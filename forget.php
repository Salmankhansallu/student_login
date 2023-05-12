<?php
session_start();

if(isset($_SESSION["username"])){
header("Location: http://localhost/studentlogin/forget.php");
}




 ?>

<!doctype html>
<html>
<head>
  <link  rel="stylesheet" href="style.css">
</head>

<body>
<form id="forgetpassword" action="<?php $_SERVER['PHP_SELF']?>" method="POST">
  <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" class="form-control" placeholder="" required>
  </div>
  <div class="form-group">
      <label>Email</label>
      <input type="text" name="email" class="form-control" placeholder="" required>

  </div>
    <input type="submit" name="login" class="btn btn-primary" value="Submit" />
    <label><a href="login.php" style="margin-left:50px;color:white;">Back</a></label>
</form>
<?php
if(isset($_POST['login'])){
  include 'config.php';
  //$conn=mysqli_connect("localhost","root","","student")or die("Connection failed : " . mysqli_connect_error());
  $name=$_POST['username'];
  $email=$_POST['email'];

  $sql="SELECT username,password,email FROM registration WHERE username='{$name}' AND email='{$email}'";
  $result=mysqli_query($conn,$sql) or die("Query Failed.");
  $count=mysqli_num_rows($result);
  $row=mysqli_fetch_assoc($result);
  if($count > 0){

    while($row) {
session_start();
$_SESSION['password']=$row['password'];

  header("Location: http://localhost/studentlogin/login.php");
}
  }

  else{
    $_POST['username']="";
    $_POST['email']="";
    echo '<div class="alert alert-danger" style="position:absolute;top:450px; color:red;">Email is Incorrect...!.</div>';
  }
}


 ?>
</body>
</html>
