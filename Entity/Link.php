<?php

namespace Owp\OwpCore\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Model\Common as OwpCommonTrait;

/**
 * @ORM\Entity(repositoryClass="Owp\OwpCore\Repository\LinkRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Link
{
    use OwpCommonTrait\IdTrait;
    use OwpCommonTrait\LabelTrait;
    use OwpCommonTrait\AuthorTrait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $link;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
