<?php

namespace Controllers;

use Core\Controller;

class MainController extends Controller
{
    public function index()
    {
        $vars = ['name' => 'Vasya', 'age' => 77];
        $this->view->render('Main Page', $vars );
    }
}
