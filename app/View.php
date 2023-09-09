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


    public static function make(string $view, array $params = []):static
    {
        return new static($view, $params);
    }

    public function render() : string
    {
        $viewPath = VIEW_PATH . '/'. $this->view. '.php';

        if (! file_exists($viewPath)) {
            throw new ViewNotFoundException();
        }

        foreach ($this->params as $k => $v){
            $$k = $v;
        }
        //the same as extract($this->params)

         ob_start();
        include $viewPath;
        return (string) ob_get_clean();
        }

        public function __toString(): string
        {
           return $this->render();
        }

        public function __get(string $name)
        {
            if(isset($this->params[$name])){
                return $this->params[$name];
            }else{
                return null;
            }
            //$this->params[$name] ?? null;
        }
}


