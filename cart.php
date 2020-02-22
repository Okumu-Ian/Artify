<?php
include 'config.php';
include 'header.php';
  ?>
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <form class="col-md-12" method="post">
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thumbnail">Image</th>
                    <th class="product-name">Product</th>
                    <th class="product-price">Price</th>
                    <th class="product-quantity">Quantity</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Remove</th>
                  </tr>
                </thead>
                <tbody>


                <?php
                $query = "SELECT * FROM cart WHERE USER_ID = '$current_user'";
                $total = 0;
                $coupon_effect = 0.0;
                $result = mysqli_query($con,$query);
                if(mysqli_affected_rows($con) > 0){
                  $query = "SELECT ART_ID, CART_QTY from cart WHERE USER_ID = '$current_user' AND ORDERED = 0";
                  $results = mysqli_query($con,$query);
                  $myarray = array();
                  while($row = mysqli_fetch_assoc($results)){
                    $myarray[] = $row;
                  }

                  // echo ($myarray[0]["ART_ID"]);
                  for ($i=0; $i < sizeof($myarray); $i++) { 
                    $art_ID = $myarray[$i]["ART_ID"];
                    $art_QTY = $myarray[$i]["CART_QTY"];
                    $query = "SELECT ART_PRICE,ART_IMAGES,ART_NAME FROM artwork WHERE ART_ID = '$art_ID'";
                    $resulted = mysqli_query($con,$query);
                    $my_array = array();  
                    while($row_ = mysqli_fetch_assoc($resulted)){
                     
                      $my_array[] = $row_;
                      $total = $total + ($my_array[0]["ART_PRICE"]* $art_QTY);

                      echo '<tr><td class="product-thumbnail"><img src="'.$my_array[0]["ART_IMAGES"].
                    '" alt="Image" class="img-fluid">'.
                    ' </td>'.
                    '<td class="product-name">'.
                    '<h2 class="h5 text-black">'.
                    $my_array[0]["ART_NAME"].
                    '</h2></td><td>Ksh '.
                    $my_array[0]["ART_PRICE"].
                    '</td>'.
                    ' <td>
                    <div class="input-group mb-3" style="max-width: 25%; margin:auto;">
                    
                      <input type="text" class="form-control text-center" value="'.$art_QTY.'" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" disabled>
                    
                    </div></td>'.
                    '<td> Ksh '.
                    $my_array[0]["ART_PRICE"] * $art_QTY.
                    '</td>'.
                    '<td><a href="?delete='.$art_ID.'" class="btn btn-primary btn-sm">X</a></td>'.
                    '</tr>';
                    }
                    // print_r($my_array);
                    
                  }

                }else{

                }
                ?>


<?php /*  <div class="input-group-append">
                        <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                      </div>
                        <div class="input-group-prepend">
                        <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                      </div>*/?>

<?php
if(isset($_GET['delete'])){
  $delete_from_cart = $_GET['delete'];
  $query = "DELETE FROM cart WHERE USER_ID = '$current_user' AND ART_ID = '$delete_from_cart'";
  $result = mysqli_query($con,$query);
  $page = $_SERVER['PHP_SELF'];
  echo '<meta http-equiv="Refresh" content="0;'.$page.'">';
}
?>

                </tbody>
              </table>
            </div>
          </form>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-md-6 mb-3 mb-md-0">
                <button class="btn btn-primary btn-sm btn-block" onclick="window.location='shop.php'">Update Cart</button>
              </div>
              <div class="col-md-6">
                <button class="btn btn-outline-primary btn-sm btn-block" onclick="window.location='shop.php'">Continue Shopping</button>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label class="text-black h4" for="coupon">Coupon</label>
                <p>Enter your coupon code if you have one.</p>
              </div>
              <div class="col-md-8 mb-3 mb-md-0">
              <form method="post" action="cart.php" id="coupon_form" name="coupon#">
                <input type="text" class="form-control py-3" id="coupon" name="couponA" placeholder="Coupon Code">
                </form>
              </div>
              <div class="col-md-4">
                <button class="btn btn-primary btn-sm" onclick="submitCoupon()">Apply Coupon</button>
              </div>

<script>
function submitCoupon(){
  document.getElementById('coupon_form').submit();
}
</script>

<?php
if(isset($_POST['couponA'])){
  $couponValue = $_POST['couponA'];
  $query = "SELECT COUPON_VALUE from art_coupons WHERE (COUPON_ID = '$couponValue') AND (USER_ID = '$current_user') AND (COUPON_USED = 0)";
  $results = mysqli_query($con,$query);
  if(mysqli_affected_rows($con) > 0){
    echo "<script>alert('Success!! Coupon Applied!');</script>";
    $coupon_effect = 0.1;
  while($row = mysqli_fetch_array($results)){
  //$coupon_effect = $row[0][0];
  }
  mysqli_query($con, "UPDATE art_coupons SET COUPON_USED = 1 WHERE COUPON_ID = '$couponValue'");
  }else{
    echo "<script>alert('Invalid Coupon Applied!');</script>";
  }
}
?>

            </div>
          </div>
          <div class="col-md-6 pl-5">
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                  </div>
                </div>
               
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black">Ksh <?php echo $total - ($total * $coupon_effect);?></strong>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary btn-lg py-4 btn-block" onclick="window.location='checkout.php'">Checkout</button>
                  </div>
                </div>
              </div>
            </div>
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