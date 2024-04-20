<?php

namespace App\Entity;

use App\Repository\InformationStockItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InformationStockItemRepository::class)]
class InformationStockItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $value = null;

    #[ORM\ManyToOne(inversedBy: 'informationStockItems')]
    private ?InformationStock $informationStock = null;

    #[ORM\ManyToOne]
    private ?InformationItem $item = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getInformationStock(): ?InformationStock
    {
        return $this->informationStock;
    }

    public function setInformationStock(?InformationStock $informationStock): static
    {
        $this->informationStock = $informationStock;

        return $this;
    }

    public function getItem(): ?InformationItem
    {
        return $this->item;
    }

    public function setItem(?InformationItem $item): static
    {
        $this->item = $item;

        return $this;
    }
}
