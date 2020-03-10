<?php include("header.php"); ?>
<br>
<div class="container">
	<h2>تقرير سحب الشريك</h2>
	<div id="updata">	<center><button onclick="printer()" id="printerr" class="btn btn-dark btn-lg"  > طباعة</button></center>
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
		تاريخ الدفع
		</option>
		<option value="1">
    قيمة الدفعة
		</option>
		<option value="3">
    الوصف
		</option>
		<option value="4">
		المستعمل
		</option>
    <option value="5">
    الحالة
    </option>
	</select>
	</div>
	<div class="col-md-6"></div>
	</div>
</div>
<table class="table" id="tab1" >
  <thead class="abc" >
    <tr>
      <th scope="col">ID</th>
     
      <th scope="col">تاريخ الدفع</th>
      <th scope="col">	قيمة الدفعة</th>
      <th scope="col">وصف</th>
      <th scope="col">		المستعمل
</th>
      <th scope="col">الحالة</th>
     
    </tr>
  </thead>
  <tbody>        <?php $mysum=0;
                                            ob_start();
                                            $con=con_function();

$s=0;

$sql ="SELECT uw.*,u.username FROM userwithdraw uw,user u where uw.uid=u.uid ";


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
                                            </td><td class='desc'>".$notife['notes']."</td><td class='desc'>".$notife['username']."</td><td class='desc'>".$notife['transfered']."</td>
                                            ";
                                                    echo "
 
                                        </tr>
                                        </form>
                                        <tr class='spacer'></tr>
                                        ";
                                       
$i++;}}else{
    echo "No Data  Found.";
  
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