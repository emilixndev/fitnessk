<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Command;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Fitnessk');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section("Boutique","fas fa-store-alt");
        yield MenuItem::linkToCrud('Commande', 'fas fa-shopping-basket', Command::class);
        yield MenuItem::linkToCrud('Article', 'fas fa-shopping-cart', Article::class);
        yield MenuItem::section("réglage","fas fa-tools");
        yield MenuItem::linkToCrud('The Label', 'fas fa-user', User::class);
    }
}
