<?php
// Database connection configuration
// $servername = "localhost";
// $username = "your_username";
// $password = "your_password";
// $dbname = "your_database_name";

// Start a session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    // Redirect to the login page or any other page you want
    header("Location: adminLogin.php");
    exit();
}

require "dbconfig.php";

// // Create a new connection
// $conn = new mysqli($servername, $username, $password, $dbname);

// // Check the connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the food ID and availability from the form submission
    $foodId = $_POST['foodId'];
    $availability = $_POST['availability'];

    // Update the food availability in the database
    $sql = "UPDATE fnb SET fnb_status = $availability WHERE fnb_id = $foodId";
    $result = $connection->query($sql);

    if ($result) {
        // Redirect the user back to the food list page or show a success message
        header("Location: adminFnB.php");
        exit();
    } else {
        // Handle the case where the update query fails
        echo "Error updating food availability: " . $connection->error;
    }
}

// If the request method is not POST, display the form to edit the food availability
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <title></title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Zoo Wee Movie</title>
  <link href="css/style.css" rel="stylesheet">
  <!-- Box Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap"
    rel="stylesheet">
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />

</head>

<body>
  <!-- Navbar -->
  <header>
    <a href="#" class="logo">
      <img src="img/logo.png" alt="Logo"> Zoo Wee Movie
    </a>
    <div class="bx bx-menu" id="menu-icon"></div>

    <!-- Menu -->
    <ul class="navbar">
      <li><a href="home.html" class="home-active">Home</a></li>
      <li><a href="home.html">Now Playing</a></li>
      <li><a href="home.html">Coming Soon</a></li>
      <li><a href="food.html">Food Beverage</a></li>
      <!-- <li><a href="#home">My Account</a></li> -->
    </ul>
    <li><a href="index.html" class="btn">My Account</a></li>
  </header>

  <!-- Edit Food Form -->
  <section class="edit-food">
    <h2 class="heading">Edit Food Availability</h2>

    <form method="POST" action="">
      <input type="hidden" name="foodId" value="<?php echo $_GET['foodId']; ?>">

      <label for="availability">Availability:</label>
      <select name="availability" id="availability">
        <option value="1">Available</option>
        <option value="0">Not Available</option>
      </select>

      <button type="submit">Save</button>
    </form>
  </section>

</body>

</html>
