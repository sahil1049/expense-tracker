<?php
session_start();
include('db.php');
if(isset($_SESSION['email'])){
  $em=$_SESSION['email'];
$status="SELECT * FROM users where email='$em'";
$result=mysqli_query($db,$status);
$row=mysqli_fetch_array($result);
$status=$row['status'];
$name=$row['name'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link type="text/css" rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link type="text/css" rel="stylesheet" href="index.css">

  <title>Sixpep</title>
</head>

<body>
  <!--Main Navigation-->
  <nav class="navbar navbar-dark bg-dark">
    <a class="navbar-brand">SIXPEP</a>
    <form class="form-inline">

      <!-- IF USER IS LOGGED IN -->
      <?php
  if(isset($_SESSION['email'])){
 
  ?>
      <a href="expensedisplay.php" class="btn btn-primary my-2 my-sm-0">Show Expenses</a>&nbsp;&nbsp;
      <a href="./profile.php" class="btn btn-warning my-2 my-sm-0">Profile</a>&nbsp;&nbsp;
     
    <?php
    if($status!="1"){
    ?>  <a href="./index1.php" class="btn btn-success my-2 my-sm-0">Verify</a>&nbsp;&nbsp;
    <?php
  }?>
      <a href="expenseadd.php?logout='1'" class="btn btn-danger my-2 my-sm-0" name="filter">Logout</a>

      <!-- IF USER IS LOGGED OUT -->
      <?php
  }
  if(!isset($_SESSION['email'])){
    
    ?>
      <button type="button" class="btn btn-success my-2 my-sm-0" data-toggle="modal"
        data-target="#signinModal">Login</button>
      &nbsp;&nbsp;
      <button type="button" class="btn btn-warning my-2 my-sm-1" data-toggle="modal" data-target="#signupModal">Create
        Account</button>
      <?php
  }
  ?>
    </form>
  </nav>
  <!-- LOGIN -->
  <div class="modal fade" id="signinModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Login</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="main.php" method="post">
          <div class="modal-body">


            <div class="form-group">
              <label for="recipient-email" class="col-form-label">Email:</label>
              <input type="email" class="form-control" name="vemail" id="vemail">
            </div>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button name="login" type="submit" class="btn btn-primary">Sign In</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
  <!-- CREATE ACCOUNT -->
  <div class="modal fade" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalCenterTitle">Create Account</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="main.php" method="post">
          <div class="modal-body">

            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Name:</label>
              <input type="text" class="form-control" name="name" id="name">
            </div>
            <div class="form-group">
              <label for="recipient-email" class="col-form-label">Email:</label>
              <input type="email" class="form-control" name="email" id="email">
            </div>
            <div class="form-group">
              <label for="recipient-gender" class="col-form-label">Gender:</label>
              &nbsp;&nbsp;&nbsp;
              <label for="male">Male</label>
              <input type="radio" name="gender" id="male" value="male" checked>
              <label for="female">Female</label>
              <input type="radio" name="gender" id="female" value="female">
            </div>
            <div class="form-group">
              <label for="recipient-dob" class="col-form-label">Date of Birth:</label>

              <input type="date" class="form-control" name="dob" id="dob">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button name="create" type="submit" class="btn btn-primary">Sign Up</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  </div>
<?php
if(isset($_SESSION['email'])){
if($status=="1"){
?>
<h1 style="text-align:center;padding-top:70px"> Hello <?php echo $name ?></h1>
<?php
}
}?>

<img src="images/logo.jpg" style="">


  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
    crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</body>

</html>