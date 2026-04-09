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
<style>

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
        /*table tbody tr {
              display: none;
        }*/




      </style>

</head>

<body class="bg_gray">
<?php


//this is for store header
// $header_store = "header_store";

include_once("../../header.php");
?>
<?php if(isset($_GET['pay'])=='payment1'){ unset($_GET['pay'])?>
<div id="div5" class="alert alert-success pull-right" style="width: 50%;background-color:#42af7d!important;">Payment successful!</div>
<?php }?>


<?php if(isset($_GET['msg'])=='uadata'){?>
<div id="div5" class="alert alert-success pull-right" style="width: 50%;background-color:#42af7d!important;">Updated successfully!</div>
<?php }?>



<section class="main_box">
<div class="container">
<div class="row">
<div id="sidebar" class="col-md-2 hidden-xs no-padding">
<div class="left_grid store_left_cat">
<?php
include('left-menu.php'); 
?>
</div>

<div class="col-md-10">                        
<?php	if($_GET['msg'] == "notacess"){ ?>

<div class="alert alert-danger" role="alert">
<h1>You can not access this Page or this Page not might exist.</h1>
</div>
<?php   } ?>

<?php 
// $storeTitle = " Dashboard / Active Products";
// include('../top-dashboard.php');
//include('../searchform.php');                       
?>

<div class="row">

<div class="col-sm-12">
<ul class="breadcrumb" style="background-color: #fff;">
<li><a href="<?php echo $BaseUrl.'/business_for_sale/dashboard/index.php';?>">Dashboard</a></li>
<li><a href="#">Active Business</a></li>
<!--<li><a href="#">Summer 15</a></li>
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

<style type="text/css">
.paginate_button {
border-radius: 0 !important;
}
div#example_filter {
margin-bottom: 5px;
}
</style>
<?php 
$p = new _businessrating;
$result = $p->read_business_active($_SESSION['uid'],$_SESSION['pid']);
if($result!=false){
$table="examle";
}
else{
$table="";
}


?>
<div class="col-sm-12">
<div class="">
<div class="table-responsive">
<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
<?php
$p = new _businessrating;

$result = $p->read_business_active($_SESSION['uid'], $_SESSION['pid']);

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
  <th></th>
<th class="text-center">ID</th>
<th class="text-center" >Title</th>
<th class="text-center" >Posting Date</th>
<th class="text-center" >Expiry Date</th>
<th class="text-center" >Duration (Days)</th>
<th class="text-center" >Price</th>
<th class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php

//$p = new _postingview;
$p = new _businessrating;

$result = $p->read_business_active($_SESSION['uid'], $_SESSION['pid']);
//echo $result->num_rows;

if ($result!=false) {
$i = 1;
while ($row = mysqli_fetch_assoc($result)) {
$dt = new DateTime($row['created_date']);
$edt = new DateTime($row['exp_date']);
?>
<tr>
<td></td>
<td class="text-center"><?php echo $i++; ?></td>
<!-- <td class="text-center"><?php echo $i; ?></td> -->
<td class="text-center"><a href="<?php echo $BaseUrl.'/business_for_sale/business_detail.php?postid='.$row['idspbusiness']; ?>"><?php echo $row['listing_headline']; ?></a></td>

<td class="text-center" style="padding-left:0px"><?php echo $dt->format('d M Y'); ?></td>             
<td class="text-center"><?php echo $edt->format('d M Y'); ?></td>
<td class="text-center">&nbsp;<?php echo $row['duration']; ?></td>
<td class="text-center">&nbsp;<?php echo 'USD '.$row['price']; ?></td>

<td class="text-center">
<!--<a href="<?php echo $BaseUrl.'/store/dashboard/detail.php?postid='.$row['idspPostings']; ?>"><i class="fa fa-eye"></i></a>
<a href="<?php //echo $BaseUrl.'/store/detail.php?catid=1&postid='.$row['idspPostings']; ?>" target="_blank"><i class="fa fa-eye"></i></a>-->
<a href="<?php echo $BaseUrl.'/business_for_sale/edit_business.php?postid='.$row['idspbusiness']; ?>"><i style="color: #428bca" title="Edit" class="fa fa-pencil" ></i></a>
<!--<a href="javascript:void(0)" data-postid="<?php //echo $row['idspPostings']; ?>" class="delpost" ><img src="<?php //echo $BaseUrl.'/assets/images/icon/delete.png'?>" class="img-responsive" alt="Delete" ></a>-->
</td>
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
								    </li>
				   Here the JS Function Will Add the Rows 
        <li data-page="next" id="prev">
								       <span> > <span class="sr-only">(current)</span></span>
								    </li>
				  </ul>
				</nav>
			</div>

 -->
</div>


</div>
</div>
</div>
<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>
<script type="text/javascript">
$(document).ready(function() {

setTimeout(function () {
$("#div5").hide();
}, 2000);

var table = $('#examle').DataTable({ 
select: false,
"columnDefs": [{
className: "Name", 
"targets":[0],
"visible": false,
"searchable":false
}]
});
//End of create main table


$('#examle tbody').on( 'click', 'tr', function () {

// alert(table.row( this ).data()[0]);

} );
});

</script>
</div>
</div>
</div>
</div>
</section><br><br><br>



<?php 
include('../../component/f_footer.php');
include('../../component/f_btm_script.php'); 
?>

</body>
<script>          getPagination('#table-id');
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
 // $('table tr:eq(0)').prepend('<th> ID </th>');

  var id = 0;

  $('table tr:gt(0)').each(function() {
    id++;
   // $(this).prepend('<td>' + id + '</td>');
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
} ?>