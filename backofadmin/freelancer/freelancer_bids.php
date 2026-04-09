<?php
//die('====================');
if (!defined('WEB_ROOT')) {
exit;
}
?>
<style>
.content {
min-height: 150px!important;
}
.select2 {
width: 400px!important;
}

</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Content Header (Page header) -->
<section class="content-header">
<h1> Freelancer Bids<small>[List]</small></h1>
</section>
<div class="box box-success">
<div class="box-body">
<div class="table-responsive tbl-respon">
<table id="example1" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
	<th>S.N.</th>
<!-- <th >Profiles ID</th> -->
<th >Profiles Name</th>
<!-- <th >Postings ID</th> -->
<th >Project Name</th>
<th >Price</th>
<th >Total Days</th>
<th >Cover Letter</th>
</tr>
</thead>
<tbody>
<?php
$id = 1;
$sql =  "SELECT * FROM spfreelancer_placebid ORDER BY `idspUserProfiles` desc";
$result2  = dbQuery($dbConn, $sql);
//$row2 = dbFetchAssoc($result2);
//print_r($aa);die('===');
while ($row = dbFetchAssoc($result2)) {
?>
<tr>
	<td><?php echo $id++; ?></td>
<!-- <td><?php echo $row['spProfiles_idspProfiles'];?></td> -->
<td><a href="/friends/?profileid=<?php echo $row['spProfiles_idspProfiles']; ?>"><?php 
showProfileName($dbConn, $row['spProfiles_idspProfiles']);
?></a></td>
<!-- <td><?php echo $row['spPostings_idspPostings'];?></td> -->
<?php 
$sql74 = "SELECT * FROM spfreelancer WHERE idspPostings = " . $row['spPostings_idspPostings'];
$result74  = dbQuery($dbConn, $sql74);
$row74 = dbFetchAssoc($result74);
?>
<td> <a href=" <?php echo $BaseUrl.'/freelancer/project-detail.php?project='. $row['spPostings_idspPostings'];?>"><?php echo $row74['spPostingTitle'];?></a></td>
<td ><?php echo $row74['Default_Currency'].' '.$row['bidPrice'];?></td>
<td ><?php echo $row['totalDays'];?></td>
<td title="<?php echo $row['coverLetter']; ?>"> <?php $new=$row['coverLetter']; echo substr($new, 0, 30);?></td>
</tr>
<?php
}
?>
</tbody>
</table>
</div>
</div>
<!--- End Table ---------------->
</div>
</section>

<script type="text/javascript">
$(document).ready( function () {
var table = $('#example1').DataTable( {
"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
});
});
</script>

