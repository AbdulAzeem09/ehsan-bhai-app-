<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
include('../../univ/baseurl.php');
session_start();
//print_r($_SESSION);
if(!isset($_SESSION['pid'])){ 
$_SESSION['afterlogin']="services/";
include_once ("../../authentication/islogin.php");

}else{
function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$_GET["categoryID"] = "7";
$_GET["categoryName"] = "Services";
$header_servic = "header_servic";
$activePage = 8;

$flid = isset($_GET['flid']) ? (int) $_GET['flid'] : 0;   
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>

<style>


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



header.header_servic.header_front {
background-color: #0f8f46 !important;
} 
tr {
background-color: #56966f;

}
#profileDropDown li.active {
background-color: #0f8f46;
}
#profileDropDown li.active a {
color: white;
}
.dataTables_wrapper .dataTables_filter input {

margin-bottom: 3px;
}
</style>
<!-- ===== INPAGE SCRIPTS====== -->
<!-- High Charts script -->
<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>


<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>




<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<?php include('../../component/dashboard-link.php'); ?>
</head>

<body class="bg_gray">
<?php
include_once("../../header.php");

if($flid){

$ob = new _flagpost;
$resultfl=$ob->deletflag($flid);

}
?>




<section class="main_box">
<div class="container">
<div class="row">

<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<?php
include('left-buyermenu.php'); 
?>
</div>
</div>
<div class="col-md-10">
<!-- <div class="col-xs-12 serviceDashTop text-center">
<h1 style="font-size:35px;"><b>Flag Posts</b></h1>
</div> -->
<div class="row">


<!-- <div class="col-md-12">
<div class="table-responsive bg_white">
<table class="table table-striped table-bordered dashServ">
<thead>
<tr>

<th>Name</th>
<th class="text-center">Flagged Date</th>

<th class="text-center">Reason</th>

<th class="text-center">Flag Name</th>

<th class="text-center">Action</th>-->

</tr>
</thead>
<tbody>


<div class="col-sm-12" style="margin-top:10px;">



<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
td.dataTables_empty {
color: black;
}
td.dataTables_empty {
color: #504a4a;
}
</style>

<!-- partial:index.partial.html -->
<div class="table-responsive tbl-respon">





<div class="container-fluid">
      <!-- <div class="header_wrap"> -->
        <div class="num_rows">
		
				<!-- <div class="form-group"> 		Show Numbers Of Rows 	
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
        </div> -->
        <!-- <div class="tb_search">
<input type="text" id="search_input_all" onkeyup="FilterkeyWord_all_table()" placeholder="Search.." class="form-control">
        </div> -->
      </div>
 <link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<table class="table table-striped table-class" id= "example" style="width: 100%;">
  
	
<thead>
<tr>


<!-- <th>Name1</th> -->
<th></th>
<th>Product</th>
<th>Flagged Date</th>
<th>Reason</th>
 <th>Flag Name</th>
 <th>Action</th>
</tr>
  </thead>
<tbody>

<?php
$st= new _spuser;
$st1=$st->readdatabybuyerid($_SESSION['uid']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}
$objflag = new _flagpost;

//print_r($_SESSION);

//echo 
$resultflaf=$objflag->readflag3($_SESSION['pid'] ,1);

// var_dump($resultflaf);
//die("-------------------");
if($account_status!=1){
if($resultflaf!=false){ 
while($row222 = mysqli_fetch_assoc($resultflaf)){

$pr_id=$row222['spPosting_idspPosting'];
// print_r($row222);
// die("PPPPPPPPPPPPPPPPPPPPPPPPP");     
$pn=$objflag->readproductname($pr_id);
// var_dump($pn);
if($pn!=false){
$pn1=mysqli_fetch_assoc($pn);
$prname= $pn1['spPostingTitle'];
}
?>
<tr>


<?php 
$result = $row222['spProfile_idspProfile'];


$objpro = new _spprofiles;
$resultp88=$objpro->readname($result);
$row88=mysqli_fetch_assoc($resultp88);
?>
<a href="<?php echo $BaseUrl ?>/friends/?profileid=<?php echo $result;?>"></a>

<td>
  <?php 
  $resultp86=$objpro->readnameprod($pr_id); 
  if($resultp86){
  $row86=mysqli_fetch_assoc($resultp86);
  }
  ?> 
<a href="<?php echo $BaseUrl;?>/store/detail.php?catid=1&postid=<?php echo $pr_id; ?>"><?php echo $row86['spPostingTitle'];?></a>



</td>
<td></td>
 <td><?php echo $row222['flag_date'] ?></td> 
<td><?php echo $row222['why_flag'] ?></td>
<td><?php echo $row222['flag_desc'] ?></td>
<td> <a class="btn btn-danger" href="flag-post.php?flid=<?php echo $row222['flag_id'];?>">Delete</a></td>
</tr>
<?php

} }}


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



<!--  Developed By Yasser Mas -->


</div>


<!--<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>


<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  } );
  
		        
		   
} );

	</script> -->


</div>


</tbody>
</table>
</div>
</div>

</div>
</div>
</div>
</div>
</section>

<div class="space-lg"></div>

<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var table = $('#example').DataTable({
                paging: true, // Enable pagination
                select: false,
                columnDefs: [{
                    className: "Name",
                    targets: [0],
                    visible: false,
                    searchable: false
                }]
            });

            $('#example tbody').on('click', 'tr', function() {
                // Handle row click event here
            });
        });
    </script>
<!-- notification js -->
<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
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
