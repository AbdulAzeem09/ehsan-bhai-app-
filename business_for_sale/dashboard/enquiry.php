<?php
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
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php');?>
<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>

<style type="text/css">
.buyer{
max-width: 100px;
overflow: hidden;
text-overflow: ellipsis;
white-space: nowrap;
}
.modal {
}
.vertical-alignment-helper {
display:table;
height: 100%;
width: 100%;
}
.vertical-align-center {

display: table-cell;
vertical-align: middle;
}
.modal-content {

width:inherit;
height:inherit;

margin: 0 auto;
}
  /* start pagination style  */
  body{

background-color: #eee; 
}

table th , table td{
text-align: center;
}

table tr:nth-child(even){
background-color: #BEF2F5
}

.pagination li:hover{
cursor: pointer;
}
      
</style>        
</head>

<body class="bg_gray">
<?php


//this is for store header
//$header_store = "header_store";

include_once("../../header.php");
?>
<section class="main_box">
<div class="container">
<div class="row">
<!-- <div class="sidebar col-md-2 no-padding left_store_menu" id="sidebar" >
<?php
// $activePage = 6;
//  include('left-menu1.php'); 
?>
</div> -->
<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<?php
include('left-menu.php'); 
?>
</div>


<div class="col-md-10 pull-right">

<div class="row">
<div class="col-sm-12">
<ul class="breadcrumb" style="background: white !important;  ">
<li><a href="<?php echo $BaseUrl.'/business_for_sale/dashboard/index.php';?>">Dashboard</a></li>
<li><a href="#">My Received Enquiries</a></li>

</ul>
</div>
</div>

<?php 

$storeTitle = " Dashboard / My Enquires";
// include('../top-dashboard.php');
//include('../searchform.php');

?>

<div class="row">



<!--    <div class="col-md-12">
<ul class="breadcrumb" style="background-color: #fff;">
<li><a href="<?php echo $BaseUrl.'/store/dashboard/sell_dashboard.php';?>">Seller Dashboard</a></li>
<li><a href="#">My Enquiries</a></li>

</ul>


<div class="text-right">
<ul class="dualDash"   style="float:left!important;">
<li><a href="<?php //echo $BaseUrl.'/store/dashboard/sell_dashboard.php'; ?>" class="<?php //echo ($activePage == 21 || $activePage == 2 || $activePage == 3 || $activePage == 4 || $activePage == 5 || $activePage == 6 || $activePage == 14 || $activePage == 16 || $activePage == 18 || $activePage == 20 || $activePage == 22 || $activePage == 8 || $activePage == 9 || $activePage == 10 || $activePage == 11 || $activePage == 12 || $activePage == 13)?'active':''?>">Seller Dashboard</a></li>
<li><a href="<?php //echo $BaseUrl.'/store/dashboard/';?>" class="<?php //echo ($activePage == 1 || $activePage == 15 || $activePage == 7 || $activePage == 23 || $activePage == 24)?'active':''?>">Buyer Dashboard</a></li>
</ul>
</div>
</div> -->


<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
div#example_filter {
margin-bottom: 5px;
}
</style>
<?php 
$en = new _businessrating;
$result = $en->read_business_enquiry($_SESSION['pid']);
if($result!=false){
$table="example";

}else{
$table="";	 
}

?>

<div class="col-sm-12 ">
<div class="">
<div class="table-responsive">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<?php
$en = new _businessrating;
$result = $en->read_business_enquiry($_SESSION['pid']);

if ($result) {
  $pagination = 'example';
}
else{
     $pagination = ' ';
}

?>
<table class="table table-striped table-class" id= "<?php echo $pagination; ?>" cellspacing="0" width="100%" >
<thead>
<tr>

<th class="text-center">Sender Name</th>
<th class="text-center" >Business Title</th>
<th class="text-center" >Comment</th>
<th class="text-center" >Duration (Days)</th>
<th class="text-center">Price</th>
<!--<th>Seller Reply</th>-->

<th class="text-center">Action</th>

</tr>
</thead>
<tbody>
<?php
$en = new _businessrating;
$result = $en->read_business_enquiry($_SESSION['pid']);
//print_r($result);
//  echo $en->ta->sql;

