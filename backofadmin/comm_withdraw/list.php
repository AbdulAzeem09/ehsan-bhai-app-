<?php



//die('====================');
if (!defined('WEB_ROOT')) {
	exit;
}


$sql =  "SELECT * FROM spuser ORDER BY `idspUser` DESC";
//echo $sql;die('=====');
$result  = dbQuery($dbConn, $sql);


?>

<?php
$user = '';
if (isset($_POST['submit_module'])) {
	//print_r($_POST['checkbox']);//die('=====');
	//$del="DELETE FROM vip_commission" ;

	$user = $_POST['commission'];
	$aa = "INSERT INTO vip_commission (user_id) VALUES ($user)";
	//echo $aa;die('=====');
	$result4  = dbQuery($dbConn, $aa);
}



?>
<style>
	.content {
		min-height: 150px !important;
	}

	.select2 {
		width: 400px !important;
	}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Content Header (Page header) -->
<section class="content-header">
	<h1>Withdraw Commission<small>[List]</small></h1>
</section>


<div class="box box-success">
<select name="cars" class="form-control" id="cars" onchange="changeLocation(this)" style="width: 15%;margin: 10px;">
	<option value="index.php">Select Option</option>
    <option value="index.php?view=list&status=Accept" <?php echo ($_GET['status'] == 'Accept') ? 'selected' : '' ;?> >Accept</option>
    <option value="index.php?view=list&status=Pending" <?php echo ($_GET['status'] == 'Pending') ? 'selected' : '' ;?> >Pending</option>
    <option value="index.php?view=list&status=All"<?php echo ($_GET['status'] == 'All') ? 'selected' : '' ;?> >All</option>
</select>

	<div class="box-body">



		<div class="table-responsive tbl-respon">
			<table id="example1" class="table table-bordered table-striped tbl-respon2">

				<thead>
					<tr>

						<th>id</th>
						<th>User Name</th>
						<th>Email</th>
						<th>Amount</th>
						<th>Status</th>
						<th>Requested Date</th>
						<th>Acton Date</th>

						<th>Action</th>

					</tr>
				</thead>
				<tbody>
					<?php
					if ($result) {
						$i = 1;
						if($_GET['status'] == 'Accept'){
							$sql =  "SELECT * FROM spcommission_withdraw WHERE status = '1' ORDER BY `id` desc";
					} else if($_GET['status'] == 'Pending'){
						$sql =  "SELECT * FROM spcommission_withdraw WHERE status = '0' ORDER BY `id` desc";
				} else {
						$sql =  "SELECT * FROM spcommission_withdraw ORDER BY `id` desc";
					}
						$result2  = dbQuery($dbConn, $sql);
						//$row2 = dbFetchAssoc($result2);
						//print_r($aa);die('===');
						$i = 1;
						while ($row = dbFetchAssoc($result2)) {
							$id = $row['id'];

							$rr =  "SELECT * FROM spuser WHERE idspUser=$row[uid]";
							$get_row  = dbQuery($dbConn, $rr);
							$user_name = dbFetchAssoc($get_row);

					?>
							<tr>
								<td><?php echo $i; ?></td>

								<td><a href="../registerdUser/index.php?view=detail&uid=<?php echo $row['uid'];?>"><?php echo $user_name['spUserName'];   ?></a></td>
								<td><?php echo $user_name['spUserEmail'];   ?></td>
								<td>USD <?php echo $row['withdraw_amount'];   ?></td>
								<td><?php if ($row['status'] == 1) {
										echo '<span style="color:green;">Accepted</span>';
									} else {
										echo '<span style="color:red;">Pending</span>';
									}   ?></td>
								<td><?php echo $row['requested_date'];   ?></td>
								<td> <?php echo $row['action_date'];   ?></td>
								<td>
									<?php if ($row['status'] == 0) { ?>
										<!--<a class="btn btn-primary" href="/backofadmin/comm_withdraw/index.php?view=approve&id=<?php echo $id; ?>">Approve</a>-->
										<a class="btn btn-primary" onclick="approve(<?php echo $id; ?>)">Approve</a>
									<?php } else {
										echo '----';
									}
									?>



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


</section>




<script type="text/javascript">
	$(document).ready(function() {
		var table = $('#example1').DataTable({

			"order": [
				[0, "desc"]
			],
			pageLength: 10,
			lengthMenu: [
				[10, 20, 50, 100],
				[10, 20, 50, 100]
			]
		});



	});
</script>
<script>
	function approve(id) {
		swal({
				title: "Do You Want to Approve?",
				/*text: "You Want to Logout!",*/
				type: "warning",
				confirmButtonClass: "sweet_ok",
				confirmButtonText: "Yes!",
				cancelButtonClass: "sweet_cancel",
				cancelButtonText: "Cancel",
				showCancelButton: true,
			},
			function(isConfirm) {
				if (isConfirm) {
					window.location.href = '/backofadmin/comm_withdraw/index.php?view=approve&id=' + id;
				}
			});
	}
</script>

<script>
function changeLocation(selectElement) {
    var selectedOption = selectElement.value;
    location.href = selectedOption;
}
</script>