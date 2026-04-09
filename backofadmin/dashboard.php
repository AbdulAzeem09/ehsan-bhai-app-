<?php
require_once 'library/config.php';
require_once 'library/functions.php';

?>

<section class="content-header">
<h1>Dashboard<small>Control panel</small></h1>
<ol class="breadcrumb">
<li><a href="<?php echo WEB_ROOT_ADMIN ?>"><i class="fa fa-dashboard"></i> Home</a></li>
<li class="active">Dashboard</li>
</ol>
</section>
<!-- Main content -->
<section class="content">
<div class="row">
<div class="col-md-3 col-sm-6 col-xs-12">
<a href="<?php echo WEB_ROOT_ADMIN.'registerdUser';?>">
<div class="info-box">
<span class="info-box-icon bg-aqua"><i class="fa fa-user"></i></span>
<div class="info-box-content">
<span class="info-box-text">Total Registrations</span>
<span class="info-box-number"><?php totalRegUser($dbConn);?></span>
</div><!-- /.info-box-content -->
</div><!-- /.info-box -->
</a>
</div>
<div class="col-md-3 col-sm-6 col-xs-12">
<a href="javascript:void(0);">
<div class="info-box">
<span class="info-box-icon bg-green"><i class="fa fa-envelope"></i></span>
<div class="info-box-content">
<span class="info-box-text">Email Verified Users</span>
<span class="info-box-number"><?php totalEmailVerified($dbConn);?></span>
</div><!-- /.info-box-content -->
</div><!-- /.info-box -->
</a>
</div>
<div class="col-md-3 col-sm-6 col-xs-12">
<a href="javascript:void(0);">
<div class="info-box">
<span class="info-box-icon bg-red"><i class="fa fa-phone"></i></span>
<div class="info-box-content">
<span class="info-box-text">Phone Verified Users</span>
<span class="info-box-number"><?php totalPhoneVerified($dbConn);?></span>
</div><!-- /.info-box-content -->
</div><!-- /.info-box -->
</a>
</div>
<div class="col-md-3 col-sm-6 col-xs-12">
<a href="<?php echo WEB_ROOT_ADMIN.'totalPost';?>">
<div class="info-box">
<span class="info-box-icon bg-yellow"><i class="fa fa-clipboard"></i></span>
<div class="info-box-content">
<span class="info-box-text">Total Post</span>
<span class="info-box-number"><?php totalPosts($dbConn);?></span>
</div><!-- /.info-box-content -->
</div><!-- /.info-box -->
</a>
</div>
<div class="col-md-3 col-sm-6 col-xs-12">
<a href="<?php echo WEB_ROOT_ADMIN.'mytask';?>">
<div class="info-box">
<span class="info-box-icon bg-aqua"><i class="fa fa-tasks"></i></span>
<div class="info-box-content">
<span class="info-box-text">Total New Task</span>
<span class="info-box-number"><?php latestUnreadTask($dbConn, $_SESSION['userId']); ?></span>
</div><!-- /.info-box-content -->
</div><!-- /.info-box -->
</a>
</div>
<div class="col-md-3 col-sm-6 col-xs-12">
<a href="<?php echo WEB_ROOT_ADMIN.'profileType';?>">
<div class="info-box">
<span class="info-box-icon bg-green"><i class="fa fa-file-text"></i></span>
<div class="info-box-content">
<span class="info-box-text">Profile Types</span>
<span class="info-box-number"><?php totprofiletype($dbConn); ?></span>
</div><!-- /.info-box-content -->
</div><!-- /.info-box -->
</a>
</div>
<div class="col-md-3 col-sm-6 col-xs-12">
<a href="<?php echo WEB_ROOT_ADMIN.'mainCategory';?>">
<div class="info-box">
<span class="info-box-icon bg-red"><i class="fa fa-university"></i></span>
<div class="info-box-content">
<span class="info-box-text">Total Moduless</span>
<span class="info-box-number"><?php totalmodule($dbConn); ?></span>
</div><!-- /.info-box-content -->
</div><!-- /.info-box -->
</a>
</div>
<div class="col-md-3 col-sm-6 col-xs-12">
<a href="<?php echo WEB_ROOT_ADMIN.'sponsor';?>">
<div class="info-box">
<span class="info-box-icon bg-yellow"><i class="fa fa-spinner"></i></span>
<div class="info-box-content">
<span class="info-box-text">Total Sponsors</span>
<span class="info-box-number"><?php totsponsor($dbConn); ?></span>
</div><!-- /.info-box-content -->
</div><!-- /.info-box -->
</a>
</div>
<div class="col-md-3 col-sm-6 col-xs-12">
<a href="<?php echo WEB_ROOT_ADMIN.'totalPost';?>">
<div class="info-box">
<span class="info-box-icon bg-aqua"><i class="fa fa-tag"></i></span>
<div class="info-box-content">
<span class="info-box-text">Total Active Post</span>
<span class="info-box-number"><?php echo active_post($dbConn); ?></span>
</div><!-- /.info-box-content -->
</div><!-- /.info-box -->
</a>
</div>

