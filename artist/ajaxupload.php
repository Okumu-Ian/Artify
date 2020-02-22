<?php

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

echo $response;
?>