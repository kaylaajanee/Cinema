<?php
require "dbconfig.php";

$sql = "INSERT INTO fnb_payment (payment_id) VALUES ('$generatedString')";

if ($connection->query($sql) == TRUE){
    echo "Succes";
} else {
    echo "Error: " . $sql . "<br>" . $connection->error;
}

?>