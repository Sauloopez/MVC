<?php

class ControlBase{
    protected $view;

    public function __construct(){
        $this->view = new ViewBase();
    }

    public static function Error(){
        require_once __DIR__.'/../Views/404.php';
    }
}