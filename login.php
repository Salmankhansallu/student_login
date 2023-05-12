<?php
session_start();


if(isset($_SESSION['password'])){
  echo "Your Password is : ".$_SESSION['password'];
  unset($_SESSION['password']);

}
else if(isset($_SESSION['status'])){
  echo $_SESSION['status'];
  unset($_SESSION['status']);
}

?><!doctype html>
<html>
<head>
  <link  rel="stylesheet" href="style.css">
</head>
<body>
  <div id="wrapper-admin" class="body-content">
              <div class="container">
                  <div class="row">
                      <div class="col-md-offset-4 col-md-4">
                        <!-- <img class="logo" src="image/news.jpg" style="margin-left:84px;"> -->

  <!-- /Form  start-->
                          <form  action="<?php $_SERVER['PHP_SELF']; ?>" method ="POST">
                                    <h3 class="heading">User</h3>
                              <div class="form-group">
                                  <label>Username</label>
                                  <input type="text" name="username" class="form-control" placeholder="" required>
                              </div>
                              <div class="form-group">
                                  <label>Password</label>
                                  <input type="password" name="password" class="form-control" placeholder="" required>
                              </div>
                              <input type="submit" name="login" class="btn btn-primary" value="login" />
                              <label class="login_text"> Don't have an account?<a href="Registration.php" class="login"> Create Account   &nbsp;<a href="forget.php" class="forget" style="float:right;"> Forget Password</a></a>  </label>




                          </form>
                          <!-- /Form  End -->
                          <?php
                            if(isset($_POST['login'])){
                              include 'config.php';
                            //  $conn=mysqli_connect("localhost","root","","student")or die("Connection failed : " . mysqli_connect_error());
                              if(empty($_POST['username']) || empty($_POST['password'])){
                                echo '<div class="alert alert-danger">All Fields must be entered.</div>';
                                die();
                              }else{
                                $user = mysqli_real_escape_string($conn, $_POST['username']);
                                $pass = $_POST['password'];

                                $sql = "SELECT id,upper(username) as username  FROM registration WHERE username = '{$user}' AND password= '{$pass}'";

                                $result = mysqli_query($conn, $sql) or die("Query Failed.");

                                if(mysqli_num_rows($result) > 0){

                              while($row = mysqli_fetch_assoc($result)){
                                session_start();
                             $_SESSION['username']=$row['username'];

                                header("Location: http://localhost/studentlogin/user.php");
                              }

                            }else{
                              $_POST['username']="";
                              $_POST['password']="";
                            echo '<div class="alert alert-danger" style="position:absolute;top:450px; color:red;">Username and Password are not matched.</div>';


                          }
                            }
                            }
                          ?>
                      </div>
                  </div>
              </div>
          </div>
</body>
</html>
