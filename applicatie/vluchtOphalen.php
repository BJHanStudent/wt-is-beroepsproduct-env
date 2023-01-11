<?php 
require_once('./components/functions.php');
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
            <?php
             if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                echo '  <li class="navLink"><form class="navigation_form" method="POST"  action="medewerkersPortal.php" >
                <input type="submit" name="logout" value="Uitloggen" ></form></li>';
            }else  {
                echo '<li class="navLink"><a href="login.php">Medewerker</a></li>';
            } ?>
        </ul>
    </nav>
    <main>
        <form action="vluchtDetails.php" method="post">
            <div class="container">
                <h2>Vul gegevens in</h2>
                <input type="text" name="vluchtnummer" placeholder="vluchtnummer" required><br>
                <input type="submit" name="Vluchtophalen" value="Vlucht ophalen">
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