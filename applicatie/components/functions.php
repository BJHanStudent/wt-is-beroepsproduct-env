<?php 
require_once('db_connectie.php');
session_start();
$conn = maakVerbinding();

function generatenewID($table,$item,$conn){
    $newflightnumber = null;
    $sql = "SELECT max($item) from $table ";
    $stm = $conn->prepare($sql);
    $stm->execute();
    foreach($stm as $row){
        $newflightnumber = $row[0];
    }
   return $newflightnumber+1;
}

function generatemessage($message,$error){
   if($error == false){
    echo "<div class='succesmessage'> <h2> ".$message."  </h2> </div>";
   }else{
    echo "<div class='errormessage'> <h2> ".$message."  </h2> </div>";;
   }
}

//====================================================================== 
//Functies voor login

function loggedincheck() {
   if( $_SESSION['loggedin'] != true){
    header('Location: index.php');
   }
}

function logout() {
    session_unset();
    session_destroy();
    header('Location: index.php');
 }


function checklogin($username,$password,$conn){
    $username = htmlspecialchars($username);
    $salt = 'hjiqjioqwpemkrpm2k34i9u0wefjiwmklenfmwkpa!@$%';
    $password = $password . $salt;
    $hashed = password_hash($password,PASSWORD_DEFAULT);
   // hashed'$2y$10$Lnb49KCskoQSF3mvoAA0hOOHT2JI.pwOiNLhANLjmV4odvgel/eDm'; //Test@2001testhjiqjioqwpemkrpm2k34i9u0wefjiwmklenfmwkpa!@$%
if(password_verify($password,$hashed)){
    $sql = "SELECT Uid from Medewerkers where naam = :username and password = :password ";
    $stm = $conn->prepare($sql);
    if($stm->execute([
        'username'=> $username,
        'password'=> $hashed
    ])){
      $_SESSION['loggedin'] = true;
      header('Location: medewerkersPortal.php');
    }
}
}

//======================================================================
//Functie voor toevoegen vlucht


function addflight($bestemming,$gatecode,$max_aantal,$max_gewicht_pp,$max_totaalgewicht,$vertrektijd,$maatschappijcode,$conn){
    $vluchtnummer = generatenewID('vlucht','vluchtnummer',$conn);
    $vertrektijd = date_create($vertrektijd);
    $vertrektijd = $vertrektijd->format('Y-m-d H:i:s');

    $sql = "INSERT INTO vlucht (vluchtnummer,bestemming,gatecode,max_aantal,max_gewicht_pp,max_totaalgewicht,vertrektijd,maatschappijcode)
    VALUES (:vluchtnummer,:bestemming,:gatecode,:max_aantal,:max_gewicht_pp,:max_totaalgewicht,:vertrektijd,:maatschappijcode)";
    $stm = $conn->prepare($sql);
    $stm->execute([
        "vluchtnummer"=>$vluchtnummer,
        "bestemming" =>$bestemming,
        "gatecode"=> $gatecode,
        "max_aantal"=> $max_aantal,
        "max_gewicht_pp"=> $max_gewicht_pp,
        "max_totaalgewicht"=> $max_totaalgewicht,
        "vertrektijd"=> $vertrektijd,
        "maatschappijcode"=>$maatschappijcode
    ]
    );
}

//======================================================================
//Functies voor toevoegen passagiers

function addpassenger($naam,$vluchtnummer,$geslacht,$balienummer,$stoel,$inchecktijdstip,$conn){
    $passagiernummer = generatenewID('Passagier','passagiernummer',$conn);
    $inchecktijdstip = date_create($inchecktijdstip);
    $inchecktijdstip = $inchecktijdstip->format('Y-m-d H:i:s');

    $sql = "INSERT INTO Passagier (passagiernummer,naam,vluchtnummer,geslacht,balienummer,stoel,inchecktijdstip)
    VALUES (:passagiernummer,:naam,:vluchtnummer,:geslacht,:balienummer,:stoel,:inchecktijdstip)";
    $stm = $conn->prepare($sql);
    $stm->execute([
        "passagiernummer"=>$passagiernummer,
        "naam"=>$naam,
        "vluchtnummer" =>$vluchtnummer,
        "geslacht"=> $geslacht,
        "balienummer"=> $balienummer,
        "stoel"=> $stoel,
        "inchecktijdstip"=> $inchecktijdstip,
    ]
    );
}

