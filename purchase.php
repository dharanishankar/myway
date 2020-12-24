<?php
include 'conn.php';
session_start();
if(!isset($_SESSION['aid'])){
      header("location:index.php");
  }

if(!isset($_SESSION['sid'])){
      header("location:site.php");
  }
  
  if(isset($_POST["logout"]))
{
   session_destroy();
   header("location:index.php");
}
$ii=0;
$id=$_SESSION['sid'];
$check="select * from purchase where sid='$id' order by pid desc;";
$result = mysqli_query($conn,$check);
$count = mysqli_num_rows($result);

if (isset($_POST["submit"]))
 {
  $date=$_POST['date'];
  $supliername=$_POST['supliername'];
  $materialname=$_POST['materialname'];
  $quantity=$_POST['quantity'];
  $qtype=$_POST['qtype'];
  $perrs=$_POST['perrs'];
  $totalamount=$_POST['totalamount'];
  $paidamount=$_POST['paidamount'];
  $balanceamount=$_POST['balanceamount'];
  $datesplit=explode("/", $date);
$datecrt=$datesplit[2]."/".$datesplit[0]."/".$datesplit[1];


$pname = rand(1000,10000)."-".$_FILES["file"]["name"];
    $tname = $_FILES["file"]["tmp_name"];
$uploads_dir = 'purchasebill';
    #TO move the uploaded file to specific location
    if(move_uploaded_file($tname, $uploads_dir.'/'.$pname))
    {
      $sql = "insert into purchase(sid,date,supliername,materialname,qty,qtype,perrs,totalamount,paidamount,balanceamount,bill) value('$id','$datecrt','$supliername','$materialname','$quantity','$qtype','$perrs','$totalamount','$paidamount','$balanceamount','$pname');";
    if(mysqli_query($conn,$sql)){
echo "<script>
alert('added successfully!!');
window.location.href='purchase.php';
</script>";
   
  
    }
    else{
        
   echo "<script>
alert('invalid data');
window.location.href='purchase.php';
</script>";
    }
  }

    else{
      $sql = "insert into purchase(sid,date,supliername,materialname,qty,qtype,perrs,totalamount,paidamount,balanceamount) value('$id','$datecrt','$supliername','$materialname','$quantity','$qtype','$perrs','$totalamount','$paidamount','$balanceamount');";
    if(mysqli_query($conn,$sql)){
echo "<script>
alert('added successfully!!');
window.location.href='purchase.php';
</script>";
   
  
    }
    else{
        
   echo "<script>
alert('invalid data');
window.location.href='purchase.php';
</script>";
    }
    
    }
}

if (isset($_POST["update"]))
 {
  $pid=$_POST['id'];
  $date=$_POST['date'];
  $supliername=$_POST['supliername'];
  $materialname=$_POST['materialname'];
  $quantity=$_POST['quantity'];
  $qtype=$_POST['qtype'];
  $perrs=$_POST['perrs'];
  $totalamount=$_POST['totalamount'];
  $paidamount=$_POST['paidamount'];
  $balanceamount=$_POST['balanceamount'];
  $datesplit=explode("/", $date);
$datecrt=$datesplit[2]."/".$datesplit[1]."/".$datesplit[0];

      $sql = "update purchase set date='$datecrt',supliername='$supliername',materialname='$materialname',qty='$quantity',qtype='$qtype',perrs='$perrs',totalamount='$totalamount',paidamount='$paidamount',balanceamount='$balanceamount' where pid='$pid';";
 
    if(mysqli_query($conn,$sql)){

   echo "<script>
alert('updated successfully!!');
window.location.href='purchase.php';
</script>";
  
    }
    else{
        echo "<script>
alert('invalid data');
window.location.href='purchase.php';
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
   z-index: 100;
   min-width: 150px;
 }
 .mw{
  min-width: 200px;
 }


</style>
    <title>Purchase Details</title>
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
        <a class="nav-link" href="customerpayment.php">Customer Payment</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="labours.php">Labour Contractor</a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="purchase.php">Purchase</a>
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
        <th style="min-width: 50px;">SNO</th>
        <th style="min-width: 150px;">DATE</th>
        <th class="mw">SUPLIER NAME</th>
        <th class="mw">MATERIAL NAME</th>

        <th>PER/RS</th>
        <th style="min-width: 50px">TYPE</th>
        <th style="min-width: 80px;">QTY</th>
        <th>TOTAL AMOUNT</th>
        <th>PAID AMOUNT</th>
       <th>BALANCE AMOUNT</th>
       <th style="min-width: 50px;">BILL</th>
       <th style="min-width: 50px;">UPDATE</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)):?> 

      <tr class="item-row">
        <form method="post">
          <input type="text" name="id" value="<?php echo $row['pid']?>" hidden>
        <?php 
        $ii++;
        $datesplit=explode("-", $row['date']);
        $datecrt=$datesplit[2]."/".$datesplit[1]."/".$datesplit[0];
        ?>

        <td><?php echo $ii;?></td>
        <td><input type="text" class="form-control" name="date" value="<?php echo $datecrt?>"></td>
        <td><input type="text" class="form-control" name="supliername" value="<?php echo $row['supliername']?>"></td>
        <td><input type="text" class="form-control" name="materialname" value="<?php echo $row['materialname']?>"></td>
                <td><input type="text" class="form-control perrs" name="perrs" value="<?php echo $row['perrs']?>"></td>
                 <td><select class="qtype" name="qtype">
                <option value="TON" <?php if($row['qtype']=='TON'){echo "selected";}?>>TON</option><option value="CFT"> <?php if($row['qtype']=='CFT'){echo "selected";}?>CFT</option><option value="M3" <?php if($row['qtype']=='M3'){echo "selected";}?>>M3</option><option value="NOS" <?php if($row['qtype']=="NOS"){echo "selected";}?>>NO'S</option></select></td>
        <td><input type="text" class="form-control quantity" name="quantity" value="<?php echo $row['qty']?>"></td>
        

       
        <td><input type="text" class="form-control totalamount" name="totalamount" value="<?php echo $row['totalamount']?>"></td>
        <td><input type="text" class="form-control paidamount" name="paidamount" value="<?php echo $row['paidamount']?>"></td>
        <td><input type="text" class="form-control balanceamount" name="balanceamount" value="<?php echo $row['balanceamount']?>"></td>
       <td><a href="purchasebill/<?php echo $row['bill']?>" target="_blank">view</a></td>
        <td><center><button type="submit" name="update"><i class="fa fa-check-square-o" aria-hidden="true"></i></button></center>
        
