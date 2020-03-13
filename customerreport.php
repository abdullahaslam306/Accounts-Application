<?php include("header.php"); ?>
<br>
<div class="container">
	<h2>تقرير العملاء</h2>
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
			ID
		</option>
		<option value="1">
		الاسم
		</option>
		<option value="1">
    سجل الاتصال
		</option>
		<option value="3">
    لبريد الالكتروني
		</option>
		<option value="4">
		بلد
		</option>
	</select>
	</div>
	<div class="col-md-6"></div>
	</div>
</div>
<table class="table" id="tab1">
  <thead class="abc">
    <tr>
      <th scope="col">#</th>
      <th scope="col">الاسم</th>
      <th scope="col">سجل الاتصال</th>
      <th scope="col">لبريد الالكتروني</th>
      <th scope="col">بلد</th>
     
    </tr>
  </thead >
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
                                            </td><td class='desc'>".$notif['email']."</td><td class='desc'>".$notif['country']."</td>";
                                            
                                            
                                       echo " </tr>
                                        </form>
                                        <tr class='spacer'></tr>
                                        " ;
$i++;}}else{
    echo "No Registered Customer Found.";
  
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