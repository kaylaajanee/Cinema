<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input values from the form
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    require "dbconfig.php";

    // Prepare and execute the query
    $query = "INSERT INTO customer (type,full_name, user_name, password, email, phone_number) 
    VALUES ('online','$fullname','$username', '$password','$email','$phone')";
    if ($connection->query($query) === TRUE) {
        // Registration successful
        $_SESSION["username"] = $username;
        // Redirect to the home page or any other page you want
        header("Location: loginUser.html");
        exit();
    } else {
        // Registration failed
        $error = "Error: " . $connection->error;
    }
}

// Close the database connection
$connection->close();
?>
