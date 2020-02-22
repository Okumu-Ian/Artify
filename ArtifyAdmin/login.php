<?php
require 'config.php';

session_start();
$_SESSION['admin_username'] = null;

?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<head>
  
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Artify- Admin</title>

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="container"  style="margin-top:auto;">

    
     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
      <div class="row" style="height: 100px;"></div>
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Admin Login</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" id="quickForm" action="login.php" method="POST">
                <div class="card-body">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group mb-0">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="terms" class="custom-control-input" id="exampleCheck1">
                      <label class="custom-control-label" for="exampleCheck1">I agree to the <a href="#">terms of service</a>.</label>
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary" name="submit">Login</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    </div>

    <?php
    
    if(isset($_POST['submit'])){

      $email = $_POST['email'];
      $password = $_POST['password'];

      $query = "SELECT admin_pass FROM admins WHERE email = '$email'";
      $results = mysqli_query($con,$query);

      $gotten_password = 0;

    if(mysqli_num_rows($results) > 0){
      while($row = mysqli_fetch_assoc($results)){
        $gotten_password = $row["admin_pass"];
      }
    }

    
      $login = password_verify($password,$gotten_password);

        if($login == true){

          $_SESSION['admin_username'] = $email;

        echo '<script>';
        echo 'window.location = "index.php"';
        echo '</script>';


        }
        else{
        
          echo '<script>';
          echo 'alert("Check your credentials and try again'.$gotten_password.'")';
          echo '</script>';
        }


        

    }

    ?>
</body
