<?php

// start a session (you may want to store session data in the db!!!)
/*
require_once('includes/SessionManager.inc.php');
$sh = new SessionManager($host,$db,$user,$password,$link);
session_set_save_handler(
	array(&$sh, '_open'), 
	array(&$sh, '_close'), 
	array(&$sh, '_read'), 
	array(&$sh, '_write'), 
	array(&$sh, '_destroy'), 
	array(&$sh, '_clean') 
);
*/
session_start();

$root_dir="";
// global configuration settings
if($_SERVER['SERVER_NAME'] == "localhost"){
	// DEV ENVIRONMENT SETTINGS
	error_reporting(E_ALL);
	define("DEBUG_MODE", true);
	define("DB_HOST", "localhost");
	define("DB_USER", "kingjv");
	define("DB_PASSWORD", "");
	define("DB_NAME", "fantasyfootball");
//	$root_dir="/classblog/";
}else{
	// PRODUCTION SETTINGS
	define("DEBUG_MODE", false);
	define("DB_HOST", "localhost");
	define("DB_USER", "kingjv");
	define("DB_PASSWORD", "");
	define("DB_NAME", "fantasyfootball");
	//$root_dir="/classblog/";
}

// get a connection to the database
$link = db_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

// global functions
function db_connect($db_hostname, $db_user, $db_password, $db_database){

	$link = new PDO("mysql:host=$db_hostname; dbname=$db_database", $db_user, $db_password);

	if(!$link){
		log_error();
	}

	return $link;

}

?>