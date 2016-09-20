<?php
session_start(); 
include( "DataUtil/common.inc.php"); 
include( "DataUtil/DataAccess.inc.php");
include 'includes/_header.php';

$da=new DataAccess($link);

$highest_score_info = $da->get_highest_score_week_info();
?>
    <body>
        <div id="wrapper"  >
            <div class="top_wrapper">

                <div class="top-title-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="page-info">
                                    <h1 class="h1-page-title">Mini Games</h1>

                                    <h2 class="h2-page-desc">
                                        2016
                                    </h2>

                                    <!-- BreadCrumb -->
                                    <div class="breadcrumb-container">
                                        <ol class="breadcrumb">
                                            <li>
                                                <a href="index.php">Home</a>
                                            </li>
                                            <li class="active">Mini Games</li>
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
                                  <div class="section-content section-tabs full-tabs">
                        <div class="tab-container">
                            <div class="section-tab-arrow"></div>
                            <div class="section-etabs-container">
                                <ul class="section-etabs">
                                    <li class="tab active">
                                        <a href="#tabc4"> Highest Points</a>
                                    </li>
                                    <li class="tab">
                                        <a href="#tabc5"> Weekly Games</a>
                                    </li>
                                    <li class="tab">
                                        <a href="#tabc6">Bounty Games</a>
                                    </li>
                                </ul>
                            </div>

                            <div class="tab-content">

                                <div id="tabc4">
                                    <div class="section-content">
                                        <div class="container">
                                            <div class="row">
                                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Week</th>
                                            <th>Winner</th>
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
                                            echo("Points: {$highest_score_info['points']}</td>");
                                            }
                                            echo( "</tr>"); 
                                        } 
                                            ?>
                                    </tbody>
                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabc5">
                                    <div class="section-content section-px stones-bg white-text">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-5 col-sm-5">
                                                    <div class="left-image-container">
                                                        <img src=images/placeholders/two-iphone-placeholder.png alt="Mockup"/>
                                                    </div>                    
                                                </div>            
                                                <div class="col-md-6 col-sm-6">
                                                    <div class="space-sep80"></div>

                                                    <h2 class="h2-section-title">Be Creative </h2>
                                                    <h3 class="h3-section-info">Lorem ipsum dolor sit amet, in pri offendit ocurreret. Vix sumo ferri an. pfs adodio fugit delenit ut qui. Omittam suscipiantur ex  vel,ex audiam  intellegat gfIn labitur discere eos, nam an feugiat voluptua.</h3>
                                                </div>

                                            </div>
                                        </div>
                                    </div>                
                                </div>
                                <div id="tabc6">
                                    <div class="section-content section-px">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="content-box content-style3">

                                                        <div class="content-style3-icon icon-users-outline"></div>
                                                        <div class="content-style3-title">
                                                            <h4 class="h4-body-title">Our Community</h4>
                                                        </div>
                                                        <div class="content-style3-text">
                                                            Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.
                                                        </div>

                                                    </div>                            </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="content-box content-style3">

                                                        <div class="content-style3-icon icon-megaphone"></div>
                                                        <div class="content-style3-title">
                                                            <h4 class="h4-body-title">Announcment</h4>
                                                        </div>
                                                        <div class="content-style3-text">
                                                            Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.
                                                        </div>

                                                    </div>                            </div>
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="content-box content-style3">

                                                        <div class="content-style3-icon fa fa-css3"></div>
                                                        <div class="content-style3-title">
                                                            <h4 class="h4-body-title">Technologies Used</h4>
                                                        </div>
                                                        <div class="content-style3-text">
                                                            Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit.
                                                        </div>

                                                    </div>                            </div>
                                            </div>
                                        </div>
                                    </div>            
                                </div>
                            </div>
                        </div>    </div>  

            </div><!--.content-wrapper end -->

        </div><!-- wrapper end -->
    </body>



<?php
include "includes/_footer.php";
?>