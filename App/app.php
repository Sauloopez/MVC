<?php

require __DIR__.'/Modules/Bootstrap.php';

class App{
    private $view;
    private $session;
    private $request;
    private $response;
    
    public function __construct(){
        $this->getView();
    }

    private function getView(){
        $router = new Router();
    }
}

return new App();