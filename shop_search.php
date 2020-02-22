<?php
require_once('config.php');
if($_POST['filter_category']){
    
    $filter_values = $_POST['filter_category'];
    
     $query = "SELECT * FROM artwork WHERE ART_NAME LIKE '%{$filter_values}%' OR ART_CATEGORY LIKE '%{$filter_values}%' ORDER BY ART_DATE DESC";
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
                    '<p class="mb-0">'.$row['ART_DESCRIPTION']
                    .'</p>'
                    .'<p class="text-primary font-weight-bold">Ksh '
                    .$row['ART_PRICE']
                    .'</p>'
                  .'</div>'
                .'</div>'
              .'</div>';

              }
              
              }else{
                  
                  echo '<div class="container"> <p>No Items match your search.</p></div>';
                  
              }
    
}else if($_POST['max_price'] && $_POST['minimum_price']){
    
    $max = $_POST['max_price'];
    $min = $_POST['minimum_price'];
    
    $query = "SELECT * FROM artwork WHERE ART_PRICE between '$min' AND '$max'";
    
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
              
              }else{
                  
                  echo '<div class="container"> <p>No Items match your search.</p></div>';
                  
              }
    
}

?>