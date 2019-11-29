<?php

namespace Owp\OwpCore\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Doctrine\ORM\Events;

class EntityListener implements EventSubscriber
{
    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    public function getSubscribedEvents()
    {
        return [
            Events::prePersist,
            Events::preUpdate,
        ];
    }

    public function prePersist(LifecycleEventArgs $event)
    {
        $entity = $event->getEntity();

        if (in_array('Owp\OwpCore\Model\AuthorTrait', class_uses($entity))) {
            $user = $this->tokenStorage->getToken()->getUser();
            if (!$user instanceof User) {
                return;
            }

            $entity->setCreateBy($user);
            $entity->setUpdateBy($user);
        }
    }

    public function preUpdate(LifecycleEventArgs $event)
    {
        $entity = $event->getEntity();


        if (in_array('Owp\OwpCore\Model\AuthorTrait', class_uses($entity))) {
            $user = $this->tokenStorage->getToken()->getUser();
            if (!$user instanceof User) {
                return;
            }

            $entity->setUpdateBy($user);
        }
    }
}
