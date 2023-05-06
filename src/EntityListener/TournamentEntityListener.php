<?php

namespace App\EntityListener;

use App\Entity\Tournament;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsEntityListener(event: Events::prePersist, entity: Tournament::class)]
#[AsEntityListener(event: Events::preUpdate, entity: Tournament::class)]
class TournamentEntityListener
{
    public function __construct(
        private SluggerInterface $slugger,
    )
    {
    }

    public function prePersist(Tournament $tournament, LifecycleEventArgs $event)
    {
        $tournament->computeSlug($this->slugger);
    }

    public function preUpdate(Tournament $tournament, LifecycleEventArgs $event)
    {
        $tournament->computeSlug($this->slugger);
    }
}