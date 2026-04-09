<div class="table-responsive">
 <table id="example" class="table table-striped table-bordered dashVdo" style="width:100% ;border-collapse: collapse;">
<thead>
<tr>

<th>Project Name</th>
<th>Total Bids</th>
<th>Bid Price ($)</th>
<th>Expire Date</th>
<th>Created Date</th>
<?php if($_GET['business']==$_SESSION['pid']){ ?>
<th class="action" >Action</th>
<?php } ?>
</tr>
</thead>
<tbody>

<?php
// $p = new _postings;
$st= new _spuser;
$st1=$st->readdatabybuyerid($_SESSION['uid']);
if($st1!=false){
$stt=mysqli_fetch_assoc($st1);
$account_status=$stt['deactivate_status'];
}
$sf  = new _freelancerposting; 

// print_r($_SESSION['pid']);

// $res = $p->client_publicpost(5, $_SESSION['pid']);


$res = $sf->client_publicpost1(5, $_GET['business']); 

//$res = $sf->clientbid_publicpost_posting(5, $_SESSION['pid']);
//echo $res->num_rows;
//echo $sf->ta->sql;
?>

<?php
//if($account_status!=1){
$i = 1;
if($res!=false){
//echo 1;
while($row = mysqli_fetch_assoc($res)){
$dt = new DateTime($row['spPostingExpDt']);
//echo $row['spPostingExpDt'];
$cr = new DateTime($row['spPostingDate']);

//   echo "<pre>";
//   print_r($row);exit;

// $pf = new _postfield;
//$result_pf = $pf->totalbids($row['idspPostings']);

$sfbid = new  _freelance_placebid;

// $respos = $pos->totalbids($_GET['project']);

//$respos = $sfbid->totalbids1($_GET['project']);
// $bids = $po->totalbids($_GET['project']);

$bids = $sfbid->totalbids1($row['idspPostings']);
//print_r($bids);
//echo $sf->ta->sql;
if($bids){
$totalbids = $bids->num_rows;
}else{
$totalbids = 0;
}
//echo date('Y-m-d');
?>

<?php  if($row['spPostingExpDt'] > date('Y-m-d')){
//echo 2;
?>
<tr>



<td > <a href="<?php echo $BaseUrl.'/freelancer/project-detail.php?project='.$row['idspPostings'];?>" target="_blank" class=" freelancer_capitalize"><?php echo $row['spPostingTitle'];?></a>

<!-- <a href="javascript:void(0)" class="red freelancer_capitalize"  ><?php echo $row['spPostingTitle'];?></a> -->


</td>
<td ><?php echo $totalbids;?></td>
<td><?php echo  $row['Default_Currency'].' '.$row['spPostingPrice'];?></td>
<td><?php echo $dt->format('M d, Y'); ?></td>
<td><?php echo $cr->format('M d, Y'); ?></td>
<?php if($_GET['business']==$_SESSION['pid']){ ?>
<td style="text-align:left;">
<a href="<?php echo $BaseUrl.'/post-ad/freelancer/?postid='.$row['idspPostings'];?>" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn btn-xs menu-icon vd_bg-yellow"> <i class="fa fa-pencil" ></i> </a>

<a href="<?php echo $BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$row['idspPostings'];?>" data-original-title="View Detail" data-toggle="tooltip" data-placement="top" class="btn btn-xs menu-icon vd_bg-red"> <i class="fa fa-eye" ></i> </a>

<?php
// if ($sppostingscommentstatus == 1) {
//     ?>
<a onclick="deactivate(<?php echo $row['idspPostings'];?>)" data-original-title="De-active" data-toggle="tooltip" data-placement="top" class="btn btn-xs menu-icon vd_bg-blue" id="deact<?php echo $row['idspPostings']; ?>"><i class="fa fa-ban" ></i></a>
<?php
// }else{
//     ?>
<a onclick="activate(<?php echo $row['idspPostings'];?>)" data-original-title="Activate" data-toggle="tooltip" data-placement="top" class="btn btn-xs menu-icon vd_bg-blue" id="act<?php echo $row['idspPostings']; ?>"><i class="fa fa-unlock " ></i></a>
<?php
// }
?>

<!-- <a href="<?php //echo $BaseUrl.'/freelancer/dashboard/project-bid.php?postid='.$row['idspPostings'];?>" class="red" >View Detail</a> -->




</td><?php } ?>
</tr>



<?php 

}
$i++;
}
//}

}else{
echo "<td colspan='6'><center>No Record Found</center></td>";
}

?>


</tbody>
</table>
</div>

<script>
var table = $('#example1').DataTable({
select: false,
"columnDefs": [{
className: "Name",
"targets": [0],
"visible": false,
"searchable": false
}]
});

function deactivate(visible) {
//alert(visible);

$.ajax({
type: "POST",
url: "deactive.php",
cache: false,
data: {
'visible': visible
},

success: function(data) {
$("#deact" + visible).addClass("disabled");
$("#act" + visible).removeClass("disabled");

}
});

}

function activate(visible) {
//alert(visible);

$.ajax({
type: "POST",
url: "activate.php",
cache: false,
data: {
'visible': visible
},

success: function(data) {
//$("#dash"+visible).attr("disabled");
$("#act" + visible).addClass("disabled");
$("#deact" + visible).removeClass("disabled");

}
});

}
setTimeout(function() {
$("#div4").hide();
}, 2000);

</script>

