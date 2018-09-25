<?php
//include autoloader
include('autoloader.php');
if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  $account = new Account();
  $success = $account -> authenticate( $email, $password );
  if( $success == true ){
    //login successful
    session_start();
    $_SESSION['email'] = $email;
    //redirect user to home page
    header("location: index.php");
  }
  else{
    $message = 'Wrong credentials supplied';
    $message_class = 'warning';
  }
}
?>
<!doctype html>
<html>
  <?php include('includes/head.php') ?>
  <body class="content">
     <?php include('includes/navbar.php') ?>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-4 offset-md-4">
            <form id="signin-form" method="post" action="login.php">
              <h3>Sign in to your account</h3>
              <div class="form-group">
               <label for="email">Email Address</label>
               <input class="form-control" type="email" name="email" id="email" placeholder="you@example.com" required>
              </div>
              <div class="form-group">
               <label for="password">Password</label>
               <input class="form-control" type="password" name="password" id="password" placeholder="your password" required>
              </div>
              <button class="btn btn-warning mt-2" type="reset">Clear</button>
              <button name="signin" class="btn btn-primary mt-2" type="submit">Sign In</button>
            </form>
            <?php
            if( $message ){
                echo "<div class=\"alert alert-$message_class alert-dismissable fade show\">
                    $message
                    <button class=\"close\" type=\"button\" data-dismiss=\"alert\">
                        &times;
                    </button>
                </div>";
            }
            ?>
          </div>
        </div>
      </div>
      <script src="js/login.js"></script>
    </body>
</html>