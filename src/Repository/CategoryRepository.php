<?php

namespace App\Repository;

use App\Entity\Category;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Category>
 *
 * @method Category|null find($id, $lockMode = null, $lockVersion = null)
 * @method Category|null findOneBy(array $criteria, array $orderBy = null)
 * @method Category[]    findAll()
 * @method Category[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CategoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Category::class);
    }


    public function findCategoriesWithPortfolioPaints()
    {
        // Commence la création d'une requête pour récupérer des données.
        return $this->createQueryBuilder('c')
            // Joint cette table avec une autre table 'paints' liée aux catégories.
            ->innerJoin('c.paints', 'p')
            // Ajoute une condition : sélectionne seulement les peintures qui sont dans le portfolio.
            ->where('p.portfolio = :portfolio')
            // Définit la valeur 'true' pour la condition 'portfolio' dans la requête.
            ->setParameter('portfolio', true)
            // Groupe les résultats par l'ID de la catégorie pour éviter les doublons.
            ->groupBy('c.id')
            // Finalise et prépare la requête pour l'exécution.
            ->getQuery()
            // Exécute la requête et obtient les résultats (les catégories).
            ->getResult();
    }
    

//    /**
//     * @return Category[] Returns an array of Category objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Category
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
