<?php 
session_start(); 
include( "DataUtil/common.inc.php"); 
include( "DataUtil/DataAccess.inc.php");
include 'includes/_header.php';

$da=new DataAccess($link);

//get record
$standings_bloods = $da->get_bloods_standings();
$standings_crips = $da->get_crips_standings();

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
                                            <a href="#tab2"><i class=icon-drive></i>Services</a>
                                        </li>


                                        <li class="tab">
                                            <a href="#tab3"><i class=icon-map></i>Contact Us</a>
                                        </li>

                                    </ul>            

                                    <div class="tabs-content">
                                        <div id="tab1">
                                            <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Team</th>
                                            <th>Win</th>
                                            <th>Loss</th>
                                            <th>Ties</th>
                                            <th>Percent</th>
                                            <th>Games Behind</th>
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
                        echo("<td><a href=\"adminControlPanel.php?TutorID={$getTutors['TutorID']}#tab2\">Select</a>"); 
                        echo( "</tr>"); 
                        } 
                        ?>
                                    </tbody>
                                </table>
                                        </div>
                                        <div id="tab2">
                                            Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet
                                            <br/><br/> 
                                            Cras dapibus. Vivamus elementum semper nisi.
                                            Aenean vulputate eleifend tellus.
                                        </div>
                                        <div id="tab3">
                                            <div class="sidebar-icon-item">
                                                <i class="icon-phone"></i> (+1) 777-444-333
                                            </div>
                                            <div class="sidebar-icon-item">
                                                <i class="icon-mail"></i> email@company.com
                                            </div>
                                            <div class="sidebar-icon-item">
                                                <i class="icon-home"></i> Address in City, P.O BOX 1111, Country
                                            </div>

                                            <div class="social-icons">

                                                <ul>
                                                    <li>
                                                        <a href="#" title="facebook" target="_blank" class="social-media-icon facebook-icon">zerply</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="twitter" target="_blank" class="social-media-icon twitter-icon">dropbox</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="digg" target="_blank" class="social-media-icon digg-icon">digg</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="mail" target="_blank" class="social-media-icon mail-icon">mail</a>
                                                    </li>
                                                    <li>
                                                        <a href="#" title="flickr" target="_blank" class="social-media-icon flickr-icon">flickr</a>
                                                    </li>

                                                </ul>

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
    include 'includes/_header.php'; 
    echo "<center><h1>YOU ARE NOT AN ADMIN!</h1></center>";
    echo "<center><img src='images/noaccess.jpg' alt='You shall not pass' style='width:304px;height:275px'></center>";
    echo "<center><a href=\"/index.php\">Return Home</a></center>";
    }
    
    include 'includes/_footer.php'; 
    ?>
