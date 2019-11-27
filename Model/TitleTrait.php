<?php

namespace Owp\OwpCore\Model;

use Knp\DoctrineBehaviors\Model\Sluggable\Sluggable;

Trait TitleTrait
{
    use Sluggable;

    /**
     * @ORM\Column(type="string", length=255)
     */
    protected $title;

    /**
     * @ORM\Column(type="string", length=512)
     */
    protected $slug;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        $this->generateSlug();

        return $this;
    }

    public function getSluggableFields()
    {
        return [ 'id', 'title' ];
    }

    public function generateSlugValue($values)
    {
        return strtolower(implode('-', str_replace(' ', '-', $values)));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getTitle();
    }
}
