<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=AUTOS', 'bhargavram', 'autos');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();

$cars_array = array();
$stmt = $pdo->query("SELECT * FROM CARS");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($cars_array, $row);
}
?>

<html>

<head></head>

<body>
    <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] === 1)) : ?>
        <h1>Welcome <?= $_SESSION["name"] ?></h1>
        <a href="logout.php">Log Out</a>
        <a href="insert_car.php">Add Car</a>
    <?php else : ?>
        <h1>Welcome</h1>
        <a href="signup.php">Sign Up</a>
        <a href="login.php">Log In</a>
    <?php endif ?>

    <?php if (count($cars_array) !== 0) : ?>
        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Year</th>
                    <th>Price</th>
                    <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] === 1)) : ?>
                        <th>Edit</th>
                        <th>Delete</th>
                    <?php endif ?>
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
                        <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] === 1)) : ?>
                            <td>
                                <a <?= "href=\"update_car.php?car_id=" . $car["car_id"] . "\"" ?>><?= "Edit " . $car["car_name"] ?></a>
                            </td>
                            <td>
                                <a href=<?= "\"delete_car.php?car_id=" . $car["car_id"] . "\""  ?>>Delete <?= $car["car_name"] ?></a>
                            </td>
                        <?php endif ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No cars in Database</p>
    <?php endif ?>

</body>

<script>
    <?php if (isset($_SESSION["message"])) : ?>
        alert(<?= "\"" . $_SESSION["message"] . "\"" ?>);
    <?php endif ?>
    <?php unset($_SESSION["message"]); ?>
</script>

</html>