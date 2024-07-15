<?php
session_start();
require "dbconfig.php";

if (isset($_POST['clear']) && $_POST['clear'] === "true") {
  unset($_SESSION['cartItems']);
}

if (isset($_POST['menuItems']) && isset($_POST['amounts'])) {
  $menuItems = $_POST['menuItems'];
  $amounts = $_POST['amounts'];

  // Update the cart items with the latest amounts
  if (isset($_SESSION['cartItems'])) {
    $cartItems = $_SESSION['cartItems'];
    foreach ($cartItems as &$item) {
      $itemName = $item['name'];
      if (in_array($itemName, $menuItems)) {
        $item['amount'] = $amounts[array_search($itemName, $menuItems)];
      }
    }
    $_SESSION['cartItems'] = $cartItems;
  }
}

// Check if the cart is empty
$isCartEmpty = !(isset($_SESSION['cartItems']) && count($_SESSION['cartItems']) > 0);
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

  <title>Cart</title>
</head>

<body>

    <!-- <div class="d-lg-flex half">
    <div class="bg order-1 order-md-2" style="background-image: url('img/cart.png');"></div>
    <div class="contents order-2 order-md-1"> -->

      <section class="ourmenu">
        <h2 class="heading">Cart</h2>
        <div class="menu-list">
        <form action="payment.php" method="post" class="payment-form">
          <?php
          if (isset($_SESSION['cartItems']) && count($_SESSION['cartItems']) > 0) {
            $cartItems = $_SESSION['cartItems'];
            foreach ($cartItems as $item) {
              $itemName = $item['name'];
              $itemPrice = $item['price'];
              $itemAmount = $item['amount'];
              $fnb_id = $item['fnb_id'];
              // Fetch image URL based on item name
              $sql = "SELECT img FROM fnb WHERE fnb_menu_name = '$itemName'";
              $result = $connection->query($sql);
              if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $img = $row['img'];
                // Include hidden input fields for image URLs
              echo '<input type="hidden" name="images[]" value="' . $img . '">';
              } else {
                echo "No image";
              }
              ?>
              <div class="cart-item">
                <div class="cart-img">
                  <img src="<?php echo $img; ?>" />
                </div>
                <div class="cart-details">
                <div class="item-details">
                <h3><?php echo $itemName; ?></h3>
                <span><?php echo $itemPrice; ?></span>
                <span><?php echo $fnb_id; ?></span>

            </div>
            <div class="item-amount">
              <div class="for-cart">
                <input type="number" name="amounts[]" value="<?php echo $itemAmount; ?>" min="1" onchange="updateAmount('<?php echo $itemName; ?>', this.value)">
            </div>
                <input type="hidden" name="menuItems[]" value="<?php echo $itemName; ?>">
                <input type="hidden" name="prices[]" value="<?php echo $itemPrice; ?>">
                <input type="hidden" name="fnb_id[]" value="<?php echo $fnb_id; ?>">
              </div></div></div>
          <?php
            }
          } else {
          ?>
            <div class="empty-cart">
              <p>Your cart is empty.</p>
            </div>
          <?php
          }
          ?>
          <br>
          <center>
    <?php if (!$isCartEmpty) { ?>
      <input type="submit" name="submit" value="Select Payment Method" class="btn">
    <?php } else { ?>
      <input type="submit" name="submit" value="Select Payment Method" class="btn" disabled>
    <?php } ?>
  </center>
        </form>
        </div>
        <br>
  <div class="buttons-container">
    <a href="food.php" class="btn-order">Go Back to Menu</a>
  </div>
</center>
        <center>
        <form action="cart.php" method="post">
            <input type="hidden" name="clear" value="true">
            <input type="submit" value="Clear Cart" class="btn-order">
          </form>
        </center>
        <!-- <center><a href="payment.php" class="btn">Select Payment<br>Method</a></center> -->
      </section>
    </div>
  </div>

  <script>
    function updateAmount(itemName, amount) {
      var cartItems = JSON.parse(sessionStorage.getItem('cartItems')) || [];
      for (var i = 0; i < cartItems.length; i++) {
        if (cartItems[i].name === itemName) {
          cartItems[i].amount = parseInt(amount);
          break;
        }
      }
      sessionStorage.setItem('cartItems', JSON.stringify(cartItems));
    }
  </script>
  <!-- <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script> -->
</body>

</html>