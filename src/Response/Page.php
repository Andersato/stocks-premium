<?php

namespace App\Response;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class Page
{
    private Collection $items;
    private int $total;
    private int $page;
    private int $limit;

    private function __construct()
    {
        $this->items = new ArrayCollection();
    }

    public static function create(Collection $items, int $total, int $numPage = 1, int $limit = 10): self
    {
        $page = new self();
        $page->setItems($items);
        $page->setTotal($total);
        $page->setPage($numPage);
        $page->setLimit($limit);

        return $page;
    }

    public function getItems(): Collection
    {
        return $this->items;
    }

    private function setItems(Collection $items): void
    {
        $this->items = $items;
    }

    public function getTotal(): int
    {
        return $this->total;
    }

    private function setTotal(int $total): void
    {
        $this->total = $total;
    }

    public function getPage(): int
    {
        return $this->page;
    }

    private function setPage(int $page): void
    {
        $this->page = $page;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    private function setLimit(int $limit): void
    {
        $this->limit = $limit;
    }
}
