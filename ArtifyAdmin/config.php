<?php

define('DATABASE_NAME', 'vootbxke_artify');
define('SERVER_NAME','localhost');
define('SERVER_PASSWORD','#2Do0@kYvX^S');
define('SERVER_USER', 'vootbxke_artify');

$con = mysqli_connect(SERVER_NAME,SERVER_USER,SERVER_PASSWORD,DATABASE_NAME) or die('Error: 101');

if(!$con){
    echo "Error: 404";
}

?>