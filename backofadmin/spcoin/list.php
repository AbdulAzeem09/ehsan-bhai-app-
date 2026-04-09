<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}


	$sql =  "SELECT * FROM spcoin_core LIMIT 1";
	$result  = dbQuery($dbConn, $sql);
	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>SP Coin <small>[Settings]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
			
			<div class="box-body">
				<div>
					<?php if(isset($_SESSION['errorMessage']) && isset($_SESSION['count']) && $_SESSION['count'] == 0){ ?>
						 
								<div class="space"></div>
								<p class="alert alert-success"><?php echo $_SESSION['errorMessage'];  ?></p> 								
					<?php unset($_SESSION['errorMessage']); } ?>
					</div>


				<?php if ($result) {
								$i = 1;
								while ($row = dbFetchAssoc($result)) {  ?>
				<form  action="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/spcoin/process.php"  method="post" >
					<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
					<div class="form-group">
						<label>Supply</label>
						<input type="number" name="supply"  class="form-control" value="<?php echo $row['supply']; ?>" required />
					</div>
					<div class="form-group">
						<label>Price</label>
						<input type="number" step="any" name="price"  class="form-control"  value="<?php echo $row['price']; ?>" required />
					</div>

					<div class="form-group">
						<label>Fector up</label>
						<input type="number" step="any" name="fector_up"  class="form-control"  value="<?php echo $row['fector_up']; ?>" required  min="0.5" />
					</div>


					<div class="form-group">
						<label>Fector down</label>
						<input type="number" step="any" name="fector_down"  class="form-control"  value="<?php echo $row['fector_down']; ?>" required min="0.5" />
					</div>

					
					<div class="form-group text-center">
						<button class="btn btn-primary"  type="submit" name="action"  value="sp_coin_update" >Save</button>
					</div>
				</form>

				<table class="table table-bordered">
					<tr>
						<td>Capital</td>
						<td><?php echo number_format($row['price']*$row['supply'],2); ?></td>
					</tr>
				</table>

			<?php } } ?>


				
			
				
			</div>
				<!--- End Table ---------------->
		</div>
        
		
	</section><!-- /.content -->
	<script type="text/javascript">
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  } );
  
		        
		   
} );

	</script>
		