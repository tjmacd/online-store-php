
<?php include 'scripts.php';
#Check logged in
session_start();
if(!$_SESSION["email"]){
  $_SESSION["returnTo"] = "./addCart.php?id=". test_input($_GET["id"]);
  header("Location: ./login.php");
  die();
}

$conn = mysqli_connect($servername, $username, $adminPassword, $dbname);
if(!$conn) {
  die("connection to database failed: " . mysqli_connect_error());
}
$sql = "SELECT product_id FROM Products WHERE product_id = " . test_input($_GET["id"]);
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) == 0) {
  die("Product could not be found");
}
$row = mysqli_fetch_assoc($result);
$productID = $row["product_id"];
$sql = "SELECT user_id FROM Users WHERE email = '" . $_SESSION["email"] . "'";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) == 0) {
  die("Something went wrong!");
}
$row = mysqli_fetch_assoc($result);
$userID = $row["user_id"];
$sql = "INSERT INTO Cart (user_id, product_id) VALUES ('$userID', '$productID')";
if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
  header("Location: ./cart.php");
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);


?>

 
