<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\TemperatureExceeded;

class TemperatureExceededFactory implements EventTypeFactoryInterface
{
    public function create(array $data): TemperatureExceeded
    {
        $event = new TemperatureExceeded();
        $event->setDeviceId($data['deviceId'] ?? null);
        $event->setEventDate($data['eventDate'] ?? null);
        $event->setTemp($data['temp'] ?? null);
        $event->setTreshold($data['treshold'] ?? null);

        return $event;
    }

    public static function getType(): string
    {
        return 'temperature_exceeded';
    }
}
