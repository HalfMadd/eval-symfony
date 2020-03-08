<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CountryRepository")
 */
class Country
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Discovery", mappedBy="country", orphanRemoval=true)
     */
    private $discovery;

    public function __construct()
    {
        $this->discoveries = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|Discovery
     */
    public function getDiscovery(): Collection
    {
        return $this->discoveries;
    }

    public function addDiscovery(Discovery $discovery): self
    {
        if (!$this->discoveries->contains($discovery)) {
            $this->discoveries[] = $discovery;
            $discovery->setCountry($this);
        }

        return $this;
    }

    public function removeDiscovery(Discovery $discovery): self
    {
        if ($this->discoveries->contains($discovery)) {
            $this->discoveries->removeElement($discovery);
            if ($discovery->getCountry() === $this) {
                $discovery->setCountry(null);
            }
        }

        return $this;
    }
}
