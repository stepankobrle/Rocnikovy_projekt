<?php
global $connection;
require "assets/database.php";
$connection = connectionDatabase();

/*
$sql = "select * from users where users_id = 1";
$results = mysqli_query($connection, $sql);
$users = mysqli_fetch_all($results, MYSQLI_ASSOC);

*/
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/general.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Document</title>
</head>
<body>
<header>
</header>

<main>
    <section>
        <h1>Vytvořte si svůj treninkový plan,<br> ktery vím pomuze v progresu.</h1>
        <a class="button start" href="signin.php">Přihlásit se</a>
        <a class="button login" href="registr.php"> Registrovat se</a>
    </section>
</main>


<footer></footer>
</body>
</html>

