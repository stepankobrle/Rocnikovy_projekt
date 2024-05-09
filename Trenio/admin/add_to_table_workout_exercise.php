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

// Získání dat z AJAX požadavku
$exerciseId = $_POST['exercise_id'];
$workoutId = $_POST['workout_id'];

// SQL dotaz pro vložení dat do propojovací tabulky
$sql = "INSERT INTO workout_exercise (workout_id, exercise_id) VALUES (:workout_id, :exercise_id)";
$statement = $connection->prepare($sql);

// Bindování parametrů
$statement->bindParam(':workout_id', $workoutId, PDO::PARAM_INT);
$statement->bindParam(':exercise_id', $exerciseId, PDO::PARAM_INT);

// Provedení dotazu
try {
    if ($statement->execute()) {
        echo 'Cvik byl úspěšně přidán do propojovací tabulky.';
    } else {
        throw new Exception('Nastala chyba při přidávání cviku do propojovací tabulky.');
    }
} catch (Exception $e) {
    error_log('Chyba při přidávání cviku do propojovací tabulky: ' .  3, '../errors/error.log');
    echo "Typ chyby: " . $e->getMessage();
}

