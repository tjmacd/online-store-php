<!DOCTYPE html>
<html>
  <head>
    <?php include 'scripts.php'; ?>
    <?php
      $conn = mysqli_connect($servername, $username, $adminPassword, $dbname);
      if(!$conn) {
        die("connection to database failed: " . mysqli_connect_error());
      }
      $sql = "SELECT product_id, name, image, price, description FROM Products WHERE product_id = " . test_input($_GET["id"]);
      $result = mysqli_query($conn, $sql);
      if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $title = $row["name"];
      } else {
        $title = "Product not found!";
      }
      mysqli_close($conn);
    ?>
    <title id="title"><?php echo $title;?></title>
  </head>
  <body>
    <?php include 'menu.php'; ?>
    <?php  
      
      if(mysqli_num_rows($result) > 0) {
        echo ('<div class="product panel panel-default col-md-3">
          <div class="panel-heading">' . $row["name"] . '</div>
          <div class="panel-body">
            <img src="/image/' . $row["image"] . '"/>
          </div>
          <div class="panel-body">Price: $' . $row["price"] . '</div>
          <div class="panel-body">Description: '. $row["description"] . '</div>
        </div>
        <a class="btn btn-default" href="/addCart.php?id=' . $row["product_id"].'">Add to cart</a>');   
        
      } else {
        echo "Product not found.";
      }
    
      
    ?>
    
  </body>
</html>