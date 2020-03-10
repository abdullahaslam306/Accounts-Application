<?php 
include 'connection.php';
if(isset($_POST['submit']))
{
	$query="Insert into Customer Values(0,'".$_POST['name']."','".$_POST['contact']."','".$_POST['email']."','".$_POST['country']."')";
	$con=con_function();
	$r=$con->query($query);
	if($r)
	{
		header("location:customer.php?msg=Added Sucessfully");
}
else{
header("location:customer.php?msg=Error");
}

	}
	
	



 ?>