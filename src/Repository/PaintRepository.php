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
        // Débute la création d'une requête pour récupérer des objets Paint.
        return $this->createQueryBuilder('p')
            // Ordonne les résultats par l'ID de Paint en ordre décroissant.
            ->orderBy('p.id', 'DESC')
            // Limite les résultats aux trois derniers objets Paint.
            ->setMaxResults(3)
            // Prépare la requête pour l'exécution.
            ->getQuery()
            // Exécute la requête et obtient les résultats.
            ->getResult()
        ;
    }

    /**
    * @return Paint[] Returns an array of Paint objects
    */

    public function findAllPortfolio(Category $category): array
    {
        // Débute la création d'une requête pour récupérer des objets Paint.
        $results = $this->createQueryBuilder('p')
            // Ajoute une condition où la catégorie donnée fait partie des catégories de l'objet Paint.
            ->where(':category MEMBER OF p.category')
            // Ajoute une condition pour sélectionner uniquement les objets Paint qui sont dans le portfolio.
            ->andWhere('p.portfolio = TRUE')
            // Définit la catégorie pour la condition de la requête.
            ->setParameter('category', $category)
            // Prépare la requête pour l'exécution.
            ->getQuery()
            // Exécute la requête et stocke les résultats.
            ->getResult();
    
        // Retourne les résultats de la requête.
        return $results;
    }
    
}

