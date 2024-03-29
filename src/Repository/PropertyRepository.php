<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;


/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }

    /**
     * @return Query
     */
    public function findAllVisibleQuery(PropertySearch  $search): Query
    {

        $query = $this->findVisibleQuery();
        if ($search->getMaxPrice())
        {
            $query= $query
                ->andWhere('p.price <= :maxPrice')
                ->setParameter('maxPrice',$search->getMaxPrice());
        }
        if ($search->getVille())
        {
            $query= $query
                ->andWhere('p.city = :ville')
                ->setParameter('ville',$search->getVille());
        }
        if ($search->getSurface())
        {
            $query= $query
                ->andWhere('p.surface <= :surface')
                ->setParameter('surface',$search->getSurface());
        }
        return $query->getQuery();

    }
        public function findlast():array
        {
            return  $this->findVisibleQuery()
                    ->setMaxResults(6)
                    ->getQuery()
                    ->getResult();

        }


    private  function findVisibleQuery():QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->Where('p.solde = false');
    }
    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
