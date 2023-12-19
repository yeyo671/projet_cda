<?php

namespace App\Repository;

use App\Entity\Blogpost;
use App\Entity\Comment;
use App\Entity\Paint;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Comment>
 *
 * @method Comment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Comment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Comment[]    findAll()
 * @method Comment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentRepository extends ServiceEntityRepository
{
    public function findComment($value)
    {
        // Si l'objet passé en paramètre est un Blogpost, on prépare la recherche pour un blogpost.
        if($value instanceof Blogpost){
            $object = 'blogpost';
        }
    
        // Si l'objet est une Peinture, on prépare la recherche pour une peinture.
        if($value instanceof Paint){
            $object = 'paint';
        }
    
        // Commence la création de la requête pour récupérer des commentaires.
        return $this->createQueryBuilder('c')
            // Ajoute une condition où le commentaire doit être associé à l'objet (blogpost ou paint).
            ->andWhere('c.' .$object . ' = :val')
            // Ajoute une autre condition pour ne récupérer que les commentaires publiés.
            ->andWhere('c.isPublished = true')
            // Définit la valeur de ':val' au ID de l'objet (blogpost ou paint).
            ->setParameter('val', $value->getId())
            // Trie les résultats par ID de commentaire, en ordre décroissant.
            ->orderBy('c.id', 'DESC')
            // Prépare la requête pour l'exécution.
            ->getQuery()
            // Exécute la requête et retourne les résultats (les commentaires).
            ->getResult()
        ;
    }
    
}
