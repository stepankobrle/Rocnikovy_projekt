<?php
global $connection;
require "../classes/Database.php";
require "../classes/Auth.php";
require "../classes/Workout.php";

session_start();

if (!Auth::isLoggedIn()) {
    die("Nemáte oprávnění");
}

//$connection = connectionDatabase();
$database = new Database();
$connection = $database->connectionDatabase();

$user_id = $_SESSION['logged_in_user_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/create_workout.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Přidat trénink</title>

    <body>
        <?php require '../assets/admin_header.php'; ?>

        <main>

            <section class="main-heading">
                <h1>Vytvořit trénink</h1>
            </section>

            <section class="wrapper">

                <form action="create_workout2.php" method="post">
                    <input type="text" name="name" id="name" placeholder="Název">
                    <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['logged_in_user_id']); ?>">
                    <textarea name="description" id="description" placeholder="popis"></textarea>
                    <button class="submit" type="submit">Přidat trénink</button>
                </form>

            </section>
        </main>

        <footer></footer>
        <script rel="script" src="../js/header.js"></script>
    </body>
</html>