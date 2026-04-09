 <h3 style="margin-left:10px">world news</h3>
 <div class="box-body tbl-respon">
 <?php
     if(isset($_POST['btnsubmit']))
  {
	  
	//print_r($_POST['rssanme']);
	   $del="delete from rss_dataid";
	   $res=dbQuery($dbConn,$del);
	   if($_POST['rssanme']!=false)
	   {
	 foreach($_POST['rssanme'] as $valu)
	 { 
	  
		 $cmds="insert into rss_dataid(rss_id)values('$valu')";
		 $res=dbQuery($dbConn,$cmds);
	 }
	   }
	//{
	//die("dfdsgsdfgf");	 
	//}
   }
 ?>
 <form method="post" action="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/channelrequest/index.php?view=worldnewsn">
<table class="table table-bordered table-striped tbl-respon2" id="example1">
<thead>
<tr>
<th>website name</th>
<th>website link</th>
<th>news_type</th>
<th>Country</th>
<th>category</th>
<th>Created_Date</th> 
<th>Check</th> 
</tr>
</thead>
</tbody>
<?php 
$cmd="select*from rss_data where rss_Status=1";
$result=dbQuery($dbConn,$cmd);
if($result!=false)
{
while($rows=mysqli_fetch_assoc($result))
{
	//for country
	$countrys=$rows['country'];
	$cmd2="select*from tbl_country where country_id=$countrys";
	$result2=dbQuery($dbConn,$cmd2);
	$rows2=mysqli_fetch_assoc($result2);
	//for category
	$categorys=$rows['category'];
	$cmd3="select*from news_categories where id=$categorys";
	$result3=dbQuery($dbConn,$cmd3);
	$rows3=mysqli_fetch_assoc($result3);
	//for rss_dataid
	$cmd4="select *from rss_dataid";
	$result4=dbQuery($dbConn,$cmd4);
 
if($result4->num_rows > 0)
{
 
	while($rows4=mysqli_fetch_assoc($result4))
	{	 
		$fid[]=$rows4['rss_id'];
	}
}
else
{
	 
$fid[]=array();	
}
	
	$sid=$rows['rss_id']; 
	?>
 <tr>
	<td><?php echo $rows['website_name']; ?></td>
	<td><?php echo $rows['website_link']; ?></td>
	<td><?php echo $rows['news_type']; ?></td>
	<td><?php echo $rows2['country_title']; ?></td> 
	<td><?php echo $rows3['name']; ?></td>
	<td><?php echo $rows['created_at']; ?></td> 
	<?php if (in_array($sid, $fid))
	{
	?>
	<td><input type="checkbox" name="rssanme[]" checked    style="height:30px;width:30px" value="<?php echo $rows['rss_id']; ?>"></td><?php } 
	
	else {
		?>
		<td><input type="checkbox" name="rssanme[]" style="height:30px;width:30px" value="<?php echo $rows['rss_id']; ?>"></td>
		<?php
	}?>
	</tr>
	<?php
	
}
}
?>
</tbody>
</table>
<input type="submit" name="btnsubmit" value="submit" class="btn btn-success">
</form>
</div>