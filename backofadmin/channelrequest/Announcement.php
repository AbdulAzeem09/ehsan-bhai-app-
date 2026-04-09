 
<h3 style="margin-left:10px">Announcement</h3><br>
<a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/channelrequest/index.php?view=addAnnouncement" class="btn btn-success" style="float:right;margin-bottom:10px;margin-right:20px">Add Announcement</a> 
<div class="box-body tbl-respon">
<table class="table table-bordered table-striped tbl-respon2" id="example1">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Title</th>
       
      <th scope="col">Announcement Date</th>
	  <th scope="col">Edit</th>
	    <th scope="col">Delete</th>
    </tr>
  </thead>
  <tbody>
   
	<?php
    $alldata="select*from spnews_announcement order by id ASC";
	$mydata= dbQuery($dbConn,$alldata);
	 
	while($rows=mysqli_fetch_assoc($mydata))
	{
		 
	?>
	 <tr>
      <td><?php echo  $rows['id']; ?></td>
      <td><?php echo  $rows['title']; ?></td>
       
      <td><?php echo $rows['create_ondate']; ?></td>
	   <td><a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/channelrequest/index.php?view=editAnnouncement&id=<?php echo $rows['id']; ?>" class="btn btn-primary">Edit</a></td>
	   <td>
	  <!-- <a href="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/channelrequest/index.php?view=delAnnouncement&id=<?php echo $rows['id']; ?>" class="btn btn-danger">Delete</a>-->
	   
	   <a href="javascript:deleteAnnouncement(<?php echo $rows['id']; ?>)" data-original-title="delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
	   
	   
	   </td>
    </tr>
    <?php }
		?>
  </tbody>
</table>
</div>


<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "ASC" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  } );
  
        
	 
  
	
  
		   
} );

	</script>
	