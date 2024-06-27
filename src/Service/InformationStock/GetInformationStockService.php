<?php

declare(strict_types=1);


namespace App\Service\InformationStock;

use App\Entity\InformationStock;
use App\Exception\InformationStockNotFoundException;
use Doctrine\ORM\EntityManagerInterface;

final class GetInformationStockService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @throws InformationStockNotFoundException
     */
    public function __invoke(string $ticker): InformationStock
    {
        $informationStock = $this->entityManager->getRepository(InformationStock::class)->findLastByTicker($ticker);

        if (null == $informationStock) {
            throw new InformationStockNotFoundException('No existe información para este ticker: '. $ticker);
        }

        return $informationStock;
    }
}