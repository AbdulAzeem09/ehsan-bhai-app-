<?php
//ini_set('display_errors', '1');
//ini_set('display_startup_errors', '1');
///(E_ALL);

include('../../univ/baseurl.php');
session_start();
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class){
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$_GET["categoryid"] = 1;


?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>

<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>
</head>

<body class="bg_gray">
<?php

//this is for store header
$header_store = "header_store";

include_once("../../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">
<!--   <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
<?php
$activePage = 4;
//include('left-menu.php'); 
?>
</div> -->
<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<?php
include('left-buyermenu.php');
?>
</div>
</div>
<div class="col-md-10">
<style>

body{

background-color: #eee; 
}

table th , table td{
text-align: center;
}

table tr:nth-child(even){
background-color: #e4e3e3
}

th {
background: #333;
color: #fff;
}

.pagination {
margin: 0;
}

.pagination li:hover{
cursor: pointer;
}

.header_wrap {
padding:30px 0;
}
.num_rows {
width: 20%;
float:left;
}
.tb_search{
width: 20%;
float:right;
}
.pagination-container {
width: 70%;
float:left;
}

.rows_count {
width: 20%;
float:right;
text-align:right;
color: #999;
}




.form-control {
display: inline!important;
width: auto!important;}

</style>


<?php 

$storeTitle = " Dashboard / Draft";
//  include('../top-dashboard.php');
// include('../searchform.php');

?>

<div class="row ">
<!--    <div class="col-md-12">
<ul class="breadcrumb" style="background-color: #fff;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
<li><a href="#">Draft</a></li>

</ul>
<div class="text-right">
<ul class="dualDash"   style="float:left!important;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13)?'active':''?>">Seller Dashboard</a></li>
<li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
</ul>
</div>
</div> -->


<div class="col-md-12">
<ul class="breadcrumb" style="background: white !important; ">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>">Buyer Dashboard</a></li>
<li>Subscriptions</li>

</ul> 
</div>

<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
</style>
<!--<?php 
$p = new _productposting;
$result = $p->readMyDraftprofile($_GET["categoryid"], $_SESSION['pid']);
if($result!=false){
$table="example";

}else{
$table="";

}
?>-->

<form action="mam_transactions.php?action=category" method="get">
<div class="dropdown" id="menu" style="margin:15px;">

<select name="select1" class="form-control">
<option>Select Company</option>
<?php
include('../../backofadmin/library/config.php');

$i = 1;
$userid=$_SESSION['uid'];
$sql1="SELECT distinct pid FROM pos_membership_barcode where customerr_user_id=$userid";
$r1=mysqli_query($dbConn,$sql1);

$p = new _pos;
//$sq=$p->raedpid($userid);
//if($sq){
//$r1=mysqli_fetch_array($sq);
//}
//$result_1 = $p->readTransations1();		

if($r1){			
while ($row_1 = mysqli_fetch_assoc($r1)) {
//print_r($row_1);
// die('=========');
$pid=$row_1['pid']; 

?>
<option value="<?php echo $row_1['pid']; ?>"
<?php
if($row_1['pid']==$_GET['select1']){
echo 'selected';
}  ?>
>
<?php 
$companyid=$p->readCom($pid);
if($companyid){
$cmpr=mysqli_fetch_array($companyid);
$cmp=$cmpr['companyname'];
echo $cmp;
}

?>
</option>
<?php } 
}?>
</select>
    
<input type="submit" value="submit" class="btn btn-primary">
<a href="<?php echo $BaseUrl.'/store/dashboard/mam_transactions.php?action=category'?>" class="btn btn-danger">Reset</a>

</div>
</form>

<form method="get">
<div class="dropdown" id="menu" style="margin:15px;">
<?php   
$uid=$_SESSION['uid'];
$pid=$_GET["select1"];
if(isset($_GET["select1"])){
$pid=$_GET["select1"];
$result3=$p->readName_qty($uid,$pid);
//print_r($result3);
// die('=======');
if($result3){
while($res2=mysqli_fetch_assoc($result3)){
$barcode=$res2['barcode']." ";
$result5=$p->readName_qty1($barcode);
if($result5){

$res3=mysqli_fetch_assoc($result5);

echo $name_qty=$res3['name_qty'].":";
}
echo $qty11=$res2['quantity']."</br>"; 

}
}

/*$select3=$_GET['select1'];

$result4= $p->readName_qty3($select3); 

$result5=$p->readName_qty1($barcode);
if($result5){

$res3=mysqli_fetch_assoc($result5);

$name_qty=$res3['name_qty'];

}

*/


}else{

$result3=$p->readName_qty($uid,$pid);
if($result3){
$res2=mysqli_fetch_assoc($result3);

$barcode=$res2['barcode'];


$result5=$p->readName_qty1($barcode);


$res3=mysqli_fetch_assoc($result5);

$name_qty=$res3['name_qty'];

}
}

?>



<?php  
$uid=$_SESSION['uid'];
if(isset($_GET["select1"])){

// echo $uid;
//die('=====');
$select2=$_GET['select1'];

$result2= $p->readQuantity2($select2);
if($result2){

$res1=mysqli_fetch_assoc($result2);
$quantity1=$res1['quantity'];
//echo $quantity1;
// die('=======');
}

}else{

$result1=$p->readQuantity($uid);



if($result1){

$res1=mysqli_fetch_assoc($result1);
//$quantity1=$res1['quantity'];
}


}



?>
<div class="d-flex flex-row justify-content-between">
<!--<div><span>Current Subscription: REVERSE OSMOSIS</span></div>-->
<!--<div>
<span><b>Balance :</b> <?php echo $total_quntity;?></span><br>
<?php if($name){?>
<span><b>Name :</b> <?php echo $name;?></span>
<?php }else{?>
<span></span>
<?php } ?>

</div>-->
<?php
$pd=$_GET['select1'];
$data11 = $p->read_barcode12($pd);
if($data11){
$total_quntity=0;
while($row_b11 = mysqli_fetch_assoc($data11)){
//echo $row_b11['barcode']."<br>";
$d = $p->read_name_qty($row_b11['barcode']);
if($d){
while($r = mysqli_fetch_assoc($d)){
//echo $r['name_qty']." = ";	echo $row_b11['quantity']."<br>";
$total_quntity+=$row_b11['quantity'];						
}}
}
//die('====');
}
?>	
<div style=" float: right; margin-top: -20px;"><span>Total Quantity : <?php echo $total_quntity; ?></span></div>
</div>
</div>
</form>


<!-- Dropdoen code here  -->							


<!--code end  -->


<div class="container-fluid">
      <div class="header_wrap">
        <div class="num_rows">
		
				<div class="form-group"> 	<!--		Show Numbers Of Rows 		-->
			 		<select class  ="form-control" name="state" id="maxRows">
						 
						 
						 <option value="10">10</option>
						 <option value="15">15</option>
						 <option value="20">20</option>
						 <option value="50">50</option>
						 <option value="70">70</option>
						 <option value="100">100</option>
            <option value="5000">Show ALL Rows</option>
						</select>
			 		
			  	</div>
        </div>
        <div class="tb_search">
<input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
        </div>
      </div>


<div class="col-md-12 ">
<!-- <h4 style="color: #0B241E!important;">UNPUBLISHED DRAFT POSTS : </h4>-->
<div class="">
<div class="table-responsive1">
<table class="table table-striped table-class" id= "table-id">
<!-- <table class="table tbl_store_setting display" id="<?php echo $table; ?>" cellspacing="0" width="100%" > -->
<thead>
<tr>
<th >
</th>

<!--<th class="text-center" style="width: 50px;">No</th>-->

<th>Date</th>
<th>Previous Quantity</th>
<th>Qty Refill</th>
<th>Membership name</th>
<!-- <th>Event</th>--> 
<th class="text-center">Action</th>
</tr>
</thead>
<tbody> 
<?php
$i=1;
$userid=$_SESSION['uid'];
$co= new _pos; 
if (isset($_GET["select1"])) {					 

$select1=$_GET['select1'];
//echo $select1;
//die('======');
$currency= $co->readTransations2_mem($select1);
//echo $currency;
//die('=====');


} else {

$currency= $co->readTransations2();

}

if($currency){
while ($row = mysqli_fetch_assoc($currency)) {
$ba=$row['barcode'];
$res7=$p->readQty($ba);
if($res7){
$row8=mysqli_fetch_array($res7);
}
?>

<tr> 
<td>
</td>	
<!--<td style="padding-left: 16px!important;"><?php echo $i; ?></td>-->
<td><?php echo $row['date'];?></td>
<td><?php echo $row['current_qty']; ?></td>
<td><?php echo $row['quantity']; ?></td>
<td><?php echo $row8['name_qty'];?></td>
<td><?php echo $row['event'];?></td> 


<!-- <td><?php 

if($row['status']==1){ ?>
<button class="btn btn-success">Paid</button>
<?php 	}else{  ?>
<button class="btn btn-danger">Pending</button>
<?php	}
?>



</td>-->
<!--<td><a href="<?php echo $BaseUrl.'/store/dashboard/transaction_details.php?id='.$row['id']; ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
</td>-->

</tr>
<?php
$i++;

}
}else{
if($_GET['filter1']=="submit"){
echo '<h4>record not found</h4>'; 
}
}
?>

</tbody>
</table>

<!--		Start Pagination -->
<div class='pagination-container'>
				<nav>
				  <ul class="pagination">
				   <!--	Here the JS Function Will Add the Rows -->
				  </ul>
				</nav>
			</div>

</div> <!-- 		End of Container -->



</div> 
</div>
</div>
</div>

</div>
</div>
</div>
</section>


<!-- partial 
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

<script type="text/javascript">
$(document).ready(function() {

var table = $('#example').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]

});
});//End of create main table


