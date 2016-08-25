<?php
session_start();
/**
 * Created by PhpStorm.
 * User: jerry
 * Date: 8/12/2016
 * Time: 3:47 PM
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <!--[if IE]><meta http-equiv='X-UA-Compatible' content='IE=edge,chrome=1'><![endif]-->
    <title>The League of Fantasy</title>
    <link href="images/favicon.ico" rel="icon" type="image/x-icon" />

    <!--[if lt IE 9]>
    <script type="text/javascript" src="js/ie-fixes.js"></script>
    <link rel="stylesheet" href="css/ie-fixes.css">
    <![endif]-->

    <meta name="description" content="The League of Fantasy">

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--- This should placed first off all other scripts -->


    <link rel="stylesheet" href="css/revolution_settings.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/axfont.css">
    <link rel="stylesheet" href="css/tipsy.css">
    <link rel="stylesheet" href="css/prettyPhoto.css">
    <link rel="stylesheet" href="css/isotop_animation.css">
    <link rel="stylesheet" href="css/animate.css">
    <link rel="stylesheet" href="css/basepage.css">





    <link href='css/style.css' rel='stylesheet' type='text/css'>
    <link href='css/responsive.css' rel='stylesheet' type='text/css'>

    <link href="css/skins/black.css" rel='stylesheet' type='text/css' id="skin-file">



    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false"></script>

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300,500,600' rel='stylesheet' type='text/css'>

    <!--[if lt IE 9]>
    <script type="text/javascript" src="js/respond.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="css/color-chooser.css">
</head>
<!-- Header -->
<header id="header">
    <div class="container">

        <div class="row header">

            <!-- Logo -->
            <div class="col-xs-2 logo">
                <a href="index.php">
                    <img src="images/logo.png" alt="The League of Fantasy" style="height: 65px"/>
                </a>
            </div>
            <!-- //Logo// -->


            <!-- Navigation File -->
            <div class="col-md-10">

                <!-- Mobile Button Menu -->
                <div class="mobile-menu-button">
                    <i class="fa fa-list-ul"></i>
                </div>
                <!-- //Mobile Button Menu// -->




                <nav>
                    <ul class="navigation">
                        <li>
                            <a href="index.php">
                                                <span class="label-nav">
                                                    Home
                                                </span>
                                                <span class="label-nav-sub" data-hover="Home">
                                                    Home
                                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="standings.php">
                                                <span class="label-nav">
                                                    Standings
                                                </span>
                                                <span class="label-nav-sub" data-hover="Standings">
                                                    Standings
                                                </span>
                            </a>
                        </li>
                            <?php
                            if($_SESSION['role'] == "Admin"){
                                ?>
                                <li>
                                       <a href="adminControlPanel.php">
                                                <span class="label-nav">
                                                    Admin Control Panel
                                                </span>
                                                <span class="label-nav-sub" data-hover="Admin">
                                                    Admin Control Panel
                                                </span>
                            </a>
                            <ul>
                                <li>
                                    <a href="editPlayersTeams.php">Players/Team Names</a>
                                </li>
                                <li>
                                    <a href="editStandings.php">Standings</a>
                                </li>
                            </ul>
                            </li>
                            <?php
                            }
                            ?>
                        <li>
                            <?php
                            if($_SESSION['role'] == "Admin"){
                                ?>
                                       <a href="logout.php">
                                                <span class="label-nav">
                                                    Logout
                                                </span>
                                                <span class="label-nav-sub" data-hover="Logout">
                                                    Logout
                                                </span>
                            </a>
                            <?php
                            }else{
                            ?>
                            <!--<a href="login.php">-->
                            <!--                    <span class="label-nav">-->
                            <!--                        Login-->
                            <!--                    </span>-->
                            <!--                    <span class="label-nav-sub" data-hover="Elements">-->
                            <!--                        Admin Login-->
                            <!--                    </span>-->
                            <!--</a>-->
                            <?php
                            }
                            ?>
                        </li>
                    </ul>

                </nav>

                <!-- Mobile Nav. Container -->
                <ul class="mobile-nav">
                    <li class="responsive-searchbox">
                        <!-- Responsive Nave -->
                        <form action="#" method="get">
                            <input type="text" class="searchbox-inputtext" id="searchbox-inputtext-mobile" name="s" />
                            <button class="icon-search"></button>
                        </form>
                        <!-- //Responsive Nave// -->
                    </li>
                </ul>
                <!-- //Mobile Nav. Container// -->
            </div>
            <!-- Nav -->

        </div>



    </div>
</header>
<!-- //Header// -->