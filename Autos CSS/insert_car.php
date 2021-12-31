<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=AUTOS', 'bhargavram', 'autos');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();

$flag = false;

if (isset($_SESSION["status"]) && $_SESSION["status"] === 1) {

    if (isset($_POST["insert"])) {
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
                $_SESSION["message"] = "Valid Data";
                $flag = true;
                // Data can be inserted into database
            }
        } else {
            $flag = false;
            $message = "Data not set";
        }

        if ($flag) {
            $sql = "INSERT INTO CARS (car_name, car_company, car_year, car_price, user_id) VALUES (:car_name, :car_company, :car_year, :car_price, :user_id)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ":car_name" => $_POST["car_name"],
                ":car_company" => $_POST["car_company"],
                ":car_year" => $_POST["car_year"],
                ":car_price" => $_POST["car_price"],
                ":user_id" => $_SESSION["user_id"],
            ));
            unset($_POST["car_name"]);
            unset($_POST["car_company"]);
            unset($_POST["car_year"]);
            unset($_POST["car_price"]);

            $_SESSION["message"] = "Car Added";
            header("location: index.php");
            return;
        }
    }

    if (isset($_POST["cancel"])) {
        header("location: index.php");
        return;
    }
} else {
    die("Access deined");
}
?>
<html>

<head>
    <title>Add Car Page</title>
    <link href="bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="my-5 text-center">
            <h1>Add Car Page</h1>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <form method="post">
                    <div class="form-group" style="margin-bottom: 10px;">
                        <label for="car_name">Enter Car Name: </label>
                        <input class="form-control" type="text" name="car_name" id="car_name" placeholder="Enter Car Name" value=<?= isset($_POST["car_name"]) ? "\"" . $_POST["car_name"] . "\"" : "" ?>>
                    </div>

                    <div class="form-group" style="margin-bottom: 10px;">
                        <label for="car_company">Enter Company Name: </label>
                        <input class="form-control" type="text" name="car_company" id="car_company" placeholder="Enter Company Name" value=<?= isset($_POST["car_company"]) ? "\"" . $_POST["car_company"] . "\"" : "" ?>>
                    </div>

                    <div class="form-group" style="margin-bottom: 10px;">
                        <label for="car_year">Enter Make Year: </label>
                        <input class="form-control" type="number" name="car_year" id="car_year" placeholder="Enter Make Year" value=<?= isset($_POST["car_year"]) ? "\"" . $_POST["car_year"] . "\"" : "" ?>>
                    </div>

                    <div class="form-group" style="margin-bottom: 10px;">
                        <label for="car_price">Enter Car Price: </label>
                        <input class="form-control" type="number" name="car_price" id="car_price" placeholder="Enter Car Price" value=<?= isset($_POST["car_price"]) ? "\"" . $_POST["car_price"] . "\"" : "" ?>>
                    </div>
                    <br>

                    <div class="text-center">
                        <div>
                            <input class="btn btn-success" style="width: 200px; margin-bottom: 10px;" type="submit" name="insert" value="Insert">
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
</body>

<script>
    <?php if (isset($_SESSION["message"])) : ?>
        alert(<?= "\"" . $_SESSION["message"] . "\"" ?>);
    <?php endif ?>
    <?php unset($_SESSION["message"]); ?>
</script>

</html>