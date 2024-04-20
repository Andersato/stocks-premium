<?php

namespace App\Entity;

use App\Repository\InformationStockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: InformationStockRepository::class)]
class InformationStock
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne]
    private ?Stock $stock = null;

    #[ORM\OneToMany(targetEntity: InformationStockItem::class, mappedBy: 'informationStock')]
    private Collection $informationStockItems;

    public function __construct()
    {
        $this->informationStockItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }
    
    public function getStock(): ?Stock
    {
        return $this->stock;
    }

    public function setStock(?Stock $stock): void
    {
        $this->stock = $stock;
    }

    /**
     * @return Collection<int, InformationStockItem>
     */
    public function getInformationStockItems(): Collection
    {
        return $this->informationStockItems;
    }

    public function addInformationStockItem(InformationStockItem $informationStockItem): static
    {
        if (!$this->informationStockItems->contains($informationStockItem)) {
            $this->informationStockItems->add($informationStockItem);
            $informationStockItem->setInformationStock($this);
        }

        return $this;
    }

    public function removeInformationStockItem(InformationStockItem $informationStockItem): static
    {
        if ($this->informationStockItems->removeElement($informationStockItem)) {
            // set the owning side to null (unless already changed)
            if ($informationStockItem->getInformationStock() === $this) {
                $informationStockItem->setInformationStock(null);
            }
        }

        return $this;
    }
}
