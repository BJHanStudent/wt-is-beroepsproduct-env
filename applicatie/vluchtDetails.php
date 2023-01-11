<?php  
require_once('./components/functions.php');
$data = getflightdetails($_POST['vluchtnummer'],$conn);

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
        <div class="flightDetails">
            <h1>Vlucht details</h1>
            <img src="images/PlaneToDestination.png" alt="">
            <h4> AMS 9:45 MRS 10:45</h4>
            <hr>
        <?= $data ?>
        </div>
    </main>
    <footer>
        <ul>
            <li>
                <a href="privacyVerklaring.php">Privacy verklaring</a>
            </li>
            <li>
                <a href="#">Copyright Gelere Airport 2022</a>
            </li>
        </ul>
    </footer>
</body>

</html>