if ($result!=false) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {


$de1= $en->read_id_business($row['postid']);
//print_r($de1);
if($de1!=false){
$row1=mysqli_fetch_assoc($de1);
}

$id=$row['id'];
// $buyerprofilid  = $row['buyerProfileid'];
$sellerprofilid  = $row['pid'];




/*  $sl = new _sellerenqreply;


$commresult  = $sl->getsellerreply($row['id']);
//  echo $sl->ta->sql;            

if($commresult != false)
{
while ($commrow = mysqli_fetch_assoc($commresult)) {

$Sellercomment = $commrow["sellerreply"];
$Scommentid = $commrow["id"];
$commid = $commrow["reply_id"];


}
}

*/

?>
<tr>


<td class=" text-center" style="width: 150px;">
<a href="<?php echo $BaseUrl.'/friends/?profileid='.$sellerprofilid; ?>" target="_blank">
<?php 

//		echo $sellerprofilid."========";

$dd = new _spprofiles;
$profile_name  = $dd->readprofilebanner($sellerprofilid);
if($profile_name != false){
$dd1 = mysqli_fetch_assoc($profile_name);


echo $dd1['spProfileName'];
}else{
echo ' ';
}
?>
</a>
</td>

<td class="text-center" >
<a href="<?php echo $BaseUrl.'/business_for_sale/business_detail.php?postid='.$row['postid']; ?>" target="_blank">  <?php echo $row1['listing_headline']; ?></a>
</td>

<!-- Modal -->
<div class="modal fade" id="<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">
<div class="modal-content no-radius bradius-15 ">
<div class="modal-header sellbuyhead">
<!--<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>-->
<h4 class="modal-title" id="myModalLabel"  style="color: #fff; font-size: 22px;">Enquiry Message</h4>

</div>
<div class="modal-body"><p style="padding: 8px;"><?php echo substr($row['comment'], 0, 50); ?></p></div>
<div class="modal-footer">
<button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
<!--   <button type="button" class="btn btn-primary">Save changes</button> -->
</div>
</div>
</div>
</div>
</div>                                                    
<!--  <td><?php echo substr($row['message'], 0, 50); ?></td> -->

<td class="text-center">
<a href="" data-toggle="modal" data-target="#<?php echo $row['id'];?>">

<?php echo substr($row['comment'], 0, 50); ?></a>
</td>

<!--  <td class="buyer">    

<?php if (isset($Sellercomment) && $row['id'] == $commid) { ?>
<a href=""data-toggle="modal" data-target="#r<?php echo $Scommentid;?>"><?php  echo $Sellercomment; ?></a>

<?php  }else{ ?>
<p>No Comment</p>
<?php } ?>

</td>-->


<!-- Modal -->
<div class="modal fade" id="r<?php echo $Scommentid;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">
<div class="modal-content no-radius bradius-15 ">
<div class="modal-header sellbuyhead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>
<h4 class="modal-title" id="myModalLabel" style="color: #fff; font-size: 22px;">Seller Reply</h4>

</div>
<div class="modal-body"><p style="padding: 8px;"> <?php echo $Sellercomment; ?>
</p></div>
<div class="modal-footer">
<button type="button" class="btn btn-default headclosebtn" data-dismiss="modal">Close</button>
<!--   <button type="button" class="btn btn-primary">Save changes</button> -->
</div>
</div>
</div>
</div>
</div>                                                         <td class="text-center" >
<?php echo $row1['duration'];?>
</td> <td class="text-center" >
<?php echo 'USD '.$row1['price'];?>
</td>

<td class="text-center">
<a href="<?= $BaseUrl; ?>/business_for_sale/dashboard/reply_enquiry_seller.php?id=<?= $id; ?>"><i title="View" class="fa fa-eye" ></i></a>
</td>




<!-- Modal -->
<div class="modal fade" id="myreply<?php echo $row['id'];?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

<div class="vertical-alignment-helper">
<div class="modal-dialog vertical-align-center">

<!--   <form id="sellerreplyform" enctype="multipart/form-data"> -->
<div class="modal-content no-radius bradius-15">
<div class="modal-header sellbuyhead">
<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>

</button>
<h3 class="modal-title" id="myModalLabel"  style="color: #fff; font-size: 22px;">Reply</h3>

</div>
<div class="modal-body">
<input type="hidden"  name="reply_id" id="reply_id<?php echo $row['id'];?>" value="<?php echo $row['id'];?>">

<div class="form-group">
<label for="sell1">Enter Message <span class="red">*</span></label> 
<textarea class="form-control" name="sellerreply" id="sellerreplyid<?php echo $row['id'];?>" rows="4"></textarea>
<span id="sellercommentid_error" style="color:red;"></span>

</div>


</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal" style="background-color: #A60000; color: #fff;border-radius: 20px; min-width: 100px;" >Close</button>
<button type="button" class="btn btn-primary" 

onclick="get_replydata(<?php echo $row['id'];?>)"  style="background-color: green; color: #fff;border-radius: 20px; border: none; min-width: 100px;">Submit</button>
</div>
</div>
<!--   </form>  -->
</div>
</div>

</div>                                                        


</tr>

<?php
$i++;
}
}
else{
?>
<tr>
<td colspan="8" style="height:50px;">
<p class="text-center">No Record Found</p>
</td>
</tr>
<?php
}
?>

