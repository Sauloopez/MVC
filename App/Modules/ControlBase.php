<?php

class ControlBase{
    protected $view;
    protected $auth;

    public function __construct(){
        $this->view = new ViewBase();
    }

    public function model($model){
        $dir = __DIR__.'/../Models/'.$model.'.php';

        if(is_file($dir)){

            require $dir;

            $this->model = new $model;
        }
    }

    public function isAuthenticated(){
        return Auth::validToken()!=null;
    }

    public function requireAuth(){
        if(!$this->isAuthenticated()){
            header("Location: ".URL.'home/login');
        }
    }

    public function valid_content($class_model, $content){
        $vars = get_class_vars($class_model);
        $model = new $class_model;
        foreach($vars as $k => $v){
            if(array_key_exists($k, $content)){
                if($content[$k] == '' || $content[$k] == ' '){
                    return null;
                }
                $model->$k = $content[$k];
            }else{
                return null;
            }
            
        }
        return $model;
    }

    public static function Error(){
        require_once __DIR__.'/../Views/includes/404.php';
    }
}