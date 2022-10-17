<?php

namespace Services;

use Models\Actor;

class ActorService
{
    protected Actor $actor;

    public function __construct()
    {
        $this->actor = new Actor();
    }

    public function addActors(array $actors): array
    {
        $ids = [];
        foreach ($actors as $actor) {
            $this->actor->name = $actor;
            $ids[] = $this->actor->create();
        }
        return $ids;
    }
}
