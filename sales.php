<?php include('header.php');
ob_start();
$note="";
$sdate="";
$ddate="";
$price=0;
$statement=""; 
$nam="";
$cd="";
$mamt="";
//error_reporting(0);
$query="select user.portion from user where uid=1";
 $con=con_function();

   $r=$con->query($query);
   $myr=$r->fetch_assoc();
?>
<label id="myhid" hidden><?php echo"$myr[portion]" ?></label>


<div class="container" dir="rtl">
  <div class="row">
  
  <div class="col-md-8">	<?php 
	if(isset($_GET['msg']))
{
	$er=$_GET['msg'];
if("Error"==$er)
{
	echo"<div class='alert alert-danger' role='alert'>";
 echo "<center>".$_GET['msg']."</center>";
echo "</div>";

}
else{
	echo"<div class='alert alert-primary' role='alert'>";
 echo "<center>".$_GET['msg']."</center>";
echo "</div>";
}
} 
if($_SESSION['typee']==1||$_SESSION['typee']==2){
?>
	<h2 >دليل المبيعات</h2>


	<form method="get" action="" >
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Sale Id</label>
      <?php $query="SELECT AUTO_INCREMENT as 'count'
     FROM information_schema.TABLES
    WHERE TABLE_SCHEMA = 'account'
    AND TABLE_NAME = 'sale'";
   $con=con_function();
   $r=$con->query($query);
   
    $row = $r->fetch_assoc();
 $current=$row['count'];

     ?>
     <?php 
if(isset($_GET['id']))
{  
	$val=$_GET['id'];
	if($val<$row['count'])
	{
		$query="select s.notes,s.sdate,s.ddate,s.price,s.statement,c.name,s.cid,s.mamt from sale s,customer c where sid=$val and c.cid=(select cid from sale where sid =$val)";
 $con=con_function();

   $r=$con->query($query);
     $numrows = mysqli_num_rows($r);

    if($numrows>0)
   {
     $row2 = $r->fetch_assoc();
     $note=$row2['notes'];
     $statement=$row2['statement'];
      $price=$row2['price'];
       $sdate=$row2['sdate'];
        $ddate=$row2['ddate'];
     $row['count']=$val;
     $nam=$row2['name'];
     $cd=$row2['cid'];
     $mamt=$row2['mamt'];
     
   }
   else{
   	echo "Not Found";
   }
	}
else{
	echo "invalid value";
}


}
 ?>
      <input type="number" required value="<?php echo $row['count']; $v=$row['count'] ?>" class="form-control" name="id" >
    </div>
    <div class="form-group col-md-6">
    	<label style="color:white">.</label><br>
   <input type="submit" required class="btn btn-outline-secondary " style="width: 100%" value="Search" name="search" >
      
    </div>
    
  </div>
</form>
<?php } if($_SESSION['typee']==1||$_SESSION['typee']==2){ ?>
<form method="post" action=""><div class="form-row">
  	<div class="form-group col-md-6">
      <label for="date">تاريخ البيع</label>
      <input type="Date" required  dir="rtl" class="form-control" value="<?php echo $sdate ?>" name="sdate" id="sdate" o  >
    </div>
    <div class="form-group col-md-6">
      <label for="deldate">	تاريخ التسليم</label>
    <input type="date" required id="ddate"  class="form-control" name="ddate" value="<?php echo $ddate ?>" >
    </div>
    
  </div>
  
  <div class="form-row">
<?php 
$query="select * from customer";
$con=con_function();
   $r=$con->query($query);
   
   
?>
<input type="hidden" name="myid" value="<?php echo $v; ?>">
<div class="form-group col-md-6">
      <label for="inputState">الزبون</label>
      <select id="inputState" class="form-control"  required name="cust">
        <?php 
        $numrows = mysqli_num_rows($r);
        if($numrows>0)
        {
          while($row = mysqli_fetch_assoc($r) )
          {
          
                
             echo "<option value='".$row['cid']."'>".$row['name']."</option>";
          }

          
        }else{
          echo "<option disabled>لم يتم العثور على العملاء</option>";
        
        }
        echo "<option value='".$cd."'"; 
        if($cd!=""){
          echo "Selected >".$nam."</option>";
        }
        else{
          echo ">".$nam."</option>";
        } ?>
      </select>
    </div>

    <div class="form-group col-md-6">
      <label for="price">السعر</label>
      <input type="number" onchange="fun()" required class="form-control" value="<?php echo $price ?>"   name="price" id="pric">
    </div>
      </div>
      
    
   <div class="form-row">


<div class="form-group col-md-6">
      <label for="status">الحالة</label>
      <select id="status" class="form-control"  required name="sstatement">
        <option value="قيد الإنجاز"> قيد الإنجاز</option>
        <option value="تم التوصيل"> تم التوصيل</option>
        <option value="منتهية">منتهية</option>

        <option value='"<?php echo $statement ;?>"' <?php if($statement!=""){
          echo "Selected";
        } ?> >
        <?php echo $statement ;?>
          
        </option>
      </select>
    </div>

    <div class="form-group col-md-6">
      <label for="price">قيمة الآلات الأخرى</label>
      <input type="number" required class="form-control" oninput="fun()" onfocusout="fun();"  onchange="fun()" value="<?php echo $mamt ;?>" name="mamt" id="mamt">
    </div>
      </div>
      
    
    

  <div class="form-row">
  <div class="form-group col-md-12">
    <label for="notes" >ملاحظات</label>
    <input type="text" required class="form-control" id="notees" value="<?php echo $note ?>"  name="notes" >
  </div>
  </div>
  <button type="button" name="" class="btn btn-Link"  onclick="window.location.href = 'sales.php?id=<?php echo $v+1 ?>'">التالي</button>

  <button type="button" onclick="abcde();" class="btn btn-primary">clear</button>
  <?php if($_SESSION['typee']==1){ ?>
  <button type="submit" name="updatesale" class="btn btn-success">تعديل</button>
  <button type="submit" name="delsale" class="btn btn-danger">حذف</button>
<?php } ?>
  <button type="button" name="" class="btn btn-success"  onclick="window.location.href = 'sales.php'">تحديث</button>
   <button type="button" name="" class="btn btn-Link"  onclick="window.location.href = 'sales.php?id=<?php echo $v-1 ?>'">السابق</button>
</form>

<?php 
}

