

<div class="row">
<div class="col-md-12">
<h4 class="text-center">Trash Folders</h4>
<div class="space"></div>
<div class="table-responsive">
<table class="table table_green_head tbl_file">
<thead>
<tr>
<th>Title</th>

<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
$pc = new _postingalbum;
$result = $pc->misc_trash_files($group_id);
if($result != false){
while ($rw = mysqli_fetch_assoc($result)) { ?>
<tr>
<td><?php echo $rw['sppostingmediaTitle']?></td>
<td>
<?php
$profileid = $_SESSION['pid'];
$g = new _spgroup;
$pr = $g->admin_Member($profileid, $group_id);
foreach ($pr as $key => $isAdmin) {
$isAmdinha = $isAdmin['spProfileIsAdmin'];
$isAssAdmin = $isAdmin['spAssistantAdmin'];
?>
<a href="<?php echo $BaseUrl.'/grouptimelines/?groupid='.$group_id.'&groupname='.$_GET['groupname'].'&restorefile='.$rw['idspPostingMedia'];?>" class="btn btn-success btn-border-radius">Restore File</a> <?php

} ?>

</td>
</tr>
<?php
}
}
?>
</tbody>
</table>
</div>
</div>
</div>
