<?php
session_start();
require('db.php');
if (isset($_GET['logout'])) {
  session_destroy();
  unset($_SESSION['username']);
  header("location: index.php");
}
// for unauthorized access
if(!isset($_SESSION['email'])){
  header('location: index.php');
}
$em=$_SESSION['email'];
$status="SELECT * FROM users where email='$em'";
$result=mysqli_query($db,$status);
$row=mysqli_fetch_array($result);
$status=$row['status'];

// for unauthorized access
if($status!="1"){
  exit("<script type='text/javascript'>alert('phone number not verified  ');
window.location.href='index1.php';
</script>");
}

$query="SELECT * from category where email='$em'";
$result=mysqli_query($db,$query);

// INSERT EXPENSE
if(isset($_POST['add'])){
    $category=$_POST['category'];
$amount=$_POST['amount'];
$day=$_POST['day'];
$month=$_POST['month'];
$email=$_SESSION['email'];
$query="INSERT into expenses(email,amount,category,day,month) values('$email','$amount','$category','$day','$month')";
mysqli_query($db,$query);

echo("<script type='text/javascript'>alert('Expense added ');
window.location.href='expensedisplay.php';
</script>");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-dark bg-dark">
  <a href="./index.php"class="navbar-brand">SIXPEP</a>
  <form class="form-inline" method="post" action="">
    
    <a  href="expenseadd.php?logout='1'" class="btn btn-outline-info my-2 my-sm-0" name="filter">Logout</a>
  </form>
  
</nav>
    <center><h1>New Expenses</h1></center>
    <div class="container">
    <form action="" method="post">
    <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Amount</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="amount" placeholder="Amount">
    </div>
  </div>
      <br>
      <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Category</label>
    <div class="col-sm-4">
      <select name="category">
      <option value="food">Food</option>
      <option value="shopping">Shopping</option>
      <option value="travel">Travel</option>
      <?php
      while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
          echo"<option value='".$row['cname']."'>".$row['cname']."</option>";
      }
      ?>
      </select>
      </div>
      </div>
      <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Day</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="day" placeholder="Day">
    </div>
  </div>
      
      <div class="form-group row">
    <label  class="col-sm-2 col-form-label">Month</label>
    <div class="col-sm-4">
      <input type="text" class="form-control" name="month" placeholder="Month">
    </div>
  </div>

      <button class="btn btn-primary"type="submit" name="add">Add Expense</button>

    </form>
</div>
    
   
</body>
</html>