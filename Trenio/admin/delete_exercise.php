<?php
require "../classes/Database.php";
require "../classes/Exercise.php";
require "../classes/Auth.php";
require "../classes/Url.php";


session_start();
if (!Auth::isLoggedIn()) {
    die("Nemáte oprávnění");
}

$database = new Database();
$connection = $database->connectionDatabase();


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(Exercise::deleteExercise($connection, $_GET["id"])) {
        Url::redirectUrl("/Trenio/admin/view_exercises.php");
    } else {
        die("Nepodařilo se smazat cvik");
    }
}

?>


<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/delete_exercise.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Smazat cvik</title>
</head>
<body>
<?php require "../assets/admin_header.php"; ?>



<main>
    <section class="main-heading">
        <h2>Chcete tento cvik smazat? </h2>
    </section>


    <section class="delete-form">
        <form method="POST">
            <button>Smazat</button>
            <a href="one_exercise.php?id=<?=  $_GET['id'] ?>">Zrušit</a>
        </form>
    </section>

</main>
<script rel="script" src="../js/header.js"></script>
</body>
</html>
