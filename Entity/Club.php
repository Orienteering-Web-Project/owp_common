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
     * @ORM\Column(type="string", length=10)
     */
    protected $id;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId($id): self
    {
        $this->id = $id;

        return $this;
    }
}
