

<div class="modal fade" id="myshare" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius">
<form action="../social/shareEvent.php" method="POST" class="sharestorepos">
<div class="modal-header">
<h4 class="modal-title">Share Post</h4>
<button type="button" class="close" data-dismiss="modal">&times;</button>
</div>
<div class="modal-body sharedimage">
<input class="dynamic-pid" id="sp-Profiles-idspProfiles" name="spShareByWhom" type="hidden" value="<?php echo $_SESSION['pid']?>">
<input type="hidden" id="shareposting" name="spPostings_idspPostings" value="">

<div class="row">
<div class="col-md-6">
<div class="dropdown">
<button class="btn btn-default btn-border-radius dropdown-toggle" type="button" id="dropdownShare" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
Select group or friend
<span class="caret"></span>
</button>
<ul class="dropdown-menu" aria-labelledby="dropdownShare">
<li id="groupshare" class="sppointer sharedd"><a href="#">Share in a group</a></li>
<li id="friendshare" class="sppointer sharedd"><a href="#">Share to a friend</a></li>
</ul>
</div>
</div>
<div class="col-md-6  hidden" id="groupshow">
<div class="">
<input type="hidden" id="spgroupshareid" name="spShareToGroup" value="">
<input type="text" class="form-control" id="spgroupname" placeholder="Select group name..">
</div>
</div>


<div class="col-md-6 hidden" id="profileshow">
<div class="">
<input type="hidden" id="spfriendshareid" name="spShareToWhom" value="">
<input type="text" class="form-control" id="spfriendname"  placeholder="Select friend's name..">
</div>
</div>
<div class="col-md-12">
<input type="text" id="aboutshare" name="spShareComment" class="form-control" placeholder="Say something about this...">
</div>
</div>
<div class="row">
<div class="col-md-12">
<div class="center-block">
<img id="modalpostingpic" src="../img/no.png" alt="Posting Pic" class="img-responsive center-block" />
</div>
</div>
<div class="col-md-12 eventShareDetail">
<div class="row">
<?php
if(!empty($startDate)){
//echo $start_date;
$dy = new DateTime($startDate);
$day = $dy->format('d');
$month = $dy->format('M');
$weak = $dy->format('D');
}else{
$day = 0;
$month = "&nbsp;";
$weak = "&nbsp;";
}
?>
<div class="col-md-1">
<span class="datee"><?php echo $month; ?><br><?php echo $day;?></span>
</div>
<div class="col-md-8">
<h2><?php echo $ProTitle;?></h2>
<p class="address"><?php echo $weak." ".$startTime;?> <?php echo $venu;?></p>
</div>
<div class="col-md-3">
<?php
$area2 = "";
$area1 = "";
$area0 = "";
$ei = new _eventIntrest;
$result = $ei->chekAlready($_GET['postid'], $_SESSION['pid']);
if($result != false){
$row3 = mysqli_fetch_assoc($result);
$area = $row3['intrestArea'];

if($area == 2){
$area2 = "<i class='fa fa-check'></i>";
}else if($area == 1){
$area1 = "<i class='fa fa-check'></i>";
}else if($area == 0){
$area0 = "<i class='fa fa-check'></i>";
}
}
?>
<div class="dropdown intrestEvent" id="eventDetaildrop" style="display: block;border: 1px solid #CCC">
<button class="btn btn_group_join btn-border-radius dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true" style="border: none;"><i class="fa fa-star" style="margin: 0px;"></i> Interested</button>
<ul class="dropdown-menu ie_<?php echo $_GET['postid'];?>">
<li><a href="javascript:void(0)" class="intrestArea" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $_GET['postid'];?>" data-area="2"><?php echo $area2;?> Going</a></li>
<li><a href="javascript:void(0)" class="intrestArea" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $_GET['postid'];?>" data-area="1"><?php echo $area1;?> Interested</a></li>
<li><a href="javascript:void(0)" class="intrestArea" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $_GET['postid'];?>" data-area="0"><?php echo $area0;?> May Be</a></li>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="" class="btn butn_cancel btn-border-radius" data-dismiss="modal">Cancel</button>
<button type="submit" id="share" class="btn butn_mdl_submit btn-border-radius">Share</button>
</div>
</form>
</div>
</div>
</div>