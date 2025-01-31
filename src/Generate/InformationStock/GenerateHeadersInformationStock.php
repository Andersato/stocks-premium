<?php

declare(strict_types=1);


namespace App\Generate\InformationStock;

use App\Response\InformationStock\List\GetHeadersInformationStockResponse;
use App\Utils\Utils;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

final class GenerateHeadersInformationStock
{
    public static function generate(array $labels = [], array $keys = [], array $sortable = []): Collection
    {
        $headers = new ArrayCollection();

        foreach ($labels as $i => $label) {
            $headers->add(
                GetHeadersInformationStockResponse::create(
                    label: $label,
                    key: $keys[$i],
                    sortable: $sortable[$i]
                )
            );
        }

        return $headers;
    }
}