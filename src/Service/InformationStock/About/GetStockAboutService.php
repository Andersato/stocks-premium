<?php

declare(strict_types=1);


namespace App\Service\InformationStock\About;

use App\Entity\InformationStock;
use App\Exception\InformationStockNotFoundException;
use App\Repository\InformationStockRepository;
use App\Response\InformationStock\About\GetStockAboutResponse;
use App\Response\InformationStock\About\GetStockFinancialHealthResponse;
use App\Response\InformationStock\About\GetStockIncomeStatementResponse;
use App\Response\InformationStock\About\GetStockProfileResponse;
use App\Response\InformationStock\About\GetStockProfitabilityResponse;
use App\Response\InformationStock\About\GetStockValuationResponse;
use App\Response\Shared\KeyObjectPairResponse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final readonly class GetStockAboutService
{

    public function __construct(
        private InformationStockRepository $informationStockRepository,
        private TranslatorInterface $translator
    )
    {
    }

    /**
     * @throws InformationStockNotFoundException
     */
    public function __invoke(string $ticker): GetStockAboutResponse
    {
        $informationStock = $this->informationStockRepository->findLastByTicker($ticker);

        if (null == $informationStock) {
            throw new InformationStockNotFoundException('No existe información para este ticker: '. $ticker);
        }

        return GetStockAboutResponse::create(
            companyName: $informationStock->getStock()->getName(),
            profile: KeyObjectPairResponse::create(
                label: $this->translator->trans('titles.profile', [], 'show'),
                info: GetStockProfileResponse::create(
                    ticker: $informationStock->getStock()->getTicker(),
                    name: $informationStock->getStock()->getName(),
                    sector: $informationStock->getStock()->getSector(),
                    industry: $informationStock->getStock()->getIndustry(),
                    indexName: $informationStock->getStock()->getIndexName(),
                    marketCap: $informationStock->getMarketCap(). ' (MM)',
                    employees: $informationStock->getEmployees(),
                    beta: $informationStock->getBeta(),
                    price: $informationStock->getPrice()
                )
            ),
            financialHealth: KeyObjectPairResponse::create(
                label: $this->translator->trans('titles.financialHealth', [], 'show'),
                info: GetStockFinancialHealthResponse::create(
                    quickRatio: $informationStock->getQuickRatio(),
                    currentRatio: $informationStock->getCurrentRatio(),
                    bookSh: $informationStock->getBookSh(),
                    cashSh: $informationStock->getCashSh(),
                    debtEquity: $informationStock->getDebtEquity(),
                    ltDebtEquity: $informationStock->getLtDebtEquity()
                )
            ),
            incomeStatement: KeyObjectPairResponse::create(
                label: $this->translator->trans('titles.incomeStatement', [], 'show'),
                info: GetStockIncomeStatementResponse::create(
                    income: $informationStock->getIncome(). ' (MM)',
                    sales: $informationStock->getSales(). ' (MM)',
                    epsTtm: $informationStock->getEpsTtm(),
                    epsYYTtm: $informationStock->getEpsYYTtm(). ' %',
                    salesYYTtm: $informationStock->getSalesYYTtm(). ' %',
                    epsQQ: $informationStock->getEpsQQ(). ' %',
                    salesQQ: $informationStock->getSalesQQ(). ' %'
                )
            ),
            profitability: KeyObjectPairResponse::create(
                label: $this->translator->trans('titles.profitability', [], 'show'),
                info: GetStockProfitabilityResponse::create(
                    roa: $informationStock->getRoa(). ' %',
                    roe: $informationStock->getRoe(). ' %',
                    roi: $informationStock->getRoi(). ' %',
                    grossMargin: $informationStock->getGrossMargin(). ' %',
                    operMargin: $informationStock->getOperMargin(). ' %',
                    profitMargin: $informationStock->getProfitMargin(). ' %'
                )
            ),
            valuation: KeyObjectPairResponse::create(
                label: $this->translator->trans('titles.valuation', [], 'show'),
                info: GetStockValuationResponse::create(
                    per: $informationStock->getPer(),
                    forwardPer: $informationStock->getForwardPer(),
                    peg: $informationStock->getPeg(),
                    priceSales: $informationStock->getPriceSales(),
                    priceBook: $informationStock->getPriceBook(),
                    priceFreeCashFlow: $informationStock->getPriceFreeCashFlow()
                )
            )
        );
    }
}