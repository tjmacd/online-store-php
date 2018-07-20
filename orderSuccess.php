<?php
#Check logged in
session_start();
if(!$_SESSION["email"]){
  $_SESSION["returnTo"] = "./cart.php";
  header("Location: ./login.php");
  die();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <?php include 'scripts.php'; ?>
    <title id="title">Order Complete</title>
  </head>
  <body>
    <?php include 'menu.php'; ?>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $conn = mysqli_connect($servername, $username, $adminPassword, $dbname);
      if(!$conn) {
        die("connection to database failed: " . mysqli_connect_error());
      }
      # Remove cart items
      $sql = "DELETE FROM Cart WHERE user_id = ".$_SESSION["user_id"];
      mysqli_query($conn, $sql);
    }
    ?>
    
    <h1>Order Complete</h1>
    <a href="./">Click here to return to main page.</a>
    
  </body>
</html>