<div class="col-md-3 col-sm-6 col-xs-12">
<a href="#">
<div class="info-box">
<span class="info-box-icon bg-aqua"><i class="fa fa-usd"></i></span>
<div class="info-box-content">
<span class="info-box-text">Total Subscription Commission</span>
<span class="info-box-number">$<?php echo total_sub_commission($dbConn); $total_sub_commission =total_sub_commission($dbConn);  ?></span>
</div><!-- /.info-box-content -->
</div><!-- /.info-box -->
</a>
</div>

<div class="col-md-3 col-sm-6 col-xs-12">
<a href="#">
<div class="info-box">
<span class="info-box-icon bg-aqua"><i class="fa fa-usd"></i></span>
<div class="info-box-content">
<span class="info-box-text">Total Sales Commission</span>
<span class="info-box-number">$<?php echo total_sale_commission($dbConn); $total_sale_commission = total_sale_commission($dbConn);  ?></span>
</div><!-- /.info-box-content -->
</div><!-- /.info-box -->
</a>
</div>

<div class="col-md-3 col-sm-6 col-xs-12">
<a href="#">
<div class="info-box">
<span class="info-box-icon bg-aqua"><i class="fa fa-money"></i></span>
<div class="info-box-content">
<span class="info-box-text">Total Commission</span>
<span class="info-box-number">$<?php $totalCommission = $total_sub_commission+$total_sale_commission; echo $totalCommission;?></span>
</div><!-- /.info-box-content -->
</div><!-- /.info-box -->
</a>
</div>




</div><!-- /.row -->
<div class="row">
<div class="col-md-12">
<div class="nav-tabs-custom">
<!-- Tabs within a box -->
<ul class="nav nav-tabs" style="font-size:16px;">
<li class="active"><a href="#store-chart" data-toggle="tab">Store</a></li>
<li><a href="#freelance-chart" data-toggle="tab">Freelancer</a></li>
<li><a href="#job-chart" data-toggle="tab">Job Board</a></li>
<li><a href="#real-chart" data-toggle="tab">Real Estate</a></li>
<li><a href="#event-chart" data-toggle="tab">Events</a></li>
<li><a href="#art-chart" data-toggle="tab">Art Gallery</a></li>
<li><a href="#music-chart" data-toggle="tab">Business</a></li>
<li><a href="#video-chart" data-toggle="tab">Videos</a></li>
<li><a href="#training-chart" data-toggle="tab">Trainings</a></li>
<li><a href="#classified-chart" data-toggle="tab">Classified Ads</a></li>

</ul>

