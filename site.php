<?php
include 'conn.php';
session_start();
if(!isset($_SESSION['aid'])){
      header("location:index.php");
  }
  if(isset($_POST["logout"]))
{
   session_destroy();
   header("location:index.php");
}
$check="select * from site order by sid desc";
$result = mysqli_query($conn,$check);
$count = mysqli_num_rows($result);
if (isset($_POST["add"]))
 {
  $sn=$_POST['sitename'];
      $sql = "insert into site(sitename) value('$sn');";
 
    if(mysqli_query($conn,$sql)){

   echo "<script>
alert('added successfully!!');
window.location.href='site.php';
</script>";
  
    }
    else{
        echo "<script>
alert('Already Exist!!');
window.location.href='site.php';
</script>";
    
    }
}
if (isset($_POST["enter"]))
 {
  $sn=$_POST['sitename'];
      $sql1 = "select * from site where sid='$sn'";
      $result1 = mysqli_query($conn,$sql1);
      $row1 = mysqli_fetch_assoc($result1);
      $count1 = mysqli_num_rows($result1);
    if($count1==1){

   $_SESSION['sid'] = $row1['sid'];
  header("location:dailywork.php");
  
    }
    else{
        echo "<script>
alert('invalid sitename');
window.location.href='site.php';
</script>";
    
    }
}
if(isset($_POST['delete']))
{
$sid=$_POST['sid'];
$del1 = "delete from site where sid='$sid'";
$del2 = "delete from dailywork where sid='$sid'";
$del3 = "delete from customerpayment where sid='$sid'";
$del4 = "delete from labours where sid='$sid'";
$del5 = "delete from labour where sid='$sid'";
$del6 = "delete from purchase where sid='$sid'";
$del7 = "delete from agreement where sid='$sid'";
if(mysqli_query($conn,$del1) && mysqli_query($conn,$del2) && mysqli_query($conn,$del3) && mysqli_query($conn,$del4) && mysqli_query($conn,$del5) && mysqli_query($conn,$del6) && mysqli_query($conn,$del7))
{
echo "<script>
alert('deleted successfully!!');
window.location.href='site.php';
</script>";
  
    }
    else{
        echo "<script>
alert('Error Deleting Site!!');
window.location.href='site.php';
</script>";
    
    }
} 

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
 <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
   
   table thead tr th {
   text-align: left;
   position: sticky;
   top: 0px;
   background-color: #666;
   color: #fff;
 }
</style>
    <title>Site</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-md navbar-dark" style="background-color: #563d7c;">
   <a class="navbar-brand" href="expense.php">My Way Constructions</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="expense.php">Expense</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="salary.php">Salary</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="site.php">Site</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="gstbill.php">GST Bill</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="gstfiling.php">GST Filing</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" target="_blank" href="letterhead.pdf">Letter Head</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="quotation.php">Quotation</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="image.php">Image</a>
      </li>
      <li>
      <form method="post"><button name="logout" class="btn btn-danger navbar-btn pl-3">Logout</button></form>   
      </li> 
    </ul>
  </div>  
</nav>
<br>

<div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-8">
        <h3>Sites</h3>
    <form method="post">
      <div class="form-group">
          <label>Site Name:</label>
      <select class="form-control select2" style="width:100%!important;" name="sitename">
        <?php while ($row = mysqli_fetch_assoc($result)):?> 
          <option value="<?php echo $row['sid']?>"><?php echo $row['sitename'] ?></option>
    <?php endwhile ?>
        </select>
      </div>
      
      <button type="submit" class="btn btn-success flex mb-5" name="enter">Enter</button>
      </form>

      </div>
      <div class="col-lg-6 col-md-8">
        <h3>Add Site</h3>
    <form method="post">
      <div class="form-group">
        <label>Site Name:</label>
        <input type="text" class="form-control" name="sitename" placeholder="" autocomplete="off" required>
      </div>
       
      <button type="submit" class="btn btn-success flex mb-5" name="add">Add</button>
      </form>
        
      </div>
  </div>
</div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>


  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
           $( function() {
      $( ".datepicker" ).datepicker();
    } );
            $('.select2').select2();
 </script>
  </body>
</html>