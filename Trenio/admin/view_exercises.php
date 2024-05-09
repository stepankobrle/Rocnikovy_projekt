<?php
// Připojení k databázi
require "../classes/Database.php";
require "../classes/Exercise.php";
require "../classes/Auth.php";

session_start();

if (!Auth::isLoggedIn()) {
    die("Nemáte oprávnění");
}

$database = new Database();
$connection = $database->connectionDatabase();


// This code is from create_exercise.php and i use it here to add new exercise
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_POST["name"] === "") {
        die("Název cviku je povinný údaj");
        exit;
    }

    $name = htmlspecialchars($_POST["name"]);
    $description = htmlspecialchars($_POST["description"]);
    $user_id =htmlspecialchars($_POST["user_id"]);

    // Nahrání obrázku na server
    $targetDir = "../img/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile);
    $image = $targetFile;

    Exercise::createExercise($connection, $name, $description, $image, $user_id);
}

// This code is from view_exercises.php and i use it here to show all exercises
//$exercises = Exercise::getAllExercise($connection);
$exercises = Exercise::getExerciseUseridWithoutUserid($connection, $_SESSION['logged_in_user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
   <link rel="stylesheet" href="../css/view_exercise.css">

    <link rel="stylesheet" href="../css/home_page.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>

<body>
    <?php if (Auth::isLoggedIn() === true):?>
        <?php require '../assets/admin_header.php';
    endif; ?>

    <main>
        <section class="main-heading">
            <h1>Seznam cviků:</h1>
            <a href="create_exercise.php" class="create-exercise">Přidat cvik</a>
        </section>

        <section class="execise-list">
            <form action="" method="post">
                    <div class="all-exercises">
                        <?php foreach ($exercises as $exercise) : ?>
                            <div class="one-exercise">
                                <?php echo htmlspecialchars($exercise['name'])?>

                                <a href="one_exercise.php?id=<?=$exercise['exercise_id'] ?>">Vice</a>
                            </div>
                        <?php endforeach; ?>
                    </div><br>


            </form>
        </section>
    </main>

<script src="../js/header.js"></script>
</body>
</html>


