<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: Olympianlogin.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<style>
    .foto {
        display: inline-block;
        background-color: #3D6B13;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s ease;
        margin-left: 45vw;
        transition: background-color 0.4s ease, transform 0.4s ease, box-shadow 0.4s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        position: absolute;
        overflow: hidden;
    }

    .foto:hover {
        background-color: #45a049;
    }

    .foto:active {
        background-color: #388e3c;

    }

    .foto::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.3);
        transition: left 0.4s ease;
    }

    .foto:hover {
        background-color: #1A4D08;
        /* Darker green on hover */
        transform: scale(1.05);
        /* Keep it centered during hover */
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        /* Increase shadow */
    }

    .foto:hover::before {
        left: 100%;
        /* Create a shine effect */
    }

    .foto:active {
        transform: scale(0.98);
        /* Keep it centered during click */
    }
</style>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../css/OlympianStyleSheet.css">
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
    <a href="OlympianAanbieding.php">
        <div class="saleConatiner">
            <img src="../foto/image.png" alt="sale" class="sale">
            <div class="saleInfo">Dit is info over de geweldige aanbiedingen!</div>
        </div>
    </a>

    <div class="product-gallery">
        <?php
        try {
            $host = "localhost";
            $passwordDB = "root";
            $usernameDB = "";
            $database = "2ste";
            $connection = new mysqli($host, $passwordDB, $usernameDB, $database);

            if ($connection->connect_error) {
                throw new Exception($connection->connect_error);
            }

            $query = "SELECT * FROM olympianlocatie";
            $statement = $connection->prepare($query);

            if (!$statement->execute()) {
                throw new Exception($connection->connect_error);
            }

            $statement->bind_result($id, $naam, $kosten, $info, $mineType, $afbeelding);

            while ($statement->fetch()) {
                $safe = base64_encode($afbeelding);
                $name = ucfirst($naam);
                $informatie = ucfirst($info);

                echo "
                <div class='image-container'>
                    <img src='data:$mineType;base64,$safe' alt='$naam' class='productFoto'>
                    <div class='hover-text'>$name, $informatie, €$kosten</div>
                </div>
            ";
            }

            if (isset($_COOKIE["bericht"])) {
                echo $_COOKIE["bericht"];
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
        ?>

    </div>
    <a href='OlympianKlacht.php' class='foto'>Voer uw klacht hier in</a>
</body>

</html>