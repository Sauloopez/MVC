<?php

require __DIR__.'/Modules/Bootstrap.php';

class App{
    private $router;
    private $auth;
    
    public function __construct(){
        if(session_status() == PHP_SESSION_NONE) session_start(); 
        $this->router = new Router();
    }
}

return new App();