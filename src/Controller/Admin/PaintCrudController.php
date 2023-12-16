<?php

namespace App\Controller\Admin;

use App\Entity\Paint;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Validator\Constraints\File;


class PaintCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Paint::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextareaField::new('description')->hideOnIndex(),
            DateField::new('date_of_completion'),
            NumberField::new('height')->hideOnIndex(),
            NumberField::new('width')->hideOnIndex(),
            NumberField::new('price')->hideOnIndex(),
            BooleanField::new('on_sale'),
            BooleanField::new('portfolio'),
            TextField::new('imageFile')
            ->setFormType(VichImageType::class)
            ->onlyWhenCreating()
            ->setFormTypeOptions([
                'constraints' => [
                    new File([
                        'maxSize' => '2M',
                        'maxSizeMessage' => 'The file is too large ({{ size }} {{ suffix }}). Allowed maximum size is {{ limit }} {{ suffix }}.',
                    ])
                ],
            ]),            
            ImageField::new('file')->setBasePath('/uploads/peintures/')->onlyOnIndex(),
            SlugField::new('slug')->setTargetFieldName('name')->hideOnIndex(),
            AssociationField::new('category'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['date'=>'DESC']);
    }
}
