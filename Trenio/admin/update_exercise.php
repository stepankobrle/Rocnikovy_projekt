<?php
require "../classes/Database.php";
require "../classes/Exercise.php";
require "../classes/Auth.php";
require "../classes/Url.php";


session_start();

if ( !Auth::isLoggedIn() ){
    die("Nepovolený přístup");
}

$database = new Database();
$connection = $database->connectionDatabase();

if ( isset($_GET["id"]) and is_numeric($_GET["id"]) ) {
    $one_exercise = Exercise::getExercise($connection, $_GET["id"]);
}

if ($one_exercise){
    $name = $one_exercise['name'];
    $description = $one_exercise['description'];
    $exercise_id = $one_exercise['exercise_id'];
    //$image = $one_exercise['image'];
} else {
    die("Cvik nebyl nalezen");
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = htmlspecialchars($_POST["name"]);
    $description = htmlspecialchars($_POST["description"]);

    // Nahrání obrázku na server
    //$targetDir = "../img/";
    //$targetFile = $targetDir . basename($_FILES["image"]["name"]);
    //move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
    //$image = $targetFile;

    if (Exercise::updateExercise($connection, $name, $description,$exercise_id)){
        Url::redirectUrl("/Trenio/admin/view_exercises.php");
    } else {
        die("Nepodařilo se upravit cvik");
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
    <link rel="stylesheet" href="../css/update_exercise.css">
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
        <form method="POST">
            <label for="name">Název cviku:</label><br>
            <input  type="text"
                    name="name"
                    placeholder="Název cviku"
                    value="<?= htmlspecialchars($name)  ?>"
                    required><br>

            <label for="description">Popis cviku:</label><br>
            <textarea   name="description"
                        placeholder="Popis cviku"
                        required><?= htmlspecialchars($description) ?></textarea><br>

            <input class="submit" type="submit" value="Uložit">
        </form>
    </section>

</main>

<script src="../js/header.js"></script>
</body>
</html>

