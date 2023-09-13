<?php

class ViewBase{
    private $dir;
    private $footer;
    private $header;
    public function __construct() {
        $this->dir = __DIR__.'/../Views/';
        $this->header = $this->dir."includes/header.php";
        $this->footer = $this->dir."includes/footer.php";
    }

    public function show($vista, $content=[]){
        $vista.='.php';
        if(is_file($this->dir.$vista)){
            $title = "MVC";
            require_once $this->header;
            require_once $this->dir.$vista;
            require_once $this->footer;
        }else{
            require_once $this->dir.'includes/404.php';
        }
    }
}