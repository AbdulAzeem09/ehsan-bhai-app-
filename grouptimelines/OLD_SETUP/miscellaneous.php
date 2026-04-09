

<div class="row">
<div class="col-md-12">
<h4 class="text-center">Miscellaneous Folders</h4>
<div class="space"></div>
<div class="table-responsive">
<table class="table table_green_head tbl_file">
<thead>
<tr>
<th>Title</th>
<th>Uploader</th>
<th>Date</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$pc = new _postingalbum;
$p = new _spprofiles;
$group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
$result = $pc->group_misc_file($group_id);
//echo $pc->ta->sql;
if ($result != false) {
while ($rw = mysqli_fetch_assoc($result)) {
//Uploader name
$re = $p->read($rw['spProfiles_idspProfiles']);
if ($re != false) {
$rpr = mysqli_fetch_assoc($re);
$profilename = $rpr["spProfileName"];
}

$res = $p->checkprofile($_SESSION["uid"], $rw['spProfiles_idspProfiles']);
if ($res != false) {
$row = mysqli_fetch_assoc($res);
$profileid = $row["idspProfiles"];
}
$resume = $rw["spPostingMedia"];
$ext = $rw['sppostingmediaExtension'];

$previewfile = $rw['sppostingmediaTitle'] . $rw['idspPostingMedia'] . "." . $rw['sppostingmediaExt'] . "";
file_put_contents("../resume/" . $previewfile, $resume);

$title = $rw['sppostingmediaTitle'];
//<td width='7%'><button type='button' class='btn btn-link preview' data-toggle='modal' data-target='#previewfile' data-src='http://dev.thethe-share-page.com/resume/".$previewfile."' data-filetitle='".$rw['sppostingmediaTitle']."'><span class='glyphicon glyphicon-search'></span> Preview</button></td>

$d = strtotime($rw['sppostingmediaDate']);
$dt = new DateTime($rw['sppostingmediaDate']);
echo "<tr>
<td >" . $title . "</td>                                          
<td ><b style='color:gray;'>" . $profilename . "</b></td>                                  

<td >" . $dt->format('d M Y') . "  " . date("H:i:s", $d) . "</td>


<td>
<a href='".$BaseUrl."/resume/" . $previewfile . "'  data-mediaid='" . $rw['idspPostingMedia'] . "' ata-toggle='tooltip' data-placement='left' title='Download' class='btn btn-success'><span class='glyphicon glyphicon-download'  ></span></a>
<button type='button' class='btn btn-danger " . ($profileid == $rw['spProfiles_idspProfiles'] ? "deleteresume" : "disabled") . "' data-mediaid='" . $rw['idspPostingMedia'] . "' data-profileid='" . $rw['spProfiles_idspProfiles'] . "'><span class='glyphicon glyphicon-trash'></span></button></td>
</tr>";
}
}
?>
<tr>
<td>
<?php
$pc = new _postingalbum;
$countMiscFile = $pc->countMiscTrashFile($group_id);
?>
<a href="<?php echo $BaseUrl.'/grouptimelines/group-folder.php?groupid='.$group_id.'&groupname='.$_GET['groupname'].'&files&miscTrash';?>" class="btn butn-post btn-border-radius"><i class="fa fa-file"></i> Trash Files (<span><?php echo $countMiscFile;?></span>)</a>
</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

</tbody>
</table>

</div>
</div>
</div>
