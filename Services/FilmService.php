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

    public function uniqueMultidimArray($array, $key) {
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
