<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Event;
use App\Event\CreateEvent;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @extends ServiceEntityRepository<Event>
 */
class EventRepository extends ServiceEntityRepository
{
    public EventDispatcherInterface $dispatcher;
    private EntityManagerInterface $em;

    public function __construct(
        ManagerRegistry $registry,
        EntityManagerInterface $em,
        EventDispatcherInterface $dispatcher,
    ) {
        parent::__construct($registry, Event::class);

        $this->em = $em;
        $this->dispatcher = $dispatcher;
    }

    public function save(Event $event): void
    {
        $this->em->persist($event);
        $this->em->flush();

        $this->dispatcher->dispatch(
            new CreateEvent($event)
        );
    }
}
