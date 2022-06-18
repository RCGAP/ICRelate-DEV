<?php

namespace App\Controller\Admin;

use App\Entity\Moderation;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ModerationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Moderation::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextEditorField::new('introduction'),
            TextField::new('content'),
            TextField::new('youtube'),
        ];
    }
    
}
