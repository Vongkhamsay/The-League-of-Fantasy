<?php 
session_start(); 
include( "DataUtil/common.inc.php"); 
include( "DataUtil/DataAccess.inc.php");
include 'includes/_header.php';

$da=new DataAccess($link);

//get record
$getPlayerInfo = $da->get_player_info();

$roleID = $_SESSION['role'];

if($roleID == "Admin"){ 
    
if(isset($_GET['player_id'])){

// Gets player_id ID 
$playerID = $_GET['player_id'];
//Grab player info by ID
$player=$da->get_player_by_id($playerID);

//Validations for editing
if(isset($_POST['btnSubmitEdit'])){
    $new_user_name = htmlentities($_POST['user_name']);
    $new_team_name = htmlentities($_POST['team_name']);
    $new_division = htmlentities($_POST['division']);
    $da ->update_player_team($playerID, $new_user_name, $new_team_name, $new_division);
    ?>
  
        <meta http-equiv="refresh" content="0">
      <?php
}

}

?>
<?php include_once("analyticstracking.php") ?>
<div class="container">
                        <div class="row">
                            <div class="">
                                <div class="title-block clearfix">
                                    <h3 class="h3-body-title">Admin Control Panel</h3>
                                    <div class="title-seperator"></div>
                                </div>
                                <div class="tab-container" >
                                    <ul class="etabs">

                                        <li class="tab">
                                            <a href="#tab1"><i class=icon-feather></i>Players</a>
                                        </li>


                                        <li class="tab">
                                            <a href="#tab2"><i class=icon-drive></i>Edit Players</a>
                                        </li>
                                    </ul>            

                                    <div class="tabs-content">
                                        <div id="tab1">
                                            <table class="table">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Team Name</th>
                                            <th>Division</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                        foreach($getPlayerInfo as $getPlayerInfo){ 
                        echo("<tr>"); 
                        echo("<td>{$getPlayerInfo['user_name']}</td>");
                        echo("<td>{$getPlayerInfo['team_name']}</td>");
                        echo("<td>{$getPlayerInfo['division']}</td>");
                        echo("<td><a href=\"editPlayersTeams.php?player_id={$getPlayerInfo['player_id']}#tab2\">Select</a>"); 
                        echo( "</tr>"); 
                        } 
                        ?>
                                    </tbody>
                                </table>
                                        </div>
                                        <div id="tab2">
                                            <?php if(isset($_GET['player_id'])){ 
                                            ?>
                                           <table class="table">
                                    <thead>
                                        <tr>
                                            <th>User Name</th>
                                            <th>Team Name</th>
                                            <th>Division</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form method="POST">
                                       <?php 
                                        foreach($player as $player){ 
                                        echo("<tr>"); 
                                        echo("<td><input type='text' name='user_name' value='{$player['user_name']}' required/></td>");
                                        echo("<td><input type='text' name='team_name' value='{$player['team_name']}' required/></td>");
                                        echo("<td><input type='text' name='division' value='{$player['division']}' required/></td>");
                                        echo("<td><input type='submit' name='btnSubmitEdit' value='Submit'></td>");
                                        echo( "</tr>"); 
                                        } 
                                        ?>
                                        
                                        </form>
                                    </tbody>
                                </table>
                                <?php
                                            }else{
                                                echo " Please select a user!";
                                            }
                                ?>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="space-sep40"></div>        
                    </div>
<?php

    }else{
    echo "<center><h1>YOU ARE NOT AN ADMIN!</h1></center>";
    echo "<center><img src='images/noaccess.jpg' alt='You shall not pass' style='width:304px;height:275px'></center>";
    echo "<center><a href=\"/index.php\">Return Home</a></center>";
    }
    
    include 'includes/_footer.php'; 
    ?>
