<?php
//$server = "epiz_28069925_auction4545";
//$username = "epiz_28069925";
//$password = "Anamaria1$";
//$dbname = "sql100.epizy.com";


//connect to database
//$conn = mysqli_connect($server, $username, $password, $dbname);
$conn = mysqli_connect('localhost', 'root', 'your_password', 'auc');

//check connection
if(!$conn){
  echo 'Connection error: ' . mysqli_connect_error();
}

?>