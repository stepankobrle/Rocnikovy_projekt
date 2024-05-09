<?php
require "../classes/Database.php";
require "../classes/Workout.php";
require "../classes/Exercise.php";
require "../classes/Url.php";
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
$sql = "SELECT workout_exercise_id FROM workout_exercise
        WHERE exercise_id = :exercise_id AND workout_id = :workout_id";

$statement = $connection->prepare($sql);

// Bindování parametrů

$statement->bindParam(':workout_id', $workoutId, PDO::PARAM_INT);
$statement->bindParam(':exercise_id', $exerciseId, PDO::PARAM_INT);

// Provedení dotazu
try {
    if ($statement->execute()) {
        $result = $statement->fetch(PDO::FETCH_ASSOC);
        $workout_exercise_id = $result['workout_exercise_id'];
        echo $workout_exercise_id;
    } else {
        throw new Exception('Nastala chyba při získávání cviku z propojovací tabulky.');
    }
} catch (Exception $e) {
    error_log('Chyba při přidávání cviku do propojovací tabulky: ' .  3, '../errors/error.log');
    echo "Typ chyby: " . $e->getMessage();
}
