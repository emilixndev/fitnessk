<?php

namespace App\Controller\Admin;

use App\Entity\Subscription;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;

class SubscriptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Subscription::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            DateField::new("date","Date"),
            CollectionField::new('users',"Adherent"),
            CollectionField::new('options',"Options"),
            TextField::new('state',"Statut"),

        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(TextFilter::new('state'));
    }

}
