<?php
include('autoloader.php');
$keyword = $_GET['flag'];
$search = new GameDetail($keyword);
$games = $search -> getGamesSort($keyword);
?>
<!doctype html>
<html>
    <?php include('includes/head.php') ?>
    <body>
        <?php include('includes/navbar.php') ?>
        <div class="container">
            <h3>All Games</h3>  
              <div class="row">
                  <?php
                    foreach( $games as $item ){
                        $game_id = $item['game_id'];
                        $game_name = $item['name'];
                        $game_price = $item['price'];
                        $game_image = $item['image'];
                        $game_console = $item['console'];
                        $game_release = $item['release_date'];
                        $game_description = TextUtility::summarize($item['description'], 15);
                        
                        echo "<div class = \"col-md-4\">
                                  <a href=\"gamedetail.php?product_id=$game_id\">
                                  <img class=\"gameImage\" src=\"images/games/$game_image\"/>
                                  </a>
                                  <h5>$game_name</h5>
                                  <h5>\$$game_price</h5>
                                  <p>$game_description</p>
                              </div>";
                    }
                  ?>
                  
              </div>
        </div>
        
    </body>
</html>