<?php

namespace App\Repository;

use App\Entity\Personne;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Personne>fs
 *
 * @method Personne|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personne|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personne[]    findAll()
 * @method Personne[]    findBy{array $criteria, array $orderBy = null, $limit = null, $offset = null}
 */
class PersonneRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personne::class);
    }

    public function save(Personne $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist[$entity];

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Personne $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    // /**
    //  * @return Personne[] Returns an arry of personne objects
    //  */

   public function findOneBySomeField($value): ?Personne
   {
       return $this->createQueryBuilder('v')
           ->andWhere('v.exampleField = :val')
           ->setParameter('val', $value)
           ->getQuery()
           ->getOneOrNullResult()
       ;
   }
   
    public function findPersonnesByAgeInterval($ageMin, $ageMax)
   {
       return $this->createQueryBuilder('v')
           ->andWhere('v.age >= :ageMin and v.age <= :ageMax')
        //    ->setParameter('ageMin', $ageMin)
        //    ->setParameter('ageMax', $ageMax)
           ->setParameters(['ageMin' => $ageMin, 'ageMax' => $ageMax])
           ->getQuery()
           ->getResult()
       ;
   }

   public function statsPersonnesByAgeInterval($ageMin, $ageMax)
   {
       $qb = $this->createQueryBuilder('v')
            ->select('avg(v.age) as ageMoyen, count(v.id) as nombrePersonne');
        $this->addIntervalAge($qb, $ageMin, $ageMax);
            return $qb->getQuery()->getScalarResult();
   }

   private function addIntervalAge(QueryBuilder $qb, $ageMin, $ageMax)
   {
    $qb ->andWhere('v.age >= :ageMin and v.age <= :ageMax')
        ->setParameters(['ageMin' => $ageMin, 'ageMax' => $ageMax]);
   }

}