if(isset($_POST['updatesale']))
{ if($current>$_POST['myid'])
  {
	ob_start();
	$query="Update sale set ddate='".$_POST['ddate']."',sdate='".$_POST['sdate']."',price=".$_POST['price'].",cid=".$_POST['cust'].",notes='".$_POST['notes']."',statement='".$_POST['sstatement']."',mamt='".$_POST['mamt']."' where sid= ".$v." ";
$con=con_function(); 
echo "$query";
	$r=$con->query($query);
	if($r)
	{
		header("location:../account app/sales.php?msg='Updated Sucessfully'");
}
else{
header("location:sales.php?msg=Error");
}
ob_end_flush();
}

elseif ($current==$v) {

ob_start();
$query="Insert into sale values(0,'".$_POST['sdate']."','".$_POST['ddate']."',".$_POST['cust'].",".$_POST['price'].",'".$_POST['notes']."','".$_POST['statement']."','".$_POST['mamt']."')";

$con=con_function();
	$re=$con->query($query);
	if($re)
	{
		header("location:sales.php?msg=Added Sucessfully");
}
else{
header("location:sales.php?msg=Error");
}
ob_end_flush();
}

} 

if(isset($_POST['delsale']))
{
$query="DELETE FROM sale WHERE sale.sid =".$v." ";
$con=con_function();
	$r=$con->query($query);
	if($r)
	{
		header("location:sales.php?msg=Deleted Sucessfully");
}
else{
header("location:sales.php?msg=Error");
}
}

 ?>
<script type="text/javascript">
  function abcde()
  { alert("sada");
    initDate();
  document.getElementById("inputState").innerHTML="";
   document.getElementById("pric").value=0;
    var s=document.getElementById("status").value"1";
alert(s);
     document.getElementById("notees").value="";
     document.getElementById("mamt").value=0;
     
  }
</script>

