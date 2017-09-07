<?php
$username = 'superadmin';
$password = '120v35watt';
$servername = 'localhost';
$dbname = 'store';

$conn = mysqli_connect($servername, $username, $password);
if(!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "CREATE DATABASE store";
if (mysqli_query($conn, $sql)) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . mysqli_error($conn);
}
echo "<br>";

mysqli_close($conn);

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// sql to create table
$sql = "CREATE TABLE Users (
user_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50) NOT NULL,
password VARCHAR(30) NOT NULL,
UNIQUE (email)
)";

if (mysqli_query($conn, $sql)) {
    echo "Table Users created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
echo "<br>";

// sql to create table
$sql = "CREATE TABLE Addresses (
address_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_id INT(6) UNSIGNED NOT NULL,
name VARCHAR(50) NOT NULL,
line1 VARCHAR(50) NOT NULL,
line2 VARCHAR(50),
city VARCHAR(30) NOT NULL,
province VARCHAR(30),
postcode VARCHAR(6) NOT NULL,
country VARCHAR(30) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    echo "Table Addresses created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
echo "<br>";

// sql to create table
$sql = "CREATE TABLE Products (
product_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(30) NOT NULL,
category VARCHAR(30) NOT NULL,
description VARCHAR(200),
image VARCHAR(50),
price FLOAT(10,2) NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    echo "Table Products created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
echo "<br>";

// sql to create table
$sql = "CREATE TABLE Cart (
cartitem_id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
user_id INT(6) UNSIGNED NOT NULL,
product_id INT(6) UNSIGNED NOT NULL
)";

if (mysqli_query($conn, $sql)) {
    echo "Table Users created successfully";
} else {
    echo "Error creating table: " . mysqli_error($conn);
}
echo "<br>";
  
# Add products
function insert($conn, $name, $category, $description, $image, $price){
  $sql = "INSERT INTO Products (name, category, description, image, price) VALUES ('$name', '$category', '$description', '$image', $price)";
  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
  echo "<br>";
}

insert($conn, "Desk lamp", "appliances", "Blue folding arm desk lamp. LED bulb. 4000 lumens. 50 W.", "big_work table lamp.jpg", 34.99);
insert($conn, "Desk chair", "furniture", "Work in style and comfort with this ergonomic desk chair. 225 lb capacity. 3 levers: recline, pitch and yaw.", "desk_chair.jpg", 87.99);
insert($conn, "Supreme King office desk", "furniture", "The Supreme King office desk is perfect for any domineering authority figure. Inspire awe in the hearts of all your underlings. Three drawers!", "free-desk-01.jpg", 49.99);

mysqli_close($conn);
?>