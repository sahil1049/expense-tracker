<?php
include('main.php');

if(!isset($_SESSION['otp'])){
    header('location: index.php');
}

$em=$_SESSION['email'];
$status="SELECT * FROM users where email='$em'";
$result=mysqli_query($db,$status);
$row=mysqli_fetch_array($result);
$status=$row['status'];

// to avoid visit to this page after user is verified
if($status=='1'){
  header('location:index.php');}
$var=$_SESSION['otp'];

?>
<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
  integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<title>Sixpep</title>

<body>
  <nav class="navbar navbar-dark bg-dark">
    <a href="./index.php" class="navbar-brand">SIXPEP</a>

  </nav>

  <center>
    <form style="margin-top:100px" action="" method="post">
      <label class="form-label">Enter OTP</label>
      <input type="text" name="otpvalue">

      <button type="submit" class="btn btn-success" name="otp_verify">Verify</button>
      <?php
echo "$var(in case the api does not work)";
?>
    </form>
  </center>

</body>

</html>