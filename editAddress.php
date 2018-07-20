<?php
#Check logged in
session_start();

if(!$_SESSION["email"]){
  header("Location: /login.php");
  die();
}
?>

<!DOCTYPE html>
<html>
  <head>
    <?php include 'scripts.php'; ?>
    <title id="title">Edit Address</title>
  </head>
  <body>
    <?php include 'menu.php'; ?>
    
    <?php
    $conn = mysqli_connect($servername, $username, $adminPassword, $dbname);
    if(!$conn) {
      die("connection to database failed: " . mysqli_connect_error());
    }
    if($_SERVER["REQUEST_METHOD"] == "GET") {
      $sql = "SELECT address_id, name, line1, line2, city, province, postcode, country FROM Addresses WHERE address_id = '" . $_GET["id"]."'";
      $addresses = mysqli_query($conn, $sql);
      $address = mysqli_fetch_assoc($addresses);
      $name = $address["name"];
      $line1 = $address["line1"];
      $line2 = $address["line2"];
      $city = $address["city"];
      $province = $address["province"];
      $postcode = $address["postcode"];
      $country = $address["country"];
      $errMessage = "";
    }
    
    if($_SERVER["REQUEST_METHOD"] == "POST") {
      $name = test_input($_POST["name"]);
      $line1 = test_input($_POST["line1"]);
      $line2 = test_input($_POST["line2"]);
      $city = test_input($_POST["city"]);
      $province = test_input($_POST["province"]);
      $postcode = test_input($_POST["postcode"]);
      $country = test_input($_POST["country"]);
      
      if($name == "" || $line1 == "" || $city == "" || $postcode == "" || $country == ""){
        $errMessage = "Please enter all required fields.";
      } else {
        
        $sql = "UPDATE Addresses SET name='$name', line1='$line1', line2='$line2', city='$city', province='$province', postcode='$postcode', country='$country' WHERE address_id = '".$_POST['id']."'";
        if(mysqli_query($conn, $sql) === TRUE) {
          header('Location: '.$_SESSION["returnTo"]);
          die();
        } else {
          die('Error: ' . $sql . "<br>" . mysqli_error($conn));
        }
        
      }
    }
    mysqli_close($conn);
    ?>
    
    <h3>New Address</h3>
    <form name="addressForm" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post" class="form-vertical">
      <label class="control-label col-md-1" for="name">*Name:</label>
      <div class="col-md-4 form-group">
        <input type="text" id="name" name="name" class="form-control" value="<?php echo $name;?>" required />
      </div>
      
      <div class="clearfix hidden-sm-up"></div>
      <label class="control-label col-md-1" for="line1">*Address Line 1:</label>
      <div class="col-md-4 form-group">
        <input type="text" id="line1" name="line1" class="form-control" value="<?php echo $line1;?>" required/>
      </div>
      
      <div class="clearfix hidden-sm-up"></div>
      <label class="control-label col-md-1" for="line2">Address Line 2:</label>
      <div class="col-md-4 form-group">
        <input type="text" id="line2" name="line2" class="form-control" value="<?php echo $line2;?>"/>
      </div>
      
      <div class="clearfix hidden-sm-up"></div>
      <label class="control-label col-md-1" for="city">*City:</label>
      <div class="col-md-4 form-group">
        <input type="text" id="city" name="city" class="form-control" value="<?php echo $city;?>" required/>
      </div>
      
      <div class="clearfix hidden-sm-up"></div>
      <label class="control-label col-md-1" for="province">Province:</label>
      <div class="col-md-4 form-group">
        <input type="text"
				   id="province"
				   name="province"
				   class="form-control"
					value="<?php echo $province;?>"/>
      </div>
      
      <div class="clearfix hidden-sm-up"></div>
      <label class="control-label col-md-1" for="postcode">*Postal code:</label>
      <div class="col-md-4 form-group">
        <input type="text"
				   id="postcode"
				   name="postcode"
				   class="form-control"
					value="<?php echo $postcode;?>"
					required/>
      </div>
      
      <div class="clearfix hidden-sm-up"></div>
      <label class="control-label col-md-1" for="country">*Country:</label>
      <div class="col-md-4 form-group">
        <input type="text"
				   id="country"
				   name="country"
				   class="form-control"
					value="<?php echo $country;?>"
					required/>
      </div>
      
      <div class="clearfix hidden-sm-up"></div>
      
      <input type="hidden" name="id" id="id" value="<?php echo $_GET['id'];?>"/>
      
      <div class="col-md-offset-1 col-md-1">
        <button type="submit",class="btn btn-primary">Save</button>
      </div>
    </form>
  </body>
</html>