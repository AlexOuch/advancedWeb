<?php
$page_title = 'Home Page';
$fruits = array('apple', 'orange', 'banana', 'watermelon');
?>
<!doctype html>
<html>
    <head>
        <title>
            <?php echo $page_title ?>
        </title>
        <meta name="viewport" content="width=device-width,intial-scale=1.0">
        <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.css">
        <script src="node_modules/jquery/dist/jquery.js"></script>
        <script src="node_modules/popper.js/dist/umd/popper.js"></script>
        <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
    </head>
    
    <body>
        <!--navbar-->
        <nav class="navbar sticky-top navbar-dark bg-dark navbar-expand-lg">
            <a href="/" class="navbar-brand order-sm-8">Hello</a>
            <button class="navbar-toggler order-sm-5" type="button" data-toggle="collapse" data-target="#main-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="main-menu">
                <form class="form-inline ml-auto" method="get" action="search.php">
                    <input type="text" class="form-control" placeholder="search" name="search">
                    <button type="submit" class="btn btn-primary ml-2">Search</button>
                </form>
                <ul class="navbar-nav">
                    <li class="navbar-item">
                        <a href="/" class="nav-link">Home</a>
                    </li>
                    <li class="navbar-item">
                        <a href="/" class="nav-link">About</a>
                    </li>
                    <li class="navbar-item">
                        <a href="/" class="nav-link">News</a>
                    </li>
                    <li class="navbar-item">
                        <a href="/" class="nav-link">Contact</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid">
            
            <div class="row">
                <div class="col-sm-4 col-md-4 bg-primary border">
                    <h3>Column 1</h3>
                </div>
                <div class="col-sm-4 col-md-4 bg-primary border">
                    <h3>Column 2</h3>
                </div>
                <div class="col-sm-4 col-md-4 bg-primary border">
                    <h3>Column 3</h3>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 bg-secondary border">
                    <h3>Column 1</h3>
                </div>
                <div class="col-md-6 bg-secondary border">
                    <h3>Column 2</h3>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-3">
                    <h3>Column 1</h3>
                    <img class="img-fluid" src="https://dummyimage.com/800x600/0ea8f0/ffffff&text=Make+images+great+again">
                    <p>Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most times they're friends, like you and me! I should've known way back when... You know why, David? Because of the kids. They called me Mr Glass.
</p>
                </div>
                <div class="col-md-3">
                    <h3>Column 2</h3>
                    <img class="img-fluid" src="https://dummyimage.com/800x600/0ea8f0/ffffff&text=Make+images+great+again">
                    <p>Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most times they're friends, like you and me! I should've known way back when... You know why, David? Because of the kids. They called me Mr Glass.
</p>
                </div>
                <div class="col-md-3">
                    <h3>Column 3</h3>
                    <img class="img-fluid" src="https://dummyimage.com/800x600/0ea8f0/ffffff&text=Make+images+great+again">
                    <div class="row">
                        <div class = "col-md-6">
                            <h3>Sub Column 1</h3>
                            <p>Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most times they're friends, like you and me! I should've known way back when... You know why, David? Because of the kids. They called me Mr Glass.
</p>
                        </div>
                        <div class = "col-md-6">
                            <h3>Sub Column 2</h3>
                            <p>Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most times they're friends, like you and me! I should've known way back when... You know why, David? Because of the kids. They called me Mr Glass.
</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <h3>Column 4</h3>
                    <img class="img-fluid" src="https://dummyimage.com/800x600/0ea8f0/ffffff&text=Make+images+great+again">
                    <p>Now that we know who you are, I know who I am. I'm not a mistake! It all makes sense! In a comic, you know how you can tell who the arch-villain's going to be? He's the exact opposite of the hero. And most times they're friends, like you and me! I should've known way back when... You know why, David? Because of the kids. They called me Mr Glass.
</p>
                </div>
            </div>
            
            <div class="row">
                <?php
                foreach($fruits as $item)
                    echo "<div class><h3></h3></div>"
                ?>
            </div>
            
        </div>
        
    </body>
</html>