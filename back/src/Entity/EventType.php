<?php

namespace App\Entity;

use App\Repository\EventTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventTypeRepository::class)]
class EventType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['event_get'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['event_get', 'article_with_event_get'])]
    private ?string $label = null;

    #[ORM\OneToMany(mappedBy: 'eventType', targetEntity: EventPlace::class)]
    private Collection $eventPlaces;

    public function __construct()
    {
        $this->eventPlaces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * @return Collection<int, EventPlace>
     */
    public function getEventPlaces(): Collection
    {
        return $this->eventPlaces;
    }

    public function addEventPlace(EventPlace $eventPlace): static
    {
        if (!$this->eventPlaces->contains($eventPlace)) {
            $this->eventPlaces->add($eventPlace);
            $eventPlace->setEventType($this);
        }

        return $this;
    }

    public function removeEventPlace(EventPlace $eventPlace): static
    {
        if ($this->eventPlaces->removeElement($eventPlace)) {
            // set the owning side to null (unless already changed)
            if ($eventPlace->getEventType() === $this) {
                $eventPlace->setEventType(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->getLabel();
    }
}
