<?php 
include('../univ/baseurl.php');
session_start();
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
if (!isset($_SESSION['pid'])) {
include_once ("../authentication/check.php");
$_SESSION['afterlogin'] = "../timeline/";
}

$_GET["categoryID"] = 13;

$p = new _postingview;
$pf  = new _postfield;

$result = $p->singletimelines($_GET['event']);
//echo $p->ta->sql;
if($result != false){
$row = mysqli_fetch_assoc($result);
$ProTitle   = $row['spPostingtitle'];
$ProDes     = $row['spPostingNotes'];
$ArtistName = $row['spProfileName'];
$ArtistId   = $row['idspProfiles'];
$ArtistAbout= $row['spProfileAbout'];
$ArtistPic  = $row['spProfilePic'];
$price      = $row['spPostingPrice'];
$country    = $row['spPostingsCountry'];
$city       = $row['spPostingsCity'];
$visibility = $row['spPostingVisibility'];

//posting fields
$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
if($result_pf){
$catName = "";
$imageSize = "";
$printedYear    = "";
while ($row2 = mysqli_fetch_assoc($result_pf)) {

if($catName == ''){
if($row2['spPostFieldName'] == 'photos_'){
$catName = $row2['spPostFieldValue'];

}
}
if($imageSize == ''){
if($row2['spPostFieldName'] == 'imagesize_'){
$imageSize = $row2['spPostFieldValue'];

}
}
if($printedYear == ''){
if($row2['spPostFieldName'] == 'mediaprinted_'){
$printedYear = $row2['spPostFieldValue'];

}
}
}
}
}
if(isset($_GET['artgalleryid']) && $_GET['artgalleryid'] > 0){
//echo $_GET['artgalleryid'];
$ag = new _artgalleryenquiry;
$result2 = $ag->read($_GET['artgalleryid']);
if($result2 != false){
$row2 = mysqli_fetch_assoc($result2);
$enqueryName = $row2['enquiryName'];
$enquiryEmail = $row2['enquiryEmail'];
$enquiryAddress = $row2['enquiryAddress'];
$enquiryCity = $row2['enquiryCity'];
$enquiryCountry = $row2['enquiryCountry'];
$enquiryDesc = $row2['enquiryDesc'];
$enquiryDate = $row2['enquiryDate'];
$enquiryPhone = $row2['enquiryPhone'];

}
}

?>

<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Enquiry Detail</h4>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-6">
<div class="righEngquiryProduct">
<a href="javascript:void(0)">
<?php
$pic = new _postingpic;
$res2 = $pic->read($_GET['event']);
if ($res2 != false) {
$rp = mysqli_fetch_assoc($res2);
$pic2 = $rp['spPostingPic'];
echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >";
} else{
echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
}
?>


</a>
</div>
</div>
<div class="col-md-6">
<div class="righEngquiryProduct">
<a href="javascript:void(0)">
<h3><?php echo $ArtistName; ?> <br>
<?php echo $imageSize; ?> Code: EX00<?php echo $_GET['event']; ?><br>
<?php echo $ProTitle;?>
</h3>

</a>
</div>
</div>
<div class="col-md-12">
<div class="table-responsive">
<table class="table table-striped">
<tbody>
<tr>
<td>Name</td>
<td><?php echo $enqueryName; ?></td>
</tr>
<tr>
<td>Email</td>
<td><?php echo $enquiryEmail; ?></td>
</tr>
<tr>
<td>Address</td>
<td><?php echo $enquiryAddress; ?></td>
</tr>
<tr>
<td>City</td>
<td><?php echo $enquiryCity; ?></td>
</tr>
<tr>
<td>Country</td>
<td><?php echo $enquiryCountry; ?></td>
</tr>
<tr>
<td>Phone No</td>
<td><?php echo $enquiryPhone; ?></td>
</tr>
<tr>
<td>Description</td>
<td class="text-justify"><?php echo $enquiryDesc; ?></td>
</tr>
</tbody>
</table>
</div>


</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>
</div>
