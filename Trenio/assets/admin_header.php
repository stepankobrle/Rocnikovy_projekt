<?php
$current_url = $_SERVER['REQUEST_URI'];
$userId = $_SESSION['logged_in_user_id'];


?>

<header>
    <div class="logo">
            <a href="view_workout.php">
                <img src="../img/logo.png" alt="">
            </a>
    </div>

    <nav>
        <ul>
            <li class="max700"><a href="./view_workout.php">Tréninky</a></li>
            <li class="max700"><a href="./create_workout1.php">Přidat trénink</a></li>
            <li class="max700"><a href="./view_exercises.php">Seznam cviků</a></li>
            <li class="max700"><a href="./create_exercise.php">Přidat cvik</a></li>
            <li><a href="./log_out.php">Odhlásit se</a></li>
        </ul>
    </nav>
    <div class="menu-icon">
        <i class='bx bx-menu'></i>
        <!-- <i class='bx bx-x'></i> -->
    </div>


</header>

<aside id="postrannilysta">
    <h2>Trenio</h2>
    <ul>
        <li><a href="./view_workout.php">Tréninky</a></li>
        <li><a href="./create_workout1.php">Přidat trénink</a></li>
        <li><a href="./view_exercises.php">Seznam cviků</a></li>
        <li><a href="./create_exercise.php">Přidat cvik</a></li>
    </ul>
</aside>
