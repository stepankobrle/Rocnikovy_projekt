<?php

class User{

    public static function createUser ($connection, $email, $password){

        $sql = "insert into users (email, password) values (:email, :password)";

        $statement = $connection->prepare($sql);

            $statement->bindValue(":email", $email, PDO::PARAM_STR);
            $statement->bindValue(":password", $password, PDO::PARAM_STR);

            try {
                if ($statement->execute()){
                    $id = $connection->lastInsertId();
                    return $id;
                }else {
                    throw new Exception("Chyba při vytváření uživatele");
                }
            } catch (Exception $e) {
                error_log("Chyba při vytváření uživatele createUser\n", 3, "../errors/error.log");
                echo "Typ chyby: " . $e->getMessage();
            }

        }


    /*
     * overeni uzivatele pomoci emailu a hesla
     *
     *
     * @param object $connection
     * @param string $log_email - email z formulare
     * @param string $log_password - heslo z formulare
     *
     * @return bool true/false
     */
    public static function authentication($connection, $log_email, $log_password)
    {

        $sql = "select password from users where email = :email";

        //$statement = mysqli_prepare($connection, $sql);
        $statement = $connection->prepare($sql);


        $statement->bindValue(":email", $log_email, PDO::PARAM_STR);

        try {
            if ($statement->execute()) {
                if ($user = $statement->fetch()) {
                    return password_verify($log_password, $user[0]);
                }
            } else {
                throw new Exception("Chyba při ověření uživatele");
            }
        } catch (Exception $e) {
            error_log("Chyba při ověření uživatele authentication\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }



        /*
         *
         * Get user id from email
         *
         * @param object $connection
         * @param string $email -
         *
         * @return int
         *
         */

        public static function getUserId($connection, $email){
            $sql = "select users_id from users where email = :email";

            $statement = $connection->prepare($sql);


                $statement->bindValue(":email", $email, PDO::PARAM_STR);

            try {
                if($statement->execute()) {
                        $results = $statement->fetch(PDO::FETCH_NUM);
                        $users_id = $results[0];
                        return $users_id;
                    } else {
                        throw new Exception("Chyba při získání id uživatele");
                    }
                } catch (Exception $e){
                    error_log("Chyba při získání id uživatele getUserId\n", 3, "../errors/error.log");
                    echo "Typ chyby: " . $e->getMessage();
                }
        }



    public static function getUserByEmail($connection, $email) {
        $sql = "SELECT * FROM users WHERE email = :email";
        $statement = $connection->prepare($sql);
        $statement->bindValue(':email', $email, PDO::PARAM_STR);

        try {
            if ($statement->execute()) {
                return $statement->fetch(PDO::FETCH_ASSOC);
            } else {
                throw new Exception("Chyba při získání uživatele podle emailu");
            }
        } catch (Exception $e) {
            error_log("Chyba při získání uživatele podle emailu getUserByEmail\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
    }


}