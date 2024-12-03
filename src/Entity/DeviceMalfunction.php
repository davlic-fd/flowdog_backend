<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ORM\Table(name: 'event_device_malfunction')]
class DeviceMalfunction extends Event
{
    #[ORM\Column]
    #[Assert\NotNull]
    #[Groups('event:read')]
    private ?int $reasonCode = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotNull]
    #[Assert\Length(max: 255)]
    #[Groups('event:read')]
    private ?string $reasonText = null;

    public function getReasonCode(): ?int
    {
        return $this->reasonCode;
    }

    public function setReasonCode(?int $reasonCode): static
    {
        $this->reasonCode = $reasonCode;

        return $this;
    }

    public function getReasonText(): ?string
    {
        return $this->reasonText;
    }

    public function setReasonText(?string $reasonText): static
    {
        $this->reasonText = $reasonText;

        return $this;
    }
}
