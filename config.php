<?php
error_reporting(E_ALL);
define("SERVER","localhost");
define("USER", "vootbxke_artify");
define("PASSWORD", "#2Do0@kYvX^S");
define("DATABASE", "vootbxke_artify");

$con = mysqli_connect(SERVER,USER,PASSWORD,DATABASE) or die();

if(!$con){
	 echo "Error";
}else{
    
	
}
?>