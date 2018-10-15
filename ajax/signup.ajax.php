<?php
//handling requests for signup via ajax through signup.js file
//this file uses SignupHelper class and Validator class
session_start();

include('../autoloader.php');

if( $_SERVER['REQUEST_METHOD'] == 'POST'){
  //create username and email checker
  $helper = new SignupHelper();
  
  $response = array();
  $errors = array();
  
  $intent = $_POST['intent'];
  
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  
  //respond depending on intent of the request
  //checkusername
  if( $intent == 'checkusername' ){
    if( $helper -> usernameExists( $username ) ){
      //username exists
      $errors['username'] = 'already used';
      $response['success'] = false;
    }
    elseif( Validator::username($username) == false ){
      $errors['username'] = implode( ', <br>' ,Validator::$errors);
      Validator::resetErrors();
      $response['success'] = false;
    }
    else{
      $response['success'] = true;
    }
  }
  //checkemail
  if( $intent == 'checkemail' ){
    if( $helper -> emailExists( $email ) ){
      //username exists
      $errors['email'] = 'already used';
      $response['success'] = false;
    }
    elseif( Validator::email( $email ) == false ){
      $errors['email'] = implode( ', <br>' ,Validator::$errors);
      Validator::resetErrors();
      $response['success'] = false;
    }
    else{
      $response['success'] = true;
    }
  }
  if( $intent == 'checkpassword' ){
    if( Validator::password( $password ) == false ){
      $errors['email'] = implode( ', <br>' ,Validator::$errors);
      Validator::resetErrors();
      $response['success'] = false;
    }
    else{
      $response['success'] = true;
    }
  }
  //signup
  if( $intent == 'signup' ){
    //create the account
    $account = new Account();
    $signup = $account -> create( $username, $email, $password );
    switch( $signup ){
      case false :
        $errors['signup'] = $account -> errors;
        $response['success'] = false;
        break;
      case true :
        $response['success'] = true;
        //create session vars so user is logged in after signup
        $user = $account -> user;
        $response['user'] = $user;
        $session_vars = array(
          'account_id' => $user['account_id'],
          'username' => $user['username'],
          'email' => $user['email'],
          'img' => $user['profile_img']
        );
        //user session manager class to create session vars
        SessionManager::create( $session_vars );
        break;
      default:
        break;
    }
  }
  
  
  
  if( count( $errors ) > 0 ){
    $response['errors'] = $errors;
  }
  echo json_encode( $response );
}


?>