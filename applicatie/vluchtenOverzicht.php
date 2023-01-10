<?php 
require_once('db_connectie.php');
require_once('./components/functions.php');
loggedincheck();
if(isset($_POST['logout'])){
    logout();
  }

$data= '';

if(isset($_GET['vertrektijd'])){
 $data = getflightoverview($_GET['vertrektijd']);
} else if(isset($_GET['maatschappijcode'])){
   $data = getflightoverview($_GET['maatschappijcode']);
}else{
  $data =  getflightoverview();
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
            <li class="navLink"><li class="navLink"><form class="navigation_form" method="POST"  action="medewerkersPortal.php" >
                <input type="submit" name="logout" value="Uitloggen" ></li></li>
        </ul>
    </nav>
    <main>
        <table class="flightTable">
            <thead>
                <tr>

                    <th>vluchtnummer</th>
                    <th>bestemming</th>
                    <th>gatecode</th>
                    <th>max aantal</th>
                    <th>max gewicht pp</th>
                    <th>max totaalgewicht</th>
                    <th>vertrektijd</th>
                    <th>maatschappijcode</th>
                    <th>
                        <div class="dropdown">
                            <button class="dropbtn">Sorteer op</button>
                            <div class="dropdown-content">
                                <form action="vluchtenOverzicht.php" method="GET">
                                    <input type="submit" name="vertrektijd" value="vertrektijd">
                                    <input type="submit" name="maatschappijcode" value="maatschappijcode">
                                </form>
                            </div>
                        </div>
                    </th>
                </tr>
            </thead>
            <tbody>
              <?= $data ?>
            </tbody>
        </table>
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