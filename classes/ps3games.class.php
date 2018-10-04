<?php
class Ps3Games extends Database{
    public $games = array();
    public function __construct(){
        parent::__construct();
    }public function getPs3Games(){
        $query = "
                select game.game_id, game.name, game.release_date, game.description, game.price, game.console, game.image
                from game
                where game.console = 'PS3'
                order by game.release_date desc

                ";
        $statement = $this -> connection -> prepare($query);
        $statement -> execute();
        $result = $statement -> get_result();
        while ( $row = $result -> fetch_assoc() ){
            array_push( $this -> games, $row );
        }
        return $this -> games;
    }
}
?>