<?php
include 'config.php';
include 'header.php';

 $item_ID = $_SESSION['item'];
 $query = "SELECT * FROM artwork WHERE ART_ID = '$item_ID'";
 $results = mysqli_query($con,$query);

 $title;
 $desc;
 $price;
 $image;
 $count;
 while($row = mysqli_fetch_assoc($results)){
  $title = $row['ART_NAME'];
  $desc = $row['ART_DESCRIPTION'];
  $price = $row['ART_PRICE'];
  $image = $row['ART_IMAGES'];
  $count = $row['ART_COUNT'];
 }
$item_ordered = $title;
$item_ordered_price = $price;

echo '<script>console.log("'.$_SESSION['formed'].'")</script>';
if($_SESSION['formed'] == 1){
  echo  "<script>$('#confirmModal').show();</script>";
  $_SESSION['formed'] = false;
}

 ?>
    <div class="bg-light py-3">
        
  <script src="js/jquery-3.3.1.min.js"></script>
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?php echo $title; ?></strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
        <form action="?item=<?php echo $item_ID;?>&cart_item=<?php echo $item_ID;?>" method="post" id="cart_form">
        <div class="row">
          <div class="col-md-6">
            <img src="<?php echo $image;?>" alt="Image" class="img-fluid">
          </div>
          <div class="col-md-6">
            <h2 class="text-black"><?php echo $title?></h2>
            <p><?php echo $desc; ?></p>
            <p class="mb-4"></p>
            <p><strong class="text-primary h4">Ksh <?php echo $price; ?></strong></p>
            <div class="mb-5">
              <div class="input-group mb-3" style="max-width: 120px;">
              <div class="input-group-prepend">
                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
              </div>
              <input type="text" class="form-control text-center" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1">
              <div class="input-group-append">
                <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
              </div>
            </div>

            </div>
            <div><button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#confirmModal" type="button">Add To Cart</button></div>
          </div>
        </div>
        </form>
        
      </div>
      
      
      <div class="container gallery">
          
          <?php 
          $image_gallery = "SELECT * FROM item_images WHERE art_id = '$item_ID'";
          $results = mysqli_query($con,$image_gallery);
          
          while($row = mysqli_fetch_array($results)){
              echo '<div class="galleryItem">
              <img src="'.$row["image_url"].'">
              </div>';         
              }
          
          ?>
      </div>
      
      
     
      
      
      
      <style>
    .galleryItem {
    width: 225px;
    display: inline-block;
    height: 225px;
    margin: 2.5%;
        }
    .galleryItem img {
        width: 100%;
        height: 100%;
        }
      </style>
    </div>
    
    
    <div class="galleryShadow"></div>
        <div class="galleryModal">
          <i class="galleryIcon gIquit close"></i>
          <i class="galleryIcon gIleft nav-left"></i>
          <i class="galleryIcon gIright nav-right"></i>
          <div class="galleryContainer">
              <img src="">
          </div>  
        </div>
    
    
        <script>
        
            $("#cart_form").on('submit', function(){
                $('#confirmModal').show();
            })
            function uploadForm(){
                document.getElementById('cart_form').submit();
                
            }
            function sendCart(){
                window.location="../shop.php";
                document.getElementById('cart_form').submit();
            }
            function sendCart2(){
                window.location="../cart.php";
                document.getElementById('cart_form').submit();
            }
        </script>
          
      <div id="confirmModal" class="modal fade" role="dialog"  tabindex="-1">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
        <h5 class="modal-title">🛒 Added to Cart</h5>
      </div>
            <div class="modal-body row">
            <div class="col-md-5">
                <img src="<?php echo $image;?>" style="height:200px; width:200px;">
            </div>
            <span class="col-md-7" style="margin: auto;">
            <?php echo $item_ordered;?> Added to cart</br>
            Total Cost: <?php echo 'Ksh'.$item_ordered_price;?></br>
            Do you want to continue shopping?
            </span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" onclick="sendCart2()">No</button>
                <button type="button" class="btn btn-primary waves-effect waves-light save-category" data-dismiss="modal" onclick="sendCart()">Yes</button>
            </div>
        </div> 
        </div>
     </div>
     
     <style>
         #confirmModal{
            position: absolute;
            float: left;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
         }
     </style>

    <script>
        $('#confirmModal').appendTo("body");
    </script>

    <?php

      if(isset($_GET['cart_item'])){
        $item = $_GET['item'];
        $check_order_status = "SELECT * FROM cart WHERE ART_ID = '$item' && USER_ID = '$current_user' && ORDERED = 0";
        mysqli_query($con,$check_order_status);
        if(mysqli_affected_rows($con) > 0){
          $select_order_qty = "SELECT CART_QTY FROM cart WHERE USER_ID = '$current_user'";
          $result = mysqli_query($con,$select_order_qty);
          while($row = mysqli_fetch_array($result)){
            $count = $row["CART_QTY"];
          }
          $count = $count + 1;
          $update_qty = "UPDATE cart SET CART_QTY = '$count' WHERE USER_ID = '$current_user' AND ART_ID = '$item'";
          mysqli_query($con,$update_qty);
          $formed = true;
          $_SESSION['formed'] = $formed;
        }else{
        $query = "INSERT into cart(`ART_ID`,`USER_ID`) values('$item','$current_user')";
        $query3 = "SELECT USER_ID FROM artwork WHERE ART_ID = '$item'";
        $rezult = mysqli_query($con,$query3);
        while($row = mysqli_fetch_array($rezult)){
            $artist = $row["USER_ID"];
        }
        $query2 = "INSERT into orders(`ART_ID`,`USER_ID`,`ORDER_QTY`,`SELLER_ID`) VALUES('$item','$current_user','1','$artist')";
        $result_from_query = mysqli_query($con,$query);
        mysqli_query($con,$query2);
            $formed = true;
            $_SESSION['formed'] = $formed;
        if(mysqli_affected_rows($con) > 0){
       /*   $page = $_SERVER['PHP_SELF'];
          echo '<meta http-equiv="Refresh" content="0;'.$page."?item=".$item_ID.'">';*/
      $string = '<script type="text/javascript">';
      $string .= 'window.location = "./cart.php"';
      $string .= '</script>';
      echo $string;
        }else{
          echo "<script>alert('Failed');</script>";
          }
        }
      }

    ?>

    <?php
    include 'featured.php';?>

  <?php
  include 'footer.php';
  ?>
  </div>

  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
  
   <script>

 	$(function () {
    /*$('.gIquit').click(function () {
        $('.galleryModal').css({ 'transform': 'scale(0)' })
        $('.galleryShadow').fadeOut()
    })
    $('.gallery').on('click', '.galleryItem', function () {
        galleryNavigate($(this), 'opened')
        $('.galleryModal').css({ 'transform': 'scale(1)' })
        $('.galleryShadow').fadeIn()
    })*/
    let galleryNav
    let galleryNew
    let galleryNewImg
    let galleryNewText
    $('.gIleft').click(function () {
        galleryNew = $(galleryNav).prev()
        galleryNavigate(galleryNew, 'last')
    })
    $('.gIright').click(function () {
        galleryNew = $(galleryNav).next()
        galleryNavigate(galleryNew, 'first')
    })
    function galleryNavigate(gData, direction) {
        galleryNewImg = gData.children('img').attr('src')
        if (typeof galleryNewImg !== "undefined") {
            galleryNav = gData
            $('.galleryModal img').attr('src', galleryNewImg)
        }
        else {
            gData = $('.galleryItem:' + direction)
            galleryNav = gData
            galleryNewImg = gData.children('img').attr('src')
            $('.galleryModal img').attr('src', galleryNewImg)
        }
        galleryNewText = gData.children('img').attr('data-text')
        if (typeof galleryNewText !== "undefined") {
            $('.galleryModal .galleryContainer .galleryText').remove()
            $('.galleryModal .galleryContainer').append('<div class="galleryText">' + galleryNewText + '</div>')
        }
        else {
            $('.galleryModal .galleryContainer .galleryText').remove()
        }
    }
})
     </script>
    
  </body>
</html>