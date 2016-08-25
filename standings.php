<?php
session_start(); 
include( "DataUtil/common.inc.php"); 
include( "DataUtil/DataAccess.inc.php");
include 'includes/_header.php';

$da=new DataAccess($link);

//get record
$standings_bloods = $da->get_bloods_standings();
$standings_crips = $da->get_crips_standings();
?>
    <body>
        <div id="wrapper"  >
            <div class="top_wrapper">

                <div class="top-title-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="page-info">
                                    <h1 class="h1-page-title">Standings</h1>

                                    <h2 class="h2-page-desc">
                                        2016 Standings
                                    </h2>

                                    <!-- BreadCrumb -->
                                    <div class="breadcrumb-container">
                                        <ol class="breadcrumb">
                                            <li>
                                                <a href="index.php">Home</a>
                                            </li>
                                            <li class="active">Standings</li>
                                        </ol>
                                    </div>
                                    <!-- BreadCrumb -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--.top wrapper end -->

            <div class="loading-container">
                <div class="spinner">
                    <div class="double-bounce1"></div>
                    <div class="double-bounce2"></div>
                </div>
            </div>


            <div class="content-wrapper hide-until-loading"><div class="body-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12" data-animtype="fadeInUp"
                                 data-animrepeat="0"
                                 data-speed="1s"
                                 data-delay="0.4s">
                                <h2 class="h2-section-title">Standings</h2>
                                <div class="i-section-title">
                                    <i class="icon-feather">

                                    </i>
                                </div>
                            </div>
                        </div>

                        <div class="space-sep20"></div>
                        <div class="row">

                            <div class="col-md-6 col-sm-6">

                                <div class="title-block clearfix">
                                    <h3 class="h3-body-title">Bloods</h3>
                                    <div class="title-seperator"></div>
                                </div><div class="accordion" data-toggle="off" data-active-index="0">
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
                        echo("<td>{$standings_bloods['team_name']}<br>{$standings_bloods['user_name']}</td>");
                        echo("<td>{$standings_bloods['win']}</td>");
                        echo("<td>{$standings_bloods['loss']}</td>");
                        echo("<td>{$standings_bloods['tie']}</td>");
                        echo("<td>{$standings_bloods['percent']}</td>");
                        echo("<td>{$standings_bloods['games_behind']}</td>");
                     //   echo("<td><a href=\"adminControlPanel.php?TutorID={$getTutors['TutorID']}#tab2\">Select</a>"); 
                        echo( "</tr>"); 
                        } 
                        ?>
                                    </tbody>
                                </table>


                                </div>            </div>

                            <div class="col-md-6 col-sm-6">
                                <div class="title-block clearfix">
                                    <h3 class="h3-body-title">Crips</h3>
                                    <div class="title-seperator"></div>
                                </div>
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
                        foreach($standings_crips as $standings_crips){ 
                        echo("<tr>"); 
                        echo("<td>{$standings_crips['team_name']}<br>{$standings_crips['user_name']}</td>");
                        echo("<td>{$standings_crips['win']}</td>");
                        echo("<td>{$standings_crips['loss']}</td>");
                        echo("<td>{$standings_crips['tie']}</td>");
                        echo("<td>{$standings_crips['percent']}</td>");
                        echo("<td>{$standings_crips['games_behind']}</td>");
                     //   echo("<td><a href=\"adminControlPanel.php?TutorID={$getTutors['TutorID']}#tab2\">Select</a>"); 
                        echo( "</tr>"); 
                        } 
                        ?>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div><!--.content-wrapper end -->

        </div><!-- wrapper end -->
    </body>



<?php
include "includes/_footer.php";
?>