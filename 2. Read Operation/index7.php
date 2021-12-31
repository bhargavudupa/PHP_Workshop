<?php
// Super Global Arrays

if(isset($_GET)) {
    echo("GET is Set ");
} else {
    echo("GET is Not Set ");
}

if(isset($_GET["car_id"])) {
    echo("GET[\"car_id\"] is Set ");
} else {
    echo("GET[\"car_id\"] is Not Set ");
}

if(isset($_POST)) {
    echo("POST is Set ");
} else {
    echo("POST is Not Set ");
}

if(isset($_FILES)) {
    echo("FILES is Set ");
} else {
    echo("FILES is Not Set ");
}

if(isset($_SESSION)) {
    echo("SESSION is Set ");
} else {
    echo("SESSION is Not Set ");
}

if(isset($abc)) {
    echo("abc is Set ");
} else {
    echo("abc is Not Set ");
}
