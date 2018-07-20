<?php
#Check logged in
session_start();
$_SESSION["returnTo"] = "/checkoutShipping.php";
if(!$_SESSION["email"]){
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
    <h3>Checkout</h3>
    <h3>Select address to ship to</h3>
    <div id='addressBook'>
      <?php
      $conn = mysqli_connect($servername, $username, $adminPassword, $dbname);
      if(!$conn) {
        die("connection to database failed: " . mysqli_connect_error());
      }
      $sql = "SELECT address_id, name, line1, line2, city, province, postcode, country FROM Addresses WHERE user_id = '" . $_SESSION["user_id"]."'";
      $addresses = mysqli_query($conn, $sql);
      while($address = mysqli_fetch_assoc($addresses)) {
        echo '<div class="address col-md-3" id="address">
          <strong>'.$address["name"].'</strong>
          <div>'.$address["line1"].'</div>
          <div>'.$address["line2"].'</div>
          <div>'.$address["city"].', '.$address["province"].' '.$address["postcode"].'</div>
          <div>'.$address["country"].'</div>
          <a class="btn btn-primary" type="submit" href="/checkoutPayment.php?shipTo='.$address["address_id"].'">Use this address</a>
          <a class="btn btn-default" type="submit" href="/editAddress.php?id='.$address["address_id"].'">Edit</a>
          <a class="btn btn-default" type="submit" href="/deleteAddress.php?id='.$address["address_id"].'">Delete</a>
        </div>';
      }
      ?>
    </div>
    <div class="clearfix hidden-sm-up"></div>
    <a class="btn btn-primary" href="/newAddress.php">Add new address</a>
    
  </body>
</html>