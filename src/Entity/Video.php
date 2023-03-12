<?php

namespace App\Entity;

use App\Repository\VideoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VideoRepository::class)]
class Video
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $category_id = null;

    #[ORM\Column(length: 255)]
    public ?string $youtube_id = null;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'video')]
    private $category;

    #[ORM\OneToMany(mappedBy: 'video', targetEntity: DescriptionVideo::class)]
    private $description;

    #[ORM\ManyToOne(targetEntity: User::class,inversedBy: 'video')]
    public $own_video;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getCategoryId(): ?int
    {
        return $this->category_id;
    }

    public function setCategoryId(int $category_id): self
    {
        $this->category_id = $category_id;

        return $this;
    }

    public function getYoutubeId(): ?string
    {
        return $this->youtube_id;
    }

    public function setYoutubeId(string $youtube_id): self
    {
        $this->youtube_id = $youtube_id;

        return $this;
    }
}
