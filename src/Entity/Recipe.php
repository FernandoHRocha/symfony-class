<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $idRecipe = null;

    #[ORM\Column(length: 255, options:["collation" => 'utf8mb4_general_ci'])]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true, options:["collation" => 'utf8mb4_general_ci', 'default' => '/default.jpeg'])]
    private ?string $thumbnail = null;

    #[ORM\Column(length: 255, options:["collation" => 'utf8mb4_general_ci'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 8, scale: 2)]
    private ?string $price = null;

    #[ORM\ManyToOne(targetEntity: "Category", inversedBy: "recipe")]
    private ?string $category = null;

    public function getId(): ?int
    {
        return $this->idRecipe;
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

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(string $thumbnail): self
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getIdRecipe(): ?int
    {
        return $this->idRecipe;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }
}
