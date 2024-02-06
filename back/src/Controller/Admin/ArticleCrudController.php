<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Article')
            ->setEntityLabelInPlural('Liste de mes articles');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideOnDetail()->hideOnIndex(),
            FormField::addFieldset('Généralités'),
            TextField::new('title')
                ->setLabel('Titre de larticle')
                ->setColumns(8)
                ->setHelp('255 caractères maximum')
                ->setRequired(true)
                ->setMaxLength(255),
            DateTimeField::new('createdAt')
                ->setLabel('Créé le')
                ->setDisabled()
                ->setFormat('EEEE d MMMM yyyy à HH:mm')
                ->setHelp('Date le parution')
                ->setColumns(4),
            AssociationField::new('layout')
                ->setLabel('Choix du rendu')
                ->hideOnIndex()
                ->setHelp('Un seul choix possible')
                ->setRequired(true)
                ->setColumns(8),
            AssociationField::new('category')
                ->setLabel('Catégorie(s)')
                ->hideOnIndex()
                ->setHelp('Plusieurs choix possibles')
                ->setColumns(4)
                ->setRequired(true),
            TextEditorField::new('content')
                ->setColumns(12)
                ->setLabel('Contenu de l\'article')
                ->setRequired(true)
                ->hideOnIndex(),
            FormField::addFieldset('Associations possibles (facultatif)')->renderCollapsed(),
            AssociationField::new('event')
                ->setRequired(false)
                ->setHelp('Associer un ou plusieurs événement(s) ?')
                ->setLabel('&#201;vénement(s) associé(s)'),
        ];
    }
}
