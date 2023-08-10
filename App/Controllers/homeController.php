<?php

class homeController extends ControlBase{
    private $dir;
    public function __construct(){
        parent::__construct();
    }

    public function index(){
        $this->view->show('home/index');
    }
}