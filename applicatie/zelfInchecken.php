<?php 
 require_once('db_connectie.php');
 require_once('./components/functions.php');

 $balieopties = "";
 $conn = maakVerbinding();
 $sql = "SELECT balienummer FROM Balie ";
 $stm = $conn->prepare($sql);
 $stm->execute();
 foreach($stm as $row){
     $balieopties.="<option value='".$row['balienummer']."'>".$row['balienummer']."</option>";
 }
 
if(isset($_POST['passagierinvoeren'])){
    if(checkpassengerlimit($_POST['vluchtnummer'],$conn) > 0){
        addpassenger(
            $_POST['naam'],
            $_POST['vluchtnummer'],
            $_POST['geslacht'],
            $_POST['balienummer']
            ,$_POST['stoel']
            ,$_POST['inchecktijdstip'],$conn);   
            generatemessage("passagier ingechecked", false);
    }else {
        generatemessage("Vlucht is vol of bestaat niet", true);
    }
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
                <input type="submit" name="logout" value="Uitloggen" ></li>';
            }else  {
                echo '<li class="navLink"><a href="login.php">Medewerker</a></li>';
            } ?>
        </ul>
    </nav>
    <main>
        <form action="zelfinchecken.php" method="post">
            <div class="container">
                <h2>Vul gegevens in</h2>
                <input type="text" name="vluchtnummer" placeholder="Vluchtnummer" required><br>
                <input type="text" name="naam" placeholder="Voornaam" required><br>  
                    <select name="geslacht">
                    <option value="M">Man</option>
                    <option value="V">Vrouw</option>
                    </select><br>
                    <select name="balienummer">
                    <?= $balieopties  ?>
                    </select><br>
                    <input type="text" name="stoel" placeholder="Stoelnummer"  required><br>
                    <input type="datetime-local" name="inchecktijdstip" placeholder="inchecktijdstip" required><br>
                <input type="submit" name="passagierinvoeren" value="Checkin">
            </div>
        </form>
        
    </main>
</body>

</html>