<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Faker\Provider\Text;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('name',"Nom"),
            TextField::new('forname',"prénom"),
            TextField::new('sexe',"Sexe")->setTemplatePath("admin/sexefield.html.twig"),
            TextField::new('email',"email"),
            DateField::new('birth_day',"Date de naissance")

        ];
    }

}
