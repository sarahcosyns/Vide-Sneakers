<?php

namespace App\Repository;

use App\Entity\Article;
use App\Entity\Photo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    // /**
    //  * @return Article[] Returns an array of Article objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    
    public function findAllArticlesGenre($genre) {
        $qb = $this->createQueryBuilder('a')
                ->innerJoin('a.photos', 'p')
                ->addSelect('p')
                ->andWhere('a.genre = :genre')
                ->setParameter('genre', $genre);
        return $qb->getQuery()->getResult();
    }
    
    public function findAllByCriteria($criterias = []){
        $qb = $this->createQueryBuilder('a')
                ->innerJoin('a.photos', 'p')
                ->addSelect('p');
        if($criterias['genre']){
            $qb->andWhere('a.Genre = :genre')
                    ->setParameter(':genre', $criterias['genre']);
        }
        if($criterias['taille']){
            $qb->andWhere('a.Taille = :taille')
                    ->setParameter(':taille', $criterias['taille']);
        }
        if($criterias['couleur']){
            $qb->andWhere('a.Couleur = :couleur')
                    ->setParameter(':couleur', $criterias['couleur']);
        }
        return $qb->getQuery()->getResult();
    }
}
