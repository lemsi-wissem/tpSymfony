<?php

namespace App\Repository;

use App\Entity\Modèle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Modèle>
 *
 * @method Modèle|null find($id, $lockMode = null, $lockVersion = null)
 * @method Modèle|null findOneBy(array $criteria, array $orderBy = null)
 * @method Modèle[]    findAll()
 * @method Modèle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ModèleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Modèle::class);
    }

//    /**
//     * @return Modèle[] Returns an array of Modèle objects
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

//    public function findOneBySomeField($value): ?Modèle
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
