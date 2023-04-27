<?php

namespace App\Repository;

use App\Entity\Produit;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Produit>
 *
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

    public function add(Produit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Produit $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return Produit[] Returns an array of Produit objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Produit
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }


    public function search($results1 = null){
        $query = $this->createQueryBuilder('a');
       // $query->where('a.active = 1');
        // if($mots != null){
        //     $query->andWhere('MATCH_AGAINST(a.title, a.content) AGAINST (:mots boolean)>0')
        //         ->setParameter('mots', $mots);
        // }
        // if($categorie != null){
        //     $query->leftJoin('a.categories', 'c');
        //     $query->andWhere('c.id = :id')
        //         ->setParameter('id', $categorie);
        // }
        if($results1 != null){
            $query->andWhere('a.idcat IN(:cats)')
                ->setParameter(':cats', array_values($results1));
        }

        return $query->getQuery()->getResult();
    }
    public function recherchee($value): array
    {
        $qb= $this->createQueryBuilder('c')
            ->andWhere('c.codeproduit LIKE :val')
            ->setParameter('val', $value);
           
         
         return $qb->getQuery()->getResult();
        
    }
    public function trie(): array
    {
        $qb= $this->createQueryBuilder('c')
        ->orderBy('c.prixunitaire', 'ASC');
         return $qb->getQuery()->getResult();
        
    }



}






