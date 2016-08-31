<?php 
session_start(); 
include( "DataUtil/common.inc.php"); 
include( "DataUtil/DataAccess.inc.php");
include 'includes/_header.php';

$da=new DataAccess($link);

//get record
$standings_bloods = $da->get_bloods_standings();
$standings_crips = $da->get_crips_standings();

if(isset($_GET['player_id'])){

// Gets player_id ID 
$playerID = $_GET['player_id'];
//Grab player info by ID
$player_record=$da->get_player_record_by_id($playerID);
$player=$da->get_player_by_id($playerID);

//Validations for editing
if(isset($_POST['btnSubmitEdit'])){
    $new_wins = htmlentities($_POST['win']);
    $new_loss = htmlentities($_POST['loss']);
    $new_ties = htmlentities($_POST['ties']);
    $new_percent = htmlentities($_POST['percent']);
    $new_game_behind = htmlentities($_POST['games_behind']);
    $da ->update_player_record($playerID, $new_wins, $new_loss, $new_ties,$new_percent,$new_game_behind);
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
                                            <a href="#tab1"><i class=icon-feather></i>Standings</a>
                                        </li>
                                        <li class="tab">
                                            <a href="#tab2"><i class=icon-drive></i>Edit Standings</a>
                                        </li>

                                    </ul>            

                                    <div class="tabs-content">
                                        <div id="tab1">
                                            <h1>Bloods</h1>
                                            <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Team</th>
                                            <th>Win</th>
                                            <th>Loss</th>
                                            <th>Ties</th>
                                            <th>Percent</th>
                                            <th>Games Behind</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                        foreach($standings_bloods as $standings_bloods){ 
                        echo("<tr>"); 
                        echo("<td>{$standings_bloods['team_name']}<br>{$standings_bloods['first_name']} {$standings_bloods['last_name']}</td>");
                        echo("<td>{$standings_bloods['win']}</td>");
                        echo("<td>{$standings_bloods['loss']}</td>");
                        echo("<td>{$standings_bloods['tie']}</td>");
                        echo("<td>{$standings_bloods['percent']}</td>");
                        echo("<td>{$standings_bloods['games_behind']}</td>");
                        echo("<td><a href=\"addEditStandings.php?player_id={$standings_bloods['player_id']}#tab2\">Select</a>"); 
                        echo( "</tr>"); 
                        } 
                        ?>
                                    </tbody>
                                </table>
                                <h1>Crips</h1>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Team</th>
                                            <th>Win</th>
                                            <th>Loss</th>
                                            <th>Ties</th>
                                            <th>Percent</th>
                                            <th>Games Behind</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <?php 
                        foreach($standings_crips as $standings_crips){ 
                        echo("<tr>"); 
                        echo("<td>{$standings_crips['team_name']}<br>{$standings_crips['first_name']} {$standings_crips['last_name']}</td>");
                        echo("<td>{$standings_crips['win']}</td>");
                        echo("<td>{$standings_crips['loss']}</td>");
                        echo("<td>{$standings_crips['tie']}</td>");
                        echo("<td>{$standings_crips['percent']}</td>");
                        echo("<td>{$standings_crips['games_behind']}</td>");
                        echo("<td><a href=\"addEditStandings.php?player_id={$standings_crips['player_id']}#tab2\">Select</a>"); 
                        echo( "</tr>"); 
                        } 
                        ?>
                                    </tbody>
                                </table>
                                        </div>
                                        <div id="tab2">
                                            <?php 
                                            if (isset($_GET['player_id'])) {
                                            ?>
                                    <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Win</th>
                                            <th>Loss</th>
                                            <th>Ties</th>
                                            <th>Percent</th>
                                            <th>Games Behind</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form method="POST">
                                       <?php 
                                       foreach ($player as $player) {
                                           echo ("<h1 class='center'>{$player['user_name']}</h1>");
                                           echo ("<h3 class='center'>{$player['team_name']}</h3>");
                                       }
                                        foreach($player_record as $player_record){ 
                                        echo("<tr>"); 
                                        echo("<td><input type='text' name='win' value='{$player_record['win']}' required/></td>");
                                        echo("<td><input type='text' name='loss' value='{$player_record['loss']}' required/></td>");
                                        echo("<td><input type='text' name='ties' value='{$player_record['tie']}' required/></td>");
                                        echo("<td><input type='text' name='percent' value='{$player_record['percent']}' required/></td>");
                                        echo("<td><input type='text' name='games_behind' value='{$player_record['games_behind']}' required/></td>");
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
