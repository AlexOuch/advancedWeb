<?php
class GameDetail extends Games{
    public function __construct(){
        parent::__construct();
    }
    public function getGame( $id ){
        $query = "
                select game.game_id, game.name, game.release_date, game.description, game.price, game.console, game.image
                from game
                where game.game_id = ?
                ";
        $statement= $this -> connection -> prepare($query);
        $statement -> bind_param('i', $id);
        $statement -> execute();
        $result = $statement -> get_result();
        $game_detail = array();
        while($row = $result -> fetch_assoc()){
            array_push($game_detail, $row);
        }
        return $game_detail;
    }
     public function getGamesSort( $flag ){
        $query = "
                select game.game_id, game.name, game.release_date, game.description, game.price, game.console, game.image
                from game
                order by ".$flag;
        $statement= $this -> connection -> prepare($query);
        $statement -> execute();
        $result = $statement -> get_result();
        $game_detail = array();
        while($row = $result -> fetch_assoc()){
            array_push($game_detail, $row);
        }
        return $game_detail;
    }
}
?>