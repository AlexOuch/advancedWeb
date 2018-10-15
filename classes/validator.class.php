<?php
//simple validator to validate username, email and password
class Validator{
  public static $errors = array();
  public static function username($name){
    //check for length / max 16
    $len = strlen($name);
    if( $len > 16 ){
      self::$errors['length'] = 'cannot be longer than 16 characters';
    }
    //check if shorter than 6 characters
    if( $len < 4 ){
      self::$errors['length'] = 'cannot be shorter than 4 characters';
    }
    //check for tags
    if( strlen(strip_tags($name)) !== $len ){
      self::$errors['tags'] = 'cannot contain tags';
    }
    //check for spaces
    if( strlen( str_replace(" ","",$name) ) !== $len  ){
      self::$errors['spaces'] = 'cannot contain spaces';
    }
    //check if there are non alphanumeric characters
    if( ctype_alnum($name) == false && self::$errors['spaces'] == false ){
      self::$errors['symbols'] = 'can only contain alphanumeric characters';
    }
    return count(self::$errors) == 0 ? true : false;
  }
  public static function password($pwd){
    $len = strlen($pwd);
    //---password must me 8 characters or longer
    if( $len < 6 ){
      self::$errors['length'] = 'must be 6 characters or longer';
    }
    //---password must contain special characters
    if( ctype_alnum($pwd) ){
      self::$errors['characters'] = 'must contain at least one special character';
    }
    //----password must contain a number and uppercase character
    //split each character into array
    $chrs = str_split($pwd);
    //set to true when a number is found
    $is_num = false;
    //set to true when uppercase character is found
    $is_upper = false;
    //loop through characters to see if there is a number and an uppercase character
    foreach($chrs as $char ){
      if(ctype_digit($char)){
        $is_num = true;
      }
      if(ctype_upper($char)){
        $is_upper = true;
      }
    }
    if( $is_num == false ){
      self::$errors['number'] = 'must contain at least a number';
    }
    if( $is_upper == false ){
      self::$errors['uppercase'] = 'must contain at least an uppercase character';
    }
    
    return count(self::$errors) == 0 ? true : false;
  }
  public static function email($address){
    $len = strlen($address);
    if( filter_var($address,FILTER_VALIDATE_EMAIL) == false ){
      self::$errors['email'] = 'invalid email address';
    }
    //check for spaces
    if( strlen( str_replace(" ","",$address) ) !== $len  ){
      self::$errors['spaces'] = 'cannot contain spaces';
    }
    return count(self::$errors) == 0 ? true : false;
  }
  public static function resetErrors(){
    self::$errors = array();
  }
}
?>