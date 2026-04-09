<?php
if (!defined('WEB_ROOT')) {
exit;
}


$sql =  "SELECT * FROM company_news ";
$result  = dbQuery($dbConn, $sql);


?>

<!-- Content Header (Page header) -->
<section class="content-header top_heading" style="padding-right: 860px;">

<span style="font-size:20px;">Company News<small>[List]</small></span>


<!-- <a href="index.php?view=company_f" class="btn btn-primary" style="margin-top:-1px;margin-left:15px;">Add</a> -->


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
<div class="alert alert-<?php //echo $_SESSION['data'];?>">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<?php echo $_SESSION['errorMessage'];  ?>
</div> 
</div><?php
unset($_SESSION['errorMessage']);
}
} 






?>

<div class="box-body" >
<div class="table-responsive tbl-respon">
<table id="example1" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th class="text-center">ID</th>
<th>Title</th>
<th style="width: 80px;">Posted Date</th>
<!-- <th>Description</th> -->
<th>Company Name</th>
<th class="text-center">Action</th>
</tr>
</thead>
<tbody>
<?php
if ($result) {
$i = 1;
while ($row = dbFetchAssoc($result)) {
//print_r($row);
//die('======');
$id1=$row['idcmpanynews'];

extract($row);
$postDate = strtotime($cmpanynewsdate);
?>
<tr class="<?php echo ($cmpanynewsStatus == 1)?'bg_ban':'';?>">
<td class="text-center"><?php echo $i; ?></td>
<td><?php echo ucfirst(strtolower($cmpanynewsTitle)); ?></td>
<td><?php echo date("d-M-Y", $postDate); ?></td>
<!-- <td><?php echo $cmpanynewsDesc;?></td> -->
<td><a href="<?php echo $BaseUrl . '/friends/?profileid='. $spProfiles_idspProfiles;?>"><?php showProfileName($dbConn, $spProfiles_idspProfiles); ?></a></td>
<td class="menu-action text-center">



<?php
if ($cmpanynewsStatus == 0) {
?>
<a href="javascript:banCmpnyNews(<?php echo $idcmpanynews;?>)" data-toggle="tooltip" title="Ban This News" class="btn menu-icon vd_bg-red" ><i class="fa fa-ban"></i></a>
<?php
}else{
?>
<a href="javascript:activeCmpnyNews(<?php echo $idcmpanynews;?>)" data-toggle="tooltip" title="Active This News" class="btn menu-icon vd_bg-green" ><i class="fa fa-unlock"></i></a>
<?php
}
?>
<a href="javascript:detailCmpnyNews(<?php echo $idcmpanynews;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-info"></i> </a>
<a href="javascript:deleteCmpnyNews(<?php echo $idcmpanynews;?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>

<a href="index.php?view=company_E&id=<?php  echo $id1; ?>" data-target="#newForm1_<?php echo $id;   ?>"  class="btn menu-icon vd_bg-red"><i class="fa fa-edit"></i></a>											
</td>
</tr>

<?php
$i++;
}
}
?>
</tbody>
</table>
</div>
</div>
<!--- End Table ---------------->
</div>


</section><!-- /.content --><script type="text/javascript">

$(document).ready( function () {
var table = $('#example1').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

setTimeout(function () {
$("#alertmsg").hide();
}, 2000);

</script>	

