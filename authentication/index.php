<?php
session_start();
require('../config.php');
global $con;

$string = '<script type="text/javascript">';
$string .= 'window.location = "../"';
$string .= '</script>';
    
if(strstr($_SESSION['username'],'_',true) != 'guest'){

$stringN = '<script type="text/javascript">';
$stringN .= 'window.location = "../index.php"';
$stringN .= '</script>';
echo $stringN;

}

if($_SESSION['message'] != null){
    $message = $_SESSION['message'];
    echo "<script>alert('$message');</script>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Get in There</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main" style="margin-top: 2.5%;">

        <div class="container" style="margin-bottom: 2.5%; padding:10px;">
        
        <div class="row justify-content-center">
        <h2 class="form-title" >Artify</h2>   
        </div>
        
        <div class="row justify-content-center">
        <h4 class="form-title">Get In There ~ Art is Waiting</h4>
        </div>
        
        </div>
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form" action="index.php">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="re_pass" id="re_pass" placeholder="Repeat your password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="images/signup-image.jpg" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link" id="scroll-up-member" onclick="scrollToForm()">I am already member</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="#" class="signup-image-link" onclick="scrollToTop()">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Log IN</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="your_name" id="your_name" placeholder="Your Email"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="your_pass" id="your_pass" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group">
                                <a href="./reset"><p>Forgot Password?</p></a>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>



    </div>
    
    <div class="modal fade" id="forgot_email" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Reset Password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form action"index.php" id="reset">
        <div class="form-group">
            <input type="text" name="reset_email" id="reset_email" placeholder="Enter email associated with this account."/>
        </div>
        </form>
        <?php 
        if(isset($_POST['reset_email']))
        {
            mail('okumu.otsembo@gmail.com','Hello Mail','Message');
        }?>
        
        <script>
            function submitForm(){
            document.getElementById('reset').submit();
            }
        </script>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" onclick="submitForm()" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
     <script src="../js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    
    
    <script>
    
    $("a[href='#scroll-up-member']").click(function() {
   
    return false;
    });
    
    
    function scrollToForm(){
    //$('#login-form').scrollTo();
     //$(document).scrollTop() + $(window).height(); 
      $("html, body").animate({ scrollTop: $(document).height() }, "slow");
    }
    
    function scrollToTop(){
    //$('#login-form').scrollTo();
     //$(document).scrollTop() + $(window).height(); 
      $("html, body").animate({ scrollTop: 0 }, "slow");
    }

</script>
    
    
</body>
</html>

<?php

if(isset($_POST['signup'])){

    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $unique_ID = uniqid("_");

    $check_sql = "SELECT * FROM users WHERE EMAIL = '$email'";
    $check_result = mysqli_query($con,$check_sql);

    if(mysqli_affected_rows($con) > 0){
        echo "<script>
        alert('Email is already in use');
        </script>";
    }else{

    $pass = password_hash($pass, PASSWORD_DEFAULT);
    $sql = "INSERT into users(FULL_NAME,EMAIL,PASSWORD,USER_ID) values ('$name','$email','$pass','$unique_ID')";

    $result = mysqli_query($con,$sql);

    if(mysqli_affected_rows($con) > 0){
        echo "<script>alert('Created account successfully!');</script>";
        
        $tmp = $_SESSION['username'];
        $update_values = "UPDATE cart set USER_ID = '$unique_ID' WHERE USER_ID = '$tmp' ";
        mysqli_query($con,$update_values);
    
        $_SESSION['username'] = $unique_ID;
        $_SESSION['start'] = time();
        echo $string;
    }else{
        echo "<script>alert('Could not create your account. Try again.');</script>";
    }

    }

}
else if(isset($_POST['signin'])){

    $email = $_POST['your_name'];
    $pass = $_POST['your_pass'];

    $sql = "SELECT PASSWORD, USER_ID from users WHERE EMAIL = '$email'";
    $results = mysqli_query($con,$sql);

    if(mysqli_affected_rows($con) <= 0){

        echo "<script>
        alert('It seems you do not have an account!');
        </script>";
    }else{

        $rows = array();
        while ($row = mysqli_fetch_array($results)) {
           $rows[] = $row;
        }

        $gotten_pass = $rows[0][0];
        $unique_ID = $rows[0][1];
        $verify = password_verify($pass, $gotten_pass);

        if($verify){
            
        $tmp = $_SESSION['username'];
        $update_values = "UPDATE cart set USER_ID = '$unique_ID' WHERE USER_ID = '$tmp' ";
        mysqli_query($con,$update_values);
            
        $_SESSION['username'] = $unique_ID;
        $_SESSION['start'] = time();
        $_SESSION['user_logged_in'] = true;
        
        if(isset($_SESSION['from'])){
            $stringA = '<script type="text/javascript">';
            $stringA .= 'window.location = "../artist/"';
            $stringA .= '</script>';
            echo $stringA;
        }else{
        echo $string;
        }
        
        }else{
             echo "<script>
        alert('Check your password and try again');
        </script>";
        }

    }
}

?>