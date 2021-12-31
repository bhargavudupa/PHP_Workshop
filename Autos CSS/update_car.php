<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=AUTOS', 'bhargavram', 'autos');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();

$valid_request = false;
$car_details = array();

$valid_input = false;

if (isset($_SESSION["status"]) && $_SESSION["status"] === 1) {
    if (isset($_GET["car_id"])) {
        $sql = "SELECT * FROM CARS where car_id = :car_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(":car_id" => $_GET["car_id"]));
        $car_details = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($car_details) {
            if($car_details["user_id"] ===  $_SESSION["user_id"]) {
                $valid_request = true;
                // Record can be updated in database
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

    if (isset($_POST["edit"])) {
        if (isset($_POST["car_name"]) && isset($_POST["car_company"]) && isset($_POST["car_year"]) && isset($_POST["car_price"])) {

            if (strlen($_POST["car_name"]) == 0) {
                $_SESSION["message"] = "Enter car name";
            } elseif (strlen($_POST["car_company"]) == 0) {
                $_SESSION["message"] = "Enter car company name";
            } elseif (strlen($_POST["car_year"]) == 0) {
                $_SESSION["message"] = "Enter car make year";
            } elseif (!is_numeric($_POST["car_year"])) {
                $_SESSION["message"] = "Enter valid car make year";
            } elseif (strlen($_POST["car_price"]) == 0) {
                $_SESSION["message"] = "Enter car price";
            } elseif (!is_numeric($_POST["car_price"])) {
                $_SESSION["message"] = "Enter valid car price";
            } else {
                $valid_input = true;
                // Data can be updated
            }
        } else {
            $valid_input = false;
            $_SESSION["message"] = "Data not set";
        }
    }

    if(isset($_POST["cancel"])) {
        header("location: index.php");
        return;
    }

    if ($valid_request && $valid_input) {
        // Update
        $sql = "UPDATE CARS SET car_name = :car_name, car_company = :car_company, car_year = :car_year, car_price = :car_price WHERE car_id = :car_id;";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array(
            ":car_name" => $_POST["car_name"],
            ":car_company" => $_POST["car_company"],
            ":car_year" => $_POST["car_year"],
            ":car_price" => $_POST["car_price"],
            ":car_id" => $_GET["car_id"],
        ));

        $_SESSION["message"] = "Car with id " . $_GET["car_id"] . " successfully updated";
        header("location: index.php");
        return;
    }
} else {
    die("Access deined");
}
?>
<html>

<head>
    <title>Update Car Page</title>
    <link href="bootstrap.min.css" rel="stylesheet">
</head>



<body>
    <div class="container">
        <div class="my-5 text-center">
            <h1>Update Car Page</h1>
        </div>
    </div>

    <?php if ($valid_request) : ?>
        <div class="container">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <form method="post">
                        <div class="form-group" style="margin-bottom: 10px;">
                            <label for="car_name">Enter Car Name: </label>
                            <input class="form-control" type="text" name="car_name" id="car_name" placeholder="Enter Car Name" value=<?= $car_details["car_name"] ?>>
                        </div>

                        <div class="form-group" style="margin-bottom: 10px;">
                            <label for="car_company">Enter Company Name: </label>
                            <input class="form-control" type="text" name="car_company" id="car_company" placeholder="Enter Company Name" value=<?= $car_details["car_company"] ?>>
                        </div>

                        <div class="form-group" style="margin-bottom: 10px;">
                            <label for="car_year">Enter Make Year: </label>
                            <input class="form-control" type="number" name="car_year" id="car_year" placeholder="Enter Make Year" value=<?= $car_details["car_year"] ?>>
                        </div>

                        <div class="form-group" style="margin-bottom: 10px;">
                            <label for="car_price">Enter Car Price: </label>
                            <input class="form-control" type="number" name="car_price" id="car_price" placeholder="Enter Car Price" value=<?= $car_details["car_price"] ?>>
                        </div>

                        <div class="text-center">
                            <div>
                                <input class="btn btn-success" style="width: 200px; margin-bottom: 10px;" type="submit" name="edit" value="Edit">
                            </div>

                            <div>
                                <input class="btn btn-danger" style="width: 200px; margin-bottom: 10px;" type="submit" name="cancel" value="Cancel">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-3"></div>
            </div>
        </div>
    <?php endif ?>

</body>

<script>
    <?php if (isset($_SESSION["message"])) : ?>
        alert(<?= "\"" . $_SESSION["message"] . "\"" ?>);
    <?php endif ?>
    <?php unset($_SESSION["message"]); ?>
</script>

</html>