<?php

declare(strict_types=1);


namespace App\Service\InformationStock\Performance;

use App\Dto\InformationStock\GetPerformanceInformationStockDto;
use App\Generate\InformationStock\GenerateHeadersInformationStock;
use App\Repository\InformationStockRepository;
use App\Response\InformationStock\List\Performance\GetPerformanceInformationStockResponse;
use App\Response\Page;
use App\Utils\Utils;
use Doctrine\Common\Collections\ArrayCollection;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final readonly class GetPerformanceStocksService
{

    public function __construct(
        private InformationStockRepository $informationStockRepository,
        private PaginatorInterface $paginator,
        private TranslatorInterface $translator,
    )
    {
    }

    public function __invoke(GetPerformanceInformationStockDto $getPerformanceInformationStockDto): Page
    {
        $query = $this->informationStockRepository->findByPerformance(
            filters: $getPerformanceInformationStockDto->getFilters(),
            page: $getPerformanceInformationStockDto->getPage(),
            limit: $getPerformanceInformationStockDto->getLimit()
        );

        $paginate = $this->paginator->paginate($query, $getPerformanceInformationStockDto->getPage(), $getPerformanceInformationStockDto->getLimit());
        $total = $paginate->getTotalItemCount();

        $items = new ArrayCollection();
        foreach ($paginate->getItems() as $item) {
            $items->add(
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
            );
        }

        $headers = $this->getLabelHeaders();

        return  Page::create(
            items: $items,
            headers: GenerateHeadersInformationStock::generate(
                labels: $headers['labels'],
                keys: $headers['keys'],
                sortable: $headers['sortable']
            ),
            total: $total,
            numPage: $getPerformanceInformationStockDto->getPage(),
            limit: $getPerformanceInformationStockDto->getLimit()
        );
    }

    private function getLabelHeaders(): array
    {
        $labels = ['ticker', 'name', 'sector', 'industry', 'marketCap', 'price', 'priceClose', 'change'];
        $response = [
            'labels' => [],
            'keys' => [],
            'sortable' => [false, false, false, false, false, false, false, false]
        ];

        foreach ($labels as $label) {
            $key = sprintf('table.%s', $label);
            $response['labels'][] = $this->translator->trans($key, [], 'screener');
            $response['keys'][] = Utils::getSlug($label);
        }

        return $response;
    }
}