<?php
session_start(); 
include_once "db_conn.php";

if(isset($_POST['submit'])){

  $post_title = $_POST['post_title'];
  $post_content = $_POST['post_content'];


  $sql = "INSERT INTO post(post_title,post_content) VALUES('$post_title','$post_content')";

  $result = mysqli_query($conn, $sql);

  if($result){
    
    $_SESSION['error'] = "Success!";

    header("location: home.php");
    exit();

  }else{

    $_SESSION['error'] = "Failed!";

    header("location: home.php");
    exit();
  }
}