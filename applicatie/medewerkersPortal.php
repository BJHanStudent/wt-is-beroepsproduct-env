<?php 
require_once('./components/functions.php');
loggedincheck();

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
            <li class="navLink"><form class="navigation_form" method="POST"  action="medewerkersPortal.php" >
                <input type="submit" name="logout" value="Uitloggen" ></form></li>
        </ul>
    </nav>
    <main>
        <div class="optionGrid">
            <div>
                <a href="bagageInchecken.php">
                    <img src="images/Suitcase.png" alt=""><br>
                    <h4>Bagage inchecken</h4>
                </a>
            </div>
            <div>
                <a href="vluchtOphalen.php">
                    <img src="images/Plane.png" alt=""><br>
                    <h4>Vlucht ophalen</h4>
                </a>
            </div>
            <div>
                <a href="zelfInchecken.php">
                    <img src="images/Passenger.png" alt=""><br>
                    <h4>Passagier invoeren</h4>
                </a>
            </div>
            <div>
                <a href="vluchtInvoeren.php">
                    <img src="images/Plane.png" alt=""><br>
                    <h4>Vlucht invoeren</h4>
                </a>
            </div>
            <div class="GridColumnFullWidth">
                <a href="vluchtenOverzicht.php">
                    <img src="images/Plane.png" alt=""><br>
                    <h4>Alle vluchten</h4>
                </a>
            </div>
        </div>
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