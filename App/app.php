<?php

require __DIR__.'/Modules/Bootstrap.php';

class App{
    private $router;
    
    public function __construct(){
        $this->router = new Router();
    }
}

return new App();