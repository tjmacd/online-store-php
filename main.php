<!DOCTYPE html>
<html>
  <head>
    <title id="title">Junk Mart</title>
    <?php include 'scripts.php'; ?>
  </head>
  <body>
    <?php include 'menu.php'; ?>
    <?php 
      $conn = mysqli_connect($servername, $username, $adminPassword, "store");
      if(!$conn) {
        die("connection to database failed: " . mysqli_connect_error());
      }
      $sql = "SELECT product_id, name, image, price FROM Products";
      $result = mysqli_query($conn, $sql);
      
      if(mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
          echo ('<a href="/product.php?id=' . $row["product_id"] . '">
            <div class="panel panel-default col-md-3">' .
              '<div class="panel-heading">' . $row["name"] . '</div>
              <div class="panel-body imageFrame">
                <img src="/image/' . $row["image"] . '"/>
              </div>
              <div class="panel-footer">Price: $' . $row["price"] . '</div>
            </div>
          </a>');   
        }
      } else {
        echo "Database empty";
      }
    
      mysqli_close($conn);
    ?>
    
  </body>
</html>