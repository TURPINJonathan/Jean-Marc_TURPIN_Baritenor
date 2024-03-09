<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function findArticlesByTitle($title)
    {
        return $this->createQuerybuilder('a')
            ->where('a.title LIKE :title')
            ->orderBy('a.createdAt', 'DESC')
            ->addOrderBy('a.title', 'ASC')
            ->setParameter('title', '%' . $title . '%')
            ->getQuery()
            ->getResult();
    }

    public function findArticlesByContent($content)
    {
        return $this->createQuerybuilder('a')
            ->where('a.content LIKE :content')
            ->orderBy('a.createdAt', 'DESC')
            ->addOrderBy('a.content', 'ASC')
            ->setParameter('content', '%' . $content . '%')
            ->getQuery()
            ->getResult();
    }

    public function findArticlesByMonth($month, $year)
    {
        $queryDate = new \DateTime($year . '-' . $month . '-01T00:00:00Z');
        $endDate = (clone $queryDate)->modify('last day of this month')->modify('23:59:59');

        $queryBuilder = $this->createQueryBuilder('a')
            ->where('a.createdAt BETWEEN :query_date AND :end_date')
            ->orderBy('a.createdAt', 'DESC')
            ->setParameters([
                'query_date' => $queryDate->format('Y-m-d'),
                'end_date' => $endDate->format('Y-m-d'),
            ]);

        $query = $queryBuilder->getQuery();

        $result = $query->getResult();

        if (empty($result)) {
            throw new NoResultException();
        }

        return $result;
    }

    public function findArticlesByCategory($category)
    {
        return $this->createQueryBuilder('a')
            ->join('a.category', 'ac')
            ->where('ac.label = :category')
            ->orderBy('a.createdAt', 'DESC')
            ->addOrderBy('a.title', 'ASC')
            ->setParameter('category', $category)
            ->getQuery()
            ->getResult();
    }

    public function findLastFiveArticles()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.createdAt', 'DESC')
            ->setMaxResults(5)
            ->getQuery()
            ->getResult();
    }

    public function findLastArticle()
    {
        return $this->createQueryBuilder('a')
            ->orderBy('a.createdAt', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function findArticlesByEvent($id)
    {
        return $this->createQueryBuilder('a')
            ->join('a.event', 'e')
            ->where('e.id = :eventId')
            ->setParameter('eventId', $id)
            ->getQuery()
            ->getResult();
    }

    public function findArticlesByEventName($name)
    {
        return $this->createQueryBuilder('a')
            ->join('a.event', 'e')
            ->addOrderBy('a.title', 'ASC')
            ->where('e.name = :eventName')
            ->setParameter('eventName', '%' . $name . '%')
            ->getQuery()
            ->getResult();
    }
}