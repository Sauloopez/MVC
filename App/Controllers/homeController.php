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
        header('Location: '.URL);
    }

    public function login(){
        $this->model('User');
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user=new User($username, $password);
            $read = User::read($user);
            if($read::class == 'User'){
                Auth::createToken(new Auth($username, $user->getRole()));
                header('Location: '.URL);
                exit();
            }else{
                if($read === $user->DOESNT_EXISTS)
                $this->view->show('home/login', ['message'=>'No se encuentra registrado']);
                if($read === $user->WRONG_PASSWORD)
                $this->view->show('home/login', ['message'=>'Datos incorrectos']);
                exit();
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