<?php

namespace App\Entity;

use App\Repository\EventPlaceRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EventPlaceRepository::class)]
class EventPlace
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['event_get'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['event_get'])]
    private ?string $name = null;

    #[ORM\ManyToOne(inversedBy: 'eventPlaces')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['event_get'])]
    private ?EventType $eventType = null;

    #[ORM\OneToMany(mappedBy: 'eventPlace', targetEntity: Event::class)]
    private Collection $events;

    #[ORM\Column(type: 'decimal', precision: 15, scale: 13)]
    #[Groups(['event_get'])]
    private ?float $latitude = null;

    #[ORM\Column(type: 'decimal', precision: 15, scale: 13)]
    #[Groups(['event_get'])]
    private ?float $longitude = null;

    #[ORM\Column(length: 100)]
    #[Groups(['event_get'])]
    private ?string $city = null;

    public function __construct()
    {
        $this->events = new ArrayCollection();
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

    public function getEventType(): ?EventType
    {
        return $this->eventType;
    }

    public function setEventType(?EventType $eventType): static
    {
        $this->eventType = $eventType;

        return $this;
    }

    /**
     * @return Collection<int, Event>
     */
    public function getEvents(): Collection
    {
        return $this->events;
    }

    public function addEvent(Event $event): static
    {
        if (!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setEventPlace($this);
        }

        return $this;
    }

    public function removeEvent(Event $event): static
    {
        if ($this->events->removeElement($event)) {
            // set the owning side to null (unless already changed)
            if ($event->getEventPlace() === $this) {
                $event->setEventPlace(null);
            }
        }

        return $this;
    }

    public function getLatitude(): ?float
    {
        return $this->latitude;
    }

    public function setLatitude(float $latitude): static
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function __toString()
    {
        return $this->getName();
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }
}
