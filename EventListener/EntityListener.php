<?php

namespace Owp\OwpCore\EventListener;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use App\Entity\AbstractEntity;
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
            $entity->setCreateBy($this->tokenStorage->getToken()->getUser());
            $entity->setUpdateBy($this->tokenStorage->getToken()->getUser());
        }
    }

    public function preUpdate(LifecycleEventArgs $event)
    {
        $entity = $event->getEntity();

        if (in_array('Owp\OwpCore\Model\AuthorTrait', class_uses($entity))) {
            $entity->setUpdateBy($this->tokenStorage->getToken()->getUser());
        }
    }
}
