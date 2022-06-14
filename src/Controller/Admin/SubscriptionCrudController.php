<?php

namespace App\Controller\Admin;

use App\Entity\Subscription;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class SubscriptionCrudController extends AbstractCrudController
{

    public function __construct(private EntityManagerInterface $em, private AdminUrlGenerator $adminUrlGenerator)
    {

    }

    public static function getEntityFqcn(): string
    {
        return Subscription::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud->showEntityActionsInlined();
    }


    public function configureActions(Actions $actions): Actions
    {

        $validate = Action::new('Validate', 'valider')
            ->setIcon('fa fa-check')
            ->linkToCrudAction('validate_sub')
            ->setCssClass('btn btn-success')
            ->displayIf(function (Subscription $subscription){
                if($subscription->getState() ==="en_attente"){
                    return true;
                }
                return false;
            })
        ;


        $refuse = Action::new('Refuse', 'Refuser')
            ->setIcon('fa fa-close')
            ->linkToCrudAction('refuse_sub')
            ->setCssClass('btn btn-danger')
            ->displayIf(function (Subscription $subscription){
                if($subscription->getState() ==="en_attente"){
                    return true;
                }
                return false;
            })
        ;



        return $actions->add(Crud::PAGE_INDEX,$refuse)
                        ->add(Crud::PAGE_INDEX,$validate);
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            DateField::new("date","Date"),
            CollectionField::new('users',"Adherent"),
            CollectionField::new('options',"Options"),
            TextField::new('state',"Statut")->setTemplatePath("admin/statefield.html.twig"),

        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(TextFilter::new('state',"Statut"));
    }



    public function validate_sub(AdminContext $context)
    {
        /** @var Subscription $subscription */
        $subscription = $context->getEntity()->getInstance();
        $subscription->setState("valide");
        $this->em->persist($subscription);
        $this->em->flush();
        $session = $context->getRequest()->getSession();
        $session->getFlashBag()->add('success', "L'abonnement à été validé");
        $url = $this->adminUrlGenerator
            ->setController(__CLASS__)
            ->setAction(Action::INDEX)
            ->generateUrl();
        return $this->redirect($url);
    }




    public function refuse_sub(AdminContext $context)
    {
        /** @var Subscription $subscription */
        $subscription = $context->getEntity()->getInstance();
        $subscription->setState("refuse");
        $this->em->persist($subscription);
        $this->em->flush();
        $session = $context->getRequest()->getSession();
        $session->getFlashBag()->add('success', "L'abonnement à été refusé");
        $url = $this->adminUrlGenerator
            ->setController(__CLASS__)
            ->setAction(Action::INDEX)
            ->generateUrl();
        return $this->redirect($url);
    }

}
