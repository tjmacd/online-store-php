<?php 
session_start();
if($_SESSION["email"]){
  header("Location: /main.php");
  die();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title id="title">Log In</title>
    <?php include 'scripts.php'; ?>
  </head>
  <body>
    <?php include 'menu.php'; ?>
    
    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $email = test_input($_POST["email"]);
      $password = test_input($_POST["password"]);
      
      $conn = mysqli_connect($servername, $username, $adminPassword, "accounts");
      if(!$conn) {
        die("connection to database failed: " . mysqli_connect_error());
      }
      $sql = "SELECT email, firstname FROM Users WHERE email = '$email' and password = '$password'";
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) == 1) {
        
        session_start();
        $_SESSION["email"] = $email;
        $row = mysqli_fetch_assoc($result);
        $_SESSION["username"] = $row["firstname"];
        $errMessage = "Login success";
        
        if($_SESSION["returnTo"]) {
          header('Location: ' . $_SESSION["returnTo"]);
        } else {
          header('Location: /main.php');
        }
        die();
        
      } else {
        $errMessage = "Username or password incorrect";
      }
    }
    ?>
    
    <?php echo "<div>$errMessage</div>"; ?>
    
    
    <h3>Log In</h3>
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" 
          method="post" 
          class="form-vertical">
      <label class="control-label col-md-1" for="email">E-mail:</label>
      <div class="col-md-4 form-group">
        <input type="text" 
               id="email" 
               name="email" 
               placeholder="E-mail Address" 
               value="<?php echo $email; ?>"
               class="form-control"/>
      </div>
      <div class="clearfix hidden-md-up"></div>

      <label class="control-label col-md-1" for="password">Password:</label> 
      <div class="col-md-4 form-group">
      <input type="password"
				   id="password"
				   name="password"
				   placeholder="Password"
				   class="form-control"/>
      </div>
      <div class="clearfix hidden-md-up"></div>

      <div class="col-md-offset-1 col-md-1">
        <button type="submit" class="btn btn-primary">Log In</button> 
      </div>
			
      <div class="clearfix hidden-md-up"></div>

      <div class="container">Don't have an account? 
        <a href="/register.php">Register now.</a> 
      </div> 
			
    </form>
  </body>
</html>