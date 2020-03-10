<?php include("header.php"); ?>
<div class="container"><div class="col-md-12 col-sm-12">  <?php 
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
<div class="container" >
  <?php 
if(isset($_POST['addpor']))
{ob_start();
  extract($_POST);
$query="Insert into portion VALUES(0,'$pordate',$poramt,'$porres','$pornotes',$rodw,$amrw,$porcash,'$portran')";
$con=con_function();
$cc=$con->query($query);
if($cc)
{
header("location:portion.php?msg=Added Sucessfully");
}
else{
  header("location:portion.php?msg=Error");
}

ob_end_flush();}
if(isset($_POST['updatepor']))
{ob_start();
extract($_POST);
$query="Update portion SET transfered='$portran',datee='$pordate',amount=$poramt,notes='$pornotes',resource='$porres',rodwith=$rodw ,amwith=$amrw,cash=$porcash where porid=$porid";
$con=con_function();

$cc=$con->query($query);
if($cc)
{
header("location:portion.php?msg=Edited Sucessfully");
}
else{
  header("location:portion.php?msg=Error");
}

ob_end_flush();
}
if(isset($_GET['id1235']))
{ob_start();
$id=0;
$id = $_GET['id1235'];

$sql = "DELETE FROM portion WHERE porid = $id ";
$con=con_function();
$check = $con->query($sql);


if($check){
  header("location:portion.php?msg=deleted successfully");
}else{
  echo $con->error;
}



  ob_end_flush();

}
if($_SESSION['typee']==3 )
{
  echo "<h2>حصص</h2>";
}
  if($_SESSION['typee']==1 ||$_SESSION['typee']==2 ){ ?>
  <h2>حصص</h2>
<form method="post" >
  
  <div class="form-group col-md-6" hidden>
    <label for="name">Portion Id</label>
    <input type="text" class="form-control" id="porid" name="porid"required readonly >
  </div>
  <div class="form-row">
<div class="form-group col-md-6 col-sm-12">
  <label>	تاريخ الحصة</label>
  <input type="date" id="pordate" class="form-control" name="pordate">

</div>
<div class="form-group col-md-6 col-sm-12">
  <label> القيمة</label>
  <input type="number" required id="poramt" class="form-control" name="poramt">
  
</div>

</div>

<div class="form-row">
<div class="form-group col-md-6 col-sm-12">
  <label>القيمة</label>
  <input type="text" name="porres" id="porres" class="form-control" required>

</div>
<div class="form-group col-md-6 col-sm-12">
  <label>ملاحظات</label>
  <input type="text" max="90" class="form-control" id="pornotes" required name="pornotes">
  
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6 col-sm-12">
  <label>سحب أبو الروض</label>
  <input type="number"  class="form-control" id="rodw" required name="rodw">
</div>
<div class="form-group col-md-6 col-sm-12">
  <label> 	سحب عمار</label>
  <input type="number" class="form-control" id="amrw" required name="amrw">
</div>
</div>
<div class="form-row">
<div class="form-group col-md-6 col-sm-12">
  <label>نقد</label>
  <input type="number"  class="form-control" id="porcash" required name="porcash">
</div>
<div class="form-group col-md-6 col-sm-12">
  <label>منقول</label>
  <input type="text" class="form-control" id="portran" required name="portran">
</div>
</div>
<?php if($_SESSION['typee']==1 ||$_SESSION['typee']==2 )
{ ?>
<button type="submit" name="addpor" class="btn btn-primary">إضافة</button>
<?php }if($_SESSION['typee']==1 ){ ?>
<button type="submit" name="updatepor" class="btn btn-success">تعديل</button>
<?php } ?>

<button type="button" name="" class="btn btn-success"  onclick="window.location.href = 'portion.php'">تحديث</button>

</form>
<?php } ?>
<br>

 <button id="exapmles1" class="btn btn-primary btn-sm"><b>-</b></button>

 <div id="abc1" class="col-sm-12"><table class="table" id="tab1"  >
  <thead class="abc">
    <tr>
      <th scope="col">#</th>
      <th scope="col">اريخ الحصة</th>
      <th scope="col">القيمة</th>
      <th scope="col">المصدر</th>
      <th scope="col">ملاحظات</th>
      <th scope="col">سحب أبو الروض</th>
      <th scope="col">سحب عمار</th>
      <th scope="col">نقد</th>
      <th scope="col">منقول</th>
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
$sql ="SELECT * FROM portion   ";
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
   echo  "<form><tr class='tr-shadow' onLongTouch='mytFunc();'>";
   echo "<td>".$notif['porid']."</td><td>
                                                ".$notif['datee']."
                                            </td> <td>
                                                ".$notif['amount']."
                                            </td><td class='desc'>".$notif['resource']."</td><td class='desc'>".$notif['notes']."</td><td class='desc'>".$notif['rodwith']."</td><td class='desc'>".$notif['amwith']."</td><td class='desc'>".$notif['cash']."</td><td class='desc'>".$notif['transfered']."</td>";if($_SESSION['typee']==1 ){echo"<td>
                                                    <button class='btn btn-danger btn-sm' >
                                                        <a  
                                                        href='portion.php?id1235=$notif[porid]'>
                                                        حذف

                                                    </button>
                                                    </td>";}
                                                    echo"

                                            
                                            
                                        </tr>

                                        </form>
                                        <tr class='spacer'></tr>
                                        " ;
                                        
$i++;}}else{
    echo "No Registered Payment Found.";
  
}  ?>

  </tbody>
                                </table>
  
</div>


</div>


<?php include("footer.php"); ?>
<script type="text/javascript">
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
  
rIndex=this.rowIndex;
console.log(rIndex);
document.getElementById('porid').value=this.cells[0].innerHTML.trim();
document.getElementById('pordate').value=this.cells[1].innerHTML.trim();
document.getElementById('poramt').value=this.cells[2].innerHTML.trim();
document.getElementById('porres').value=this.cells[3].innerHTML.trim();
document.getElementById('pornotes').value=this.cells[4].innerHTML.trim();
document.getElementById('rodw').value=this.cells[5].innerHTML.trim();
document.getElementById('amrw').value=this.cells[6].innerHTML.trim();
document.getElementById('porcash').value=this.cells[7].innerHTML.trim();
document.getElementById('portran').value=this.cells[8].innerHTML.trim();



  }}

function initDate()
{
  var g=document.getElementById("pordate");

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

}
window.onload = function() {
 initDate();
};
</script>

