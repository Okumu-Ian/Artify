<?php
?>
 <footer class="site-footer border-top">
     <div class="site-section site-section-sm site-blocks-1" style="margin-bottom: 5%;">
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="">
            <div class="icon mr-4 align-self-start">
              <span class="icon-truck"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">Free Shipping</h2>
              <p>Get your art shipped to you within hours at no extra costs.</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="100">
            <div class="icon mr-4 align-self-start">
              <span class="icon-refresh2"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">Free Returns</h2>
              <p>Not what you ordered? No worries, return it within 7 days. Absolutely free</p>
            </div>
          </div>
          <div class="col-md-6 col-lg-4 d-lg-flex mb-4 mb-lg-0 pl-4" data-aos="fade-up" data-aos-delay="200">
            <div class="icon mr-4 align-self-start">
              <span class="icon-help"></span>
            </div>
            <div class="text">
              <h2 class="text-uppercase">Customer Support</h2>
              <p>We are on 24/7 customer support. Call us any time any day.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
      <div class="container">
        <div class="row">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <div class="row">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4">Navigations</h3>
              </div>
              <div class="col-md-6 col-lg-4">
                <ul class="list-unstyled">
                  <li><a href="./artist/index.php">Sell online</a></li>
                  <li><?php if(strstr($current_user,'_',true) != "guest"){
                  echo '<a href="?logout=true">Logout</a>';
                  echo '<script>console.log("'.$current_user.'");</script>';
                  }else{
                  echo '<a href="./authentication">Log In</a>';
                  }?></li>
                  <?php 
                    $string = '<script type="text/javascript">';
                    $string .= 'window.location = "./authentication"';
                    $string .= '</script>';
                  if(isset($_GET['logout'])){
                  session_unset(); 
                  session_destroy();
                  echo $string;
                  }?>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-md-6 col-lg-3">
            <div class="block-5 mb-5">
              <h3 class="footer-heading mb-4">Contact Info</h3>
              <ul class="list-unstyled">
                <li class="address">Nairobi, Kenya</li>
                <li class="phone"><a href="tel://254706813320">+2547 06 81 33 20</a></li>
                <li class="email">info@artify.com</li>
              </ul>
            </div>

            <div class="block-7">
              <form action="#" method="post">
                <label for="email_subscribe" class="footer-heading">Subscribe</label>
                <div class="form-group">
                  <input type="text" class="form-control py-4" id="email_subscribe"  name="email_subscribe" placeholder="Email">
                  <input type="submit" class="btn btn-sm btn-primary" name="subscribe" value="Send">
                </div>
              </form>

<?php
if(isset($_POST['subscribe'])){
$mail = $_POST['email_subscribe'];
$query = "INSERT into subscription(SUB_EMAIL) VALUES ('$mail')";
$results = mysqli_query($con,$query);
}
?>

            </div>
          </div>
        </div>
      </div>
    </footer>