<?php

namespace App\Controller\Admin;

use App\Entity\Blogpost;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;


class BlogpostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Blogpost::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('title'),
            TextField::new('slug')->hideOnForm(),
            TextareaField::new('content'),
            DateField::new('date')->hideOnForm(),
        ];
    }
}
