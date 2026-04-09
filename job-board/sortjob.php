<?php
include('../univ/baseurl.php');
session_start();
function sp_autoloader($class) {
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
$sortby = $_POST['sortby'];
//echo $sortby;
if($sortby == 'ASC'){
$sort = "idspPostings ASC";
}else if($sortby == 'DESC'){
$sort = "idspPostings DESC";
}else{
if($sortby == 'posted-Date'){
$sort = "spPostingDate DESC";
}else{
$sort = "spPostingDate ASC";
}
}
?>


<div class="col-sm-12 jobseakrhead no-padding">
<?php
$limit = 4;
$p   = new _postingview;
$pf  = new _postfield;
$res = $p->jobBoard_sortby(2, $_SESSION['pid'], $sort);
//$res = $p->publicpost_jobBoard($limit, 2);
//echo $p->ta->sql;
if($res){
while ($row = mysqli_fetch_assoc($res)) {
$closingdate = new DateTime($row['spPostingExpDt']);

$result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
if($result_pf){

$skill = "";
$cmpnyName = "";
$strtSalry = "";
$endSalry = "";
$jobLevel = "";

while ($row2 = mysqli_fetch_assoc($result_pf)) {
// if($closingdate == ''){
//     if($row2['spPostFieldName'] == 'spPostingClosing_'){
//         $closingdate = new DateTime($row2['spPostFieldValue']); 
//     }
// }
if($cmpnyName == ''){
if($row2['spPostFieldName'] == 'spPostingCompany_'){
$cmpnyName = $row2['spPostFieldValue'];
}
}
if($strtSalry == ''){
if($row2['spPostFieldName'] == 'spPostingSlryRngTo_'){
$strtSalry = $row2['spPostFieldValue'];
}
}
if($endSalry == ''){
if($row2['spPostFieldName'] == 'spPostingSlryRngFrm_'){
$endSalry = $row2['spPostFieldValue'];
}
}
if($skill == ''){
if($row2['spPostFieldName'] == 'spPostingSkill_'){
$skill = explode(',', $row2['spPostFieldValue']);
}
}
if($jobLevel == ''){
if($row2['spPostFieldName'] == 'spPostingJoblevel_'){
$jobLevel = $row2['spPostFieldValue'];
}
}

}
$postingDate = $p-> spPostingDate($row["spPostingDate"]);
}
?>
<!-- repeat able box -->
<div class="whiteboardmain m_btm_15">
<div class="row top_job_head">
<div class="col-sm-12 jobboradlist">
<h2><a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>"><?php echo $row['spPostingtitle'];?> </a></h2>
<h1><?php echo $cmpnyName.' ,'. $row['spPostingsCity']. ','.$row['spPostingsCountry'];?></h1>
<p>
<?php
if(strlen($row['spPostingNotes']) < 400){
echo $row['spPostingNotes'];
}else{
echo substr($row['spPostingNotes'], 0,400);

} ?>
<a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" class="readmore">...Read More</a>
</p>
<?php
if(count($skill) >0){
foreach($skill as $key => $value){
if($value != ''){
echo "<span class='skills-tags'>".$value."</span>";
}

}
}
?>
</div>

</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="footer_job">
<div class="row">
<div class="col-md-3">
<a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" data-toggle='tooltip' data-placement='bottom' title='Last Date To Apply'><i class="fa fa-calendar"></i> <?php echo $closingdate->format('d-M-Y');?></a>
</div>
<div class="col-md-3">
<a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" data-toggle='tooltip' data-placement='bottom' title='Experience'><i class="fa fa-floppy-o"></i> 2 Years</a>
</div>
<div class="col-md-3 text-center">
<a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" data-toggle='tooltip' data-placement='bottom' title='Salary'><i class="fa fa-money"></i> <?php echo $endSalry.' - '.$strtSalry;?></a>
</div>
<div class="col-md-3 text-right">
<a href="<?php echo $BaseUrl.'/job-board/job-detail.php?postid='.$row['idspPostings'];?>" data-toggle='tooltip' data-placement='bottom' title='Job Level'><i class="fa fa-briefcase"></i> <?php echo $jobLevel;?></a>
</div>
</div>
</div>
</div>
</div>
<!-- repeat able box end -->
<?php
}
}else{
?>
<div class="whiteboardmain" style="min-height: 300px;">
<p>No Jobs Found!</p>
</div>
<?php
}
?>
</div>

