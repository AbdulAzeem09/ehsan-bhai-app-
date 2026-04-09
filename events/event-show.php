
<div class="table-responsive">
<table class="table table-striped EventTbl text-center">
<thead>
<tr>
<td>Time</td>
<!-- <td>Organizer</td> -->
<td>Event Name</td>
<td>Venue</td>
<td>Ticket</td>
</tr>
</thead>
<tbody >
<?php
if(isset($showtoday)){

$p      = new _spevent;
//$p      = new _postingview;
// $pf     = new _postfield;
//$res    = $p->publicpost($start, $_GET["categoryID"]);
$result = $p->showdailywiseevent($showtoday, $_GET['categoryID']);
//echo $p->ta->sql;
if($result != false){
while ($row = mysqli_fetch_assoc($result)) {
//print_r($row);
$venu = "";
$startDate = "";
$startTime    = "";
$endTime = "";
$OrganizerName = "";


$venu = $row['spPostingEventVenue'];
$startDate = $row['spPostingStartDate'];
$startTime = $row['spPostingStartTime'];
$endTime = $row['spPostingEndTime'];
$OrganizerName = $row['spPostingEventOrgName'];

$default_currency = $row['default_currency'];
$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);

$pf = new _spevent_transection;
//echo $row['idspPostings'];die('========');

//$pricedata1 = mysqli_fetch_assoc($result_pf);
//print_r($pricedata1);die;
//echo $pf->ta->sql."<br>";
$pdata = $pf->readprice($row['idspPostings']);
if ($pdata != false) {

$pricedata = mysqli_fetch_assoc($pdata);
$eventprice = $pricedata['event_price'];

//	echo $eventprice;
//$curr=$pricedata1['currency'];
}


//$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
/* if($result_pf){
$venu = "";
$startDate = "";
$startTime    = "";
$endTime = "";
$OrganizerName = "";
while ($row2 = mysqli_fetch_assoc($result_pf)) {

if($venu == ''){
if($row2['spPostFieldName'] == 'spPostingEventVenue_'){
$venu = $row2['spPostFieldValue'];

}
}
if($startDate == ''){
if($row2['spPostFieldName'] == 'spPostingStartDate_'){
$startDate = $row2['spPostFieldValue'];

}
}
if($startTime == ''){
if($row2['spPostFieldName'] == 'spPostingStartTime_'){
$startTime = $row2['spPostFieldValue'];

}
}
if($endTime == ''){
if($row2['spPostFieldName'] == 'spPostingEndTime_'){
$endTime = $row2['spPostFieldValue'];

}
}
if($OrganizerName == ''){
if($row2['spPostFieldName'] == 'spPostingEventOrgName_'){
$OrganizerName = $row2['spPostFieldValue'];

}
}
}
$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);
}*/
?>
<tr>
<td><i class="fa fa-clock"></i> <?php echo date("h:i A", $dtstrtTime); ?></td>
<!-- <td>
<?php // if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ ?>

<a href="<?php  // echo $BaseUrl.'/friends/?profileid='.$row['spPostingEventOrgId'];?>"><?php // echo $OrganizerName; ?></a>


<?php // }else{ ?>

<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' ><?php // echo $OrganizerName; ?></a>

<?php // } ?>





</td>  -->
<td>

<?php if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ ?>

<a href="<?php echo $BaseUrl.'/events/event-detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingTitle'];?></a>

<?php }else{ ?>

<a href="javascript:void(0)" data-toggle='modal' data-target='#alertNotEmpProfile' ><?php echo $row['spPostingTitle'];?></a>



<?php } ?>



</td>
<td><?php echo $venu;?></td>
<?php $aa= round($eventprice, 3); ?>
<td><?php echo ($row['event_payment_type'] == 2)? $default_currency. ' ' . $aa:'Free';?></td>
</tr>
<?php
}
}else{?>
<td colspan="5">No Record Found</td>
<?php }
}
?>


</tbody>
</table>
</div>