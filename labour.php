<?php
include 'conn.php';
session_start();
if(!isset($_SESSION['aid'])){
      header("location:index.php");
  }

if(!isset($_SESSION['sid'])){
      header("location:site.php");
  }
  if(!isset($_SESSION['lsid'])){
      header("location:labours.php");
  }
  if(isset($_POST["logout"]))
{
   session_destroy();
   header("location:index.php");
}
$ii=0;
$id=$_SESSION['sid'];
$lsid=$_SESSION['lsid'];
$check="select * from labour where sid='$id' and lsid='$lsid' order by lid desc;";
$result = mysqli_query($conn,$check);
$count = mysqli_num_rows($result);
$check2="select * from labours where sid='$id' and lsid='$lsid'";
$result2 = mysqli_query($conn,$check2);
$row2 = mysqli_fetch_assoc($result2);
$check3="select sum(amount) as x from labour where lsid='$lsid' and sid='$id'";
$result3 = mysqli_query($conn,$check3);
$row3 = mysqli_fetch_assoc($result3);
if (isset($_POST["submit"]))
 {
  $date=$_POST['date'];
  $description=$_POST['description'];
  $rs1=$_POST['rs1'];
  $rs2=$_POST['rs2'];
  $rs3=$_POST['rs3'];
  $rsc1=$_POST['rsc1'];
  $rsc2=$_POST['rsc2'];
  $rsc3=$_POST['rsc3'];
  $rs4=$_POST['rs4'];
  $reason=$_POST['reason'];
  $amt=$_POST['amount'];
  $datesplit=explode("/", $date);
$datecrt=$datesplit[2]."/".$datesplit[0]."/".$datesplit[1];
      $sql = "insert into labour(sid,lsid,date,description,rs1,rs2,rs3,rs4,rsc1,rsc2,rsc3,amount,reason) value('$id','$lsid','$datecrt','$description','$rs1','$rs2','$rs3','$rs4','$rsc1','$rsc2','$rsc3','$amt','$reason');";
 
    if(mysqli_query($conn,$sql)){

   echo "<script>
alert('added successfully!!');
window.location.href='labour.php';
</script>";
  
    }
    else{
        
   echo "<script>
alert('invalid data');
window.location.href='labour.php';
</script>";
    }
}
if (isset($_POST["update"]))
 {
  $lid=$_POST['id'];
  $date=$_POST['date'];
  $description=$_POST['description'];
  $rs1=$_POST['rs1'];
  $rs2=$_POST['rs2'];
  $rs3=$_POST['rs3'];
  $rs4=$_POST['rs4'];
  $rsc1=$_POST['rsc1'];
  $rsc2=$_POST['rsc2'];
  $rsc3=$_POST['rsc3'];
  $amt=$_POST['amount'];
  $reason=$_POST['reason'];
  $datesplit=explode("/", $date);
$datecrt=$datesplit[2]."/".$datesplit[1]."/".$datesplit[0];
      $sql = "update labour set date='$datecrt',description='$description',rs1='$rs1',rs2='$rs2',rs3='$rs3',rsc1='$rsc1',rsc2='$rsc2',rsc3='$rsc3',amount='$amt',rs4='$rs4',reason='$reason' where lid='$lid'";
 
    if(mysqli_query($conn,$sql)){

   echo "<script>
alert('updated successfully!!');
window.location.href='labour.php';
</script>";
  
    }
    else{
        echo "<script>
alert('invalid data');
window.location.href='labour.php';
</script>";
    
    }
}

