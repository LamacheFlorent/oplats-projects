<?php

namespace App\Entity;

use App\Repository\FavoriteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FavoriteRepository::class)
 */
class Favorite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $userId;

    /**
     * @ORM\Column(type="integer")
     */
    private $recipeId;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="favorite")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="favorite")
     */
    private $recipe;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
    }

    public function getRecipeId(): ?int
    {
        return $this->recipeId;
    }

    public function setRecipeId(int $recipeId): self
    {
        $this->recipeId = $recipeId;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getRecipe(): ?Recipe
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipe $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }
}