</td>
</form>
      </tr>
      
    <?php endwhile?>
    
    </tbody>
  </table>
  
  
</div>

<input type="button" class="btn btn-success mt-3" value="Print" id="button" name="button">
  </div>
</div>
 <?php endif?>
<div class="container">
  <form method="post" enctype="multipart/form-data">
    <div class="row">
      
      <div class="col-lg-6 col-md-8">
       
    <div class="form-group">
        <label>Date:</label>
        <input type="text" class="form-control datepicker" placeholder="Choose Date" name="date" autocomplete="off" required>
      </div>
      
        
      <div class="row">
        <div class="col">
         <div class="form-group">
          <label>Quantity:</label>
          <input type="text" class="form-control" id="quantity" value="1" name="quantity" placeholder="" autocomplete="off" required>
        </div>
        </div>
        <div class="col">
          <label>Type:</label><br>
         <select name="qtype">
           <option value="TON">TON</option>
           <option value="CFT">CFT</option>
           <option value="M3">M3</option>
           <option value="NOS">NO'S</option>
         </select>
        </div>
      </div>
        <div class="form-group">
          <label>Per/RS:</label>
          <input type="text" class="form-control" id="perrs" name="perrs" placeholder="" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label>Paid Amount:</label>
          <input type="number" class="form-control" id="paidamount" name="paidamount" placeholder="" autocomplete="off" required>
        </div>
        <div class="form-group">
          <label>Upload Bill:</label><div>
           <input type="file" id="file" name="file"></div>
        </div>
      
      <button type="submit" name="submit" class="btn btn-success flex mb-5">ADD</button>
     
      </div>
      
     <div class="col-lg-6 col-md-8 ">
      <div class="form-group">
          <label>Suplier Name:</label>
          <input type="text" class="form-control" name="supliername" placeholder="" autocomplete="off" required>
        </div>
      <div class="form-group">
          <label>Material Name:</label>
          <input type="text" class="form-control" name="materialname" placeholder="" autocomplete="off" required>
        </div>
     
        <div class="form-group">
          <label>Total Amount:</label>
          <input type="text" class="form-control" id="totalamount" name="totalamount" placeholder="" autocomplete="off" required>
        </div>
        
        <div class="form-group">
          <label>Balance Amount:</label>
          <input type="number" class="form-control" id="balanceamount" name="balanceamount" placeholder="" autocomplete="off" required>
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

    bind() ;
 function bind(){
  $('body').on('keyup change blur','#paidamount',update_price);
  $('body').on('keyup change blur','#totalamount',update_price);
  $('body').on('keyup change blur','#quantity',update_price);
  $('body').on('keyup change blur','#perrs',update_price);

  $('body').on('keyup change blur','.paidamount',update_pric);
  $('body').on('keyup change blur','.totalamount',update_pric);
  $('body').on('keyup change blur','.quantity',update_pric);
  $('body').on('keyup change blur','.perrs',update_pric);
 
  }

  function  update_price(){
    var quantity = $('#quantity').val();
    var perrs = $('#perrs').val();
    var paidamount = $('#paidamount').val();
    var totalamount = Number(perrs)*Number(quantity);
    var balanceamount=Number(totalamount)-Number(paidamount);
     $('#totalamount').val(totalamount);
     $('#balanceamount').val(balanceamount);

  }
  function  update_pric(){
    var row =  $(this).parents('.item-row');
     var quantity=  row.find('.quantity').val();
     var perrs =  row.find('.perrs').val();
     var paidamount =  row.find('.paidamount').val();
     var totalamount = Number(perrs)*Number(quantity);
    var balanceamount=Number(totalamount)-Number(paidamount);
     
     row.find('.totalamount').val(totalamount);
     row.find('.balanceamount').val(balanceamount);

  }

$('#button').on('click',function(){
printData();
})
})

 </script>
  </body>
</html>