<div class="tab-content no-padding">
<!-- Morris chart - Sales -->
<div class="chart tab-pane active" id="store-chart" style="position: relative; height: 419px;">
<div class="box-footer no-padding">
<ul class="nav nav-pills nav-stacked">
<li><a href="#">Industry Type <span class="pull-right text-red"><?php echo totalalltable($dbConn, "industry_type", "status"); ?></span></a></li>
<li><a href="#">Product Status <span class="pull-right text-green"> <?php echo totalalltable($dbConn, "productstatus", "status"); ?></span></a></li>
<li><a href="#">Shipping Destination <span class="pull-right text-yellow"> <?php echo totalalltable($dbConn, "shipping_destination", "status"); ?></span></a></li>
<li><a href="#">Total Postings  <span class="pull-right text-red"><?php echo totdashpost($dbConn, "spproduct", 1); ?></span></a></li>
<li><a href="#">Total Category  <span class="pull-right text-red"><?php echo totdashcat($dbConn, "subcategory", 1, "subCategoryStatus"); ?></span></a></li>
</ul>
</div><!-- /.footer -->
</div>
<div class="chart tab-pane" id="freelance-chart" style="position: relative; height: 419px;">
<div class="box-footer no-padding">
<ul class="nav nav-pills nav-stacked">
<li><a href="#">Project Type <span class="pull-right text-green"> <?php echo totalalltable($dbConn, "projecttype", "status"); ?></span></a></li>
<li><a href="#">Profile Type <span class="pull-right text-green"> <?php echo totalalltable($dbConn, "freelance_profile_type", "status"); ?></span></a></li>
<li><a href="#">Total  Postings  <span class="pull-right text-red"><?php echo totdashpost($dbConn, "spfreelancer", 5); ?></span></a></li>
<li><a href="#">Total Category  <span class="pull-right text-red"><?php echo totdashcat($dbConn, "subcategory", 5, "subCategoryStatus"); ?></span></a></li>

</ul>
</div><!-- /.footer -->
</div>
<div class="chart tab-pane" id="job-chart" style="position: relative; height: 419px;">
<div class="box-footer no-padding">
<ul class="nav nav-pills nav-stacked">
<li><a href="#">Job Level <span class="pull-right text-green"> <?php echo totalalltable($dbConn, "job_level", "status"); ?></span></a></li>
<li><a href="#">Total  Postings  <span class="pull-right text-red"><?php echo totdashpost($dbConn, "spjobboard", 2); ?></span></a></li>

<li><a href="#">Total Category  <span class="pull-right text-red"><?php echo totdashcat($dbConn, "subcategory", 2, "subCategoryStatus"); ?></span></a></li>

</ul>
</div><!-- /.footer -->
</div>
<div class="chart tab-pane" id="real-chart" style="position: relative; height: 419px;">
<div class="box-footer no-padding">
<ul class="nav nav-pills nav-stacked">
<li><a href="#">Property Type <span class="pull-right text-green"> <?php echo totalalltable($dbConn, "property_type", "status"); ?></span></a></li>
<li><a href="#">Property Status <span class="pull-right text-green"> <?php echo totalalltable($dbConn, "property_status", "status"); ?></span></a></li>
<li><a href="#">Total  Postings  <span class="pull-right text-red"><?php echo totdashpost($dbConn, "sprealstate", 3); ?></span></a></li>

<li><a href="#">Total Category  <span class="pull-right text-red"><?php echo totdashcat($dbConn, "subcategory", 3, "subCategoryStatus"); ?></span></a></li>

</ul>
</div><!-- /.footer -->
</div>
<div class="chart tab-pane" id="event-chart" style="position: relative; height: 419px;">
<div class="box-footer no-padding">
<ul class="nav nav-pills nav-stacked">
<li><a href="#">Total  Postings  <span class="pull-right text-red"><?php echo totdashpost($dbConn, "spevent", 9); ?></span></a></li>

<li><a href="#">Total Category  <span class="pull-right text-red"><?php echo totdashcat($dbConn, "subcategory", 9, "subCategoryStatus"); ?></span></a></li>

