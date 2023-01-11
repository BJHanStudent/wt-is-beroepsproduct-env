<?php 
 require_once('db_connectie.php');
 require_once('./components/functions.php');
 $message = '';

if(isset($_POST['bagageinchecken'])){
    if(checkcargospace($_POST['passagiernummer'],$_POST['bagagegewicht'],$conn) > 0){
        addcase(
            $_POST['passagiernummer'],
            $_POST['bagagegewicht'],$conn);
            $message = generatemessage("Bagage toegevoegd", false);
    }else {
        $message = generatemessage("Er is geen ruimte meer voor bagage", true);
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
        <div>
            <ul>
                <li>
                    <h2 class="MainTitel">Gelre Airport</h2>
                </li>
                <li class="navLink"><a href="index.php">Home</a></li>
            </ul>
        </div>
    </nav>
    <main>
        <?= $message ?>
        <form action="bagageInchecken.php" method="post">
            <div class="container">
                <h2>Bagage inchecken</h2>
                <input type="text" name="passagiernummer" placeholder="passagiernummer" required><br>
                <label for="Bagagegewicht">Gewicht</label>
                <select name="bagagegewicht" id="Bagagegewicht">
                    <option value="10">10kg</option>
                    <option value="20">20kg</option>
                    <option value="30">30kg</option>
                </select>
                <input type="submit" name="bagageinchecken" value="Check in">
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