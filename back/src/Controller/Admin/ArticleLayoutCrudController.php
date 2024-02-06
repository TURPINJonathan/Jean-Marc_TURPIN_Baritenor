<?php

namespace App\Controller\Admin;

use App\Entity\ArticleLayout;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class ArticleLayoutCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ArticleLayout::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Layout')
            ->setEntityLabelInPlural('Liste des layout');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideOnDetail()->hideOnIndex(),
            IntegerField::new('choice')
                ->setLabel('Numéro du layout')
                ->setColumns(12)
                ->setRequired(true),
        ];
    }
}
