<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=AUTOS', 'bhargavram', 'autos');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();

if (isset($_POST["log-in"])) {
    if (isset($_POST["email_id"]) && isset($_POST["password"])) {
        if (strlen($_POST["email_id"]) > 0 && strlen($_POST["password"]) > 0) {
            $sql = "SELECT * FROM USERS where email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(array(
                ":email" => $_POST["email_id"],
            ));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                if ($result["password"] === $_POST["password"]) {
                    $_SESSION["email"] = $_POST["email_id"];
                    $_SESSION["name"] = $result["name"];
                    $_SESSION["user_id"] = $result["user_id"];
                    $_SESSION["status"] = 1;
                    $_SESSION["message"] = "Successfully logged up!";
                    header("location: index.php");
                    return;
                } else {
                    $_SESSION["status"] = 0;
                    $_SESSION["message"] = "Password is incorrect! Try again...";
                }
            } else {
                $_SESSION["status"] = 0;
                $_SESSION["message"] = "Email id is not found..Try with the other!!";
            }
        } else {
            $_SESSION["status"] = 0;
            $_SESSION["message"] = "All fields are required";
        }
    } else {
        $_SESSION["status"] = 0;
        $_SESSION["message"] = "All the required fields are not set";
    }
}

if (isset($_POST["cancel"])) {
    session_destroy();
    header("location: index.php");
    return;
}
?>
<html>

<head>
    <title>Log In Page</title>
    <link href="bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="my-5 text-center">
            <h1>Log In Page</h1>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-3"></div>
            <div class="col-6">
                <form method="post">
                    <div class="form-group" style="margin-bottom: 10px;">
                        <label for="email_id">Enter Email</label>
                        <input class="form-control" type="text" name="email_id" id="email_id" placeholder="Enter Email" value=<?= isset($_POST["email_id"]) ? "\"" . $_POST["email_id"] . "\"" : "" ?>>
                    </div>

                    <div class="form-group" style="margin-bottom: 10px;">
                        <label for="password">Enter Password</label>
                        <input class="form-control" type="password" name="password" id="password" placeholder="Enter Password">
                    </div>

                    <div class="text-center">
                        <div>
                            <input class="btn btn-success" style="width: 200px; margin-bottom: 10px;" type="submit" name="log-in" value="Log In">
                        </div>

                        <div>
                            <input class="btn btn-danger" style="width: 200px; margin-bottom: 10px;" type="submit" name="cancel" value="Cancel">
                        </div>

                        <a href="signup.php">Don't have an account?</a>
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