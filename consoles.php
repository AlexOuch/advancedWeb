<?php
session_start();
//include autoloader
include('autoloader.php');
//create instance of products class
$con = new Consoles();
$consoles = $con -> getConsoles();
$page_title = 'Consoles';

?>
<!doctype html>
<html>
    <?php include('includes/head.php') ?>
    <body>
        <?php include('includes/navbar.php') ?>
        <div class="container">
            <h3>Consoles</h3>
              <div class="row">
                  <?php
                    foreach( $consoles as $item ){
                        $console_id = $item['console_id'];
                        $console_name = $item['name'];
                        $console_price = $item['price'];
                        $console_image = $item['image'];
                        $console_description = TextUtility::summarize($item['description'], 15);
                        
                        echo "<div class = \"col-md-4\">
                                  <a href=\"consoledetail.php?product_id=$console_id\">
                                  <img class=\"gameImage\" src=\"images/consoles/$console_image\"/>
                                  </a>
                                  <h5>$console_name</h5>
                                  <h5>\$$console_price</h5>
                                  <p>$console_description</p>
                              </div>";
                    }
                  ?>
                  
              </div>
        </div>
        
    </body>
</html>