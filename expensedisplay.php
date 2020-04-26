<?php
session_start();
// for unauthorized access
if(!isset($_SESSION['email'])){
    header('location: index.php');
  }
require('db.php');
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
$email=$_SESSION['email'];
$query="SELECT * from expenses where email='$email'";
$result=mysqli_query($db,$query);
$data="<table class='table table-bordered table striped'>
<tr>
<th>Amount(in Rs.)</th>
<th>Category</th>
<th>Day</th>
<th>Month</th>
</tr>";
while($row=mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $amount=$row['amount'];
    $category=$row['category'];
    $day=$row['day'];
    $month=$row['month'];
    $data.="<tr>
    <td>$amount</td>
    <td>$category</td>
    <td>$day</td>
    <td>$month</td>
    <tr>";

}
$data.="</table";
if(isset($_POST['filter'])){
    $category=$_POST['category'];
$test="SELECT * from expenses where category='$category' and email='$email'";
$fresult=mysqli_query($db,$test);
$fdata="<table class='table table-bordered table striped'>
<tr>
<th>Amount(in Rs.)</th>
<th>Category</th>
<th>Day</th>
<th>Month</th>
</tr>";
while($frow=mysqli_fetch_array($fresult,MYSQLI_ASSOC)){
    $amount=$frow['amount'];
    $category=$frow['category'];
    $day=$frow['day'];
    $month=$frow['month'];
    $fdata.="<tr>
    <td>$amount</td>
    <td>$category</td>
    <td>$day</td>
    <td>$month</td>
    <tr>";
}
$fdata.="</table";
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
    <title>Document</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <a href="./index.php" class="navbar-brand">SIXPEP</a>
        <form class="form-inline" method="post" action="">
            <a href="expenseadd.php?logout='1'" class="btn btn-danger my-2 my-sm-0" name="filter">Logout</a>&nbsp;&nbsp;
            <input class="form-control mr-sm-2" type="search" placeholder="category" name="category"
                aria-label="Search">
            <button type="submit" class="btn btn-outline-info my-2 my-sm-0" name="filter">Search </button>
        </form>
    </nav>
    <br>
    <br>

    <form action='' method="post">
        <button name="display" class="btn btn-primary " type="submit">Display All</button>
        <a class="btn btn-success " href="./category.php">Show Categories</a>
        <a style="position:fixed;right:2px" class="btn btn-warning " href="./expenseadd.php">Add Expense</a>



    </form>


    <?php
// DISPLAYS FILTERED EXPENSES 
if(isset($_POST['filter'])){
    echo $fdata;
    }
 // DISPLAYS ALL EXPENSES
    else{
        echo $data;
        }
?>

</body>

</html>