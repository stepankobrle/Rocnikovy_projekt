<?php
global $connection;
require "../classes/Database.php";
require "../classes/Auth.php";
require "../classes/User.php";
require "../classes/Workout.php";

session_start();

if (!Auth::isLoggedIn()) {
    die("Nemáte oprávnění");
}

//$connection = connectionDatabase();
$database = new Database();
$connection = $database->connectionDatabase();

$workout = Workout::getAllWorkout($connection);

$userId = $_SESSION['logged_in_user_id'];
$user_workouts = array_filter($workout, function($workout) use ($userId) {
    return $workout['users_id'] == $userId;
});

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/view_workout.css">
    <link rel="stylesheet" href="../css/home_page.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Document</title>
</head>
<body>

        <?php require '../assets/admin_header.php'; ?>

    <main>
        <section class="main-heading">
            <h1>Tréninky</h1>
                <a href="create_workout1.php" class="create_workout">Přidat trénink</a>
        </section>



        <section>
            <div class="tab">
                <button class="tablink" onclick="openTab(event, 'Tab1')" data-tab="Tab1">Ukázkové tréninky</button>
                <button class="tablink" onclick="openTab(event, 'Tab2')" data-tab="Tab2">Moje tréninky</button>
            </div>

            <div id="Tab1" class="tabcontent">
                <!-- zde bude propojeno tab2 a tab3-->

                    <?php foreach ($workout as $workout) : ?>
                        <?php if ($workout['users_id'] !== null) continue; ?>

                            <div class="workout-name">
                                <span><?php echo htmlspecialchars($workout['name'])?></span>

                                <a href="one_workout.php?id=<?=$workout['workout_id'] ?>" class="btn">Vice</a>
                            </div>

                    <?php endforeach; ?>
            </div>


            <div id="Tab2" class="tabcontent">
                <!-- zde budou treninky ktere si uzivatel sam slozi z vybranych cviku ktere najde v databazi, a nebo ktere si vytvori -->
                <?php foreach ($user_workouts as $workout) :?>

                       <div class="workout-name">
                           <span><?php echo htmlspecialchars($workout['name'])?></span>

                           <a href="one_workout.php?id=<?=$workout['workout_id'] ?>" class="btn">Vice</a>
                      </div>

                   <?php endforeach; ?>
               <br>

            </div>
        </section>
    </main>

    <footer></footer>
        <script src="../js/homepage.js"></script>
        <script rel="script" src="../js/header.js"></script>
</body>
</html>