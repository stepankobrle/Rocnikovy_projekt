<?php


class Auth {
    /*
 *
 *Ověřuje zda je uživatel přihlášen
 *
 * @return bool - true pokud je uživatel přihlášen, jinak false
 */

    public static function isLoggedIn(){
        return isset($_SESSION["is_logged_in"]) and $_SESSION["is_logged_in"];
    }


    public static function getUser($connection, $userId){
        $sql = "SELECT * FROM users WHERE user_id = ?";
        $stmt = $connection->prepare($sql);

        try {
               if ($stmt->execute) {
                return $stmt->fetchAll();
            }else
                throw new Exception("Chyba při získání uživatele");

        }catch (PDOException $e) {
            error_log("Chyba při získání uživatele getUser\n", 3, "../errors/error.log");
            echo "Typ chyby: " . $e->getMessage();
        }
        $stmt->execute([$userId]);

    }
}