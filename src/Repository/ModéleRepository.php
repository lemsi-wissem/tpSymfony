<?php

namespace App\Repository;

use App\Entity\Modéle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Modéle>
 *
 * @method Modéle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Modéle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Modéle[]    findAll()
 * @method Modéle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModéleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Modéle::class);
    }

//    /**
//     * @return Modéle[] Returns an array of Modéle objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Modéle
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
