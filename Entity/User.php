<?php

namespace Owp\OwpCore\Entity;

use Owp\OwpCore\Entity\Base;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Owp\OwpCore\Model as OwpCoreModel;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    use OwpCoreModel\UserNameTrait;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="Owp\OwpCore\Entity\Base")
     * @ORM\JoinColumn(name="base_id", referencedColumnName="id", nullable=true)
     */
    private $base;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBase(): ?Base
    {
        return $this->base;
    }

    public function setBase(Base $base): self
    {
        $this->base = $base;
        $this->setFirstName($base->getFirstName());
        $this->setLastName($base->getLastName());

        return $this;
    }

    public function getPeople(Event $event): People
    {
        return (new People())
            ->setBase($this->getBase())
            ->setFirstName($this->getFirstName())
            ->setLastName($this->getLastName())
            ->setEvent($event);
    }
}
