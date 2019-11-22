<?php

namespace Owp\OwpCore\Entity;

use Doctrine\ORM\Mapping as ORM;
use Owp\OwpCore\Model as OwpCoreTrait;

/**
 * @ORM\Entity(repositoryClass="Owp\OwpCore\Repository\MenuRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Menu
{
    use OwpCoreTrait\IdTrait;
    use OwpCoreTrait\LabelTrait;
    use OwpCoreTrait\AuthorTrait;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $link;

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(string $link): self
    {
        $this->link = $link;

        return $this;
    }
}
