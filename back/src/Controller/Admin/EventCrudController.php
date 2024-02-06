<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('&#201;vénement')
            ->setEntityLabelInPlural('Liste de mes événements');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideOnDetail()->hideOnIndex(),
            FormField::addFieldset('Généralités'),
            TextField::new('name')
                ->setLabel('Nom de l\'événement')
                ->setColumns(12)
                ->setHelp('255 caractères maximum')
                ->setRequired(true)
                ->setMaxLength(255),
            TextEditorField::new('details')
                ->setColumns(12)
                ->setLabel('Ajouter des précisions à l\'événement.')
                ->setRequired(false)
                ->hideOnIndex()
                ->setHelp('Sera affiché dans l\'info-bulle sur la carte.'),
            AssociationField::new('eventPlace')
                ->setLabel('Lieu de l\'événement')
                ->setColumns(12)
                ->setHelp('Permettra d\'afficher l\'événement sur la carte.')
                ->setRequired(false),
            FormField::addFieldset('Date de l\'événement'),
            DateTimeField::new('startAt')
                ->setLabel('Début')
                ->setColumns(6)
                ->setRequired(true)
                ->setFormat('EEEE d MMMM yyyy à HH:mm')
                ->setHelp('Date et heure de commencement de l\'événement'),
            DateTimeField::new('endAt')
                ->setLabel('Fin')
                ->setColumns(6)
                ->setFormat('EEEE d MMMM yyyy à HH:mm')
                ->setRequired(true)
                ->setHelp('Date et heure de fin de l\'événement'),
        ];
    }
}