</ul>
</div><!-- /.footer -->
</div>
<div class="chart tab-pane" id="art-chart" style="position: relative; height: 419px;">
<div class="box-footer no-padding">
<ul class="nav nav-pills nav-stacked">
<li><a href="#">Art Sold By <span class="pull-right text-green"> <?php echo totalalltable($dbConn, "art_sold_by", "status"); ?></span></a></li>
<li><a href="#">Frame Type <span class="pull-right text-green"> <?php echo totalalltable($dbConn, "frame_type", "status"); ?></span></a></li>
<li><a href="#">Total Postings  <span class="pull-right text-red"><?php echo totdashpost($dbConn, "sppostingsartcraft", 13); ?></span></a></li>
<li><a href="#">Art Gallery Sizes  <span class="pull-right text-red"><?php echo totdashcount($dbConn, "artsizes"); ?></span></a></li>

<li><a href="#">Total Category  <span class="pull-right text-red"><?php echo totdashcat($dbConn, "subcategory", 13, "subCategoryStatus"); ?></span></a></li>

</ul>
</div><!-- /.footer -->
</div>


<!-- Morris chart - Sales -->
<div class="chart tab-pane " id="music-chart" style="position: relative; height: 419px;">
<div class="box-footer no-padding">
<ul class="nav nav-pills nav-stacked">
<!--<li><a href="#">Music Language <span class="pull-right text-green"> <?php //echo totalalltable($dbConn, "music_language", "status"); ?></span></a></li>-->
<li><a href="#">Total  Postings  <span class="pull-right text-red"><?php echo totdashpost($dbConn, "spbuisnesspostings", 14); ?></span></a></li>

<li><a href="#">Total Category  <span class="pull-right text-red"><?php echo totdashcat($dbConn, "subcategory", 14, "subCategoryStatus"); ?></span></a></li>
</ul>
</div><!-- /.footer -->
</div>
<div class="chart tab-pane" id="video-chart" style="position: relative; height: 419px;">
<div class="box-footer no-padding">
<ul class="nav nav-pills nav-stacked">
<li><a href="#">Total  Postings  <span class="pull-right text-red"><?php echo totdashpost($dbConn, "spvideo", 10); ?></span></a></li>

<li><a href="#">Total Category  <span class="pull-right text-red"><?php echo totdashcat($dbConn, "subcategory", 10, "subCategoryStatus"); ?></span></a></li>

</ul>
</div><!-- /.footer -->
</div>
<div class="chart tab-pane" id="training-chart" style="position: relative; height: 419px;">
<div class="box-footer no-padding">
<ul class="nav nav-pills nav-stacked">
<li><a href="#">Total  Postings  <span class="pull-right text-red"><?php echo totdashpost($dbConn, "sptraining", 8); ?></span></a></li>

<li><a href="#">Total Category  <span class="pull-right text-red"><?php echo totdashcat($dbConn, "subcategory", 8, "subCategoryStatus"); ?></span></a></li>

</ul>
</div><!-- /.footer -->
</div>
<div class="chart tab-pane" id="classified-chart" style="position: relative; height: 419px;">
<div class="box-footer no-padding">
<ul class="nav nav-pills nav-stacked">
<li><a href="#">Total  Postings  <span class="pull-right text-red"><?php echo totdashpost($dbConn, "spclassified", 7); ?></span></a></li>

<li><a href="#">Total Category  <span class="pull-right text-red"><?php echo totdashcat($dbConn, "subcategory", 7, "subCategoryStatus"); ?></span></a></li>

</ul>
</div><!-- /.footer -->
</div>

</div>
</div><!-- /.nav-tabs-custom -->
</div>
</div>
<div class="row">
<div class="col-md-4">
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Recently Assigned Tasks</h3>
<!-- <div class="box-tools pull-right">
<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
</div> -->
</div><!-- /.box-header -->
<div class="box-body">
<ul class="products-list product-list-in-box">
<?php
$userId = $_SESSION['userId'];
$sql = "SELECT * FROM tbl_notes WHERE spNotesRead = 0 AND user_id_to = $userId  ORDER BY idspNotes DESC limit 5";
$result = dbQuery($dbConn, $sql);
if ($result) {
while ($row = dbFetchAssoc($result)) { ?>
<li class="item">
<div class="product-img">
<?php
printUserImage($dbConn, $row['user_id_from']);
?>
</div>
<div class="product-info">
<a href="<?php echo WEB_ROOT_ADMIN.'mytask/index.php?view=detail&noteId='.$row['idspNotes']; ?>" class="product-title"><?php echo $row['spNotesTitle'];?> <span class="label label-danger pull-right">Detail</span></a>
<span class="product-description">
<?php 
if(strlen($row['spNotesDesc']) > 35){
echo substr($row['spNotesDesc'], 0,40)."...";
}else{
echo $row['spNotesDesc']; 
}
?>
</span>
</div>
</li><!-- /.item -->
<?php
}
}
?>

