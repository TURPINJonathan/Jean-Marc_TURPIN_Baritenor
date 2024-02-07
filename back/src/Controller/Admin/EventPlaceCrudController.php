<?php

namespace App\Controller\Admin;

use App\Entity\EventPlace;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class EventPlaceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EventPlace::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Lieu d\'événement')
            ->setEntityLabelInPlural('Liste des lieux d\'événements');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideOnDetail()->hideOnIndex(),
            FormField::addFieldset('Généralités'),
            TextField::new('name')
                ->setLabel('Nom du lieu')
                ->setHelp('255 caractères maximum')
                ->setRequired(true)
                ->setMaxLength(255),
            AssociationField::new('eventType')
                ->setLabel('Type')
                ->setRequired(true),
            FormField::addFieldset('Localisation'),
            TextField::new('city')
                ->setLabel('Ville')
                ->setColumns(12)
                ->setHelp('100 caractères maximum')
                ->setRequired(true)
                ->setMaxLength(100),
            NumberField::new('longitude')
                ->setColumns(6)
                ->setLabel('Longitude')
                ->setRequired(false),
            NumberField::new('latitude')
                ->setColumns(6)
                ->setLabel('Latitude')
                ->setRequired(false),
        ];
    }
}
