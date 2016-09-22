<?php
/**
* Handles all calls to the database for the entire application
*/
class DataAccess{
	
	/**
	* @var resource $link 	The connection to the database
	*/
	private $link;
	
	/**
	* Constructor method
	* 
	* @param resource $link 	Sets the $link property
	*/
	function __construct($link){
		$this->link = $link;
		$conn = $this->link;
	}

	function get_bloods_standings() {
		$qStr ="SELECT * FROM `record` r, `players` p WHERE p.division = 'Bloods' AND r.player_id = p.player_id ORDER BY win DESC";
		$result = $this->link->prepare($qStr);
		$result->execute();
		$standings = array();
		while($row = $result->fetch()){
			$standings[] =$row;
		}
		return $standings;
	}
	
	function get_crips_standings() {
		$qStr ="SELECT * FROM `record` r, `players` p WHERE p.division = 'Crips' AND r.player_id = p.player_id ORDER BY win DESC";
		$result = $this->link->prepare($qStr);
		$result->execute();
		$standings = array();
		while($row = $result->fetch()){
			$standings[] =$row;
		}
		return $standings;
}

	function get_player_info() {
		$qstr = "SELECT * FROM players ORDER BY division DESC";
		$result = $this->link->prepare($qstr);
		$result->execute();
		$playerInfo = array();
		
		while($row = $result->fetch()) {
			$playerInfo[] = $row;
		}
		
		return $playerInfo;
	}
	
	function get_player_by_id($player_id) {
		$qstr = "SELECT first_name, last_name, team_name, division FROM players WHERE player_id = :playerID";
		$result = $this->link->prepare($qstr);
		$result->execute(
			[':playerID' => $player_id]
			);
		$result = $result->fetchALL(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	function add_player_team($first_name,$last_name, $team_name, $division) {
		$qstr = "INSERT INTO players (first_name,last_name, team_name, division) VALUES (:first_name,:last_name, :team_name, :division)";
		$result = $this->link->prepare($qstr);
		$result->execute([
			':first_name' => $first_name,
			':last_name' => $last_name,
			':team_name' => $team_name,
			':division' => $division
			]);
			
			return $result;
	}
	
	function update_player_team($player_id, $first_name,$last_name, $team_name, $division) {
		$qstr = "UPDATE players SET first_name = :first_name, last_name = :last_name, team_name = :team_name, division = :division WHERE player_id = :playerID";
		$result=$this->link->prepare($qstr);
		$result->execute([
		':first_name' => $first_name,
		':last_name' => $last_name,
		':team_name' => $team_name,
		':division' => $division,
		':playerID'=> $player_id
		]);
		
		return $result;
	}
	
	function get_player_record_by_id($player_id) {
		$qstr = "SELECT win, loss, tie, percent, games_behind FROM record WHERE player_id = :playerID";
		$result = $this->link->prepare($qstr);
		$result->execute([
			':playerID' => $player_id
			]);
		$result = $result->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	function get_players_no_record() {
		$qstr = "SELECT p.player_id FROM players p NATURAL LEFT JOIN record r WHERE r.player_id IS NULL";
		$result = $this->link->prepare($qstr);
		$result->execute();
		$player_record = array();
		while($row = $result->fetch()) {
			$player_record[] = $row;
		}
		return $player_record;
	}
	
	function add_player_record($player_id) {
		$qstr = "INSERT INTO record (player_id,win,loss,tie,percent,games_behind) VALUES (:playerID,0,0,0,0.00,0.0)";
		$result = $this->link->prepare($qstr);
		$result->execute([
			':playerID' => $player_id[0]
			]);
	}
	
	function update_player_record($player_id, $win, $loss, $tie, $percent, $games_behind){
		$qstr = "UPDATE record SET win = :win, loss = :loss, tie = :tie, percent = :percent, games_behind = :games_behind WHERE player_id = :playerID";
		$result = $this->link->prepare($qstr);
		$result->execute([
			':playerID' => $player_id,
			':win' => $win,
			':loss' => $loss,
			':tie' => $tie,
			':percent' => $percent,
			':games_behind' => $games_behind
			]);
		
		
	}
	
	//MINI GAMES HIGHEST POINTS
	function get_highest_score_week_info() {
		$qstr = "SELECT highest_points_id,week,winner_player_id,points FROM highest_points";
		$result = $this->link->prepare($qstr);
		$result->execute();
		$record = array();
		while($row = $result->fetch()) {
			$record[] = $row;
		}
		
		return $record;
	}
	
	function get_player_name_by_id($id) {
		$qstr = "SELECT first_name, last_name FROM players WHERE player_id = :id";
		$result = $this->link->prepare($qstr);
		$result->execute([
			":id" => $id
			]);
			
		$player = $result->fetch();
		
		return $player;
	}
	
	function get_highest_score_by_weekID($week_id){
		$qstr = "SELECT week, winner_player_id, points FROM highest_points WHERE highest_points_id = :week_id";
		$result = $this->link->prepare($qstr);
		$result->execute([
			":week_id" => $week_id
			]);
			
			$playerInfo = $result->fetchALL();
			
			return $playerInfo;
	}
	
	function get_player_names() {
		$qstr = "SELECT player_id, first_name, last_name FROM players";
		$result = $this->link->prepare($qstr);
		$result->execute();
		$players = array();
		
		while($row = $result->fetch()) {
			$players[] = $row;
		}
		
		return $players;
		
	}
	
	function update_highest_points($highest_points_id, $week,$winner_player_id,$points) {
		$qstr = "UPDATE highest_points SET week = :week, winner_player_id = :winner_player_id, points = :points WHERE highest_points_id = :highest_points_id";
		$result = $this->link->prepare($qstr);
		$result->execute([
			':week' => $week,
			':winner_player_id' => $winner_player_id,
			':points' => $points,
			':highest_points_id' => $highest_points_id,
			]);
	}
	
	
	//END HIGHEST POINTS

	function handle_error($err_msg){
		if(DEBUG_MODE){
			die($err_msg);
		}else{
			//TODO: handle errors in production
		}
	}
}
