<?php

namespace Core;

use lib\Codes;
use lib\Messages;

class View
{
    private string $path;
    private string $layout = 'default';
    private static string $errorLayout = 'error';
    private array $route;

    const PATH_TO_VIEWS = 'Views/';
    const PATH_TO_LAYOUTS = 'Views/layout/';

    public function __construct(array $route)
    {
        $this->route = $route;
        $this->path = $route['controller'] . '/' . $route['action'];
    }

    public function render(string $title, array $vars = []): void
    {
        extract($vars);
        if (file_exists(self::PATH_TO_VIEWS . $this->path . '.php')) {
            ob_start();
            require self::PATH_TO_VIEWS . $this->path . '.php';
            $content = ob_get_clean();
            if (file_exists(self::PATH_TO_LAYOUTS . $this->layout . '.php')) {
                require self::PATH_TO_LAYOUTS . $this->layout . '.php';
            } else {
                View::error(Codes::HTTP_NOT_FOUND, Messages::LAYOUT_NOT_FOUND);
            }
        } else {
            View::error(Codes::HTTP_NOT_FOUND, Messages::VIEW_NOT_FOUND);
        }
    }

    public static function error(int $code, string$message): void
    {
        http_response_code($code);
        require self::PATH_TO_LAYOUTS . self::$errorLayout . '.php';
    }

    public function redirect(string $url)
    {
        header('Location: ' . $url );
        exit;
    }

    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }

    public function getLayout(): string
    {
        return $this->layout;
    }

}
