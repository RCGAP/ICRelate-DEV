<?php

namespace App\Controller\Admin;

use App\Entity\PostLike;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PostLikeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return PostLike::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new('post'),
            ChoiceField::new('user'),
        ];
    }
}
