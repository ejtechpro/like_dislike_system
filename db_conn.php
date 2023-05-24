<?php
$hname = "localhost";
$uname = "root";
$pass = "";
$db_name ="like";


  $conn = mysqli_connect($hname , $uname , $pass , $db_name);

  if(!$conn){

    echo "Connection failed!";

   }
   ?>