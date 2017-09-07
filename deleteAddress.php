<?php include 'scripts.php';
#Check logged in
session_start();

if(!$_SESSION["email"]){
  header("Location: /login.php");
  die();
}

$conn = mysqli_connect($servername, $username, $adminPassword, $dbname);
if(!$conn) {
  die("connection to database failed: " . mysqli_connect_error());
}

$sql = "DELETE FROM Addresses WHERE address_id = ".$_GET["id"];
mysqli_query($conn, $sql);

mysqli_close($conn);
header("Location: ". $_SESSION["returnTo"]);
?>
    