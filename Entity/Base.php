<?php

namespace Owp\OwpCore\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="Owp\OwpCore\Repository\BaseRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Base
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $lastName;

    /**
     * @ORM\Column(type="integer", length=255, nullable=true)
     */
    protected $si;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $club;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId($id): ?self
    {
        $this->id = $id;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): ?self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): ?self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getSi()
    {
        return $this->si;
    }

    public function setSi($si): ?self
    {
        $this->si = $si;

        return $this;
    }

    public function getClub(): ?string
    {
        return $this->club;
    }

    public function setClub($club): ?self
    {
        $this->club = $club;

        return $this;
    }

    public function __toString()
    {
        return $this->getId() . ' - ' . $this->getLastName() . ' ' . $this->getFirstName();
    }
}