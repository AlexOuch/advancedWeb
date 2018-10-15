<?php
class Consoles extends Database{
    public $consoles = array();
    public function __construct(){
        parent::__construct();
    }public function getConsoles(){
        $query = "
                select console.console_id, console.name, console.description, console.price, console.image
                from console
                order by console.console_id
                ";
        $statement = $this -> connection -> prepare($query);
        $statement -> execute();
        $result = $statement -> get_result();
        while ( $row = $result -> fetch_assoc() ){
            array_push( $this -> consoles, $row );
        }
        return $this -> consoles;
    }
}
?>