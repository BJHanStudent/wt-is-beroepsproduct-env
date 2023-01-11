<?php
 require_once('db_connectie.php');
 require_once('./components/functions.php');
 $_SESSION['loggedin'] = false;


if(isset($_POST['login'])){
 checklogin($_POST['name'],$_POST['password'],$conn);
}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/normalize.css">
    <title>Gelre Airport</title>
</head>

<body>
    <nav class="navigation">
        <ul>
            <li>
                <h2 class="MainTitel">Gelre Airport</h2>
            </li>
            <li class="navLink"><a href="index.php">Home</a></li>
        </ul>
    </nav>
    <main>
        <form action="login.php" method="post">
            <div class="container">
                <h2>Login</h2>
                <input type="name" name="name" placeholder="Username" required><br>
                <input type="password" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Wachtwoord moet bestaan uit 8 karakters waarvan een nummer hoofd en kleine letter" required><br>
                <input type="submit" name="login" value="Inloggen">
            </div>
        </form>
    </main>
    <footer>
        <ul>
            <li>
                <a href="privacyVerklaring.html">Privacy verklaring</a>
            </li>
            <li>
                <a href="#">Copyright Gelere Airport 2022</a>
            </li>
        </ul>
    </footer>
</body>

</html>

