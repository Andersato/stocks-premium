<?php

declare(strict_types=1);


namespace App\Service\InformationStock\Performance;

use App\Constant\InformationStockConstants;
use App\Entity\InformationStock;
use App\Entity\Stock;
use App\Response\InformationStock\List\Performance\GetPerformanceInformationStockResponse;
use App\Response\InformationStock\List\Performance\TopGainersResponse;
use App\Response\InformationStock\List\Performance\TopLosersResponse;
use Doctrine\ORM\EntityManagerInterface;

final class TopLosersService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(): TopLosersResponse
    {
        $response = new TopLosersResponse();

        $sectors = $this->entityManager->getRepository(Stock::class)->findSectors();

        $topLosers = [
            'SmallCaps' => [],
            'MidCaps' => [],
            'LargeCaps' => [],
            'MegaCaps' => []
        ];

        foreach ($sectors as $items) {
            $parameters[InformationStockConstants::FILTER_SECTOR] = $items['sector'];
            $topLosers['SmallCaps'][$items['sector']] = $this->entityManager->getRepository(InformationStock::class)->findByMarketCap(
                InformationStockConstants::SMALL_CAPS,
                [InformationStockConstants::FILTER_TOP_LOSERS],
                $parameters
            );
            $topLosers['MidCaps'][$items['sector']] = $this->entityManager->getRepository(InformationStock::class)->findByMarketCap(
                InformationStockConstants::MID_CAPS,
                [InformationStockConstants::FILTER_TOP_LOSERS],
                $parameters
            );
            $topLosers['LargeCaps'][$items['sector']] = $this->entityManager->getRepository(InformationStock::class)->findByMarketCap(
                InformationStockConstants::LARGE_CAPS,
                [InformationStockConstants::FILTER_TOP_LOSERS],
                $parameters
            );
            $topLosers['MegaCaps'][$items['sector']] = $this->entityManager->getRepository(InformationStock::class)->findByMarketCap(
                InformationStockConstants::MEGA_CAPS,
                [InformationStockConstants::FILTER_TOP_LOSERS],
                $parameters
            );
        }

        foreach ($topLosers as $key => $items) {
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