<?php

namespace App\Repository;

use App\Entity\InformationStockItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InformationStockItem>
 *
 * @method InformationStockItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method InformationStockItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method InformationStockItem[]    findAll()
 * @method InformationStockItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InformationStockItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InformationStockItem::class);
    }

    //    /**
    //     * @return InformationStockItem[] Returns an array of InformationStockItem objects
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

    //    public function findOneBySomeField($value): ?InformationStockItem
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
