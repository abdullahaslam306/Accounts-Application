<?php include("header.php"); ?>
<div class="container">

  <?php 
  echo "<hr>";



if(isset($_POST['addinc']))
{
  extract($_POST);
  $query="Insert into income Values(0,$_SESSION[id],'$edate',$eamt,'$edesc','$eresource','$efor',$emonth,'$estat')";
 
  $con=con_function();
  $ry=$con->query($query);
  if($ry)
  {
    header("location:journal.php?msg=Added Sucessfully");
}
else{
header("location:journal.php?msg=Error");
}


  }
  
  if(isset($_POST['editinc']))
{ob_start();
  extract($_POST);
  $query="Update income SET datee='$edate',amount=$eamt,descr='$edesc',resources='$eresource',infor='$efor',mid='$emonth',status='$estat' where inid=$eid";

  $con=con_function();
 
  $ry=$con->query($query);
  if($ry)
  {
    header("location:journal.php?msg=Edited Sucessfully");
}
else{
header("location:journal.php?msg=Error");
}
  }
  
if(isset($_GET['id1236']))
{ob_start();
$id=0;
$id = $_GET['id1236'];

$sql = "DELETE FROM income WHERE inid = $id ";

$con=con_function();
$checkr = $con->query($sql);


if($checkr){
  header("location:journal.php?msg=deleted successfully");
}else{
  echo $con->error;
}

} 

if(isset($_POST['addpmt']))
{
 extract($_POST);
  $queryy="Insert into payment Values(0,$_SESSION[id],'$pdate',$pamt,'$pdesc','$resource','$pfor',$pmonth,'$pstat')";
 
  $con=con_function();
  echo "$queryy";
  $rr=$con->query($queryy);
  if($rr)
  {
    header("location:journal.php?msg=Added Sucessfully");
}
else{
header("location:journal.php?msg=Error");
}


  }
  
  if(isset($_POST['editpmt']))
{
  extract($_POST);
  $queryy="Update payment SET date='$pdate',amount=$pamt,descr='$pdesc',resource='$resource',for_='$pfor',mid='$pmonth',transfered='$pstat' where pid=$pid";
  echo "$queryy";
  $con=con_function();
 
  $rr=$con->query($queryy);
  if($rr)
  {
     
    header("location:journal.php?msg=Edited Sucessfully");
}
else{
  
header("location:journal.php?msg=Error");
}
  }
  
if(isset($_GET['id123']))
{ob_start();
$id=0;
$idd = $_GET['id123'];

$sql = "DELETE FROM payment WHERE pid = $idd ";
echo "$sql";
$con=con_function();
$checkke = $con->query($sql);


if($checkke){
  
  header("location:journal.php?msg=deleted successfully");
}else{
  
  echo $con->error;
}
}   

 ?>


<form >
  <h2>نموذج المجلة</h2>
  <div class="from-row">
    <div class="form-row">
    <div class="form-group col-md-5">
    <label for="name">الشهر</label>
    <input type="text" class="form-control" id="mon" name="mon"required readonly >
  </div>
  <div class="col-md-2"></div>
  <div class="form-group col-md-5">
    <label for="name">مجموع الدفعات</label>
    <input type="text" class="form-control" id="ptot" name="ptot"required >
  </div>
   </div>

<div class="form-row">
    <div class="form-group col-md-5">
    <label for="name">الرصيد</label>
    <input type="text" class="form-control" id="bal" name="bal"required readonly >
  </div>
  <div class="col-md-2"></div>
  <div class="form-group col-md-5">
    <label for="name"> مجموع الواردات</label>
    <input type="text" class="form-control" id="intot" name="intot"required >
  </div>
   </div>
  <hr>
    

  
  </div>
 
</form>

