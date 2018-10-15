<?php
class SessionManager{
  //this method takes an associative array as an argument
  public static function create(Array $vars){
    self::checkSession();
    foreach( $vars as $key => $value ){
      $_SESSION[ $key ] = $value;
    }
  }
  //this method checks if session has started and starts it if not
  public static function checkSession(){
    if( session_status() == PHP_SESSION_NONE ) {
      session_start();
    }
  }
}
?>