<?php
class AccountManager extends Account{
  private $account_id;
  public $errors = array();
  public function __construct(){
    parent::__construct();
  }
  public function getData( $account_id ){
    //get account data by its id
    $query = 'SELECT 
    account_id, 
    email, 
    username, 
    profile_img,
    accessed,
    updated
    FROM account
    WHERE account_id = ?';
    $statement = $this -> connection -> prepare( $query );
    $statement -> bind_param('i', $account_id );
    try{
      if( $statement -> execute() == false ){
        throw new Exception('query failed');
      }
      else{
        $result = $statement -> get_result();
        if( $result -> num_rows == 0 ){
          throw new Exception('no account found');
        }
        else{
          $row = $result -> fetch_assoc();
          return $row;
        }
      }
    }
    catch( Exception $exc ){
      $this -> errors['query'] = $exc -> getMessage();
    }
  }
  
  //update the account password
  public function updatePasswords( $account_id , Array $passwords ){
    //check the passwords
    $pwcheck = $this -> checkPasswords( $passwords );
    //when all checks are true update the account
    if( $pwcheck == true ){
      //update the account
      $query = 'UPDATE account SET password=? WHERE account_id=?';
      $statement = $this -> connection -> prepare( $query );
      //hash password
      $hash = password_hash( $passwords[0], PASSWORD_DEFAULT ); 
      //bind the parameters
      $statement -> bind_param('si', $hash, $account_id);
      $success = $statement -> execute() ? true : false;
      if( $success ){
        $update = $this -> setDateUpdated( $account_id );
        return $update ? true : false;
      }
      else{
        return false;
      }
    }
    else{
      return false;
    }
  }
  //update account info
  public function updateAccountInfo( $account_id , $username, $email ){
    //update the account
    $query = 'UPDATE account SET username=?, email=? WHERE account_id=?';
    $statement = $this -> connection -> prepare( $query );
    //bind the parameters
    $statement -> bind_param('ssi', $username, $email, $account_id );
    //return true if statement executes
    $success = $statement -> execute() ? true : false;
    if( $success ){
      $update = $this -> setDateUpdated( $account_id );
      return $update ? true : false;
    }
    else{
      return false;
    }
  }
  //update the profile image
  public function updateProfileImage( $account_id , $profile_img ){
    //update the account
    $query = 'UPDATE account SET profile_img=? WHERE account_id=?';
    //echo "UPDATE account SET profile_img='$profile_img' WHERE account_id='$account_id'";
    $statement = $this -> connection -> prepare( $query );
    //bind the parameters
    $statement -> bind_param('si', $profile_img , $account_id );
    //return true if statement executes
    $success = $statement -> execute() ? true : false;
    if( $success ){
      $update = $this -> setDateUpdated( $account_id );
      return $update ? true : false;
    }
    else{
      return false;
    }
  }
  
  //this function takes an array of 2 passwords as parameter and check them for errors and validity
  private function checkPasswords( Array $passwords ){
    $pwerrors = array();
    if( $passwords[0] !== $passwords[1] ){
      array_push( $pwerrors, 'passwords do not match');
    }
    //check if the password is valid
    if( Validator::password( $passwords[0] ) == false ){
      array_push( $pwerrors, implode( ',', Validator::$errors ) );
    }
    //return false if there are errors, true if there are none
    if( count($pwerrors) == 0 ){
      return true;
    }
    else{
      $this -> errors['password'] = implode( ',' , $pwerrors );
      return false;
    }
  }
  private function setDateUpdated( $account_id ){
    $query = 'UPDATE account SET updated=NOW() WHERE account_id=?';
    $statement = $this -> connection -> prepare( $query );
    //bind the parameters
    $statement -> bind_param('i',  $account_id );
    //return true if statement executes
    return $statement -> execute() ? true : false;
  }
}
?>