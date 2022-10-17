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

    public function getFilms():array
    {
        $films = $this->findAll();
        $format = new Format();
        $actors = new Actor();
        for ($i = 0; $i < count($films); $i++) {
            $format->id = $films[$i]['format_id'];
            $films[$i]['format_title'] = $format->getFormatById();
            $films[$i]['actors'] = $actors->getJoinFilm($films[$i]['id']);
        }
        return $films;
    }
}