<div class="container" dir="rtl">
  <br>
  <?php if($_SESSION['typee']==1 ||$_SESSION['typee']==2){ ?>
 <h2 >دفع</h2>
 <form action="" method="POST" >
  <div class="form-row">
    <div class="form-group col-md-6" hidden>
    <label for="name">Payment Id</label>
    <input type="text" class="form-control" id="pid" name="pid"required readonly >
  </div>
  <div class="form-group col-md-6">
    <label for="name">التاريخ</label>
    <input type="date" class="form-control" id="pdate" name="pdate"required >
  </div>
   </div>

   <div class="form-row ">
   <div class="form-group col-md-4">
    <label for="exampleFormControlInput1">القيمة</label>
    <input type="number" class="form-control" id="pamt" name="pamt" required  >
  </div>
  <div class="form-group col-md-4">
    <label for="exampleFormControlInput1">الوصف</label>
    <input type="text" class="form-control"  name="pdesc" required id="pdesc" >
  </div>
  
  <div class="form-group col-md-4">
    <label for="exampleFormControlInput1">المصدر</label>
    <input type="text" class="form-control"  name="resource" required id="resource" >
  </div>
  </div>
  <div class="form-row">
   <div class="form-group col-md-4">
    <label for="country">بيد</label>
    <input type="text" class="form-control" id="pfor" name="pfor"  required>
  </div>
   <div class="form-group col-md-4">
    <label for="country">الشهر</label>
    <select class="form-control" required name='pmonth' id="pmonth">
     <option value="1">كانون الثاني</option>
     <option value="2">شباط</option>
     <option value="3">آذار</option>
     <option value="4">نيسان</option>
     <option value="5">أيار</option>
     <option value="6">حزيران</option>
     <option value="7">تموز</option>
     <option value="8">آب</option>
     <option value="9">ايلول</option>
     <option value="10">تشرين الاول</option>
     <option value="11">تشرين الثاني</option>
     <option value="12">كانون الأول</option>
    </select>
  </div>
   <div class="form-group col-md-4">
    <label for="country">الحالة</label>
    <input type="text" class="form-control" id="pstat" name="pstat"  required>
  </div>
  </div>
 <?php if($_SESSION['typee']==1 ||$_SESSION['typee']==2){ ?>
<button type="submit" name="addpmt" class="btn btn-primary">إضافة</button><?php } if($_SESSION['typee']==1 ){  ?>
  <button type="submit" name="editpmt" class="btn btn-success">تعديل</button><?php } ?>
  <button type="button" name="" class="btn btn-success"  onclick="window.location.href = 'journal.php'">تحديث</button>
  
  
</form>
<?php } if($_SESSION['typee']==3){echo "<h2>Payment Details</h2>";} ?>
<br>
<button id="exapmles" class="btn btn-primary btn-sm"><b>-</b></button>
<br>
<br>
<div id="abc3">
 <table class="table" id="tab1" >
  <thead class="abc">
    <tr>
      <th scope="col">#</th>
      <th scope="col">التاريخ</th>
      <th scope="col">القيمة</th>
      <th scope="col">الوصف</th>
      <th scope="col">المصدر</th>
      <th scope="col">بيد</th>
      <th scope="col">الشهر</th>
      <th scope="col">الحالة</th>
      <?php if($_SESSION['typee']==1 ){ ?>
      <th>حذف</th>
    <?php } ?>
    </tr>
  </thead>
  <tbody>
                              
                                    
                                        
                                            <?php
                                            ob_start();
                                            
                                            $sumpay=0;
                                            
                                            $con=con_function();

