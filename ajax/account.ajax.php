<?php
//handling requests to do with account
session_start();

include('../autoloader.php');



//authentication required
if( !$_SESSION['email'] ){
  exit();
}

//check for POST request
if( $_SERVER['REQUEST_METHOD'] == 'POST'){
  $response = array();
  $errors = array();
  
  $helper = new AccountHelper( $_POST['account_id'] );
  //check intent
  $intent = $_POST['intent'];
  //check the username
  if( $intent == 'checkuser'){
    $username = $_POST['username'];
    //check if username exists
    //if user exists, return false
    if( $helper -> userExists( $username ) ){
      $errors['username'] = 'username already used';
    }
    //check if username is valid using Validator class
    if( Validator::username( $username ) == false ){
      $errors['validate'] = implode( ',' ,Validator::$errors);
    }
    $response['success'] = count( $errors ) == 0 ? true : false;
    
  }
  
  if( $intent == 'checkemail' ){
    $email = $_POST['email'];
    //check if email exists
    if( $helper -> emailExists( $email ) ){
      $errors['email'] = 'email already used';
    }
    //check if email is valid
    if( Validator::email( $email) == false ){
      $errors['validate'] = implode( ',' , Validator::$errors );
    }
    $response['success'] = count( $errors ) == 0 ? true : false;
  }
  
  if( $intent == 'validatepasswords' ){
    $passwords = $_POST['passwords'];
    if( $passwords[0] !== $passwords[1] ){
      $errors['passwords'] = 'passwords not equal';
    }
    if( Validator::password( $passwords[0] ) == false ){
      $errors['validate'] = implode( ',' , Validator::$errors );
    }
    $response['success'] = count( $errors ) == 0 ? true : false;
  }
  if( count($errors) > 0 ){
    $response['errors'] = $errors;
  }
  echo json_encode( $response );
}
?>