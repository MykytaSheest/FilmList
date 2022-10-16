<?php

namespace Controllers;

use Core\Controller;

class MainController extends Controller
{
    public function __construct(array $route)
    {
        parent::__construct($route);
        $this->existenceUser();
    }

    public function index()
    {
        $this->view->render('Films');
    }
}
