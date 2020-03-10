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
 
if(isset($_POST['adduser']))
{
  
   $myquery="Select * from user where 1";
                $con=con_function();
   $r=$con->query($myquery);
                 $numrow = mysqli_num_rows($r);
           $myboolean=false;
                 if($numrow>0)
                 {
                  while($re=$r->fetch_assoc())
                  {
                    if($re['username']==$_POST['username'])
                    {
                         $myboolean=true;
                         echo "<center>This Username Already Exists</center>";
                    }
                  }
                 }
                 if($myboolean==false)
                 {



  $query="Insert into user Values(0,'".$_POST['username']."','".$_POST['email']."','".$_POST['pass']."',".$_POST['portion'].",".$_POST['type'].")";
  
  $con=con_function();
  $r=$con->query($query);
  if($r)
  {
    header("location:user.php?msg=Added Sucessfully");
}
else{
header("location:user.php?msg=Error");
}}
ob_end_flush();

  }
  
  if(isset($_POST['edituser']))
{ob_start();
  
  $query="Update user SET username='".$_POST['username']."',email='".$_POST['email']."',portion=".$_POST['portion'].",password='".$_POST['pass']."',type=$_POST[type] where uid=".$_POST['id'];
  $con=con_function();
 
  $r=$con->query($query);
  if($r)
  {ob_end_flush();
    header("location:../account app/user.php?msg=Edited Sucessfully");
}
else{
header("location:user.php?msg=Error");
}
ob_end_flush();
  }

 ?>
	<h2 >إدارة المستخدم</h2>
  <?php if(!($_SESSION['typee']==3 )) {?>
	<form action="" method="POST" >
    <div class="form-group" hidden>
    <label for="name">User Id</label>
    <input type="text" class="form-control" id="custid" name="id"required readonly >
  </div>
  <div class="form-group">
    <label for="name">اسم المستخدم</label>
    <input type="text" class="form-control" id="username" name="username"required >
  </div>
   
  
  
  
   <div class="form-group">
    <label for="exampleFormControlInput1">البريد الالكتروني</label>
    <input type="email" class="form-control" id="email" name="email" required id="exampleFormControlInput1" placeholder="name@example.com">
  </div>
  <div class="form-group">
    <label for="exampleFormControlInput1">كلمة السر</label>
    <input type="text" class="form-control"  name="pass" required id="password" >
  </div>
<div class="row">
   <div class="form-group col-md-6">
    <label for="country">الحصة</label>
    <input type="double" class="form-control" id="portion" name="portion"  required>
  </div>
  <div class="form-group col-md-6">
    <label for="country">نوع المستخد</label>
    <SELECT required class="form-control" name="type" id="type">
       <option value="0" disabled selected>------Select---------</option>
      <option value="1">سوبر المستخدم</option>
      <option value="2">شريك</option>
      <option value="3">محاسب</option>
    </SELECT>
  </div>
  </div>
<?php
ob_start(); 
if($_SESSION['typee']==1 ||($_SESSION['typee']==2 )){ 
 echo "<button type='submit' name='adduser' class='btn btn-primary'>إضافة</button> ";
 } if(($_SESSION['typee']==1 )) {

  echo"<button type='submit' name='edituser' class='btn btn-success'>تعديل</button>
  ";
 

}

}

?>
<button type='button'  class='btn btn-success'  onclick="window.location.href = 'user.php'">تحديث</button>
</form>

<br>
<br>
<table class="table" id="tab1" >
  <thead class="abc">
    <tr>
      <th scope="col">#</th>
      <th scope="col">اسم المستخدم</th>
      <th scope="col">البريد الالكتروني</th>
      <th scope="col">الحصة</th>
      <th scope="col">كلمة السر</th>
      <th scope="col">نوع المستخد</th>
      <?php if(($_SESSION['typee']==1 )) {?>
      <th>حذف</th>
    <?php  } ?>
    </tr>
  </thead>
  <tbody>
                              
                                    
                                        
                                            <?php 
                                            ob_start();
                                            $con=con_function();

$s=0;
$sql ="SELECT * FROM user  ";
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
    {$mytpe="";
   echo  "<form><tr class='tr-shadow'>";
   if($notif['type']==1)
   {
$mytype="سوبر المستخدم";
   }
   elseif ($notif['type']==2) {
    
$mytype="شريك";
   
   }
   elseif ($notif['type']==3) {
    
$mytype="محاسب";
   
   }
   echo "<td>".$notif['uid']."</td><td>
                                                ".$notif['username']."
                                            </td> <td class='desc'>".$notif['email']."</td><td class='desc'>".$notif['portion']."</td><td class='desc'>".$notif['password']."</td><td class='desc'>".$mytype."</td>";
                                            if(($_SESSION['typee']==1 ))
                                                    {echo"<td><button class='btn btn-danger btn-sm' >
                                                        <a  
                                                        href='deluser.php?id123=$notif[uid]'>
                                                        حذف

                                                    </button></td>";}
                                                    

                                            
                                            
                                       echo " </tr>
                                        </form>
                                        <tr class='spacer'></tr>
                                        " ;
$i++;}}else{
    echo "لم يتم العثور على مستخدم مسجل.";
  
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
document.getElementById('username').value=this.cells[1].innerHTML.trim();
document.getElementById('email').value=this.cells[2].innerHTML.trim();
document.getElementById('password').value=this.cells[4].innerHTML.trim();
document.getElementById('portion').value=this.cells[3].innerHTML.trim();
var ty=this.cells[5].innerHTML.trim();
if(ty=="Super User")
{
 document.getElementById('type').value=1;

}
elseif(ty=="Partner")
{
  document.getElementById('type').value=2;

}
elseif(ty=="Accountant")
document.getElementById('type').value=3;

  }}

</script>

