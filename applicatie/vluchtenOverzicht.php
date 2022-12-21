<?php 
require_once('db_connectie.php');

$data= '';
if(isset($_POST['Tijd'])){
 $data = getOverzicht('vertrektijd');
}
if(isset($_POST['Vluchtmaatschappij'])){
   $data = getOverzicht('maatschappijcode');
}else{
    $data = getOverzicht(null);
}
function getOverzicht($orderby){
    $conn = maakVerbinding();
    if($orderby != null){
        $sql = "SELECT * FROM  Vlucht order by ".$orderby." ";
    }else{
        $sql = "SELECT * FROM  Vlucht ";
    }
    $stm = $conn->prepare($sql);
    $stm->execute();
    $data = "";
    
    foreach($stm as $row){
      $data.= "<tr>
      <td>".$row['vluchtnummer']."</td>
      <td>".$row['bestemming']."</td>
      <td>".$row['gatecode']."</td>
      <td>".$row['max_aantal']."</td>
      <td>".$row['max_gewicht_pp']."</td>
      <td>".$row['max_totaalgewicht']."</td>
      <td>".$row['vertrektijd']."</td>
      <td>".$row['maatschappijcode']."</td>
      "
      
      ;  
      $data.="</tr>";
    }
    return $data;
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
            <li class="navLink"><a href="login.php">Uitloggen</a></li>
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
                                <form action="vluchtenOverzicht.php" method="POST">
                                    <input type="submit" name="Tijd" value="Tijd">
                                    <input type="submit" name="Vluchtmaatschappij" value="Vluchtmaatschappij">
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