<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=AUTOS', 'bhargavram', 'autos');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();

$valid_request = false;
$car_details = array();

if (isset($_SESSION["status"]) && $_SESSION["status"] === 1) {
    if (isset($_GET["car_id"])) {
        $sql = "SELECT * FROM CARS where car_id = :car_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":car_id" => $_GET["car_id"]));
        $car_details = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($car_details) {
            if($car_details["user_id"] ===  $_SESSION["user_id"]) {
                $valid_request = true;
                // Record can be deleted from database
            }
            else {
                die("Access deined");
            }
        } else {
            $_SESSION["message"] = "Car details not found for " . htmlentities($_GET["car_id"]);
            header("location: index.php");
            return;
        }
    } else {
        $_SESSION["message"] = "Invalid Request URL - ID not found.";
        header("location: index.php");
        return;
    }

    if ($valid_request) {
        // Deleting
        $sql = "DELETE FROM CARS where car_id = :car_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":car_id" => $_GET["car_id"]));
        $_SESSION["message"] = "Deleted car " . $car_details["car_name"] . " with ID " . $car_details["car_id"];
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
</body>

</html>