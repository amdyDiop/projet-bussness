<?php

namespace App\Repository;

use App\Entity\Produit;
//use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Produit|null find($id, $lockMode = null, $lockVersion = null)
 * @method Produit|null findOneBy(array $criteria, array $orderBy = null)
 * @method Produit[]    findAll()
 * @method Produit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProduitRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Produit::class);
    }
    /**
     * @return Query
     */
   /** public function findAllVisibleQuery(PropertySearch  $search): Query
    {

        $query = $this->findVisibleQuery();
        if ($search->getMaxPrice())
        {
            $query= $query
                ->andWhere('p.prix <= :maxPrice')
                ->setParameter('maxPrice',$search->getMaxPrice());
        }
        if ($search->getVille())
        {
            $query= $query
                ->andWhere('p.ville = :ville')
                ->setParameter('ville',$search->getVille());
        }
        /**  if ($search->getSurface())
        {
        $query= $query
        ->andWhere('p.surface <= :surface')
        ->setParameter('surface',$search->getSurface());
        }
        return $query->getQuery();

    }**/
    public function findlast():array
    {
        return  $this->findVisibleQuery()
            ->setMaxResults(8)
            ->getQuery()
            ->getResult();

    }


    private  function findVisibleQuery():QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->Where('p.visible = true');
    }
    // /**
    //  * @return Produit[] Returns an array of Produit objects
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
    public function findOneBySomeField($value): ?Produit
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
