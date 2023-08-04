<?php

class ViewBase{
    private $dir;
    public function __construct() {
        $this->dir = __DIR__.'/../Views/';
    }

    public function show($vista){
        $vista.='.php';
        if(is_file($this->dir.$vista)){
            require_once $this->dir.$vista;
        }else{
            require_once $this->dir.'404.php';
        }
    }
}