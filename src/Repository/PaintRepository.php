<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Paint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

/**
 * @extends ServiceEntityRepository<Paint>
 *
 * @method Paint|null find($id, $lockMode = null, $lockVersion = null)
 * @method Paint|null findOneBy(array $criteria, array $orderBy = null)
 * @method Paint[]    findAll()
 * @method Paint[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaintRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paint::class);
    }

    /**
    * @return Paint[] Returns an array of Paint objects
    */

    public function lastTree(){
        return $this->createQueryBuilder('p')
            ->orderBy('p.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }

    /**
    * @return Paint[] Returns an array of Paint objects
    */

    public function findAllPortfolio(Category $category): array
    {
        return $this->createQueryBuilder('p')
        ->where(':category MEMBER OF p.category')
        ->andWhere('p.portfolio = TRUE')
        ->setParameter('category', $category)
        ->getQuery()
        ->getResult();
    }

}

