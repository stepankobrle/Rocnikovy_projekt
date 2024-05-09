<?php

class Database{

    public function connectionDatabase(){
        $db_host = "127.0.0.1";
        $db_name = "myapp1";
        $db_users = "stpkbl";
        $db_password = "123456stp";


        $connection = "mysql:host=" . $db_host . ";dbname=" . $db_name . ";charset=utf8";

        try {
            $db = new PDO($connection, $db_users, $db_password);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $db;
        }catch( PDOException $e){
            echo $e->getMessage();
            exit;
        }

    }

}