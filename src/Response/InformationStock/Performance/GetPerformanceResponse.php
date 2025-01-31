<?php

declare(strict_types=1);


namespace App\Response\InformationStock\Performance;

use App\Response\AppResponseInterface;
use App\Response\Shared\KeyValuePairResponse;

final readonly class GetPerformanceResponse implements AppResponseInterface
{
    /** @var KeyValuePairResponse[] $performanceCategories */
    private array $performanceCategories;

    /** @var KeyValuePairResponse[] $marketCapCategories */
    private array $marketCapCategories;

    /** @var KeyValuePairResponse[] $sectors */
    private array $sectors;

    public function __construct(array $performanceCategories = [], array $marketCapCategories = [], array $sectors = [])
    {
        $this->performanceCategories = $performanceCategories;
        $this->marketCapCategories = $marketCapCategories;
        $this->sectors = $sectors;
    }

    public function getPerformanceCategories(): array
    {
        return $this->performanceCategories;
    }

    public function getMarketCapCategories(): array
    {
        return $this->marketCapCategories;
    }

    public function getSectors(): array
    {
        return $this->sectors;
    }
}