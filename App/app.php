<?php

require __DIR__.'/Modules/Bootstrap.php';

class App{
    private $router;
    private $auth;
    
    public function __construct(){
        $this->router = new Router();       
    }
}

return new App();