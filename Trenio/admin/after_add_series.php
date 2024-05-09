<?php
require "../classes/database.php";
require "../classes/url.php";
require "../classes/Auth.php";
require "../classes/Series.php";
require "../classes/Workout.php";

session_start();

if (!Auth::isLoggedIn()) {
    die("Nemáte oprávnění");
}

$database = new Database();
$connection = $database->connectionDatabase();

$workout_exercise_id = $_POST['workout_exercise_id'];
$set = $_POST['set'];
$reps = $_POST['reps'];
$weight = $_POST['weight'];

$new_setnumber = Series::maxSetnumber($connection, $workout_exercise_id);
$addSeries = Series::addSeries($connection, $workout_exercise_id, $new_setnumber, $reps, $weight);
$workout_id = Workout::getWorkoutIdByWorkoutExercise($connection, $workout_exercise_id);

Url::redirectUrl("/Trenio/admin/one_workout.php?id=" . $workout_id);
?>



