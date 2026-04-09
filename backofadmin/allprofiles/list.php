<?php
if (!defined('WEB_ROOT')) {
exit;
}
$rowsPerPage = 25;
$sql		=	"SELECT * FROM spprofiles";
$result = dbQuery($dbConn, $sql);
// custom pagignation
//$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
//$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);

?>

<!-- Content Header (Page header) -->
<section class="content-header">
<h1>Registered Profiles</h1>
</section>
<!-- Main content -->
<section class="content">




<div class="box box-success">

<div class="box-body">
<div>
<?php 
if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
if($_SESSION['count'] <= 1){
$_SESSION['count'] +=1; ?>
<div class="space"></div>
<p class="alert alert-success"><?php echo $_SESSION['errorMessage'];  ?></p> <?php
unset($_SESSION['errorMessage']);
}
} ?>
</div>
<table id="example1" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th class="text-center">ID</th>

<th>Profile Name</th>
<th>Profile Type</th>
<th>Phone</th>
<th>Email</th>
<th>Country</th>


<th>Action</th>
</tr>
</thead>
<tbody>
<?php
if ($result){
if (isset($_GET['page']) && $_GET['page'] > 1) {
$i = 25 * ($_GET['page'] - 1) + 1;
}else{
$i = 1;
}

while($row = dbFetchAssoc($result)) {
//print_r($row);
$type=$row['spProfileType_idspProfileType'];
$sq="SELECT * FROM spprofiletype WHERE idspProfileType=$type";
$res=mysqli_query($dbConn,$sq);
//print_r($res);
$rrr=dbFetchAssoc($res);
//print_r($rrr);
@$profile_type=$rrr['spProfileTypeName'];
extract($row);

?>
<tr>
<td class="text-center"><?php echo $i++;?></td>

<td><a href="javascript:singleProfileDetail(<?php echo $spUser_idspUser.','.$idspProfiles; ?>)"><?php echo $spProfileName;	?></a></td>
<td><?php echo $profile_type; ?></td>
<td><?php echo $spProfilePhone; ?></td>
<td><?php echo $spProfileEmail; ?></td>

<td>
<?php
if($spProfilesCountry > 0 && $spProfilesCountry != ''){
CountryName($dbConn, $spProfilesCountry);
} ?>

</td>

<td class="menu-action text-center">

<a href="javascript:singleProfileDetail(<?php echo $spUser_idspUser.','.$idspProfiles; ?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-info"></i> </a>
<a href="javascript:deleteProfile(<?php echo $idspProfiles; ?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>

</td>
</tr><?php
}
}else { ?>
<tr>
<td height="20">No User/ Admin Added Yet</td>
</tr>
<?php 
} //end while ?>

</tbody>

</table>
</div><!-- /.box-body -->


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
