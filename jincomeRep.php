<?php include("header.php"); ?>
<br>
<div class="container">
  <h2>تقرير دخل المستخدم</h2>
  <div id="updata"> <center><button onclick="printer()" id="printerr" class="btn btn-dark btn-lg"  > طباعة</button></center>
  <br>
  <div class="row">
    <div class="col-md-3 form-group">
      <label>بحث</label>
  <input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Search here">
  </div>
  <div class="col-md-3 form-group">
    <label> مصنف بواسطة</label>
  <select class="form-control" id="filterBy">
    <option selected value="0">
      ID
    </option>
    <option value="1">
    التاريخ
    </option>
    <option value="2">
    القيمة
    </option>
    <option value="3">
    الوصف
    </option>
    <option value="4">
    المصدر
    </option>
    <option value="5">
    بيد
    </option>

    <option value="6">
    الشهر
    </option>
    <option value="7">
    الحالة
    </option>
  </select>
  </div>
  <div class="col-md-6"></div>
  </div>
</div>
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
      
       <?php
 
    
      
    
                                            $suminc=0;
                                            
                                            $con=con_function();

$s=0;
$sql ="SELECT i.*,m.mname as 'month' FROM income i,month m where i.mid=m.mno   ";
?>

      
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
                                            ";echo "
                                            
                                        </tr>
                                        </form>
                                        <tr class='spacer'></tr>
                                        " ;
                                     
$i++;}

}else{
    echo "No Income Record Found."; 
}  



?>                         
                            
                                       
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