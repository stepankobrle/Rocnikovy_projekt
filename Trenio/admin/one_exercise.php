<?php
require "../classes/Database.php";
require "../classes/Exercise.php";
require "../classes/Auth.php";

session_start();

if ( !Auth::isLoggedIn() ){
    die("Nepovolený přístup");
}

$database = new Database();
$connection = $database->connectionDatabase();



if ( isset($_GET["id"]) and is_numeric($_GET["id"]) ) {
    $exercise = Exercise::getExercise($connection, $_GET["id"]);
} else {
    $exercise = null;
}

$text = $exercise["description"];
$paragraphs = explode("\n", wordwrap($text, 100));
//$exercises = Exercise::getAllExercise($connection);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/one_exercise.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>
<?php require "../assets/admin_header.php"; ?>

<main>
    <section class="main-heading">
        <?php if ($exercise === null): ?>
            <h1>Cvik nenalezen</h1>
        <?php else: ?>
            <h1><?= htmlspecialchars($exercise["name"]) ?></h1>
        <?php endif ?>
    </section>

    <section>
        <?php if ($exercise === null): ?>
            <p>Cvik nenalezen</p>
        <?php else: ?>
            <?php foreach ($paragraphs as $paragraph): ?>
                <p><?php echo htmlspecialchars($paragraph)?></p>
            <?php endforeach; ?>
    <!--<p>Fotka:  <?= htmlspecialchars($exercise["image"]) ?></p>-->
        <?php endif ?>
    </section>


    <section class="buttons">
        <a href="view_exercises.php">Zpět na seznam cviků</a><br>


        <?php if ($exercise ['users_id'] !== null):?>
            <a class="users-button" href="delete_exercise.php?id=<?= $exercise['exercise_id'] ?>">Smazat cvik</a>
            <a class="users-button" href="update_exercise.php?id=<?= $exercise['exercise_id'] ?>">Upravit cvik</a>
        <?php else:?>

        <?php endif; ?>
    </section>

</main>

<script src="../js/header.js"></script>
</body>
</html>

