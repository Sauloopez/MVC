<?php

class homeController extends ControlBase{
    private $dir;
    public function __construct(){
        parent::__construct();
        $this->view->show('home/index');
    }
}