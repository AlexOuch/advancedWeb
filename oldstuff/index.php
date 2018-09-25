<?php
session_start();
//include autoloader
include('autoloader.php');
//create instance of products class
$prods = new Products();
$products = $prods -> getProducts();
$page_title = 'Home Page';

?>
<!doctype html>
<html>
    <?php include('includes/head.php') ?>
    <body>
        <?php include('includes/navbar.php') ?>
        <div class="container-fluid">
              <div class="row">
                  <?php
                    foreach( $products as $item ){
                        $product_id = $item['id'];
                        $product_name = $item['name'];
                        $product_description = TextUtility::summarize($item['description'], 15);
                        $product_price = $item['price'];
                        $product_image = $item['image_file_name'];
                        
                        echo "<div class=\"col-md-3\">
                        <h4>$product_name</h4>
                        <img src=\"images/products/$product_image\" class=\"img-fluid\">
                        <h5>$product_price</h5>
                        <p>$product_description</p>
                        <a href=\"detail.php?product_id=$product_id\">Details</a>
                        </div>";
                    }
                  ?>
              </div>
        </div>
        
    </body>
</html>