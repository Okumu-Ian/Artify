<?php include 'config.php';
include 'header.php';?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-12">
            <div class="border p-4 rounded" role="alert">
              Returning customer? <a href="./authentication">Click here</a> to login
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-5 mb-md-0">
            <h2 class="h3 mb-3 text-black">Shipping Details</h2>
            <div class="p-3 p-lg-5 border">
                <form action="checkout.php?payup=" method="POST" id="first_form">
              <div class="form-group">
                <label for="c_country" class="text-black">Country <span class="text-danger">*</span></label>
                <select id="c_country" class="form-control">
                <option value="1">Select a country</option>    
                        <option value="2">Kenya</option>    
                        <option value="3">Uganda</option>    
                        <option value="4">Tanzania</option>    
                        <option value="5">Rwanda</option>    
                </select>
              </div>
              <div class="form-group row">
                <div class="col-md-6">
                  <label for="c_fname" class="text-black">First Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_fname" name="c_fname">
                </div>
                <div class="col-md-6">
                  <label for="c_lname" class="text-black">Last Name <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_lname" name="c_lname">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_companyname" class="text-black">Company Name </label>
                  <input type="text" class="form-control" id="c_companyname" name="c_companyname">
                </div>
              </div>

              <div class="form-group row">
                <div class="col-md-12">
                  <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_address" name="c_address" placeholder="City/Town">
                </div>
              </div>

              <div class="form-group">
                <input type="text" class="form-control" placeholder="Street ,Building Name">
              </div>

              <div class="form-group row mb-5">
                <div class="col-md-6">
                  <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_email" name="c_email">
                </div>
                <div class="col-md-6">
                  <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                  <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number">
                </div>
              </div>

             
              <div class="form-group">
                <label for="c_order_notes" class="text-black">Order Notes</label>
                <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Details about delivery ..."></textarea>
              </div>

            </form>
            </div>
          </div>
          <div class="col-md-6">

            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Coupon Code</h2>
                <div class="p-3 p-lg-5 border">
                  
                  <label for="c_code" class="text-black mb-3">Enter your coupon code if you have one</label>
                  <div class="input-group w-75">
                    <input type="text" class="form-control" id="c_code" placeholder="Coupon Code" aria-label="Coupon Code" aria-describedby="button-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-primary btn-sm" type="button" id="button-addon2">Apply</button>
                    </div>
                  </div>

                </div>
              </div>
            </div>
            
            <div class="row mb-5">
              <div class="col-md-12">
                <h2 class="h3 mb-3 text-black">Your Order</h2>
                <div class="p-3 p-lg-5 border">
                  <table class="table site-block-order-table mb-5">
                    <thead>
                      <th>Product</th>
                      <th>Total</th>
                    </thead>
                    <tbody>
                
                    <?php
                    $query = "SELECT * FROM cart WHERE USER_ID = '$current_user'";
                    $total = 0;
                    $result = mysqli_query($con,$query);
                    if(mysqli_affected_rows($con) > 0){
                      $query = "SELECT ART_ID, CART_QTY from cart WHERE USER_ID = '$current_user' AND ORDERED = 0";
                      $results = mysqli_query($con,$query);
                      $myarray = array();
                      while($row = mysqli_fetch_assoc($results)){
                        $myarray[] = $row;
                      }
    
                      for ($i=0; $i < sizeof($myarray); $i++) { 
                        $art_ID = $myarray[$i]["ART_ID"];
                        $art_QTY = $myarray[$i]["CART_QTY"];
                        $query = "SELECT ART_PRICE,ART_IMAGES,ART_NAME FROM artwork WHERE ART_ID = '$art_ID'";
                        $resulted = mysqli_query($con,$query);
                        $my_array = array();  
                        while($row_ = mysqli_fetch_assoc($resulted)){
                         
                          $my_array[] = $row_;
                          $total = $total + ($my_array[0]["ART_PRICE"]* $art_QTY);
                          echo ' <tr>
                          <td>'.$row_['ART_NAME'].' <strong class="mx-2">x</strong>'.$art_QTY.'</td>
                          <td>Ksh '.$my_array[0]["ART_PRICE"] * $art_QTY.'</td>
                        </tr>';
                        }
                      }
                      
                      mysqli_query($con,"INSERT into pending_ordering(USER_ID,PENDING_VALUE) VALUES('$current_user','$total')");
                      
                      

                    }
                    ?>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Cart Subtotal</strong></td>
                        <td class="text-black">Ksh <?php echo $total;?></td>
                      </tr>
                      <tr>
                        <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                        <td class="text-black font-weight-bold"><strong>Ksh <?php echo $total;?></strong></td>
                      </tr>
                    </tbody>
                  </table>

                 <!-- <div class="border p-3 mb-3">
                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsebank" role="button" aria-expanded="false" aria-controls="collapsebank">Direct Bank Transfer</a></h3>

                    <div class="collapse" id="collapsebank">
                      <div class="py-2">
                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                      </div>
                    </div>
                  </div>

                  <div class="border p-3 mb-3">
                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsecheque" role="button" aria-expanded="false" aria-controls="collapsecheque">Cheque Payment</a></h3>

                    <div class="collapse" id="collapsecheque">
                      <div class="py-2">
                        <p class="mb-0">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                      </div>
                    </div>
                  </div>-->

                  <div class="border p-3 mb-3">
                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsepaypal" role="button" aria-expanded="false" aria-controls="collapsepaypal">Paypal</a></h3>

                    <div class="collapse" id="collapsepaypal">
                      <div class="py-2">
                        <p class="mb-0">Transact freely using your Paypal account. </br> Currently not Available</p>
                      </div>
                    </div>
                  </div>

                    <div class="border p-3 mb-5">
                    <h3 class="h6 mb-0"><a class="d-block" data-toggle="collapse" href="#collapsempesa" role="button" aria-expanded="false" aria-controls="collapsempesa">M-Pesa</a></h3>

                    <div class="collapse" id="collapsempesa">
                      <div class="py-2">
                        <p class="mb-0">Make a payment on Mobile Money. Freely submit your payments on Mobile money. </br> Currently the only avaialble option.</p>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="sumbitForm()">Place Order</button>
                  </div>

                </div>
              </div>
            </div>

          </div>
        </div>
        <!-- </form> -->
      </div>
    </div>
    <?php
    
    if(isset($_GET['payup'])){
        $email = $_POST['c_email'];
        $country = $_POST['c_country'];
        $first_name = $_POST['c_fname'];
        $last_name = $_POST['c_lname'];
        $address = $_POST['c_address'];
        $phone = $_POST['c_phone'];
        $order = $_POST['c_order_notes'];
        
        if($first_name == '' || $last_name == '' || $address == '' || $phone == '' || $email == ''){
        echo "<script>alert('Kindly fill in all the details first!');</script>";    
        }else{
    $full_name = $first_name.' '.$last_name;
    $insert_into_orders = "INSERT into orders(USER_PHONE,USER_FULL_NAME,USER_ID) VALUES('$phone','$full_name','$current_user')";
    $query_update_user_order = "UPDATE orders SET USER_PHONE = '$phone', USER_FULL_NAME = '$full_name' WHERE USER_ID = '$current_user'";
    mysqli_query($con,$insert_into_orders);
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "./mpesapay"';
    $string .= '</script>';
    echo $string;
        }
        
    }
    
    ?>
  <?php include 'footer.php';?>
  </div>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
  
  <script>
      $(document).ready(function() {

  $('#first_form').submit(function(e) {
    e.preventDefault();
    var first_name = $('#c_fname').val();
    var last_name = $('#c_lname').val();
    var email = $('#c_email').val();
    var phone = $('#c_phone').val();
   // var address = $('#c_city').val();
    
    $(".error").remove();

    if (first_name.length < 1) {
      $('#c_fname').after('<span class="error">This field is required</span>');
    }
    if (last_name.length < 1) {
      $('#c_lname').after('<span class="error">This field is required</span>');
    }
    if (email.length < 1) {
      $('#c_email').after('<span class="error">This field is required</span>');
    } else {
      var regEx = /^[A-Z0-9][A-Z0-9._%+-]{0,63}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/;
      var validEmail = regEx.test(email);
      if (!validEmail) {
        $('#c_email').after('<span class="error">Enter a valid email</span>');
      }
    }
    if (phone.length < 10) {
      $('#c_phone').after('<span class="error">Enter a valid phone number</span>');
    }
  });

});

function sumbitForm(){
    document.getElementById('first_form').submit();
}
  </script>
    
  </body>
</html>