<?php


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Registrace do Trenio</title>
</head>
<body id="login">

<div class="wrapper">
    <form action="admin/after_registration.php" method="post">
        <div class="back-uvod">
            <a href="index.php"><i class='bx bx-arrow-back'></i></a>
        </div>

        <h2>Registrace</h2>
        <div class="input-box">
            <input type="email" name="email" placeholder="E-mail" required>
            <i class='bx bxs-user' ></i>
        </div>

        <div class="input-box">
            <input type="password" name="password" placeholder="Heslo" required>
            <i class='bx bxs-lock-alt'></i>
        </div>


        <button type="submit" class="btn">Dokončit registraci</button>

        <div class="registr">
            <p>Máte založený účet? <a href="signin.php">Přihlásit se</a></p>
        </div>

    </form>
</div>
</body>
</html>