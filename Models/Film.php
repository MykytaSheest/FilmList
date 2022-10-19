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

    protected function getActorTableName(): string
    {
        return 'actors';
    }

    public function create(): \PDOStatement|string|bool
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

    public function createPivot(int $filmId, int $actorId): \PDOStatement|string|bool
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

    public function getFilms(): array
    {
        $films = $this->orderByTitle();
        return $this->getFilmData($films);
    }

    public function getSearchFilm(string $findString, string $field): array
    {
        switch ($field) {
            case 'title':
                $films = $this->searchByTitle($findString);
                break;
            case 'actor':
                $films = $this->searchByActor($findString);
                break;
            default:
                return [];
        }
        return $this->getFilmData($films);
    }

    public function orderByTitle(): array|bool
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' ORDER BY title COLLATE  utf8_unicode_ci';
        return $this->db->row(
            $sql
        );
    }

    public function searchByTitle(string $findString): array|bool
    {
        $sql = 'SELECT * FROM ' . $this->getTableName() . ' WHERE title LIKE :find ';
        return $this->db->row(
            $sql,
            [
                'find' => $findString
            ]
        );
    }

    public function searchByActor(string $findActor): array|bool
    {
        $sql = 'SELECT DISTINCT *
                FROM film_actor
                JOIN actors ON film_actor.actor_id = actors.id
                JOIN films ON film_actor.film_id = films.id
                WHERE name LIKE :find
                ';
        return $this->db->row(
            $sql,
            [
                'find' => $findActor
            ]
        );
    }

    protected function getFilmData(array $films): array
    {
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
