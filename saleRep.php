<?php include("header.php"); ?>
<br>
<div class="container">
  <h2>تقرير البيع</h2>
  <div id="updata"> <center><button onclick="printer()" id="printerr" class="btn btn-dark btn-lg"  > طباعة</button></center>
  <br>
  <div class="row">
    <div class="col-md-3 form-group">
      <label>بحث</label>
  <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search here">
  </div>
  <div class="col-md-3 form-group">
    <label>مصنف بواسطة</label>
  <select class="form-control" id="filterBy">
    <option selected value="0">
      #
    </option>
    <option value="1">
    اسم الزبون
    </option>
    <option value="2">
    المبلغ الإجمالي
    </option>
    <option value="3">
    كمية اخرى
    </option>
    <option value="4">
    مجموع الدفع
    </option>
    <option value="5">
    العملاء المتبقية
    </option>

    <option value="6">
    حساب المستخدم
    </option>
    <option value="7">
    سحب المستخدم
    </option>
    <option value="8">
    المستخدم المتبقي
    </option>
  </select>
  </div>
  <div class="col-md-6"></div>
  </div>
</div>
 <table class="table" id="tab1" >
  <thead  style="text-align: center;" class="abc">
    <tr>
      <th scope="col">#</th>
      <th scope="col">اسم الزبون</th>
      <th scope="col">المبلغ الإجمالي</th>
      <th scope="col">كمية اخرى</th>
      <th scope="col">مجموع الدفع</th>
      <th scope="col">العملاء المتبقية</th>
      <th scope="col">حساب المستخدم</th>
      <th scope="col">سحب المستخدم</th>
      <th scope="col">المستخدم المتبقي</th>
      
      
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
    echo "No Sales Found.";
  
}  ?>

</tbody>

</table>

</div>
<script type="text/javascript">
  function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  index = document.getElementById("filterBy").value;

  filter = input.value.toUpperCase();
  table = document.getElementById("tab1");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[index];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
$("#printerr").click(function(){
  
  $("thead").removeClass("abc");
  var b=document.getElementById('updata');
  
    
    b.style.display='none';

    window.print();
    b.style.display='block';
  
   $("thead").addClass("abc");
});




</script>
<?php include("footer.php"); ?>