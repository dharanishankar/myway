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
$check="select * from expense order by eid desc";
$result = mysqli_query($conn,$check);
$count = mysqli_num_rows($result);
$ii=0;
if (isset($_POST["submit"]))
 {
  $date=$_POST['date'];
  $ed=$_POST['expensedesc'];
  $ap=$_POST['addpayment'];
  $ea=$_POST['expenseamount'];
  $stb=$_POST['stillbalance'];
  $datesplit=explode("/", $date);
$datecrt=$datesplit[2]."/".$datesplit[0]."/".$datesplit[1];
     $pname = rand(1000,10000)."-".$_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
$uploads_dir = 'expensebill';
    #TO move the uploaded file to specific location
    if(move_uploaded_file($tname, $uploads_dir.'/'.$pname))
    {
      $sql = "insert into expense(date,expensedesc,addpayment,expenseamount,stillbalance,bill) value('$datecrt','$ed','$ap','$ea','$stb','$pname');";
 
    if(mysqli_query($conn,$sql)){

   echo "<script>
alert('added successfully!!');
window.location.href='expense.php';
</script>";
  
    }
    else{
        echo "<script>
alert('invalid data');
window.location.href='expense.php';
</script>";
    
    }

    }
    else{
       $sql = "insert into expense(date,expensedesc,addpayment,expenseamount,stillbalance) value('$datecrt','$ed','$ap','$ea','$stb');";
 
    if(mysqli_query($conn,$sql)){

   echo "<script>
alert('added successfully!!');
window.location.href='expense.php';
</script>";
  
    }
    else{
        echo "<script>
alert('invalid data');
window.location.href='expense.php';
</script>";
    
    }
}
}

if(isset($_POST['update']))
{
  $id=$_POST['eid'];
  $date=$_POST['ed'];
  $desc=$_POST['eed'];
  $datesplit=explode("/", $date);
$datecrt=$datesplit[2]."/".$datesplit[1]."/".$datesplit[0];
  $sql = "update expense set date='$datecrt',expensedesc='$desc' where eid='$id'";
 
    if(mysqli_query($conn,$sql)){

   echo "<script>
alert('updated successfully!!');
window.location.href='expense.php';
</script>";
  
    }
    else{
        echo "<script>
alert('invalid data');
window.location.href='expense.php';
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
</style>
    <title>Daily Expenese Details</title>
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
        <a class="nav-link active" href="expense.php">Expense</a>
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
        <a class="nav-link" href="image.php">Image</a>
      </li>

      <li>
      <form method="post"><button name="logout" class="btn btn-danger navbar-btn pl-3">Logout</button></form>   
      </li> 
    </ul>
  </div>  
</nav>
<br>

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
        <th>EXPENSE DESCRIPTION</th>
        <th>ADD PAYMENT</th>
        <th>EXPENSE AMOUNT</th>
        <th>STILL BALANCE</th>
        <th>BILL</th>
        <th>Update</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)):?> 

      <tr>
        <form method="post">
          <input type="text" class="form-control" name="eid" value="<?php echo $row['eid']?>" hidden>
        <?php 
        
        $datesplit=explode("-", $row['date']);
        $datecrt=$datesplit[2]."/".$datesplit[1]."/".$datesplit[0];
        $ii++;
        if($ii==1)
        $sb=$row['stillbalance'];
        ?>
        
        <td><?php echo $ii?></td>
        <td><input type="text" class="form-control" name="ed" value="<?php echo $datecrt?>"></td>
        <td><input type="text" class="form-control" name="eed" value="<?php echo $row['expensedesc']?>"></td>
        <td><?php echo $row['addpayment']?></td>
        <td><?php echo $row['expenseamount']?></td>
        <td><?php echo $row['stillbalance']?></td>
        <td><a href="expensebill/<?php echo $row['bill']?>" target="_blank">view</a></td>
        <td><center><button type="submit" name="update"><i class="fa fa-check-square-o" aria-hidden="true"></i></button></center>
        
</td>
</form>
      </tr>
      
    <?php endwhile?>
    <input type="text" name="sb" id="sb" value="<?php echo $sb?>" hidden>
    </tbody>
  </table>
  
   <?php if($count>=5):?>
</div>
<?php endif?>

  </div>
  <input type="button" class="btn btn-success mt-3" value="Print" id="button" name="button">
</div>

<div class="container">
  <form method="post" enctype="multipart/form-data">
    <div class="row">
      
      <div class="col-lg-6 col-md-8">
       
    <div class="form-group">
        <label>Date:</label>
        <input type="text" class="form-control datepicker" placeholder="Choose Date" name="date" autocomplete="off" required>
      </div>
       <div class="form-group">
          <label>Expense Description:</label>
          <input type="text" class="form-control" name="expensedesc" placeholder="" autocomplete="off" required>
        </div>
      <div class="form-group">
        <label>Add Payment:</label>
        <input type="text" class="form-control" value="0" name="addpayment" id="addpayment" placeholder="" autocomplete="off" required>
      </div>
             
      <button type="submit" name="submit" class="btn btn-success flex mb-5">ADD</button>
     
      </div>
      <div class="col-lg-6 col-md-8">
        
    <div class="form-group">
          <label>Expense Amount:</label>
          <input type="text" class="form-control" value="0" name="expenseamount" id="expenseamount" placeholder="" autocomplete="off" required>
        </div>
      <div class="form-group">
        <label>Still Balance:</label>
        <input type="text" class="form-control" name="stillbalance" id="stillbalance" placeholder="" autocomplete="off" required>
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
  <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

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

$('#button').on('click',function(){
printData();
})


    bind() ;
 function bind(){
  $('body').on('keyup change blur','#addpayment',update_price);
  $('body').on('keyup change blur','#expenseamount',update_price);
  }

  function  update_price(){
    var apl = $('#addpayment').val();
    var eal = $('#expenseamount').val();
     var sbl =  Number(apl)-Number(eal);
     var sbg = $('#sb').val();
     if(isNaN(sbg))
     {
      sbg=0;
     }
     $('#stillbalance').val(Number(sbg)+Number(sbl));
  }
} );


 </script>
  </body>
</html>