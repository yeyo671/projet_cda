<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
* @implements PasswordUpgraderInterface<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        // Vérifie si l'utilisateur est une instance de la classe User.
        if (!$user instanceof User) {
            // Si ce n'est pas le cas, lance une exception indiquant que le type d'utilisateur n'est pas supporté.
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }
    
        // Met à jour le mot de passe de l'utilisateur avec le nouveau mot de passe haché.
        $user->setPassword($newHashedPassword);
        // Persiste les modifications de l'utilisateur dans la base de données.
        $this->getEntityManager()->persist($user);
        // Enregistre les modifications dans la base de données.
        $this->getEntityManager()->flush();
    }
    

    public function getPainter(){
        // Commence la création d'une requête pour récupérer un utilisateur.
        return $this->createQueryBuilder('u')
            // Ajoute une condition pour filtrer les utilisateurs ayant le rôle de peintre.
            ->where('u.roles LIKE :roles')
            // Définit le rôle recherché dans les paramètres de la requête.
            ->setParameter('roles', '%"ROLE_PEINTRE"%')
            // Prépare la requête pour l'exécution.
            ->getQuery()
            // Exécute la requête et obtient soit un résultat, soit null s'il n'y a pas de correspondance.
            ->getOneOrNullResult();
    }
    


//    /**
//     * @return User[] Returns an array of User objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('u.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?User
//    {
//        return $this->createQueryBuilder('u')
//            ->andWhere('u.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
