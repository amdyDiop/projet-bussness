<?php

namespace App\Repository;

use App\Entity\Boutique;
use App\Entity\Produit;
use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;

/**
 * @method Boutique|null find($id, $lockMode = null, $lockVersion = null)
 * @method Boutique|null findOneBy(array $criteria, array $orderBy = null)
 * @method Boutique[]    findAll()
 * @method Boutique[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BoutiqueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Boutique::class);
    }
    /**
     * @return Query
     */
    public function findAllBoutique(PropertySearch  $search): Query
    {

        $query = $this->findBoutiqueVisible();

        if ($search->getVille())
        {
            $query= $query
                ->andWhere('p.ville = :ville')
                ->setParameter('ville',$search->getVille());
        }


        if ($search->getNom())
        {
            $query= $query
                ->andWhere('p.nomBoutique = :nom')
                ->setParameter('nom',$search->getnom());
        }
        return $query->getQuery();

    }

    /**
     * @return Property
     */
    function findLatest():array
    {
        return $this->findBoutiqueVisible()
            ->setMaxResults(12)
            ->getQuery()
            ->getResult();

    }

    function findNEW():array
    {
        return $this->createQueryBuilder('p')
            ->where('p.active=true')
            ->setMaxResults(4)
            ->orderBy('p.id', 'DESC')
            ->getQuery()
            ->getResult();

    }
    function marchand():array
    {
        return $this->createQueryBuilder('b')
            ->where('b.id=8')
            ->getQuery()
            ->getResult();

    }

    /**
     * @return QueryBuilder
     */
    private function findBoutiqueVisible():QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.active=true');
    }





    /*
    public function findOneBySomeField($value): ?Boutique
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
