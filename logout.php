<?php
include 'config.php';
//$conn=mysqli_connect("localhost","root","","student")or die("Connection failed : " . mysqli_connect_error());

session_start();

session_unset();

session_destroy();

  header("Location: http://localhost/studentlogin/login.php");

?>
