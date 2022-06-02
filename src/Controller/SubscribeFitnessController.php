<?php

namespace App\Controller;

use App\Form\SubscribeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SubscribeFitnessController extends AbstractController
{
    #[Route('/subscribe/fitness', name: 'subscribe_fitness')]
    public function index(Request $request): Response
    {

        $form = $this->createForm(SubscribeType::class);

        $form->handleRequest($request);

        return $this->renderForm('subscribe_fitness/index.html.twig', [
            'controller_name' => 'SubscribeFitnessController',
            'form' => $form
        ]);
    }
}
