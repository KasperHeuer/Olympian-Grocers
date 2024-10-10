<?php
require '../vendor/autoload.php';
use Dompdf\Dompdf;
ob_start();
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
            <div class='hover-text'>$name, $informatie, €$kosten</div>
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

$html = ob_get_clean();

$dompdf = new Dompdf();
$dompdf->loadHtml($html, 'UTF-8');

ini_set('memory_limit', '256M');


$dompdf->setPaper('A4', 'landscape');

$dompdf->render();

$dompdf->stream("sample.pdf", array("Attachment" => 0)); // Display in browser
?>