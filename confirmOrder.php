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
    <title id="title">Checkout</title>
  </head>
  <body>
    <?php include 'menu.php'; ?>
    <?php
    $conn = mysqli_connect($servername, $username, $adminPassword, $dbname);
    if(!$conn) {
      die("connection to database failed: " . mysqli_connect_error());
    }
    # Get Address
    $sql = "SELECT name, line1, line2, city, province, postcode, country FROM Addresses WHERE address_id = ". $_POST["shipTo"];
    $result = mysqli_query($conn, $sql);
    $address = mysqli_fetch_assoc($result);
    
    # Get cart data
    $sql = "SELECT product_id FROM Cart WHERE user_id = ".$_SESSION["user_id"];
    $cart = mysqli_query($conn, $sql);
    $price = 0.00;
    while($itemid = mysqli_fetch_assoc($cart)){
      $sql = "SELECT price FROM Products WHERE product_id = ".$itemid["product_id"];
      $productData = mysqli_query($conn, $sql);
      $product = mysqli_fetch_assoc($productData);
      $price += $product["price"];
    }
    $shipping = 6.99;
    $tax = $price * 0.13;
    $total = $price + $shipping + $tax;
    ?>
    
    <h2>Confirm order</h2>
    <form method="post" action="/orderSuccess.php">
      <h3>Ship to:</h3>
      <div class="panel panel-default">
        <strong><?php echo $address["name"];?></strong>
        <div><?php echo $address["line1"];?></div>
        <div><?php echo $address["line2"];?></div>
        <div><?php echo $address["city"].', '.$address["province"].' '.$address["postcode"];?></div>
        <div><?php echo $address["country"];?></div>
      </div>
      <h3>Charge to:</h3>
      <div class="panel panel-default">Credit card ending in 
        <?php
        echo substr($_POST["number"], -4);
        ?>
      </div>
      
      <h3>Cost:</h3>
      <table class="table">
        <tr>
          <td>Price:</td>
          <td><?php echo $price;?></td>
        </tr>
        <tr>
          <td>Shipping:</td>
          <td><?php echo $shipping;?></td>
        </tr>
        <tr>
          <td>Tax:</td>
          <td><?php echo number_format((float)$tax, 2, '.',''); ?></td>
        </tr>
        <tr>
          <td><strong>Total Price:</strong></td>
          <td><strong><?php echo number_format((float)$total, 2, '.',''); ?></strong></td>
        </tr>
      </table>
      <button class="btn btn-primary" type="submit">Confirm</button>
    </form>
    
  </body>
</html>