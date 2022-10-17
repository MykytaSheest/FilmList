<?php

namespace Controllers;

use Core\Controller;
use Core\View;
use lib\Codes;
use lib\Messages;
use Models\Film;
use Models\Format;
use Services\ActorService;
use Services\FilmService;

class FilmController extends Controller
{
    protected ActorService $actorService;
    protected FilmService $filmService;

    public function __construct(array $route)
    {
        parent::__construct($route);
        $this->existenceUser('register');
        $this->checkAuth();
        $this->actorService = new ActorService();
        $this->filmService = new FilmService();
    }

    public function index()
    {
        $film = new Film();
        $films = $film->getFilms();
        $this->view->render('Films', ['films' => $films]);
    }

    public function create()
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->view->render('Add Film', ['formats' => new Format()]);
                break;
            case 'POST':
                $actorIds = $this->actorService->addActors(explode(',', $_POST['actors']));
                $filmId = $this->filmService->createFilm($_POST);
                $this->filmService->createFilmAcotr($filmId, $actorIds);
                header('Content-Type: application/json; charset=utf-8');
                echo json_encode($filmId);
                break;
            default:
                View::error(Codes::HTTP_METHOD_NOT_ALLOWED, Messages::METHOD_NOT_ALLOWED);
        }
    }
}
