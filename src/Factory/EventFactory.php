<?php

declare(strict_types=1);

namespace App\Factory;

use App\Entity\Event;
use Symfony\Component\DependencyInjection\ServiceLocator;

class EventFactory
{
    /** @var array<string, string> */
    public array $typeToServiceMap;

    public function __construct(
        private readonly ServiceLocator $locator,
    ) {
        foreach ($locator as $serviceId => $factory) {
            $this->typeToServiceMap[$factory::getType()] = $serviceId;
        }
    }

    public function create(string $type, array $data): Event
    {
        if (!$this->locator->has($this->typeToServiceMap[$type])) {
            throw new \InvalidArgumentException(sprintf('Unknown event type "%s"', $type));
        }

        /** @var EventTypeFactoryInterface $factory */
        $factory = $this->locator->get($this->typeToServiceMap[$type]);

        return $factory->create($data);
    }
}
