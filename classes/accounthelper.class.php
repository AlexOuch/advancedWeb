<?php
//this class checks if a user already exits and if email is already used
//when a user updates their account details (already logged in)
class AccountHelper extends Account{
  private $account_id;
  public function __construct($account_id){
    $this -> account_id = $account_id;
    parent::__construct();
  }
  public function userExists( $username ){
    //select usernames that does not have the user's account id
    $query = 'SELECT username FROM account WHERE username=? AND account_id !=?';
    $statement = $this -> connection -> prepare( $query );
    $statement -> bind_param( 'si' , $username, $this -> account_id );
    $statement -> execute();
    $result = $statement -> get_result();
    return ( $result -> num_rows > 0 ) ? true : false;
  }
  public function emailExists( $email ){
    $query = 'SELECT email FROM account WHERE email=? AND account_id !=?';
    $statement = $this -> connection -> prepare( $query );
    $statement -> bind_param( 'si' , $email, $this -> account_id );
    $statement -> execute();
    $result = $statement -> get_result();
    return ( $result -> num_rows > 0 ) ? true : false;
  }
}
?>