<?php

namespace app;

use app\Exceptions\ViewNotFoundException;

class View
{
    protected string $view;
    protected array $params;

    public function __construct(string $view, array $params = [])
    {
        $this->view = $view;
        $this->params = $params;
    }

    public function render() : bool|string
    {
        $viewPath = VIEW_PATH . '/'. $this->view. '.php';

        if (! file_exists($viewPath)) {
            throw new ViewNotFoundException('View not found');
        }

      ob_start();

        include $viewPath;

        return (string) ob_get_clean();

}
}