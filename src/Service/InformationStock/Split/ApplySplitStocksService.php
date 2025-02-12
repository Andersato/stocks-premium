<?php

declare(strict_types=1);


namespace App\Service\InformationStock\Split;

use App\Entity\InformationStock;
use Doctrine\ORM\EntityManagerInterface;

final readonly class ApplySplitStocksService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    )
    {
    }

    public function __invoke(string $ticker, string $dateSplit, int $numberSplit): void
    {
        $informationStocks = $this->entityManager->getRepository(InformationStock::class)->findByTickerAndDateToApplySplit(
            ticker: $ticker,
            dateSplit: $dateSplit,
        );

        foreach ($informationStocks as $informationStock) {
            $informationStock->setPrice(round($informationStock->getPrice() / $numberSplit, 2));
            $informationStock->setPriceOpen(round($informationStock->getPriceOpen() / $numberSplit, 2));
            $informationStock->setPriceHigh(round($informationStock->getPriceHigh() / $numberSplit, 2));
            $informationStock->setPriceLow(round($informationStock->getPriceLow() / $numberSplit, 2));
            $informationStock->setTargetPrice(round($informationStock->getTargetPrice() / $numberSplit, 2));
            $informationStock->setPrevClose(round($informationStock->getPrevClose() / $numberSplit, 2));
            $informationStock->setAtr14(round($informationStock->getAtr14() / $numberSplit, 2));
            $informationStock->setEpsTtm(round($informationStock->getEpsTtm() / $numberSplit, 2));
            $informationStock->setEpsNextQuarter(round($informationStock->getEpsNextQuarter() / $numberSplit, 2));
            $informationStock->setShsOutstand(round($informationStock->getShsOutstand() * $numberSplit, 2));
            $informationStock->setShsFloat(round($informationStock->getShsFloat() * $numberSplit, 2));
            $informationStock->setShortInterest(round($informationStock->getShortInterest() * $numberSplit, 2));
            $informationStock->setAvgVolume(round($informationStock->getAvgVolume() * $numberSplit, 2));
            $informationStock->setBookSh(round($informationStock->getBookSh() * $numberSplit, 2));
            $informationStock->setCashSh(round($informationStock->getCashSh() * $numberSplit, 2));
            $this->entityManager->persist($informationStock);
        }

        $this->entityManager->flush();
    }
}