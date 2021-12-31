<?php
session_start();

echo ("<pre>");
print_r($_POST);
print_r($_SESSION);
echo ("</pre>");

?>

<html>

<head></head>

<body>
    <?php if (isset($_SESSION["status"]) && ($_SESSION["status"] === 1)) : ?>
        <h1>Welcome <?= $_SESSION["name"] ?></h1>
        <a href="logout.php">Log Out</a>
    <?php else : ?>
        <h1>Welcome</h1>
        <a href="signup.php">Sign Up</a>
        <a href="login.php">Log In</a>
    <?php endif ?>
</body>

<script>
    <?php if (isset($_SESSION["message"])) : ?>
        alert(<?= "\"" . $_SESSION["message"] . "\"" ?>);
    <?php endif ?>
    <?php unset($_SESSION["message"]); ?>
</script>

</html>