$('#example tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );
</script>

<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>

</body>
</html>
<?php
} ?>


<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
<script>

getPagination('#table-id');
	$('#maxRows').trigger('change');
	function getPagination (table){

		  $('#maxRows').on('change',function(){
		  	$('.pagination').html('');						// reset pagination div
		  	var trnum = 0 ;									// reset tr counter 
		  	var maxRows = parseInt($(this).val());			// get Max Rows from select option
        
		  	var totalRows = $(table+' tbody tr').length;		// numbers of rows 
			 $(table+' tr:gt(0)').each(function(){			// each TR in  table and not the header
			 	trnum++;									// Start Counter 
			 	if (trnum > maxRows ){						// if tr number gt maxRows
			 		
			 		$(this).hide();							// fade it out 
			 	}if (trnum <= maxRows ){$(this).show();}// else fade in Important in case if it ..
			 });											//  was fade out to fade it in 
			 if (totalRows > maxRows){						// if tr total rows gt max rows option
			 	var pagenum = Math.ceil(totalRows/maxRows);	// ceil total(rows/maxrows) to get ..  
			 												//	numbers of pages 
			 	for (var i = 1; i <= pagenum ;){			// for each page append pagination li 
			 	$('.pagination').append('<li data-page="'+i+'">\
								      <span>'+ i++ +'<span class="sr-only">(current)</span></span>\
								    </li>').show();
			 	}											// end for i 
     
         
			} 												// end if row count > max rows
			$('.pagination li:first-child').addClass('active'); // add active class to the first li 
        
        
        //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT
       showig_rows_count(maxRows, 1, totalRows);
        //SHOWING ROWS NUMBER OUT OF TOTAL DEFAULT

        $('.pagination li').on('click',function(e){		// on click each page
        e.preventDefault();
				var pageNum = $(this).attr('data-page');	// get it's number
				var trIndex = 0 ;							// reset tr counter
				$('.pagination li').removeClass('active');	// remove active class from all li 
				$(this).addClass('active');					// add active class to the clicked 
        
        
        //SHOWING ROWS NUMBER OUT OF TOTAL
       showig_rows_count(maxRows, pageNum, totalRows);
        //SHOWING ROWS NUMBER OUT OF TOTAL
        
        
        
				 $(table+' tr:gt(0)').each(function(){		// each tr in table not the header
				 	trIndex++;								// tr index counter 
				 	// if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
				 	if (trIndex > (maxRows*pageNum) || trIndex <= ((maxRows*pageNum)-maxRows)){
				 		$(this).hide();		
				 	}else {$(this).show();} 				//else fade in 
				 }); 										// end of for each tr in table
					});										// end of on click pagination list
		});
											// end of on select change 
		 
								// END OF PAGINATION 
    
	}	


			

