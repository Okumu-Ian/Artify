<?php 
  include 'config.php';
  include 'header.php';
        ?>

    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" style="height:auto;">
         <ol class="carousel-indicators">
    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
  </ol>
  <div class="carousel-inner">
    <div class="carousel-item active" style="height:350px;">
      <img class="d-block w-100" src="https://images.unsplash.com/photo-1513364776144-60967b0f800f?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1351&q=80" alt="First slide">
      <div class="carousel-caption d-none d-md-block">
    <h4>Art and love are the same thing:</h4>
    <p>It's the process of seeing yourself in things that are not you.</p>
    <p><a href="shop.php" class="btn btn-sm btn-primary">Shop Now</a>
    </p>
    </div>
    </div>
    <div class="carousel-item" style="height:350px;">
      <img class="d-block w-100" src="https://images.unsplash.com/photo-1499781350541-7783f6c6a0c8?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1415&q=80" alt="Second slide">
      <div class="carousel-caption d-none d-md-block">
    <h4>“Creativity takes courage”</h4>
    <p>-Henry Matisse</p>
    <p><a href="shop.php" class="btn btn-sm btn-primary">Shop Now</a>
    </p>
    </div>
    </div>
    <div class="carousel-item" style="height:350px;">
      <img class="d-block w-100" src="images/main.jpg" alt="Third slide">
      <div class="carousel-caption d-none d-md-block">
    <h4>“Every child is an artist.”</h4>
    <p>The problem is how to remain an artist once we grow up.</p>
    <p><a href="shop.php" class="btn btn-sm btn-primary">Shop Now</a>
    </p>
    </div>
    </div>
  </div>
  
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
  
  
  
</div>

    

    <?php include 'featured.php';?>
    <?php include 'categories.php';?>

    <div class="site-section block-8">
      <div class="container">
        <div class="row justify-content-center  mb-5">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Opening Night!</h2>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-md-12 col-lg-7 mb-5">
            <a href="#"><img src="images/main.jpg" alt="Image placeholder" class="img-fluid rounded"></a>
          </div>
          <div class="col-md-12 col-lg-5 text-center pl-md-5">
            <h2><a href="#">Upto 50% off in selected pieces</a></h2>
            <p class="post-meta mb-4">By <a href="#">Carl Otieno</a> <span class="block-8-sep">&bullet;</span> December 3, 2019</p>
            <p>An art lover? Well this is your chance. Take a whooping discount.</p>
            <p><a href="shop.php" class="btn btn-primary btn-sm">Shop Now</a></p>
          </div>
        </div>
      </div>
    </div>

  <?php
include 'footer.php';
  ?>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
    
  </body>
</html>