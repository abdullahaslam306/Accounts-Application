<?php include("header.php"); ?>
<div class="container" dir="rtl">
  <div class="col-md-12">  <?php 
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
 if($_SESSION['typee']!=3 ){ ?>
	<h2 >زبون</h2>
	<form action="" method="POST" >
    <div class="form-group" hidden>
    <label for="name">Customer Id</label>
    <input type="text" class="form-control" id="custid" name="id"required readonly >
  </div>
  <div class="form-group">
    <label for="name">الاسم</label>
    <input type="text" class="form-control" id="name1" name="name"required >
  </div>
   <div class="form-group">
    <label for="contact">سجل الاتصال</label>
    <input  type="number" name="contact" id="contact2" class="form-control" required >
  </div>
   <div class="form-group">
    <label for="exampleFormControlInput1">لبريد الالكتروني</label>
    <input type="email" class="form-control" id="email" name="email" required id="exampleFormControlInput1" placeholder="name@example.com">
  </div>
   <div class="form-group">
    <label for="country">بلد</label>
    <input type="text" class="form-control" id="country" name="country"  required>
  </div>
 <?php if($_SESSION['typee']==1 ||($_SESSION['typee']==2 )){ ?>
<button type="submit" name="addcustomer" class="btn btn-primary">إضافة</button><?php } if($_SESSION['typee']==1 ) {?>
  <button type="submit" name="editcustomer" class="btn btn-success">تعديل</button><?php } ?>
  <button type="button" name="" class="btn btn-success"  onclick="window.location.href = 'customer.php'">تحديث</button>
  
  
</form>

<?php 
 }
if(isset($_POST['addcustomer']))
{ob_start();
  $query="Insert into Customer Values(0,'".$_POST['name']."','".$_POST['contact']."','".$_POST['email']."','".$_POST['country']."')";
  $con=con_function();
  $r=$con->query($query);
  if($r)
  {
    header("location:customer.php?msg=Added Sucessfully");
}
else{
header("location:customer.php?msg=Error");
}
ob_end_flush();

  }
  
  if(isset($_POST['editcustomer']))
{ob_start();
  
  $query="Update Customer SET name='".$_POST['name']."',contact='".$_POST['contact']."',email='".$_POST['email']."',country='".$_POST['country']."' where cid=".$_POST['id'];
  $con=con_function();
  $r=$con->query($query);
  if($r)
  {
    header("location:customer.php?msg=Edited Sucessfully");
}
else{
header("location:customer.php?msg=Error");
}
ob_end_flush();
  }
  

  
  

if($_SESSION['typee']==3 )
{
  echo "<h2>Customer Details</h2>";
}

 ?>

<br>

<br>
<table class="table" id="tab1" >
  <thead class="abc">
    <tr>
      <th scope="col">#</th>
      <th scope="col">الاسم</th>
      <th scope="col">سجل الاتصال</th>
      <th scope="col">البريد الالكتروني</th>
      <th scope="col">بلد</th>
      <?php if($_SESSION['typee']==1 ){ ?>
      <th>حذف</th>
    <?php } ?>
    </tr>
  </thead>
  <tbody>
                              
                                    <tbody>
                                        
                                            <?php 
                                            ob_start();
                                            $con=con_function();

$s=0;
$sql ="SELECT * FROM Customer  ";
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
   echo "<td>".$notif['cid']."</td><td>
                                                ".$notif['name']."
                                            </td> <td>
                                                ".$notif['contact']."
                                            </td><td class='desc'>".$notif['email']."</td><td class='desc'>".$notif['country']."</td>";if($_SESSION['typee']==1 ){
                                              echo "<td>
                                                    <button class='btn btn-danger btn-sm' >
                                                        <a  
                                                        href='delcust.php?id123=$notif[cid]'>
                                                        delete

                                                    </button>
                                                    </td>
                                                    ";}

                                            
                                            
                                       echo " </tr>
                                        </form>
                                        <tr class='spacer'></tr>
                                        " ;
$i++;}}else{
    echo "لم يتم العثور على عميل مسجل.";
  
}  ?>

                                            
                                            
                                            
                                            
                                            
                                          
                                            
                                                
                                       
                                    </tbody>
                                </table>
  

</div>



<?php include ("footer.php"); ?>
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
document.getElementById('custid').value=this.cells[0].innerHTML.trim();
document.getElementById('name1').value=this.cells[1].innerHTML.trim();
document.getElementById('contact2').value=this.cells[2].innerHTML.trim();
document.getElementById('email').value=this.cells[3].innerHTML;
document.getElementById('country').value=this.cells[4].innerHTML;



  }}

</script>