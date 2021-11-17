<?php

namespace App\Entity;

use App\Repository\SuscriptionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SuscriptionRepository::class)
 */
class Suscription
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $membercard;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $solde;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $options = [];



    public function getId(): ?int
    {
        return $this->id;
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

    public function getMembercard(): ?string
    {
        return $this->membercard;
    }

    public function setMembercard(?string $membercard): self
    {
        $this->membercard = $membercard;

        return $this;
    }

    public function getSolde(): ?int
    {
        return $this->solde;
    }

    public function setSolde(?int $solde): self
    {
        $this->solde = $solde;

        return $this;
    }

    public function getOptions(): ?array
    {
        return $this->options;
    }

    public function setOptions(?array $options): self
    {
        $this->options = $options;

        return $this;
    }



}
