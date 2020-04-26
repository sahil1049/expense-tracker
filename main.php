<?php
session_start();
$db = mysqli_connect('localhost', 'root', '', 'sixpep');
$errors=array();

// REGISTRATION
if(isset($_POST['create'])){
   $name=$_POST['name'];
   $email=$_POST['email'];
   $_SESSION['email']=$email;
   $gender=$_POST['gender'];
   $dob=$_POST['dob'];
  //  USER DUPLICATION QUERY
   $user_check_query = "SELECT * FROM users WHERE email='$email'  LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
 
  if (mysqli_fetch_array($result)) {
    session_destroy();
    echo("<script type='text/javascript'>alert('User already exists');
   window.location.href='index.php';
   </script>");
  }
  else{
      
   $query="INSERT into users(name,email,gender,dob) values ('$name','$email','$gender','$dob')";
   mysqli_query($db,$query);
  
   echo("<script type='text/javascript'>alert('User Created');
   window.location.href='index1.php';
   </script>");
  }
}

// SENDS OTP
if(isset($_POST['btn-save'])){
  $num = $_POST["phone"];
  $_SESSION['phone']=$num;
  $rndno=rand(1000, 9999);

$ms = rawurlencode($rndno);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.fast2sms.com/dev/bulk?authorization=K3sxn629GdVgSu0qvYFWtXmMCpcwZPioyEHfNAU58jeaDrTb7zClh2OxDbTkBUaLeYt0j4go1InpZ6mX&sender_id=FSTSMS&message=".urlencode($ms)."&language=english&route=p&numbers=".urlencode($num),
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_SSL_VERIFYHOST => 0,
  CURLOPT_SSL_VERIFYPEER => 0,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
  CURLOPT_HTTPHEADER => array(
    "cache-control: no-cache"
  ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);


$_SESSION['otp']=$rndno;
header("Location:otp.php");
}

// OTP VERIFICATION
if(isset($_POST['otp_verify'])){
  $urno=$_POST['otpvalue'];
  $rno=$_SESSION['otp'];
  $phone=$_SESSION['phone'];
  $email=$_SESSION['email'];
  if($urno==$rno)
  {
    $query="UPDATE users set phone='$phone',status='1' where email='$email'";
    mysqli_query($db,$query);

    echo("<script type='text/javascript'>alert('Phone verified ');
    window.location.href='expensedisplay.php';
    </script>");
  }
  else{
      header('Location: otp.php');
  }

}
// LOGIN USING EMAIL
if(isset($_POST['login'])){
  $email=$_POST['vemail'];
  $query="SELECT * from users where email='$email'";
  $result=mysqli_query($db,$query);
  if(mysqli_fetch_array($result)==null){
    echo("<script type='text/javascript'>alert('User does not exist');
    window.location.href='index.php';
    </script>");

  }
  else{
    $_SESSION['email']=$email;
  header('location:expensedisplay.php');
  }
}
?>