$s=0;
$sql ="SELECT p.*,m.mname as 'month' FROM payment p,month m where p.mid=m.mno AND uid=$_SESSION[id] ";
mysqli_set_charset($con,"utf8");
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
   echo "<td>".$notif['pid']."</td><td>
                                                ".$notif['date']."
                                            </td> <td class='desc'>".$notif['amount']."</td><td class='desc'>".$notif['descr']."</td><td class='desc'>".$notif['resource']."</td><td class='desc'>".$notif['for_']."</td>
                                            <td value='".$notif['mid']."'>".$notif['month']."</td><td class='desc'>".$notif['transfered']."</td>";
                                            if($_SESSION['typee']==1 ){echo"<td>
                                                    <button class='btn btn-danger btn-sm' >
                                                        <a  
                                                        href='journal.php?id123=$notif[pid]'>
                                                        حذف

                                                    </button>
                                                    </td>";}
echo"

                                            
                                            
                                        </tr>
                                        </form>
                                        <tr class='spacer'></tr>
                                        " ;
                                        $sumpay+=$notif['amount'];
$i++;}
echo "<tr><td>مجموع الدفعات</td><td></td><td id='paysum'>".$sumpay."</td></tr>";
}else{
    echo "لم يتم العثور على سجل الدفع.";
  
} 
$con->close();
ob_end_flush();

 ?>

                                            
                                            
                                            
                                            
                                            
                                          
                                            
                                                
                                       
                                    </tbody>
                                </table>
  
</div>
<hr>
</div>


<script type="text/javascript">
  var table=document.getElementById('tab1'),rIndex;
  console.log(table);
  for (var i = 1; i < table.rows.length; i++) {
var len=table.rows[i].cells.length;
len=len-1;

table.rows[i].ondblclick=function()
{
rIndex=this.rowIndex;
console.log(rIndex);
document.getElementById('pid').value=this.cells[0].innerHTML.trim();
document.getElementById('pdate').value=this.cells[1].innerHTML.trim();
document.getElementById('pamt').value=this.cells[2].innerHTML.trim();
document.getElementById('pdesc').value=this.cells[3].innerHTML.trim();
document.getElementById('resource').value=this.cells[4].innerHTML.trim();
document.getElementById('pfor').value=this.cells[5].innerHTML.trim();
abcd=0;
if(this.cells[6].innerHTML.trim()=='كانون الثاني')
{
abcd=1;
}
if(this.cells[6].innerHTML.trim()=='شباط')
{
abcd=2;
}
if(this.cells[6].innerHTML.trim()=='آذار')
{
abcd=3;
}
if(this.cells[6].innerHTML.trim()=='نيسان')
{
abcd=4;
}
if(this.cells[6].innerHTML.trim()=='أيار')
{
abcd=5;
}
if(this.cells[6].innerHTML.trim()=='حزيران')
{
abcd=6;
}
if(this.cells[6].innerHTML.trim()=='تموز')
{
abcd=7;
}
if(this.cells[6].innerHTML.trim()=='آب')
{
abcd=8;
}
if(this.cells[6].innerHTML.trim()=='ايلول')
{
abcd=9;
}
if(this.cells[6].innerHTML.trim()=='تشرين الاول')
{
abcd=10;
}if(this.cells[6].innerHTML.trim()=='تشرين الثاني')
{
abcd=11;
}if(this.cells[6].innerHTML.trim()=='كانون الأول')
{
abcd=12;
}
document.getElementById('pmonth').value=abcd;
document.getElementById('pstat').value=this.cells[7].innerHTML.trim();




  }}

</script>

</div>


