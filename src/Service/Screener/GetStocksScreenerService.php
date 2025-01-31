<?php

declare(strict_types=1);


namespace App\Service\Screener;

use App\Dto\InformationStock\GetListInformationStockDto;
use App\Entity\InformationStock;
use App\Generate\InformationStock\GenerateHeadersInformationStock;
use App\Response\InformationStock\List\GetListInformationStockResponse;
use App\Response\InformationStock\List\GetPageListInformationStockResponse;
use App\Response\Page;
use App\Utils\Utils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

final readonly class GetStocksScreenerService
{

    public function __construct(
        private EntityManagerInterface $entityManager,
        private PaginatorInterface $paginator,
        private TranslatorInterface $translator,
    )
    {
    }

    public function __invoke(GetListInformationStockDto $listInformationStockDto): GetPageListInformationStockResponse
    {
        $query = $this->entityManager->getRepository(InformationStock::class)->findByFilters(
            filters: $listInformationStockDto->getFilters(),
            page: $listInformationStockDto->getPage(),
            limit: $listInformationStockDto->getLimit()
        );

        $paginate = $this->paginator->paginate($query, $listInformationStockDto->getPage(), $listInformationStockDto->getLimit());
        $total = $paginate->getTotalItemCount();

        $items = new ArrayCollection();
        foreach ($paginate->getItems() as $item) {
            $items->add(
                GetListInformationStockResponse::create(
                    ticker: $item['ticker'],
                    name: $item['name'],
                    sector: $item['sector'],
                    industry: $item['industry'],
                    marketCap: $item['marketCap'],
                    price: $item['price'],
                    range52W: $item['range52W'],
                    distance52W: $item['high52W']
                )
            );
        }

        $headers = $this->getLabelHeaders();
        $page =  Page::create(
            items: $items,
            headers: GenerateHeadersInformationStock::generate(
                labels: $headers['labels'],
                keys: $headers['keys'],
                sortable: $headers['sortable']
            ),
            total: $total,
            numPage: $listInformationStockDto->getPage(),
            limit: $listInformationStockDto->getLimit()
        );

        return GetPageListInformationStockResponse::create(
            page: $page
        );
    }

    private function getLabelHeaders(): array
    {
        $labels = ['ticker', 'name', 'sector', 'industry', 'marketCap', 'price', 'high52W', 'distance52W'];
        $response = [
            'labels' => [],
            'keys' => [],
            'sortable' => [true, true, true, true, true, true, false, false]
        ];

        foreach ($labels as $label) {
            $key = sprintf('table.%s', $label);
            $response['labels'][] = $this->translator->trans($key, [], 'screener');
            $response['keys'][] = Utils::getSlug($label);
        }

        return $response;
    }
}