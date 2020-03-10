<?php include("header.php"); ?>
<div class="container" >
  <div id='12222'>
  <hr>
	<h2>Month Payment</h2>
<form method="post" >
	
	<div class="form-group col-md-6">
    <label for="name">Month Payment id</label>
    <input type="text" class="form-control" id="mpid" name="mpid"required readonly >
  </div>
  <?php 
$query="select * from customer";
$con=con_function();
   $r=$con->query($query);   
?>

	<div class="form-row">
<div class="form-group col-md-3">

	<label for="inputState">Customer</label>
      <select id="cid" name="cid" class="form-control"  required >
        <?php 
        $numrows = mysqli_num_rows($r);
        if($numrows>0)
        {
          while($row = mysqli_fetch_assoc($r) )
          {
          
                
             echo "<option value='".$row['cid']."'>".$row['name']."</option>";
          }

          
        }else{
          echo "<option disabled>No Customer Found</option>";
        
        }
       ?>
      </select>
   

</div>
<div class="form-group col-md-3">
	<label>Month Payments</label>
	<input type="text" required id="mp" class="form-control" name="mp">
	
</div>
<div class="form-group col-md-4">
	<label>For</label>
	<input type="text" name="mpfor" id="mpfor" class="form-control" required>

	
</div>
<div class="form-group col-md-2">
	<label>Notes</label>
	<input type="text" name="mpnote" class="form-control" id="mpnote" required>

	
</div>

</div>

<button type="submit" name="addmp" class="btn btn-primary">ADD</button>
<button type="submit" name="updatemp" class="btn btn-success">UPDATE</button>
<button type="button" name="" class="btn btn-success"  onclick="window.location.href = 'salereport.php'">REFRESH</button>

</form>
</div>
<br>
<?php 
if(isset($_POST['addmp']))
{ob_start();
	extract($_POST);
$query="Insert into mPayments VALUES(0,$cid,'$mp','$mpfor','$mpnote')";
echo "$query";

$con=con_function();
$cc=$con->query($query);
if($cc)
{
header("location:salereport.php?msg=Added Sucessfully");
}
else{
	header("location:salereport.php?msg=Error");
}

ob_end_flush();}
if(isset($_POST['updatemp']))
{ob_start();
extract($_POST);
$query="Update mPayments SET notes='$mpnote',mpfor='$mpfor',mp='$mp',cid=$cid where mpid=$mpid";

$con=con_function();
$cc=$con->query($query);
if($cc)
{
header("location:salereport.php?msg=Edited Sucessfully");
}
else{
	header("location:salereport.php?msg=Error");
}

ob_end_flush();
}
if(isset($_GET['id123']))
{ob_start();
$id=0;
$id = $_GET['id123'];

$sql = "DELETE FROM mPayments WHERE mpid = $id ";
$con=con_function();
$check = $con->query($sql);


if($check){
	header("location:salereport.php?msg=deleted successfully");
}else{
	echo $con->error;
}



	ob_end_flush();

}   
 ?>
 
 <div id="abc"><table class="table" id="tab2" >
  <thead >
    <tr>
      <th scope="col">#</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Month Payments</th>
      <th scope="col">For</th>
      <th scope="col">Notes</th>
      
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
                              
                                    
                                        
                                            <?php 
                                            ob_start();
                                            $con=con_function();

$s=0;
$sql ="Select m.mpid,c.name as 'name',m.mp,m.mpfor,m.notes from mpayments m ,customer c where m.cid=c.cid  ";
$rr=$con->query($sql);
 if($rr->num_rows>0)
  {$s=$s+$rr->num_rows;
 $projects = array();
 $pn=array();
  $i=0;
    while ($noti =  mysqli_fetch_assoc($rr))
    {
        $notife[] = $noti;
        
    }
   $i=0;
    sort($notife);
  
   
 
 
    foreach ($notife as $notifee)
    {
   echo  "<form><tr class='tr-shadow'>";
   echo "<td>".$notifee['mpid']."</td><td>
                                                ".$notifee['name']."
                                            </td> <td>
                                                ".$notifee['mp']."
                                            </td><td class='desc'>".$notifee['mpfor']."</td><td class='desc'>".$notifee['notes']."</td><td>
                                                    <button class='btn btn-danger btn-sm' >
                                                        <a  
                                                        href='monthlypayment.php?id123=$notifee[mpid]'>
                                                        delete

                                                    </button>
                                                    </td>

                                            
                                            
                                        </tr>
                                        </form>
                                        <tr class='spacer'></tr>
                                        " ;
$i++;}}else{
    echo "No Record Found.";
  
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
document.getElementById('mpid').value=this.cells[0].innerHTML.trim();
document.getElementById('cid').value=this.cells[1].innerHTML.trim();
document.getElementById('mp').value=this.cells[2].innerHTML.trim();
document.getElementById('mpfor').value=this.cells[3].innerHTML.trim();

document.getElementById('mpnote').value=this.cells[4].innerHTML.trim();



  }}


</script>
<?php include("footer.php"); ?>