<?php
session_start();

if(!isset($_SESSION["username"])){
  header("Location: http://localhost/studentlogin/login.php");
}


 ?>

<!doctype  html>
<html>
<head>
<link  rel="stylesheet" href="style.css">
</head>
<body>
<div id="admin-contents">
      <div class="container">
          <div class="row">
              <div class="col-md-10" style="background:#0984e3; color:white; font-size:20px; padding:10px 15px;">
                <a class="user-logout" href="logout.php" style="color:#fff;"> HELLO <?php echo $_SESSION['username'];?>,LOGOUT</a>
                  <h1 class="admin-heading">All Users</h1>
              </div>

              <div class="col-md-12">
                <?php
                   // database configuration
                  /* Calculate Offset Code */
                  include 'config.php';
                //  $conn=mysqli_connect("localhost","root","","student")or die("Connection failed : " . mysqli_connect_error());
                  $limit = 8;
                  if(isset($_GET['page'])){
                    $page = $_GET['page'];
                  }else{
                    $page = 1;
                  }
                  $offset = ($page - 1) * $limit;
                  /* select query of user table with offset and limit */
                  $sql = "SELECT * FROM registration ORDER BY id DESC LIMIT {$offset},{$limit}";
                  $result = mysqli_query($conn, $sql) or die("Query Failed.");
                  if(mysqli_num_rows($result) > 0){
                ?>
                  <table class="content-table" border="1" cellspacing=0 name="data">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Email</th>

                      </thead>
                      <tbody>
                        <?php
                          $serial = $offset + 1;
                          while($row = mysqli_fetch_assoc($result)) {
                        ?>
                          <tr>
                              <td class='id'><?php echo $serial; ?></td>
                              <td><?php echo $row['fname']. " ".$row['lname']; ?></td>
                              <td><?php echo $row['username']; ?></td>
                              <td><?php echo $row['email'];?></td>

                          </tr>
                        <?php
                          $serial++;
                        } ?>
                      </tbody>
                  </table>
                  <?php
                }else {
                  echo "<h3>No Results Found.</h3>";
                }
                // show pagination
                $sql1 = "SELECT * FROM registration";
                $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                if(mysqli_num_rows($result1) > 0){

                  $total_records = mysqli_num_rows($result1);

                  $total_page = ceil($total_records / $limit);

                  echo '<ul  class="pagination admin-pagination">';
                  if($page > 1){
                    echo '<li ><a href="user.php?page='.($page - 1).'">Prev</a></li>';
                  }
                  for($i = 1; $i <= $total_page; $i++){
                    if($i == $page){
                      $active = "active";
                    }else{
                      $active = "";
                    }
                    echo '<li class="'.$active.'"><a href="user.php?page='.$i.'">'.$i.'</a></li>';
                  }
                  if($total_page > $page){
                    echo '<li><a href="user.php?page='.($page + 1).'">Next</a></li>';
                  }

                  echo '</ul>';
                }
                  ?>
              </div>
          </div>
      </div>
  </div></body>
</html>
