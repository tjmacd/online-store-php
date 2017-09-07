<?php
#Check logged in
session_start();
if(!$_SESSION["email"]){
  $_SESSION["returnTo"] = "/cart.php";
  header("Location: /login.php");
  die();
}
$_SESSION["shipTo"] = $_GET["shipTo"];
?>

<!DOCTYPE html>
<html>
  <head>
    <?php include 'scripts.php'; ?>
    <title id="title">Checkout</title>
  </head>
  <body>
    <?php include 'menu.php'; ?>
    <h3>Payment</h3>
    <form class="form-vertical" id="creditCardInfo" method="post" action="/confirmOrder.php">
      <label class="control-label col-md-1" for="name">Name on card:</label>
      <div class="col-md-4 form-group">
        <input type="text" id="name" name="name" class="form-control"
					required/>
      </div>
      <div class="clearfix hidden-md-up"></div>
      
      <label class="control-label col-md-1" for="number">Card number:</label>
      <div class="col-md-4 form-group">
        <input type="text" id="number" name="number" class="form-control"
		maxlength="16" size="16" required/>
      </div>
      <div class="clearfix hidden-md-up"></div>
      
      <label class="control-label col-md-1" for="cvc">CVC:</label>
      <div class="col-md-4 form-group">
        <input type="text" id="cvc" name="cvc" class="form-control"
		maxlength="3" size="3" required/>
      </div>
      <div class="clearfix hidden-md-up"></div>
      
      <label class="control-label col-md-1" for="axpDate">Expiry date:</label>
      <div class="col-md-4 form-group">
        <select id="month" name="month" required></select>
        <select id="year" name="year" required></select>
      </div>
      <div class="clearfix hidden-md-up"></div>
      
      <div class="col-md-offset-1 col-md-1">
        <button type="submit" class="btn btn-primary">Next</button>
      </div>
      
      <script src="scripts/checkout.js"></script>
    </form>
    
  </body>
</html>