<?php

namespace App\Entity;

use App\Entity\Partenaire;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\Serializer\Annotation\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @Vich\Uploadable
 */
class User implements UserInterface

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
    /**
     * NOTE: This is not a mapped field of entity metadata, just a simple property.
     * 
     * @Vich\UploadableField(mapping="users", fileNameProperty="imageName")
     * 
     * @var File
     */
    private $imageFile;
    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private $imageName;
    /**
     * @ORM\Column(type="string", length=255)
     */
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message="Le champ ne doit pas être vide")
     */
    private $username;

    /**
     * @ORM\Column(type="json")
     * @Assert\NotBlank(message="Le champ ne doit pas être vide")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\NotBlank(message="Le champ ne doit pas être vide")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champ ne doit pas être vide")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champ ne doit pas être vide")
     */
    private $prenom;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Partenaire", inversedBy="users")
     * @Assert\NotBlank(message="Le champ ne doit pas être vide")
     */
    private $partenaire;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Le champ ne doit pas être vide")
     */
    private $teluser;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\NotBlank(message="Le champ ne doit pas être vide")
     */
    private $status;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Transaction", mappedBy="user")
     */
    private $transaction;

    public function __construct()
    {
        $this->partenaire = new ArrayCollection();
        $this->status=true;
        $this->transaction = new ArrayCollection();
    }

    
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection|Partenaire[]
     */
    public function getPartenaire(): Collection
    {
        return $this->partenaire;
    }

    public function addPartenaire(Partenaire $partenaire): self
    {
        if (!$this->partenaire->contains($partenaire)) {
            $this->partenaire[] = $partenaire;
        }

        return $this;
    }

    public function removePartenaire(Partenaire $partenaire): self
    {
        if ($this->partenaire->contains($partenaire)) {
            $this->partenaire->removeElement($partenaire);
        }

        return $this;
    }

    public function getTeluser(): ?string
    {
        return $this->teluser;
    }

    public function setTeluser(string $teluser): self
    {
        $this->teluser = $teluser;

        return $this;
    }

    public function getStatus(): ?bool
    {
        return $this->status;
    }

    public function setStatus(bool $status): self
    {
        $this->status = $status;

        return $this;
    }  
    /**
     * Get nOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @return  File
     */ 
    public function getImageFile()
    {
        return $this->imageFile;
    }

    /**
     * Set nOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @param  File  $imageFile  NOTE: This is not a mapped field of entity metadata, just a simple property.
     *
     * @return  self
     */ 
    public function setImageFile(File $imageFile)
    {
        $this->imageFile = $imageFile;
        // if($this->$imageFile instanceof UploadedFile){

        // }
    }

    /**
     * Get the value of imageName
     *
     * @return  string
     */ 
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set the value of imageName
     *
     * @param  string  $imageName
     *
     * @return  self
     */ 
    public function setImageName(string $imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransaction(): Collection
    {
        return $this->transaction;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transaction->contains($transaction)) {
            $this->transaction[] = $transaction;
            $transaction->setUser($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transaction->contains($transaction)) {
            $this->transaction->removeElement($transaction);
            // set the owning side to null (unless already changed)
            if ($transaction->getUser() === $this) {
                $transaction->setUser(null);
            }
        }

        return $this;
    }
}
