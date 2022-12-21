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
        <form class="loginform" action="medewerkersPortal.php" method="post">
            <div class="container">
                <h2>Vul gegevens in</h2>
                <input type="text" name="vluchtnummer" placeholder="vluchtnummer" required><br>
                <input type="text" name="vliegmaatschappij" placeholder="Vliegmaatschappij" required><br>
                <input type="text" name="verteklocatie" placeholder="Verteklocatie" required><br>
                <input type="text" name="Bestemming" placeholder="Bestemming" required><br>
                <input type="date" name="Vertrekdatum" required><br>
                <input type="submit" name="Vluchtophalen" value="Vlucht invoeren">
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