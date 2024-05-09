<?php
require    "../classes/Database.php";
require "../classes/Series.php";
require "../classes/Auth.php";
require "../classes/Url.php";
require "../classes/Workout.php";

session_start();

if (!Auth::isLoggedIn()) {
    die("Nemáte oprávnění");
}

$database = new Database();
$connection = $database->connectionDatabase();


//$Workout_exerciseId = Workout::getAllWorkout_exersice($connection);
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(Workout::removeExerciseFromWorkout($connection, $_GET['workout_id'], $_GET['exercise_id'])){

    } else {
        Url::redirectUrl("/Trenio/admin/one_workout.php?id=" . $_GET['workout_id']);
    }
}


// SQL dotaz pro odstranění série
;

// Přesměrování na stránku s tréninkem
//Url::redirectUrl("/Trenio/admin/one_workout.php?id=" . $workoutId);

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
            <a href="one_workout.php?id=<?=  $_GET['workout_id'] ?>">Zrušit</a>
        </form>
    </section>

</main>
<script rel="script" src="../js/header.js"></script>
</body>
</html>
