<?php
// https://www.php.net/manual/en/language.types.array.php

// https://www.php.net/manual/en/ref.array.php
// https://www.w3schools.com/Php/php_ref_array.asp

echo ("<pre>");

// The var_dump() function dumps information about one or more variables. The information holds type and value of the variable(s).
// The print_r() function prints the information about a variable in a more human-readable way.

$a1 = array(1, 2, 3);
$a2 = [1, 2, 3];

// echo($a1);

// var_dump($a1);
// var_dump($a2);

$a3 = array("Bhargav", "Krishna", "Gautham", "Anup");
// $a4 = ["Bhargav", "Krishna", "Gautham", "Anup"];

// var_dump($a3);
// var_dump($a4);

$a5 = array(1, 2, 3.5, "Bhargav", "Krishna", "Gautham", "Anup");

// var_dump($a5);

$a6 = array($a1, $a3);

var_dump($a6);
// var_dump($a6[0]);

$a7 = array(
    "name" => "Bhargavram",
    "age" => 21,
);

$a8 = [
    "name" => "Bhargavram",
    "age" => 21,
];

var_dump($a7);
// var_dump($a8);

// echo($a8);
print_r($a8);

// echo($a7[0]); //Error
echo ($a7["name"]);

// The count() function returns the number of elements in an array.

echo("a1 " . count($a1) . "\n");
echo("a2 " . count($a2) . "\n");
echo("a3 " . count($a3) . "\n");
// echo("a4 " . count($a4) . "\n");
echo("a5 " . count($a5) . "\n");
echo("a6 " . count($a6) . "\n");
echo("a7 " . count($a7) . "\n");
echo("a8 " . count($a8) . "\n");

echo ("</pre>");