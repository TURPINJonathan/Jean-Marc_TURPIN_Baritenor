<?php

namespace App\Controller;

use Doctrine\ORM\NoResultException;
use App\Entity\Event;
use App\Repository\EventRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EventController extends AbstractController
{
    #[Route('/api/event/list', name: 'event_list', methods: ['GET'])]
    public function eventList(ManagerRegistry $doctrine): Response
    {
        $events = $doctrine->getManager()->getRepository(Event::class)->findAll();

        if (!$events) {
            throw new NoResultException("No results found");
        }

        return $this->json($events, Response::HTTP_OK, [], ['groups' => 'event_get']);
    }

    #[Route('/api/event/{id}', name: 'event_id', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function eventById(ManagerRegistry $doctrine, $id): Response
    {
        $event = $doctrine->getManager()->getRepository(Event::class)->find(['id' => $id]);

        if (!$event) {
            throw new NoResultException("No results found");
        }

        return $this->json($event, Response::HTTP_OK, [], ['groups' => 'event_get']);
    }

    #[Route('/api/event/type_{type}', name: 'event_by_type', methods: ['GET'], requirements: ['type' => '.+'])]
    public function eventByType(EventRepository $eventRepository, $type): Response
    {
        $events = $eventRepository->findEventsByType($type);

        if (!$events) {
            throw new NoResultException("No results found");
        }

        return $this->json($events, Response::HTTP_OK, [], ['groups' => 'event_get']);
    }

    #[Route('/api/event/place_{place}', name: 'event_by_place', methods: ['GET'], requirements: ['place' => '.+'])]
    public function eventByPlace(EventRepository $eventRepository, $place): Response
    {
        $events = $eventRepository->findEventsByPlace($place);

        if (!$events) {
            throw new NoResultException("No results found");
        }

        return $this->json($events, Response::HTTP_OK, [], ['groups' => 'event_get']);
    }

    #[Route('/api/event/month_{month}{year}', name: 'event_by_month', methods: ['GET'], requirements: ['month' => '0[1-9]|1[0-2]', 'year' => '\d{4}'])]
    public function eventByMonth(EventRepository $eventRepository, $month, $year): Response
    {
        $events = $eventRepository->findEventsByMonth($month, $year);

        if (!$events) {
            throw new NoResultException("No results found");
        }

        return $this->json($events, Response::HTTP_OK, [], ['groups' => 'event_get']);
    }

    #[Route('/api/event/name_{name}', name: 'event_by_name', methods: ['GET'], requirements: ['name' => '[^\s]+'])]
    public function eventByName(EventRepository $eventRepository, $name): Response
    {
        $events = $eventRepository->findEventsByName($name);

        if (!$events) {
            throw new NoResultException("No results found");
        }

        return $this->json($events, Response::HTTP_OK, [], ['groups' => 'event_get']);
    }
}
