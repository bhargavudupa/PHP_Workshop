<?php

// In PHP, we have the following loop types:
// while
// do...while
// for
// foreach

$i = 0;

while($i != 5) {
    echo("The number is " . $i . "<br>");
    $i++;
}
echo("<br>");

$i = 0;

$array = ["Volvo", "Audi", "Ford", "BMW"];
while($i < count($array)) {
    echo($array[$i] . "<br>");
    $i++;
}
echo("<br>");

$i = 10;

do {
  echo("The number is $i <br>");
  $i+= 10;
} while ($i <= 50);
echo("<br>");

$i = 0;

$array = ["Volvo", "Audi", "Ford", "BMW"];
do {
    echo($array[$i] . "<br>");
    $i++;
} while($i < count($array));
echo("<br>");