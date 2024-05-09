<?php

require "../classes/Url.php";
require "../classes/Database.php";
//require "../assets/user.php";
require "../classes/User.php";

session_start();

$database = new Database();
$connection = $database->connectionDatabase();

//kontrola duplikatu emailu


if ($_SERVER["REQUEST_METHOD"] === "POST"){


    $database = new Database();
    $connection = $database->connectionDatabase();


    if (isset($_POST["email"])) {

        $email = $_POST["email"];
        $user = User::getUserByEmail($connection, $email);

        if (!empty($user)) {
            echo "Uživatel s tímto emailem již existuje.";
            die();
        }
    }
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);    //hash password
    //

    //poslat udaje do databaze
    $id = User::createUser($connection, $email, $password);

    if (!empty($id)){
        //zabranuje provedeni tzv. fixation attack.
        session_regenerate_id(true);

        //nastaveni ze je uzivatel prihlaseny
        $_SESSION["is_logged_in"] = true;
        //nastaveni id uzivatele
        $_SESSION["logged_in_user_id"] = $id;

        Url::redirectUrl("/Trenio/admin/view_workout.php");
    } else {
        echo "Registrace se nezdařila.";
    }
}