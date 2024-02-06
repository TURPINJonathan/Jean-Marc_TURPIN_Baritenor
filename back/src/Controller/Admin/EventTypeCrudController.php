<?php

namespace App\Controller\Admin;

use App\Entity\EventType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EventTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return EventType::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Type d\'événement')
            ->setEntityLabelInPlural('Liste des types d\'événements');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideOnDetail()->hideOnIndex(),
            TextField::new('label')
                ->setLabel('Nom du type')
                ->setColumns(12)
                ->setHelp('100 caractères maximum')
                ->setRequired(true)
                ->setMaxLength(100),
        ];
    }
}
