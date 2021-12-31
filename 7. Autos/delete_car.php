<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=AUTOS', 'bhargavram', 'autos');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();

$valid_request = false;
$message = "";
$car_details = array();

if (isset($_SESSION["status"]) && $_SESSION["status"] === 1) {
    if (isset($_GET["car_id"])) {
        $sql = "SELECT * FROM CARS where car_id = :car_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":car_id" => $_GET["car_id"]));
        $car_details = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($car_details) {
            $valid_request = true;
            // Record can be deleted from database
        } else {
            $message = "Car details not found for " . htmlentities($_GET["car_id"]);
        }
    } else {
        $message = "Invalid Request URL - ID not found.";
    }

    if ($valid_request) {
        // Deleting
        $sql = "DELETE FROM CARS where car_id = :car_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":car_id" => $_GET["car_id"]));
        $message = "Deleted car " . $car_details["car_name"] . " with ID " . $car_details["car_id"];
        header("location: index.php");
        return;
    }
} else {
    die("Access deined");
}
?>
<html>

<head></head>

<body>
    <?php if ($valid_request) : ?>
        <h1 style="color: blue;"><?= $message ?></h1>
    <?php else : ?>
        <h1 style="color: red;"><?= $message ?></h1>
    <?php endif ?>

</body>

</html>