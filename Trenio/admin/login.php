<?php

//require "../assets/database.php";
require "../classes/Database.php";
require "../classes/Url.php";
//require "../assets/user.php";
require "../classes/User.php";

session_start();

if($_SERVER["REQUEST_METHOD"] === "POST"){

    //$connection = connectionDatabase();
    $database = new Database();
    $connection = $database->connectionDatabase();

    $log_email = $_POST["login-email"];
    $log_password = $_POST["login-password"];

    if (User::authentication($connection, $log_email, $log_password)){
        //ziskani id uzivatele jeste neni pouzito v kodu - bude slouzit pro data uzivatele po prihlaseni//
        $id = User::getUserId($connection, $log_email);

        //zabranuje provedeni tzv. fixation attack.
        session_regenerate_id(true);

        //nastaveni ze je uzivatel prihlaseny
        $_SESSION["is_logged_in"] = true;
        //nastaveni id uzivatele - pridam s nastavenim $id
        $_SESSION["logged_in_user_id"] = $id;

        Url::redirectUrl("/Trenio/admin/view_workout.php");

    }else{
       $error = "Nesprávné jméno nebo heslo";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>
    <?php if(!empty($error)):?>
        <p><?= $error ?></p>
    <?php endif; ?>
</body>