if(isset($_POST['updatepayamount']))
{
  $pa=$_POST['payamount'];
  $sql = "update labours set payamount='$pa' where sid='$id' and lsid='$lsid'";
 
    if(mysqli_query($conn,$sql)){

   echo "<script>
alert('successfully updated!!');
window.location.href='labour.php';
</script>";
  
    }
    else{
        
   echo "<script>
alert('invalid data');
window.location.href='labour.php';
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
 }
 pre{
  color: white;
 }
</style>
    <title>Labour Contractor Payment</title>
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
  <center><u><b><h3><?php echo $row2['name']." Labour Contractor"?></h3></b></u></center>
  <form method="post">
<pre>PAY AMOUNT  : <input type="text" value="<?php echo $row2['payamount']?>" name="payamount" id="payamount" placeholder="" autocomplete="off" required>   <button name="updatepayamount" type="submit"><i class="fa fa-check-square-o" aria-hidden="true"></i></button></pre></form><br>
<pre>PAID AMOUNT : <input type="text" value="<?php echo $row3['x']?>" id='pamt' name="paymentamount" placeholder="" autocomplete="off" required><br><br></pre>
<pre>BALANCE PAY : <input type="text" name="paymentbalance" placeholder="" id='bp' autocomplete="off" required><br><br></pre>
</div>
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
        <th style="min-width: 170px;">DATE</th>
        <th style="min-width: 300px;">DESCRIPTION OF WORK</th>
        <th style="min-width: 250px;">1ST RS:850</th>
        <th style="min-width: 250px;">2ND RS:650</th>
        <th style="min-width: 250px;">3RD RS:550</th>
        <th style="min-width: 250px;">EXTRAS</th>
        <th style="min-width: 250px;">AMOUNT</th>
       <th style="min-width: 150px;">UPDATE</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)):?> 

      <tr class="item-row">
        <form method="post">
          <input type="text" name="id" value="<?php echo $row['lid']?>" hidden>
        <?php 
        $ii++;
        $datesplit=explode("-", $row['date']);
        $datecrt=$datesplit[2]."/".$datesplit[1]."/".$datesplit[0];
        ?>

        <td><?php echo $ii;?></td>
        <td><input type="text" class="form-control" name="date" value="<?php echo $datecrt?>"></td>
        <td><input type="text" class="form-control" name="description" value="<?php echo $row['description']?>"></td>
        <td><div class="row"><div class="col"><input type="text" class="form-control rs1" name="rs1" value="<?php echo $row['rs1']?>"></div><div class="col"><input type="text" class="form-control rsc1" name="rsc1" value="<?php echo $row['rsc1']?>"></div></div></td>
        <td><div class="row"><div class="col"><input type="text" class="form-control rs2" name="rs2" value="<?php echo $row['rs2']?>"></div><div class="col"><input type="text" class="form-control rsc2" name="rsc2" value="<?php echo $row['rsc2']?>"></div></div></td>
        <td><div class="row"><div class="col"><input type="text" class="form-control rs3" name="rs3" value="<?php echo $row['rs3']?>"></div><div class="col"><input type="text" class="form-control rsc3" name="rsc3" value="<?php echo $row['rsc3']?>"></div></div></td>
        <td><div class="row"><div class="col"><input type="text" class="form-control rs4" name="rs4" value="<?php echo $row['rs4']?>"></div><div class="col"><input type="text" class="form-control reason" name="reason" value="<?php echo $row['reason']?>"></div></div></td>
        <td><input type="text" class="form-control amt" name="amount" value="<?php echo $row['amount']?>"></td>
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
  <form method="post">
    <div class="row">
      
      <div class="col-lg-6 col-md-8 ">
       
    <div class="form-group">
        <label>Date:</label>
        <input type="text" class="form-control datepicker" placeholder="Choose Date" name="date" autocomplete="off" required>
      </div>
      <div class="row">
        <div class="col">
         <div class="form-group">
          <label>1st RS:</label>
          <input type="text" class="form-control" id="rs1" value="850" name="rs1" placeholder="" autocomplete="off" required>
        </div>
        </div>
        <div class="col">
         <div class="form-group">
          <label>1st Count</label>
          <input type="number" class="form-control" id="rsc1" value="1" name="rsc1" placeholder="" autocomplete="off" required>
        </div>
        </div>
      </div>
       <div class="row">
        <div class="col">
         <div class="form-group">
          <label>3rd RS:</label>
          <input type="text" class="form-control" id="rs3" value="550" name="rs3" placeholder="" autocomplete="off" required>
        </div>
        </div>
        <div class="col">
         <div class="form-group">
          <label>3rd Count:</label>
          <input type="number" class="form-control" id="rsc3" value="1" name="rsc3" placeholder="" autocomplete="off" required>
        </div>
        </div>

      </div>
      <div class="form-group">
          <label>Amount:</label>
          <input type="text" class="form-control" id="amt" name="amount" placeholder="" autocomplete="off" required>
        </div>
      <button type="submit" name="submit" class="btn btn-success flex mb-5">ADD</button>
     
      </div>
      
     <div class="col-lg-6 col-md-8">
      <div class="form-group">
          <label>Description of Work:</label>
          <input type="text" class="form-control" name="description" placeholder="" autocomplete="off" required>
        </div>
      <div class="row">
        <div class="col">
         <div class="form-group">
          <label>2nd RS:</label>
          <input type="text" class="form-control" id="rs2" value="650" name="rs2" placeholder="" autocomplete="off" required>
        </div>
        </div>
        <div class="col">
         <div class="form-group">
          <label>2nd Count:</label>
          <input type="number" class="form-control" id="rsc2" value="1" name="rsc2" placeholder="" autocomplete="off" required>
        </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
         <div class="form-group">
          <label>Extra Amount:</label>
          <input type="text" class="form-control" id="rs4" value="0" name="rs4" placeholder="" autocomplete="off" required>
        </div>
        </div>
        <div class="col">
         <div class="form-group">
          <label>Reason:</label>
          <input type="text" class="form-control" name="reason" placeholder="" autocomplete="off" >
        </div>
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

    bind() ;
 function bind(){
  $('body').on('keyup change blur','#rs1',update_price);
  $('body').on('keyup change blur','#rs2',update_price);
  $('body').on('keyup change blur','#rs3',update_price);
  $('body').on('keyup change blur','#rs4',update_price);
  $('body').on('keyup change blur','#rsc1',update_price);
  $('body').on('keyup change blur','#rsc2',update_price);
  $('body').on('keyup change blur','#rsc3',update_price);
  $('body').on('keyup change blur','#payamount',update);
  $('body').on('keyup change blur','#pamt',update);
  $('body').on('keyup change blur','.rs1',update_pric);
  $('body').on('keyup change blur','.rs2',update_pric);
  $('body').on('keyup change blur','.rs3',update_pric);
  $('body').on('keyup change blur','.rs4',update_pric);
  $('body').on('keyup change blur','.rsc1',update_pric);
  $('body').on('keyup change blur','.rsc2',update_pric);
  $('body').on('keyup change blur','.rsc3',update_pric);
  }
  var payamount=$('#payamount').val();
    var pamt=$('#pamt').val();
    $('#bp').val(Number(payamount)-Number(pamt));
  function update(){
    var payamount=$('#payamount').val();
    var pamt=$('#pamt').val();
    $('#bp').val(Number(payamount)-Number(pamt));
  }

  function  update_price(){
    var rs1 = $('#rs1').val();
    var rs2 = $('#rs2').val();
    var rs3 = $('#rs3').val();
    var rs4 = $('#rs4').val();
    var rsc1 = $('#rsc1').val();
    var rsc2 = $('#rsc2').val();
    var rsc3 = $('#rsc3').val();
   
     $('#amt').val((Number(rs1)*Number(rsc1)+Number(rs2)*Number(rsc2)+Number(rs3)*Number(rsc3))+Number(rs4));
  }
  function  update_pric(){
    var row =  $(this).parents('.item-row');
     var rs1 =  row.find('.rs1').val();
     var rs2 =  row.find('.rs2').val();
     var rs3 =  row.find('.rs3').val();
     var rsc1 =  row.find('.rsc1').val();
     var rsc2 =  row.find('.rsc2').val();
     var rsc3 =  row.find('.rsc3').val();
     var rs4= row.find('.rs4').val();
     row.find('.amt').val((Number(rs1)*Number(rsc1)+Number(rs2)*Number(rsc2)+Number(rs3)*Number(rsc3))+Number(rs4));

  }

$('#button').on('click',function(){
printData();
})
})

 </script>
  </body>
</html>