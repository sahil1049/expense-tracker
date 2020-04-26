<?php
session_start();
include('db.php');

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
  <link type="text/css" rel="stylesheet"
    href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <title>Sixpep</title>
  <style>
    body {
      background-color: rgb(209, 207, 230);
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-dark bg-dark">
    <a href="index.php" class="navbar-brand">SIXPEP</a>
    <form class="form-inline">
      <a href="expenseadd.php?logout='1'" class="btn btn-danger my-2 my-sm-0" name="filter">Logout</a>&nbsp;&nbsp;
      <a type="button" class="btn btn-warning  my-2 my-sm-0" href="./expensedisplay.php">Show Expenses</a>
      &nbsp;&nbsp;
      <button type="button" class="btn btn-outline-info my-2 my-sm-0" data-toggle="modal"
        data-target="#categoryModal">Add Category</button>
    </form>
  </nav>
  <div class="container" style="padding-top:50px">
    <center><button type="button" style="width:200px" class="btn btn-info">Food</button></center>
    <br>
    <center><button type="button" style="width:200px" class="btn btn-info">Shopping</button></center>
    <br>
    <center><button type="button" style="width:200px" class="btn btn-info">Travel</button></center>

    <!-- DISPLAYS THE ADDED CATEGORIES -->
    <center>
      <div id="categories"></div>
    </center>
    <br>


    <!-- Modal -->
    <div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Add Category</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="form-group">
              <label for="recipient-name" class="col-form-label">Category:</label>
              <input type="text" class="form-control" id="category">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="addCategory()" data-dismiss="modal">Add</button>
          </div>
        </div>
      </div>
    </div>
  </div>


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

<script>
  // read categories function
  $(document).ready(function () {

    readCategories();
  });
  function readCategories() {
    var readcategories = "readcategories";
    $.ajax({
      url: "categoryprocess.php",
      type: "post",
      data: { readcategories: readcategories },
      success: function (data, status) {
        $('#categories').html(data);
      }


    })



  }



  // add category function
  function addCategory() {
    var category = $('#category').val();


    $.ajax({
      url: 'categoryprocess.php',
      type: 'post',
      data: {
        category: category,

      },
      success: function (data, status) {

        readCategories();

      }
    })
  }

  // delete category
  function deleteCategory(deleteid) {
    var conf = confirm("are you sure you want to delete this category");
    if (conf == true) {
      $.ajax({
        url: "categoryprocess.php",
        type: "post",
        data: { deleteid: deleteid },
        success: function (data, status) {
          readCategories();
        }



      })
    }
  }

</script>

</html>