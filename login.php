<?php
session_start();
$email = $_SESSION['myusername'];
$password = $_SESSION['mypassword'];
$validation = $_SESSION['validation'];
$emailErr = "";
$passwordErr = "";
$sqlErr = "";
$email_valid = FALSE;
$password_valid = FALSE;
//Validate Email
if(strlen($email) <1){
    $emailErr = '<span style="color:red;">*Email field is empty.</span>';
    $email_valid = FALSE;
}else{
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = '<span style="color:red;">Invalid email format</span>';
        $email_valid = FALSE;
    }else{
        $emailErr = "";
        $email_valid = TRUE;
    }

}

//Validate Password
if(strlen($password) <1){
    $passwordErr= '<span style="color:red;">*Password field is empty.</span>';
    $password_valid = FALSE;
}else{
    $passwordErr = "";
    $password_valid = TRUE;
}

//Validation for SQL
if($email_valid == TRUE && $password_valid == TRUE){
    if($validation == True){
        $sqlErr = "";
    }else if($validation == FALSE){
        $sqlErr = '<span style = "color:red;">*Email/Password does not match. Please try again.</span>';
    }
}else{
    $sqlErr = "";
}

include "includes/_header.php";
?>
<?php include_once("analyticstracking.php") ?>
                <div class="top-title-wrapper">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 col-sm-12">
                                <div class="page-info">
                                    <h1 class="h1-page-title">Sign In</h1>


                                    <!-- BreadCrumb -->
                                    <div class="breadcrumb-container">
                                        <ol class="breadcrumb">
                                            <li>
                                                <a href="index.php">Home</a>
                                            </li>
                                            <li class="active">Sign In</li>
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
                            <div class="col-md-12 col-sm-12 animated" data-animtype="flipInY"
                                 data-animrepeat="0"
                                 data-speed="1s"
                                 data-delay="0.5s">
                                <h2 class="h2-section-title">Sign In</h2>

                                <div class="i-section-title">
                                    <i class="icon-users-outline">

                                    </i>
                                </div>

                                <div class="space-sep20"></div>
                            </div>            
                        </div>

                        <div class="row">

                            <div class="col-md-6 col-sm-6 centered">
                                <div class="classic-form">
                                    <form class="form-horizontal" role="form" method="post" action="DataUtil/check_login.php">
                                        <div class="form-group">
                                            <label for="email" class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="email" name="email" value ="<?php echo $email?>"placeholder="Email" required><?php echo $emailErr ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="password" class="col-sm-3 control-label">Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required> <?php echo $passwordErr ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <div class="checkbox">
                                                    <?php echo $sqlErr?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-sm-offset-3 col-sm-9">
                                                <button type="submit" class="btn btn-block btn-primary">Sign In</button>
                                            </div>
                                        </div>

                                    </form>                    
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div><!--.content-wrapper end -->
          <?php include "includes/_footer.php";?>
    </body>
</html>
