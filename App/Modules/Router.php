<?php
class Router
{

    public function __construct()
    {
        $this->matchRoute();
    }

    public function matchRoute()
    {
        $url = (explode('=', $_SERVER['QUERY_STRING']));
        $vista = $url[1];

        if (!is_file(__DIR__ . '/../Views/' . $vista . '.php')) {
            $vista = '404';
        }
        require_once(__DIR__ . '/../Views/' . $vista . '.php');


    }
}