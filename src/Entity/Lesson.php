<?php

namespace App\Entity;

use App\Repository\LessonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LessonRepository::class)
 */
class Lesson
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
    private $nbmax;

    /**
     * @ORM\Column(type="boolean")
     */
    private $full;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enable;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="lessons")
     */
    private $iduser;

    public function __construct()
    {
        $this->iduser = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbmax(): ?int
    {
        return $this->nbmax;
    }

    public function setNbmax(int $nbmax): self
    {
        $this->nbmax = $nbmax;

        return $this;
    }

    public function getFull(): ?bool
    {
        return $this->full;
    }

    public function setFull(bool $full): self
    {
        $this->full = $full;

        return $this;
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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEnable(): ?bool
    {
        return $this->enable;
    }

    public function setEnable(bool $enable): self
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getIduser(): Collection
    {
        return $this->iduser;
    }

    public function addIduser(User $iduser): self
    {
        if (!$this->iduser->contains($iduser)) {
            $this->iduser[] = $iduser;
        }

        return $this;
    }

    public function removeIduser(User $iduser): self
    {
        $this->iduser->removeElement($iduser);

        return $this;
    }
}
