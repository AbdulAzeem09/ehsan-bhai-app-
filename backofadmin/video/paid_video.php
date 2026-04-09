<?php
if (!defined('WEB_ROOT')) {
exit;
}
$sql		=	"SELECT * FROM `spvideo` WHERE `video_price_status` = '1' ";
$result = dbQuery($dbConn, $sql);
// custom pagignation
//$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
//$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);

?>

<!-- Content Header (Page header) -->
<section class="content-header top_heading">
<h1>Paid Videos <small>[List]</small></h1>
</section>
<!-- Main content -->
<section class="content-fluid">
<div class="box box-success">
<div>
</div>
<div class="box-body tbl-respon">
<table id="example1" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th>No</th>
<th>Video</th>
<th>Video Title</th>
<th>Video Description</th>
<th>Video Price</th>
<th>Video Discount</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$i = 1;

while($row = dbFetchAssoc($result)) {

//$status = "<img src='" .  WEB_ROOT_TEMPLATE . "/images/icon/active.png' alt='Active' width='24' height='24' />";
?>
<tr>

<td class="text-center"><?php echo $i;?></td>
<td>

<div class="itemsContainer">
<div class="image">
<video id="uploaded_video" controls="" style="width: 135px;"> <source src="https://<?php echo $_SERVER['SERVER_NAME']; ?>/upload/video/<?php echo $row['video_file']?>"></video></div>
</div>

</td>

<td title="<?php echo $row['video_title'];?>" > 
<?php $new=$row['video_title']; echo substr($new, 0, 30); ?></td>
<td title="<?php echo $row['video_desc']; ?>"><?php $new1=$row['video_desc']; echo substr($new1, 0, 30); ?></td>
<td><?php echo $row['default_currency'].' '. $row['video_price']; ?></td>
<td><?php echo $row['default_currency'].' '. $row['video_discount']; ?></td>


<td><a href="https://<?php echo $_SERVER['SERVER_NAME']; ?>/videos/watch.php?video_id=<?php echo $row['video_id']; ?>" data-toggle="tooltip" title="Detail!" class="btn menu-icon vd_bg-blue">View </a></td>

</tr><?php
$i++;
}
?>

</tbody>

</table>
</div>



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
