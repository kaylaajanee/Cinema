<?php
session_start();
unset($_SESSION['cartItems']);

// Check if the user is logged in
// if (!isset($_SESSION['username'])) {
//   // Redirect the user to the login page or display an error message
//   header("Location: loginUser.html");
//   exit();
// }

require "dbconfig.php";

$menuItems = [];
$amounts = [];
$prices = [];
$images = [];
$fnb_id = [];
if (isset($_SESSION['menuItems']) && isset($_SESSION['amounts']) && isset($_SESSION['prices']) && isset($_SESSION['images']) && isset($_SESSION['fnb_id'])) {
  $menuItems = $_SESSION['menuItems'];
  $amounts = $_SESSION['amounts'];
  $prices = $_SESSION['prices'];
  $images = $_SESSION['images'];
  $fnb_id = $_SESSION['fnb_id'];
  //var_dump($fnb_id);
}

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
  </header>

  <!-- Select Theater -->
  <section class="success">
    <center><img src="img/success.png" alt="success payment"></center>
    <center>
      <p>Your payment is successful.<br>
        Thankyou for ordering the ticket,<br>
        it will be sent to your email.</p>
      <?php

      //session_start();

      // Check if the user is logged in
      //if (!isset($_SESSION['user_id'])) {
      // Redirect the user to the login page or display an error message
        //header("Location: signinNew.html");
      //exit();
      //}

      //$userID = $_SESSION['user_id'];
      require "dbconfig.php";

      $orderCode = $_GET['orderCode'];
      $customer_id = $_SESSION['customer_id'];
      $paymentOption = isset($_GET['paymentOption']) ? $_GET['paymentOption'] : '';
  
      $query = "UPDATE fnb_payment SET order_code = '$orderCode', p_status = 1 WHERE p_status = 0 ";
  
      // to execute $query
      if ($connection->query($query) === true) {
        echo "Order saved successfully.";
      } else {
        echo "Error saving order: " . $connection->error;
      }
  
      echo "<p>Order Code: " . $orderCode . "</p>";
      echo "<p>Payment Option: " . $paymentOption . "</p>";
      ?>

<?php
      // var_dump($_SESSION['menuItems']);
      // if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['menuItems']) && isset($_POST['amounts']) && isset($_POST['prices']) && isset($_POST['images'])) {
      //   $menuItems = $_POST['menuItems'];
      //   $amounts = $_POST['amounts'];
      //   $prices = $_POST['prices'];
      //   $images = $_POST['images'];
      // }

      $totalAmount = 0;
      $totalPrice = 0;
      // Display the selected menu data
      for ($i = 0; $i < count($menuItems); $i++) {
        $itemName = $menuItems[$i];
        $itemAmount = $amounts[$i];
        $itemPrice = $prices[$i];
        $itemImage = $images[$i];
       // $fnb_id = $fnb_id[$i];

       $totalAmount += $itemAmount;
       $totalPrice += $itemPrice*$itemAmount;
       // Calculate the subtotal price for each item
       $subtotalPrice = $itemAmount * $itemPrice;
        
        ?>
        <div class="cart-item">
  <div class="cart-img">
    <img src="<?php echo $itemImage; ?>" />
  </div>
  <div class="cart-details">
    <div class="item-details">
      <h3><?php echo $itemName; ?></h3>
      <span>Subtotal: <?php echo $subtotalPrice; ?></span>
    </div>
    <div class="item-amount">
      <span><?php echo $itemAmount; ?></span>
    </div>
  </div>
</div>

      <?php
      }

      // Retrieve other menu details based on $itemName if needed
      ?>
      <br><span>Total Price: <?php echo $totalPrice; ?></span>
    <div class="order">
      <a href="home.html" class="btn-order">Back to Home</a>
    </div>
  </section>

</body>

</html>