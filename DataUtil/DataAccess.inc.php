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

	/**
	* Authenticates a user for accessing the control panel
	* 
	* @param string email
	* @param string password
	* 
	* @return assoc array if login is authenticated, returns false if authentication fails
	*/
	function login($email, $password){
	
		$email = mysqli_real_escape_string($this->link, $email);
		$password = mysqli_real_escape_string($this->link, $password);

		$qStr = "SELECT user_display_name FROM users WHERE user_email = '$email' AND user_password = '$password' AND user_active = 'yes'";
		//die($qStr);

		$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
		$num_rows = $result->num_rows;
		
		if($num_rows == 1){
			// NOTE: not the diff between msqli_fetch_array() and mysqli_fetch_assoc()
			// return mysqli_fetch_array($result);
			return mysqli_fetch_assoc($result);
		}elseif($num_rows > 1){
			$this->handle_error("Duplicate email and passwords in DB!");
			return false;
		}else{
			return false;
		}
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
	

	//search by tutor
	function search_by_tutor($tutor){
		
		
		$qStr ="SELECT TutorFirstName, TutorLastName, TutorEmail, ClassDescription, Availability FROM tblTutors WHERE (TutorFirstName LIKE '%$tutor%') OR (TutorLastName LIKE '%$tutor%') OR ((concat(TutorFirstName, ' ', TutorLastName) LIKE '%$tutor%'))";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
		$tutor = array();
		while($row = mysqli_fetch_assoc($result)){
			$tutor[] =$row;
		}
		
		return $tutor;
	}
	//search by class
	function search_by_class($class){
		$qStr ="SELECT TutorFirstName, TutorLastName, TutorEmail, ClassDescription, Availability FROM tblTutors WHERE (ClassDescription LIKE '%$class%')";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
		$classes = array();
		while($row = mysqli_fetch_assoc($result)){
			$classes[] =$row;
		}
		
		return $classes;
		
	}
	//Get All tutors
	function get_tutors(){
		$qStr ="SELECT TutorID, TutorFirstName, TutorLastName, TutorEmail, ClassDescription, Availability FROM tblTutors";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
		$tutors = array();
		while($row = mysqli_fetch_assoc($result)){
			$tutors[] =$row;
		}
		
		return $tutors;
	}
	//Get tutor by ID
	function get_tutor_by_id($tutorID){
		$qStr ="SELECT TutorID, TutorFirstName, TutorLastName, TutorEmail, ClassDescription, Availability FROM tblTutors WHERE TutorID = '$tutorID'";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
		$tutors = array();
		while($row = mysqli_fetch_assoc($result)){
			$tutors[] =$row;
		}
		
		return $tutors;
	}
	
	function update_tutor($TutorID, $TutorFirstName, $TutorLastName, $TutorEmail, $ClassDescription, $Availability){
			$qStr = "UPDATE `tblTutors` SET `TutorID`=TutorID, `TutorFirstName`='$TutorFirstName', `TutorLastName`='$TutorFirstName', `TutorLastName`='$TutorLastName', `TutorEmail`='$TutorEmail', `ClassDescription`='$ClassDescription', `Availability`='$Availability' WHERE TutorID='$TutorID'";
			$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	if(!$result){
      	return false;
      }
      $row = mysqli_fetch_assoc($result);
      return $result;
	}
	

	function get_tutor_clock($tutorID){
		$qStr ="SELECT tutorClockID, TutorID, tutorClockIn, tutorClockOut FROM tblTutorClock WHERE TutorID = '$tutorID'";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
		$tutors = array();
		while($row = mysqli_fetch_assoc($result)){
			$tutors[] =$row;
		}
		
		return $tutors;
	}
	
	//Update tutor clock
	function update_tutor_clock($clockIn, $clockOut, $tutorClockID){
		$qStr = "UPDATE `tblTutorClock` SET `tutorClockIn`='$clockIn',`tutorClockOut`='$clockOut' WHERE tutorClockID='$tutorClockID'";
		$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	}
	
	function insert_new_tutor_clock($tutorID, $tutorClockIn, $tutorClockOut){
	$qStr = "INSERT INTO tblTutorClock(TutorID, tutorClockIn, tutorClockOut) VALUES('$tutorID', STR_TO_DATE( '$tutorClockIn', '%Y-%m-%d %H:%i:%s' ), STR_TO_DATE( '$tutorClockOut', '%Y-%m-%d %H:%i:%s'))";
	$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	return $result;
	}
	
	//Insert new tutor
	function insert_tutor($tutorID, $firstName, $lastName, $email, $description, $availability, $password){
	$qStr = "INSERT INTO tblTutors(TutorID, TutorFirstName, TutorLastName, TutorEmail, ClassDescription, Availability, RoleID, TutorPassword) VALUES('$tutorID', '$firstName', '$lastName', '$email', '$description', '$availability', 2, MD5('$password'))";
	$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	return $result;
	}
	
	function get_tutee($tutorID){
		$qStr ="SELECT * FROM tblStudentClock WHERE TutorID = '$tutorID'";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
		$tutors = array();
		while($row = mysqli_fetch_assoc($result)){
			$tutors[] =$row;
		}
		
		return $tutors;
	}
	
	//get punch-in table array from database
	function get_punch_table(){
		$qStr ="SELECT * FROM tblStudentClock";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
		$punchTable = array();
		while($row = mysqli_fetch_assoc($result)){
			$punchTable[] =$row;
		}
		
		return $punchTable;
	}
		//get Tutor punch-in table array from database
	function get_tutor_table(){
		$qStr ="SELECT * FROM tblTutorClock";
		$result = mysqli_query($this->link,$qStr) or $this->handle_error(mysqli_error($this->link));
		$tutorTable = array();
		while($row = mysqli_fetch_assoc($result)){
			$tutorTable[] =$row;
		}
		
		return $tutorTable;
	}
	//insert for student punch-in table
	function insert_punch_table_data($studID, $studFirstName, $studLastName, $studClockIn, $tutorID, $tutorClockID){
	$qStr = "INSERT INTO tblStudentClock(studClockID, studFirstName, studLastName, studClockIn, studClockOut, TutorID, tutorClockID) VALUES('$studID', '$studFirstName', '$studLastName', STR_TO_DATE( '$studClockIn', '%Y-%m-%d %H:%i:%s' ), NULL, $tutorID, $tutorClockID)";
	$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	return $result;
	}
	
	//update for student punch table
	function update_punch_table_data($studClockOut, $studID, $tutorClockID){
		$qStr = "UPDATE tblStudentClock SET studClockOut='$studClockOut' WHERE studClockID=$studID && tutorClockID=$tutorClockID";
		$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	if(!$result){
      	return false;
      }
      $row = mysqli_fetch_assoc($result);
      return $result;
	}
	
		//insert tutor punch table
	function insert_tutor_punch_data($tutorID, $tutorClockIn){
	$qStr = "INSERT INTO tblTutorClock(TutorID, tutorClockIn, tutorClockOut) VALUES('$tutorID', STR_TO_DATE( '$tutorClockIn', '%Y-%m-%d %H:%i:%s' ), NULL)";
	$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	return $result;
	}
	
	//update for tutor punch table
	function update_tutor_punch_data($tutorClockOut, $tutorID, $tutorClockID){
		$qStr = "UPDATE tblTutorClock SET tutorClockOut='$tutorClockOut' WHERE TutorID=$tutorID && tutorClockID=$tutorClockID ";
		$result = mysqli_query($this->link, $qStr) or $this->handle_error(mysqli_error($this->link));
	if(!$result){
      	return false;
      }
      $row = mysqli_fetch_assoc($result);
      return $result;
	}
	
}
// notice there is no closing php delimiter for files that are meant to be embedded STR_TO_DATE('12-01-2014 00:00:00','%m-%d-%Y %H:%i:%s')