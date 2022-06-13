<?php

namespace App\Controller;

use App\Entity\Option;
use App\Entity\Subscription;
use App\Entity\User;
use App\Form\SubscribeType;
use App\Repository\OptionRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Date;

class SubscribeFitnessController extends AbstractController
{

    public function __construct(private OptionRepository $optionRepository, private EntityManagerInterface   $entityManager)
    {
    }


    #[Route('/subscribe/fitness', name: 'subscribe_fitness')]
    public function index(Request $request): Response
    {
        if(!$this->getUser()) {
            return $this->renderForm('subscribe_fitness/errorSubscribe.html.twig', [
                "message"=>"Vous devez vous connecter ou vous enregistrer pour pouvoir effectuer une demande d'abonnement."
            ]);
        }

        if ($this->getUser()->getSub()) {
            return $this->render('subscribe_fitness/errorSubscribe.html.twig', [
                "message" => "Vous avez déjà effectué une demande d'abonnement.",
                "sub" => $this->getUser()->getSub()
            ]);
        }

                $form = $this->createForm(SubscribeType::class);
                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid()) {
                    $user = $this->getUser();
                    $sub = new Subscription();
                    $sub->setDate($form->get("startdate")->getData());
                    $sub->setState("firststep");
                    $type = "month";
                    if ($form->get("type")->getData()) $type = "year";
                    $sub->setType($type);
                    $user->setSub($sub);
                    $this->entityManager->persist($sub);
                    $this->entityManager->persist($user);
                    $this->entityManager->flush();
                    foreach ($form->get("options")->getData() as $option) {
                        $option = $this->optionRepository->find($option);
                        $option->addSubscription($sub);
                        $this->entityManager->persist($option);
                        $this->entityManager->flush();
                    }
                    $this->addFlash("success", "Votre demande d'abonnement à bien été pris en compte");

                    return $this->redirectToRoute("home");
                }

                return $this->renderForm('subscribe_fitness/index.html.twig', [
                    'form' => $form
                ]);


    }
}
