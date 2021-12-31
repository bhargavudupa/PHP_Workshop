<?php
$flag = false;
$message = "";
if (isset($_POST["submit"])) {
    if (isset($_POST["name"]) && isset($_POST["age"])) {
        if (strlen($_POST["name"]) > 0 && strlen($_POST["age"]) > 0 && is_numeric($_POST["age"])) {
            $flag = true;
            $message = "Valid Data";
        } else {
            $flag = false;
            $message = "Invalid Data";
        }
    } else {
        $flag = false;
        $message = "Data not set";
    }
}
echo ("<pre>");
print_r($_GET);
print_r($_POST);
echo ("</pre>");
?>
<html>

<head></head>

<body>
    <form method="post">
        <label for="name">Enter Name: </label>
        <input type="text" name="name" id="name" />
        <br>
        <label for="age">Enter Age: </label>
        <input type="text" name="age" id="age">
        <br>
        <input type="submit" name="submit" value="Submit" />
    </form>

    <p style=<?php echo($flag ? ("\"color: green\"") : ("\"color: red\"")); ?>><?= $message ?></p>
</body>

</html>