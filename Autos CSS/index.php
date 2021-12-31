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

<head>
    <title>Autos Home Page</title>
    <link href="bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="my-5 text-center">
            <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] === 1)) : ?>
                <h1>Welcome <?= $_SESSION["name"] ?></h1>
            <?php else : ?>
                <h1>Welcome to Autos Home Page</h1>
            <?php endif ?>
        </div>

        <?php if (count($cars_array) !== 0) : ?>
            <table class="table table-striped table-bordered table-hover text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Company</th>
                        <th>Year</th>
                        <th>Price</th>
                        <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] === 1)) : ?>
                            <th>Update</th>
                            <th>Delete</th>
                        <?php endif ?>
                    </tr>
                </thead>
                <tbody class="table-light">
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
                                <?php if ($_SESSION["user_id"] === $car["user_id"]) : ?>
                                    <td>
                                        <a style="width: 100%;" class="btn btn-warning" <?= "href=\"update_car.php?car_id=" . $car["car_id"] . "\"" ?>><?= "Update " . $car["car_name"] ?></a>
                                    </td>
                                    <td>
                                        <a style="width: 100%;" class="btn btn-danger btn-block" href=<?= "\"delete_car.php?car_id=" . $car["car_id"] . "\""  ?>>Delete <?= $car["car_name"] ?></a>
                                    </td>
                                <?php else : ?>
                                    <td>No Update Rights</td>
                                    <td>No Delete Rights</td>
                                <?php endif ?>
                            <?php endif ?>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php else : ?>
            <div class="my-5 text-center">
                <h2>No cars in Database</h2>
            </div>
        <?php endif ?>

        <div class="my-5 text-center">
            <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] === 1)) : ?>
                <div class="row">
                    <div class="col-4"></div>
                    <a class="col-4 btn btn-danger" href="logout.php" style="margin-bottom: 10px;">Log Out</a>
                    <div class="col-4"></div>
                </div>

                <div class="row">
                    <div class="col-4"></div>
                    <a class="col-4 btn btn-primary" href="insert_car.php" style="margin-bottom: 10px;">Add Car</a>
                    <div class="col-4"></div>
                </div>
            <?php else : ?>
                <div class="row">
                    <div class="col-4"></div>
                    <a class="col-4 btn btn-primary" href="signup.php" style="margin-bottom: 10px;">Sign Up</a>
                    <div class="col-4"></div>
                </div>

                <div class="row">
                    <div class="col-4"></div>
                    <a class="col-4 btn btn-primary" href="login.php" style="margin-bottom: 10px;">Log In</a>
                    <div class="col-4"></div>
                </div>
            <?php endif ?>
        </div>
    </div>

</body>

<script>
    <?php if (isset($_SESSION["message"])) : ?>
        alert(<?= "\"" . $_SESSION["message"] . "\"" ?>);
    <?php endif ?>
    <?php unset($_SESSION["message"]); ?>
</script>

</html>