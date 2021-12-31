<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=AUTOS', 'bhargavram', 'autos');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$cars_array = array();
$stmt = $pdo->query("SELECT * FROM CARS");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($cars_array, $row);
}

// echo("<pre>");
// print_r($cars_array);
// echo("</pre>");
?>
<html>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Company</th>
                <th>Year</th>
                <th>Price</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cars_array as $car) : ?>
                <tr>
                    <td>
                        <?= $car["car_id"] ?>
                    </td>
                    <td>
                        <?= $car["car_name"] ?>
                    </td>
                    <td>
                        <?= $car["car_company"] ?>
                    </td>
                    <td>
                        <?= $car["car_year"] ?>
                    </td>
                    <td>
                        <?= $car["car_price"] ?>
                    </td>
                    <td>
                        <a href=<?= "\"delete_car.php?car_id=" . $car["car_id"] . "\""  ?>>Delete <?= $car["car_name"] ?></a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</body>

</html>