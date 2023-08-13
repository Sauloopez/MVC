<?php


class ModelBase
{
    protected $table;
    protected PDO $conn;

    public function __construct()
    {
        $this->conn = Conection::conn(
            //Modulo PDO que se va a utilizar, ejm:mysql, postgres, etc
            PDO,
            //Host de la base de datos
            DB_HOST,
            //Usuario de la base de datos
            DB_USER,
            //Contraseña de la base de datos
            DB_PASSWORD,
            //Nombre de la base de datos
            DB
        );
    }

}