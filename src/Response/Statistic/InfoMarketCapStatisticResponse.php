<?php

declare(strict_types=1);


namespace App\Response\Statistic;

final class InfoMarketCapStatisticResponse
{
    private ?int $to = null;
    private ?int $from = null;
    private ?int $count = null;
    private string $name;

    /** @var InfoSectorStatisticResponse[]  */
    private array $sectors = [];

    public function getTo(): ?int
    {
        return $this->to;
    }

    public function setTo(?int $to): void
    {
        $this->to = $to;
    }

    public function getFrom(): ?int
    {
        return $this->from;
    }

    public function setFrom(?int $from): void
    {
        $this->from = $from;
    }

    public function getSectors(): array
    {
        return $this->sectors;
    }

    public function setSectors(array $sectors): void
    {
        $this->sectors = $sectors;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getCount(): ?int
    {
        return $this->count;
    }

    public function setCount(?int $count): void
    {
        $this->count = $count;
    }

    public function getTitle(): string
    {
        if (null !== $this->from && null !== $this->to) {
            return $this->from . ' MM - '. $this->to . ' MM';
        }

        if (null !== $this->from && null === $this->to) {
            return $this->from . ' MM';
        }

        return $this->to . ' MM';
    }

    public function addSector(InfoSectorStatisticResponse $infoSectorStatisticResponse): void
    {
        $this->sectors[] = $infoSectorStatisticResponse;
    }
}