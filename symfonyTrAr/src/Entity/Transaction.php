<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TransactionRepository")
 */
class Transaction
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $montantTr;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateTr;

    /**
     * @ORM\Column(type="integer")
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomEx;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telEx;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $cniEx;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeDePieceEx;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adresseEx;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nomB;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $adrB;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cniB;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telB;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $typeDePieceB;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="transaction")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateEnvoie;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateRetrait;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Compte", inversedBy="compte")
     */
    private $compte;

    /**
     * @ORM\Column(type="integer")
     */
    private $fraits;

    /**
     * @ORM\Column(type="float")
     */
    private $comEtat;

    /**
     * @ORM\Column(type="float")
     */
    private $comSys;

    /**
     * @ORM\Column(type="float")
     */
    private $comEnv;

    /**
     * @ORM\Column(type="float")
     */
    private $comRetr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMontantTr(): ?float
    {
        return $this->montantTr;
    }

    public function setMontantTr(float $montantTr): self
    {
        $this->montantTr = $montantTr;

        return $this;
    }

    public function getDateTr(): ?\DateTimeInterface
    {
        return $this->dateTr;
    }

    public function setDateTr(\DateTimeInterface $dateTr): self
    {
        $this->dateTr = $dateTr;

        return $this;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getNomEx(): ?string
    {
        return $this->nomEx;
    }

    public function setNomEx(?string $nomEx): self
    {
        $this->nomEx = $nomEx;

        return $this;
    }

    public function getTelEx(): ?string
    {
        return $this->telEx;
    }

    public function setTelEx(?string $telEx): self
    {
        $this->telEx = $telEx;

        return $this;
    }

    public function getCniEx(): ?int
    {
        return $this->cniEx;
    }

    public function setCniEx(?int $cniEx): self
    {
        $this->cniEx = $cniEx;

        return $this;
    }

    public function getTypeDePieceEx(): ?string
    {
        return $this->typeDePieceEx;
    }

    public function setTypeDePieceEx(?string $typeDePieceEx): self
    {
        $this->typeDePieceEx = $typeDePieceEx;

        return $this;
    }

    public function getAdresseEx(): ?string
    {
        return $this->adresseEx;
    }

    public function setAdresseEx(?string $adresseEx): self
    {
        $this->adresseEx = $adresseEx;

        return $this;
    }

    public function getNomB(): ?string
    {
        return $this->nomB;
    }

    public function setNomB(?string $nomB): self
    {
        $this->nomB = $nomB;

        return $this;
    }

    public function getAdrB(): ?string
    {
        return $this->adrB;
    }

    public function setAdrB(?string $adrB): self
    {
        $this->adrB = $adrB;

        return $this;
    }

    public function getCniB(): ?string
    {
        return $this->cniB;
    }

    public function setCniB(?string $cniB): self
    {
        $this->cniB = $cniB;

        return $this;
    }

    public function getTelB(): ?string
    {
        return $this->telB;
    }

    public function setTelB(?string $telB): self
    {
        $this->telB = $telB;

        return $this;
    }

    public function getTypeDePieceB(): ?string
    {
        return $this->typeDePieceB;
    }

    public function setTypeDePieceB(?string $typeDePieceB): self
    {
        $this->typeDePieceB = $typeDePieceB;

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

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getDateEnvoie(): ?\DateTimeInterface
    {
        return $this->dateEnvoie;
    }

    public function setDateEnvoie(\DateTimeInterface $dateEnvoie): self
    {
        $this->dateEnvoie = $dateEnvoie;

        return $this;
    }

    public function getDateRetrait(): ?\DateTimeInterface
    {
        return $this->dateRetrait;
    }

    public function setDateRetrait(\DateTimeInterface $dateRetrait): self
    {
        $this->dateRetrait = $dateRetrait;

        return $this;
    }

    public function getCompte(): ?Compte
    {
        return $this->compte;
    }

    public function setCompte(?Compte $compte): self
    {
        $this->compte = $compte;

        return $this;
    }

    public function getFraits(): ?int
    {
        return $this->fraits;
    }

    public function setFraits(int $fraits): self
    {
        $this->fraits = $fraits;

        return $this;
    }

    public function getComEtat(): ?float
    {
        return $this->comEtat;
    }

    public function setComEtat(float $comEtat): self
    {
        $this->comEtat = $comEtat;

        return $this;
    }

    public function getComSys(): ?float
    {
        return $this->comSys;
    }

    public function setComSys(float $comSys): self
    {
        $this->comSys = $comSys;

        return $this;
    }

    public function getComEnv(): ?float
    {
        return $this->comEnv;
    }

    public function setComEnv(float $comEnv): self
    {
        $this->comEnv = $comEnv;

        return $this;
    }

    public function getComRetr(): ?float
    {
        return $this->comRetr;
    }

    public function setComRetr(float $comRetr): self
    {
        $this->comRetr = $comRetr;

        return $this;
    }
}
