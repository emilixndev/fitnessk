<?php

namespace App\Controller\Admin;

use App\Entity\Suscription;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SuscriptionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Suscription::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('membercard'),
            CollectionField::new('users',"Adherent"),

        ];
    }

}
