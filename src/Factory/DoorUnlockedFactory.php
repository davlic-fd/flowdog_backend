<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\DoorUnlocked;

class DoorUnlockedFactory implements EventTypeFactoryInterface
{
    public function create(array $data): DoorUnlocked
    {
        $event = new DoorUnlocked();
        $event->setDeviceId($data['deviceId'] ?? null);
        $event->setEventDate($data['eventDate'] ?? null);
        $event->setUnlockDate($data['unlockDate'] ?? null);

        return $event;
    }

    public static function getType(): string
    {
        return 'door_unlocked';
    }
}
