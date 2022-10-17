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

    public function deleteActorsById(array $ids): void
    {
        foreach ($ids as $id) {
            $this->actor->id = $id;
            $this->actor->delete();
        }
    }

    public function uniqueMultidimArray(array $array, string $key): array
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }
}
