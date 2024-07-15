<?php

require "dbconfig.php";

// Fetch all menu from the database 
$sql = "SELECT * FROM payment_category WHERE status = 'ON'"; 

$result = $connection->query($sql);

session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $menuItems = $_POST['menuItems'];
  $amounts = $_POST['amounts'];
  $prices = $_POST['prices'];
  $images = $_POST['images'];
  $fnb_id= $_POST['fnb_id'];
  //var_dump($fnb_id);
}

$_SESSION['menuItems'] = $menuItems;
$_SESSION['amounts'] = $amounts;
$_SESSION['prices'] = $prices;
$_SESSION['images'] = $images;
$_SESSION['fnb_id'] = $fnb_id;

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
  <!-- <script>
    function generateRandomCode() {
      var characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      var code = '';

      for (var i = 0; i < 5; i++) {
        code += characters.charAt(Math.floor(Math.random() * characters.length));
      }

      return code;
    }

    // Add click event listeners to the payment buttons
    // document.getElementById("generateButton1").addEventListener("click", generateCode);
    // document.getElementById("generateButton2").addEventListener("click", generateCode);
    // document.getElementById("generateButton3").addEventListener("click", generateCode);
    // document.getElementById("generateButton4").addEventListener("click", generateCode);
    // document.getElementById("generateButton5").addEventListener("click", generateCode);
    // document.getElementById("generateButton6").addEventListener("click", generateCode);
    // document.getElementById("generateButton7").addEventListener("click", generateCode);

    // Function to generate the random code and redirect to success.html
    function generateCode(event) {
      event.preventDefault();
      var randomCode = generateRandomCode();
      var paymentOption = this.parentNode.parentNode.querySelector("h3").textContent;
      localStorage.setItem("orderCode", randomCode);
      localStorage.setItem("paymentOption", paymentOption);
      location.href = "paid.php";
    }
  </script> -->
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
  <section class="theater">
    <h2 class="heading">Choose Your Payment Option</h2>
    <!-- Coming Soon List -->
    <div class="payment-list">
    <?php
      
      if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          $p_category_id = $row['p_category_id'];
          $img = $row['img'];
          
          // Check if the img field is empty or null
          if (!empty($img)) {
      ?>
        <center>
            <div class="box-payment">
              <div class="box-img-payment">
              <a href="unpaid.php?paymentOption=<?php echo $p_category_id; ?>"><img src="<?php echo $img; ?>" alt="Movie One"></a>
              
              </div>
              <h3><?php echo $row['p_category_id']; ?></h3>
            </div>
          </center>
      <?php
          }
        }
      } else {
        echo "No menu items found.";
      }
      ?>
                    
      <center>
      
        <!-- Movie 1 
        <div class="box-payment">
          <div class="box-img-payment">
            <a id="generateButton1" href="unpaid.php? orderCode=<script>document.write(localStorage.getItem('orderCode'));</script>&paymentOption=VA Bank BCA & id=1"><img src="img/bank/bca.png" alt="Movie One"></a>
          </div>
          <h3>VA Bank BCA</h3>
        </div>

        <Movie 2 
        <div class="box-payment">
          <div class="box-img-payment">
            <a href="success.html"><img src="img/bank/mandiri.png" alt="Movie One"></a>
          </div>
          <h3>VA Bank Mandiri</h3>
        </div>

         Movie 3 
        <div class="box-payment">
          <div class="box-img-payment">
            <a href="success.html"><img src="img/bank/bri.png" alt="Movie One"></a>
          </div>
          <h3>VA Bank BRI</h3>
        </div>

         Movie 4 
        <div class="box-payment">
          <div class="box-img-payment">
            <a href="success.html"><img src="img/bank/bni.png" alt="Movie One"></a>
          </div>
          <h3>VA Bank BNI</h3>
        </div>

         Movie 5 
        <div class="box-payment">
          <div class="box-img-payment">
            <a href="success.html"><img src="img/ewallet/dana.png" alt="Movie One"></a>
          </div>
          <h3>Dana</h3>
        </div>

         Movie 5 
        <div class="box-payment">
          <div class="box-img-payment">
            <a href="success.html"><img src="img/ewallet/gopay.png" alt="Movie One"></a>
          </div>
          <h3>Gopay</h3>
        </div>

         Movie 5 
        <div class="box-payment">
          <div class="box-img-payment">
            <a href="success.html"><img src="img/ewallet/ovo.png" alt="Movie One"></a>
          </div>
          <h3>OVO</h3>
        </div>
      </center> -->


    </div>
  </section>

  <script>
    
    
  </script>
</body>

</html>

<style>
  .payment-list {
  display: flex;
  flex-direction: column;
}

.box-payment {
  margin-bottom: 20px;
}
</style>