<?php
session_start();
if ($_SESSION['username'] ){
	
}	
else{
	header("location:Login_v14/?msg=Login First");
}





// $x=10;
// $_p['q']=10;
// if (($_p['q']) && $x==10){
// 	echo "done";
// }else{
// 	echo "not done";
// }


?>


