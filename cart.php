<?php
#Check logged in
session_start();
if(!$_SESSION["email"]){
  $_SESSION["returnTo"] = "/cart.php";
  header("Location: /login.php");
  die();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <?php include 'scripts.php'; ?>
    <title id="title"><?php echo $_SESSION["username"] . "'s Cart";?></title>
  </head>
  <body>
    <?php include 'menu.php'; ?>
    <h3><?php echo $_SESSION["username"] . "'s Shopping Cart";?></h3>
    <?php
    $conn = mysqli_connect($servername, $username, $adminPassword, $dbname);
    if(!$conn) {
      die("connection to database failed: " . mysqli_connect_error());
    }

    $sql = "SELECT product_id FROM Cart WHERE user_id = " . $_SESSION["user_id"];
    $cart = mysqli_query($conn, $sql);
    if(mysqli_num_rows($cart) > 0) {
      while($item = mysqli_fetch_assoc($cart)) {
        $sql = "SELECT name, image, price FROM Products WHERE product_id = " . $item["product_id"];
        $productData = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($productData);
        echo '<div class="panel panel-info">
          <div class="panel-heading">'. $row["name"] . '</div>
          <div class="panel-body imageFrame">
            <img src="/image/' . $row["image"] . '"/>
          </div>
          <div class="panel-body">Price: $' . $row["price"] . '</div>
        </div>';
      }
      echo '<a class="btn btn-primary" href="/checkoutShipping.php">Check Out</a>';
    } else {
      echo '<div class="panel panel-default">Your shopping cart is empty.</div>';
    }
    ?>
    
  </body>
</html>