// SI SETTING
$(function(){
	// Just to append id number for each row  
default_index();
					
});

//ROWS SHOWING FUNCTION
function showig_rows_count(maxRows, pageNum, totalRows) {
   //Default rows showing
        var end_index = maxRows*pageNum;
        var start_index = ((maxRows*pageNum)- maxRows) + parseFloat(1);
        var string = 'Showing '+ start_index + ' to ' + end_index +' of ' + totalRows + ' entries';               
        $('.rows_count').html(string);
}

// CREATING INDEX
function default_index() {
  $('table tr:eq(0)').prepend('<th> ID </th>')

					var id = 0;

					$('table tr:gt(0)').each(function(){	
						id++
						$(this).prepend('<td>'+id+'</td>');
					});
}

// All Table search script
function FilterkeyWord_all_table() {
  
// Count td if you want to search on all table instead of specific column

  var count = $('.table').children('tbody').children('tr:first-child').children('td').length; 

        // Declare variables
  var input, filter, table, tr, td, i;
  input = document.getElementById("search_input_all");
  var input_value =     document.getElementById("search_input_all").value;
        filter = input.value.toLowerCase();
  if(input_value !=''){
        table = document.getElementById("table-id");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 1; i < tr.length; i++) {
          
          var flag = 0;
           
          for(j = 0; j < count; j++){
            td = tr[i].getElementsByTagName("td")[j];
            if (td) {
             
                var td_text = td.innerHTML;  
                if (td.innerHTML.toLowerCase().indexOf(filter) > -1) {
                //var td_text = td.innerHTML;  
                //td.innerHTML = 'shaban';
                  flag = 1;
                } else {
                  //DO NOTHING
                }
              }
            }
          if(flag==1){
                     tr[i].style.display = "";
          }else {
             tr[i].style.display = "none";
          }
        }
    }else {
      //RESET TABLE
      $('#maxRows').trigger('change');
    }
}
</script>
