<?php

$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "cinema";

//established connection 
$connection = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// test connection
if(!$connection){
    die("connection error:". mysqli_connect_error());
}
?>