<?php
require "../classes/database.php";
require "../classes/workout.php";
require "../classes/exercise.php";
require "../classes/url.php";
require "../classes/Auth.php";
require "../classes/Series.php";


session_start();

if (!Auth::isLoggedIn()) {
    die("Nemáte oprávnění");
}

$database = new Database();
$connection = $database->connectionDatabase();

if ( isset($_GET["id"]) and is_numeric($_GET["id"]) ) {
    $workout = Workout::getWorkoutById($connection, $_GET["id"]);
} else {
    $workout = null;
}

$users_id = $_SESSION['logged_in_user_id'];
$exercises = Exercise::getExerciseUseridWithoutUserid($connection, $users_id);
$exercise = Exercise::getAllExercise($connection);
$exerciseByWorkout = Workout::getExerciseByWorkoutId($connection, $workout['workout_id']);
$Workout_exerciseId = Workout::getAllWorkout_exersice($connection);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/one_workout.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Trénink</title>

<body>
<?php require '../assets/admin_header.php'; ?>

<main>

    <section class="main-heading">
        <h1><?php echo htmlspecialchars($workout['name']); ?></h1>
    </section>



<!-------------------------------
Show workout name
Show exercises in workout
Show series in exercise***
Show button for add series
show button for update exercise
-------------------------------->
    <section>
        <ul  >
            <?php foreach ($exerciseByWorkout as $getExercise): ?>


            <ul class="exercise-list">

                <li>
                    <div class="Exercise-name">
                        <?php echo $getExercise['name']; ?>
                    </div>
                    <div class="name-options-dropdown">
                        <button class="name-options-btn">
                            <i class='bx bxs-edit-alt'></i>
                        </button>

                        <div class="name-options-content">
                            <a href="remove_exercise.php?exercise_id=<?php echo $getExercise['exercise_id']?>&workout_id=<?= $workout['workout_id']?>" class="delete-option">Smazat</a>
                        </div>
                    </div>
                </li>
            </ul>

            <!-- show series in exercise -->
                <?php $seriesByExercise = Series::seriesByExercise($connection, $getExercise['exercise_id'],$workout['workout_id'] ); ?>

                    <ul class="series-list">
                        <?php foreach ($seriesByExercise as $series): ?>
                            <li>
                                <span><?php echo $series['set_number']; ?>.série&nbsp;&nbsp;&nbsp; <?php echo $series['repetitions']; ?> opakování&nbsp;&nbsp;&nbsp; <?php echo $series['weight']; ?> kg </span>


                            <div class="options-dropdown">
                                <button class="options-btn">
                                    <i class='bx bx-dots-vertical-rounded'></i>
                                </button>

                                <div class="options-content">
                                    <a href="delete_series.php?id=<?php echo $series['series_id']?>&workout_id=<?= $workout['workout_id']?>" class="delete-option">Smazat</a>
                                    <a href="update_series.php?id=<?php echo $series['series_id']?>&workout_id=<?= $workout['workout_id']?>" class="edit-option">Upravit</a>
                                </div>

                            </div>

                        </li>
                        <?php endforeach; ?>
                    </ul>

                <button
                        class="addSeriesBtn" data-exercise-id="<?php echo $getExercise['exercise_id']; ?>"
                        data-workout-id="<?php echo $workout['workout_id']; ?>">Přidat sérii
                </button>


            <?php endforeach; ?>
        </ul>


<!-------------------------------
Btn for add series with modal window
-------------------------------->

        <button id="openModalBtn2">Přidat cvik</button>

        <!-- Modální okno -->
        <div id="myModal2" class="modal">
            <!-- Obsah modálního okna -->
            <div class="modal-content">
                <!-- Tlačítko pro zavření modálního okna -->
                <span id="close2" class="close">&times;</span>
                <!-- Obsah modálního okna -->
                <h2>Vyberte cvik:</h2>

                <ul>
                    <?php foreach ($exercise as $exercise_id): ?>
                        <!--<p><?php echo $exercise_id['image']; ?></p>-->
                        <li><?php echo $exercise_id['name']; ?></li>
                        <button
                                class="addExerciseBtn" data-exercise-id="<?php echo $exercise_id['exercise_id']; ?>"
                                data-workout-id="<?php echo $workout['workout_id']; ?>">Přidat cvik
                        </button>
                    <?php endforeach; ?>
                </ul>

            </div>
        </div>

    </section>
</main>

<footer></footer>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script rel="cript" src="../js/option_content.js"></script>
<script rel="cript" src="../js/add_Exercise_Btn.js"></script>
<script rel="script" src="../js/add_Series_Btn.js"></script>
<script rel="script" src="../js/modal_addExercise.js"></script>
<script rel="script" src="../js/header.js"></script>
</body>
</html>
