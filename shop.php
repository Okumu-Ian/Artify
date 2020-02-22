<?php
include 'config.php';
include 'header.php';
?>
    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Shop</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-md-9 order-2">
            
            <div class="row">
                <div class="col-md-12 mb-5">
                    <div class="float-md-left mb-4">
                        <h2 class="text-black h5" id="h2-shop">Shop</h2>
                    </div>
                    <div class="d-flex">
                        <div class="dropdown mr-1 ml-md-auto" style="width:200px; height:75px;">
                    <select id="fetch_category" name="order_by">
                      <option> Filter Category</option>
                      <option value="Drawing">Drawing</option>
                      <option value="Sculpture">Sculpture</option>
                      <option value="Photography">Photography</option>
                      <option value="Prints">Prints</option>
                      <option value="Paintings">Paintings</option>
                      <option value="Collectibles">Collectibles</option>
                      <option value="Jewellery and Collectibles">Jewellery and Collectibles</option>
                      <option value="Vintage">Vintage</option>
                      <option value="Clip Art">Clip Art</option>
                      <option value="Dolls and Miniatures">Dolls and Miniatures</option>
                      <option value="Fiber Art">Fiber Art</option>
                      <option value="Mixed Media and Collage">Mixed Media and Collage</option>
                      <option value="Fine Art Ceramics">Fine Art Ceramics</option>
                      <option value="Glass Art">Glass Art</option>
                        </select>
                        </div>
                    </div>
                </div>
            </div>
            <script src="js/jquery-3.3.1.min.js"></script>
            <script src="js/jquery-ui.js"></script>
            <script>
                $(document).ready(function(){
                    $("#fetch_category").on('change', function (){
                        var value = $(this).val();
                        $.ajax(
                            {
                               url:'shop_search.php',
                               type:'POST',
                               data:'filter_category='+value,
                               beforeSend: function(){
                                   $("#list_row").html('<div class="container"><h5 style="margin-left:5%;">Please Wait ...</h5></div>');
                                   $("#h2-shop").html('Shop / <span class="text-primary">'+value+'</span>');
                               },
                               success: function(data){
                                    $("#list_row").html(data);
                               },
                            });
                    });
                    
                    
                    $("#slider-range").on('change',function(){
                        var amount = $(this).val();
                        console.log(amount);
                    });
                });
                    
                    
                    
                function navigateToHref(value){
                    
                    $.ajax(
                            {
                               url:'shop_search.php',
                               type:'POST',
                               data:'filter_category='+value,
                               beforeSend: function(){
                                   $("#list_row").html('<div class="container"><h5 style="margin-left:5%;">Please Wait ...</h5></div>');
                                   $("#h2-shop").html('Shop / <span class="text-primary">'+value+'</span>');
                               },
                               success: function(data){
                                    $("#list_row").html(data);
                               },
                            });
                    
                }    
                    
                
                
                
            </script>

            <style>
              .max-lines {
  display: block;/* or inline-block */
  text-overflow: ellipsis;
  word-wrap: break-word;
  overflow: hidden;
  max-height: 3.6em;
  line-height: 1.8em;
}
            </style>
            
            <div class="row mb-5" id="list_row">


              <?php
              
              if(isset($_POST['s'])){
                  
              $search = $_POST['s'];
              $query = "SELECT * FROM artwork WHERE ART_NAME LIKE '%{$search}%' OR ART_CATEGORY LIKE '%{$search}%' AND ART_HIDDEN = '1' ORDER BY ART_DATE DESC";
              $results = mysqli_query($con,$query);
              if(mysqli_num_rows($results) > 0){
            
              while ($row = mysqli_fetch_assoc($results)) {
                
                  echo '<div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">'.
                '<div class="block-4 text-center border" >'.
                  '<figure class="block-4-image">'.
                    '<a href="?item='.$row['ART_ID'].'">'.
                    '<img src="'.$row['ART_IMAGES']
                    .'" alt="Image placeholder" class="img-fluid" style="height: 250px; width: 100%;"></a>'.
                  '</figure>'.
                  '<div class="block-4-text p-4">'.
                    '<h3><a href="?item='.$row['ART_ID'].'">'.$row['ART_NAME']
                    .'</a></h3>'.
                    '<p class="mb-0 max-lines">'.$row['ART_DESCRIPTION']
                    .'</p>'
                    .'<p class="text-primary font-weight-bold">Ksh '
                    .$row['ART_PRICE']
                    .'</p>'
                  .'</div>'
                .'</div>'
              .'</div>';

              }
              
              }
                  
              }else{

              $query = "SELECT * FROM artwork WHERE ART_HIDDEN = '1' ORDER BY ART_DATE DESC";
              $results = mysqli_query($con,$query);
              if(mysqli_num_rows($results) > 0){
            
              while ($row = mysqli_fetch_assoc($results)) {
                
                  echo '<div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">'.
                '<div class="block-4 text-center border" >'.
                  '<figure class="block-4-image">'.
                    '<a href="?item='.$row['ART_ID'].'">'.
                    '<img src="'.$row['ART_IMAGES']
                    .'" alt="Image placeholder" class="img-fluid" style="height: 250px; width: 100%;"></a>'.
                  '</figure>'.
                  '<div class="block-4-text p-4">'.
                    '<h3><a href="?item='.$row['ART_ID'].'">'.$row['ART_NAME']
                    .'</a></h3>'
                    .'<p class="mb-0 max-lines">'.$row['ART_DESCRIPTION']
                    .'</p>'
                    .'<p class="text-primary font-weight-bold">Ksh '
                    .$row['ART_PRICE']
                    .'</p>'
                  .'</div>'
                .'</div>'
              .'</div>';

              }
              }
              
              }

              
            if(isset($_GET['item'])){
                $_SESSION['item'] = $_GET['item'];
                $string = '<script type="text/javascript">';
                $string .= 'window.location = "./shop-single.php"';
                $string .= '</script>';
                echo $string;
            }
            
              
              ?>
            </div>
            <div class="row" data-aos="fade-up">
              <div class="col-md-12 text-center">
                <div class="site-block-27">
                  <ul>
                    <li><a href="#">&lt;</a></li>
                    <li class="active"><span>1</span></li>
                    <!-- <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li> -->
                    <li><a href="#">&gt;</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>

           

          <div class="col-md-3 order-1 mb-5 mb-md-0">
            <div class="border p-4 rounded mb-4">
              <h3 class="mb-3 h6 text-uppercase text-black d-block">Categories</h3>
             <ul class="list-unstyled mb-0">
                <?php
                $sql1 = "SELECT COUNT(ART_CATEGORY) FROM artwork WHERE ART_CATEGORY = 'Drawing' AND ART_HIDDEN = '1'";
                $sql2 = "SELECT COUNT(ART_CATEGORY) FROM artwork WHERE ART_CATEGORY = 'Sculpture' AND ART_HIDDEN = '1'";
                $sql3 = "SELECT COUNT(ART_CATEGORY) FROM artwork WHERE ART_CATEGORY = 'Photography' AND ART_HIDDEN = '1'";
                $sql4 = "SELECT COUNT(ART_CATEGORY) FROM artwork WHERE ART_CATEGORY = 'Prints' AND ART_HIDDEN = '1'";
                $sql5 = "SELECT COUNT(ART_CATEGORY) FROM artwork WHERE ART_CATEGORY = 'Paintings' AND ART_HIDDEN = '1'";
                $sql6 = "SELECT COUNT(ART_CATEGORY) FROM artwork WHERE ART_CATEGORY = 'Collectibles' AND ART_HIDDEN = '1'";
                $sql7 = "SELECT COUNT(ART_CATEGORY) FROM artwork WHERE ART_CATEGORY = 'Jewelery and Accessories' AND ART_HIDDEN = '1'";
                $sql8 = "SELECT COUNT(ART_CATEGORY) FROM artwork WHERE ART_CATEGORY = 'Vintage' AND ART_HIDDEN = '1'";
                $sql9 = "SELECT COUNT(ART_CATEGORY) FROM artwork WHERE ART_CATEGORY = 'Clip Art' AND ART_HIDDEN = '1'";
                $sql10 = "SELECT COUNT(ART_CATEGORY) FROM artwork WHERE ART_CATEGORY = 'Dolls and Miniatures' AND ART_HIDDEN = '1'";
                $sql11 = "SELECT COUNT(ART_CATEGORY) FROM artwork WHERE ART_CATEGORY = 'Fiber Art' AND ART_HIDDEN = '1'";
                $sql12 = "SELECT COUNT(ART_CATEGORY) FROM artwork WHERE ART_CATEGORY = 'Mixed Media and Collage' AND ART_HIDDEN = '1'";
                $sql13 = "SELECT COUNT(ART_CATEGORY) FROM artwork WHERE ART_CATEGORY = 'Fine Art Ceramics' AND ART_HIDDEN = '1'";
                $sql14 = "SELECT COUNT(ART_CATEGORY) FROM artwork WHERE ART_CATEGORY = 'Glass Art' AND ART_HIDDEN = '1'";

                $result1 = mysqli_query($con,$sql1);
                $result2 = mysqli_query($con,$sql2);
                $result3 = mysqli_query($con,$sql3);
                $result4 = mysqli_query($con,$sql4);
                $result5 = mysqli_query($con,$sql5);
                $result6 = mysqli_query($con,$sql6);
                $result7 = mysqli_query($con,$sql7);
                $result8 = mysqli_query($con,$sql8);
                $result9 = mysqli_query($con,$sql9);
                $result10 = mysqli_query($con,$sql10);
                $result11 = mysqli_query($con,$sql11);
                $result12 = mysqli_query($con,$sql12);
                $result13 = mysqli_query($con,$sql13);
                $result14 = mysqli_query($con,$sql14);

                $data1;
                $data2;
                $data3;
                $data4;
                $data5;
                $data6;
                $data7;
                $data8;
                $data9;
                $data10;
                $data11;
                $data12;
                $data13;
                $data14;

                while ($row = mysqli_fetch_array($result1)) {
                  $data1 = $row[0][0];
                }

                while ($row = mysqli_fetch_array($result2)) {
                  $data2 = $row[0][0];
                }

                while ($row = mysqli_fetch_array($result3)) {
                  $data3 = $row[0][0];
                }
                while ($row = mysqli_fetch_array($result4)) {
                  $data4 = $row[0][0];
                }
                while ($row = mysqli_fetch_array($result5)) {
                  $data5 = $row[0][0];
                }
                while ($row = mysqli_fetch_array($result6)) {
                  $data6 = $row[0][0];
                }
                while ($row = mysqli_fetch_array($result7)) {
                  $data7 = $row[0][0];
                }
                while ($row = mysqli_fetch_array($result8)) {
                  $data8 = $row[0][0];
                }
                while ($row = mysqli_fetch_array($result9)) {
                  $data9 = $row[0][0];
                }
                while ($row = mysqli_fetch_array($result10)) {
                  $data10 = $row[0][0];
                }
                while ($row = mysqli_fetch_array($result11)) {
                  $data11 = $row[0][0];
                }
                while ($row = mysqli_fetch_array($result12)) {
                  $data12 = $row[0][0];
                }
                while ($row = mysqli_fetch_array($result13)) {
                  $data13 = $row[0][0];
                }
                while ($row = mysqli_fetch_array($result14)) {
                  $data14 = $row[0][0];
                }
                ?>
                <li class="mb-1"><a href="#" class="d-flex" onclick="navigateToHref('Drawing')"><span>Drawing</span> <span class="text-black ml-auto"><?php echo"($data1)"; ?></span></a></li>
                <li class="mb-1"><a href="#" class="d-flex" onclick="navigateToHref('Sculpture')"><span>Sculpture</span> <span class="text-black ml-auto"><?php echo"($data2)"; ?></span></a></li>
                <li class="mb-1"><a href="#" class="d-flex" onclick="navigateToHref('Photography')"><span>Photography</span> <span class="text-black ml-auto"><?php echo"($data3)"; ?></span></a></li>
                <li class="mb-1"><a href="#" class="d-flex" onclick="navigateToHref('Prints')"><span>Prints</span> <span class="text-black ml-auto"><?php echo"($data4)"; ?></span></a></li>
                <li class="mb-1"><a href="#" class="d-flex" onclick="navigateToHref('Paintings')"><span>Paintings</span> <span class="text-black ml-auto"><?php echo"($data5)"; ?></span></a></li>
                <li class="mb-1"><a href="#" class="d-flex" onclick="navigateToHref('Collectibles')"><span>Collectibles</span> <span class="text-black ml-auto"><?php echo"($data6)"; ?></span></a></li>
                <li class="mb-1"><a href="#" class="d-flex" onclick="navigateToHref('Jewelery and Accessories')"><span>Jewelery and Accessories</span> <span class="text-black ml-auto"><?php echo"($data7)"; ?></span></a></li>
                <li class="mb-1"><a href="#" class="d-flex" onclick="navigateToHref('Vintage')"><span>Vintage</span> <span class="text-black ml-auto"><?php echo"($data8)"; ?></span></a></li>
                <li class="mb-1"><a href="#" class="d-flex" onclick="navigateToHref('Clip Art')"><span>Clip Art</span> <span class="text-black ml-auto"><?php echo"($data9)"; ?></span></a></li>
                <li class="mb-1"><a href="#" class="d-flex" onclick="navigateToHref('Dolls and Miniatures')"><span>Dolls and Miniatures</span> <span class="text-black ml-auto"><?php echo"($data10)"; ?></span></a></li>
                <li class="mb-1"><a href="#" class="d-flex" onclick="navigateToHref('Fiber Art')"><span>Fiber Art</span> <span class="text-black ml-auto"><?php echo"($data11)"; ?></span></a></li>
                <li class="mb-1"><a href="#" class="d-flex" onclick="navigateToHref('Mixed Media and Collage')"><span>Mixed Media and Collage</span> <span class="text-black ml-auto"><?php echo"($data12)"; ?></span></a></li>
                <li class="mb-1"><a href="#" class="d-flex" onclick="navigateToHref('Fine Art Ceramics')"><span>Fine Art Ceramics</span> <span class="text-black ml-auto"><?php echo"($data13)"; ?></span></a></li>
                <li class="mb-1"><a href="#" class="d-flex" onclick="navigateToHref('Glass Art')"><span>Glass Art</span> <span class="text-black ml-auto"><?php echo"($data14)"; ?></span></a></li>
              </ul>
            </div>

         <!--   <div class="border p-4 rounded mb-4">
              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter by Price</h3>
                <div id="slider-range" class="border-primary"></div>
                <input type="text" name="text" id="amount" class="form-control border-0 pl-0 bg-white" disabled="" />
              </div>
            </div>-->
            
            
            <div class="border p-4 rounded mb-4">
                <div class="mb-4">
                    <h3 class="mb-3 h6 text-uppercase text-black d-block">Filter By Price</h3>
                    <form id="filter_price">
                        <div class="input-group">
                            <label for="minimum_price" class="h6 text-black">Min (Ksh)</label>
                            <input id="minimum_price" name="minimum_price" type="number">
                        </div>
                        <div class="input-group" style="margin-top: 5px;">
                            <label for="max_price" class="h6 text-black">Max (Ksh)</label>
                            <input id="max_price" name="max_price" type="number">
                        </div>
                        
                        <div class="input-group">
                            <input type="submit" value="FILTER" id="filter_price" style="margin-top:10px; margin-bottom:-10px;" class="btn btn-primary">
                        </div>
                        
                    </form>
                </div>
            </div>
            
            
            <script>
                $(function(){
                    
                    $("#filter_price").on('submit',function(e){

                      var min = $('#minimum_price').val();
                      var max = $('#max_price').val();

                      if(min == ''){
                        min = 0;
                      }

                      if(max == ''){

                        max = 100000000;

                      }

                        e.preventDefault();
                        $.ajax({
                            type: 'POST',
                            url: 'shop_search.php',
                            data: 'minimum_price='+min + '&max_price='+max,
                            beforeSend: function(){
                                   $("#list_row").html('<div class="container"><h5 style="margin-left:5%;">Please Wait ...</h5></div>');
                               },
                            success: function(data){
                                    $("#list_row").html(data);
                               },
                            error: function(){
                              $("#list_row").html('<div class="container"><h5 style="margin-left:5%;">Could not find items in your search.</h5></div>'); 
                            }
                        });
                    });
                    
                });
            </script>
            
            
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <?php include 'categories.php';?>
          </div>
        </div>
        
      </div>
    </div>

   <?php
   include 'footer.php';
   ?>
  </div>

 
  
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>

  <script src="js/main.js"></script>
    
  </body>
</html>