<?php

declare(strict_types=1);


namespace App\Response\Statistic;

final class InfoSectorStatisticResponse
{
    private string $name;

    /** @var InfoIndustryStatisticResponse[]  */
    private array $industries;

    public function __construct(string $name)
    {
        $this->name = $name;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getIndustries(): array
    {
        return $this->industries;
    }

    public function setIndustries(array $industries): void
    {
        $this->industries = $industries;
    }

    public function addIndustries(InfoIndustryStatisticResponse $infoIndustryStatisticResponse): void
    {
        $this->industries[] = $infoIndustryStatisticResponse;
    }
}