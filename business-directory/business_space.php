<div class="table-responsive">
<table class="table table-striped table-bordered  tabDirc ">
<thead class="">
<tr>
<th style="width: 100px;">Title</th>
<th>Description</th>
<th>Posted Date</th>
<?php if($_GET['business']==$_SESSION['pid']){ ?>
<th class="text-center" style="width: 150px;">Action</th>
<?php }?>
</tr>
</thead>
<tbody>
<?php
$cn = new _company_news;
$result1 = $cn->readMyNews($_GET['business']);
//echo $cn->ta->sql;
if($result1){
while ($row = mysqli_fetch_assoc($result1)) { 
$postTime = strtotime($row['cmpanynewsdate']); ?>
<tr>
<td><a><?php echo $row['cmpanynewsTitle']?></a></td>
<td><?php echo $row['cmpanynewsDesc']?></td>
<td style="width: 100px;"><?php echo date("d-M-Y", $postTime); ?></td>
<?php if($_GET['business']==$_SESSION['pid']){ ?>
<td align="center">
<a href="javascript:void(0)" data-newsid="<?php echo $row['idcmpanynews'];?>" data-toggle="modal" data-target="#ReadNews" class="editNews" ><i class="fa fa-edit"></i></a>
<a href="<?php echo $BaseUrl.'/business-directory/deletenews.php?newsid='.$row['idcmpanynews'];?>" class="btn "><i class="fa fa-trash"></i></a>

</td><?php } ?>
</tr>
<?php
}
} else{?>
<td colspan="9"><center>No Record Found</center></td> 
<?php }
?>


</tbody>
</table>
</div>

<div class="modal fade jobseeker" id="ReadNews" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
<div class="modal-dialog" role="document">
<div class="modal-content no-radius" >
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h3 class="modal-title" id="resumeheadr">Update News</h3>
</div>
<div class="modal-body">
<form action="<?php echo $BaseUrl.'/business-directory/updatenews.php';?>" method="post" class="">                            
<div id="updateNews"></div>
<div class="modal-footer" class="uploadupdate">
<button type="submit" class="btn btn-primary btn-border-radius">Update</button>
<button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Close</button>

</div>
</form>
</div>
</div>
</div>
</div>