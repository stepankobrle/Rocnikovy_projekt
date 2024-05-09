<?php
require "../classes/Database.php";
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
    $series =  Series::getSeries($connection, $_GET["id"]) ;
} else {
    $series = null;
}


if ($series) {
    $sets = $series['set_number'];
    $reps = $series['repetitions'];
    $weight = $series['weight'];
    $series_id = $series['series_id'];
} else {
    die("Série nebyla nalezena");
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $sets = htmlspecialchars($_POST["set_number"]);
    $reps = htmlspecialchars($_POST["repetitions"]);
    $weight = htmlspecialchars($_POST["weight"]);

    if (Series::updateSeries($connection, $sets, $reps, $weight ,$_GET["id"])){
        Url::redirectUrl("/Trenio/admin/one_workout.php?id=" . $workout_id);
    } else {
        die("Nepodařilo se upravit sérii");
    }
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
    <link rel="stylesheet" href="../css/update_series.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>
<?php require "../assets/admin_header.php"; ?>

<main>
    <section class="main-heading">
        <h1>Upravit cvik</h1>
    </section>

    <section class="wrapper">
        <h2></h2>
        <form method="POST">
            <label for="set_number">Série</label>
                <input  type="number"
                        name="set_number"
                        placeholder="serie"
                        value="<?= htmlspecialchars($sets)  ?>"
                        required><br>

            <label for="repetitions">Opakování</label>
                <input  type="number"
                        name="repetitions"
                        placeholder="opakování"
                        value="<?= htmlspecialchars($reps)  ?>"
                        required><br>

            <label for="weight">Váha</label>
                <input  type="number"
                        name="weight"
                        placeholder="váha"
                        value="<?= htmlspecialchars($weight)  ?>"
                        required><br>

            <input class="submit" type="submit" value="Uložit">
        </form>
    </section>

</main>

<script src="../js/header.js"></script>
</body>
</html>