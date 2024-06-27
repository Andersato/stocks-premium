<?php

declare(strict_types=1);


namespace App\Service\InformationStock\List;

use App\Dto\InformationStock\GetListInformationStockDto;
use App\Entity\InformationStock;
use App\Response\InformationStock\List\GetListInformationStockResponse;
use App\Response\InformationStock\List\GetPageListInformationStockResponse;
use App\Response\Page;
use App\Service\InformationStock\Performance\TopGainersService;
use App\Service\InformationStock\Performance\TopLosersService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;

final class GetListInformationStockService
{
    private EntityManagerInterface $entityManager;
    private TopGainersService $topGainersService;

    private TopLosersService $topLosersService;
    private PaginatorInterface $paginator;

    public function __construct(
        EntityManagerInterface $entityManager,
        TopGainersService $topGainersService,
        TopLosersService $topLosersService,
        PaginatorInterface $paginator

    )
    {
        $this->entityManager = $entityManager;
        $this->topGainersService = $topGainersService;
        $this->topLosersService = $topLosersService;
        $this->paginator = $paginator;
    }

    public function __invoke(GetListInformationStockDto $listInformationStockDto): GetPageListInformationStockResponse
    {
        $topGainersResponse = ($this->topGainersService)();
        $topLosersResponse = ($this->topLosersService)();

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

        $page =  Page::create($items, $total, $listInformationStockDto->getPage(), $listInformationStockDto->getLimit());

        return GetPageListInformationStockResponse::create(
            page: $page,
            topGainersResponse: $topGainersResponse,
            topLosersResponse: $topLosersResponse
        );
    }
}