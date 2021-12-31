<?php

// https://www.w3schools.com/php/php_if_else.asp
// https://www.php.net/manual/en/control-structures.if.php
// https://www.php.net/manual/en/control-structures.else.php
// https://www.php.net/manual/en/control-structures.elseif.php
// https://www.php.net/manual/en/control-structures.switch.php

$var1 = 25;
$var2 = 25;

if ($var1 > $var2) {
    echo ($var1 . " is greater");
} elseif ($var1 === $var2) {
    echo ("Both are equal");
} else {
    echo ("$var2 is greater");
}

echo ("<br>");

// == -> Returns true if $x is equal to $y
// === -> Returns true if $x is equal to $y, and they are of the same type
// != -> Not equal	$x != $y true if $x is not equal to $y
// <> -> Not equal	$x <> $y true if $x is not equal to $y
// !== -> Not identical	$x !== $y true if $x is not equal to $y, or they are not of the same type

$var1 = 25;
$var2 = "25";

if ($var1 == $var2) {
    echo ("Both are equal");
} else {
    echo ("They are not equal");
}

echo ("<br>");

if ($var1 === $var2) {
    echo ("Both are equal");
} else {
    echo ("They are not equal");
}

// Explore switch and other comparision operatiors yourself