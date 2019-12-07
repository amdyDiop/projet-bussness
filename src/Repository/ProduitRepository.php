<?php

namespace App\Repository;

use App\Entity\Produit;
use App\Entity\PropertySearch;

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
    public function findAllProduit(PropertySearch  $search): Query
    {

        $query = $this->findAllProduitVisible();
        if ($search->getMaxPrice())
        {
            $query= $query
                ->andWhere('p.prix <= :maxPrice')
                ->setParameter('maxPrice',$search->getMaxPrice());
        }

      /**if ($search->getNom())
        {
            $query= $query
                ->andWhere('p.sku = :nom')
                ->setParameter('nom',$search->getNom());
        }**/
        return $query->getQuery();

    }
    public function findlast():array
    {
        return  $this->findAllProduitVisible()
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(16)
            ->getQuery()
            ->getResult();

    }


    private  function findAllProduitVisible():QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->Where('p.visible = true');
    }


    function findNEW():array
    {

        return $this->createQueryBuilder('p')
            ->where('p.visible= true')
            ->setMaxResults(4)
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult();
    }

    function best():array
    {

        return $this->createQueryBuilder('p')
            ->where('p.visible= true')
            ->andWhere('p.id >= 204')
            ->setMaxResults(4)
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult();
    }


    function topProduit2():array
    {

        return $this->createQueryBuilder('p')
            ->andwhere('p.id = 200')
            ->getQuery()
            ->getResult();
    }

    function topProduit1():array
    {

        return $this->createQueryBuilder('p')
            ->andwhere('p.id = 201')

            ->getQuery()
            ->getResult();
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
