<?php

namespace App\Controller;

use App\Entity\ArticleCategory;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArticleCategoryController extends AbstractController
{
    #[Route('/api/article_category/list', name: 'article_category_list', methods: ['GET'])]
    public function articlesCategoryList(ManagerRegistry $doctrine): Response
    {
        $articlesCategory = $doctrine->getManager()->getRepository(ArticleCategory::class)->findAll();

        if (!$articlesCategory) {
            throw new NoResultException();
        }

        return $this->json($articlesCategory, Response::HTTP_OK, [], ['groups' => 'article_get']);
    }
}
