<?php
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=AUTOS', 'bhargavram', 'autos');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo("<pre>");
$stmt = $pdo->query("SELECT * FROM CARS");
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    print_r($row);
}
echo("</pre>");