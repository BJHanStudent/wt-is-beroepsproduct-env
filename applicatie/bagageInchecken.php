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
        <form action="medewerkersPortal.html" method="post">
            <div class="container">
                <h2>Bagage inchecken</h2>
                <input type="text" name="vluchtnummer" placeholder="Vluchtnummer" required><br>
                <input type="text" name="Ticketnummer" placeholder="Ticketnummer" required><br>
                <label for="Bagagegewicht">Gewicht</label>
                <select name="Bagagegewicht" id="Bagagegewicht">
                    <option value="10">10kg</option>
                    <option value="20">20kg</option>
                    <option value="30">30kg</option>
                </select>
                <label for="Bagagehoeveelheid">Aantal koffers</label>
                <select name="Bagagehoeveelheid" id="Bagagehoeveelheid">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
                <input type="submit" name="Passagierinvoeren" value="Check in">
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