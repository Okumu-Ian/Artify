<?php

require 'config.php';
$output = '';
$query = $_POST["search_art"];
$sql = "SELECT * FROM  artwork WHERE ART_NAME LIKE '%{$query}%'";
$result = mysqli_query($con,$sql);

if(mysqli_num_rows($result) > 0){

    $index = 0;
    while($row = mysqli_fetch_assoc($results)){
        ++$index;
        $output .= '
        <tr>
        <td>'.$index. '</td>
        <td>'.$row["ART_ID"]. '</td>
        <td>'.$row["ART_NAME"]. '</td>
        <td>'.$row["ART_CATEGORY"]. '</td>
        <td>
                  <div class="row">
                    <button class="btn btn-primary" style="margin-right: 2%; width: auto;">VIEW</button>
                    <button class="btn btn-danger" style="margin-left: 2%; width: auto;">DELETE</button>
                  </div>
                  </td>
        ';
    }
    echo $output;

} else{
    echo "Nothing Found";
}

?>