<?php
include 'conn.php';
session_start();
if(!isset($_SESSION['aid'])){
      header("location:index.php");
  }

if(!isset($_SESSION['sid'])){
      header("location:site.php");
  }
  if(!isset($_SESSION['cpaid']))
  {
    header("location:customerpaymentadmin.php");
  }
  if(isset($_POST["logout"]))
{
   session_destroy();
   header("location:index.php");
}

$ii=0;
$id=$_SESSION['sid'];
$check="select * from customerpayment where sid='$id' order by date desc";
$result = mysqli_query($conn,$check);
$count = mysqli_num_rows($result);
$check2="select * from site where sid='$id'";
$result2 = mysqli_query($conn,$check2);
$row2 = mysqli_fetch_assoc($result2);
$check3="select sum(payamount) as x from customerpayment where sid='$id'";
$result3 = mysqli_query($conn,$check3);
$row3 = mysqli_fetch_assoc($result3);
if (isset($_POST["submit"]))
 {
  $date=$_POST['date'];
  $pt=$_POST['paymenttype'];
  $pa=$_POST['payamount'];
  $datesplit=explode("/", $date);
$datecrt=$datesplit[2]."/".$datesplit[0]."/".$datesplit[1];
 
    $pname = rand(1000,10000)."-".$_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
$uploads_dir = 'customerpayment';
    #TO move the uploaded file to specific location
    if(move_uploaded_file($tname, $uploads_dir.'/'.$pname))
    {
      $sql = "insert into customerpayment(sid,date,paymenttype,payamount,bill) value('$id','$datecrt','$pt','$pa','$pname');";
 
    if(mysqli_query($conn,$sql)){

   echo "<script>
alert('added successfully!!');
window.location.href='customerpayment.php';
</script>";
  
    }
    else{
        echo "<script>
alert('invalid data');
window.location.href='customerpayment.php';
</script>";
    
    }

    }
    else{
        $sql = "insert into customerpayment(sid,date,paymenttype,payamount) value('$id','$datecrt','$pt','$pa');";
 
    if(mysqli_query($conn,$sql)){

   echo "<script>
alert('added successfully!!');
window.location.href='customerpayment.php';
</script>";
  
    }
    else{
        echo "<script>
alert('invalid data');
window.location.href='customerpayment.php';
</script>";
    
    }
    
    }
}
if(isset($_POST['updateprojcast']))
{
  $pc=$_POST['projectcast'];
  $sql = "update site set projectcast='$pc' where sid='$id'";
 
    if(mysqli_query($conn,$sql)){

   echo "<script>
alert('successfully updated!!');
window.location.href='customerpayment.php';
</script>";
  
    }
    else{
        
   echo "<script>
alert('invalid data');
window.location.href='customerpayment.php';
</script>";
    }
  
}
if (isset($_POST["update"]))
 {
  $cpid=$_POST['id'];
  $date=$_POST['date'];
  $paymenttype=$_POST['paymenttype'];
  $payamount=$_POST['payamount'];
  $datesplit=explode("/", $date);
$datecrt=$datesplit[2]."/".$datesplit[1]."/".$datesplit[0];
      $sql = "update customerpayment set date='$datecrt',paymenttype='$paymenttype',payamount='$payamount' where cpid='$cpid'";
 
    if(mysqli_query($conn,$sql)){

   echo "<script>
alert('updated successfully!!');
window.location.href='customerpayment.php';
</script>";
  
    }
    else{
        echo "<script>
alert('invalid data');
window.location.href='customerpayment.php';
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
 }
 pre{
  color: white;
 }

</style>
    <title>Customer Payment</title>
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
        <a class="nav-link" href="dailywork.php">Daily Work</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="Customerpayment.php">Customer Payment</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="labours.php">Labour Contractor</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="purchase.php">Purchase</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="doc.php">Documents</a>
      </li>
      <li>
      <form method="post"><button name="logout" class="btn btn-danger navbar-btn pl-3">Logout</button></form>   
      </li> 
    </ul>
  </div>  
</nav>
<br>
<div class="container">
  <form method="post">
<pre>PROJECT CAST         : <input type="text" value="<?php echo $row2['projectcast']?>" name="projectcast" id="pc" placeholder="" autocomplete="off" required>   <button name="updateprojcast" type="submit"><i class="fa fa-check-square-o" aria-hidden="true"></i></button></pre></form><br>
<pre>TOTAL PAYMENT AMOUNT : <input type="text" value="<?php echo $row3['x']?>" id='tpa' name="paymentamount" placeholder="" autocomplete="off" required><br><br></pre>
<pre>PAYMENT BALANCE      : <input type="text" name="paymentbalance" placeholder="" id='pb' autocomplete="off" required><br><br></pre>
</div>
    <div class="container mb-5">
    <div class="row">
      <?php if($count>=5):?>
      <div style="height: 60vh;overflow: scroll;">
      <?php endif?>
      <table class="table table-hover table-bordered" border="1" id="example">
    <thead>
      <tr>
        <th>SNO</th>
        <th>DATE</th>
        <th>PAYMENT TYPE</th>
        <th>PAY AMOUNT</th>
        <th>BILL</th>
        <th>UPDATE</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)):?> 
        
      <tr>
        <form method="post">
          <input type="text" name="id" value="<?php echo $row['cpid']?>" hidden>
        <?php 
        $ii++;
        $datesplit=explode("-", $row['date']);
        $datecrt=$datesplit[2]."/".$datesplit[1]."/".$datesplit[0];
        ?>
        <td><?php echo $ii?></td>
        <td><input type="text" class="form-control" name="date" value="<?php echo $datecrt?>"></td>
        <td><input type="text" class="form-control" name="paymenttype" value="<?php echo $row['paymenttype']?>"></td>
        <td><input type="text" class="form-control" name="payamount" value="<?php echo $row['payamount']?>"></td>
        <td><a href="customerpayment/<?php echo $row['bill']?>" target="_blank">view</a></td>
        <td><center><button type="submit" name="update"><i class="fa fa-check-square-o" aria-hidden="true"></i></button></center>
        
