<?php
session_start();
if (!isset($_SESSION["login"])) {
    header("location: Olympianlogin.php");
}
?>
<link rel="stylesheet" href="../css/OlympianStyleSheet.css">
<style>
    body {
        font-family: 'Times New Roman', Times, serif;
    }

    h1 {
        text-align: center;
        color: #D78E5B;
        margin-top: 20px;
    }

    .update {
        margin: 50px auto;
        padding: 20px;
        background-color: #66817C;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #EEC44C;
    }

    input[type="text"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #D78E5B;
        border-radius: 5px;
        font-size: 14px;
        transition: border-color 0.3s ease;
        background-color: white;
    }

    input[type="text"]:focus {
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

    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }
</style>

<?php
$method = $_SERVER["REQUEST_METHOD"];
$host = "localhost";
$usernameDB = "root";
$passwordDB = "";
$database = "2ste";
try {
    if ($method == "GET") {
        if (isset($_GET["productId"])) {
            $productId = $_GET["productId"];
            $productNaam = "<error>";
            $productKosten = "<error>";
            $productInfo = "<error>";
            $connection = new mysqli($host, $usernameDB, $passwordDB, $database);
            if ($connection->connect_error) {
                throw new Exception($connection->connect_error);
            }
            $query = "SELECT * FROM olympianlocatie WHERE productId = ?";
            $statement = $connection->prepare($query);
            $statement->bind_param("i", $productId);
            $statement->bind_result($DBid, $DBnaam, $DBkosten, $DBinfo, $mimeType, $abeelding);
            if (!$statement->execute()) {
                throw new Exception($connection->error);
            }

            while ($statement->fetch()) {
                $id = $DBid;
                $naam = $DBnaam;
                $kosten = $DBkosten;
                $info = $DBinfo;
            }
        } else {
            header("location: OlympianProducten.php");
        }
    } else if ($method = "POST") {
        if (isset($_POST["id"])) {
            $postId = $_POST["id"];
            $postNaam = $_POST["naam"];
            $postKosten = $_POST["kosten"];
            $postInfo = $_POST["Info"];


            $connection = new mysqli($host, $usernameDB, $passwordDB, $database);

            if ($connection->connect_error) {
                throw new Exception($connection->connect_error);
            }

            $query = "UPDATE olympianlocatie SET productNaam = ?, productKosten = ?, productInfo = ? WHERE productId  = ?";
            $statement = $connection->prepare($query);
            $statement->bind_param("ssss", $postNaam, $postKosten, $postInfo, $postId);
            if (!$statement->execute()) {
                throw new Exception($connection->error);
            }
            header("location: OlympianProducten.php");
            setcookie("bericht", "<div class=succesvol>Succesvolle veranderd</div>", time() + 2);
        }
    }

} catch (Exception $e) {
    echo "De error is " . $e->getMessage();
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
</head>

<body>
    <form action="olympianVeranderen.php" method="POST" class="update">
        <h1> Veranderen</h1>
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label>Naam</label>
        <input type="text" name="naam" placeholder="Naam" value="<?php echo $naam; ?>" required maxlength="30"><br>
        <label>Kosten</label>
        <input type="text" name="kosten" placeholder="Kosten" value="<?php echo $kosten; ?>" required maxlength="7"><br>
        <label>Info</label>
        <input type="text" name="Info" placeholder="Info" value="<?php echo $info; ?>" required maxlength="30"><br>
        <input type="submit" value="Veranderen">
    </form>
</body>

</html>