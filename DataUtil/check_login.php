<?php
 session_start();
$host="localhost"; // Host name
$username="kingjv"; // Mysql username
$password=""; // Mysql password
$db_name="fantasyfootball"; // Database name

$tbl_name="web_user"; // Table name

// Connect to server and select database.
// Display message if successfully connect, otherwise retains and outputs the potential error
 $conn = new PDO("mysql:host=$host; dbname=$db_name", $username, $password);
 echo 'Connected to database';
// username and password sent from form
$myusername=$_POST['email'];
$mypassword=md5($_POST['password']);


// To protect MySQL injection (more detail about MySQL injection)
//$myusername = stripslashes($myusername);
//$mypassword = stripslashes($mypassword);
//$myusername = mysql_real_escape_string($myusername);
//$mypassword = mysql_real_escape_string($mypassword);
//
$sql="SELECT * FROM $tbl_name WHERE email= '$myusername' AND
password = '$mypassword'";
$sql = $conn->prepare($sql);
$sql->execute();

$count = $sql->rowCount();

$validation = true;
if($count == 1){
$_role = "Admin";
$_SESSION['role'] = $_role;
header("location:/adminControlPanel.php");

$validation = true;
}

else {
   
//echo "Wrong Username or Password";
$_SESSION['myusername'] = $myusername;
$_SESSION['mypassword'] =$mypassword;
$validation = false;
$_SESSION['validation'] = $validation;

header("location:../login.php");

}
?>
<?php
