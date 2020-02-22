<?php

if(isset($_POST['category-name'])){
    
    $art_name = $_POST['category-name'];
    $art_category = $_POST['category-value'];
    $art_desc = $_POST['art-description'];
    $art_price = $_POST['art-price'];
    $art_qty = $_POST['art-qty'];
    
    // file name
    $filename = $_FILES['file']['name'];
    $file_name = uniqid('file_');
    // Location
    $location = '../images/'.$file_name.'_'.$filename;

    // file extension
    $file_extension = pathinfo($location, PATHINFO_EXTENSION);
    $file_extension = strtolower($file_extension);

    // Valid image extensions
    $image_ext = array("jpg","png","jpeg","gif");

    $response = 0;
    if(in_array($file_extension,$image_ext)){
    // Upload file
    if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
    $response = $location;
    }
    }
    
    if($response != 0){
        $art_id = uniqid('ART_');
        $add_art_query = "INSERT into artwork (ART_ID,USER_ID,ART_NAME,ART_DESCRIPTION,
            ART_PRICE,ART_FEATURED,ART_IMAGES,ART_CATEGORY,ART_COUNT) values('$art_id','$current_user','$art_name','$art_desc',
            '$art_price','1','$response','$art_category','$art_qty')";
        mysqli_query($con,$add_art_query);
        
    }
}

?>