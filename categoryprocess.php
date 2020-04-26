<?php
require('./db.php');
session_start();
extract($_POST);
$em=$_SESSION['email'];
$status="SELECT * FROM users where email='$em'";
$result=mysqli_query($db,$status);
$row=mysqli_fetch_array($result);
$status=$row['status'];

// INSERTS NEW CATEGORY
if(isset($_POST['category']))
{
    $email=$_SESSION['email'];
    
   
    $query="INSERT INTO category(email,cname) VALUES ('$email','$category') ";
    mysqli_query($db,$query);

}

// READS CATEGORIES
if(isset($_POST['readcategories']))
{
    $email=$_SESSION['email'];
    $displayquery="SELECT * FROM category where email='$email'";
    $result=mysqli_query($db,$displayquery);
    while($row=mysqli_fetch_array($result)){
      echo"<br>";
        echo"<button type='button'style='width:200px;margin-left:33px;align-content:center' class='btn btn-info'>".$row['cname']."</button>
        &nbsp;<i class='fa fa-trash fa-2x' onclick='deleteCategory(".$row['cid'].")'aria-hidden='true'></i><br>";
    }
    

}

// DELETES CATEGORY
if(isset($_POST['deleteid'])){
    $cid=$_POST['deleteid'];
    $deleteQuery="DELETE FROM category where cid ='$cid'";
    mysqli_query($db,$deleteQuery);

}
?>