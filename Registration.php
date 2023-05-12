<?php

session_start();
if(isset($_SESSION["username"])){
header("Location: http://localhost/studentlogin/Registration.php");
}

?>

<?php
if(isset($_POST['save'])){
  include 'config.php';
  //$conn=mysqli_connect("localhost","root","","student")or die("Connection failed : " . mysqli_connect_error());
  $fname=mysqli_real_escape_string($conn,$_POST["fname"]);
  $lname=mysqli_real_escape_string($conn,$_POST["lname"]);
  $user=mysqli_real_escape_string($conn,$_POST["user"]);
  $email=mysqli_real_escape_string($conn,$_POST["email"]);
  $password=mysqli_real_escape_string($conn,$_POST["password"]);

  $sql = "SELECT username FROM registration WHERE username = '{$user}'";

  $result = mysqli_query($conn, $sql) or die("Query Failed.");
$row=mysqli_num_rows($result);
  if($row>0){
    echo "<p style='color:red;text-align:center;margin: 10px 0;'>UserName already Exists.</p>";


  }else{
    $sql1 = "INSERT INTO registration (fname,lname, username, email, password)
              VALUES ('{$fname}','{$lname}','{$user}','{$email}','{$password}')";
$result1=mysqli_query($conn,$sql1);
    if($result1){
      $_POST["user"]="";
      $_POST["password"]="";

$_SESSION['status']="Registered successfully..!";
header('location:http://localhost/studentlogin/login.php');


    }else{
      echo "<p style='color:red;text-align:center;margin: 10px 0;'>Can't Insert User.</p>";
    }
  }

}

 ?>
 <!doctype html>
 <html>
 <head>
  <link  rel="stylesheet" href="style.css">
 </head>
 <body>
<div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="heading"> New Registration</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <!-- <?php $_SERVER['PHP_SELF']; ?> -->
                  <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>
                      <div class="form-group">
                          <label>Email</label>
                          <input type="text" name="email" class="form-control" placeholder="email" required>
                      </div>

                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>

                      <input type="submit"  name="save" class="btn btn-primary" value="Save" required />
                      <label class="login_text">Have an account?<a href="login.php" class="login"> login</a></label>
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div></body>
</html>
