<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=AUTOS', 'bhargavram', 'autos');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$cars_array = array();
$sql = "SELECT * FROM CARS where car_name = :car_name";
$stmt = $pdo->prepare($sql);
$stmt->execute(array(":car_name" => "Brezza"));

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
                    <th>Company</th>
                    <th>Year</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($cars_array as $car) : ?>
                    <tr>
                        <td>
                            <?php echo ($car["car_id"]); ?>
                        </td>
                        <td>
                            <?php echo ($car["car_name"]); ?>
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
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No car records in database</p>
    <?php endif ?>
</body>

</html>