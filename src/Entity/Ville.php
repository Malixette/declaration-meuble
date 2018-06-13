<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VilleRepository")
 */
class Ville
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $un;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $deux;

    public function getId()
    {
        return $this->id;
    }

    public function getUn(): ?string
    {
        return $this->un;
    }

    public function setUn(string $un): self
    {
        $this->un = $un;

        return $this;
    }

    public function getDeux(): ?string
    {
        return $this->deux;
    }

    public function setDeux(string $deux): self
    {
        $this->deux = $deux;

        return $this;
    }
}
