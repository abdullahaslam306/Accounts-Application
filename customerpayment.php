<?php include("header.php"); ?>
<div class="container" >
	<h2>User's Withdwal</h2>
<form method="post" id="abc">
	
	<div class="form-group col-md-6">
    <label for="name">Withdraw id</label>
    <input type="text" class="form-control" id="cpid" name="cpid"required readonly >
  </div>
	<div class="form-row">
<div class="form-group col-md-4">
	<label>Payment Date</label>
	<input type="date" id="pdate" class="form-control" name="pdate">

</div>
<div class="form-group col-md-4">
	<label>Payment Amount</label>
	<input type="number" required id="pamt" class="form-control" name="pamt">
	
</div>
<div class="form-group col-md-4">
	<label>Payment Method</label>
	<select name="pmethod" class="form-control" id="pmethod" required>
		<option value="check">Check</option>
		<option value="cash">Cash</option>

	</select>
</div>
</div>
<div class="form-row">
<div class="form-group col-md-4">
	<label>User</label>
	<select class="form-control" name="user" id="puser" required>
		<?php $query="Select name,cid from customer";
		$con=con_function();
		$results=$con->query($query);
		 
        $numrows = mysqli_num_rows($results);
        if($numrows>0)
        {
          while($row = mysqli_fetch_assoc($results) )
          {
          
                
             echo "<option value='".$row['cid']."'>".$row['name']."</option>";
          }

          
        }else{
          echo "<option disabled>No Customer Found</option>";
        
       } ?>
		<option value=""></option>
	</select>

</div>
<div class="form-group col-md-4">
	<label>Notes</label>
	<input type="text" max="100" class="form-control" id="pnotes" required name="notes">
	
</div>
<div class="form-group col-md-4">
	<label>Complete</label>
	<select class="form-control" name="complete" id="pcomplete" required>
		<option value="Yes">Yes</option>
		<option value="No">No</option>
	</select>
</div>
</div>
<button type="submit" name="addpayment" class="btn btn-primary">ADD</button>
<button type="submit" name="updatepayment" class="btn btn-success">UPDATE</button>
<button type="button" name="" class="btn btn-success"  onclick="window.location.href = 'customerpayment.php'">REFRESH</button>

</form>
<br>
<?php 
if(isset($_POST['addpayment']))
{ob_start();
	extract($_POST);
$query="Insert into customerpayment VALUES(0,7,'$pdate','$pamt','$pmethod','$notes','$user','$complete')";

$cc=$con->query($query);
if($cc)
{
header("location:customerpayment.php?msg=Added Sucessfully");
}
else{
	header("location:customerpayment.php?msg=Error");
}

ob_end_flush();}
if(isset($_POST['updatepayment']))
{ob_start();
extract($_POST);
$query="Update customerpayment SET method='$pmethod',date='$pdate',amount=$pamt,notes='notes',resource='$user',complete='$complete' where cpid=$cpid";

$cc=$con->query($query);
if($cc)
{
header("location:customerpayment.php?msg=Edited Sucessfully");
}
else{
	header("location:customerpayment.php?msg=Error");
}

ob_end_flush();
}
if(isset($_GET['id123']))
{ob_start();
$id=0;
$id = $_GET['id123'];

$sql = "DELETE FROM customerpayment WHERE customerpayment.cpid = $id ";
$check = $con->query($sql);


if($check){
	header("location:customerpayment.php?msg=deleted successfully");
}else{
	echo $con->error;
}



	ob_end_flush();

}
 ?><table class="table" id="tab1" >
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Payment Date</th>
      <th scope="col">Payment Amount</th>
      <th scope="col">Method</th>
      <th scope="col">User</th>
      <th scope="col">Notes</th>
      <th scope="col">Status</th>
      
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
                              
                                    <tbody>
                                        
                                            <?php 
                                            ob_start();
                                            $con=con_function();

$s=0;
$sql ="SELECT * FROM customerpayment  ";
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
   echo "<td>".$notif['cpid']."</td><td>
                                                ".$notif['date']."
                                            </td> <td>
                                                ".$notif['amount']."
                                            </td><td class='desc'>".$notif['method']."</td><td class='desc'>".$notif['resource']."</td><td class='desc'>".$notif['notes']."</td><td class='desc'>".$notif['complete']."</td><td>
                                                    <button class='btn btn-danger btn-sm' >
                                                        <a  
                                                        href='customerpayment.php?id123=$notif[cpid]'>
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


<button id="exapmles">Click me !</button>
</div>

<script type="text/javascript">
	$("#exapmles").click(function(){
		
  $("#abc").toggle();
});
	
  var table=document.getElementById('tab1'),rIndex;
  console.log(table);
  for (var i = 1; i < table.rows.length; i++) {
var len=table.rows[i].cells.length;
len=len-1;

table.rows[i]. ondblclick=function()
{
rIndex=this.rowIndex;
console.log(rIndex);
document.getElementById('cpid').value=this.cells[0].innerHTML.trim();
document.getElementById('pdate').value=this.cells[1].innerHTML.trim();
document.getElementById('pamt').value=this.cells[2].innerHTML.trim();
document.getElementById('pmethod').value=this.cells[3].innerHTML.trim();
document.getElementById('puser').value=this.cells[4].innerHTML.trim();
document.getElementById('pnotes').value=this.cells[5].innerHTML.trim();
document.getElementById('pcomplete').value=this.cells[6].innerHTML.trim();



  }}


</script>
<?php include("footer.php"); ?>