<?php
// $servername = "localhost";
// $dbusername = "root";
// $dbpassword = "";
// $dbname = "cinema3";

// // Establish Connection
// $connection = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// // Test Connection
// if ($connection->connect_error) { die("Connection Error: " . $connection->connect_error); }

// Start a session
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    // Redirect to the login page or any other page you want
    header("Location: adminLogin.php");
    exit();
}

require "dbconfig.php";

// Fetch all menu from the database 
$sql = "SELECT fnb_id, fnb_menu_name, fnb_price, img, fnb_status FROM fnb"; 
$result = $connection->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Zoo Wee Movie</title>
    <link href="css/style.css" rel="stylesheet" />
    <!-- Box Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css" />
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet" />
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
  </head>

  <body>
    <!-- Navbar -->
    <header>
      <a href="#" class="logo"> <img src="img/logo.png" alt="Logo" /> Zoo Wee Movie </a>
      <div class="bx bx-menu" id="menu-icon"></div>

      <!-- Menu -->
      <ul class="navbar">
        <!--
        <li><a href="home.html" class="home-active">Home</a></li>
        <li><a href="home.html">Now Playing</a></li>
        <li><a href="home.html">Coming Soon</a></li>
        <li><a href="food.html">Food Beverage</a></li>
         <li><a href="#home">My Account</a></li> -->
      </ul>
      <li><a href="adminlogout.php" class="btn">Log Out</a></li>
    </header>

    <!-- Ourmenu -->
    <section class="ourmenu">
      <h2 class="heading">Our Menu</h2>

      <!-- Coming Soon List -->
      <div class="menu-list">
      <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $fnb_id = $row['fnb_id'];
                    $fnb_menu_name = $row['fnb_menu_name'];
                    $fnb_price = $row['fnb_price'];
                    $img = $row['img'];
                    $status= $row['fnb_status'];
                    ?>
                    <div class="box">
                        <div class="box-img">
                            <img src="<?php echo $img; ?>" alt="<?php echo $fnb_menu_name; ?>" />
                        </div>
                        <h3><?php echo $fnb_menu_name; ?></h3>
                        <span><?php echo $fnb_price; ?></span>
                        <p>Status: <span style="color: <?php echo ($status == 1) ? 'green' : 'red'; ?>;"><?php echo ($status == 1) ? 'Available' : 'Not Available'; ?></span></p><br>
                        <a class="add-to-cart-btn" href="adminEdit.php?foodId='<?php echo $fnb_id?>'">edit availability</a>
                    </div>
                    <?php
                }
            } else {
                echo "No menu items found.";
            }
            ?>
        <!-- Menu 1
        <div class="box">
          <div class="box-img">
            <img src="img/caramelpopcorn.png" alt="Movie One" />
          </div>
          <h3>Caramel Popcorn</h3>
          <span>IDR 45.000</span>
          <button class="add-to-cart-btn" style="margin-left: auto">Add to Cart</button>
        </div>

        Menu 2
        <div class="box">
          <div class="box-img">
            <img src="img/popcorn.png" alt="Movie One" />
          </div>
          <h3>Popcorn Original</h3>
          <span>IDR 38.000</span>
          <button class="add-to-cart-btn">Add to Cart</button>
        </div>

        Menu 3
        <div class="box">
          <div class="box-img">
            <img src="img/fishchips.png" alt="Movie One" />
          </div>
          <h3>Fish and Chips</h3>
          <span>IDR 65.000</span>
          <button class="add-to-cart-btn">Add to Cart</button>
        </div>

        Menu 4
        <div class="box">
          <div class="box-img">
            <img src="img/lycheetea.png" alt="Movie One" />
          </div>
          <h3>Lychee Tea</h3>
          <span>IDR 30.000</span>
          <button class="add-to-cart-btn">Add to Cart</button>
        </div>

        Menu 5
        <div class="box">
          <div class="box-img">
            <img src="img/hotchoco.png" alt="Movie One" />
          </div>
          <h3>Hot Chocolate</h3>
          <span>IDR 40.000</span>
          <button class="add-to-cart-btn">Add to Cart</button>
        </div>

        Menu 6
        <div class="box">
          <div class="box-img">
            <img src="img/peachtea.png" alt="Movie One" />
          </div>
          <h3>Peach Tea</h3>
          <span>IDR 30.000</span>
          <button class="add-to-cart-btn">Add to Cart</button>
        </div> -->
      </div>
    </section>
  </body>
</html>