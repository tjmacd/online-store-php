<?php
$servername = "localhost";
$username = "admin";
#$username = "root";
$password = "120v35watt";
#$password = " ";
$dbname = "accounts";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
  die("connection failed: " . mysqli_connect_error());
}
echo "connected successfully";
$sql1 = "SELECT email FROM Users WHERE email = 'john@example.com'";
$result = mysqli_query($conn, $sql1);
if(mysqli_num_rows($result) > 0){
  echo "Account for this email already exists<br>";
}

$sql = "INSERT INTO Users (firstname, lastname, email, password) VALUES ('John', 'Doe', 'john@example.com', 'password')";
if(mysqli_query($conn, $sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
mysqli_close($conn);

?>