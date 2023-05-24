<?php
if(isset($_SESSION['username'])){

$username = $_SESSION['username'];

}else{

header("location: index.php");
exit();
}