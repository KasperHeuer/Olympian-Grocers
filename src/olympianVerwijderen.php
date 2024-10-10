<?php
try {
    session_start();
    if (!isset($_SESSION["login"])) {
        header("location: Olympianlogin.php");
    }
    $host = "localhost";
    $usernameDB = "root";
    $passwordDB = "";
    $database = "2ste";
    $productId = $_GET["productId"];
    $connection = new mysqli($host, $usernameDB, $passwordDB, $database);
    if ($connection->connect_error) {
        throw new Exception($connection->connect_error);
    }
    $query = "DELETE FROM olympianlocatie WHERE productId = ?";
    $statement = $connection->prepare($query);
    $statement->bind_param("i", $productId);
    if (!$statement->execute()) {
        throw new Exception($connection->connect_error);
    }

    header("location: OlympianProducten.php");
    setcookie("bericht", "<div class=succesvol>Succesvolle verwijdering</div>", time() + 2);
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