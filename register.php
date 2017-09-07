<!DOCTYPE html>
<html>
  <head>
    <title id="title">Account Creation</title>
    <?php include 'scripts.php'; ?>
  </head>
  <body>
    <?php include 'menu.php'; ?>
    
    <?php
    $firstname = $lastname = $email = $password = $confirmPassword = "";
    $errMessage = "";
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $firstname = test_input($_POST["firstname"]);
      $lastname = test_input($_POST["lastname"]);
      $email = test_input($_POST["email"]);
      $password = test_input($_POST["password"]);
      $confirmPassword = test_input($_POST["confirmPassword"]);
      
      if($firstname == "" || $lastname == "" || $email == "" || $password == "" || confirmPassword == ""){
        $errMessage = "All fields must be filled!";
      } elseif ($password != $confirmPassword) {
        $errMessage = "Passwords do not match!";
      } else {
        $conn = mysqli_connect($servername, $username, $adminPassword, $dbname);
        if(!$conn) {
          die("connection to database failed: " . mysqli_connect_error());
        }
        $sql = "SELECT email FROM Users WHERE email = '$email'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) > 0){
          $errMessage = "Account for this email already exists!";
        } else {
          $sql = "INSERT INTO Users (firstname, lastname, email, password) VALUES ('$firstname', '$lastname', '$email', '$password')";
          if(mysqli_query($conn, $sql) === TRUE) {
            header('Location: /registerSuccess.php');
            die();
          } else {
            die('Error: ' . $sql . "<br>" . mysqli_error($conn));
          }
          
        }
        mysqli_close($conn);
      }
    }
    
    ?>
    
    <h3>Register</h3>
    <form name="registerForm"
			action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"
		  method="post"
		  class="form-vertical">
      <label class="control-label col-md-1" for="firstname">First name:</label> 
      <div class="col-md-4 form-group">
        <input type="text"
				   id="firstname"
				   name="firstname"
				   placeholder="First name"
                   value="<?php echo $firstname;?>"
				   class="form-control"
					required/>
      </div>
      
      <div class="clearfix hidden-sm-up"></div>

      <label class="control-label col-md-1" for="lastname">Last name:</label> 
      <div class="col-md-4 form-group">
        <input type="text"
				   id="lastname"
				   name="lastname"
				   placeholder="Last name"
                   value="<?php echo $lastname;?>"
				   class="form-control"
					required />
      </div>
      
      <div class="clearfix hidden-sm-up"></div>
		
      <label class="control-label col-md-1" for="email">E-Mail:</label> 
      <div class="col-md-4 form-group">
        <input type="email"
				   id="email"
				   name="email"
				   placeholder="E-Mail Address"
                   value="<?php echo $email;?>"
				   class="form-control"
					required />
      </div>
      
      <div class="clearfix hidden-sm-up"></div>

      <label class="control-label col-md-1" for="password">Password:</label> 
      <div class="col-md-4 form-group">
        <input type="password"
				   id="password"
				   name="password"
				   placeholder="Password"
                   value="<?php echo $password;?>"
				   class="form-control"
					required />
      </div>
      
      <div class="clearfix hidden-sm-up"></div>

      <label class="control-label col-md-1" for="confirmPassword">Confirm Password:</label> 
      <div id="confirmDiv" class="col-md-4 form-group">
        <input type="password"
				   id="confirmPassword"
				   name="confirmPassword"
				   placeholder="Password"
                   value="<?php echo $confirmPassword;?>"
				   class="form-control"
					required />
        <?php echo $errMessage;?>
      </div>
      
      
      <div class="clearfix hidden-sm-up"></div>

      <div class="col-md-offset-1 col-md-1">
        <button type="submit" class="btn btn-primary">Register</button> 
      </div>
    </form>
  </body>
</html>