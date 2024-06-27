<?php

namespace App\Repository;

use App\Entity\Stock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Stock>
 *
 * @method Stock|null find($id, $lockMode = null, $lockVersion = null)
 * @method Stock|null findOneBy(array $criteria, array $orderBy = null)
 * @method Stock[]    findAll()
 * @method Stock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Stock::class);
    }

    public function findOneByTicker(string $ticker): ?Stock
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.ticker = :ticker')
            ->setParameter('ticker', $ticker)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findSectors(): array
    {
        $qb = $this->createQueryBuilder('s')
            ->select('DISTINCT(s.sector) as sector')
            ->where('s.sector IS NOT NULL')
            ->orderBy('s.sector', 'ASC');

        return $qb->getQuery()->getScalarResult();
    }

    public function findTickersToAutocomplete(string $value): array
    {
        $qb = $this->createQueryBuilder('s')
            ->select('s.ticker, s.name')
            ->where('s.ticker LIKE :ticker')
            ->setParameter('ticker', $value.'%')
            ->setMaxResults(15)
            ->orderBy('s.ticker', 'ASC');

        return $qb->getQuery()->getArrayResult();
    }

    public function findTickersByStatistics(): array
    {
        $qb = $this->createQueryBuilder('s')
            ->select('s.ticker')
            ->getQuery();

        return $qb->getArrayResult();
    }
}
