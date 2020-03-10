<?php //include("header.php"); ?>
<div class="container" >
	<h2>User's Payment</h2>
<form method="post" >
	
	<div class="form-group col-md-6">
    <label for="name">Payment id</label>
    <input type="text" class="form-control" id="upid" name="upid"required readonly >
  </div>
	<div class="form-row">
<div class="form-group col-md-3">
	<label>Payment Date</label>
	<input type="date" id="udate" class="form-control" name="udate">

</div>
<div class="form-group col-md-3">
	<label>Payment Amount</label>
	<input type="number" required id="uamt" class="form-control" name="uamt">
	
</div>
<div class="form-group col-md-4">
	<label>For</label>
	<input type="text" name="ufor" id="ufor" class="form-control">

	
</div>
<div class="form-group col-md-2">
	<label>Status</label>
	<select required name="ustatus" id="ustatus" class="form-control">
		<option value="No">Yes</option>
		<option value="Yes">No</option>
	</select>

	
</div>

</div>

<button type="submit" name="addupayment" class="btn btn-primary">ADD</button>
<button type="submit" name="updateupayment" class="btn btn-success">UPDATE</button>
<button type="button" name="" class="btn btn-success"  onclick="window.location.href = 'userwithdraw.php'">REFRESH</button>

</form>
<br>
<?php 
if(isset($_POST['addupayment']))
{ob_start();
	extract($_POST);
$query="Insert into userWithdraw VALUES(0,$val,'$udate','$uamt',1,'$ufor','sasa','$ustatus')";

$con=con_function();
$cc=$con->query($query);
if($cc)
{
header("location:sales.php?msg=Added Sucessfully");
}
else{
	//header("location:sales.php?msg=Error");
}

ob_end_flush();}
if(isset($_POST['updateupayment']))
{ob_start();
extract($_POST);
$query="Update userwithdraw SET datee='$udate',amount=$uamt,notes='$ufor',transfered='$ustatus' where wid=$upid";
$con=con_function();
$cc=$con->query($query);
if($cc)
{
header("location:sales.php?msg=Edited Sucessfully");
}
else{
	header("location:sales.php?msg=Error");
}

ob_end_flush();
}
if(isset($_GET['id123']))
{ob_start();
$id=0;
$id = $_GET['id123'];

$sql = "DELETE FROM userwithdraw WHERE wid = $id ";
$con=con_function();
$check = $con->query($sql);


if($check){
	header("location:sales.php?msg=deleted successfully");
}else{
	echo $con->error;
}



	ob_end_flush();

}   
 ?>
 <button id="exapmles" class="btn btn-primary btn-sm"><b>-</b></button>
 <div id="abc"><table class="table" id="tab2" >
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Payment Date</th>
      <th scope="col">Payment Amount</th>
      <th scope="col">Description</th>
      <th scope="col">Status</th>
      
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
                              
                                    
                                        
                                            <?php 
                                            ob_start();
                                            $con=con_function();

$s=0;
$sql ="SELECT * FROM userwithdraw where sid=$val  ";
$r=$con->query($sql);
 if($r->num_rows>0)
  {$s=$s+$r->num_rows;
 $projects = array();
 $pn=array();
  $i=0;
    while ($not =  mysqli_fetch_assoc($r))
    {
        $notif[] = $not;
        
    }
   $i=0;
    sort($notif);
  
   
 
 
    foreach ($notif as $notif)
    {
   echo  "<form><tr class='tr-shadow'>";
   echo "<td>".$notif['wid']."</td><td>
                                                ".$notif['datee']."
                                            </td> <td>
                                                ".$notif['amount']."
                                            </td><td class='desc'>".$notif['notes']."</td><td class='desc'>".$notif['transfered']."</td><td>
                                                    <button class='btn btn-danger btn-sm' >
                                                        <a  
                                                        href='userwithdraw.php?id123=$notif[wid]'>
                                                        delete

                                                    </button>
                                                    </td>

                                            
                                            
                                        </tr>
                                        </form>
                                        <tr class='spacer'></tr>
                                        " ;
$i++;}}else{
    echo "No Registered Group Found.";
  
}  ?>

</tbody>

</table>

</div>

<script type="text/javascript">
	$("#exapmles").click(function(){
		
  $("#abc").toggle();
});
	
  var tablee=document.getElementById('tab2'),rIndex;
  console.log(tablee);
  for (var i = 1; i < tablee.rows.length; i++) {
var len=tablee.rows[i].cells.length;
len=len-1;

tablee.rows[i]. ondblclick=function()
{
rIndex=this.rowIndex;
console.log(rIndex);
document.getElementById('upid').value=this.cells[0].innerHTML.trim();
document.getElementById('udate').value=this.cells[1].innerHTML.trim();
document.getElementById('uamt').value=this.cells[2].innerHTML.trim();
document.getElementById('ufor').value=this.cells[3].innerHTML.trim();

document.getElementById('ustatus').value=this.cells[6].innerHTML.trim();



  }}


</script>
<?php //include("footer.php"); ?>