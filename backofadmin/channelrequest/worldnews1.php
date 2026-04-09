<?php
error_reporting(0);
@ini_set('display_errors', 0);
?>

<h3>World news </h3>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/channelrequest/index.php?view=addchannels"" class="btn btn-success" style="float:right;">Add New Channel</a> <br><br> 
<table <table class="table table-bordered table-striped tbl-respon2" id="example1" >
<thead>
<tr>
<th>Website name</th>
<th>website link</th>
<th>news type</th>
<th>Country</th>
<th>State</th>
<th>Category</th>
<th>Delete</th>
<th>Edit</th>
</tr>
</thead>
<tbody>
<?php 
$cmd="select*from rss_addchannel";
$spres=dbQuery($dbConn,$cmd);
while($result=mysqli_Fetch_assoc($spres))
{
	$conid=$result['country'];
	$stateid=$result['state'];
	$cate=$result['category'];
	$country="select*from tbl_country where country_id=$conid";
	$spres2=dbQuery($dbConn,$country);
	if($spres2!=false){
	$result2=mysqli_Fetch_assoc($spres2); 
	}
	$state="select*from  tbl_state where state_id=$stateid";
	$spres3=dbQuery($dbConn,$state);
	//print_r($spres3);
	//die('==');
	if($spres3!=false){
    $result3=mysqli_fetch_assoc($spres3);
	}
	//print_r($result3);
	//die('==');
	$category="select*from  news_categories where id=$cate";  
	$spres4=dbQuery($dbConn,$category);
    $result4=mysqli_Fetch_assoc($spres4);   
	
 ?>
<tr>
<td> <?php echo $result['website_name'];?></td>
<td><?php echo $result['website_link'];  ?></td>
<td><?php echo $result['news_type']; ?></td>
<td><?php echo $result2['country_title']; ?></td>
<td><?php echo $result3['state_title'] ?></td>
<td><?php echo $result4['name'];?></td>
<td> <!--<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/channelrequest/index.php?view=deletechannels&id=<?php echo $result['id']; ?>" class="btn btn-danger">Delete</a>-->

<a href="javascript:deleteWorldnews(<?php echo $result['id']; ?>)" data-original-title="delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>


</td>
<td><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/channelrequest/index.php?view=editech&id=<?php echo $result['id']; ?>" class="btn btn-primary">Edit</a>
</td>
</tr>
 
<?php } ?>

</tbody>
</table>

