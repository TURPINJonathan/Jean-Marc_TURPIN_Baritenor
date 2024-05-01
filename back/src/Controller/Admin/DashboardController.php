<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\ArticleCategory;
use App\Entity\Event;
use App\Entity\EventType;
use App\Entity\EventPlace;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(EventCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Jean-Marc TURPIN, Bariténor');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::subMenu('Evénements', 'fas fa-calendar-days')->setSubItems([
            MenuItem::linkToCrud('Mes événements', 'fas fa-list', Event::class),
            MenuItem::linkToCrud('Lieux', 'fas fa-map-location', EventPlace::class),
            MenuItem::linkToCrud('Types', 'fas fa-layer-group', EventType::class),
        ]);

        yield MenuItem::subMenu('Articles', 'fas fa-newspaper')->setSubItems([
            MenuItem::linkToCrud('Mes articles', 'fas fa-newspaper', Article::class),
            MenuItem::linkToCrud('Catégories', 'fas fa-folder-tree', ArticleCategory::class),
        ]);
    }
}
