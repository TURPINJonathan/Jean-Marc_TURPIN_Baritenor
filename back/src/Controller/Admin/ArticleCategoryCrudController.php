<?php

namespace App\Controller\Admin;

use App\Entity\ArticleCategory;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ArticleCategory::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Catégorie d\'article')
            ->setEntityLabelInPlural('Liste de mes catégories d\'article');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideOnDetail()->hideOnIndex(),
            TextField::new('label')
                ->setLabel('Nom de la catégorie')
                ->setColumns(12)
                ->setHelp('100 caractères maximum')
                ->setRequired(true)
                ->setMaxLength(100),
        ];
    }
}
