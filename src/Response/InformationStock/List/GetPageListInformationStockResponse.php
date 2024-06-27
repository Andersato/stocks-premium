<?php

declare(strict_types=1);


namespace App\Response\InformationStock\List;

use App\Response\AppResponseInterface;
use App\Response\InformationStock\List\Performance\TopGainersResponse;
use App\Response\InformationStock\List\Performance\TopLosersResponse;
use App\Response\Page;

final class GetPageListInformationStockResponse implements AppResponseInterface
{
    private Page $page;
    private TopGainersResponse $topGainersResponse;
    private TopLosersResponse $topLosersResponse;

    public static function create(Page $page, TopGainersResponse $topGainersResponse, TopLosersResponse $topLosersResponse): self
    {
        $response = new self();

        $response->page = $page;
        $response->topGainersResponse = $topGainersResponse;
        $response->topLosersResponse = $topLosersResponse;

        return $response;
    }

    public function getPage(): Page
    {
        return $this->page;
    }

    public function getTopGainersResponse(): TopGainersResponse
    {
        return $this->topGainersResponse;
    }

    public function getTopLosersResponse(): TopLosersResponse
    {
        return $this->topLosersResponse;
    }
}