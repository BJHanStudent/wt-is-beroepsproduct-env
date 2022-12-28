<?php 
session_start();
function loggedincheck() {
   if( $_SESSION['loggedin'] != true){
    header('Location: index.php');
   }
}


function generatenewID($table,$item){
    $newflightnumber = null;
    $conn = maakVerbinding();
    $sql = "SELECT max($item) from $table ";
    $stm = $conn->prepare($sql);
    $stm->execute();
    foreach($stm as $row){
        $newflightnumber = $row[0];
    }
   return $newflightnumber+1;
}



function addflight($bestemming,$gatecode,$max_aantal,$max_gewicht_pp,$max_totaalgewicht,$vertrektijd,$maatschappijcode){
    $conn = maakVerbinding();
    $vluchtnummer = generatenewID('vlucht','vluchtnummer');
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

function addpassenger($naam,$vluchtnummer,$geslacht,$balienummer,$stoel,$inchecktijdstip){
    $conn = maakVerbinding();
    $passagiernummer = generatenewID('Passagier','passagiernummer');
    $inchecktijdstip = date_create($inchecktijdstip);
    $inchecktijdstip= $inchecktijdstip->format('Y-m-d H:i:s');

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

function checkpassengerlimit($flight){
    $limit = null;
    $conn = maakVerbinding();
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




function addcase($passagiernummer,$bagagewicht){
    $conn = maakVerbinding();
    $objectvolgnummer = generatenewID('BagageObject','Objectvolgnummer');
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

function checkcargospace($passengernumber,$luggage){
    $weightlimit = null;
    $conn = maakVerbinding();
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


function getOverzicht($orderby =''){
    $conn = maakVerbinding();

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

?>