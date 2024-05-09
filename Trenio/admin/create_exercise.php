<?php
require "../classes/Database.php";
require "../classes/Auth.php";
require "../classes/Url.php";
require "../classes/Exercise.php";

session_start();

if (!Auth::isLoggedIn()) {
    die("Nemáte oprávnění");
}



$database = new Database();
$connection = $database->connectionDatabase();

/*
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_POST["name"] === "") {
        die("Název cviku je povinný údaj");
        exit;
    }

    $name = htmlspecialchars($_POST["name"]);
    $description = htmlspecialchars($_POST["description"]);
    $user_id = htmlspecialchars($_POST["user_id"]);

    // Nahrání obrázku na server
    $targetDir = "../img/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
    $image = $targetFile;


    Exercise::createExercise($connection, $name, $description, $image);

*/

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/create_exercise.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>

    <?php require '../assets/admin_header.php'; ?>

    <main>

        <section class="main-heading">
            <h1>Přidat cvik:</h1>
        </section>

        <section class="wrapper" >

            <form action="view_exercises.php" method="post" enctype="multipart/form-data">
                <label for="name">Název cviku:</label><br>
                    <input type="text" id="name" name="name" required><br>
                <label for="description">Popis cviku:</label><br>
                    <textarea id="description" name="description" required></textarea><br>
                <!-- zjistit jak pridat foto-->
                    <input  type="file" id="image" name="image" value="Přidat fotku" ><br>
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['logged_in_user_id']); ?>">
                    <input  class="submit" type="submit" value="Přidat cvik">
            </form>
        </section>
    </main>

<footer>

</footer>
<script rel="script" src="../js/header.js"></script>
</body>
</html>