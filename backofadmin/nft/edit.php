<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}


	$sql =  "SELECT * FROM nft_category WHERE id=".$_GET['id'];
	$result  = dbQuery($dbConn, $sql);


	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>NFT Category<small>[Edit]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
			<div class="box-header text-right">
			
					
			</div>
			<div class="box-body">
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


				<?php while ($row = dbFetchAssoc($result)) { ?>
				<form action="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/nft/process.php" method="post" >
					<input type="hidden" name="action"  value="nft_category_update">
					<input type="hidden" name="id"  value="<?php echo $row['id']; ?>">
				<div class="row">
					<div class="col-md-6">
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control"  value="<?php echo $row['name']; ?>"  required >
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group" style="margin-top: 30px;">
						<button class="btn btn-primary">Save</button>
					</div>
				</div>
				</div>
				</form>
			<?php } ?>
				
			
				
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
		