</div>
<div class="col-md-4"> <form>
   <h2>العمليات الحسابية</h2>
   <br>
   <label>العمليات الحسابية</label>
  <input type="number" class="form-control" id="roddue" name="roddue" readonly value="0">

  <div class="form-row">
     <label for="deldate">مجموع دفعات الزبون</label>
  <input type="number" class="form-control" name="custtot" value="0" readonly id="custtot">
  </div>
  <div class="form-row">
     <label for="deldate">مجموع دفعات الزبون</label>
  <input type="number" class="form-control" name="custdue" value="0" readonly id="custdue">
</div>
<div class="form-row">
   <label for="deldate">	سحب الشريك</label>
  <input type="number" class="form-control" name="uwith" value="0" readonly id="userwith">
</div>
<div class="form-row">
   <label for="deldate">باقي الشريك</label>
  <input type="number" class="form-control" name="uremain" readonly value="0" id="uremain">
</div>

</form></div>
</div>

</div>

<div class="container" >
  <h2>دفع العملاء</h2>
<form method="post" >
  
  <div class="form-group col-md-6" hidden>
    <label for="name">Payment Id</label>
    <input type="text" class="form-control" id="cpid" name="cpid"required readonly >
  </div>
  <div class="form-row">
<div class="form-group col-md-4">
  <label for="date">موعد الدفع</label>
  <input type="date" id="pdate" class="form-control" name="pdate">

</div>
<div class="form-group col-md-4">
  <label>قيمة الدفعة</label>
  <input type="number" required id="pamt" class="form-control" name="pamt">
  
</div>
<div class="form-group col-md-4">
  <label>	طريقة الدفع</label>
  <select name="pmethod" class="form-control" id="pmethod" required>
    <option value="شيك">شيك</option>
    <option value="نقد">نقد</option>

  </select>
</div>
</div>
<div class="form-row">
<div class="form-group col-md-4">
  <label>المصدر</label>
  <input type="text" name="user" class="form-control" id="puser" required>
</div>
<div class="form-group col-md-4">
  <label>ملاحظات</label>
  <input type="text" max="100" class="form-control" id="pnotes" required name="notes">
  
</div>
<div class="form-group col-md-4">
  <label>ملاحظات</label>
  <select class="form-control" name="complete" id="pcomplete" required>
    <option value="نعم">نعم</option>
    <option value="لا">لا</option>
  </select>
</div>
</div>
<button type="submit" name="addpayment" class="btn btn-primary">	إضافة</button>
<?php if($_SESSION['typee']==1){ ?>
<button type="submit" name="updatepayment" class="btn btn-success">تعديل</button>
<?php } ?>
<button type="button" name="" class="btn btn-success"  onclick="window.location.href = 'customerpayment.php'">تحديث</button>

</form>
<br>
<?php 
if(isset($_POST['addpayment']))
{ob_start();
  extract($_POST);
$query="Insert into customerpayment VALUES(0,". $v.",'$pdate','$pamt','$pmethod','$notes','$user','$complete')";
echo "$query";
$cc=$con->query($query);
if($cc)
{
header("location:sales.php?msg=Added Sucessfully");
}
else{
  header("location:sales.php?msg=Error Sale Not Exist");
}

ob_end_flush();}
if(isset($_POST['updatepayment']))
{ob_start();
extract($_POST);
$query="Update customerpayment SET method='$pmethod',date='$pdate',amount=$pamt,notes='notes',resource='$user',complete='$complete' where cpid=$cpid";

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
if(isset($_GET['id1235']))
{ob_start();
$id=0;
$id = $_GET['id1235'];

$sql = "DELETE FROM customerpayment WHERE customerpayment.cpid = $id ";
$check = $con->query($sql);


if($check){
  header("location:sales.php?msg=deleted successfully");
}else{
  echo $con->error;
}



  ob_end_flush();

}
 ?>
 <button id="exapmles1" class="btn btn-primary btn-sm"><b>-</b></button>
 <div id="abc1"><table class="table" id="tab1"  >
  <thead class="abc">
    <tr>
      <th scope="col">#</th>
      <th scope="col">تاريخ الدفع</th>
      <th scope="col"> قيمة الدفعة</th>
      <th scope="col">
طريقة الدفع</th>
      <th scope="col">المصدر</th>
      <th scope="col">ملاحظات</th>
      <th scope="col">اكتملت</th>
      <?php if( $_SESSION['typee']==1)
      { ?>
      <th>حذف</th>
    <?php } ?></tr>
  </thead>
  <tbody>
                              
                                   
                                        
                                            <?php 
                                            $sum=0;
                                            ob_start();
                                            $con=con_function();

$s=0;
$sql ="SELECT * FROM customerpayment where sid=". $v."  ";
//echo "$sql";
$r=$con->query($sql);
 $rr=mysqli_num_rows($r);
 if($rr>0)
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
                                            </td><td class='desc'>".$notif['method']."</td><td class='desc'>".$notif['resource']."</td><td class='desc'>".$notif['notes']."</td><td class='desc'>".$notif['complete']."</td>";if($_SESSION['typee']==1){echo "<td>
                                                    <button class='btn btn-danger btn-sm' >
                                                        <a  
                                                        href='customerpaymentdel.php?id1235=$notif[cpid]'>
                                                        delete

                                                    </button>
                                                    </td>";}echo"

                                            
                                            
                                        </tr>

                                        </form>
                                        <tr class='spacer'></tr>
                                        " ;
                                        $sum+=$notif['amount'];
$i++;}}else{
    echo " لم يتم العثور على الدفعة المسجلة.";
  
}  ?>
<tr><td>مجموع الدفعات</td><td></td><td id="sum"><?php echo "$sum"; ?></td></tr>
  </tbody>
                                </table>
  
