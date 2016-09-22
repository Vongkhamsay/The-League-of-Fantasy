<?php 
session_start(); 
include( "DataUtil/common.inc.php"); 
include( "DataUtil/DataAccess.inc.php");
include 'includes/_header.php';

$da=new DataAccess($link);

//get record
$highest_score_info = $da->get_highest_score_week_info();
$players_full_name = $da->get_player_names();

if(isset($_GET['highest_points_id'])){

// Gets player_id ID 
$weekID = $_GET['highest_points_id'];
//Grab player info by ID
$player_record=$da->get_highest_score_by_weekID($weekID);
$playerName=$da->get_player_name_by_id($player_record['winner_player_id']);

//Validations for editing
if(isset($_POST['btnSubmitEdit'])){
    $new_week = htmlentities($_POST['week']);
    $new_winner_id = htmlentities($_POST['winner_id']);
    $new_points = htmlentities($_POST['points']);
    $da ->update_highest_points($weekID,$new_week,$new_winner_id,$new_points);
    ?>
  
        <meta http-equiv="refresh" content="0">
      <?php
}

}

$roleID = $_SESSION['role'];

if($roleID == "Admin"){ 

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
                                            <a href="#tab1"><i class=icon-feather></i>Highest Points</a>
                                        </li>
                                        <li class="tab">
                                            <a href="#tab2"><i class=icon-drive></i>Edit Week</a>
                                        </li>

                                    </ul>            

                                    <div class="tabs-content">
                                        <div id="tab1">
                                            <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Week</th>
                                            <th>Winner</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                                            foreach($highest_score_info as $highest_score_info){ 
                                            $player_name = $da->get_player_name_by_id($highest_score_info['winner_player_id']);
                                            echo("<tr>"); 
                                            echo("<td>{$highest_score_info['week']}</td>");
                                            if($highest_score_info['winner_player_id'] == NULL) {
                                            echo "<td></td>";
                                            }else{
                                            echo("<td><h3>{$player_name['first_name']} {$player_name['last_name']}</h3>");
                                            echo("Points: {$highest_score_info['points']}</td>");; 
                                            }
                                            echo("<td><a href=\"addEditHighestPoints.php?highest_points_id={$highest_score_info['highest_points_id']}#tab2\">Select</a>");
                                            echo( "</tr>"); 
                                            } 
                        ?>
                                    </tbody>
                                </table>
                                        </div>
                                        <div id="tab2">
                                            <?php 
                                            if (isset($_GET['highest_points_id'])) {
                                            ?>
                                    <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Week</th>
                                            <th>Winner</th>
                                            <th>Points</th>
                                            <th>Submit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form method="POST">
                                       <?php 
                                        foreach($player_record as $player_record){ 
                                        echo("<tr>"); 
                                        echo("<td><input type='text' name='week' value='{$player_record['week']}' required/></td>");
                                        echo("<td><select name='winner_id'>");
                                        foreach ( $players_full_name as $players_full_name) {
                                            echo("<option value={$players_full_name['player_id']}");
                                            if ($player_record['winner_player_id'] == $players_full_name['player_id']) {
                                                echo " selected";
                                            }
                                            
                                            
                                            echo(">{$players_full_name['first_name']} {$players_full_name['last_name']}</option>");
                                        }
                                        
                                        echo("<select/></td>");
                                        echo("<td><input type='text' name='points' value='{$player_record['points']}' required/></td>");
                                        echo("<td><input type='submit' name='btnSubmitEdit' value='Submit'></td>");
                                        echo( "</tr>"); 
                                        } 
                                        ?>
                                        
                                        </form>
                                    </tbody>
                                </table>
                                <?php
                                            }else{
                                                echo "Please select a record.";
                                            }
                                ?>
                                        </div>
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
