<?php

namespace App\Repository;

use App\Entity\ArticleLayout;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ArticleLayout>
 *
 * @method ArticleLayout|null find($id, $lockMode = null, $lockVersion = null)
 * @method ArticleLayout|null findOneBy(array $criteria, array $orderBy = null)
 * @method ArticleLayout[]    findAll()
 * @method ArticleLayout[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleLayoutRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ArticleLayout::class);
    }
}