</tbody>
</table>
<!--		Start Pagination -->
<!-- <div class='pagination-container' >
				<nav>
				  <ul class="pagination">
            
            <li data-page="prev" >
								     <span> < <span class="sr-only">(current)</span></span>
								    </li> -->
				   <!--	Here the JS Function Will Add the Rows -->
        <!-- li data-page="next" id="prev">
								       <span> > <span class="sr-only">(current)</span></span>
								    </li>
				  </ul>
				</nav>
			</div> -->


</div>
</div>
</div>
</div>

</div>
</div>
</div>
</section><br><br><br>

<!-- <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->
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


$('#exaple tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );

</script>

<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>

<script type="text/javascript">
//function get_approvedata(id){

function get_replydata(id){
//alert();


var reply_id = $("#reply_id"+id).val()

var sellerreplyid = $("#sellerreplyid"+id).val()

if (sellerreplyid == "") {

$("#sellercommentid_error").text("Please Enter Comment.");
$("#sellerreplyid").focus();


return false;
}else{
$.ajax({
type: 'POST',
url: 'addsellercomment.php',
data: {reply_id: reply_id, sellerreply: sellerreplyid},


success: function(response){ 

//console.log(data);

swal({

title: "Reply Submitted Successfully!",
type: 'success',
showConfirmButton: true

},
function() {

//window.location.reload();

});


}
});
}

}



</script>

<!-- 
<script type="text/javascript">
$(document).ready(function(e){
// Submit form data via Ajax
$("#sellerreplyform").on('submit', function(e){
// alert();
e.preventDefault();

var sellercommentid = $("#sellercommentid").val()

if (sellercommentid == "") {

$("#sellercommentid_error").text("Please Enter Comment.");
$("#sellercommentid").focus();


return false;
}else{

$.ajax({
type: 'POST',
url: 'addsellercomment.php',
data: new FormData(this),
processData: false,
contentType: false,


success: function(response){ 

//console.log(data);


swal({

title: "Reply Submitted Successfully!",
type: 'success',
showConfirmButton: true

},
function() {

window.location.reload();

});


}
});
}

});
});

</script> -->

</body>
<script>

getPagination('#table-id');
					//getPagination('.table-class');
					//getPagination('table');

		  /*					PAGINATION 
		  - on change max rows select options fade out all rows gt option value mx = 5
		  - append pagination list as per numbers of rows / max rows option (20row/5= 4pages )
		  - each pagination li on click -> fade out all tr gt max rows * li num and (5*pagenum 2 = 10 rows)
		  - fade out all tr lt max rows * li num - max rows ((5*pagenum 2 = 10) - 5)
		  - fade in all tr between (maxRows*PageNum) and (maxRows*pageNum)- MaxRows 
		  */
		 

function getPagination(table) {
  var lastPage = 1;

  $('#maxRows')
    .on('change', function(evt) {
      //$('.paginationprev').html('');						// reset pagination

     lastPage = 1;
      $('.pagination')
        .find('li')
        .slice(1, -1)
        .remove();
      var trnum = 0; // reset tr counter
      var maxRows = parseInt($(this).val()); // get Max Rows from select option

      if (maxRows == 5000) {
        $('.pagination').hide();
      } else {
        $('.pagination').show();
      }

      var totalRows = $(table + ' tbody tr').length; // numbers of rows
      $(table + ' tr:gt(0)').each(function() {
        // each TR in  table and not the header
        trnum++; // Start Counter
        if (trnum > maxRows) {
          // if tr number gt maxRows

          $(this).hide(); // fade it out
        }
        if (trnum <= maxRows) {
          $(this).show();
        } // else fade in Important in case if it ..
      }); //  was fade out to fade it in
      if (totalRows > maxRows) {
        // if tr total rows gt max rows option
        var pagenum = Math.ceil(totalRows / maxRows); // ceil total(rows/maxrows) to get ..
        //	numbers of pages
        for (var i = 1; i <= pagenum; ) {
          // for each page append pagination li
          $('.pagination #prev')
            .before(
              '<li data-page="' +
                i +
                '">\
								  <span>' +
                i++ +
                '<span class="sr-only">(current)</span></span>\
								</li>'
            )
            .show();
        } // end for i
      } // end if row count > max rows
      $('.pagination [data-page="1"]').addClass('active'); // add active class to the first li
      $('.pagination li').on('click', function(evt) {
        // on click each page
        evt.stopImmediatePropagation();
        evt.preventDefault();
        var pageNum = $(this).attr('data-page'); // get it's number

        var maxRows = parseInt($('#maxRows').val()); // get Max Rows from select option

        if (pageNum == 'prev') {
          if (lastPage == 1) {
            return;
          }
          pageNum = --lastPage;
        }
        if (pageNum == 'next') {
          if (lastPage == $('.pagination li').length - 2) {
            return;
          }
          pageNum = ++lastPage;
        }

        lastPage = pageNum;
        var trIndex = 0; // reset tr counter
        $('.pagination li').removeClass('active'); // remove active class from all li
        $('.pagination [data-page="' + lastPage + '"]').addClass('active'); // add active class to the clicked
        // $(this).addClass('active');					// add active class to the clicked
	  	limitPagging();
        $(table + ' tr:gt(0)').each(function() {
          // each tr in table not the header
          trIndex++; // tr index counter
          // if tr index gt maxRows*pageNum or lt maxRows*pageNum-maxRows fade if out
          if (
            trIndex > maxRows * pageNum ||
            trIndex <= maxRows * pageNum - maxRows
          ) {
            $(this).hide();
          } else {
            $(this).show();
          } //else fade in
        }); // end of for each tr in table
      }); // end of on click pagination list
	  limitPagging();
    })
    .val(10)
    .change();

  // end of on select change

  // END OF PAGINATION
}

function limitPagging(){
	// alert($('.pagination li').length)

	if($('.pagination li').length > 7 ){
			if( $('.pagination li.active').attr('data-page') <= 3 ){
			$('.pagination li:gt(5)').hide();
			$('.pagination li:lt(5)').show();
			$('.pagination [data-page="next"]').show();
		}if ($('.pagination li.active').attr('data-page') > 3){
			$('.pagination li:gt(0)').hide();
			$('.pagination [data-page="next"]').show();
			for( let i = ( parseInt($('.pagination li.active').attr('data-page'))  -2 )  ; i <= ( parseInt($('.pagination li.active').attr('data-page'))  + 2 ) ; i++ ){
				$('.pagination [data-page="'+i+'"]').show();

			}

		}
	}
}

$(function() {
  // Just to append id number for each row
  $('table tr:eq(0)').prepend('<th> ID </th>');

  var id = 0;

  $('table tr:gt(0)').each(function() {
    id++;
    $(this).prepend('<td>' + id + '</td>');
  });
});

//  Developed By Yasser Mas
// yasser.mas2@gmail.com








</script>
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
</html>
<?php
}
?>
