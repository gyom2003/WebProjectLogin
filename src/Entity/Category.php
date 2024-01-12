<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $name = null;

    #[ORM\OneToMany(mappedBy: 'category_relation', targetEntity: Items::class)]

    // #[ORM\Column(name: "categorymain" )]
    private Collection $categorymain;

    public function __construct()
    {
        $this->categorymain = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

  
    public function getCategorymain(): Collection
    {
        return $this->categorymain;
    }

    public function addCategorymain(Items $categorymain): static
    {
        if (!$this->categorymain->contains($categorymain)) {
            $this->categorymain->add($categorymain);
            $categorymain->setCategoryRelation($this);
        }

        return $this;
    }

    public function removeCategorymain(Items $categorymain): static
    {
        if ($this->categorymain->removeElement($categorymain)) {
            if ($categorymain->getCategoryRelation() === $this) {
                $categorymain->setCategoryRelation(null);
            }
        }

        return $this;
    }
}
