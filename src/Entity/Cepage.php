<?php

namespace App\Entity;

use App\Repository\CepageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CepageRepository::class)
 */
class Cepage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $variety;

    /**
     * @ORM\ManyToMany(targetEntity=Wine::class, mappedBy="cepages")
     */
    private $wines;

    public function __construct()
    {
        $this->wines = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTheVariety()
    {
        return 'Le ' . $this->variety;
    }
    public function getVariety(): ?string
    {
        return $this->variety;
    }

    public function setVariety(string $variety): self
    {
        $this->variety = $variety;

        return $this;
    }

    /**
     * @return Collection|Wine[]
     */
    public function getWines(): Collection
    {
        return $this->wines;
    }

    public function addWine(Wine $wine): self
    {
        if (!$this->wines->contains($wine)) {
            $this->wines[] = $wine;
            $wine->addCepage($this);
        }

        return $this;
    }

    public function removeWine(Wine $wine): self
    {
        if ($this->wines->removeElement($wine)) {
            $wine->removeCepage($this);
        }

        return $this;
    }
}
