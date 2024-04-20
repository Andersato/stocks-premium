<?php

namespace App\Message;

use App\Constant\InformationItemConstants;
use App\Entity\InformationItem;
use App\Entity\Stock;
use App\Model\InformationItem\InformationItemFactory;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final class AddInformationStockHandler
{
    final public const URL_STOCK = 'https://finviz.com/quote.ashx?t=#TICKER&ty=c&p=d&b=1';
    final public const TABLE_CLASS = 'screener_snapshot-table-body';

    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[NoReturn]
    public function __invoke(AddInformationStockMessage $message): void
    {
        /** @var Stock $stock */
        $stock = $this->entityManager->getRepository(Stock::class)->findOneByTicker($message->getTicker());
        if (null === $stock) {
            $stock = new Stock();
            $stock->setTicker($message->getTicker());
            $stock->setName($message->getName());
            $this->entityManager->persist($stock);
        }
        $this->entityManager->flush();

        $client = new HttpBrowser(HttpClient::create(['timeout' => 60]));
        $url = str_replace('#TICKER', $message->getTicker(), self::URL_STOCK);
        $crawler = $client->request('GET',  $url);

        $table = $crawler->filter('table.'.self::TABLE_CLASS);
        $table->each(function (Crawler $tbody) use ($stock) {
            $epsNextYear = 0;
            $tbody->children('tr')->each(function (Crawler $tr) use ($epsNextYear, $stock) {
                for ($i = 0; $i < $tr->children('td')->count(); $i += 2) {
                    $tdItemName = $tr->children('td')->eq($i)->text();
                    $tdItemValue = $tr->children('td')->eq($i+1)->text();
                    if (InformationItemConstants::EPS_NEXT_YEAR === $tdItemName) {
                        $epsNextYear++;
                    }
                    if (2 === $epsNextYear) {
                        $tdItemName = InformationItemConstants::EPS_NEXT_G_YEAR;
                    }
                    $informationType = InformationItemFactory::create($tdItemName);
                    if (null !== $informationType) {
                        $informationType->setValue($tdItemValue);
                        $informationTypeEntity = $this->entityManager->getRepository(InformationItem::class)->findOneByName(
                            $informationType->getName()
                        );
                        if (null === $informationTypeEntity) {
                            $informationTypeEntity = new InformationItem();
                            $informationTypeEntity->setType($informationType->getType());
                            $informationTypeEntity->setName($informationType->getName());
                            $this->entityManager->persist($informationTypeEntity);
                        }
                    }
                }
            });
        });
        die;
    }
}