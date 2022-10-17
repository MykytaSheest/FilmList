<?php

namespace Services;

use Models\Film;

class FilmService
{
    protected Film $film;

    public function __construct()
    {
        $this->film = new Film();
    }

    public function createFilm($data): int
    {
        $this->film->title = $data['title'];
        $this->film->year = $data['year'];
        $this->film->formatId = $data['format'];
        return $this->film->create();
    }

    public function createFilmAcotr(int $filmId, array $actorsId): void
    {
        foreach ($actorsId as $id) {
            $this->film->createPivot($filmId, $id);
        }
    }
}
