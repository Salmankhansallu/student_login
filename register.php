<?php
session_start();
if(isset($_SESSION['password'])){
  echo "Your Password is : ".$_SESSION['password'];
  session_unset($_SESSION['password']);

}




 ?>
