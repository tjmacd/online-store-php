<!DOCTYPE html>
<html>
  <head>
    <title id="title">Search results for <?php echo $_GET["query"];?></title>
    <?php include 'scripts.php'; ?>
  </head>
  <body>
    <?php include 'menu.php'; ?>
    <?php 
      $conn = mysqli_connect($servername, $username, $adminPassword, $dbname);
      if(!$conn) {
        die("connection to database failed: " . mysqli_connect_error());
      }
      $sql = "SELECT product_id, name, image, price FROM Products WHERE concat_ws('|', name, category, description) LIKE '%".$_GET["query"]."%'";
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
        echo "No results found";
      }
    
      mysqli_close($conn);
    ?>
    
  </body>
</html>