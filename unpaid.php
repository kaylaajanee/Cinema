<?php
session_start();

require "dbconfig.php";

$menuItems = [];
$amounts = [];
$prices = [];
$images = [];
$fnb_ids = [];

if (isset($_SESSION['menuItems']) && isset($_SESSION['amounts']) && isset($_SESSION['prices']) && isset($_SESSION['images']) && isset($_SESSION['fnb_id'])) {
  $menuItems = $_SESSION['menuItems'];
  $amounts = $_SESSION['amounts'];
  $prices = $_SESSION['prices'];
  $images = $_SESSION['images'];
  $fnb_ids = $_SESSION['fnb_id'];
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
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
  <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css" />
  <script>
    function generateRandomCode() {
      var characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      var code = '';

      for (var i = 0; i < 5; i++) {
        code += characters.charAt(Math.floor(Math.random() * characters.length));
      }

      return code;
    }

    function generateCode(event) {
      event.preventDefault();
      var randomCode = generateRandomCode();
      localStorage.setItem("orderCode", randomCode);
      var paymentOption = '<?php echo urlencode($_GET["paymentOption"]); ?>'; // Get paymentOption from URL parameter
      location.href = "paid.php?orderCode=" + randomCode + "&paymentOption=" + paymentOption;
    }
  </script>
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
    <center>
      <p>The bill<br>
        will be sent to your email<br>
        Please complete your payment</p>
      <?php
      $customer_id = $_SESSION['customer_id'];
      $paymentOption = isset($_GET['paymentOption']) ? $_GET['paymentOption'] : '';

      $totalAmount = 0;
      $totalPrice = 0;
      $fnb_id = 0;

      // Calculate the total amount and price
      for ($i = 0; $i < count($menuItems); $i++) {
        $totalAmount += $amounts[$i];
        $totalPrice += $amounts[$i] * $prices[$i];
      }

      // Insert records into fnb_payment table
      $query = "INSERT INTO fnb_payment (customer_id, fnb_amount, p_category_id, total_price, p_status) 
                VALUES ('$customer_id', '$totalAmount', '$paymentOption', '$totalPrice', '0')";

      if ($connection->query($query) === true) {
        $paymentId = $connection->insert_id; // Get the generated payment_id
        echo "Order saved successfully.";
      } else {
        echo "Error saving order: " . $connection->error;
      }

      // Insert records into details table
      for ($i = 0; $i < count($menuItems); $i++) {
        $itemName = $menuItems[$i];
        $itemAmount = $amounts[$i];
        $itemPrice = $prices[$i];
        $itemImage = $images[$i];
        $fnbId = $fnb_ids[$i];
        $subtotalPrice = $itemAmount * $itemPrice;

        $itemQuery = "INSERT INTO details (payment_id, fnb_id, item_amount, subtotal)
                      VALUES ('$paymentId', '$fnbId', '$itemAmount', '$subtotalPrice')";

        if ($connection->query($itemQuery) === true) {
          echo " ";
        } else {
          echo "Error saving order: " . $connection->error;
        }
      }
      ?>
      <?php
      // Display the selected menu data
      for ($i = 0; $i < count($menuItems); $i++) {
        $itemName = $menuItems[$i];
        $itemAmount = $amounts[$i];
        $itemPrice = $prices[$i];
        $itemImage = $images[$i];

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
    <br><br>
  </div>
      </div>
        <?php
        }
        ?>
      <span>Total Price: <?php echo $totalPrice; ?></span>
      <div class="order">
        <a href="#" onclick="generateCode(event)" class="btn-order">I have completed the payment</a>
      </div>
    </center>
  </section>
</body>
</html>