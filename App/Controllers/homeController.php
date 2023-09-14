<?php

class homeController extends ControlBase{
    private $dir;
    public function __construct(){
        parent::__construct();

    }

    public function index(){
        $this->view->show('home/index');
    }

    public function registro(){
        echo 'hola desde registro';
    }

    public function logout(){
        if($this->isAuthenticated()){
            session_destroy();
            unset($_SESSION['jwt']);
        }
        $this->view->show('home/index');
    }

    public function login(){
        $this->model('User');
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = new User($username, $password);
            if(User::READ($user)::class == 'Error'){
                $this->view->show('home/login', ['datos incorrectos']);
            }else{
                Auth::createToken(new Auth($username, $username == 'webmaster@domain.co'?'admin':'user'));
                header('Location: '.URL);
                return ;
            }
        }
        if($_SERVER['REQUEST_METHOD']=='GET'){
            if($this->isAuthenticated()){
                $this->view->show('home/index', ['Ya has iniciado sesión como '.$this->authUser()->username]);
            }else{
                $this->view->show('home/login');
            }
        }
    }
}