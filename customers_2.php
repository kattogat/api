<form method="get" action="customers_2.php">
    <label>Sök på id</label><br>
    <input name="customer_id" type="number"><br>  
    <label>Bara visa adress?</label><br>
    <input name="address" type="checkbox" value="true"><br>  
    <input type="submit" text="Sänd">  
</form>

<?php

require "config.php";

function printOut($json) {
    if ($json == "[]") {
        header("HTTP/1.0 404 Not found");
        echo "<h1>Error 404! Den här användaren finns inte!</h1>";
    } else {
        echo $json;
    }
}

if (isset($_GET['customer_id']) and isset($_GET['address']) == false) {
    $thisUser = $_GET['customer_id'];

    $sql = "SELECT user.*, address.existing_id AS address_id, address.customer_id, address.customer_id, address.customer_address_id, address.email AS address_email, address.firstname AS address_firstname, address.lastname AS address_lastname, address.postcode, address.street, 
    address.city, address.telephone, address.country_id, address.address_type, address.company, address.country, address.existing_id FROM `user` LEFT JOIN `address` ON address.customer_id = user.existing_id WHERE user.existing_id = $thisUser";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $array = $stmt->fetchAll();
    $json = json_encode($array, JSON_PRETTY_PRINT);

    printOut($json);

} elseif (isset($_GET['address'])) {
    $thisUser = $_GET['customer_id'];
    
        $sql = "SELECT * FROM `address` WHERE customer_id = $thisUser";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $array = $stmt->fetchAll();
        $json = json_encode($array, JSON_PRETTY_PRINT);
    
        printOut($json);
}