<!DOCTYPE html>
<html lang="en">
<?php

if (isset($_COOKIE["bericht"])) {
    echo $_COOKIE["bericht"];
}


session_start();
if (!isset($_SESSION["login"])) {
    header("location: Olympianlogin.php");
}
?>


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producten</title>
    <link rel="stylesheet" href="../css/olympianstylesheet.css">
    <style>
    /* TODO verwijderen */
        .image-containerProduct {
            position: relative;
            width: 300px;
            height: 300px;
            overflow: hidden;
            border: 1px solid #ddd;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .image-containerProduct img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hover-text {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 10px;
            font-size: 18px;
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 0 0 8px 8px;
        }

        .image-container:hover .hover-text {
            opacity: 1;
        }


        .verwijderen {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: gray;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            opacity: 0.9;

        }

        .verwijderen:hover {
            background-color: darkred;
            opacity: 1;
        }

        .veranderen {
            position: absolute;
            top: 10px;
            right: 12vw;
            background-color: gray;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            opacity: 0.9;

        }

        .veranderen:hover {
            background-color: darkred;
            opacity: 1;
        }

        .succesvol {
            bottom: 1200px;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            margin: 10px 0;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
            border: 1px solid #3e8e41;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            width: 80%;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            animation: slideIn 0.5s ease-in-out, bounceFade 2s forwards ease-in-out;
            position: sticky;
            top: 0;
            z-index: 1;
            pointer-events: none;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(20px) scale(0.9);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes bounceFade {

            0% {
                transform: translateY(0);
                opacity: 1;
            }

            20% {
                transform: translateY(-15px);
            }

            40% {
                transform: translateY(0);
            }

            60% {
                transform: translateY(-10px);
            }

            80% {
                transform: translateY(0);
            }

            100% {
                transform: translateY(0);
                opacity: 0;
                height: 0;
                width: 0;
                font-size: 0;
            }

        }

        div.saleContainer {
            position: relative;
            text-align: center;
            margin: none;

        }

        img.sale {
            width: 100%;
        }

        div.saleInfo {
            position: absolute;
            top: 30vh;
            color: black;
            font-size: xx-large;
        }

        table.ProductsTable {
            width: 90vw;
            height: 45vh;
            position: absolute;
            left: 5vw;
            border-spacing: 10px;
        }


        td.ProductsData {
            background-color: #EEC44C;
            text-align: center;
            max-width: 15vw;
            max-height: 15vh;
        }

        a.productsLink {
            color: black;
            text-decoration: none;
            border: black solid 1px;
            font-size: 6vw;
        }

        a#product {
            background-size: cover;
            transition: background-color 0.5s ease-in-out;
        }


        .product-gallery {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 20px;
        }

        .image-containerProduct {
            position: relative;
            width: 300px;
            height: auto;
            overflow: hidden;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s ease forwards;
            border: 1px solid #ddd;
        }

        .image-containerProduct img {
            width: 100%;
            height: auto;
            transition: transform 0.5s ease;
        }

        .image-containerProduct:hover img {
            transform: scale(1.1);
        }

        .hover-text {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 10px;
            box-sizing: border-box;
            text-align: center;
            opacity: 0;
            transform: translateY(100%);
            transition: transform 0.5s ease, opacity 0.5s ease;
        }

        .image-containerProduct:hover .hover-text {
            opacity: 1;
            transform: translateY(0);

        }

        @keyframes fadeIn {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Remove underline and style links */
        .image-link {
            text-decoration: none;
            width: 33px;
        }

        .image-containerProduct {
            position: relative;
            width: 300px;
            height: 300px;
            overflow: hidden;
            border: 1px solid #ddd;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .image-containerProduct img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hover-text {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 10px;
            font-size: 18px;
            text-align: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 0 0 8px 8px;
        }

        .image-containerProduct:hover .hover-text {
            opacity: 1;
        }

        .foto {
            display: inline-block;
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s ease;
            margin-left: 40vw;
        }

        .foto:hover {
            background-color: #45a049;
            /* Darker green on hover */
        }

        .foto:active {
            background-color: #388e3c;
            /* Even darker green on click */
        }

        @media(max-width: 600px) {

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

            .saleConatiner {
                display: none;
            }

            img.sale {
                width: 100%;
                height: auto;
                /* Maintain aspect ratio */
            }

            .saleInfo {
                position: absolute;
                bottom: 10px;
                /* Adjust position for better visibility */
                left: 0;
                right: 0;
                color: white;
                font-size: 20px;
                /* Adjust font size for mobile */
                background-color: rgba(0, 0, 0, 0.5);
                padding: 5px;
            }

            .product-gallery {
                display: flex;
                justify-content: center;
                flex-wrap: wrap;
                padding: 10px;
            }

            .image-containerProduct {
                position: relative;
                width: 90%;
                /* Responsive width */
                max-width: 300px;
                /* Limit max width */
                margin: 10px;
                overflow: hidden;
                border: 1px solid #ddd;
                box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
                border-radius: 8px;
            }

            .image-containerProduct img {
                width: 100%;
                height: 100%;
                /* Maintain aspect ratio */
                object-fit: cover;
                transition: transform 0.3s ease;
            }

            .image-containerProduct:hover img {
                transform: scale(1.1);
            }

            .hover-text {
                position: absolute;
                bottom: 0;
                left: 0;
                right: 0;
                background-color: rgba(0, 0, 0, 0.6);
                color: white;
                padding: 10px;
                font-size: 16px;
                /* Adjust font size */
                text-align: center;
                opacity: 0;
                transition: opacity 0.3s ease;
            }

            .image-containerProduct:hover .hover-text {
                opacity: 1;
            }



            @media (max-width: 768px) {
                .header {
                    font-size: 14px;
                    /* Smaller font size for mobile */
                }

                .saleInfo {
                    font-size: 18px;
                    /* Smaller font size for mobile */
                }

                .hover-text {
                    font-size: 14px;
                    /* Smaller hover text for mobile */
                }

                .image-containerProduct {
                    max-width: 90%;
                    /* More responsive width */
                }

                .veranderen {
                    position: absolute;
                    left: 5px;
                    width: fit-content;
                }
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

<body>
    <header>
        <a href="homepaginaOlympian.php"><img src="../foto/logoTransBackground.png" alt="Logo" class="logo"
                id="logo"></a>
        <a href="OlympianProducten.php" class="header" id="Producten">Producten</a>
        <a href="OlympianAanbieding.php" class="header" id="Aanbiedingen">Aanbiedingen</a>
        <a href="OlympianLogin.php" class="header" id="Inloggen">Inloggen</a>
        <a href="OlympianProductToevoegen.php" class="header" id="winkelmand">Toevoegen</a>
    </header>
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
                <div class='image-containerProduct'>
                    <img src='data:$mineType;base64,$safe' alt='$naam'>
                    <a class='veranderen' href='olympianVeranderen.php?productId=$id'>Veranderen</a>
                    <div class='hover-text'>$name, $informatie, €$kosten</div>
                    <a class='verwijderen' href='olympianVerwijderen.php?productId=$id'>Verwijderen</a>
                </div>
            ";
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
    <a href='foto.php' class='foto'>Maak een lijst van alle Producten</a>
</body>

</html>