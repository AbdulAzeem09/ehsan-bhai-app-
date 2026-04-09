<?php
error_reporting(E_ERROR | E_PARSE);

?>
<style>
body {font-family: Arial;}

/* Style the tab */
.tab {
overflow: hidden;
border: 1px solid #ccc;
background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
background-color: inherit;
float: left;
border: none;
outline: none;
cursor: pointer;
padding: 14px 16px;
transition: 0.3s;
font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
display:none;
padding: 6px 12px;
border: 1px solid #ccc;
border-top: none;
}
</style>


<div class="container">
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
<div class="modal-dialog">

<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Modal Header</h4>
</div>
<div class="modal-body">
<p>Some text in the modal.</p>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</div>

</div>
</div>

</div>
<?php
if (!defined('WEB_ROOT')) {
exit;
}


// custom pagignation
//$result     = dbQuery($dbConn, getPagingQuery($sql, $rowsPerPage));
//$pagingLink = getPagingLink($dbConn, $sql, $rowsPerPage);


//$query2="SELECT * FROM rss_data WHERE seller_userid='$selectname' AND date_txn BETWEEN '$sdate' AND '$edate'";

// $result=dbQuery($dbConn, $query2);

//$roww2=mysqli_fetch_assoc($ress2);
if(isset($_GET['status']) &&($_GET['status']!='')){
$rss_id=$_GET['id'];

$status=$_GET['status'];
$sql5="UPDATE `rss_data` SET `rss_status`=$status WHERE rss_id=$rss_id";


dbQuery($dbConn, $sql5);
}

$rowsPerPage = 25;
$sql		=	"SELECT * FROM rss_data";
$result = dbQuery($dbConn, $sql);

?>

<!-- Content Header (Page header) -->
<section class="content-header">
<?php
if($_GET['msg']=='update')
{
?>
<div class="alert alert-success" role="alert">
Update channel successfully
</div>
<?php
}
?>
<h1>Channel Request<small>[List]</small></h1>

</section>



<div class="tab">
<a class="btn btn-success"> <button class="tablinks" onclick="openCity(event, 'London')">Accepted</button></a>
<a class="btn btn-danger"><button class="tablinks" onclick="openCity(event, 'Paris')">Rejected</button></a>
<a class="btn btn-info"><button class="tablinks" onclick="openCity(event, 'Tokyo')">Pending</button></a>
</div>

<div id="London" class="tabcontent box box-success"style="display:block">
<h3>Accepted</h3>
<div class="box-body" >
<div class="table-responsive tbl-respon">
<table id="example1" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>


<th>User Name</th>
<th>Website Name</th>
<th>Website Link</th>
<th> News Type </th>
<th>Country</th> 
<th>State</th>
<th>Category</th>

<th>Created At</th>

</tr>
</thead>
<tbody>
<?php 

$sql="select*from rss_data where rss_status=1";
$result = dbQuery($dbConn, $sql);
while($row11=mysqli_fetch_assoc($result))

