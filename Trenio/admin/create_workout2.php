<?php
require "../classes/database.php";
require "../classes/workout.php";
require "../classes/exercise.php";
require "../classes/url.php";
require "../classes/Auth.php";

session_start();

if (!Auth::isLoggedIn()) {
    die("Nemáte oprávnění");
}

$database = new Database();
$connection = $database->connectionDatabase();


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_POST["name"] === "") {
        die("Název tréninku je povinný údaj");
        exit;
    }

    $name = htmlspecialchars($_POST["name"]);
    $description = htmlspecialchars($_POST["description"]);
    $users_id = htmlspecialchars($_POST["user_id"]);//$_SESSION['logged_in_user_id'];

    $createWorkout = Workout::createWorkout($connection, $name, $description, $users_id);


    $new_workout_id = $connection->lastInsertId();

    // Načtení tréninku z databáze pomocí ID
    //$new_workout = Workout::getWorkoutById($connection, $new_workout_id);

    // Načtení cviků z databáze
    //$exercises = Exercise::getExerciseUseridWithoutUserid($connection, $users_id);

    // Přesměrování na stránku s vytvořeným tréninkem
    Url::redirectUrl("/Trenio/admin/one_workout.php?id=" . $new_workout_id);
}

?>


