<?php

require __DIR__.'/Modules/Bootstrap.php';

class App{
    private $view;
    private $session;
    private $request;
    private $response;
    
    public function __construct(){
        $this->view = $this->getView();
        $this->request = $this->request();
    }

    private function getView(){
        $router = new Router();
        return $router;
    }

    private function request(){
        $request ='';
        return $request;
    }
}

return new App();