<?php

session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input values from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    require "dbconfig.php";

    // Prepare and execute the query
    $query = "SELECT * FROM customer WHERE user_name = '$username' AND password = '$password'";
    $result = $connection->query($query);

    // Check if the query returned any rows
    if ($result && $result->num_rows > 0) {
        // Authentication successful
        $_SESSION["username"] = $username;
        $row = $result->fetch_assoc();
        $_SESSION["customer_id"] = $row["customer_id"];
        // Redirect to the home page or any other page you want
        header("Location: home.html");
        exit();
    } else {
        // Authentication failed
        $error = "Invalid username or password";
        $_SESSION["error"] = $error;
        header("Location: loginUser.html");
        exit();
    }

    // Close the database connection
    $connection->close();
}

?>
