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

    public function createFilm(array $data): int
    {
        $this->film->title = trim($data['title']);
        $this->film->year = $data['year'];
        $this->film->formatId = $data['format'];
        return $this->film->create();
    }

    public function updateFilm(array $data): int
    {
        $this->film->id = $data['id'];
        $this->film->title = trim($data['title']);
        $this->film->year = $data['year'];
        $this->film->formatId = $data['format'];
        return $this->film->update();
    }

    public function createFilmAcotr(int $filmId, array $actorsId): void
    {
        foreach ($actorsId as $id) {
            $this->film->createPivot($filmId, $id);
        }
    }

    public function checkExistMoviesAndThrowExists(array $movies): array
    {
        $film = new Film();
        $existFilms = [];
        $addFilms = [];
        for ($i = 0; $i < count($movies); $i++) {
            if (!empty($film->getBy('title', trim($movies[$i]['title'])))) {
                $movies[$i]['id'] = $film->getBy('title', trim($movies[$i]['title']))[0]['id'];
                $existFilms[] = $movies[$i];
                continue;
            }
            $addFilms[] = $movies[$i];
        }

        return [
            'update' => $existFilms,
            'add' => $addFilms
        ];
    }
}
