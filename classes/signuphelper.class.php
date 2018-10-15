<?php
class SignupHelper extends Database {
  public function __construct(){
    parent::__construct();
  }
  public function usernameExists( $username ){
    $query = "SELECT username from account WHERE username=?";
    $statement = $this -> connection -> prepare( $query );
    $statement -> bind_param('s', $username );
    $statement -> execute();
    $result = $statement -> get_result();
    if( $result -> num_rows > 0 ){
      $row = $result -> fetch_assoc();
      //return true if user exists
      return ( strtolower( $row['username'] ) == strtolower( $username ) ) ? true : false;
    }
    else{
      //return false if not
      return false;
    }
  }
  public function emailExists( $email ){
    $query = "SELECT email from account WHERE email=?";
    $statement = $this -> connection -> prepare( $query );
    $statement -> bind_param('s', $email );
    $statement -> execute();
    $result = $statement -> get_result();
    if( $result -> num_rows > 0 ){
      //email exists
      return true;
    }
    else{
      return false;
    }
  }
}

?>