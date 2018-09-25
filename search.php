<?php
include('autoloader.php');
$keyword = $_GET['search'];

$search = new GameSearch($keyword);
$result = $search -> search($keyword);
?>
<!doctype html>
<html>
    <?php include('includes/head.php') ?>
    <body>
        <?php include('includes/navbar.php') ?>
        <div class="container">
            <?php
            //check if search returns result
            if (count ($result) == 0){
                echo "<h1>Your search for $keyword returned no result</h1>";
            }
            //if there are results
            else{
                echo "<div class = \"row\">
                    <h3>You searched for $keyword</h3>
                    </div>";
                foreach( $result as $item){
                    $id = $item['game_id'];
                    $name = $item['name'];
                    $price = $item['price'];
                    $image = 'images/games/' . $item['image'];
                    echo "<div class=\"row my-2\">
                        <div class=\"col-sm-3\">
                            <img src=\"$image\" class=\"img-fluid\">
                        </div> 
                        <div class=\"col-sm-6\">
                            <h3>$name</h3>
                            <h3>\$$price</h3>
                        </div>
                        <div class=\"col-sm-3\">
                            <a href=\"gamedetail.php?product_id=$id\">Detail</a>
                        </div>
                    </div><hr>";
                }
            }
            ?>
        </div>
        
    </body>
</html>