<?php

namespace Owp\OwpCore\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;

final class MenuAdmin extends AbstractEntityAdmin
{
    protected $baseRoutePattern  = 'menu';

    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);

        $formMapper
            ->add('link', TextType::class);
    }
}
