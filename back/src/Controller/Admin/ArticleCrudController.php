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
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            FormField::addTab('Généralités'),
            TextField::new('title')
                ->setLabel('Titre de larticle')
                ->setColumns(6)
                ->setHelp('255 caractères maximum')
                ->setRequired(true)
                ->setMaxLength(255),
            SlugField::new('slug')
                ->setTargetFieldName('title')
                ->setColumns(6)
                ->hideOnIndex()
                ->hideOnDetail(),
            DateTimeField::new('createdAt')
                ->setLabel('Créé le')
                ->setDisabled()
                ->setFormat('EEEE d MMMM yyyy à HH:mm')
                ->setHelp('Date le parution')
                ->setColumns(2),
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
            
            FormField::addTab('Associations possibles (facultatif)'),
            FormField::addColumn(6),
            TextField::new('imageFile')
                ->setFormType(VichImageType::class)
                ->setLabel('Image')
                ->setRequired(false)
                ->hideOnIndex()
                ->setHelp('Image de l\'article')
                ->setColumns(12),
            ImageField::new('file')
                ->setBasePath('articles')
                ->setUploadDir('articles')
                ->setRequired(false)
                ->hideOnForm()
                ->setColumns(12),
            TextField::new('picture_description')
                ->setLabel('Légende de l\'image')
                ->setRequired(false)
                ->setColumns(12)
                ->hideOnIndex()
                ->setHelp('Sera lue par les liseuses d\'écran'),

            FormField::addColumn(6),
            AssociationField::new('event')
                ->setRequired(false)
                ->setHelp('Associer un ou plusieurs événement(s)')
                ->setColumns(12)
                ->setLabel('&#201;vénement(s)'),
            TextField::new('videoURL')
                ->setLabel('Vidéo')
                ->setRequired(false)
                ->setColumns(12)
                ->hideOnIndex()
                ->setHelp('Exemple: https://youtu.be/Ha8c8n4EIgI?si=I07d0QQcG7riuaiL'),
        ];
    }
}
