<?php
if (isset($_POST["productName"])) {

    try {
        $host = "localhost";
        $passwordDB = "root";
        $usernameDB = "";
        $database = "2ste";
        $connection = new mysqli($host, $passwordDB, $usernameDB, $database);
        if ($connection->connect_error) {
            throw new Exception($connection->connect_error);
        }
        $query = "INSERT INTO olympianlocatie(productNaam, productKosten, productInfo, mineType, afbeelding) VALUES (?,?,?,?,?)";
        $binary = file_get_contents($_FILES["afbeelding"]["tmp_name"]);
        $mimeType = $_FILES["afbeelding"]["type"];

        $statement = $connection->prepare($query);
        $statement->bind_param("ssssb", $_POST["productName"], $_POST["kosten"], $_POST["Info"], $mimeType, $niks);
        $statement->send_long_data(4, $binary);
        if (!$statement->execute()) {
            throw new Exception($connection->connect_error);
        }

    } catch (Exception $e) {
        echo "dit is de error " . $e->getMessage();
        die;
    } finally {
        if ($connection) {
            $connection->close();
        }
        if ($statement) {
            $statement->close();
        }
        setcookie("bericht", "<div class=succesvol>Succesvolle toegevoegd </div>", time() + 2);
        exit(header("location: OlympianProducten.php"));

    }

}

session_start();
if (!isset($_SESSION["login"])) {
    header("location: Olympianlogin.php");
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toevoegen</title>
    <link rel="stylesheet" href="../css/OlympianStyleSheet.css">
    <style>
     
        header {
            display: flex;
            padding-bottom: 3px;
            border-bottom: black 1px solid;
        }

        a.header {
            color: black;
            background-color: #D78E5B;
            margin-left: 25px;
            width: 150px;
            text-align: center;
            padding: 5vh 0px;
            text-decoration: none;
            font-size: 20px;
            border-radius: 100px;
        }

        img.logo {
            width: 50vw;
            animation: flip 4s infinite linear;
        }

        @keyframes flip {
            0% {
                transform: rotateY(0deg);
            }

            100% {
                transform: rotateY(360deg);
            }
        }

        form.toevoegen {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #66817C;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #D78E5B;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #EEC44C;
        }

        input[type="text"],
        input[type="file"] {
            width: 95%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #D78E5B;
            border-radius: 5px;
            font-size: 14px;
            transition: border-color 0.3s ease;
            background-color: white;
        }

        input[type="text"]:focus,
        input[type="file"]:focus {
            border-color: #EEC44C;
            outline: none;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #D78E5B;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #C97A4B;
        }

        form.toevoegen {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeSlideIn 0.5s forwards ease-in-out;
        }

        @keyframes fadeSlideIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        input[type="submit"] {
            background: linear-gradient(90deg, #D78E5B 50%, transparent 50%);
            transition: background-position 0.5s ease;
            background-size: 200%;
        }

        input[type="submit"]:hover {
            background-position: 100%;
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
                /* Responsive logo size */
                max-width: 200px;
                /* Limit the maximum size */
            }

            .header {
                color: white;
                text-decoration: none;
                padding: 10px;
                font-size: 16px;
                /* Adjust font size */
            }

            .header:hover {
                background-color: rgba(255, 255, 255, 0.2);
            }
        }
    </style>
    <script>
        onload = function () {
            logo.addEventListener('mouseover', function () {
                logo.style.transform = 'rotate(360deg)'; /* Rotate 360 degrees */
            });

            logo.addEventListener('mouseout', function () {
                logo.style.transform = 'rotate(0deg)'; /* Reset rotation */
            });
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



            document.querySelectorAll('.image-container').forEach(container => {
                container.addEventListener('mouseover', () => {
                    const hoverText = container.querySelector('.hover-text');
                    hoverText.style.display = 'block'; // Show text on hover
                });

                container.addEventListener('mouseout', () => {
                    const hoverText = container.querySelector('.hover-text');
                    hoverText.style.display = 'none';
                });
            });
            logo.addEventListener('mouseover', function () {
                logo.style.transform = 'rotate(360deg)';
            });

            logo.addEventListener('mouseout', function () {
                logo.style.transform = 'rotate(0deg)';
            });

        }
    </script>

</head>

<body>

    <header>
        <a href="homepaginaOlympian.php"><img src="../foto/logoTransBackground.png" alt="Logo" class="logo"
                id="logo"></a>
        <a href="OlympianProducten.php" class="header" id="Producten">Producten</a>
        <a href="OlympianAanbieding.php" class="header" id="Aanbiedingen">Aanbiedingen</a>
        <a href="OlympianLogin.php" class="header" id="Inloggen">Inloggen</a>
        <a href="OlympianProductToevoegen.php" class="header" id="winkelmand">Toevoegen</a>
    </header>

    <form location="OlympianProductToevoegen.php" method="post" class="toevoegen" enctype="multipart/form-data">
        <h1>Toevoegen</h1>
        <label>Naam</label>
        <input type="text" name="productName" required maxlength="30">
        <label>Kosten</label>
        <input type="text" name="kosten" required maxlength="7">
        <label>Info</label>
        <input type="text" name="Info" required maxlength="30">
        <label>Afbeelding toevoegen</label>
        <input type="file" name="afbeelding" required>
        <input type="submit" value="Toevoegen">
    </form>

</body>


</html>