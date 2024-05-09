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

if ( isset($_GET["workout_exercise_id"]) and is_numeric($_GET["workout_exercise_id"]) ) {
    $workout_exercise_id = $_GET["workout_exercise_id"];
} else {
    $workout_exercise_id = null;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/add_series.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Přidat trénink</title>

<body>
<?php require '../assets/admin_header.php'; ?>

<main>
    <section class="main-heading">
        <h1>Přidejte sérii</h1>
    </section>

    <section class="wrapper">
        <form action="after_add_series.php" method="post">
                <input type="hidden" name="workout_exercise_id" value="<?php echo $workout_exercise_id; ?>">
                <input type="hidden" name="set" id="set" required>
            <label for="reps">Počet opakování</label>
                <input type="number" name="reps" id="reps" required>
            <label for="weight">Váha</label>
                <input type="number" name="weight" id="weight" required>
            <br>
            <button class="submit" type="submit">Přidat sérii</button>

        <!--<button id="redirectBtn1" data-workout-id="<?php echo $workout_exercise_id['workout_id']; ?>">Hotovo</button>-->

    </section>
</main>


</body>
</html>