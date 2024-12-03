<?php

declare(strict_types=1);

namespace App\Event;

use App\Entity\Event;

class CreateEvent
{
    public function __construct(
        public Event $event
    ) {
    }
}
