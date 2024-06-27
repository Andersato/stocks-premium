<?php

declare(strict_types=1);


namespace App\Service\InformationStock\Performance;

use App\Constant\InformationStockConstants;
use App\Entity\InformationStock;
use App\Entity\Stock;
use App\Response\InformationStock\List\Performance\GetPerformanceInformationStockResponse;
use App\Response\InformationStock\List\Performance\TopGainersResponse;
use Doctrine\ORM\EntityManagerInterface;

final class TopGainersService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(): TopGainersResponse
    {
        $response = new TopGainersResponse();

        $sectors = $this->entityManager->getRepository(Stock::class)->findSectors();

        $topGainers = [
            'SmallCaps' => [],
            'MidCaps' => [],
            'LargeCaps' => [],
            'MegaCaps' => []
        ];

        foreach ($sectors as $items) {
            $parameters[InformationStockConstants::FILTER_SECTOR] = $items['sector'];
            $topGainers['SmallCaps'][$items['sector']] = $this->entityManager->getRepository(InformationStock::class)->findByMarketCap(
                    InformationStockConstants::SMALL_CAPS,
                    [InformationStockConstants::FILTER_TOP_GAINERS],
                    $parameters
            );
            $topGainers['MidCaps'][$items['sector']] = $this->entityManager->getRepository(InformationStock::class)->findByMarketCap(
                InformationStockConstants::MID_CAPS,
                [InformationStockConstants::FILTER_TOP_GAINERS],
                $parameters
            );
            $topGainers['LargeCaps'][$items['sector']] = $this->entityManager->getRepository(InformationStock::class)->findByMarketCap(
                InformationStockConstants::LARGE_CAPS,
                [InformationStockConstants::FILTER_TOP_GAINERS],
                $parameters
            );
            $topGainers['MegaCaps'][$items['sector']] = $this->entityManager->getRepository(InformationStock::class)->findByMarketCap(
                InformationStockConstants::MEGA_CAPS,
                [InformationStockConstants::FILTER_TOP_GAINERS],
                $parameters
            );
        }

        foreach ($topGainers as $key => $items) {
            $addFunction = sprintf('add%s', $key);
            $sectors = array_keys($items);
            foreach ($sectors as $sector) {
                /** @var InformationStock $item */
                foreach ($items[$sector] as $item) {
                    $response->$addFunction(
                        GetPerformanceInformationStockResponse::create(
                            ticker: $item['ticker'],
                            name: $item['name'],
                            sector: $item['sector'],
                            industry: $item['industry'],
                            marketCap: $item['marketCap'],
                            price: $item['price'],
                            priceClose: $item['prevClose'],
                            change: $item['changeToday']
                        ),
                        $sector
                    );
                }
            }
        }

        return $response;
    }
}