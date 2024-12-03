<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\EventRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: EventRepository::class)]
#[ORM\Table(name: 'event_temperature_exceeded')]
class TemperatureExceeded extends Event
{
    #[ORM\Column]
    #[Assert\NotNull]
    #[Groups('event:read')]
    private ?float $temp = null;

    #[ORM\Column]
    #[Assert\NotNull]
    #[Groups('event:read')]
    private ?float $treshold = null;

    public function getTemp(): ?float
    {
        return $this->temp;
    }

    public function setTemp(?float $temp): static
    {
        $this->temp = $temp;

        return $this;
    }

    public function getTreshold(): ?float
    {
        return $this->treshold;
    }

    public function setTreshold(?float $treshold): static
    {
        $this->treshold = $treshold;

        return $this;
    }
}
