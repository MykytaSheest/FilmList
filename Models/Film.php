<?php

namespace Models;

use Core\Model;

class Film extends Model
{

    protected function getTableName(): string
    {
        return "films";
    }

    protected function getPivotTable(): string
    {
        return "film_actor";
    }

    public function create()
    {
        $sql = 'INSERT INTO ' . $this->getTableName() . ' (title, year, format_id) VALUES (:title, :year, :format_id)';
        $actor = $this->db->query(
            $sql,
            [
                'title' => $this->title,
                'year' => $this->year,
                'format_id' => $this->formatId,
            ],
            true,
        );
        return $actor;

    }

    public function createPivot(int $filmId, int $actorId)
    {
        $sql = 'INSERT INTO ' . $this->getPivotTable() . ' (film_id, actor_id) VALUES (:film_id, :actor_id)';
        $pivot = $this->db->query(
            $sql,
            [
                'film_id' => $filmId,
                'actor_id' => $actorId,
            ],
        );
        return $pivot;
    }
}
