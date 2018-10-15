<?php
include('autoloader.php');
//receive get requests for product_id
$id = $_GET['product_id'];
$detail = new ConsoleDetail();
$pd = $detail -> getConsole($id);

?>

<!doctype html>
<html>  
    <?php include('includes/head.php') ?>
    <body>
        <?php include('includes/navbar.php') ?>
        <div class="container">
              <div class="row">
                  <div class="col-md-6">
                      <?php
                      foreach( $pd as $prod ){
                          $img = 'images/consoles/' . $prod['image'];
                          echo "<img class=\"gameDetailImg\" src=\"$img\">";
                      }
                      ?>
                  </div>
                  <div class="col-md-6">
                      <?php
                      $product = $pd[0];
                      $id = $product['id'];
                      $name = $product['name'];
                      $description= $product['description'];
                      $price = $product['price'];
                      ?>
                      <h2><?php echo $name; ?></h2>
                      <h5>Price: $<?php echo $price; ?></h5>
                      <row><h5>Description</h5></row>
                      <p><?php echo $description; ?></p>
                  </div>
              </div>
        </div>
        
    </body>
</html>