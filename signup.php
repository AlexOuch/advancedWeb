<?php
//include autoloader
include('autoloader.php');

//check request method
//if request is a POST request
if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
    //handle sign up here
    $account = new Account();
    //receive post variables from form
    $email = $_POST['email'];
    $password = $_POST['password'];
    $username = $_POST['username'];
    //sign user up
    $signup = $account -> create($username,$email,$password);
    if( $signup == true ){
        //signup succeeded
        //start session
        session_start();
        //create session variable with user's email
        $_SESSION['email'] = $email;
        //show success message
        $message = 'Your account has been created!';
        $message_class = 'success';
    }
    else{
        //signup failed
        $message = implode(' ', $account -> errors );
        $message_class = 'warning';
        //get the errors and show to user
    }
}

$page_title = 'Sign Up';
?>
<!doctype html>
<html>
    <?php include('includes/head.php') ?>
    <body class="content">
       <?php include('includes/navbar.php') ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <form id="signup-form" method="post" action="signup.php">
                        <h3>Sign up for an account</h3>
                        <div class="form-group">
                           <label for="username">Username</label>
                           <input class="form-control" type="text" name="username" id="username" placeholder="minimum 4 characters" required tabindex="1">
                           <div class="valid-feedback"></div>
                           <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                           <label for="email">Email Address</label>
                           <input class="form-control" type="email" name="email" id="email" placeholder="you@example.com" required tabindex="2">
                           <div class="valid-feedback"></div>
                           <div class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                           <label for="password">Password</label>
                           <input class="form-control" type="password" name="password" id="password" placeholder="minimum 6 characters" required tabindex="3">
                           <div class="valid-feedback"></div>
                           <div class="invalid-feedback"></div>
                        </div>
                        <button class="btn btn-warning mt-2" type="reset" tabindex="5">Clear</button>
                        <button class="btn btn-primary mt-2" type="submit" tabindex="4">
                            Sign up
                        </button>
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
        <script src="js/signup.js"></script>
    </body>
</html>