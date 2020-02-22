<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset</title>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<!------ Include the above in your HEAD tag ---------->
</head>
<body style="padding:10%">
<div class="form-gap"></div>
<div class="container">
	<div class="row" >
		<div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">Forgot Password?</h2>
                  <p>You can reset your password here.</p>
                  <div class="panel-body">
    
                    <form id="register-form" role="form" autocomplete="off" class="form" method="post">
    
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                        </div>
                      </div>
                      <div class="form-group">
                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                      </div>
                      
                      <input type="hidden" class="hide" name="token" id="token" value=""> 
                    </form>
    
                  </div>
                  
                  <?php
    require('../../config.php');
    if(isset($_POST['recover-submit'])){
        
        $email = $_POST['email'];
        
        $sql = "SELECT * FROM users WHERE EMAIL = '$email'";
        $results = mysqli_query($con,$sql);
        
        if(mysqli_num_rows($results) > 0 ){
            
        ?>
            
          <div class="alert alert-success" role="alert" style="margin-top: 2.5%">
            An email has been sent to you with instructions on how to reset your password.
          </div>  
            
        <?php
            
            
            $token = bin2hex(openssl_random_pseudo_bytes(64));
            
            require_once('forgot-pass-recover-email.php');
            
        }else{
            
            ?>
            
            <div class="alert alert-danger" role="alert" style="margin-top: 2.5%">
            It seems you do not have an account with us.
          </div>
            
            <?php
        }
        
        
    }
    
    ?>
                  
                </div>
              </div>
            </div>
          </div>
	</div>
</div>


    


</body>
</html>