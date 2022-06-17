<?php

namespace App\Controller\Admin;

use App\Entity\Lesson;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class LessonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Lesson::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name',"Nom"),
            DateTimeField::new('date',"Début"),
            DateTimeField::new('datetimeend',"Fin"),
            BooleanField::new("enable","Valide"),
            ColorField::new("color","Couleur"),
            NumberField::new("nbmax")->onlyOnForms(),
            BooleanField::new("full")->onlyOnForms()

        ];
    }

}
