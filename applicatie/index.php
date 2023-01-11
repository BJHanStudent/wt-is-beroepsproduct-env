<?php 
require_once('./components/functions.php');
if(isset($_POST['logout'])){
    logout();
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
            <li class="navLink"><a href="passagierPortal.php">Passagier</a></li>
            <?php
             if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
                echo '<li class="navLink"><a href="medewerkersPortal.php">Medewerker</a></li>';
                echo '  <li class="navLink"><form class="navigation_form" method="POST"  action="medewerkersPortal.php" >
                <input type="submit" name="logout" value="Uitloggen" ></li>';     
            }else  {
                echo '<li class="navLink"><a href="login.php">Medewerker</a></li>';
            } ?>
            
        </ul>
    </nav>
    <main>
        <img class="MainPageImage" src="images/Mainbackground.jpg" alt="">
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