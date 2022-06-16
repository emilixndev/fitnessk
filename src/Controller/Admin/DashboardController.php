<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Command;
use App\Entity\Lesson;
use App\Entity\Subscription;
use App\Entity\User;
use App\Repository\LessonRepository;
use App\Repository\SubscriptionRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{

    public function __construct(private SubscriptionRepository $subscriptionRepository)
    {
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $nbValidate = count($this->subscriptionRepository->findBy(['state'=>'valide']));
        $nbRefuse = count($this->subscriptionRepository->findBy(['state'=>'refuse']));
        $nbWaiting = count($this->subscriptionRepository->findBy(['state'=>'en_attente']));
        return $this->render("admin/dashboardAdmin.html.twig",[
            'validate' => $nbValidate,
            'refuse' => $nbRefuse,
            'waiting' => $nbWaiting

        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Fitnessk');
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToRoute("Accueil","fa fa-arrow-left","home");

        yield MenuItem::section("Abonnement","fas fa-store-alt");
        yield MenuItem::linkToCrud('Liste abonnement', 'fas fa-list', Subscription::class);

        yield MenuItem::section("Cours","fas fa-users");
        yield MenuItem::linkToCrud('Planning', 'fas fa-calendar', Lesson::class);

        yield MenuItem::section("réglage","fas fa-tools");
        yield MenuItem::linkToCrud('Adhérent', 'fas fa-user', User::class);

    }
}
