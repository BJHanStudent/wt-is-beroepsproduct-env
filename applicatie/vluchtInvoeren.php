<?php 
require_once('db_connectie.php');
require_once('./components/functions.php');
$message = '';

if(isset($_POST['vluchtinvoeren'])){
    addflight(
        $_POST['bestemming'],
        $_POST['gatecode'],
        $_POST['max_aantal'],
        $_POST['max_gewicht_pp'],
        $_POST['max_totaalgewicht'],
        $_POST['vertrektijd'],
        $_POST['maatschappijcode'],$conn);
        $message = generatemessage("Vluchtingevoerd", false);
        
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
    <?= $message ?>
    <form class="loginform" action="vluchtinvoeren.php" method="post">
            <div class="container">
                <h2>Vul gegevens in</h2>
                <input type="text" name="maatschappijcode" placeholder="Vliegmaatschappij" required><br>
                <input type="text"  name="gatecode" placeholder="Gatecode" required><br>
                <input type="text" name="max_aantal" placeholder="Max aantal" required><br>
                <input type="text" name="max_gewicht_pp" placeholder="Max gewicht pp" required><br>
                <input type="text" name="max_totaalgewicht" placeholder="Totaalgewicht" required><br>
                <input type="text" name="bestemming" placeholder="Bestemming" required><br>
                <input type="datetime-local" name="vertrektijd" placeholder="Vertrektijd" required><br>
                <input type="submit" name="vluchtinvoeren" value="Vlucht invoeren">
            </div>
        </form>
    </main>
    
</body>

</html>