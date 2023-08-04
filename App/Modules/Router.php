<?php
class Router
{
    public $method;
    public $controller;

    public function __construct()
    {
        $this->matchRoute();
    }

    public function matchRoute()
    {
        $query = explode('=', $_SERVER['QUERY_STRING'])[1];
        $url = explode('/', $query);
        $dirController = __DIR__ . '/../Controllers/' . $url[0] . 'Controller.php';
        if (is_file($dirController)) {
            require_once($dirController);

            $this->controller = $url[0].'Controller';
            $this->method = '__construct';
            if(isset($url[1])){
                $this->method = $url[1];
            }
            $this->run();
        }else{
            ControlBase::Error();
        }
    }

    private function run(){
        $controller = new $this->controller;
        
        if($this->method != '__construct'){
            if(method_exists($controller, $this->method))
                $controller ->{$this->method}();
            else
                ControlBase::Error();
        }
    }
}