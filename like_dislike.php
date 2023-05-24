<?php 
session_start();
include_once "db_conn.php";
include_once "session.php";

//check if the post ID is set and is a number/integer
if(isset($_GET['post_id']) && is_numeric($_GET['post_id'])){

  $post_id = $_GET['post_id'];

}

//check if the like or dislike button is clicked
if(isset($_POST['like'])){
  //check if the user has already liked or disliked the post
  $sql1 = "SELECT * FROM likes WHERE post_id='$post_id' AND username='{$_SESSION['username']}'";
 $result1 = mysqli_query($conn, $sql1);

 if(mysqli_num_rows($result1) == 1){
  
  $row = mysqli_fetch_assoc($result1);

  if($row['action'] == 'like'){

    //user has already liked the post, so unlike it
    mysqli_query($conn, "UPDATE post SET likes=GREATEST(likes-1,0) WHERE post_id='$post_id'");
    mysqli_query($conn, "DELETE FROM likes WHERE post_id='$post_id' AND username='{$_SESSION['username']}'");
    $action='none';
    header("location: home.php");

  }else{

   //user has already disliked the post, so change dislike to like
   mysqli_query($conn, "UPDATE post SET likes=GREATEST(likes+1,0), dislikes=GREATEST(dislikes-1,0) WHERE post_id='$post_id'");
   mysqli_query($conn, "UPDATE likes SET action='like' WHERE post_id='$post_id' AND username='{$_SESSION['username']}'");
   $action = 'like';
   header("location: home.php");
 }

 }else{

  //user has not liked or disliked the post, so like it
  mysqli_query($conn, "UPDATE post SET likes=GREATEST(likes+1,0) WHERE post_id='$post_id'");
  mysqli_query($conn, "INSERT INTO likes (post_id, username, action) VALUES('$post_id','{$_SESSION['username']}','like')");
  header("location: home.php");

 }

} else if (isset($_POST['dislike'])) {
  //check if the user has already liked or disliked the post
  $sql1 = "SELECT * FROM likes WHERE post_id='$post_id' AND username='{$_SESSION['username']}'";
  $result1 = mysqli_query($conn, $sql1);

  if (mysqli_num_rows($result1) == 1) {
    $row = mysqli_fetch_assoc($result1);

    if ($row['action'] == 'dislike') {
      //user has already disliked the post, so undislike it
      mysqli_query($conn, "UPDATE post SET dislikes=GREATEST(dislikes-1,0) WHERE post_id='$post_id'");
      mysqli_query($conn, "DELETE FROM likes WHERE post_id='$post_id' AND username='{$_SESSION['username']}'");
      $action = 'none';
      header("location: home.php");
    } else {
      //user has already liked the post, so dislike it
      mysqli_query($conn, "UPDATE post SET dislikes=GREATEST(dislikes+1,0), likes=GREATEST(likes-1,0) WHERE post_id='$post_id'");
      mysqli_query($conn, "UPDATE likes SET action='dislike' WHERE post_id='$post_id' AND username='{$_SESSION['username']}'");
      $action = 'dislike';
      header("location: home.php");
    }
  } else {
    //user has not liked or disliked the post, so dislike it
    mysqli_query($conn, "UPDATE post SET dislikes=GREATEST(dislikes+1,0) WHERE post_id='$post_id'");
    mysqli_query($conn, "INSERT INTO likes (post_id, username, action) VALUES('$post_id','{$_SESSION['username']}','dislike')");
    header("location: home.php");
  }
}