</td>
</form>
      </tr>
      
    <?php endwhile?>
    
    </tbody>
  </table>
  
   <?php if($count>5):?>
</div>
<?php endif?>

  </div>
  <input type="button" class="btn btn-success mt-3" value="Print" id="button" name="button">
</div>

<div class="container">
  <form method="post"  enctype="multipart/form-data">
    <div class="row">
      
      <div class="col-lg-6 col-md-8">
       
    <div class="form-group">
        <label>Date:</label>
        <input type="text" class="form-control datepicker" placeholder="Choose Date" name="date" autocomplete="off" required>
      </div>
       <div class="form-group">
          <label>Payment Type:</label>
          <input type="text" class="form-control" name="paymenttype" placeholder="" autocomplete="off" required>
        </div>
      <button type="submit" name="submit" class="btn btn-success flex mb-5">ADD</button>

      </div>
       <div class="col-lg-6 col-md-8 ">
         <div class="form-group">
          <label>Pay Amount:</label>
          <input type="text" class="form-control" name="payamount" placeholder="" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label>Upload Bill:</label><div>
           <input type="file" id="file" name="file"></div>
        </div>

      </div>
     
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
  

  <script>
           $( function() {
      $( ".datepicker" ).datepicker();
    } );

           $(document).ready(function() {
   function printData()
{
   var divToPrint=document.getElementById("example");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}
var pc1 = $('#pc').val();
    var tpa1 = $('#tpa').val();
     var pb1 =  Number(pc1)-Number(tpa1);
     $('#pb').val(pb1);
 bind() ;
 function bind(){
  $('body').on('keyup change blur','#pc',update_price);
  }

  function  update_price(){
    var pc = $('#pc').val();
    var tpa = $('#tpa').val();
     var pb =  Number(pc)-Number(tpa);
     $('#pb').val(pb);
  }



$('#button').on('click',function(){
printData();
})
})

 </script>
  </body>
</html>