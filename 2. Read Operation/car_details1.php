<?php

$pdo = new PDO('mysql:host=localhost;port=3306;dbname=AUTOS', 'bhargavram', 'autos');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$valid_request = false;
$car_details = array();

if (isset($_GET["car_id"])) {
    $valid_request = true;
    $stmt = $pdo->query("SELECT * FROM CARS where car_id = " .  $_GET["car_id"]);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($car_details, $row);
    };
}
?>
<html>

<head></head>

<body>
    <?php if ($valid_request) : ?>
        <?php if ($car_details) : ?>
            <?php
            echo ("<pre>");
            print_r($car_details);
            echo ("</pre>");
            ?>
        <?php else : ?>
            <h1 style="color: red;">Car details not found for <?= htmlentities($_GET["car_id"]) ?></h1>
        <?php endif ?>
    <?php else : ?>
        <h1 style="color: red;">Invalid Request URL - ID not found.</h1>
    <?php endif ?>

</body>

</html>