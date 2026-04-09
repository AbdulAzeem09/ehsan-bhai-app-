

<?php
error_reporting(E_ERROR | E_PARSE);
 
	if (!defined('WEB_ROOT')) {
		exit;
	}

	$sql =  "SELECT * FROM event_category";
	$result  = dbQuery($dbConn, $sql);
	
	$msg='';
	// if ($_SERVER['REQUEST_METHOD']=="POST") {
		
	// 	if (isset($_POST['submit'])and !empty($_POST['submit'])) {
			
				/*$module_name=mysqli_real_escape_string($conn,$module);
				$module_id=mysqli_real_escape_string($conn,$id);
				$sql="UPDATE faq SET module_name='$module_name' where id='$module_id'";
				//echo $sql;
				//die();
				$res=mysqli_query($conn,$sql);

				if ($res) {
					if (mysqli_affected_rows($conn)==1) {
						?>
						<script type="text/javascript">
							alert("Record Updated");
						</script>
						<?php
					}
				} */
				
			//}
	// 	}
	// }

if($_GET['action']=="update"){
	if (isset($_POST['submit'])and !empty($_POST['submit'])) {
			
		
				//$sql="UPDATE faq SET module_name='$module_name' where id='$module_id'";
				$sql="UPDATE event_category SET speventTitle= '".$_POST['module']."' where idspevent= '".$_POST['id']."';";
				//echo $sql;
				//die();
				$res = mysqli_query($dbConn,$sql);

				if ($res) {
					if (mysqli_affected_rows($dbConn)==1) {
						?>
						<script type="text/javascript">
							alert("Record Updated");
							window.location.href = "<?php echo $BaseUrl; ?>/backofadmin/evencategory/";
						</script>
						<?php
					}
				} 
				
		
	}
}

if($_GET['action']=="delete"){
			
		
				//$sql="UPDATE faq SET module_name='$module_name' where id='$module_id'";
				$sql="Delete from event_category where idspevent= '".$_GET['id']."';";
				//echo $sql;
				//die();
				$res = mysqli_query($dbConn,$sql);

				if ($res) {
					if (mysqli_affected_rows($dbConn)==1) {
						?>
						<script type="text/javascript">
							//alert("Record Deleted");
							window.location.href = "<?php echo $BaseUrl; ?>/backofadmin/evencategory/";
						</script>
						<?php
					}
				} 
				
}
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header top_heading">
		<h1>Event Category</h1>
	</section>
	<!-- Main content -->
	<section class="content">
        <?php
        include "add.php";
        ?>
		<div class="box box-success">
			
			<?php 
			if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
				if($_SESSION['count'] <= 1){
					$_SESSION['count'] +=1; ?>
					<div class="row" id="alertmsg" style="margin: 5px 0px 0px 5px;" >
						<div style="min-height:10px;"></div>
						<div class="alert alert-<?php echo $_SESSION['data'];?>">
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
							<?php echo $_SESSION['errorMessage'];  ?>
						</div> 
					</div><?php
					unset($_SESSION['errorMessage']);
				}
			} ?>
			
			<!-- /.box-header -->
			<div class="box-body" >
				<div class="table-responsive tbl-respon">
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
						<thead>
							<tr>
								<th style="width: 80px;">ID</th>
								<th>Title</th>
								
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if ($result) {
								$i = 1;
								while ($row = dbFetchAssoc($result)) {
									extract($row);
									?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										<td><?php echo $row['speventTitle']; ?></td>
										<td class="menu-action text-center">

                                            <a onclick="openModalwithdata('<?php echo $row['speventTitle']; ?>','<?php echo $row['idspevent'];?>');" data-toggle="modal" data-target="#myModal" href="javascript:modifyMusic(<?php echo $row['idspevent'];?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>
											
                                           <!-- <a href="?action=delete&id=<?php echo $row['idspevent'];?>" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>-->
											
											<a href="javascript:delete_event_cat(<?php echo $row['idspevent'] ?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
                                            
										
										</td>
									</tr>
									<?php
									$i++;
								}
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
				<!--- End Table ---------------->
		</div>
    



<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal</h4>
        </div>
        <div class="modal-body">
        	<form method="post" action="?action=update">
          <input type="hidden" name="id" id="module_id">
<div class="form-group">
          <label>Module Name</label>

          <input type="text" name="module" id="module_name_id" value="" class="form-control">

</div>          
<div class="form-group">
          <input type="submit" name="submit" class="btn btn-primary">
</div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>    
		
	</section><!-- /.content -->
	<script type="text/javascript">
	

function openModalwithdata(name,id){
document.getElementById("module_name_id").value = name;
document.getElementById("module_id").value = id;

}


$(document).ready( function () {
  var table = $('#example1').DataTable( {
   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  });	   
});

	</script>
		







