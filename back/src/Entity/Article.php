<?php

namespace App\Entity;

use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['article_get'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['article_get'])]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['article_get'])]
    private ?string $content = null;

    #[ORM\ManyToMany(targetEntity: ArticleCategory::class, inversedBy: 'articles')]
    #[Groups(['article_get'])]
    private Collection $category;

    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['article_get'])]
    private ?ArticleLayout $layout = null;

    #[ORM\Column]
    #[Groups(['article_get'])]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToMany(targetEntity: Event::class, inversedBy: 'articles')]
    #[Groups(['article_get'])]
    private Collection $event;

    public function __construct()
    {
        $this->createdAt = new DateTimeImmutable();
        $this->category = new ArrayCollection();
        $this->event = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return Collection<int, ArticleCategory>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(ArticleCategory $category): static
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(ArticleCategory $category): static
    {
        $this->category->removeElement($category);

        return $this;
    }

    public function getLayout(): ?ArticleLayout
    {
        return $this->layout;
    }

    public function setLayout(?ArticleLayout $layout): static
    {
        $this->layout = $layout;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvent(): Collection
    {
        return $this->event;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->event->contains($event)) {
            $this->event->add($event);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        $this->event->removeElement($event);

        return $this;
    }
}
