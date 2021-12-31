<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=AUTOS', 'bhargavram', 'autos');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$cars_array = array();

$stmt = $pdo->query("SELECT * FROM CARS");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($cars_array, $row);
}

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
    <?php if (count($cars_array) > 0) : ?>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cars_array as $car) : ?>
                    <tr>
                        <td>
                            <?= $car["car_id"] ?>
                        </td>
                        <td>
                            <a <?= "href=\"car_update.php?car_id=" . $car["car_id"] ."\""?>><?= $car["car_name"] ?></a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No car records in database</p>
    <?php endif ?>
</body>

</html>