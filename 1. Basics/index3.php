<?php
// https://www.w3schools.com/php/php_operators.asp
// https://www.php.net/manual/en/language.operators.php

$var1 = "Hello ";
$var2 = "World";
// $var3 = $var1 + $var2;
$var3 = $var1 . $var2;

echo ("<pre>");
echo ($var1 . "\n");
echo ($var2 . "\n");
echo ($var3 . "\n");
echo ("</pre>");

echo ("<pre>");
echo (strlen($var1) . "\n");
echo (strlen($var2) . "\n");
echo (strlen($var3) . "\n");
echo ("</pre>");

$var1 = 25;
$var2 = 30;
$var3 = $var1 . $var2;

echo ("<pre>");
echo ($var1 . "\n");
echo ($var2 . "\n");
echo ($var3 . "\n");
echo ("</pre>");