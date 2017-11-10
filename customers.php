<?php

require "config.php";

header('Content-type: application/json');

// $sql = "SELECT * FROM user";
// $stmt = $pdo->prepare($sql);
// $stmt->execute();
// $array = $stmt->fetchAll();
// $json = json_encode($array, JSON_PRETTY_PRINT);

$sql = "SELECT * FROM `user` INNER JOIN `address` ON address.customer_id = user.existing_id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$array = $stmt->fetchAll();
$json = json_encode($array, JSON_PRETTY_PRINT);


echo $json;