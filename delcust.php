<?php
//session_start();

include "connection.php";


$con = con_function();
$id=0;
$id = $_GET['id123'];

$sql = "DELETE FROM customer WHERE customer.cid = $id ";
$check = $con->query($sql);


if($check){
	header("location:customer.php?msg=deleted successfully");
}else{
	echo $con->error;
}

$con->close();

?>
