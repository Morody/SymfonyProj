<?php

namespace App\Entity;

use App\Repository\DescriptionVideoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DescriptionVideoRepository::class)]
class DescriptionVideo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;


    #[ORM\ManyToOne(targetEntity: Video::class, inversedBy: 'description')]
    private $video;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'description')]
    private $owner_description;

    public function __construct($description, $video, $owner_description)
    {
        $this->description = $description;
        $this->video = $video;
        $this->owner_description = $owner_description;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }


    public function getOwnerDescription()
    {
        return $this->owner_description;
    }

    public function getVideo()
    {
        return $this->video;
    }

}
