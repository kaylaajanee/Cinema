<?php
// Start a session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the input values from the form
    $username = $_POST["username"];
    $password = $_POST["password"];

    require "dbconfig.php";

    // Prepare and execute the query
    $query = "SELECT * FROM admin WHERE admin_name = '$username' AND admin_password = '$password'";
    $result = $connection->query($query);

    // Check if the query returned any rows
    if ($result && $result->num_rows > 0) {
        // Authentication successful
        $_SESSION["username"] = $username;
        // Redirect to the home page or any other page you want
        header("Location: adminFnB.php");
        exit();
    } else {
        // Authentication failed
        $error = "Invalid username or password";
    }

    // Close the database connection
    $connection->close();
}

?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="fonts/icomoon/style.css">

  <link rel="stylesheet" href="css/owl.carousel.min.css">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <!-- Style -->
  <link rel="stylesheet" href="css/style-login.css">
  <link rel="stylesheet" href="css/style.css">

  <title>Login #2</title>
</head>

<body>


  <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('img/m9.png');"></div>
    <div class="contents order-2 order-md-1">

      <div class="container">
        <div class="row align-items-center justify-content-center">
          <div class="col-md-7">
            <h3>Sign In<strong> as Admin</strong></h3>
            <p class="mb-4">Let's go enjoy the movie</p>
            <form action="" method="post">
              <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" name="username" class="form-control" placeholder="Your Username" id="username">
              </div>
              <div class="form-group last mb-3">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Your Password" id="password">
              </div>

              <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                  <input type="checkbox" checked="checked" />
                  <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
              </div>
              <center>
                <input type="submit" class="btn" name="login" value="Sign In">
              </center>

              <center class="mt-5">
                <span>You have an account? <a href="loginUser.html">Sign In</a></span><br>
                <span>Don't have an account? <a href="signupUser.html">Sign Up</a></span>
              </center>

            </form>
          </div>
        </div>
      </div>
    </div>


  </div>



  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>

</html>
