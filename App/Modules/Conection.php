<?php

class Conection{
    private PDO $CONN;

    public function __construct(PDO $conn = null){
        $this->CONN= $conn;
    }

    public static function conn($module, $host, $user, $password, $database){
        try{
            $conn= new Conection( new PDO($module.':host='.$host.';dbname='.$database, 
            $user, $password));
        }catch(PDOException $exp){
            echo 'Error'.$exp->getMessage();
            return null;
            
        }

        return $conn->getConn();
    }

    private function getConn(){
        return $this->CONN;
    }
}