<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Event;
use App\Repository\ArticleRepository;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/api/article/list', name: 'article_list', methods: ['GET'])]
    public function articlesList(ManagerRegistry $doctrine): Response
    {
        $articles = $doctrine->getManager()->getRepository(Article::class)->findAll();

        if (!$articles) {
            throw new NoResultException();
        }

        return $this->json($articles, Response::HTTP_OK, [], ['groups' => 'article_get']);
    }

    #[Route('/api/article/{id}', name: 'article_id', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function articleById(ManagerRegistry $doctrine, $id): Response
    {
        $article = $doctrine->getManager()->getRepository(Article::class)->find(['id' => $id]);
        $serializationGroup = ['article_get'];
        $articleEvent = $article->getEvent();

        if (!$article) {
            throw new NoResultException();
        }

        if (!empty($articleEvent) && count($articleEvent) > 0) {
            $serializationGroup[] = 'article_with_event_get';
        }

        return $this->json($article, Response::HTTP_OK, [], ['groups' => $serializationGroup]);
    }

    #[Route('/api/article/{slug}', name: 'article_slug', methods: ['GET'], requirements: ['slug' => '[a-z0-9-]+'])]
    public function articleBySlug(ManagerRegistry $doctrine, $slug): Response
    {
        $article = $doctrine->getManager()->getRepository(Article::class)->findArticleBySlug(['slug' => $slug]);
        $serializationGroup = ['article_get'];
        $articleEvent = $article->getEvent();

        if (!$article) {
            throw new NoResultException();
        }

        if (!empty($articleEvent) && count($articleEvent) > 0) {
            $serializationGroup[] = 'article_with_event_get';
        }

        return $this->json($article, Response::HTTP_OK, [], ['groups' => $serializationGroup]);
    }

    #[Route('/api/article/name_{title}', name: 'article_by_name', methods: ['GET'], requirements: ['id' => '[^\s]+'])]
    public function articleByTitle(ArticleRepository $article, $title): Response
    {
        $articles = $article->findArticlesByTitle($title);

        if (!$articles) {
            throw new NoResultException();
        }

        return $this->json($articles, Response::HTTP_OK, [], ['groups' => 'article_get']);
    }

    #[Route('/api/article/month_{month}{year}', name: 'article_by_month', methods: ['GET'], requirements: ['month' => '0[1-9]|1[0-2]', 'year' => '\d{4}'])]
    public function articleByMonth(ArticleRepository $articleRepository, $month, $year): Response
    {
        $articles = $articleRepository->findArticlesByMonth($month, $year);

        if (!$articles) {
            throw new NoResultException();
        }

        return $this->json($articles, Response::HTTP_OK, [], ['groups' => 'article_get']);
    }

    #[Route('/api/article/category_{category}', name: 'article_by_category', methods: ['GET'], requirements: ['place' => '.+'])]
    public function articleByPlace(ArticleRepository $articleRepository, $category): Response
    {
        $articles = $articleRepository->findArticlesByCategory($category);

        if (!$articles) {
            throw new NoResultException();
        }

        return $this->json($articles, Response::HTTP_OK, [], ['groups' => 'article_get']);
    }

    #[Route('/api/article/last_five', name: 'article_last_five', methods: ['GET'])]
    public function lastFiveArticles(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findLastFiveArticles();

        if (!$articles) {
            throw new NoResultException();
        }

        return $this->json($articles, Response::HTTP_OK, [], ['groups' => 'article_get']);
    }

    #[Route('/api/article/last_one', name: 'article_last_one', methods: ['GET'])]
    public function lastArticle(ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->findLastArticle();

        if (!$article) {
            throw new NoResultException();
        }

        return $this->json($article, Response::HTTP_OK, [], ['groups' => 'article_get']);
    }

    #[Route('/api/article/by_event_{id}', name: 'article_by_event', methods: ['GET'], requirements: ['event' => '\d+'])]
    public function articleByEvent(ArticleRepository $article, ManagerRegistry $doctrine, $id): Response
    {
        $event = $doctrine->getManager()->getRepository(Event::class)->find(['id' => $id]);
        $articles = $article->findArticlesByEvent($event);


        if (!$event || !$articles) {
            throw new NoResultException();
        }

        return $this->json($articles, Response::HTTP_OK, [], ['groups' => ['article_get', 'article_with_event_get']]);
    }

    #[Route('/api/article/search', name: 'article_search', methods: ['GET'])]
    public function articlesSearch(ArticleRepository $articleRepository, Request $request): Response
    {
        $params = $request->query->all();

        dump($params);

        $articlesFound = [];

        if (isset($params['title']) && $params['title']) {
            $articlesByTitle = $articleRepository->findArticlesByTitle($params['title']);
            
            foreach ($articlesByTitle as $articleTitle) {
                array_push($articlesFound, $articleTitle);
            }
        }

        if (isset($params['category_label']) && $params['category_label']) {
            $articlesByCategory = $articleRepository->findArticlesByCategory($params['category_label']);
            
            foreach ($articlesByCategory as $articleByCategory) {
                array_push($articlesFound, $articleByCategory);
            }
        }

        if (isset($params['content']) && $params['content']) {
            $articlesByContent = $articleRepository->findArticlesByContent($params['content']);
            
            foreach ($articlesByContent as $articleByContent) {
                array_push($articlesFound, $articleByContent);
            }
        }

        if (isset($params['event_name']) && $params['event_name']) {
            $articlesByEventName = $articleRepository->findArticlesByEventName($params['event_name']);
            
            foreach ($articlesByEventName as $articleByEventName) {
                array_push($articlesFound, $articleByEventName);
            }
        }

        return $this->json($articlesFound, Response::HTTP_OK, [], ['groups' => ['article_get', 'article_with_event_get']]);
    }
}
