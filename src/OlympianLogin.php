<!DOCTYPE html>
<html lang="en">
<?php
session_start();
$method = $_SERVER["REQUEST_METHOD"];

if (isset($_COOKIE["bericht"])) {
    echo $_COOKIE["bericht"];
}

if ($method == "POST" && isset($_POST["gebruikersnaam"])) {
    try {


        $host = "localhost";
        $usernameDB = "root";
        $passwordDB = "";
        $database = "2ste";
        $connection = new mysqli($host, $usernameDB, $passwordDB, $database);
        if ($connection->connect_error) {
            throw new Exception($connection->connect_error);
        }


        $query = "SELECT * FROM gebruikers WHERE gebruikersnaam = ?";

        $statement = $connection->prepare($query);

        $password = $_POST["wachtwoord"];

        $username = htmlspecialchars($_POST["gebruikersnaam"]);

        $statement->bind_param("s", $username);

        if (!$statement->execute()) {
            throw new Exception($connection->error);
        }


        $statement->bind_result($id, $name, $email, $dbWachtwoord);



        $databasenaam = "<error>";
        $databaseWachtwoord = "<error>";


        while ($statement->fetch()) {
            $databasenaam = $name;
            $databaseWachtwoord = $dbWachtwoord;
        }

        if ($databasenaam == "<error>") {
            setcookie("bericht", "<div class=waarschuwing> Uw gebruikersnaam is niet gevonden </div>", time() + 2);
            header("location: OlympianLogin.php");
        } elseif (!password_verify($password, $databaseWachtwoord)) {
            setcookie("bericht", "<div class=waarschuwing>Het wachtwoord is incorrect</div>", time() + 2);
            header("location: OlympianLogin.php");
        } else {
            header("location: homepaginaOlympian.php");
            $_SESSION["login"] = $databasenaam;
        }
    } catch (Exception $e) {
        echo "De error is " . $e->getMessage();
    } finally {

        if ($connection) {
            $connection->close();
        }

        if ($statement) {
            $statement->close();
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
    <link rel="stylesheet" href="../css/OlympianStyleSheet.css">
    <style>
        /* TODO verwijderen */
        div.waarschuwing {
            border: 1px solid black;
            padding: 10px;
            background-color: red;
            color: white;
            position: absolute;
            top: 25vw;
            left: 25vw;
            width: 50vw;
            height: 10vh;
            text-align: center;
        }

        form.Regristreren {
            position: absolute;
            border-radius: 10px;
            width: 80vw;
            left: 10vw;
            display: flex;
            flex-direction: column;
            transform: translateY(30px);
            animation: fadeIn 1s ease forwards;
        }


        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .Regristreren label {
            margin-top: 1em;
        }

        .Regristreren input {
            padding: 0.5em;
            margin-top: 0.5em;
            border: 2px solid #D78E5B;
            background-color: #D78E5B;
            border-radius: 100px;
            font-size: x-large;
        }

        .Regristrereninput:focus {
            outline: none;
            border-color: #EEC44C;
        }

        .Regristreren button {
            margin-top: 1.5em;
            padding: 0.75em;
            background-color: #f44336;
            color: #D78E5B;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }


        .loginLink {
            text-decoration: none;
            color: black;
            margin-top: 10px;
            display: block;
            text-align: center;
            transition: color 0.3s;
            font-size: x-large;
        }

        .loginLink:hover {
            color: darkgray;
        }


        div.waarschuwing {
            border: 2px solid #b52e2e;
            padding: 20px;
            background-color: #f8d7da;
            color: #721c24;
            position: fixed;
            top: 80%;
            left: 50%;
            transform: translate(-50%, -50%);
            max-width: 80vw;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 8px;
            line-height: 1.5;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }

        div.waarschuwing::before {
            content: '⚠️';
            font-size: 2rem;
        }

        div.waarschuwing::after {
            content: '⚠️';
            font-size: 2rem;
        }

        input[type="submit"] {
            background: linear-gradient(90deg, #D78E5B 50%, transparent 50%);
            transition: background-position 0.5s ease;
            background-size: 200%;
        }

        input[type="submit"]:hover {
            background-position: 100%;
        }

        input:invalid {
            border: 2px dashed red;
            color: #900;
        }

        input:invalid:focus {
            border-color: darkred;
            box-shadow: 0 0 5px rgba(255, 0, 0, 0.5);
        }

        input:valid {
            border: 2px dashed green;
            color: #333;
        }

        input:valid:focus {
            box-shadow: 0 0 5px rgba(0, 255, 0, 0.5);
        }

        @media(max-width: 600px) {
            body {
                font-family: Arial, sans-serif;
                background-color: #66817C;
                margin: 0;
            }

            header {
                display: flex;
                flex-direction: column;
                align-items: center;
                background-color: #4CAF50;
                padding: 10px 0;
                background-color: #66817C;
            }

            .logo {
                width: 80%;
                max-width: 200px;
            }

            .header {
                color: white;
                text-decoration: none;
                padding: 10px;
                font-size: 16px;

            }

            .header:hover {
                background-color: rgba(255, 255, 255, 0.2);
            }

        }
    </style>

    <script>
        onload = function () {
            const buttonProducten = document.getElementById("Producten");

            buttonProducten.onmouseover = function () {
                buttonProducten.textContent = "";
                console.log('yipee :>')
            }

            buttonProducten.onmouseout = function () {
                buttonProducten.textContent = "Producten";  // Resets the text
                console.log('yipee :> pt.2')
            }

            const buttonAanbiedingen = document.getElementById("Aanbiedingen");

            buttonAanbiedingen.onmouseover = function () {
                buttonAanbiedingen.textContent = "";
                console.log('yipee :>')
            }

            buttonAanbiedingen.onmouseout = function () {
                buttonAanbiedingen.textContent = "Aanbiedingen";  // Resets the text
                console.log('yipee :> pt.2')
            }


            const buttonLogIn = document.getElementById("Inloggen");

            buttonLogIn.onmouseover = function () {
                buttonLogIn.textContent = "";
                console.log('yipee :>')
            }

            buttonLogIn.onmouseout = function () {
                buttonLogIn.textContent = "Inloggen";  // Resets the text
                console.log('yipee :> pt.2')
            }



            const buttonWinkelmand = document.getElementById("winkelmand");

            buttonWinkelmand.onmouseover = function () {
                buttonWinkelmand.textContent = "";
                console.log('yipee :>')
            }

            buttonWinkelmand.onmouseout = function () {
                buttonWinkelmand.textContent = "Toevoegen";
                console.log('yipee :> pt.2')
            }

            logo.addEventListener('mouseover', function () {
                logo.style.transform = 'rotate(360deg)';
            });

            logo.addEventListener('mouseout', function () {
                logo.style.transform = 'rotate(0deg)';
            });
        }

    </script>
</head>
<header>
    <a href="homepaginaOlympian.php"><img src="../foto/logoTransBackground.png" alt="Logo" class="logo" id="logo"></a>
    <a href="OlympianProducten.php" class="header" id="Producten">Producten</a>
    <a href="OlympianAanbieding.php" class="header" id="Aanbiedingen">Aanbiedingen</a>
    <a href="OlympianLogin.php" class="header" id="Inloggen">Inloggen</a>
    <a href="OlympianProductToevoegen.php" class="header" id="winkelmand">Toevoegen</a>
</header>


<form location="OlympianRegristreren.php" method="POST" class="Regristreren">
    <label>Naam</label>
    <input type="text" name="gebruikersnaam" required>
    <label>Wachtwoord</label>
    <input type="password" name="wachtwoord" minlength="6" required>
    <input type="submit" value="Log in">
    <a href="OlympianRegristreren.php" class="loginLink">Regristreren</a>
</form>

<body>

</body>

</html>