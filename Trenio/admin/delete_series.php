<?php
require    "../classes/Database.php";
require "../classes/Series.php";
require "../classes/Auth.php";
require "../classes/Url.php";

session_start();

if (!Auth::isLoggedIn()) {
    die("Nemáte oprávnění");
}

$database = new Database();
$connection = $database->connectionDatabase();

if (isset($_GET["workout_id"]) and is_numeric($_GET["workout_id"])) {
    $workout_id =  $_GET["workout_id"];
} else {
    $workout_id = null;
}


if ( isset($_GET["id"]) and is_numeric($_GET["id"]) ) {
    $series =   Series::deleteSeries($connection, $_GET["id"]);
} else {
    $series = null;
}




Url::redirectUrl("/Trenio/admin/one_workout.php?id=" . $workout_id);