</div>


</div>




<script type="text/javascript">
  


  $("#exapmles").click(function(){
    
  $("#abc").toggle();
});
  $("#exapmles1").click(function(){
    
  $("#abc1").toggle();
});
  
  var table=document.getElementById('tab1'),rIndex;
  console.log(table);
  for (var i = 1; i < table.rows.length; i++) {
var len=table.rows[i].cells.length;
len=len-1;

table.rows[i]. ondblclick=function()
{
  fun();
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







<script type="text/javascript">
function fun()
{
  var mach=document.getElementById("mamt");
  var p=document.getElementById("pric");
  var fin=document.getElementById("roddue");
   var total_cus =document.getElementById("sum").innerHTML.trim();
    document.getElementById("custtot").value=total_cus;
   var price= document.getElementById("pric");
   var myval=parseInt(total_cus);
   document.getElementById("custdue").value=(price.value-myval);
av=document.getElementById("uwithd").innerHTML;
uvv=parseInt(av);
var port=document.getElementById("myhid").innerHTML;

    document.getElementById("userwith").value=uvv;
    document.getElementById("uremain").value=((parseInt(port)*price.value)-uvv);
   
    
  var cal=(p.value-mach.value)*0.2;
 fin.value=cal;

} 
var c=document.getElementById('mamt').value;
  c2=parseInt(c);
if(c2!=0)
{
  fun();
}

  var cp=document.getElementById('cpid').value;
  if(cp=="")
  {

  }
  else{

  }

</script>

<div class="container" >
  <h2>دفعات الشركاء</h2>
<form method="post" >
  
  <div class="form-group col-md-6" hidden>
    <label for="name">Payment id</label>
    <input type="text" class="form-control" id="upid" name="upid"required readonly >
  </div>
  <div class="form-row">
<div class="form-group col-md-3">
  <label>	تاريخ الدفع</label>
  <input type="date" id="udate" class="form-control" name="udate">

</div>
<div class="form-group col-md-3">
  <label>قيمة الدفعة</label>
  <input type="number" required id="uamt" class="form-control" name="uamt">
  
</div>
<div class="form-group col-md-4">
  <label>بيد</label>
  <input type="text" name="ufor" id="ufor" class="form-control">

  
</div>
<div class="form-group col-md-2">
  <label>الحالة</label>
  <select required name="ustatus" id="ustatus" class="form-control">
  <option value="نعم">نعم</option>
    <option value="لا">لا</option>
  </select>

  
</div>

</div>

<button type="submit" name="addupayment" class="btn btn-primary">إضافة</button>
<?php if($_SESSION['typee']==1){ ?>
<button type="submit" name="updateupayment" class="btn btn-success">تعديل</button>
<?php } ?>
<button type="button" name="" class="btn btn-success"  onclick="window.location.href = 'userwithdraw.php'">تحديث</button>

</form>
<br>
<?php 
if(isset($_POST['addupayment']))
{ob_start();
  extract($_POST);
$query="Insert into userWithdraw VALUES(0,$v,'$udate','$uamt',$_SESSION[id],'$ufor','sasa','$ustatus')";

$con=con_function();
$cc=$con->query($query);
if($cc)
{
header("location:sales.php?msg=Added Sucessfully");
}
else{
  header("location:sales.php?msg=Error");
}

ob_end_flush();}
if(isset($_POST['updateupayment']))
{ob_start();
extract($_POST);
$query="Update userwithdraw SET datee='$udate',amount=$uamt,notes='$ufor',transfered='$ustatus' where wid=$upid";
$con=con_function();
$cc=$con->query($query);
echo "$query";
if($cc)
{
header("location:sales.php?msg=Edited Sucessfully?id=$val");
}
else{
  header("location:sales.php?msg=Error");
}

ob_end_flush();
}
if(isset($_GET['id1234']))
{ob_start();
$id=0;
$id = $_GET['id1234'];

$sql = "DELETE FROM userwithdraw WHERE wid = $id ";
$con=con_function();
$check = $con->query($sql);


if($check){
  header("location:sales.php?msg=deleted successfully?id=$val");
}else{
  echo $con->error;
}



  ob_end_flush();

}   
 ?>
 <button id="exapmles" class="btn btn-primary btn-sm"><b>-</b></button>
 <div id="abc"><table class="table" id="tab2" >
  <thead class="abc" >
    <tr>
      <th scope="col">#</th>
      <th scope="col">تاريخ الدفع</th>
      <th scope="col">	قيمة الدفعة</th>
      <th scope="col">وصف</th>
      <th scope="col">الحالة</th>
      <?php if($_SESSION['typee']==1){ ?>
      <th>حذف</th>
    <?php } ?>
    </tr>
  </thead>
  <tbody>
                              
                                    
                                        
                                            <?php $mysum=0;
                                            ob_start();
                                            $con=con_function();

$s=0;
$sql ="SELECT * FROM userwithdraw where sid=$v  ";
$rr=$con->query($sql);
 if($rr->num_rows>0)
  {
 $projectss = array();
 $pn=array();
  $i=0;
    while ($nott =  mysqli_fetch_assoc($rr))
    {
        $notifi[] = $nott;
        
    }
   $i=0;
    sort($notifi);
  
   
 
 
    foreach ($notifi as $notife)
    {
   echo  "<form><tr class='tr-shadow'>";
   echo "<td>".$notife['wid']."</td><td>
                                                ".$notife['datee']."
                                            </td> <td>
                                                ".$notife['amount']."
                                            </td><td class='desc'>".$notife['notes']."</td><td class='desc'>".$notife['transfered']."</td>
                                            ";if($_SESSION['typee']==1){
                                              echo "<td>
                                                    <button class='btn btn-danger btn-sm' >
                                                        <a  
                                                        href='delwith.php?id1234=$notife[wid]'>
                                                        delete

                                                    </button>
                                                    </td>";}
                                                    echo "

                                            
                                            
                                        </tr>
                                        </form>
                                        <tr class='spacer'></tr>
                                        "; $mysum+=$notife['amount'];
                                       
$i++;}}else{
    echo "No Data  Found.";
  
}
echo "<tr><td >مجموع دفعات </td><td></td><td id='uwithd'>$mysum</td></tr>";  
?>
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

document.getElementById('ustatus').value=this.cells[4].innerHTML.trim();



  }}

function initDate()
{ fun();
  var g=document.getElementById("sdate");

var h=  document.getElementById("ddate");
var e=  document.getElementById("pdate");
var n=  document.getElementById("udate");

var today = new Date();


var mdate = today.getFullYear();

if((today.getMonth()+1) < 10)
{
 mon='-0'+(today.getMonth()+1);
}
else{
  mon=(today.getMonth()+1);
}
if((today.getDate()) < 10)
{
 dat='-0'+(today.getDate());
}
else{
  dat=(today.getDate());
}
mdate=mdate+mon+dat;


g.value= mdate ;
h.value=mdate;
e.value=mdate;
n.value=mdate;
}
window.onload = function() {
 initDate();
}
</script>


<?php 
 include('footer.php'); ?>

