<?php

namespace App\Entity;

use App\Repository\ReviewRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ReviewRepository::class)
 */
class Review
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"reviews:users"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5000, nullable=true)
     * @Groups({"reviews:users"})
     */
    private $comment;

    /**
     * @ORM\Column(type="decimal", precision=2, scale=1, nullable=true)
     * @Groups({"reviews:users"})
     */
    private $rate;

    /**
     * @ORM\ManyToOne(targetEntity=Recipe::class, inversedBy="review")
     */
    private $recipe;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="reviews")
     */
    private $user;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function setComment(?string $comment): self
    {
        $this->comment = $comment;

        return $this;
    }

    public function getRate(): ?string
    {
        return $this->rate;
    }

    public function setRate(?string $rate): self
    {
        $this->rate = $rate;

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}
