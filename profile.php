<?php
include('./db.php');
session_start();
if(!isset($_SESSION['email'])){
  header('location: index.php');
}
$email=$_SESSION['email'];
// FETCHING PREVIOUS DETAILS
$query="SELECT * from users where email='$email'";
$result=mysqli_query($db,$query);
$row=mysqli_fetch_array($result);
$uid=$row['uid'];
$name=$row['name'];
$phone=$row['phone'];
$email=$row['email'];
$dob=$row['dob'];

// UPDATE QUERY
if(isset($_POST['update'])){
$uname=$_POST['name'];
$uemail=$_POST['email'];
$ugender=$_POST['gender'];
$udob=$_POST['dob'];
$uphone=$_POST['phone'];
$uquery="UPDATE users set name='$uname',email='$uemail',gender='$ugender',dob='$udob',phone='$uphone' where uid='$uid'";
mysqli_query($db,$uquery);
$_SESSION['email']=$uemail;
echo("<script type='text/javascript'>alert('Profile Updated');
window.location.href='index.php';
</script>");

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Sixpep</title>
</head>

<body>
  <nav class="navbar navbar-dark bg-dark">
    <a href="./index.php" class="navbar-brand">SIXPEP</a>

  </nav>
  <br>
  <br>
  <div class="container">
    <form action="" method="post">
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Name</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="name" value=<?php echo $name;?>>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Email</label>
        <div class="col-sm-4">
          <input type="email" class="form-control" name="email" value=<?php echo $email;?>>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Gender</label>
        <div class="col-sm-4">
          <label for="male">Male</label>
          <input type="radio" name="gender" id="male" value="male" checked>
          <label for="female">Female</label>
          <input type="radio" name="gender" id="female" value="female">
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Date of Birth</label>
        <div class="col-sm-4">
          <input type="date" class="form-control" name="dob" value=<?php echo $dob;?>>
        </div>
      </div>
      <div class="form-group row">
        <label class="col-sm-2 col-form-label">Phone</label>
        <div class="col-sm-4">
          <input type="text" class="form-control" name="phone" value=<?php echo $phone;?>>
        </div>
      </div>
      <button class="btn btn-primary" type="submit" name="update">Update Profile</button>
    </form>
  </div>
</body>

</html>