</ul>
</div><!-- /.box-body -->
<div class="box-footer text-center">
<a href="<?php echo WEB_ROOT_ADMIN.'mytask';?>" class="uppercase">View All Notes</a>
</div><!-- /.box-footer -->
</div><!-- /.box -->
</div>
<div class="col-md-4">
<div class="box box-primary">
<div class="box-header with-border">
<h3 class="box-title">Recently Review Tasks</h3>
<!-- <div class="box-tools pull-right">
<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
</div> -->
</div><!-- /.box-header -->
<div class="box-body">
<ul class="products-list product-list-in-box">
<?php
$userId = $_SESSION['userId'];
$sql = "SELECT * FROM tbl_notes WHERE spNotesRead = 0 AND user_id_from = $userId AND spNotesStatus = 1  ORDER BY idspNotes DESC limit 5";
$result = dbQuery($dbConn, $sql);
if ($result) {
while ($row = dbFetchAssoc($result)) { ?>
<li class="item">
<div class="product-img">
<?php
printUserImage($dbConn, $row['user_id_from']);
?>
</div>
<div class="product-info">
<a href="<?php echo WEB_ROOT_ADMIN.'crossTask/index.php?view=detail&noteId='.$row['idspNotes']; ?>" class="product-title"><?php echo $row['spNotesTitle'];?> <span class="label label-danger pull-right">Detail</span></a>
<span class="product-description">
<?php 
if(strlen($row['spNotesDesc']) > 35){
echo substr($row['spNotesDesc'], 0,40)."...";
}else{
echo $row['spNotesDesc']; 
}
?>
</span>
</div>
</li><!-- /.item -->
<?php
}
}
?>

</ul>
</div><!-- /.box-body -->
<div class="box-footer text-center">
<a href="<?php echo WEB_ROOT_ADMIN.'crossTask';?>" class="uppercase">View All Notes</a>
</div><!-- /.box-footer -->
</div><!-- /.box -->
</div>
<div class="col-md-4">
<div class="info-box bg-yellow">
<span class="info-box-icon"><i class="fa fa-globe"></i></span>
<div class="info-box-content">
<span class="info-box-text">Country</span>
<span class="info-box-number"><?php echo totdashcount($dbConn, "tbl_country"); ?></span>
<div class="progress">
<div class="progress-bar" style="width: 50%"></div>
</div>

</div><!-- /.info-box-content -->
</div><!-- /.info-box -->
<div class="info-box bg-green">
<span class="info-box-icon"><i class="fa fa-superpowers"></i></span>
<div class="info-box-content">
<span class="info-box-text">State</span>
<span class="info-box-number"><?php echo totdashcount($dbConn, "tbl_state"); ?></span>
<div class="progress">
<div class="progress-bar" style="width: 70%"></div>
</div>

</div><!-- /.info-box-content -->
</div><!-- /.info-box -->
<div class="info-box bg-aqua">
<span class="info-box-icon"><i class="fa fa-superpowers"></i></span>
<div class="info-box-content">
<span class="info-box-text">City</span>
<span class="info-box-number"><?php echo totdashcount($dbConn, "tbl_city"); ?></span>
<div class="progress">
<div class="progress-bar" style="width: 90%"></div>
</div>

</div><!-- /.info-box-content -->
</div><!-- /.info-box -->

</div>



</div>
</section>














