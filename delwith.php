<?php
//session_start();

include "connection.php";


$con = con_function();
$id=0;
$id = $_GET['id123'];

$sql = "DELETE FROM userwithdraw WHERE wid = $id ";
$check = $con->query($sql);


if($check){
	header("location:sales.php?msg=deleted successfully");
}else{
	echo $con->error;
}

$con->close();

?>
