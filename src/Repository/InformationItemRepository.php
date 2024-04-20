<?php

namespace App\Repository;

use App\Entity\InformationItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<InformationItem>
 *
 * @method InformationItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method InformationItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method InformationItem[]    findAll()
 * @method InformationItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InformationItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InformationItem::class);
    }

    //    /**
    //     * @return InformationItem[] Returns an array of InformationItem objects
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

    //    public function findOneBySomeField($value): ?InformationItem
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
