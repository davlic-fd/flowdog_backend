<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ORM\Table(name: 'event_door_unlocked')]
class DoorUnlocked extends Event
{
    #[ORM\Column]
    #[Assert\NotNull]
    #[Groups('event:read')]
    private ?int $unlockDate = null;

    public function getUnlockDate(): ?int
    {
        return $this->unlockDate;
    }

    public function setUnlockDate(?int $unlockDate): static
    {
        $this->unlockDate = $unlockDate;

        return $this;
    }
}
