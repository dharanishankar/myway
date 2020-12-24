<?php
include 'conn.php';
session_start();
if(!isset($_SESSION['aid'])){
      header("location:index.php");
  }
if(!isset($_SESSION['sid'])){
      header("location:site.php");
  }
if(isset($_POST['submit']))
{
  $pass=$_POST['password'];
  if($pass=='')
{
  header("location:dailywork.php");

}
$check="select * from password where pid=1 and password='$pass'";
$result = mysqli_query($conn,$check);
$row = mysqli_fetch_assoc($result);
$count = mysqli_num_rows($result);
if($count==1)
{
  $_SESSION['cpaid'] = 1;
  header("location:customerpayment.php");
}
else
{
  echo "<script>
alert('invalid data');
window.location.href='dailywork.php';
</script>";
}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>ADMIN</title>
	<meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="icon" href="https://i.ibb.co/7yvvvL2/ui-logo.png" type="image/x-icon"> -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
<style>
  body {
    background-color: #dbd7d469;
  }

</style>
</head>

<body>
<nav class="navbar navbar-expand-md navbar-dark" style="background-color: #563d7c;">
   <a class="navbar-brand" href="expense.php">My Way Constructions</a>
</nav>
  <br><br><br>
  <div class="container">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-6 col-md-8 shadow p-4 mb-4 bg-white rounded ">
        <center>
          <h1>ADMIN</h1>
        </center>
    <form method="post">
      <div class="form-group">
        <label>Password:</label>
        <input type="password" class="form-control" name="password" placeholder="Enter password" required autocomplete="off">
      </div>
      <button type="submit" name="submit" class="btn btn-success flex">Enter</button>
      </form>
      </div>
  </div>
</div>

</body>
</html>