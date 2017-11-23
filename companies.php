<?php

require "config.php";

$sql = "SELECT firstname, lastname, customer_company FROM user";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$array = $stmt->fetchAll();

$companies = [];

foreach ($array as $key) {
    $companies[] = $key['customer_company']; 
}

$uniqueCompanies = array_unique($companies);

foreach ($uniqueCompanies as $one) {
    echo $one . "<br>";

    $sql2 = "INSERT INTO companies (company_name) VALUES(:company_name)";
    $intoDB = $pdo->prepare($sql2);
    $intoDB->execute (array(':company_name' => $one)); 
}

$sql3 = "SELECT * FROM companies";
$compFromDB = $pdo->prepare($sql3);
$compFromDB->execute();
$compID = $compFromDB->fetchAll(); 


foreach ($compID as $theKey) {

    $sql4 = "UPDATE user SET company_id = :company_id WHERE customer_company = :customer_company";
    $compIntoDB = $pdo->prepare($sql4);
    $compIntoDB->execute (array(':company_id' => $theKey['id'], 'customer_company' => $theKey['company_name']));
}