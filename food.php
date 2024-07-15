<?php
require "dbconfig.php";

// Fetch all menu from the database 
$sql = "SELECT fnb_id, fnb_menu_name, fnb_price, img, fnb_status FROM fnb WHERE fnb_status = 1";
$result = $connection->query($sql);

session_start();
// unset($_SESSION['cartItems']);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fnb_menu_name']) && isset($_POST['fnb_price']) && isset($_POST['fnb_id'])) {
  $fnb_menu_name = $_POST['fnb_menu_name'];
  $fnb_price = $_POST['fnb_price'];
  $fnb_id = $_POST['fnb_id'];

  // Create new item
  $newItem = array(
    'fnb_id' => $fnb_id,
    'name' => $fnb_menu_name,
    'price' => $fnb_price,
    'amount' => 1
  );

  if (isset($_SESSION['cartItems'])) {
    $found = false;
    foreach ($_SESSION['cartItems'] as &$item) {
      if ($item['name'] === $fnb_menu_name && $item['price'] === $fnb_price) {
        $item['amount'] += 1;
        $item['fnb_id'] = $fnb_id;
        $found = true;
        break;
      }
    }
    if (!$found) {
      $_SESSION['cartItems'][] = $newItem;
    }
  } else {
    $_SESSION['cartItems'] = array($newItem);
  }  
}
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
        <li><a href="home.html" class="home-active">Home</a></li>
        <li><a href="home.html">Now Playing</a></li>
        <li><a href="home.html">Coming Soon</a></li>
        <li><a href="food.php">Food Beverage</a></li>
        <!-- <li><a href="#home">My Account</a></li> -->
      </ul>
      <li><a href="logoutUser.php" class="btn">My Account</a></li>
    </header>

    <div class="header-image">
    <div class="cart-count"><div class="cart-count">
  <?php echo isset($_SESSION['cartItems']) ? array_sum(array_column($_SESSION['cartItems'], 'amount')) : 0; ?>
</div>
</div>
    <a href="cart.php"><img src="img/c_logo.png" alt="Cart Image"></a>
  </div>

  <section class="ourmenu">
    <h2 class="heading">Our Menu</h2>
    <div class="menu-list">
      <?php
      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $fnb_menu_name = $row['fnb_menu_name'];
          $fnb_price = $row['fnb_price'];
          $img = $row['img'];
          $fnb_status = $row['fnb_status'];
          $fnb_id = $row['fnb_id'];
          if ($fnb_status != 1) {
            continue;
          }
          ?>
          <div class="box">
            <div class="box-img">
              <img src="<?php echo $img; ?>" alt="<?php echo $fnb_menu_name; ?>" />
            </div>
            <h3><?php echo $fnb_menu_name; ?></h3>
            <span><?php echo $fnb_price; ?></span>
            <?php
            // Check if the user is logged in
            if (isset($_SESSION['username'])) {
              $customer_id = $_SESSION['username'];
              // User is logged in, display the add to cart button
              ?>
              <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <input type="hidden" name="fnb_menu_name" value="<?php echo $fnb_menu_name; ?>" />
                <input type="hidden" name="fnb_price" value="<?php echo $fnb_price; ?>" />
                <input type="hidden" name="fnb_id" value="<?php echo $fnb_id; ?>" />
                <p><?php echo $fnb_id ?></p>
                <button type="submit" class="add-to-cart-btn">Add to Cart</button>
              </form>
              <!-- <button class="add-to-cart-btn" onclick="addToCart('<?php echo $fnb_menu_name; ?>', <?php echo $fnb_price; ?>)">Add to Cart</button> -->
              <?php
            }
            ?>
          </div>
          <?php
        }
      } else {
        echo "No menu items found.";
      }
      ?>
    </div>
  </section>
</body>
</html>