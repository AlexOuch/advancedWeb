<?php
session_start();
//if user is not logged in, redirect to login.php

if( !$_SESSION['email'] ){
  header('location: login.php');
}
//include autoloader
include('autoloader.php');

$acm = new AccountManager();

//if user is updating account
if( $_SERVER['REQUEST_METHOD'] == 'POST' ){
  //handle post data
  //get account id from the session
  $account_id = $_SESSION['account_id'];
  
  //check if there's profile image being uploaded
  //if no image is uploaded, the error code is 4
  if( $_FILES['profile-image']['error'] !== 4 ){
    //create an image uploader
    //set maximum 100000 bytes (100KB)
    $max_size = 100000;
    $dir = 'images/profiles';
    $uploader = new ImageUpload($max_size,$dir);
    $uploader -> upload( $_FILES );
    $filename = $uploader -> uploaded['name'];
    $update_img = $acm -> updateProfileImage( $account_id, $filename );
  }
  //if there are passwords
  if( strlen( $_POST['password1'] ) > 0 && strlen( $_POST['password2'] ) > 0 ){
    //--create array from the two password fields
    $passwords = array( $_POST['password1'], $_POST['password2'] );
    //update the password
    $update_pwd = $acm -> updatePasswords($account_id, $passwords);
  }
  //update the account info
  $email = $_POST['email'];
  $username = $_POST['username'];
  $update_acct = $acm -> updateAccountInfo($account_id, $username ,$email);
}




//get user data to show in update form
$account_data = $acm -> getData( $_SESSION['account_id'] );
$account_id = $account_data['account_id'];
$email = $account_data['email'];
$username = $account_data['username'];
$profile_img = $account_data['profile_img'];


//update session data
$_SESSION['username'] = $username;
$_SESSION['email'] = $email;
$_SESSION['img'] = $profile_img;

?>
<!doctype html>
<html>
  <?php include('includes/head.php') ?>
  <body class="content">
     <?php include('includes/navbar.php') ?>
    <div class="container">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <h3 class="text-capitalize">
            <?php echo $_SESSION['username']."'s"; ?> Account
          </h3>
        </div>
      </div>
        <form id="account-update" class="row" method="post"  action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
          <section class="profile col-sm-2 col-md-2 offset-md-2">
              <img id="account-profile" class="img-fluid border rounded-circle" src="/images/profiles/<?php echo $profile_img; ?>">
              <label for="profile-image" class="btn btn-outline-secondary">
                <i class="fas fa-pen"></i>
              </label>
              <span class="ml-2" id="profile-image-info"></span>
              <input type="file" id="profile-image" class="d-none" name="profile-image" value="<?php echo $profile_img; ?>">
          </section>
          <section class="col-sm-6 col-md-6">
              <input type="hidden" name="account_id" value="<?php echo $account_id; ?>">
              <div class="form-group">
                <label for="username">Username</label>
                <input id="username" type="text" name="username" class="form-control" required value="<?php echo $username; ?>" placeholder="minimum 6 characters">
                <div class="invalid-feedback">The username has been taken</div>
              </div>
              <div class="form-group">
                <label for="email">Email Address</label>
                <input id="email" type="email" name="email" class="form-control" required value="<?php echo $email; ?>" placeholder="you@domain.com">
                <div class="invalid-feedback">Must be a valid email address</div>
              </div>
              <div class="form-group">
                <label for="password1">New Password</label>
                <input id="password1" type="password" class="form-control" name="password1" placeholder="minimum 8 characters">
              </div>
              <div class="form-group">
                <label for="password2">Retype Password</label>
                <input id="password2" type="password" class="form-control"  name="password2" placeholder="retype your new password">
                <div class="invalid-feedback">Must contain a special character, a number and be more than 8 characters</div>
              </div>
              <button type="submit" class="btn btn-outline-secondary">Update</button>
          </section>
        </form>
    </div>
    <script src="/js/account-page.js"></script>
  </body>
</html>