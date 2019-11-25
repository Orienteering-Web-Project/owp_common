<?php

namespace Owp\OwpCore\Admin;

use Sonata\AdminBundle\Form\FormMapper;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class LinkAdmin extends AbstractEntityAdmin
{
    protected $baseRoutePattern  = 'link';

    protected function configureFormFields(FormMapper $formMapper)
    {
        parent::configureFormFields($formMapper);

        $formMapper
            ->add('link', TextType::class)
            ->add('description', TextareaType::class, ['required' => false]);
    }
}
