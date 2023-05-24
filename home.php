<?php 
session_start();
include_once "session.php";
include_once "db_conn.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EJ | HOME</title>

  <link rel="stylesheet" href="fontawasome/css/all.min.css">
  <link rel="stylesheet" href="fontawasome/css/fontawesome.min.css">

  <style>
    body{
    background: lavender;
    }

    nav{
      display: flex;
      justify-content:space-around;
      align-items: center;
    }

    section{
      display: flex;
      flex-wrap: wrap;
      gap: 2px;
      justify-content: center;
      border-top: 2px solid #00f;
      border-bottom: 2px solid #00f;
   }

   .post{
      display: flex;
      justify-content: center;
      text-align: center;
      background: lightgray;
      flex-basis: 500px;
      flex-grow: 1;
    }

   .content{
    display: block;
    justify-content: center;
    align-items: center;
   }

   .post form input,
   textarea{
    display: block;
    outline: none;
    margin: 10px;
    border: 1px solid #00f;
    padding: 10px;
    border-radius: 3px;
    width: 100%;

   }

   input#button{
    color: #fff;
    padding: 8px;
    background: #00f;
    cursor: pointer;
    }

    input#button:hover{
      opacity: 0.7;
    }

  h4 small{
    color: green;
   }
   a{
    text-decoration: none;
    color: #00f;
   }

  

   .container{
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: justify;
    background: lightgray;
    flex-grow: 1;
    flex-basis: 500px;
  
   }

 

   .buttons{
  display: flex;
  padding: 4px;
  justify-content: flex-start;
  align-items: flex-start;
   }

   button{
    cursor: pointer;
    padding: 4px;
    background: #fff;
    margin: auto 5%;
    border: 1px solid #00f;
    border-radius: 50%;
    color: #00f;
    font-size: 16px;
   
   }
 </style>
</head>
<body>
  <nav>
<span><?= "Welcome" . " " . ucwords($username) ?></span>
<a href="logout.php">Sign Out</a>
</nav>
 
<section>
  <div class="post">
  <div class="content">
 

  <h4>Post Something</h4>
<?php
if(isset($_SESSION['error'])){?>

<p><?php echo ($_SESSION['error']); ?></p>

<?php unset($_SESSION['error']); }?>
 
<form action="post.php" method="post">

<input type="text" name="post_title" placeholder="Post Title" required>

<textarea type="text" name="post_content" placeholder="Post Your content here..." row="4" required></textarea>
<input id="button" type="submit" name="submit" value="POST"><br>

</form>
</div>
</div>

<div class="container">
<div class="content">

<h4>Post Display</h4>

<?php 
$sql  = "SELECT * FROM post";

$result = mysqli_query($conn, $sql);
if($result)
{
if(mysqli_num_rows($result) > 0)
{
  while($row = mysqli_fetch_array($result))
  {
    $post_id = $row['post_id']; 
    $post_content = $row['post_content']; 
    $post_title = $row['post_title']; 
    $likes = $row['likes']; 
    $dislikes = $row['dislikes']; 
?>

    <h4><?=  ucwords($post_title) .':-' ?> <small><?=  $post_content ?></small></h4>
  

    <form action="like_dislike.php?post_id=<?=  $row['post_id']; ?>" method="post">
   <div class="buttons">
    <button  type="submit" name="like"><i class="fa-solid fa-thumbs-up"></i></button>
   <span><?=  $likes ?></span> 
    <button  type="submit" name="dislike"><i class="fa-solid fa-thumbs-down"></i></button>
   <span><?= $dislikes ?></span>
    </div>
 
    </form>
    <hr>
   





  <?php } } } ?>
</div>
</div>
</section>
<center><small>ejtechpro &copy; <?= date('Y M D'); ?></small></center>
<script src="fontawasome/js/all.min.js"></script>
<script src="fontawasome/js/fontawesome.min.js"></script>
</body>
</html>