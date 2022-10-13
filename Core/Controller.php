<?php

namespace Core;

abstract class Controller
{
    protected array $route;

    public function __construct(array $route)
    {
        $this->route = $route;
    }
}
