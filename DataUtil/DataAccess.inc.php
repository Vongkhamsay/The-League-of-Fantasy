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
		$qstr = "SELECT user_name, team_name, division FROM players WHERE player_id = $player_id";
		$result = $this->link->prepare($qstr);
		$result->execute();
		$result = $result->fetchALL(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	function update_player_team($player_id, $user_name, $team_name, $division) {
		$qstr = "UPDATE players SET user_name = '$user_name', team_name = '$team_name', division = '$division' WHERE player_id = $player_id";
		$result=$this->link->prepare($qstr);
		$result->execute();
		
		return $result;
	}
	
	function get_player_record_by_id($player_id) {
		$qstr = "SELECT win, loss, tie, percent, games_behind FROM record WHERE player_id = $player_id";
		$result = $this->link->prepare($qstr);
		$result->execute();
		$result = $result->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}
	
	function update_player_record($player_id, $win, $loss, $tie, $percent, $games_behind){
		$qstr = "UPDATE record SET win = $win, loss = $loss, tie = $tie, percent = $percent, games_behind = $games_behind WHERE player_id = $player_id";
		$result = $this->link->prepare($qstr);
		$result->execute();
		
		
	}

	function handle_error($err_msg){
		if(DEBUG_MODE){
			die($err_msg);
		}else{
			//TODO: handle errors in production
		}
	}
}
