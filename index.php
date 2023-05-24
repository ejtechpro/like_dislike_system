<?php 
session_start();

if(isset($_POST['username'])){

$username = $_POST['username'];

  if($username == 'ej' || $username == 'ann'){

    $_SESSION['username'] = $username;

    header("location: home.php");
    exit();
 

  }else{

    $_SESSION['error'] = "Invalid username!";

    header("location: index.php");
    exit();
    
  }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>EJ | LOGIN</title>

  <style>
    body{
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      height: 100vh;
      background: lavender;
    }
    
    .content{
      display: block;
      justify-content: center;
      align-items: center;
      width: 50%;
    }

    .login{
      display: block;
      justify-content: center;
      align-items: center;
      text-align: center;
      background: lightgray;
      padding-top: 10px;
      width: 100%;
      height: 25vh;
      border-top: 2px solid #00f;
      border-bottom: 2px solid #00f;
   }
   .login form input{
    outline: none;
    border: 1px solid #00f;
    padding: 10px;
    border-radius: 3px;

   }

   input#button{
    color: #fff;
    padding: 8px;
    margin-top: 3%;
    background: #00f;
    cursor: pointer;
    }

    input#button:hover{
      opacity: 0.7;
    }

   p{
    color: brown;
   }
</style>

</head>
<body>
<div class="content">
<div class="login">

<h4>Login</h4>
<?php
//Displaying error using session
if(isset($_SESSION['error'])){?>

<p><?php echo $_SESSION['error']; ?></p>

<?php unset($_SESSION['error']); } ?>
 
<form action="index.php" method="post">

<input type="text" name="username" placeholder="Username" required>

<input type="submit" id="button"  name="submit" value="Login">

</form>
</div>
<small>ejtechpro &copy; <?= date('Y M D'); ?></small>
</div>
  
</body>
</html>