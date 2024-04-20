<?php

namespace App\Repository;

use App\Entity\InformationStock;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InformationStock>
 *
 * @method InformationStock|null find($id, $lockMode = null, $lockVersion = null)
 * @method InformationStock|null findOneBy(array $criteria, array $orderBy = null)
 * @method InformationStock[]    findAll()
 * @method InformationStock[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InformationStockRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InformationStock::class);
    }

    //    /**
    //     * @return InformationStock[] Returns an array of InformationStock objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('i.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?InformationStock
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
