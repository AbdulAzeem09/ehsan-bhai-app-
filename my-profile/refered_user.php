<?php
/*	error_reporting(E_ALL);
ini_set('display_errors', '1');*/

include('../univ/baseurl.php');
session_start();
//print_r($_SESSION);
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="store/";
include_once ("../authentication/islogin.php");

}else{
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../component/f_links.php');?>

<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../component/dashboard-link.php'); ?>

</head>

<body class="bg_gray">
<?php


//this is for store header
// $header_store = "header_store";

include_once("../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">
<div class="col-md-2">

<div class="left_profile">

<h2>My Account</h2>
<p ><a href="<?php echo $BaseUrl.'/my-profile/';?>"><i class="fa fa-user"></i>&nbsp;&nbsp;&nbsp;My Profile</a></p>
<p><a href="<?php echo $BaseUrl?>/my-profile/refered_user.php" class="pull-left">Referred User</a></p>
<!--<p ><a href="<?php echo $BaseUrl.'/my-profile/my-account.php';?>"><i class="fa fa-dollar"></i>&nbsp;&nbsp;&nbsp;My Account</a></p>-->



</div>
</div>
<div class="col-md-10">                        


<?php 
//  $storeTitle = " Dashboard / Active Products";
// include('../top-dashboard.php');
//include('../searchform.php');                       
?>

<div class="row">

<div class="col-md-12">
<ul class="breadcrumb" style="background-color: #fff;">
<!--<li><a href="<?php //echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>-->
<li><a href="">User With My Referral Code</a></li>
<!-- <li><a href="#">Summer 15</a></li>
<li>Italy</li> -->
</ul>
<!--    <div class="text-right">
<ul class="dualDash"   style="float:left!important;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13)?'active':''?>">Seller Dashboard</a></li>
<li><a href="<?php echo $BaseUrl.'/store/dashboard/';?>" class="<?php echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
</ul>
</div> -->
</div>
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
.tooltip:hover .tooltiptext {
visibility: visible;
}
#example_filter{
margin-bottom: 5px;
margin-right: 5px;

}

.tbl_store_setting thead {
background-color: #3e2048;
color: #fff;
}

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

</style>
<?php  $p = new _spuser;

$result = $p->readdatabybuyerid($_SESSION['uid']);
//echo $result->num_rows;

if ($result!=false) {
$i = 1;
$row = mysqli_fetch_assoc($result);
//print_r($row);


$res= $p->read_user_ref_code($row['userrefferalcode']);
if($res!=false){
$table="example";
}
else{
$table="";
}

}
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<div class="num_rows">
		
        <div class="form-group">
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

<div class="col-md-12 ">



<div class="">
<div class="table-responsive">

<table class="table table-striped table-class" id= "table-id" cellspacing="0" width="100%" >
<thead>
<tr>




<th class="text-center">User Name</th>
<th class="text-center">Email</th>
<th class="text-center">Registered On</th>
<th class="text-center">Post Count</th>

</tr>
</thead>
<tbody>
<?php


//$p = new _postingview;
$p = new _spuser;

$result = $p->readdatabybuyerid($_SESSION['uid']);
//echo $result->num_rows;

if ($result) {
$i = 1;
$row = mysqli_fetch_assoc($result);
// $dt = new DateTime($row['spPostingDate']);
//  $edt = new DateTime($row['spPostingExpDt']);
$res= $p->read_user_ref_code($row['userrefferalcode']);
if($res!=false){
while($r=mysqli_fetch_assoc($res)){
//print_r($r);
$idspuser=$r['idspUser'];


$st_num=0;
$fr_num=0;
$rs_num=0;
$jb_num=0;
$ac_num=0;
$sp = new _spprofiles;
$st=$sp->read_post_store($idspuser);
if($st!=false){

$st_num=$st->num_rows;
}
$fr=$sp->read_post_freelancer($idspuser);
if($fr!=false){

$fr_num=$fr->num_rows;
}
$rs=$sp->read_post_real_state($idspuser);
if($rs!=false){

$rs_num=$rs->num_rows;
}
$jb=$sp->read_post_job_board($idspuser);
if($jb!=false){

$jb_num=$jb->num_rows;
}
$ac=$sp->read_post_art_craft($idspuser);
if($ac!=false){

$ac_num=$ac->num_rows;
}
//echo $st_num.' '.$fr_num.' '.$jb_num.' '.$rs_num.' '.$ac_num;
$count=$st_num+$fr_num+$jb_num+$rs_num+$ac_num;
?>
<tr>


<!--<td class="text-center"><?php echo $i; ?></td>-->

<td class="text-center"><?php echo $r['spUserName']; ?></td>
<td class="text-center">&nbsp;<?php echo $r['spUserEmail']; ?></td>
<td class="text-center">&nbsp;<?php echo $r['spUserRegDate']; ?></td>
<td class="text-center">&nbsp;<?php echo $count; ?></td>
</tr>
<?php
$i++;
}}
}
else{
?>
<tr>
<td colspan="6">
<p class="text-center">No Record Found</p>
</td>
</tr>
<?php
}
?>

</tbody>
</table>

<div class='pagination-container'>
				<nav>
				  <ul class="pagination">
				   <!--	Here the JS Function Will Add the Rows -->
				  </ul>
				</nav>
			</div>

</div>
</div>
</div>
</div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

</div>
</div>
</div>
</section>


<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>

</body>
</html>
<?php
} ?>

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