{
?>
<tr>
<td><?php $pid= $row11['pid'];
$sql2		=	"SELECT * FROM spprofiles WHERE idspProfiles =$pid"; 
//echo $sql2;
//die;

$result2 = dbQuery($dbConn, $sql2);

$row12=mysqli_fetch_assoc($result2);

//print_r($row12);
//die;




?>
<a href="<?php $BaseUrl; ?>/friends/?profileid=<?php echo $pid;?>"><?php echo $row12['spProfileName']; ?></a>
</td>
<td><?php echo $row11['website_name'];?></td>
<td>
<?php 
$str= $row11['website_link'];
if (str_contains($str, 'https://')) {
$str1 = substr($str, 8);
$variable = substr($str1, 0, strpos($str1, "/"));?>
<?php
?> https://<?php echo $variable;

}
else{
$str = substr($str, 0, strpos($str, "/"));
echo  $str;
}




?>

</td>

<td><?php echo $row11['news_type'];?></td>
<td><?php $cid=$row11['country'];
$sql3	=	"SELECT * FROM  tbl_country WHERE country_id = $cid";

$result3 = dbQuery($dbConn, $sql3);

$row13=mysqli_fetch_assoc($result3);
echo $row13['country_title'];

?></td>
<td>
<?php $ids=$row11['news_State'];

$sql5	=	"SELECT * FROM  tbl_state WHERE state_id = $ids";

$result5 = dbQuery($dbConn, $sql5);
if( $result5!=false)
$row15=mysqli_fetch_assoc($result5);
echo $row15['state_title'];




?>
</td>
<td><?php $id=$row11['category'];





$sql4	=	"SELECT * FROM  news_categories WHERE id = $id";

$result4 = dbQuery($dbConn, $sql4);

$row14=mysqli_fetch_assoc($result4);
echo $row14['name'];




?></td>
<?php $status= $row11['rss_status'];


?> 
<td><?php echo $row11['created_at'];?></td>


</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>

<div id="Paris" class="tabcontent box box-success">
<h3>Rejected</h3>
<div class="box-body">
<div class="table-responsive tbl-respon">
<table id="example3" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>


<th>User Name</th>
<th>Website Name</th>
<th>Website Link</th>
<th> News Type </th>
<th>Country</th>  
<th> State</th>							
<th>Category</th>

<th>Created At</th>

</tr>
</thead>
<tbody>
<?php 

$sql="select*from rss_data where rss_status=2";
$result = dbQuery($dbConn, $sql);
while($row11=mysqli_fetch_assoc($result))

{
?>
<tr>
<td><?php $pid= $row11['pid'];

$sql2		=	"SELECT * FROM spprofiles WHERE idspProfiles =$pid"; 
//echo $sql2;
//die;

$result2 = dbQuery($dbConn, $sql2);

$row12=mysqli_fetch_assoc($result2);
//print_r($row12);
//die;




?>
<a href="<?php $BaseUrl; ?>/friends/?profileid=<?php echo $pid;?>"><?php echo $row12['spProfileName']; ?></a>
</td>
<td><?php echo $row11['website_name'];?></td>
<td><?php echo $row11['website_link'];?></td>
<td><?php echo $row11['news_type'];?></td>
<td><?php $cid=$row11['country'];
$sql3	=	"SELECT * FROM  tbl_country WHERE country_id = $cid";

$result3 = dbQuery($dbConn, $sql3);

$row13=mysqli_fetch_assoc($result3);
echo $row13['country_title'];

?></td>
<td>
<?php $ids=$row11['news_State'];

$sql5	=	"SELECT * FROM  tbl_state WHERE state_id = $ids";

$result5 = dbQuery($dbConn, $sql5);
if( $result5!=false)
$row15=mysqli_fetch_assoc($result5);
echo $row15['state_title'];




?>
</td>
<td><?php $id=$row11['category'];





$sql4	=	"SELECT * FROM  news_categories WHERE id = $id";

$result4 = dbQuery($dbConn, $sql4);

$row14=mysqli_fetch_assoc($result4);
echo $row14['name'];




?></td>
<?php $status= $row11['rss_status'];



?>
<td><?php echo $row11['created_at'];?></td>

</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>

<div id="Tokyo" class="tabcontent box box-success">
<h3>Pending</h3>
<div class="box-body" >
<div class="table-responsive tbl-respon">
<table id="example4" class="table table-bordered table-striped tbl-respon2">
<thead>
<tr>


<th>User Name</th>
<th>Website Name</th>
<th>Website Link</th>
<th> News Type </th>
<th>Country</th>
<th>State</th>							
<th>Category</th>

<th>Created At</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php 

$sql="select*from rss_data where rss_status=3";
$result = dbQuery($dbConn, $sql);
while($row11=mysqli_fetch_assoc($result))

{
?>
<tr>
<td><?php $pid= $row11['pid'];
$sql2 ="SELECT * FROM spprofiles WHERE idspProfiles =$pid"; 
$result2 = dbQuery($dbConn, $sql2);
$row12=mysqli_fetch_assoc($result2);
?>
<a href="<?php $BaseUrl; ?>/friends/?profileid=<?php echo $pid;?>"><?php echo $row12['spProfileName']; ?></a>
</td>
<td><?php echo $row11['website_name'];?></td>
<td title="<?php echo $row11['website_link'];?>"><?php
echo (strlen($row11['website_link']) < 27) ? $row11['website_link'] : substr($row11['website_link'], 0, 25) . '...';
?>
</td>
<td><?php echo $row11['news_type'];?></td>
<td><?php $cid=$row11['country'];
$sql3	=	"SELECT * FROM  tbl_country WHERE country_id = $cid";
$result3 = dbQuery($dbConn, $sql3);

$row13=mysqli_fetch_assoc($result3);
echo $row13['country_title'];

?></td>
<td>
<?php $ids=$row11['news_State'];

$sql5	=	"SELECT * FROM  tbl_state WHERE state_id = $ids";

$result5 = dbQuery($dbConn, $sql5);
if( $result5!=false)
$row15=mysqli_fetch_assoc($result5);
echo $row15['state_title'];




?>
</td>
<td><?php $id=$row11['category'];





$sql4	=	"SELECT * FROM  news_categories WHERE id = $id";

$result4 = dbQuery($dbConn, $sql4);

$row14=mysqli_fetch_assoc($result4);
echo $row14['name'];




?></td>
<?php $status= $row11['rss_status'];



?>
<td><?php echo $row11['created_at'];?></td>
<?php if($status ==3){?>
<td><a  onclick="return confirm('Are you sure you want to Approve?');" href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/channelrequest/index.php?view=channellist&status=1&id=<?php echo $row11['rss_id'];?>" class="btn menu-icon vd_bg-blue">Approve</a>

<a onclick="return confirm('Are you sure you want to Reject?');" href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/channelrequest/index.php?view=channellist&status=2&id=<?php echo $row11['rss_id'];?>" class="btn menu-icon vd_bg-red" style="padding: 6px 18px;">Reject</a>

<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/channelrequest/index.php?view=editchannel&id=<?php echo $row11['rss_id'];?>"class="btn menu-icon vd_bg-green" style="padding: 6px 26px;">Edit </a>	

<!--	<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Edit</button></td>-->
<?php } else { ?>
<td>---</td>

<?php }  ?>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
<script>
function openCity(evt, cityName) {
var i, tabcontent, tablinks;
tabcontent = document.getElementsByClassName("tabcontent");
for (i = 0; i < tabcontent.length; i++) {
tabcontent[i].style.display = "none";
}
tablinks = document.getElementsByClassName("tablinks");
for (i = 0; i < tablinks.length; i++) {
tablinks[i].className = tablinks[i].className.replace(" active", "");
}
document.getElementById(cityName).style.display = "block";
evt.currentTarget.className += " active";
}
</script>



<script type="text/javascript">

$(document).ready( function () {
var table = $('#example1').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );


var table = $('#example4').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );
var table = $('#example3').DataTable( {

"order": [[ 0, "desc" ]],
pageLength : 10,
lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
} );




} );

</script>
