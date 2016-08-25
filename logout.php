<?php
session_start();
session_destroy();
include('includes/_header.php');
include_once("analyticstracking.php");
echo "<center>You have been logged out! <br><a href='login.php'>Login Page</a> </center>";
include('includes/_footer.php');
 
?>