<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\DeviceMalfunction;

class DeviceMalfunctionFactory implements EventTypeFactoryInterface
{
    public function create(array $data): DeviceMalfunction
    {
        $event = new DeviceMalfunction();
        $event->setDeviceId($data['deviceId'] ?? null);
        $event->setEventDate($data['eventDate'] ?? null);
        $event->setReasonCode($data['reasonCode'] ?? null);
        $event->setReasonText($data['reasonText'] ?? null);

        return $event;
    }

    public static function getType(): string
    {
        return 'device_malfunction';
    }
}
