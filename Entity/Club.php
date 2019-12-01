<?php

namespace Owp\OwpCore\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Owp\OwpCore\Model as OwpCoreModel;
use Owp\OwpEvent\Model as OwpEventTrait;

/**
 * @ORM\Entity(repositoryClass="Owp\OwpCore\Repository\ClubRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Club
{
    use OwpCoreModel\LabelTrait;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=10)
     */
    protected $name;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): self
    {
        $this->name = $name;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getName() . ' - ' . $this->getLabel();
    }
}
