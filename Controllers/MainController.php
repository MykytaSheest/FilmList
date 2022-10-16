<?php

namespace Controllers;

use Core\Controller;
use Models\Main;

class MainController extends Controller
{
    public function __construct(array $route)
    {
        parent::__construct($route);
    }

    public function index()
    {
        $vars = ['name' => 'Vasya', 'age' => 77];
        $this->view->render('Main Page', $vars );
    }
}
