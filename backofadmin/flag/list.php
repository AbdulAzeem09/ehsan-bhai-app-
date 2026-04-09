<?php
if (!defined('WEB_ROOT')) {
exit;
}


if (isset($_GET['catId']) && $_GET['catId'] > 0) {
$catid = $_GET['catId'];
$sql =  "SELECT * FROM flagpost WHERE spCategory_idspCategory = $catid AND flag_status = 0";
//echo $sql;
$result  = dbQuery($dbConn, $sql);

}else{
redirect('index.php?catId=1');
}

if ($catid == 1) {
$title  = "Flag Post <small>[Store]</small>";
}else if($catid == 5){
$title = "Flag Post <small>[Freelance]</small>";



}else if($catid == 2){
$title = "Flag Post <small>[Job Board]</small>";
}else if($catid == 3){
$title = "Flag Post <small>[Real Estate]</small>";
}else if($catid == 9){
$title = "Flag Post <small>[Event]</small>";
}else if($catid == 16){
$title = "Flag Post <small>[Group Event]</small>";
}else if($catid == 13){
$title = "Flag Post <small>[Art Gallery]</small>";
}else if($catid == 14){
$title = "Flag Post <small>[Music]</small>";
}else if($catid == 10){
$title = "Flag Post <small>[Videos]</small>";
}else if($catid == 8){
$title = "Flag Post <small>[Trainings]</small>";
}else if($catid == 7){
$title = "Flag Post <small>[Classified Ads]</small>";
}else{
$title = "";
}


?>

<!-- Content Header (Page header) -->
<section class="content-header top_heading">
<!--<a href="#">Disable Job</a> &nbsp&nbsp&nbsp
<a href="#">Warning Poster</a> &nbsp&nbsp&nbsp
<a href="#">Warning Flaggers</a> &nbsp&nbsp&nbsp
<a href="#">Disable Accounts</a> &nbsp&nbsp&nbsp-->
<h1><?php echo $title; ?></h1>
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

