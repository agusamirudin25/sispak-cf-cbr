<?php

class Router
{
    private $controller = 'App\Classes\Auth';
    private $method     = 'login';
    private $params     = [];

    public function __construct()
    {
        $this->parseUri();
    }

    private function parseUri()
    {
        $uri = $_GET['uri'] ?? '';

        $uri = explode('/', trim(strtolower($uri), '/'));

        // controller
        if (!empty($uri[0])) {

            $controller = $uri[0];
            unset($uri[0]);
            $controller = 'App\Classes\\' . $controller;

            if (class_exists($controller)) {
                $this->controller = $controller;
            } else {
                abort('404');
            }
        }


        $class = $this->controller;
        // pretty($class, 1);
        $class = new $class;

        // method 
        if (isset($uri[1])) {

            $method = $uri[1];
            unset($uri[1]);

            if (method_exists($class, $method)) {
                $this->method = $method;
            } else {
                abort();
            }
        }

        // params 
        if (isset($uri[2])) {
            $this->params = array_values($uri);
        }

        call_user_func_array([$class, $this->method], $this->params);
    }
}
