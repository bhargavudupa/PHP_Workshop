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

echo "<pre>";
var_dump($_POST);
var_dump($_SESSION);
echo "</pre>";
?>
<html>

<head></head>

<body>
    <form method="post">
        <label for="email_id">Enter Email</label>
        <input type="text" name="email_id" id="email_id" value=<?= isset($_POST["email_id"]) ? "\"" . $_POST["email_id"] . "\"" : "" ?>>
        <br>

        <label for="password">Enter Password</label>
        <input type="password" name="password" id="password">
        <br>

        <input type="submit" name="log-in" value="Log In">
        <br>

        <input type="submit" name="cancel" value="Cancel">
        <br>

        <a href="signup.php">Don't have an account?</a>
    </form>
</body>

<script>
    <?php if (isset($_SESSION["message"])) : ?>
        alert(<?= "\"" . $_SESSION["message"] . "\"" ?>);
    <?php endif ?>
    <?php unset($_SESSION["message"]); ?>
</script>

</html>