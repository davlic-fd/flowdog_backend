<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Event;

interface EventTypeFactoryInterface
{
    public function create(array $data): Event;
    public static function getType(): string;
}