function checkpassengerlimit($flight,$conn){
    $limit = null;
    $sql = "select Vlucht.max_aantal - count(*) from Passagier
    join Vlucht on  Passagier.vluchtnummer = Vlucht.vluchtnummer 
    where Passagier.vluchtnummer = ".$flight."
    group by Vlucht.max_aantal";
    $stm = $conn->prepare($sql);
    $stm->execute([]
    );
    foreach($stm as $row){
        $limit = $row[0];
    }
    return $limit;

 }

//======================================================================
//Functie voor toevoegen bagage


function addcase($passagiernummer,$bagagewicht,$conn){
    $objectvolgnummer = generatenewID('BagageObject','Objectvolgnummer',$conn);
    $sql = "INSERT INTO BagageObject (passagiernummer,objectvolgnummer,gewicht)
    VALUES (:passagiernummer,:objectvolgnummer,:bagagewicht)";
    $stm = $conn->prepare($sql);
    $stm->execute([
        "passagiernummer"=>$passagiernummer,
        "bagagewicht"=>$bagagewicht,
        "objectvolgnummer" =>$objectvolgnummer,
    ]
    );
}

function checkcargospace($passengernumber,$luggage,$conn){
    $weightlimit = null;
    $sql = "select Vlucht.vluchtnummer from Vlucht
    join Passagier on Passagier.vluchtnummer = Vlucht.vluchtnummer 
    where Passagier.passagiernummer = ".$passengernumber."";
    $stm = $conn->prepare($sql);
    $stm->execute([]);
    foreach($stm as $row){
        $flightnumber = $row[0];
        $sql = "
        select Vlucht.max_totaalgewicht - sum(BagageObject.gewicht) from Passagier
        join Vlucht on  Passagier.vluchtnummer = Vlucht.vluchtnummer 
        join BagageObject on BagageObject.passagiernummer = Passagier.passagiernummer
        where Passagier.vluchtnummer = ".$flightnumber."
        group by Vlucht.max_totaalgewicht";
        $stm = $conn->prepare($sql);
        $stm->execute([]);
        foreach($stm as $row){
            $weightlimit = $row[0] - $luggage;
        }
    }
    return $weightlimit;
 }


 //======================================================================
 //Functie voor ophalen vlucht gegevens

 function getflightdetails($flightnumber,$conn){
    $sql = "SELECT * FROM  Vlucht where vluchtnummer = :vluchtnummer ";
    $stm = $conn->prepare($sql);
    $data = "";
    $stm->execute([
        "vluchtnummer"=>$flightnumber
    ]
    );
    
    foreach($stm as $row){
        $data.= "<ul>
        <li>".$row['vluchtnummer']."</li>
        <li>".$row['bestemming']."</li>
        <li>".$row['gatecode']."</li>
        <li>".$row['max_aantal']."</li>
        <li>".$row['max_gewicht_pp']."</li>
        <li>".$row['max_totaalgewicht']."</li>
        <li>".$row['vertrektijd']."</li>
        <li>".$row['maatschappijcode']."</li>
        "
        ;  
        $data.="</ul>";
      }
      return $data;
}



function getflightoverview($conn,$orderby =''){

    $sql = "SELECT * FROM Vlucht ";
    if ($orderby == 'maatschappijcode'){
        $sql.= "order by ".$orderby." ";
    }else if($orderby == 'vertrektijd'){
        $sql.= "order by ".$orderby." desc ";
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

//======================================================================

?>