<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: Olympianlogin.php");
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$method = $_SERVER['REQUEST_METHOD'];

if ($method == "POST" && isset($_POST["naam"])) {
    require "../vendor/autoload.php";

    $mail = new PHPMailer(true);

    try {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->safeLoad();

        $PriveEmail = $_ENV["Email"];
        $PriveWachtwoord = $_ENV["Wachtwoord"];

        // Als error un-comment dit
        // $mail->SMTPDebug = 2;
        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;

        $mail->Username = $PriveEmail;
        $mail->Password = $PriveWachtwoord;

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $zeikerNaam = $_POST["naam"];
        $zeikerEmail = $_POST["email"];
        $zeikerKlacht = $_POST["klacht"];

        $mail->setFrom($PriveEmail, "Olympian Grocers");
        $mail->addAddress($zeikerEmail, $zeikerNaam);

        $mail->isHTML(true);

        $mail->Subject = "U heeft een klacht over Olympian Grocers verzonden";

        $mail->Body = "Uw klacht <br>" . $zeikerKlacht . "<br> is verzonden, onze exuses voor uw probleem en wij proberen zo snel mogelijk te reageren.";

        $mail->AltBody = "Er is recent een error gebeurt, graag geduld hebben.";

        $mail->send();

        header("location: homepaginaOlympian.php");

    } catch (Exception $e) {
        echo "er is een error" . $mail->ErrorInfo;
    }
}

?>

<!DOCTYPE html>
<html lang="en">



<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Klacht</title>
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
    <form action="OlympianKlacht.php" method="POST" class="Klacht">
        <label>Uw naam</label>
        <input type="text" name="naam" class="klachtInput" required>
        <label>Uw Email</label>
        <input type="email" name="email" class="klachtInput" required>
        <label>Uw klacht</label>
        <input type="klacht" name="klacht" class="klachtInput" required>
        <input type="submit" value="send">
    </form>
</body>

</html>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #66817C;
        margin: 0;
    }

    form.Klacht {
        background-color: #fff;
        border-radius: 10px;
        width: 80vw;
        max-width: 500px;
        padding: 20px;
        margin: 50px auto;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        animation: fadeIn 1s ease forwards;
    }

    .Klacht label {
        margin-top: 1em;
        font-weight: bold;
    }

    .klachtInput {
        padding: 0.5em;
        margin-top: 0.5em;
        border: 2px solid #D78E5B;
        border-radius: 5px;
        font-size: 1rem;
    }

    .klachtInput:focus {
        outline: none;
        border-color: #EEC44C;
        box-shadow: 0 0 5px rgba(238, 196, 76, 0.5);
    }

    input[type="submit"] {
        margin-top: 1.5em;
        padding: 0.75em;
        background-color: #D78E5B;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    input[type="submit"]:hover {
        background-color: #C0392B;
        transform: translateY(-2px);
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

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }



    @media(max-width: 600px) {
        .Klacht {
            width: 90vw;
        }
    }
</style>