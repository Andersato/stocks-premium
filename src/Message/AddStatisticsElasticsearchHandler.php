<?php

namespace App\Message;

use App\Constant\ElasticsearchConstants;
use App\Constant\InformationItemConstants;
use App\Entity\InformationItem;
use App\Entity\InformationStock;
use App\Entity\Stock;
use App\Exception\InformationStockNotFoundException;
use App\Model\InformationItem\InformationItemFactory;
use App\Model\InformationItem\InformationTypeInterface;
use App\Model\InformationStock\StatisticElasticsearchDocument;
use App\Repository\InformationStockRepository;
use App\Utils\Utils;
use Doctrine\ORM\EntityManagerInterface;
use Elastic\Elasticsearch\Client;
use Elastic\Elasticsearch\ClientBuilder;
use Elastic\Elasticsearch\Exception\AuthenticationException;
use JetBrains\PhpStorm\NoReturn;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\DomCrawler\Crawler;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;

#[AsMessageHandler]
final class AddStatisticsElasticsearchHandler
{
    private EntityManagerInterface $entityManager;
    private Client $client;

    /**
     * @throws AuthenticationException
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        private readonly string $elasticsearchHost
    )
    {
        $this->client = ClientBuilder::create()->setHosts([$elasticsearchHost])->build();
        $this->entityManager = $entityManager;
    }

    /**
     * @throws InformationStockNotFoundException
     * @throws \Exception
     */
    #[NoReturn]
    public function __invoke(AddStatisticsElasticsearchMessage $message): void
    {

        try {
            $dates = $this->entityManager->getRepository(InformationStock::class)->findDatesToStatisticsElastic($message->getTicker());
            $dates = array_map(function($item) {
                return $item['date'];
            }, $dates);

            if (count($dates) >= 2) {
                $informationStockPrev = $this->entityManager->getRepository(InformationStock::class)->findByTickerAndDate(
                    ticker: $message->getTicker(),
                    date: $dates[1]
                );

                $informationStockCurrent = $this->entityManager->getRepository(InformationStock::class)->findByTickerAndDate(
                    ticker: $message->getTicker(),
                    date:$dates[0]
                );

                $stock = $informationStockCurrent->getStock();
                $posLastWeek = min(InformationStockRepository::LAST_WEEK, count($dates));
                $informationStockLastWeek = $this->entityManager->getRepository(InformationStock::class)->findByTickerAndDate(
                    ticker: $message->getTicker(),
                    date:$dates[$posLastWeek-1]
                );

                $body = [
                    'changeVolume' => $informationStockPrev->getVolume() > 0 ? round(($informationStockCurrent->getVolume() - $informationStockPrev->getVolume()) / $informationStockPrev->getVolume() * 100, 2) : 0,
                    'changeRelativeVolume' => $informationStockPrev->getRelVolume() > 0 ? round(($informationStockCurrent->getRelVolume() - $informationStockPrev->getRelVolume()) / $informationStockPrev->getRelVolume() * 100, 2) : 0,
                    'changeInstOwn' => $informationStockPrev->getInstOwn() > 0 ? round(($informationStockCurrent->getInstOwn() - $informationStockPrev->getInstOwn()) / $informationStockPrev->getInstOwn() * 100, 2) : 0,
                    'changeInsiderOwn' => $informationStockPrev->getInsiderOwn() > 0 ? round(($informationStockCurrent->getInsiderOwn() - $informationStockPrev->getInsiderOwn()) / $informationStockPrev->getInsiderOwn() * 100, 2) : 0,
                    'changePrice' => $informationStockCurrent->getChangeToday(),
                    'price' => $informationStockCurrent->getPrice(),
                    'changeShortFloat' => $informationStockPrev->getShortFloat() > 0 ? round(($informationStockCurrent->getShortFloat() - $informationStockPrev->getShortFloat()) / $informationStockPrev->getShortFloat() * 100, 2) : 0,
                    'perfWeek' => $informationStockCurrent->getPerfWeek(),
                    'perfMonth' => $informationStockCurrent->getPerfMonth(),
                    'perfYear' => $informationStockCurrent->getPerfYear(),
                    'perfQuarter' => $informationStockCurrent->getPerfQuarter(),
                    'perfHalfYear' => $informationStockCurrent->getPerfHalfYear(),
                    'perfYtd' => $informationStockCurrent->getPerfYtd(),
                    'marketCap' => $informationStockCurrent->getMarketCap(),
                    'high52W' => $informationStockCurrent->getHigh52W(),
                    'epsYYTtm' => $informationStockCurrent->getEpsTtm(),
                    'epsQQ' => $informationStockCurrent->getEpsQQ(),
                    'salesYYTtm' => $informationStockCurrent->getSalesYYTtm(),
                    'salesQQ' => $informationStockCurrent->getSalesQQ(),
                    'rsi' => $informationStockCurrent->getRsi14(),
                    'volume' => $informationStockCurrent->getVolume(),
                    'avgVolume' => $informationStockCurrent->getAvgVolume(),
                    'changeInstOwnWeek' => $informationStockLastWeek->getInstOwn() > 0 ? round(($informationStockCurrent->getInstOwn() - $informationStockLastWeek->getInstOwn()) / $informationStockLastWeek->getInstOwn() * 100, 2) : 0,
                    'changeInsiderOwnWeek' => $informationStockLastWeek->getInsiderOwn() > 0 ? round(($informationStockCurrent->getInsiderOwn() - $informationStockLastWeek->getInsiderOwn()) / $informationStockLastWeek->getInsiderOwn() * 100, 2) : 0,
                    'changeShortFloatWeek' => $informationStockLastWeek->getShortFloat() > 0 ? round(($informationStockCurrent->getShortFloat() - $informationStockLastWeek->getShortFloat()) / $informationStockLastWeek->getShortFloat() * 100, 2) : 0,
                ];

                try {
                    $params = [
                        'index' => ElasticsearchConstants::INDEX_NAME,
                        'body' => [
                            'query' => [
                                'term' => [
                                    'ticker' => $message->getTicker()
                                ]
                            ]
                        ]
                    ];

                    $response = $this->client->search($params)->asArray();

                    $document = StatisticElasticsearchDocument::transform($response);

                    $paramsToInsert = [
                        'index' => ElasticsearchConstants::INDEX_NAME,
                    ];

                    if (null === $document) {
                        $paramsToInsert['body'] = $body;
                        $paramsToInsert['body']['ticker'] = $stock->getTicker();
                        $paramsToInsert['body']['name'] =  $stock->getName();
                        $paramsToInsert['body']['sector'] = $stock->getSector();
                        $paramsToInsert['body']['industry'] = $stock->getIndustry();

                        $this->client->index($paramsToInsert);
                    } else {
                        $paramsToInsert['id'] = $document->getId();
                        $paramsToInsert['body']['doc'] = $body;

                        $this->client->update($paramsToInsert);
                    }
                } catch (\Exception $exception) {
                    dd("Error: " . json_encode($body), $exception->getMessage());
                }
            }
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }

    }
}