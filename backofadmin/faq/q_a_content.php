<?php
	
	if (!defined('WEB_ROOT')) {
		exit;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
	</head>
	<body>
	
		<?php
		
		

		if (($_GET['msg'])=='edit') {
			?>
			<br>
			<div class="alert alert-success " role="alert">
   Update Successfully 
</div>
			<?php
		}

	

		if (($_GET['msg'])=='del') {
			?>
			<br>
			<div class="alert alert-danger " role="alert">
   Delete Successfully 
</div>
			<?php
		}

				if (($_GET['msg'])=='add') {
			
			?>
			<br>
			<div class="alert alert-success" role="alert">
  Added Successfully 
</div>
<?php
}
		?>

		<a href="faq_q_a_list.php?view=add" class="btn btn-primary" style="margin-left:30px;margin-top: 40px;">Add Q&A</a><br><br>
		<hr>
		
		<div class="box-body" >
			<div class="table-responsive tbl-respon" style="overflow-x:hidden;">
				<table id="example1" class="table table-bordered table-striped tbl-respon2">
					<thead>
						<tr>
							<th style="width: 80px;">ID</th>
							<th>Module Name</th>
							
							<th>Question</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php
						$sql =  "SELECT * FROM faq_q_a";
						$result  = dbQuery($dbConn, $sql);
						$i=1;
						while($data3 = mysqli_fetch_assoc($result)){ ?>
						
							
							<tr>
								<td class="text-center"><?php echo $i; ?></td>
								<td><?php $m_id=$data3['module_id'];
									$sql4 =  "SELECT * FROM faq where id= $m_id";
									$result4  = dbQuery($dbConn, $sql4);
									$data4 = mysqli_fetch_assoc($result4);
									
								echo $data4['module_name']; ?></td>
								<td><?php 
									
									
									echo $data3['question']; 
									
								?></td>
								
								<td class="menu-action text-center">
							
									<a href="faq_q_a_list.php?view=modify&id=<?php echo $data3['id']; ?>" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>
									
									<a onclick="return confirm('Are you sure you want to delete this item?');" href="processeventcat.php?action=delete_qa&id=<?php echo $data3['id']; ?>" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
									
								</td>
							</tr>

						<?php $i++;
					} ?>
						
					</tbody>
				</table>
			</div>
		</div>

	</body>
</html>					