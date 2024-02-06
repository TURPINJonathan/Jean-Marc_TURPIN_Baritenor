<?php

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventRepository::class)]
class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['event_get', 'article_with_event_get'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['event_get', 'article_with_event_get'])]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['event_get', 'article_with_event_get'])]
    private ?string $details = null;

    #[ORM\ManyToOne(inversedBy: 'events')]
    #[Groups(['event_get', 'article_with_event_get'])]
    private ?EventPlace $eventPlace = null;

    #[ORM\Column]
    #[Groups(['event_get', 'article_with_event_get'])]
    private ?\DateTimeImmutable $startAt = null;

    #[ORM\Column]
    #[Groups(['event_get', 'article_with_event_get'])]
    private ?\DateTimeImmutable $endAt = null;

    #[ORM\ManyToMany(targetEntity: Article::class, mappedBy: 'event')]
    private Collection $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): static
    {
        $this->details = $details;

        return $this;
    }

    public function getEventPlace(): ?EventPlace
    {
        return $this->eventPlace;
    }

    public function setEventPlace(?EventPlace $eventPlace): static
    {
        $this->eventPlace = $eventPlace;

        return $this;
    }

    public function getStartAt(): ?\DateTimeImmutable
    {
        return $this->startAt;
    }

    public function setStartAt(\DateTimeImmutable $startAt): static
    {
        $this->startAt = $startAt;

        return $this;
    }

    public function getEndAt(): ?\DateTimeImmutable
    {
        return $this->endAt;
    }

    public function setEndAt(\DateTimeImmutable $endAt): static
    {
        $this->endAt = $endAt;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): static
    {
        if (!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->addEvent($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): static
    {
        if ($this->articles->removeElement($article)) {
            $article->removeEvent($this);
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }
}