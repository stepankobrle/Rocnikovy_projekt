<?php


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Přihlášení do Trenio</title>
</head>
<body id="login">


    <div class="wrapper">
        <form action="admin/login.php" method="post">
            <div class="back-uvod">
                <a href="index.php"><i class='bx bx-arrow-back'></i></a>
            </div>

            <h2>Přihlášení</h2>
            <div class="input-box">
                <input type="email" name="login-email" placeholder="E-mail" required>
                <i class='bx bxs-user' ></i>
            </div>

            <div class="input-box">
                <input type="password" name="login-password" placeholder="Heslo" required>
                <i class='bx bxs-lock-alt'></i>
            </div>

            <div class="remember-password">
                <label><input type="checkbox">Zapamatovat si</label>
                <a href="#">Zapomenuté heslo? </a>
            </div>

            <button type="submit" class="btn">Přihlásit se</button>

            <div class="registr">
                <p>Nemáš založený účet? <a href="registr.php">Registrovat se</a></p>
            </div>
        </form>
    </div>
</body>
</html>