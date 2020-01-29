<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WilderRepository")
 */
class Wilder
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
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Event", inversedBy="wilders")
     */
    private $evnets;

    public function __construct()
    {
        $this->evnets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * @return Collection|Event[]
     */
    public function getEvnets(): Collection
    {
        return $this->evnets;
    }

    public function addEvnet(Event $evnet): self
    {
        if (!$this->evnets->contains($evnet)) {
            $this->evnets[] = $evnet;
        }

        return $this;
    }

    public function removeEvnet(Event $evnet): self
    {
        if ($this->evnets->contains($evnet)) {
            $this->evnets->removeElement($evnet);
        }

        return $this;
    }
}
