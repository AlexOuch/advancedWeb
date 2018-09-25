<?php
include('autoloader.php');
//receive get requests for product_id
$id = $_GET['product_id'];
$detail = new ProductDetail();
$pd = $detail -> getProduct($id);

?>

<!doctype html>
<html>  
    <?php include('includes/head.php') ?>
    <body>
        <?php include('includes/navbar.php') ?>
        <div class="container-fluid">
              <div class="row">
                  <div class="col-md-6">
                      <?php
                      foreach( $pd as $prod ){
                          $img = 'images/products/' . $prod['image_file_name'];
                          echo "<img class=\"img-fluid\" src=\"$img\">";
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
                      <h5 class = "price"><?php echo $price; ?></h5>
                      <p><?php echo $description; ?></p>
                  </div>
              </div>
        </div>
        
    </body>
</html>