<?php

declare(strict_types=1);

namespace App\Controller\Api;

use App\Entity\DeviceMalfunction;
use App\Entity\DoorUnlocked;
use App\Entity\Event;
use App\Entity\TemperatureExceeded;
use App\Factory\EventFactory;
use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EventController extends AbstractController
{
    public function __construct(
        private readonly ValidatorInterface $validator,
        private readonly EventFactory $eventFactory,
        private readonly EventRepository $eventRepository,
    ) {
    }

    #[Route('/events', name: 'app_get_event', methods: ['GET'])]
    public function getEvents(
        EventRepository $eventRepository,
        SerializerInterface $serializer,
    ): JsonResponse {
        $events = $eventRepository->findAll();
        $data = $serializer->serialize($events, 'json', ['groups' => 'event:read']);

        return new JsonResponse($data, 200, [], true);
    }

//     JEDEN ENDPOINT DLA WSZYSTKICH ZDARZEN
//     W zaleznosci od typu zdarzenia okreslenego przez klucz 'type'
//     w ciele zapytania. Type jest wymagane i przyjmuje wartosci:
//     'door_unlocked', 'device_malfunction', 'temperature_exceeded'

    #[Route('/events', name: 'app_create_event', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['type'])) {
            return $this->json(['message' => 'Type is required'], Response::HTTP_BAD_REQUEST);
        }

        $event = $this->eventFactory->create($data['type'], $data);
        $errors = $this->validator->validate($event);
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $this->eventRepository->save($event);

        return $this->json([
            'message' => 'Event created successfully',
        ], Response::HTTP_CREATED);
    }

//    PONIZEJ OSOBNE ENDPOINTY DLA KAZDEGO RODZAJU ZDARZEN

    #[Route('/door_unlocked_events', name: 'app_create_door_unlocked_event', methods: ['POST'])]
    public function createDoorUnlockedEvent(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $event = new DoorUnlocked();
        $event->setDeviceId($data['deviceId'] ?? null);
        $event->setEventDate($data['eventDate'] ?? null);
        $event->setUnlockDate($data['unlockDate'] ?? null);

        return $this->createEvent($event);
    }

    #[Route('/device_malfunction_events', name: 'app_create_device_malfunction_event', methods: ['POST'])]
    public function createDeviceMalfunctionEvent(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $event = new DeviceMalfunction();
        $event->setDeviceId($data['deviceId'] ?? null);
        $event->setEventDate($data['eventDate'] ?? null);
        $event->setReasonCode($data['reasonCode'] ?? null);
        $event->setReasonText($data['reasonText'] ?? null);

        return $this->createEvent($event);
    }

    #[Route('/temperature_exceeded_events', name: 'app_create_temperature_exceeded_event', methods: ['POST'])]
    public function createTemperatureExceededEvent(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $event = new TemperatureExceeded();
        $event->setDeviceId($data['deviceId'] ?? null);
        $event->setEventDate($data['eventDate'] ?? null);
        $event->setTemp($data['temp'] ?? null);
        $event->setTreshold($data['treshold'] ?? null);

        return $this->createEvent($event);
    }

    private function createEvent(Event $event): JsonResponse
    {
        $errors = $this->validator->validate($event);
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $this->eventRepository->save($event);

        return $this->json([
            'message' => 'Event created successfully',
        ], Response::HTTP_CREATED);
    }
}
