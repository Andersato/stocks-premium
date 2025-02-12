<?php

namespace App\Command;

use App\Constant\ElasticsearchConstants;
use App\Entity\InformationStock;
use App\Entity\InformationStockReject;
use App\Message\AddInformationStockMessage;
use Doctrine\ORM\EntityManagerInterface;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use Elastic\Elasticsearch\Exception\ClientResponseException;
use Elastic\Elasticsearch\Exception\MissingParameterException;
use Elastic\Elasticsearch\Exception\ServerResponseException;
use phpDocumentor\Reflection\Types\Integer;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

#[AsCommand(
    name: 'app:add-daily-prices-stocks',
    description: 'Se encarga de añadir los precios diarios (alto, bajo) de las acciones',
)]
class AddDailyPriceToStocksCommand extends Command
{
    private const DAILY = 'daily/%s/prices';

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly HttpClientInterface $tiingoClient
    )
    {
        parent::__construct();
    }

    /**
     * @return int
     * @throws ClientExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws ServerExceptionInterface
     * @throws TransportExceptionInterface
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $informationStocks = $this->entityManager->getRepository(InformationStock::class)->findDistinctStocksWithoutHighAndLowPrice();
        $currentDate = new \DateTime('now');

        foreach ($informationStocks as $informationStock) {
            try {
                $response = $this->tiingoClient->request('GET',
                    sprintf(self::DAILY, $informationStock['ticker']),
                    [
                    'query' => [
                       'startDate' => '2024-04-30',
                       'endDate' => $currentDate->format('Y-m-d'),
                    ]
                ]);

                $content = json_decode($response->getContent(), true);

                foreach ($content as $item) {
                    $date = new \DateTime($item['date']);

                    $informationStockEntity = $this->entityManager->getRepository(InformationStock::class)->findByTickerAndCreatedAt(
                        ticker: $informationStock['ticker'],
                        createdAt: $date->format('Y-m-d')
                    );

                    if (null !== $informationStockEntity) {
                        $informationStockEntity->setPriceHigh($item['high']);
                        $informationStockEntity->setPriceLow($item['low']);
                        $informationStockEntity->setPriceOpen($item['open']);
                        $informationStockEntity->setVolume($item['volume']);
                        $this->entityManager->persist($informationStockEntity);
                    } else {
                        $io->info(
                            sprintf('No hay datos para la fecha %s y la acción con ticker %s',
                            $date->format('Y-m-d'), $informationStock['ticker'])
                        );
                    }
                }

                $this->entityManager->flush();
                $io->success(sprintf('Se ha procesado la acción %s.', $informationStock['ticker']));
            } catch (\Exception $exception) {
                $io->error($exception->getMessage());
            }

        }

        return Command::SUCCESS;
    }
}
