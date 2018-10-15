<?php
class ConsoleDetail extends Consoles{
    public function __construct(){
        parent::__construct();
    }
    public function getConsole( $id ){
        $query = "
                select console.console_id, console.name, console.description, console.price, console.image
                from console
                where console.console_id = ?
                ";
        $statement= $this -> connection -> prepare($query);
        $statement -> bind_param('i', $id);
        $statement -> execute();
        $result = $statement -> get_result();
        $console_detail = array();
        while($row = $result -> fetch_assoc()){
            array_push($console_detail, $row);
        }
        return $console_detail;
    }
}
?>