<div class="container" dir="rtl">
<?php if($_SESSION['typee']==1||$_SESSION['typee']==2){ ?>
	<h2 >الإيرادات</h2>
	<form action="" method="POST" >
		<div class="form-row">
    <div class="form-group col-md-6" hidden>
    <label for="name">Income Id</label>
    <input type="text" class="form-control" id="eid" name="eid"required readonly >
  </div>
  <div class="form-group col-md-6">
    <label for="name">التاريخ</label>
    <input type="date" class="form-control" id="edate" name="edate"required >
  </div>
   </div>

   <div class="form-row ">
   <div class="form-group col-md-4">
    <label for="exampleFormControlInput1">القيمة</label>
    <input type="number" class="form-control" id="eamt" name="eamt" required  >
  </div>
  <div class="form-group col-md-4">
    <label for="exampleFormControlInput1">الوصف</label>
    <input type="text" class="form-control"  name="edesc" required id="edesc" >
  </div>
  
  <div class="form-group col-md-4">
    <label for="exampleFormControlInput1">المصدر</label>
    <input type="text" class="form-control"  name="eresource" required id="eresource" >
  </div>
  </div>
  <div class="form-row">
   <div class="form-group col-md-4">
    <label for="country">بيد</label>
    <input type="text" class="form-control" id="efor" name="efor"  required>
  </div>
   <div class="form-group col-md-4">
    <label for="country">الشهر</label>
    <select class="form-control" required name='emonth' id="emonth">
    	<option value="1">كانون الثاني</option>
    	<option value="2">شباط</option>
    	<option value="3">آذار</option>
    	<option value="4">نيسان</option>
    	<option value="5">أيار</option>
    	<option value="6">حزيران</option>
    	<option value="7">تموز</option>
    	<option value="8">آب</option>
    	<option value="9">ايلول</option>
    	<option value="10">تشرين الاول</option>
    	<option value="11">تشرين الثاني</option>
    	<option value="12">كانون الأول</option>
    </select>
  </div>
   <div class="form-group col-md-4">
    <label for="country">الحالة</label>
    <input type="text" class="form-control" id="estat" name="estat"  required>
  </div>
  </div>
 

 <?php if($_SESSION['typee']==1||$_SESSION['typee']==2){ ?>
<button type="submit" name="addinc" class="btn btn-primary">إضافة</button>
<?php } if($_SESSION['typee']==1){ ?>
  <button type="submit" name="editinc" class="btn btn-success">تعديل</button>
  <?php } ?>
  <button type="button" name="" class="btn btn-success"  onclick="window.location.href = 'journal.php'">تحديث</button>
  
  
</form>
<?php }  if($_SESSION['typee']==3)
{echo "<h2>Income Details</h2>";}?>
<br>
<button id="exapmles1" class="btn btn-primary btn-sm"><b>-</b></button>

<br>
<br>
<div id="abc1">
<table class="table" id="tab2" >
  <thead class="abc">
    <tr>
    <th scope="col">#</th>
      <th scope="col">التاريخ</th>
      <th scope="col">القيمة</th>
      <th scope="col">الوصف</th>
      <th scope="col">المصدر</th>
      <th scope="col">بيد</th>
      <th scope="col">الشهر</th>
      <th scope="col">الحالة</th>
      
      
   		 <?php
 
    
      
    
                                            $suminc=0;
                                            
                                            $con=con_function();

$s=0;
$sql ="SELECT i.*,m.mname as 'month' FROM income i,month m where i.mid=m.mno AND uid=$_SESSION[id]  ";
if($_SESSION['typee']==1)
{?>

      <th>حذف</th>
<?php } ?>
    </tr>
  </thead>
   		<tbody>


<?php 
mysqli_set_charset($con,"utf8");
$re=$con->query($sql);
 if($re->num_rows>0)
  {$s=$s+$re->num_rows;
 $projects = array();
 $pn=array();
  $i=0;
    while ($nott =  mysqli_fetch_assoc($re))
    {
        $notife[] = $nott;
        
    }
   $i=0;
    sort($notife);
  
   
 
 
    foreach ($notife as $notife)
    {
   echo  "<form><tr class='tr-shadow'>";
   echo "<td>".$notife['inid']."</td><td>
                                                ".$notife['datee']."
                                            </td> <td class='desc'>".$notife['amount']."</td><td class='desc'>".$notife['descr']."</td><td class='desc'>".$notife['resources']."</td><td class='desc'>".$notife['infor']."</td>
                                            <td class='desc'>".$notife['month']."</td><td class='desc'>".$notife['status']."</td>
                                            ";if($_SESSION['typee']==1){echo "<td>
                                                    <button class='btn btn-danger btn-sm' >
                                                        <a  
                                                        href='journal.php?id1236=$notife[inid]'>
                                                        حذف

                                                    </button>
                                                    </td>

                                            ";}echo "
                                            
                                        </tr>
                                        </form>
                                        <tr class='spacer'></tr>
                                        " ;
                                        $suminc+=$notife['amount'];
$i++;}
echo "<tr><td>مجموع الواردات</td><td></td><td id='incsum'>".$suminc."</td></tr>";
}else{
    echo "لم يتم العثور على سجل الدفع"; 
}  



