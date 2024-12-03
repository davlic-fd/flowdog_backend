<?php

declare(strict_types=1);

namespace App\EventListener;

use App\Entity\DeviceMalfunction;
use App\Entity\DoorUnlocked;
use App\Entity\TemperatureExceeded;
use App\Event\CreateEvent;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(event: CreateEvent::class)]
class CreateEventListener
{
    public function __construct(
        // TODO: Inject logger
        // TODO: Inject SMS service
        // TODO: Inject email service
        // TODO: Inject REST API service
    ) {
    }

    public function __invoke(CreateEvent $event): void
    {
        $this->log();

        switch (get_class($event->event)) {
            case DeviceMalfunction::class:
                $this->sendEmail();
                break;

            case DoorUnlocked::class:
                $this->sendSms();
                break;

            case TemperatureExceeded::class:
                $this->sendRestApi();
                break;
        }
    }

    private function log(): void
    {
        // TODO: $this->logger->log();
        echo '------------------------------------------' . __METHOD__ . PHP_EOL;
    }

    private function sendSms(): void
    {
        // TODO: $this->smsService->send();
        echo '------------------------------------------' . __METHOD__ . PHP_EOL;
    }

    private function sendEmail(): void
    {
        // TODO: $this->emailService->send();
        echo '------------------------------------------' . __METHOD__ . PHP_EOL;
    }

    private function sendRestApi(): void
    {
        // TODO: $this->restApiService->send();
        echo '------------------------------------------' . __METHOD__ . PHP_EOL;
    }
}
