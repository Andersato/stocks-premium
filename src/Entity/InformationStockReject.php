<?php

namespace App\Entity;

use App\Repository\InformationStockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class InformationStockReject
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'date')]
    private \DateTimeInterface $date;

    #[ORM\Column(length: 30)]
    private string $ticker;

    #[ORM\Column(length: 30)]
    private string $stockName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): \DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): void
    {
        $this->date = $date;
    }

    public function getTicker(): string
    {
        return $this->ticker;
    }

    public function setTicker(string $ticker): void
    {
        $this->ticker = $ticker;
    }

    public function getStockName(): string
    {
        return $this->stockName;
    }

    public function setStockName(string $stockName): void
    {
        $this->stockName = $stockName;
    }
}
