<?php

declare(strict_types=1);


namespace App\Service\InformationStock\List;

use App\Entity\Stock;
use App\Response\InformationStock\List\GetTickersToAutocompleteResponse;
use Doctrine\ORM\EntityManagerInterface;

final class GetTickerToAutocompleteService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(string $value): array
    {
        $tickers = $this->entityManager->getRepository(Stock::class)->findTickersToAutocomplete($value);

        $response = [];
        foreach ($tickers as $ticker) {
            $response[] = GetTickersToAutocompleteResponse::create(
                ticker: $ticker['ticker'],
                name: $ticker['name']
            );
        }

        return $response;
    }
}