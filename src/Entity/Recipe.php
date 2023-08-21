<?php

namespace App\Entity;

use App\Repository\RecipeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 */
class Recipe
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
    private $codeAPI;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeAPI(): ?int
    {
        return $this->codeAPI;
    }

    public function setCodeAPI(int $codeAPI): self
    {
        $this->codeAPI = $codeAPI;

        return $this;
    }
}
