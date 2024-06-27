<?php

declare(strict_types=1);


namespace App\Dto\InformationStock;

final class GetListInformationStockDto
{
    public int $page = 1;
    public int $limit = 20;
    private GetFiltersListInformationStockDto $filters;

    public function __construct(
    )
    {
    }

    public static function create(GetFiltersListInformationStockDto $filters, int $page = 1, int $limit = 20): self
    {
        $getListInformationStockDto = new self();
        $getListInformationStockDto->filters = $filters;
        $getListInformationStockDto->page = $page;
        $getListInformationStockDto->limit = $limit;

        return $getListInformationStockDto;
    }

    public function getFilters(): GetFiltersListInformationStockDto
    {
        return $this->filters;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}