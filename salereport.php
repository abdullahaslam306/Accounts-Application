<?php 	include("header.php"); ?>
<div class="container"><div class="col-md-12">  <?php 
  if(isset($_GET['msg']))
{
  $er=$_GET['msg'];
if("Error"==$er)
{
  echo"<div class='alert alert-danger' role='alert'>";
 echo "<center>".$_GET['msg']."</center>";
echo "</div>
</div>";

}
else{
  echo"<div class='alert alert-primary' role='alert'>";
 echo "<center>".$_GET['msg']."</center>";
echo "</div>
</div>";
}
} 
 ?></div></div>

<h2 style="text-align: center">تقرير البيع</h2>
<br>

<center><button onclick="printer()" id="printerr" class="btn btn-dark btn-md"  > طباعة</button></center>
<br>
<div class="container" id="122">
 <div id="abc"><table class="table" id="tab2" >
  <thead  style="text-align: center;" class="abc">
    <tr>
      <th scope="col">#</th>
      <th scope="col">اسم الزبون</th>
      <th scope="col">القيمة</th>
      <th scope="col">قيمة الأخرى</th>
      <th scope="col">مجموع الدفعات</th>
      <th scope="col">العملاء المتبقية</th>
      <th scope="col">	حساب المستخدم</th>
      <th scope="col">باقي المستخدم</th>
      <th scope="col">سحب المستخدم</th>
      
      
    </tr>
  </thead>
  <tbody style="text-align: center">
                              
                                    
                                        
                                            <?php 
                                            ob_start();
                                            $con=con_function();

$s=0;
$sql ="Select sr.*,sr2.*,sr3.*,sr.sid as 'nsid' from
salerep sr LEFT OUTER JOIN salerep3 sr3 on sr.sid=sr3.sid ,salerep2 sr2  ";
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
    { $color="";
    	if($notif['status']=="Processed")
        {
            $color="yellow";
        }
       elseif ($notif['status']=="Delivered") {

       	   $color="red";
       }
       else{
       	$color="green";

       }
   echo  "<form><tr class='tr-shadow'>";
   echo "<td style='background-color:$color;'>".$notif['nsid']."</td><td>
                                                ".$notif['cname']."
                                            </td> <td>
                                                ".$notif['sprice']."
                                            </td><td class='desc'>".$notif['otherp']."</td><td class='desc'>".$notif['cptotal']."</td>";
                                            $diff=0;
                                            $a=(int)$notif['sprice'];
                                             $b=(int)$notif['cptotal'];

                                            $diff=$a-$b;
                                            if($notif['uwtotal']==NULL)
                                            {
                                            $notif['uwtotal']=0;	
                                            }
    echo "<td class='desc'>".$diff."</td><td class='desc'>".$notif['uname']."</td><td class='desc'>".$notif['uwtotal']."";$uw=0;$aa=0;$bb=0;
    $aa=(int)$notif['sprice'];
    $bb=(int)$notif['uwtotal'];
    $uw=$aa-$bb;

    echo "<td class='desc'>".$uw."</td>


                                            
                                            
                                        </tr>
                                        </form>
                                        <tr class='spacer'></tr>
                                        " ;
$i++;}}else{
    echo "لا توجد مبيعات.";
  
}  ?>

</tbody>

</table>

</div>

<br>


</div>
<?php if($_SESSION['typee']==1 ||($_SESSION['typee']==2 )){ ?>
<div class="container" >
	<hr>
	<h2>شهر الدفع</h2>
  <div id='12222'>
  
<form method="post" >
	
	<div class="form-group col-md-6" hidden>
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

	<label for="inputState">الزبون</label>
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
          echo "<option disabled>لا العملاء Found</option>";
        
        }
       ?>
      </select>
   

</div>
<div class="form-group col-md-3">
	<label>شهر المدفوعات</label>
	<input type="text" required id="mp" class="form-control" name="mp">
	
</div>
<div class="form-group col-md-4">
	<label>بيد</label>
	<input type="text" name="mpfor" id="mpfor" class="form-control" required>

	
</div>
<div class="form-group col-md-2">
	<label>ملاحظات</label>
	<input type="text" name="mpnote" class="form-control" id="mpnote" required>

	
</div>

</div>
<?php if($_SESSION['typee']==1 ||($_SESSION['typee']==2 )){ ?>
<button type="submit" name="addmp" class="btn btn-primary">إضافة</button><?php }if($_SESSION['typee']==1 ){ ?>

<button type="submit" name="updatemp" class="btn btn-success">تعديل</button>
<?php } ?>


<button type="button" name="" class="btn btn-success"  onclick="window.location.href = 'salereport.php'">تحديث</button>

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
 
 <div id="abc"><table class="table" id="tab1" >
  <thead class="abc">
    <tr>
      <th scope="col">#</th>
      <th scope="col">الزبون</th>
      <th scope="col">شهر المدفوعات</th>
      <th scope="col">بيد</th>
      <th scope="col">ملاحظات</th>
      <?php if($_SESSION['typee']==1 ){ ?>
      <th>حذف</th>
    <?php } ?>
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
                                            </td><td class='desc'>".$notifee['mpfor']."</td><td class='desc'>".$notifee['notes']."</td>";if($_SESSION['typee']==1 ){echo "<td>
                                                    <button class='btn btn-danger btn-sm' >
                                                        <a  
                                                        href='monthlypayment.php?id123=$notifee[mpid]'>
                                                        حذف

                                                    </button>
                                                    </td>";}

                                            
                                            
                                      echo " </tr>
                                        </form>
                                        <tr class='spacer'></tr>
                                        " ;
$i++;}}else{
    echo "No Record Found.";
  
}  ?>

</tbody>

</table>

</div>
</div>
<?php } ?>

<script type="text/javascript">
	$("#exapmles").click(function(){
		
  $("#abc").toggle();
});
	
var tablee=document.getElementById('tab1'),rIndex;
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



<script type="text/javascript">
	function printer()
	{ 
		var a=document.getElementById('printerr');
		var b=document.getElementById('12222');
		

		a.style.display='none';
		b.style.display='none';

		window.print();
		a.style.display='block';
		b.style.display='block';

	}

</script>

<?php 	include("footer.php") ?>