?>                         
                                    
                                        
                                            

                                            
                                            
                                            
                                            
                                            
                                          
                                            
                                                
                                       
                                    </tbody>
                                </table>
  

</div>
</div>


<?php
include ("footer.php"); ?>
<script type="text/javascript">
	$("#exapmles").click(function(){
    
  $("#abc3").toggle();
});
  $("#exapmles1").click(function(){
    
  $("#abc1").toggle();
});
  var tablee=document.getElementById('tab2'),rIndex;

  console.log(tablee);
  for (var i = 1; i < tablee.rows.length; i++) {
var lens=tablee.rows[i].cells.length;
lens=lens-1;

tablee.rows[i].ondblclick=function()
{
rIndex=this.rowIndex;
console.log(rIndex);
document.getElementById('eid').value=this.cells[0].innerHTML.trim();
document.getElementById('edate').value=this.cells[1].innerHTML.trim();
document.getElementById('eamt').value=this.cells[2].innerHTML.trim();
document.getElementById('edesc').value=this.cells[3].innerHTML.trim();
document.getElementById('eresource').value=this.cells[4].innerHTML.trim();
document.getElementById('efor').value=this.cells[5].innerHTML.trim();
abcd=0;
if(this.cells[6].innerHTML.trim()=='كانون الثاني')
{
abcd=1;
}
if(this.cells[6].innerHTML.trim()=='شباط')
{
abcd=2;
}
if(this.cells[6].innerHTML.trim()=='آذار')
{
abcd=3;
}
if(this.cells[6].innerHTML.trim()=='نيسان')
{
abcd=4;
}
if(this.cells[6].innerHTML.trim()=='أيار')
{
abcd=5;
}
if(this.cells[6].innerHTML.trim()=='حزيران')
{
abcd=6;
}
if(this.cells[6].innerHTML.trim()=='تموز')
{
abcd=7;
}
if(this.cells[6].innerHTML.trim()=='آب')
{
abcd=8;
}
if(this.cells[6].innerHTML.trim()=='ايلول')
{
abcd=9;
}
if(this.cells[6].innerHTML.trim()=='تشرين الاول')
{
abcd=10;
}if(this.cells[6].innerHTML.trim()=='تشرين الثاني')
{
abcd=11;
}if(this.cells[6].innerHTML.trim()=='كانون الأول')
{
abcd=12;
}
document.getElementById('emonth').value=abcd;
document.getElementById('estat').value=this.cells[7].innerHTML.trim();




  }}

var month=document.getElementById('mon');

var income=document.getElementById('incsum');
var int=document.getElementById('intot');
int.value=income.innerHTML;

var pay=document.getElementById('paysum');
var intt=document.getElementById('ptot');
intt.value=pay.innerHTML;
var bln=document.getElementById('bal');
bln.value=int.value-intt.value;
var d = new Date();
var month = new Array();
month[0] = "كانون الثاني";
month[1] = "February";
month[2] = "آذار";
month[3] = "نيسان";
month[4] = "أيار";
month[5] = "حزيران";
month[6] = "تموز";
month[7] = "آب";
month[8] = "ايلول";
month[9] = "تشرين الاول";
month[10] = "تشرين الثاني";
month[11] = "كانون الأول";
var n = month[d.getMonth()];
document.getElementById('mon').value=n;
function initDate()
{
  var g=document.getElementById("pdate");
var h=  document.getElementById("edate");

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

}
window.onload = function() {
 initDate();
};
</script>