<?php if($_GET['catId'] == 1){?>
<div class="box-body" >
<div class="table-responsive tbl-respon">
<table id="example1" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th>ID</th>
<th>Why Flag</th>
<th>Dscription</th>
<th>Post Title</th>
<!--<th>Flag Count</th>-->
<th>Flager Name</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
if ($result) {
$i = 1;
while ($row = dbFetchAssoc($result)) {
// echo"<pre>";
//print_r($row);
//extract($row);
extract($row);

//$sql1 =  "SELECT * FROM  spproduct  AS t where spCategories_idspCategory = $catid AND idspPostings = ".$spPosting_idspPosting;
$sql1 =  "SELECT * FROM  spproduct  where  idspPostings = ".$spPosting_idspPosting;


// echo $sql1;
$result1  = dbQuery($dbConn, $sql1);

$row1 = dbFetchAssoc($result1);
$counts = 0;
//   echo"<pre>";
//print_r($row1);
//extract($row);
if(!empty($row1['spProfiles_idspProfiles'])) {
$count = "SELECT COUNT('profileid') as flagecount FROM flagged_jobprofile where profileid = ".$row1['spProfiles_idspProfiles']; 
$counts  = dbQuery($dbConn, $count);	
}

?>
<tr>
<td class="text-center"><?php echo $i; ?></td>
<td><?php echo $why_flag; ?></td>
<td><?php echo $flag_desc;?></td>
<td style="text-transform: capitalize;">
<a href="/retail/detail.php?catid=1&pid=<?php echo $row1['idspPostings']; ?>"><?php echo @ $row1['spPostingTitle'];?></a>
</td>
<!--<td>
<?php //echo $counts->num_rows; ?>
</td>-->
<td>
<a href="/friends/?profileid=<?php echo $row['spProfile_idspProfile']; ?>"><?php 
showProfileName($dbConn, $spProfile_idspProfile);
?></a>
<td><?php echo $row['flag_date']; ?></td>
</td>
<td class="menu-action text-center">

<!--<a href="javascript:deactivepost(<?php echo $spPosting_idspPosting; ?>)" data-toggle="tooltip" title="" class="btn menu-icon vd_bg-red" data-original-title="Deactive This Post"><i class="fa fa-ban"></i></a>-->

<!--<a href="javascript:void(0);" data-toggle="tooltip" title="" class=" deactive-btn btn menu-icon vd_bg-red" data-work="deactive" data-Id="<?php echo $spPosting_idspPosting; ?>" data-catid = "<?php  echo $catid; ?>" data-original-title="Deactive This Post"><i class="fa fa-ban"></i></a>-->

<a href="javascript:void(0);" class="deactive-btn" data-work="deactive" data-Id="<?php echo $row1['idspPostings'];?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:#f85d2c; border-radius:4px;"><i style="color: white;" class="fa fa-ban disable-btn" data-disableId=""></i></a> 

<a href="javascript:void(0);" class="disable-btn" data-work="delete" data-Id="<?php echo $row1['idspPostings'];?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:red; border-radius:4px;"><i style="color: white;" class="fa fa-times disable-btn" data-disableId=""></i></a> 

<!--<a href="deleteflag.php(<?php echo $catid.', '.$row1['idspPostings']; ?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>-->

<!--<a href="javascript:void(0);" class="disable-btn" data-work="delete" data-Id="<?php echo $row1['idspPostings'];?>" data-catid = "<?php  echo $catid; ?>" data-original-title="Delete" data-toggle="tooltip"  data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times disable-btn"></i> </a>-->

<a href="javascript:detail(<?php echo $catid.', '.$flag_id;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-info"></i> </a>

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



<?php } ?>

<?php if($_GET['catId'] == 2){?>
<div class="box-body" >
<div class="table-responsive tbl-respon">
<table id="example22" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th>ID</th>
<th>Why Flag</th>
<th>Dscription</th>
<th>Post Title</th>

<th>Flager Name</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
if ($result) {
$i = 1;
while ($row = dbFetchAssoc($result)) {
// echo"<pre>";
//print_r($row);
//extract($row);
extract($row);

//$sql1 =  "SELECT * FROM  spproduct  AS t where spCategories_idspCategory = $catid AND idspPostings = ".$spPosting_idspPosting;
$sql1  =  "SELECT *,COUNT(*) as Count FROM flagtimelinepost  INNER JOIN sppostings ON flagtimelinepost.spPosting_idspPosting=sppostings.idspPostings where flagtimelinepost.flag_status=0 GROUP BY
flagtimelinepost.spPosting_idspPosting";


// echo $sql1;
$result1  = dbQuery($dbConn, $sql1);

$row1 = dbFetchAssoc($result1);
$counts = 0;
//   echo"<pre>";
//print_r($row1);
//extract($row);
if(!empty($row1['spProfiles_idspProfiles'])) {
$count = "SELECT COUNT('spProfile_idspProfile') as flagecount FROM flagpost where spProfile_idspProfile = ".$row1['spProfiles_idspProfiles']; 
$counts  = dbQuery($dbConn, $count);	
}

?>
<tr>
<td class="text-center"><?php echo $i; ?></td>
<td><?php echo $why_flag; ?></td>
<td><?php echo substr($flag_desc,0,20).'....';?></td>




<td style="text-transform: capitalize;">
<?php 
$sql2 =  "SELECT * FROM  spjobboard  where  idspPostings = ".$row['spPosting_idspPosting'];

// echo $sql1;
$result2  = dbQuery($dbConn, $sql2);

while ($row2 = dbFetchAssoc($result2)) {



?>
<a href="/job-board/job-detail.php?pid=<?php echo $row['spPosting_idspPosting']; ?>"><?php echo $row2['spPostingTitle']; }?></a>
</td>
<!--<td>
<?php //echo $counts->num_rows; ?>
</td>-->
<td>
<a href="/friends/?profileid=<?php echo $row['spProfile_idspProfile']; ?>"><?php 
showProfileName($dbConn, $spProfile_idspProfile);
?></a>
</td>
<td><?php echo $row['flag_date']; ?></td>
<td class="menu-action text-center">

<a href="javascript:void(0);" class="deactive-btn" data-work="deactive" data-Id="<?php echo $row['spPosting_idspPosting'];?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:#f85d2c; border-radius:4px;"><i style="color: white;" class="fa fa-ban disable-btn" data-disableId=""></i></a> 

<!--<a href="javascript:deactivepost(<?php echo $spPosting_idspPosting; ?>)" data-toggle="tooltip" title="" class="btn menu-icon vd_bg-red" data-original-title="Deactive This Post"><i class="fa fa-ban"></i></a>-->

<a href="javascript:void(0);" class="disable-btn" data-work="delete" data-Id="<?php echo $row['spPosting_idspPosting'];?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:red; border-radius:4px;"><i style="color: white;" class="fa fa-times disable-btn" data-disableId=""></i></a> 

<a href="javascript:detail(<?php echo $catid.', '.$flag_id;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-info"></i> </a>

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
<?php } ?>

<script type="text/javascript">

$(document).ready( function () {
var table2 = $('#example22').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

</script>	

<?php if($_GET['catId'] == 3){?>
<div class="box-body" >
<div class="table-responsive tbl-respon">
<table id="example3" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th>ID</th>
<th>Why Flag</th>
<th>Dscription</th>
<th>Post Title</th>
<!--<th>Flag Count</th>-->
<th>Flager Name</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
if ($result) {
$i = 1;
while ($row = dbFetchAssoc($result)) {
// echo"<pre>";
//print_r($row);
//extract($row);
extract($row);

//$sql1 =  "SELECT * FROM  spproduct  AS t where spCategories_idspCategory = $catid AND idspPostings = ".$spPosting_idspPosting;
$sql1  =  "SELECT *,COUNT(*) as Count FROM flagtimelinepost  INNER JOIN sppostings ON flagtimelinepost.spPosting_idspPosting=sppostings.idspPostings where flagtimelinepost.flag_status=0 GROUP BY
flagtimelinepost.spPosting_idspPosting";


// echo $sql1;
$result1  = dbQuery($dbConn, $sql1);

$row1 = dbFetchAssoc($result1);
$counts = 0;
//   echo"<pre>";
//print_r($row1);
//extract($row);
if(!empty($row1['spProfiles_idspProfiles'])) {
$count = "SELECT COUNT('spProfile_idspProfile') as flagecount FROM flagpost where spProfile_idspProfile = ".$row1['spProfiles_idspProfiles']; 
$counts  = dbQuery($dbConn, $count);	
}

?>
<tr>
<td class="text-center"><?php echo $i; ?></td>
<td><?php echo $why_flag; ?></td>
<td><?php echo $flag_desc;?></td>




<td style="text-transform: capitalize;">
<?php 
$sql2 =  "SELECT * FROM  sprealstate  where  idspPostings = ".$row['spPosting_idspPosting'];

// echo $sql1;
$result2  = dbQuery($dbConn, $sql2);

while ($row2 = dbFetchAssoc($result2)) {



?>
<a href="/real-estate/property-detail.php?pid=<?php echo $row['spPosting_idspPosting']; ?>"><?php echo $row2['spPostingTitle']; }?></a>
</td>
<!--<td>
<?php echo $counts->num_rows; ?>
</td>-->
<td>
<a href="/friends/?profileid=<?php echo $row['spProfile_idspProfile']; ?>"><?php 
showProfileName($dbConn, $spProfile_idspProfile);
?></a>
</td>
<td><?php echo $row['flag_date']; ?></td>
<td class="menu-action text-center">

<a href="javascript:void(0);" class="deactive-btn" data-work="deactive" data-Id="<?php echo $row['spPosting_idspPosting'];?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:#f85d2c; border-radius:4px;"><i style="color: white;" class="fa fa-ban disable-btn" data-disableId=""></i></a> 

<!--<a href="javascript:deactivepost(<?php echo $spPosting_idspPosting; ?>)" data-toggle="tooltip" title="" class="btn menu-icon vd_bg-red" data-original-title="Deactive This Post"><i class="fa fa-ban"></i></a>-->

<a href="javascript:void(0);" class="disable-btn" data-work="delete" data-Id="<?php echo $row['spPosting_idspPosting'];?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:red; border-radius:4px;"><i style="color: white;" class="fa fa-times disable-btn" data-disableId=""></i></a> 

<a href="javascript:detail(<?php echo $catid.', '.$flag_id;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-info"></i> </a>

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
<?php } ?>

<script type="text/javascript">

$(document).ready( function () {
var table = $('#example3').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

</script>	


<?php if($_GET['catId'] == 5){?>
<div class="box-body" >
<div class="table-responsive tbl-respon">
<table id="example5" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th>ID</th>
<th>Why Flag</th>
<th>Dscription</th>
<th>Post Title</th>
<!--<th>Flag Count</th>-->
<th>Flager Name</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
if ($result) {
$i = 1;
while ($row = dbFetchAssoc($result)) {
// echo"<pre>";
//print_r($row);
//extract($row);
extract($row);

//$sql1 =  "SELECT * FROM  spproduct  AS t where spCategories_idspCategory = $catid AND idspPostings = ".$spPosting_idspPosting;
$sql1  =  "SELECT *,COUNT(*) as Count FROM flagtimelinepost  INNER JOIN sppostings ON flagtimelinepost.spPosting_idspPosting=sppostings.idspPostings where flagtimelinepost.flag_status=0 GROUP BY
flagtimelinepost.spPosting_idspPosting";


// echo $sql1;
$result1  = dbQuery($dbConn, $sql1);

$row1 = dbFetchAssoc($result1);
$counts = 0;
//   echo"<pre>";
//print_r($row1);
//extract($row);
if(!empty($row1['spProfiles_idspProfiles'])) {
$count = "SELECT COUNT('spProfile_idspProfile') as flagecount FROM flagpost where spProfile_idspProfile = ".$row1['spProfiles_idspProfiles']; 
$counts  = dbQuery($dbConn, $count);	
}

?>
<tr>
<td class="text-center"><?php echo $i; ?></td>
<td><?php echo $why_flag; ?></td>
<td><?php echo $flag_desc;?></td>




<td style="text-transform: capitalize;">
<?php 
$sql2 =  "SELECT * FROM  spfreelancer  where  idspPostings = ".$row['spPosting_idspPosting'];

// echo $sql1;
$result2  = dbQuery($dbConn, $sql2);

while ($row2 = dbFetchAssoc($result2)) {



?>
<a href="/freelancer/project-detail.php?project=<?php echo $row['spPosting_idspPosting']; ?>"><?php echo $row2['spPostingTitle']; }?></a>
</td>
<!--<td>
<?php echo $counts->num_rows; ?>
</td>-->
<td>
<a href="/friends/?profileid=<?php echo $row['spProfile_idspProfile']; ?>"><?php 
showProfileName($dbConn, $spProfile_idspProfile);
?></a>
</td>
<td><?php echo $row['flag_date']; ?></td>
<td class="menu-action text-center">

<a href="javascript:void(0);" class="deactive-btn" data-work="deactive" data-Id="<?php echo $row['spPosting_idspPosting'];?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:#f85d2c; border-radius:4px;"><i style="color: white;" class="fa fa-ban disable-btn" data-disableId=""></i></a> 

<!--<a href="javascript:deactivepost(<?php echo $spPosting_idspPosting; ?>)" data-toggle="tooltip" title="" class="btn menu-icon vd_bg-red" data-original-title="Deactive This Post"><i class="fa fa-ban"></i></a>-->

<a href="javascript:void(0);" class="disable-btn" data-work="delete" data-Id="<?php echo $row['spPosting_idspPosting'];?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:red; border-radius:4px;"><i style="color: white;" class="fa fa-times disable-btn" data-disableId=""></i></a> 

<a href="javascript:detail(<?php echo $catid.', '.$flag_id;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-info"></i> </a>

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
<?php } ?>

<script type="text/javascript">

$(document).ready( function () {
var table = $('#example5').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

</script>	

<?php if($_GET['catId'] == 9){?>
<div class="box-body" >
<div class="table-responsive tbl-respon">
<table id="example9" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th>ID</th>
<th>Why Flag</th>
<th>Dscription</th>
<th>Post Title</th>
<!--<th>Flag Count</th>-->
<th>Flager Name</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
if ($result) {
$i = 1;
while ($row = dbFetchAssoc($result)) {
// echo"<pre>";
//print_r($row);
//extract($row);
extract($row);

//$sql1 =  "SELECT * FROM  spproduct  AS t where spCategories_idspCategory = $catid AND idspPostings = ".$spPosting_idspPosting;
$sql1  =  "SELECT *,COUNT(*) as Count FROM flagtimelinepost  INNER JOIN sppostings ON flagtimelinepost.spPosting_idspPosting=sppostings.idspPostings where flagtimelinepost.flag_status=0 GROUP BY
flagtimelinepost.spPosting_idspPosting";


// echo $sql1;
$result1  = dbQuery($dbConn, $sql1);

$row1 = dbFetchAssoc($result1);
$counts = 0;
//   echo"<pre>";
//print_r($row1);
//extract($row);
if(!empty($row1['spProfiles_idspProfiles'])) {
$count = "SELECT COUNT('spProfile_idspProfile') as flagecount FROM flagpost where spProfile_idspProfile = ".$row1['spProfiles_idspProfiles']; 
$counts  = dbQuery($dbConn, $count);	
}

?>
<tr>
<td class="text-center"><?php echo $i; ?></td>
<td><?php echo $why_flag; ?></td>
<td><?php echo $flag_desc;?></td>




<td style="text-transform: capitalize;">
<?php 
$sql2 =  "SELECT * FROM  spevent  where  idspPostings = ".$row['spPosting_idspPosting'];

// echo $sql1;
$result2  = dbQuery($dbConn, $sql2);

while ($row2 = dbFetchAssoc($result2)) {



?>
<a href="/events/detail.php?postid=<?php echo $row['spPosting_idspPosting']; ?>"><?php echo $row2['spPostingTitle']; }?></a>
</td>
<!--<td>
<?php //echo $counts->num_rows; ?>
</td>-->
<td>
<a href="/friends/?profileid=<?php echo $row['spProfile_idspProfile']; ?>"><?php 
showProfileName($dbConn, $spProfile_idspProfile);
?></a>
</td>
<td><?php echo $row['flag_date']; ?></td>
<td class="menu-action text-center">

<a href="javascript:void(0);" class="deactive-btn" data-work="deactive" data-Id="<?php echo $row['spPosting_idspPosting'];?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:#f85d2c; border-radius:4px;"><i style="color: white;" class="fa fa-ban disable-btn" data-disableId=""></i></a> 

<!--<a href="javascript:deactivepost(<?php echo $spPosting_idspPosting; ?>)" data-toggle="tooltip" title="" class="btn menu-icon vd_bg-red" data-original-title="Deactive This Post"><i class="fa fa-ban"></i></a>-->

<a href="javascript:void(0);" class="disable-btn" data-work="delete" data-Id="<?php echo $row['spPosting_idspPosting'];?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:red; border-radius:4px;"><i style="color: white;" class="fa fa-times disable-btn" data-disableId=""></i></a> 

<a href="javascript:detail(<?php echo $catid.', '.$flag_id;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-info"></i> </a>

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
<?php } ?>

<script type="text/javascript">

$(document).ready( function () {
var table = $('#example9').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

</script>	

<?php if($_GET['catId'] == 8){?>
<div class="box-body" >
<div class="table-responsive tbl-respon">
<table id="example8" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th>ID</th>
<th>Why Flag</th>
<th>Dscription</th>
<th>Post Title</th>
<!--<th>Flag Count</th>-->
<th>Flager Name</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
if ($result) {
$i = 1;
while ($row = dbFetchAssoc($result)) {
// echo"<pre>";
//print_r($row);
//extract($row);
extract($row);

//$sql1 =  "SELECT * FROM  spproduct  AS t where spCategories_idspCategory = $catid AND idspPostings = ".$spPosting_idspPosting;
$sql1  =  "SELECT *,COUNT(*) as Count FROM flagtimelinepost  INNER JOIN sppostings ON flagtimelinepost.spPosting_idspPosting=sppostings.idspPostings where flagtimelinepost.flag_status=0 GROUP BY
flagtimelinepost.spPosting_idspPosting";


// echo $sql1;
$result1  = dbQuery($dbConn, $sql1);

$row1 = dbFetchAssoc($result1);
$counts = 0;
//   echo"<pre>";
//print_r($row1);
//extract($row);
if(!empty($row1['spProfiles_idspProfiles'])) {
$count = "SELECT COUNT('spProfile_idspProfile') as flagecount FROM flagpost where spProfile_idspProfile = ".$row1['spProfiles_idspProfiles']; 
$counts  = dbQuery($dbConn, $count);	
}

?>
<tr>
<td class="text-center"><?php echo $i; ?></td>

<td><?php echo $why_flag; ?></td>
<td><?php echo $flag_desc;?></td>




<td style="text-transform: capitalize;">
<?php 
$sql2 =  "SELECT * FROM  sptraining  where  id = ".$row['spPosting_idspPosting'];

// echo $sql1;
$result2  = dbQuery($dbConn, $sql2);

while ($row2 = dbFetchAssoc($result2)) {



?>
<a href="/events/detail.php?postid=<?php echo $row['spPosting_idspPosting']; ?>"><?php echo $row2['spPostingTitle']; }?></a>
</td>
<!--<td>
<?php //echo $counts->num_rows; ?>
</td>-->
<td>
<a href="/friends/?profileid=<?php echo $row['spProfile_idspProfile']; ?>"><?php 
showProfileName($dbConn, $spProfile_idspProfile);
?></a>
</td>
<td><?php echo $row['flag_date']; ?></td>
<td class="menu-action text-center">

<a href="javascript:void(0);" class="deactive-btn" data-work="deactive" data-Id="<?php echo $row['spPosting_idspPosting'];?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:#f85d2c; border-radius:4px;"><i style="color: white;" class="fa fa-ban disable-btn" data-disableId=""></i></a> 

<!--<a href="javascript:deactivepost(<?php echo $spPosting_idspPosting; ?>)" data-toggle="tooltip" title="" class="btn menu-icon vd_bg-red" data-original-title="Deactive This Post"><i class="fa fa-ban"></i></a>-->

<a href="javascript:void(0);" class="disable-btn" data-work="delete" data-Id="<?php echo $row['spPosting_idspPosting'];?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:red; border-radius:4px;"><i style="color: white;" class="fa fa-times disable-btn" data-disableId=""></i></a> 

<a href="javascript:detail(<?php echo $catid.', '.$flag_id;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-info"></i> </a>

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
<?php } ?>

<script type="text/javascript">

$(document).ready( function () {
var table = $('#example8').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

</script>	


<?php if($_GET['catId'] == 13){   ?>
<div class="box-body" >
<div class="table-responsive tbl-respon">
<table id="example13" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th>ID</th>
<th>Why Flag</th>
<th>Dscription</th>
<th>Post Title</th>
<!--<th>Flag Count</th>-->
<th>Flager Name</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
if ($result) {
$i = 1;
while ($row = dbFetchAssoc($result)) {
//  echo"<pre>";
//print_r($row);
//extract($row);
extract($row);

//$sql1 =  "SELECT * FROM  flagpost  AS t where spCategories_idspCategory = $catid AND spProfile_idspProfile = ".$spPosting_idspPosting;
//$sql1 =  "SELECT * FROM  sprealstate  where  idspPostings = ".$spPosting_idspPosting;
$sql1  =  "SELECT *,COUNT(*) as Count FROM flagtimelinepost  INNER JOIN sppostings ON flagtimelinepost.spPosting_idspPosting=sppostings.idspPostings where flagtimelinepost.flag_status=0 GROUP BY
flagtimelinepost.spPosting_idspPosting";

//$sql1 =  "SELECT * FROM  sprealstate  where  idspPostings = ".$spPosting_idspPosting;
// echo $sql1;
$result1  = dbQuery($dbConn, $sql1);

$row1 = dbFetchAssoc($result1);
$counts = 0;
//   echo"<pre>";
//print_r($row1);
//extract($row);
if(!empty($row1['spProfiles_idspProfiles'])) {
$count = "SELECT COUNT('spProfile_idspProfile') as flagecount FROM flagpost where spProfile_idspProfile = ".$row1['spProfiles_idspProfiles']; 
$counts  = dbQuery($dbConn, $count);	
}

?>
<tr>
<td class="text-center"><?php echo $i; ?></td>
<td><?php echo $why_flag; ?></td>
<td><?php echo $flag_desc;?></td>


<td style="text-transform: capitalize;">
<?php 
$sql2 =  "SELECT * FROM  sppostingsartcraft  where  idspPostings = ".$row['spPosting_idspPosting'];

// echo $sql1;
$result2  = dbQuery($dbConn, $sql2);

while ($row2 = dbFetchAssoc($result2)) {




?>
<a href="/artandcraft/detail.php?pid=<?php echo $row2['idspPostings']; ?>"><?php echo $row2['spPostingTitle'];  } ?></a>
</td>
<!--<td>
<?php //echo $counts->num_rows; ?>
</td>-->
<td>
<a href="/friends/?profileid=<?php echo $row['spProfile_idspProfile']; ?>"><?php 
showProfileName($dbConn, $spProfile_idspProfile);
?></a>
</td>
<td><?php echo $row['flag_date']; ?></td>
<td class="menu-action text-center">

<a href="javascript:void(0);" class="deactive-btn" data-work="deactive" data-Id="<?php echo $row2['idspPostings'];?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:#f85d2c; border-radius:4px;"><i style="color: white;" class="fa fa-ban disable-btn" data-disableId=""></i></a> 


<!--<a href="javascript:deactivepost(<?php echo $spPosting_idspPosting; ?>)" data-toggle="tooltip" title="" class="btn menu-icon vd_bg-red" data-original-title="Deactive This Post"><i class="fa fa-ban"></i></a>-->

<a href="javascript:void(0);" class="disable-btn" data-work="delete" data-Id="<?php echo $row2['idspPostings']; ?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:red; border-radius:4px;"><i style="color: white;" class="fa fa-times disable-btn" data-disableId=""></i></a> 

<a href="javascript:detail(<?php echo $catid.', '.$flag_id;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-info"></i> </a>

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
<?php  }?>

<script type="text/javascript">

$(document).ready( function () {
var table = $('#example13').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

</script>	
<!--- End Table ---------------->

<?php if($_GET['catId'] == 10){   ?>
<div class="box-body" >
<div class="table-responsive tbl-respon">
<table id="example10" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th>ID</th>
<th>Why Flag</th>
<th>Dscription</th>
<th>Post Title</th>
<!--<th>Flag Count</th>-->
<th>Flager Name</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
if ($result) {
$i = 1;
while ($row = dbFetchAssoc($result)) {
// echo"<pre>";
//print_r($row);
//extract($row);
extract($row);

//$sql1 =  "SELECT * FROM  flagpost  AS t where spCategories_idspCategory = $catid AND spProfile_idspProfile = ".$spPosting_idspPosting;
//$sql1 =  "SELECT * FROM  sprealstate  where  idspPostings = ".$spPosting_idspPosting;
$sql1  =  "SELECT *,COUNT(*) as Count FROM flagtimelinepost  INNER JOIN sppostings ON flagtimelinepost.spPosting_idspPosting=sppostings.idspPostings where flagtimelinepost.flag_status=0 GROUP BY
flagtimelinepost.spPosting_idspPosting";


// echo $sql1;
$result1  = dbQuery($dbConn, $sql1);

$row1 = dbFetchAssoc($result1);
$counts = 0;
//   echo"<pre>";
//print_r($row1);
//extract($row);
if(!empty($row1['spProfiles_idspProfiles'])) {
$count = "SELECT COUNT('spProfile_idspProfile') as flagecount FROM flagpost where spProfile_idspProfile = ".$row1['spProfiles_idspProfiles']; 
$counts  = dbQuery($dbConn, $count);	
}

?>
<tr>
<td class="text-center"><?php echo $i; ?></td>
<td><?php echo $why_flag; ?></td>
<td><?php echo $flag_desc;?></td>


<td style="text-transform: capitalize;">
<?php 

//echo $row['spPosting_idspPosting'];
$sql2 =  "SELECT * FROM  spvideo  where  video_id = ".$row['spPosting_idspPosting'];

// echo $sql1;
$result2  = dbQuery($dbConn, $sql2);

while ($row2 = dbFetchAssoc($result2)) {



?>
<a href="/videos/watch.php?video_id=<?php echo $row['spPosting_idspPosting']; ?>"><?php echo $row2['video_title']; }?></a>
</td>
<!--<td>
<?php //echo $counts->num_rows; ?>
</td>-->
<td>
<a href="/friends/?profileid=<?php echo $row['spProfile_idspProfile']; ?>"><?php 
showProfileName($dbConn, $spProfile_idspProfile);
?></a>
</td>
<td><?php echo $row['flag_date']; ?></td>
<td class="menu-action text-center">

<a href="javascript:void(0);" class="deactive-btn" data-work="deactive" data-Id="<?php echo $row['spPosting_idspPosting'];?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:#f85d2c; border-radius:4px;"><i style="color: white;" class="fa fa-ban disable-btn" data-disableId=""></i></a> 

<!--<a href="javascript:deactivepost(<?php echo $spPosting_idspPosting; ?>)" data-toggle="tooltip" title="" class="btn menu-icon vd_bg-red" data-original-title="Deactive This Post"><i class="fa fa-ban"></i></a>-->

<a href="javascript:void(0);" class="disable-btn" data-work="delete" data-Id="<?php echo $row['spPosting_idspPosting'];?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:red; border-radius:4px;"><i style="color: white;" class="fa fa-times disable-btn" data-disableId=""></i></a> 

<a href="javascript:detail(<?php echo $catid.', '.$flag_id;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-info"></i> </a>

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
<?php } ?>

<script type="text/javascript">

$(document).ready( function () {
var table = $('#example10').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

</script>	

<?php if($_GET['catId'] == 7){   ?>
<div class="box-body" >
<div class="table-responsive tbl-respon">
<table id="example7" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>
<th>ID</th>
<th>Why Flag</th>
<th>Dscription</th>
<th>Post Title</th>
<!--<th>Flag Count</th>-->
<th>Flager Name</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
if ($result) {
$i = 1;
while ($row = dbFetchAssoc($result)) {
// echo"<pre>";
//print_r($row);
//extract($row);
extract($row);

//$sql1 =  "SELECT * FROM  flagpost  AS t where spCategories_idspCategory = $catid AND spProfile_idspProfile = ".$spPosting_idspPosting;
//$sql1 =  "SELECT * FROM  sprealstate  where  idspPostings = ".$spPosting_idspPosting;
$sql1  =  "SELECT *,COUNT(*) as Count FROM flagtimelinepost  INNER JOIN sppostings ON flagtimelinepost.spPosting_idspPosting=sppostings.idspPostings where flagtimelinepost.flag_status=0 GROUP BY
flagtimelinepost.spPosting_idspPosting";


// echo $sql1;
$result1  = dbQuery($dbConn, $sql1);

$row1 = dbFetchAssoc($result1);
$counts = 0;
//   echo"<pre>";
//print_r($row1);
//extract($row);
if(!empty($row1['spProfiles_idspProfiles'])) {
$count = "SELECT COUNT('spProfile_idspProfile') as flagecount FROM flagpost where spProfile_idspProfile = ".$row1['spProfiles_idspProfiles']; 
$counts  = dbQuery($dbConn, $count);	
}

?>
<tr>
<td class="text-center"><?php echo $i; ?></td>
<td><?php echo $why_flag; ?></td>
<td><?php echo $flag_desc;?></td>
<td style="text-transform: capitalize;">
<?php 
//echo $row['spPosting_idspPosting'];
$sql2 =  "SELECT * FROM  spclassified  where  idspPostings = ".$row['spPosting_idspPosting'];
// echo $sql1;
$result2  = dbQuery($dbConn, $sql2);
while ($row2 = dbFetchAssoc($result2)) {
?>
<a href="/services/detail.php?postid=<?php echo $row['spPosting_idspPosting']; ?>"><?php echo $row2['spPostingTitle']; }?></a>
</td>
<!--<td>
<?php //echo $counts->num_rows; ?>
</td>-->
<td>
<a href="/friends/?profileid=<?php echo $row['spProfile_idspProfile']; ?>"><?php 
showProfileName($dbConn, $row['spProfile_idspProfile']);
?></a>
</td>
<td><?php echo $row['flag_date']; ?></td>
<td class="menu-action text-center">

<a href="javascript:void(0);" class="deactive-btn" data-work="deactive" data-Id="<?php echo $row['spPosting_idspPosting'];?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:#f85d2c; border-radius:4px;"><i style="color: white;" class="fa fa-ban disable-btn" data-disableId=""></i></a> 

<!--<a href="javascript:deactivepost(<?php echo $spPosting_idspPosting; ?>)" data-toggle="tooltip" title="" class="btn menu-icon vd_bg-red" data-original-title="Deactive This Post"><i class="fa fa-ban"></i></a>-->

<a href="javascript:void(0);" class="disable-btn" data-work="delete" data-Id="<?php echo $row['spPosting_idspPosting'];?>" data-catid = "<?php  echo $catid; ?>"  class="btn menu-icon vd_bg-red" style ="background-color:red; border-radius:4px;"><i style="color: white;" class="fa fa-times disable-btn" data-disableId=""></i></a> 


<a href="javascript:detail(<?php echo $catid.', '.$flag_id;?>)" data-original-title="Detail" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-info"></i> </a>

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
<?php } ?>

<script type="text/javascript">

$(document).ready( function () {
var table = $('#example7').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );



} );

</script>	
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

<script type="text/javascript">
$(document).ready(function(){
$(document).on("click",".disable-btn",function() {
var dataId = $(this).attr("data-id");
var cat_id = $(this).attr("data-catId");
var work = $(this).attr("data-work");
//alert(work);
if(work=='deactive'){
swal({
title: "Do You Want Deactive this Listing?",
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Deactive!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = '/dashboard/portfolio/delete_port.php?id=' +dataId+'&work='+work;
} 
});

}	
if(work=='delete'){
swal({
title: "Do You Want Delete this Listing?",
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Delete!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = 'deleteflag.php?id=' +dataId+'&work='+work+'&cat_id='+cat_id;
} 
});
}	

// alert(dataId);
});
});


</script>

<script type="text/javascript">
$(document).ready(function(){
$(document).on("click",".deactive-btn",function() {
var dataId = $(this).attr("data-id");
var cat_id = $(this).attr("data-catId");
var work = $(this).attr("data-work");
//alert(work);
if(work=='deactive'){
swal({
title: "Do You Want Deactive this Listing?",
/*text: "You Want to Logout!",*/
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes, Deactive!",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "Cancel",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
window.location.href = '/backofadmin/flag/deactivepost.php?id=' +dataId+'&work='+work+'&catId='+cat_id;
} 
});

}	


// alert(dataId);
});
});


</script>