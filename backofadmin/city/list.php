<?php
if (!defined('WEB_ROOT')) {
exit;
}
$rowsPerPage = 100;
$sql =  "SELECT * FROM tbl_city ORDER BY city_id DESC";
$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);


?>

<!-- Content Header (Page header) -->
<section class="content-header top_heading">
<h1>Cities<small>[List]</small></h1>
</section>
<!-- Main content -->
<section class="content">
<div class="box box-success">

<?php 
if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
if($_SESSION['count'] <= 1){
$_SESSION['count'] +=1; ?>
<div class="row" id="alertmsg" style="margin: 5px 0px 0px 5px;" >
<div style="min-height:10px;"></div>
<div class="alert alert-<?php echo $_SESSION['data'];?>">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<?php echo $_SESSION['errorMessage'];  ?>
</div> 
</div><?php
unset($_SESSION['errorMessage']);
}
} ?>

<div class="box-header text-right">
<button type="button" name="btnButton" class="btn btn-primary"  onclick="addCity()"><i class="fa fa-plus"></i> Add City</button>
</div><!-- /.box-header -->
<div class="box-body" >
<div class="table-responsive tbl-respon">
<table id="example1" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th>Sr.No</th>
<th>Country Name</th>
<th>State Name</th>
<th>City Name</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
if ($result) {
if(isset($_GET['page'])){
$page = $_GET['page'] - 1;
$i = $rowsPerPage * $page +1;
}else{
$i = 1;
}
while ($row = dbFetchAssoc($result)) {
extract($row);
?>
<tr>
<td class="text-center"><?php echo $i++; ?></td>
<td><?php CountryName($dbConn, $country_id);?></td>
<td><?php StateName($dbConn, $state_id);?></td>
<td><?php echo $city_title; ?></td>
<td class="menu-action text-center">

<a href="javascript:deleteCity(<?php echo $city_id;?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>


</td>
</tr>
<?php

}
}
?>
<!-- <tr height="20">
<td align="center" colspan="9" class="pagingStyle"><?php echo $pagingLink;?></td>
</tr> -->
</tbody>
</table>
</div>
</div>
<!--- End Table ---------------->
</div>


</section><!-- /.content -->
<script type="text/javascript">

$(document).ready( function () {
var table = $('#example1').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

</script>	
