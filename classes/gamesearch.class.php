<?php
class GameSearch extends Games{
    public function __construct(){
        parent::__construct();
    }
    public function search($keyword){
        $query = "
               select game.game_id, game.name, game.release_date, game.description, game.price, game.console, game.image
                from game
                where game.name like ?
                or game.description like ?
                ";
        $statement = $this -> connection -> prepare($query);        
        //pad the $keyword to increase matches 
        $string = '%' . $keyword . '%';
        $statement -> bind_param('ss',$string,$string);
        $statement -> execute();
        $result = $statement -> get_result();
        $search_result = array();
        while( $row = $result -> fetch_assoc() ){
            array_push($search_result, $row);
        }
        return $search_result;  
    }
}
?>