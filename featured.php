<?php
global $con;
?>
<div class="site-section block-3 site-blocks-2 bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Featured ArtWork</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="nonloop-block-3 owl-carousel">


            <?php
            $query = "SELECT * FROM artwork WHERE ART_FEATURED = 1";
            $results = mysqli_query($con,$query);
            if(mysqli_num_rows($results) > 0){
              $dataArray = array();
              while ($row = mysqli_fetch_assoc($results)) {
                $dataArray[] = $row;
                echo '<div class="item">'.
                '<div class="block-4 text-center">'.
                  '<figure class="block-4-image">'.
                    '<img src="'.$row['ART_IMAGES'].
                    '" alt="Image placeholder" class="img-fluid" style="height: 250px;">'.
                  '</figure>'.
                  '<div class="block-4-text p-4">'.
                    '<h3><a href="?item='.$row['ART_ID'].'">'.$row['ART_NAME'].
                    '</a></h3>'.
                    '<p class="mb-0">'.$row['ART_DESCRIPTION'].
                    '</p>'.
                    '<p class="text-primary font-weight-bold">Ksh '.$row['ART_PRICE'].
                    '</p>'.
                  '</div>'.
                '</div>'.
              '</div>';
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
          </div>
        </div>
      </div>
    </div>