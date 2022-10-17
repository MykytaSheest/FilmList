<?php

namespace Models;

use Core\Model;

class Actor extends Model
{
    protected function getTableName(): string
    {
        return 'actors';
    }

    public function create()
    {
        $sql = 'INSERT INTO ' . $this->getTableName() . ' (name) VALUES (:name)';
        $actor = $this->db->query(
            $sql,
            [
                'name' => $this->name,
            ],
            true,
        );
        return $actor;
    }

    public function getJoinFilm(int $idFilm)
    {
        $sql = 'SELECT * FROM actors 
                    INNER JOIN film_actor ON film_actor.actor_id = actors.id
                    WHERE film_actor.film_id = :id
                    ';
        $actors = $this->db->row(
            $sql,
            [
                'id' => $idFilm
            ],
        );
        $names = [];
        foreach ($actors as $actor) {
            $names[] = $actor['name'];
        }

        return $names;
    }

}
