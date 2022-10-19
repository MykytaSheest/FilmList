<?php

namespace Controllers;

use Core\Controller;
use Core\View;
use lib\Codes;
use lib\Messages;
use Models\Actor;
use Models\Film;
use Models\Format;
use Services\ActorService;
use Services\FileService;
use Services\FilmService;

class FilmController extends Controller
{
    protected ActorService $actorService;
    protected FilmService $filmService;
    protected FileService $fileService;

    public function __construct(array $route)
    {
        parent::__construct($route);
        $this->existenceUser('register');
        $this->checkAuth();
        $this->actorService = new ActorService();
        $this->filmService = new FilmService();
        $this->fileService = new FileService();
    }

    public function index(): void
    {
        $film = new Film();
        $films = $film->getFilms();
        $this->view->render('Films', ['films' => $films]);
    }

    public function create(): void
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

    public function delete(): void
    {
        $film = new Film();
        $film->id = $_POST['id'];
        $data = $film->getById($_POST['id']);
        $actor = new Actor();

        $actorIds = $actor->getJoinFilm($_POST['id'], true);
        $this->actorService->deleteActorsById($actorIds);

        $film->delete();

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($data);
    }

    public function search(): void
    {
        if (!empty($_POST['title'])) {
            $film = new Film();
            $films = $film->getSearchFilm('%' . $_POST['title'] . '%', 'title');
            $this->view->setPath('film/index');
            $this->view->render('Search Fimls', ['films' => $films]);
        } else if (!empty($_POST['actor'])) {
            $film = new Film();

            $films = $this->actorService->uniqueMultidimArray(
                $film->getSearchFilm('%' . $_POST['actor'] . '%', 'actor'),
                'id'
            );
            $this->view->setPath('film/index');
            $this->view->render('Search Fimls', ['films' => $films]);
        } else {
            View::error(Codes::HTTP_NOT_FOUND, Messages::VIEW_NOT_FOUND);
        }
    }

    public function upload(): void
    {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->view->setPath('film/upload');
                $this->view->render('Upload file with films');
                break;
            case 'POST':
                $films = $this->fileService->parseFile(fopen($_FILES['file']['tmp_name'], 'r'));
                foreach ($films as $film) {
                    $actorIds = $this->actorService->addActors($film['actors']);
                    $filmId = $this->filmService->createFilm($film);
                    $this->filmService->createFilmAcotr($filmId, $actorIds);
                }
                $this->view->redirect('/');
                break;
            default:
                View::error(Codes::HTTP_NOT_FOUND, Messages::VIEW_NOT_FOUND);
        }
    }
}
