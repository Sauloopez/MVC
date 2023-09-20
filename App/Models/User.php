<?php

class User extends ModelBase{
    private $user;
    private $password;
    private $role;

    public Error $EXISTS;
    public Error $DOESNT_EXISTS;
    public Error $WRONG_PASSWORD;

    public function __construct($user= "", $password="", $role=''){
        parent::__construct();
        $this->user=$user;
        $this->password=$password;
        $this->role = $role;
        $this->EXISTS = new Error('El usuario existe', 1);
        $this->DOESNT_EXISTS = new Error('El usuario no existe', 0);
        $this->WRONG_PASSWORD = new Error('Contraseña incorrecta', 2);
    }

    public function hashPassword(){
        $this->password= password_hash($this->password, PASSWORD_DEFAULT);
    }

    public function __destruct(){

    }

    //Getters
    public function getUser(){
        return $this->user;
    }

    public function getPassword(){
        return $this->password;
    }

    public function getRole(){
        return $this->role;
    }

    public static function create(User $user){
        $conn = $user->conn;
        $query = "INSERT INTO users (username, password, role) ".
        "VALUES (?, ?, ?)";

        $stmt = $conn->prepare($query);

        $value = User::read($user);
        if($value == $user->DOESNT_EXISTS){
            $user->hashPassword();
            try{
                $stmt->execute(array($user->getUser(), $user->getPassword(), $user->getRole()));
                return $user->DOESNT_EXISTS;
            }catch(PDOException $e){
                return $e;
            }
            
            
        }

        return $user->EXISTS;
    }

    public static function read(User $user){
        $conn = $user->conn;
        $query="SELECT username, password, role FROM users WHERE username = ?";

        $stmt = $conn->prepare($query);

        $stmt->execute(array($user->getUser()));

        $row= $stmt->fetch(PDO::FETCH_ASSOC);
        //Si existe la fila usuario
        if($row){
            //Si la contraseña es igual a la proporcionada
            if(password_verify($user->getPassword(), $row['password'])){
                //Retorna el usuario
                return new User($row['user'], '', $row['role']);
            }
            //Si la contraseña es incorrecta
            return $user->WRONG_PASSWORD;
        }
        //Si el usuario no existe
        return $user->DOESNT_EXISTS;
    }

    
    public static function delete(User $user){
        $conn = $user->conn;
        $query="DELETE FROM users WHERE username= ? AND password = ?";

        $stmt= $conn->prepare($query);

        $value = User::read($user);
        if($value::class == 'Error'){
            return $user->DOESNT_EXISTS;
        }
        
        $stmt->execute(array($user->getUser(), $user->getPassword()));
        return $user;
    }
}