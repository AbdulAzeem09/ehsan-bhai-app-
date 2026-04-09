

<div class="row">
<div class="col-md-12">
<div class="files_name text-center">
<p>
<?php //Uploader name
$spf = new _postingalbum;
$group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
$creatName = $spf->readfolder($group_id);
//echo $spf->spf->sql;
if ($creatName != false) {
$foldr_Name = mysqli_fetch_assoc($creatName);
echo  $foldr_Name["spf_title"];
}?>
</p>
</div>
<div class="table-responsive">
<?php
if(isset($_GET['trashFiles'])){ ?>
<table class="table table_green_head text-center">
<thead>
<tr >
<th>Title</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$pc = new _postingalbum;
$folder = isset($_GET['folder']) ? (int) $_GET['folder'] : 0;
$result = $pc->trash_files($folder);
if($result != false){
while ($rw = mysqli_fetch_assoc($result)) { ?>
<tr>
<td class="text-left"><?php echo $rw['sppostingmediaTitle']?></td>
<td>
<?php
$profileid = $_SESSION['pid'];
$g = new _spgroup;
$pr = $g->admin_Member($profileid, $group_id);
foreach ($pr as $key => $isAdmin) {
$isAmdinha = $isAdmin['spProfileIsAdmin'];
$isAssAdmin = $isAdmin['spAssistantAdmin'];
if($isAmdinha == 0 || $isAssAdmin == 1){ ?>
<a  href="<?php echo $BaseUrl.'/grouptimelines/group-folder.php?groupid='.$group_id.'&groupname='.$_GET['groupname'].'&files&restorefile='.$rw['idspPostingMedia'];?>" class="btn btn-success btn-border-radius">Restore File</a> <?php
}
} ?>

</td>
</tr>
<?php
}
}
?>
</tbody>
</table>
<?php
}else if($folder && $folder > 0){ ?>
<table class="table table_green_head tbl_file">
<thead>
<tr>
<th >File Name</th>
<th>Type</th>
<th>Date</th>
<th style="text-align: center">Shared By</th>

<th style="text-align: center">Action</th>
</tr>
</thead>
<tbody>
<?php
$pc = new _postingalbum;
$p = new _spprofiles;
$folderpath = $pc->folder_path($folder);
if($folderpath){
$row = mysqli_fetch_assoc($folderpath);
$fPath = $row['spf_folder_name'];
if($fPath == ""){
$CreateFolder = preg_replace('~[^\pL\d]+~u', '-', $row['spf_title']);
$locationFold = '../resume/'.$CreateFolder;
mkdir($locationFold);
}else{
$CreateFolder = $row['spf_folder_name'];
}
}
$result1 = $pc->groupfile($group_id, $folder);
//echo $pc->ta->sql;
if ($result1 != false) {
while ($row1 = mysqli_fetch_assoc($result1)) {
//Uploader name
$re = $p->read($row1['spProfiles_idspProfiles']);
if ($re != false) {
$rpr = mysqli_fetch_assoc($re);
$profilename = $rpr["spProfileName"];
}

$res = $p->checkprofile($_SESSION["uid"], $row1['spProfiles_idspProfiles']);
if ($res != false) {
$row = mysqli_fetch_assoc($res);
$profileid = $row["idspProfiles"];
}
$resume = $row1["spPostingMedia"];
$ext = $row1['sppostingmediaExtension'];

$previewfile = $row1['sppostingmediaTitle'] . $row1['idspPostingMedia'] . "." . $row1['sppostingmediaExt'] . "";
$new1=$row1['spPostingMedia'];

file_put_contents("../resume/".$CreateFolder."/" . $previewfile, 
base64_decode($resume));

$title = $row1['sppostingmediaTitle'];
//<td width='7%'><button type='button' class='btn btn-link preview' data-toggle='modal' data-target='#previewfile' data-src='http://dev.thethe-share-page.com/resume/".$previewfile."' data-filetitle='".$row1['sppostingmediaTitle']."'><span class='glyphicon glyphicon-search'></span> Preview</button></td>

$d = strtotime($row1['sppostingmediaDate']);
$dt = new DateTime($row1['sppostingmediaDate']);
if($row1['sppostingmediaExt'] == "pdf"){
$imgName = "pdf.png";

}else if($row1['sppostingmediaExt'] == "jpg"){
$imgName = "image.png";

}else if($row1['sppostingmediaExt'] == "png"){
$imgName = "image.png";

}else if($row1['sppostingmediaExt'] == "docx"){
$imgName = "word.png";

}

?>

<tr>
<td>
<a  href="<?php echo $BaseUrl."/myjobboard/images/".$new1;?>" target="_blank" style="color: #337ab7;">
<?php echo $title;?>
</a>
</td>  
<td><?php echo $row1['sppostingmediaExt'];?></td>                                     
<td ><?php 

echo $dt->format('M d, Y');
?></td>
<td ><?php echo $profilename;?></td>
<td class="action_icon">
<a  href="<?php echo $BaseUrl."/myjobboard/images/".$new1;?>"  data-mediaid="<?php echo $row1['idspPostingMedia']; ?>" download="<?php echo $previewfile;?>"><i class='fa fa-download'  ></i></a>
<?php 
$pr = $g->admin_Member($_SESSION['pid'], $group_id);
//echo $g->tad->sql;
if ($pr != false) {
$row = mysqli_fetch_assoc($pr);
//print_r($row);
$isAmdinha = $row["spProfileIsAdmin"];
$isAssAdmin = $row['spAssistantAdmin'];
}
if($isAmdinha == 0 || $isAssAdmin == 1){
?>
<a class='<?php if($_SESSION['pid'] == $row1['spProfiles_idspProfiles']){echo "deleteresume";}else{echo $row1['spProfiles_idspProfiles'];}?>' data-mediaid='<?php echo $row1['idspPostingMedia'];?>' data-profileid='<?php echo $row1['spProfiles_idspProfiles'];?>' ><i class='fa fa-trash'></i></a>
<?php } ?>
</td>
</tr><?php
}
}else{

echo "<tr><td colspan='5'><h4 style='text-align:center'>No Record Found</h4></td></tr>";
}
?>
<tr>
<td>
<?php
$pc = new _postingalbum;
$countTrashFile = $pc->countTrashFile($group_id, $folder);
?>
<!-- <a href="<?php echo $BaseUrl.'/grouptimelines/group-folder.php?groupid='.$_GET['groupid'].'&groupname='.$_GET['groupname'].'&files&folder='.$_GET['folder'].'&trashFiles';?>" ><i class="fa fa-file"></i> Trash Files (<span><?php echo $countTrashFile;?></span>)</a> -->
</td>
<td>
<p>&nbsp;</p>
</td>
<td>
<p>&nbsp;</p>
</td>
<td>
<p>&nbsp;</p>
</td>
<td>
<p>&nbsp;</p>
</td>
</tr>

</tbody>
</table>
<?php

}   ?>
</div>
</div>
</div>
<script type="text/javascript">

$(".action_icon").on("click", ".deleteresume", function () {
var btn = this;
var mediaid = $(this).data("mediaid");
swal({
title: "Are you sure?",
type: "warning",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Yes",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: true,
},
function(isConfirm) {
if (isConfirm) {
$.post("../job-board/dashboard/deleteresume.php", {mediaid: mediaid}, function (r) {
$(btn).closest(".resumeoperation").hide();
location.reload();
});
}
});
})




</script>
