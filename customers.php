<?php

require "config.php";

header('Content-type: application/json');

// $sql = "SELECT * FROM user";
// $stmt = $pdo->prepare($sql);
// $stmt->execute();
// $array = $stmt->fetchAll();
// $json = json_encode($array, JSON_PRETTY_PRINT);

$sql = "SELECT user.*, address.existing_id AS address_id, address.customer_id, address.customer_id, address.customer_address_id, address.email, address.firstname, address.lastname, address.postcode, address.street, 
address.city, address.telephone, address.country_id, address.address_type, address.company, address.country, address.existing_id FROM `user` LEFT JOIN `address` ON address.customer_id = user.existing_id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$array = $stmt->fetchAll();
$json = json_encode($array, JSON_PRETTY_PRINT);


echo $json;