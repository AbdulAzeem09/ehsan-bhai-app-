

<div class="row">
<div class="col-md-12">
<h4 class="text-center">Trash Folders</h4>
<div class="space"></div>
<div class="table-responsive">
<table class="table table_green_head text-center">
<thead>
<tr>
<th>Title</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php
$pc = new _postingalbum;
$group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
$result = $pc->group_trash_file($group_id);
//echo $pc->spf->sql;
if ($result != false) {
while ($rw = mysqli_fetch_assoc($result)) { ?>
<tr>
<td class="text-left"><?php echo $rw['spf_title'];?></td>
<td>
<?php
$profileid = $_SESSION['pid'];
$g = new _spgroup;
$pr = $g->admin_Member($profileid, $group_id);
foreach ($pr as $key => $isAdmin) {
$isAmdinha = $isAdmin['spProfileIsAdmin'];
$isAssAdmin = $isAdmin['spAssistantAdmin'];
if($isAmdinha == 0 || $isAssAdmin == 1){ ?>
<a href="<?php echo $BaseUrl.'/grouptimelines/group-folder.php?groupid='.$_GET['groupid'].'&groupname='.$_GET['groupname'].'&files&restore='.$rw['spf_id'];?>" class="btn btn-success btn-border-radius">Restore</a> <?php
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
</div>
</div>
</div>
