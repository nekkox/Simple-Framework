<?php

namespace App;

use App\Exceptions\ViewNotFoundException;

class View
{
    protected string $view;
    protected array $params;

    public function __construct(string $view, array $params = [])
    {
        $this->view = $view;
        $this->params = $params;
    }

    public static function make(string $view, array $params = []): static
    {
        return new static($view, $params);
    }

    public function render(): string
    {
        $viewPath = VIEW_PATH . '/' . $this->view . '.php';

        if (!file_exists($viewPath)) {
            throw new ViewNotFoundException();
        }
        //using variableVariable to pass data to the view "echo $foo";
        foreach ($this->params as $k => $v) {
            $$k = $v;
        }
        //the same as extract($this->params)

        ob_start();
        include $viewPath;
        return (string)ob_get_clean();
    }

    public function __toString(): string
    {
        return $this->render();
    }

    public function __get(string $name)
    {
        //magic method for printing parameters in views
        //$this->foo; where foo is variable
        if (isset($this->params[$name])) {
            return $this->params[$name];
        } else {
            return null;
        }
        //$this->params[$name] ?? null;
    }
}


