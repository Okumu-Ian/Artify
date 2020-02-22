<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<!------ Include the above in your HEAD tag ---------->
</head>
<body style="padding:10%">
 <div class="form-gap"></div>
<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Create A Password</h2>
                  <p>You can create a new password now.</p>
                  <div class="panel-body">
    
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                          <input id="password" name="password" placeholder="password" class="form-control"  type="password">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
                          <input id="c_password" name="c_password" placeholder="confirm-password" class="form-control"  type="password">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
	</div>
</div>

<?php

require('../../../config.php');

$email = $_GET['email'];
$token = $_GET['token'];

$verify_email = "SELECT * FROM reset_pass WHERE email = '$email' AND token = '$token'";
$result = mysqli_query($con,$verify_email);

if(mysqli_num_rows($result) > 0){

  echo '<script>';
  echo 'console.log("values_found")';
  echo '</script>';

}

if(isset($_POST['recover-submit'])){
    
    $password = $_POST['password'];
    
    $password = password_hash($password,PASSWORD_DEFAULT);
    
    $query = "UPDATE users set PASSWORD = '$password' WHERE EMAIL = '$email'";
    $results = mysqli_query($con,$query);

    if(mysqli_num_rows($results) > 0){
        
$string = '<script type="text/javascript">';
$string .= 'window.location = "../../"';
$string .= '</script>'; 
        
    }
}

?>

</body>
</html>