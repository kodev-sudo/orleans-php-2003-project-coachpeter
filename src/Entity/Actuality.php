<?php

namespace App\Entity;

use App\Repository\ActualityRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use \DateTime;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ActualityRepository", repositoryClass=ActualityRepository::class)
 * @Vich\Uploadable()
 */
class Actuality
{
    const MAX_SIZE="500k";

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Veuillez indiquer le titre de l'article")
     * @Assert\Length(max=255, maxMessage="Le nom du titre {{ value }} est trop long,
     * il ne devrait pas dépasser {{ limit }} caractères")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank(message="Veuillez remplir le contenu de l'article")
     */
    private $content;

    /**
     * @ORM\Column(type="date")
     * @Assert\NotBlank(message = "Veuillez indiquer la date de parution de l'article sous le format JJ/MM/AAAA")
     * @Assert\Date(message = "Veuillez indiquer une date valide")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=50)
     * @Assert\NotBlank(message="Veuillez indiquer un thème à l'article")
     * @Assert\Length(max=50, maxMessage="Le nom du thème {{ value }} est trop long,
     * il ne devrait pas dépasser {{ limit }} caractères")
     */
    private $topic;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     * @Assert\Length(max=255, maxMessage="Le nom est trop long, il ne devrait pas dépasser {{ limit}} caractères")
     */
    private $picture;

    /**
     * @Vich\UploadableField(mapping="actuality_file",fileNameProperty="picture")
     * @var File|null
     * @Assert\File(maxSize = Actuality::MAX_SIZE,
     *     maxSizeMessage="Le fichier est trop gros  ({{ size }} {{ suffix }}),
     * il ne doit pas dépasser {{ limit }} {{ suffix }}",
     *     mimeTypes = {"image/jpeg", "image/jpg", "image/gif","image/png"},
     *     mimeTypesMessage = "Veuillez entrer un type de fichier valide: jpg, jpeg, png ou gif.")
     */
    private $actualityFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var DateTime|null
     */
    private $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

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

    public function getTopic(): ?string
    {
        return $this->topic;
    }

    public function setTopic(string $topic): self
    {
        $this->topic = $topic;

        return $this;
    }

    public function setActualityFile(File $image = null)
    {
        $this->actualityFile = $image;
        if ($image) {
            $this->updatedAt = new DateTime('now');
        }
    }

    public function getActualityFile(): ?File
    {
        return $this->actualityFile;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture($picture): self
    {
        $this->picture = $picture;

        return $this;
    }
}
