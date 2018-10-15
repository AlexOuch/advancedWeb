<?php
if( isset( $_SESSION['email'])){
    $loginout = array(
        'Log Out' => 'logout.php'
        );
}
else{
    $loginout = array(
        'Sign Up' => 'signup.php',
        'Log In' => 'login.php'
        );
}

?>
<!--navbar-->
<nav class="navbar sticky-top navbar-dark bg-dark navbar-expand-lg">
    <button class="navbar-toggler order-sm-5" type="button" data-toggle="collapse" data-target="#main-menu">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="main-menu">
        <ul class="navbar-nav">
            <li class = "nav-item">
                <a href = "index.php" class = "nav-link">Home</a>
            </li>
            <li class = "nav-item">
                <a href = "consoles.php" class = "nav-link">Consoles</a>
            </li>
            <li class = "nav-item">
                <button class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Games</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="psphome.php">PSP</a>
                    <a class="dropdown-item" href="psvitahome.php">PSVita</a>
                    <a class="dropdown-item" href="ps3home.php">PS3</a>
                    <a class="dropdown-item" href="ps4home.php">PS4</a>
                </div>
            </li>
            <li class = "nav-item">
                <button class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sort By</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="sort.php?flag=game.release_date desc">Release Date</a>
                    <a class="dropdown-item" href="sort.php?flag=game.price asc">Price (ascending)</a>
                    <a class="dropdown-item" href="sort.php?flag=game.price desc">Price (descending)</a>
                    <a class="dropdown-item" href="sort.php?flag=game.name asc">Name (ascending)</a>
                    <a class="dropdown-item" href="sort.php?flag=game.name desc">Name (descending)</a>
                </div>
            </li>
        </ul>
        <form class="form-inline ml-auto" method="get" action="search.php">
            <input type="text" class="form-control" placeholder="search" name="search">
            <button type="submit" class="btn btn-primary ml-2">Search</button>
        </form>
                <ul class="navbar-nav">
            <?php
            foreach( $loginout as $key => $value ){
                echo "<li class=\"nav-item\">
                <a href=\"$value\" class=\"nav-link\">$key</a>
                </li>";
            }
            ?>
            <img class = "shoppingCartIcon" href="shoppingcart.php" src="images/shoppingCartIcon.png">
        </ul>
    </div>
</nav>