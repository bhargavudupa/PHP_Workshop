<?php
for($i = 0; $i < 5; $i++) {
    echo("The number is " . $i . "<br>");
}
echo("<br>");

$i = 0;

$array = ["Volvo", "Audi", "Ford", "BMW"];
for($i = 0; $i < count($array); $i++) {
    echo($array[$i] . "<br>");
}
echo("<br>");

$i = 10;

$cars = ["Volvo", "Audi", "Ford", "BMW"];
foreach($cars as $car) {
    echo($car . "<br>");
}