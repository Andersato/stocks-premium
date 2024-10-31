<?php

namespace App\Message;

use App\Constant\InformationItemConstants;
use App\Entity\InformationItem;
use App\Entity\InformationStock;
use App\Entity\InformationStockReject;
use App\Entity\Stock;
use App\Model\InformationItem\InformationItemFactory;
use App\Model\InformationItem\InformationTypeInterface;
use App\Utils\Utils;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
final class AddInformationStockHandler
{
    final public const URL_STOCK = 'https://finviz.com/quote.ashx?t=#TICKER&ty=c&p=d&b=1';
    final public const TABLE_CLASS = 'screener_snapshot-table-body';
    final public const DIV_QUOTES_LINKS = 'div.quote-header-wrapper > div.quote-links > div';
    private int $epsNextYear;

    private EntityManagerInterface $entityManager;
    private MessageBusInterface $messageBus;

    public function __construct(EntityManagerInterface $entityManager, MessageBusInterface $messageBus)
    {
        $this->entityManager = $entityManager;
        $this->messageBus = $messageBus;
        $this->epsNextYear = 0;
    }

    #[NoReturn]
    public function __invoke(AddInformationStockMessage $message): void
    {
        sleep(1);
        try {
            /** @var Stock $stock */
            $stock = $this->entityManager->getRepository(Stock::class)->findOneByTicker($message->getTicker());
            if (null === $stock) {
                $stock = new Stock();
                $stock->setTicker($message->getTicker());
                $stock->setName($message->getName());
            }

            $client = new HttpBrowser(HttpClient::create(['timeout' => 60]));
            $url = str_replace('#TICKER', $message->getTicker(), self::URL_STOCK);
            $crawler = $client->request('GET',  $url);
            $dateCrawler = $crawler->filter('span.quote-price_date');
            $quotesCrawler = $crawler->filter(self::DIV_QUOTES_LINKS);
            $sector = $stock->getSector();
            if (0 < $quotesCrawler->count()) {
                $linksCrawler = $quotesCrawler->eq(0)->filter('a');
                if (4 <= $linksCrawler->count()) {
                    $stock->setSector($linksCrawler->eq(0)->text());
                    $stock->setIndustry($linksCrawler->eq(1)->text());
                    $stock->setIndexName($linksCrawler->eq(3)->text());
                }
            }

            if (null === $sector) {
                $this->entityManager->persist($stock);
                $this->entityManager->flush();
            }

            if ($dateCrawler->count() > 0) {
                $date = Utils::getDate($dateCrawler->text());

                $informationStock = $this->entityManager->getRepository(InformationStock::class)->findByStockAndDate($stock, $date);

                if (null === $informationStock) {
                    $informationStock = new InformationStock();
                    $informationStock->setCreatedAt($date);
                    $informationStock->setStock($stock);

                    $table = $crawler->filter('table.'.self::TABLE_CLASS);

                    $table->each(function (Crawler $tbody) use ($informationStock) {
                        $bodyChildren = $tbody->children('tr');
                        $bodyChildren->each(function (Crawler $tr) use ($informationStock) {
                            $trChildren = $tr->children('td');
                            for ($i = 0; $i < $trChildren->count(); $i += 2) {
                                $tdItemName = $trChildren->eq($i)->text();
                                $tdItemValue = $trChildren->eq($i+1)->text();

                                if (InformationItemConstants::EPS_NEXT_YEAR === $tdItemName) {
                                    $this->epsNextYear++;
                                }
                                if (InformationItemConstants::EPS_NEXT_YEAR === $tdItemName && 2 === $this->epsNextYear) {
                                    $tdItemName = InformationItemConstants::EPS_NEXT_G_YEAR;
                                }

                                try {
                                    $informationType = InformationItemFactory::create($tdItemName);
                                    if (null !== $informationType) {
                                        $informationType->setValue($tdItemValue);
                                        $informationItem = $this->entityManager->getRepository(InformationItem::class)->findOneByName(
                                            $informationType->getName()
                                        );
                                        if (null === $informationItem) {
                                            $informationItem = new InformationItem();
                                            $informationItem->setType($informationType->getType());
                                            $informationItem->setName($informationType->getName());
                                            $this->entityManager->persist($informationItem);
                                        }

                                        $this->addValueItem($informationStock, $informationType, $informationItem);
                                        $this->entityManager->persist($informationStock);
                                    }
                                } catch (\Exception|\Throwable $exception) {
                                    $this->messageBus->dispatch(
                                        new SendErrorEmailMessage(
                                            stock: $informationStock->getStock()->getTicker(),
                                            itemName: $tdItemName,
                                            itemValue: $tdItemValue,
                                            error: $exception->getMessage()
                                        )
                                    );
                                }
                            }
                        });
                    });
                }

                $this->entityManager->flush();
            }
        } catch (\Exception|\Throwable $exception) {
            $stockInformationReject =  new InformationStockReject();
            $stockInformationReject->setDate(new \DateTime());
            $stockInformationReject->setStockName($message->getName());
            $stockInformationReject->setTicker($message->getTicker());
            $this->entityManager->persist($stockInformationReject);
            $this->entityManager->flush();

            $this->messageBus->dispatch(
                new SendErrorEmailMessage(
                    stock: $message->getTicker(),
                    itemName: $message->getName(),
                    itemValue: (string) $message->getNumMessage(),
                    error: $exception->getMessage()
                )
            );
        }
    }

    /**
     * @throws \Exception
     */
    private function addValueItem(
        InformationStock $informationStock,
        InformationTypeInterface $informationType,
        InformationItem $informationItem
    ): void
    {
        $value = $informationType->getValue();

        switch ($informationItem->getType()) {
            case 'float': $value = (float) $value; break;
            case 'integer': $value = (int) $value; break;
            case 'date': $value = new \DateTime($value); break;
        }

        $setter = sprintf('set%s', $informationItem->getAttributeName());
        $informationStock->$setter($value);
    }
}