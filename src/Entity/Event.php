<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ORM\InheritanceType(value: "JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap(value: [
    'deviceMalfunction' => DeviceMalfunction::class,
    'temperatureExceeded' => TemperatureExceeded::class,
    'doorUnlocked' => DoorUnlocked::class,
])]
abstract class Event
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    #[Assert\Length(max: 255)]
    #[Groups('event:read')]
    private ?string $deviceId = null;

    #[ORM\Column]
    #[Assert\NotNull]
    #[Groups('event:read')]
    private ?int $eventDate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDeviceId(): ?string
    {
        return $this->deviceId;
    }

    public function setDeviceId(?string $deviceId): static
    {
        $this->deviceId = $deviceId;

        return $this;
    }

    public function getEventDate(): ?int
    {
        return $this->eventDate;
    }

    public function setEventDate(?int $eventDate): static
    {
        $this->eventDate = $eventDate;

        return $this;
    }
}
