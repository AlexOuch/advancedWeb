<?php
class Account extends Database{
  public $errors = array();
  public $user = array();
  public function __construct(){
    parent::__construct();
  }
  public function create($username,$email,$password){
    //create array to store errors
    $errors = array();
    //use validator class to validate username password and email
    if( Validator::username($username) == false ){
      $errors['username'] = Validator::$errors;
      Validator::resetErrors();
    }
    if( Validator::password($password) == false ){
      $errors['password'] = Validator::$errors;
      Validator::resetErrors();
    }
    if( Validator::email($email) == false ){
      $errors['email'] = Validator::$errors;
      Validator::resetErrors();
    }
    //check if user or email exists
    $helper = new SignupHelper();
    if( $helper -> usernameExists( $username ) ){
      $errors['username'] = 'username already used';
    }
    if( $helper -> emailExists( $email ) ){
      //username exists
      $errors['email'] = 'email already used';
    }
    //check if there are no errors
    if( count($errors) == 0 ){
      //proceed and create account
      $query = "INSERT INTO account 
              (username,email,password,created,accessed,profile_img,active)
              VALUES 
              (? , ? , ?, NOW(), NOW(), 'default.jpg', 1 )";
      $hash = password_hash( $password, PASSWORD_DEFAULT );
      $statement = $this -> connection -> prepare($query);
      $statement -> bind_param('sss', $username, $email, $hash );
      $success = $statement -> execute() ? true : false ;
      //check the error code
      if( $success == false && $this -> connection -> errno == '1062' ){
        //check if it is email or username error
        $msg = $this -> connection -> error;
        if( strpos($msg,'username') > 0 ){
            $errors['username'] = 'username already used';
        }
        if( strpos($msg,'email') > 0 ){
            $errors['email'] = 'email already used';
        }
        $this -> errors = $errors;
      }
      elseif( $success == true ){
        $this -> user['account_id'] = $this -> connection -> insert_id;
        $this -> user['email'] = $email;
        $this -> user['img'] = 'default.jpg';
        $this -> user['username'] = $username;
      }
      return $success;
    }
    else{
      $this -> errors = $errors;
      return false;
    }
  }
    public function authenticate( $email, $password ){
      $query = 'SELECT 
      account_id,
      email, 
      password, 
      username, 
      profile_img,
      accessed,
      updated
      FROM account 
      WHERE email=? AND active=1';
      $statement = $this -> connection -> prepare($query);
      $statement -> bind_param('s', $email);
      $statement -> execute();
      $result = $statement -> get_result();
      if( $result -> num_rows == 0 ){
        //account does not exist
        $this -> errors['auth'] = 'account does not exist';
        return false;
      }
      else{
        $account = $result -> fetch_assoc();
        $this -> user['account_id'] = $account['account_id'];
        $this -> user['email'] = $account['email'];
        $this -> user['img'] = $account['profile_img'];
        $this -> user['username'] = $account['username'];
        $this -> user['accessed'] = $account['accessed'];
        $this -> user['updated'] = $account['updated'];
        $hash = $account['password'];
          
        $match = password_verify( $password, $hash );
        if( $match == true ){
          //password is correct
          //update account accessed date
          $accessed = $this -> updateAccessed( $account['account_id'] );
          return true;
        }
        else{
          //wrong password
          $this -> errors['auth'] = 'credentials do not match our records';
          return false;
        }
    }
  }
  private function updateAccessed( $account_id ){
    $query = 'UPDATE account SET accessed=NOW() WHERE account_id=?';
    $statement = $this -> connection -> prepare( $query  );
    $statement -> bind_param('i', $account_id );
    if( $statement -> execute() ){ 
      return true; 
    }
    else{
      $this -> errors['error updating log'];
      return false;
    }
  }
}
?>