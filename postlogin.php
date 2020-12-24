<?php
include 'conn.php';
session_start();
$uname=$_POST['username'];
$pass=$_POST['password'];
if($uname=='' || $pass=='')
{
	header("location:index.php");

}
$check="select * from admin where username='$uname' and password='$pass'";
$result = mysqli_query($conn,$check);
$row = mysqli_fetch_assoc($result);
$count = mysqli_num_rows($result);
if($count==1)
{
	$_SESSION['aid'] = $row['aid'];
	header("location:expense.php");
}
else
{
	echo "<script>
alert('invalid data');
window.location.href='index.php';
</script>";
}
?>