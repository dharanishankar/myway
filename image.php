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
$ii=0;
$check="select * from image";
$result = mysqli_query($conn,$check);
$count = mysqli_num_rows($result);

if(isset($_POST['delete']))
{
  $iid=$_POST['id'];
  $check1="select * from image where iid='$iid';";
$result1 = mysqli_query($conn,$check1);
$ro = mysqli_fetch_assoc($result1);
if(unlink('img/'.$ro['file']))
{
  $check2="delete from image where iid='$iid';";
  if(mysqli_query($conn,$check2))
  {
    echo "<script>
alert('deleted successfully!!');
window.location.href='image.php';
</script>";
   
  }
  else
  {
      echo "<script>
alert('Invalid!!');
window.location.href='image.php';
</script>";
   
  }
}
}

if (isset($_POST["submit"]))
 {
  $name=$_POST['name'];

$pname = rand(1000,10000)."-".$_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
$uploads_dir = 'img';
    #TO move the uploaded file to specific location
    if(move_uploaded_file($tname, $uploads_dir.'/'.$pname))
    {
      $sql = "insert into image(name,file) value('$name','$pname');";
    if(mysqli_query($conn,$sql)){
echo "<script>
alert('added successfully!!');
window.location.href='image.php';
</script>";
   
  
    }
    else{
        
   echo "<script>
alert('invalid data');
window.location.href='image.php';
</script>";
    }
  }

    else{
       echo "<script>
alert('invalid data');
window.location.href='image.php';
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
<style type="text/css">
   body{
    background-color: #000000;
    color: white;
  }
   table thead tr th {
   text-align: left;
   position: sticky;
   top: 0px;
   background-color: #666;
   color: #fff;
   z-index: 1;
 }


</style>
    <title>Image</title>
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
        <a class="nav-link" href="site.php">Site</a>
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
        <a class="nav-link active" href="image.php">Image</a>
      </li>
      <li>
      <form method="post"><button name="logout" class="btn btn-danger navbar-btn pl-3">Logout</button></form>   
      </li> 
    </ul>
  </div>  
</nav>
<br>
<?php if($count>0):?>
    <div class="container mb-5">
    <div class="row">
      <?php if($count>5):?>
      <div style="height: 60vh;overflow: scroll;">
      <?php endif?>
      <?php if($count<=5 && $count>0):?>
      <div style="overflow: scroll;">
      <?php endif?>
      <table class="table table-hover table-bordered" border="1" id="example">
    <thead>
      <tr class="item-row">
        <th>SNO</th>
        <th style="min-width: 200px;">NAME</th>
       <th>IMAGE</th>
       <th>DELETE</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)):?> 
       
      <tr class="item-row">
        <form method="post">
          <input type="text" name="id" value="<?php echo $row['iid']?>" hidden>
        <?php 
        $ii++;
        ?>

        <td><?php echo $ii;?></td>
        
        <td><?php echo $row['name']?></td>
       <td><a href="img/<?php echo $row['file']?>" target="_blank">view</a></td>
        <td><center><button type="submit" name="delete"><i class="fa fa-trash" aria-hidden="true"></i></button></center>
        
</td>
</form>
      </tr>
      
    <?php endwhile?>
    
    </tbody>
  </table>
  
  
</div>
  </div>
</div>
<?php endif?>


<div class="container">
  <form method="post" enctype="multipart/form-data">
    <div class="row">
      
      <div class="col-lg-6 col-md-8">
        
        <div class="form-group">
          <label>DOCUMENT NAME:</label>
          <input type="text" class="form-control" name="name" placeholder="" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label>Upload Document:</label><div>
           <input type="file" id="file" name="file"></div>
        </div>
      
      <button type="submit" name="submit" class="btn btn-success flex mb-5">ADD</button>
     
      </div>
    
      
     </div>
  
   </form>
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>

  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  </body>
</html>