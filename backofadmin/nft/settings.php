<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}


	$sql =  "SELECT * FROM nft_setting WHERE id=1";
	$result  = dbQuery($dbConn, $sql);
	
	
?>
	
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>NFT Setting<small>[List]</small></h1>
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
			 	<form   id="ddd" action="<?php $_SERVER["DOCUMENT_ROOT"]?>/backofadmin/nft/process.php" method="post" >
					<input type="hidden" name="action"  value="nft_setting_update">
				<div class="form-group">
					<label>Instruction</label>
					<textarea id="editor" rows="20" name="ins" ><?php echo $row['ins']; ?></textarea>
				</div>
				<div class="form-group text-center">
					<button  id="save" type="button" class="btn btn-primary" >Save</button>
					<?php 
					$url="/backofadmin/nft/process.php";
					?>
					<!--<a   data-original-title="Update" data-toggle="tooltip" data-placement="top" class="btn btn-primary"> Save  </a>-->
					
				</div>
				</form>
			<?php } ?>
				
			
			</div>
				<!--- End Table ---------------->
		</div>
        
		
	</section><!-- /.content -->

	<script src="https://cdn.ckeditor.com/ckeditor5/34.2.0/classic/ckeditor.js"></script>
<script>

	$(document).ready(function(){
		$("#save").click(function(){
			 
		swal({
  title: "Do You Want to Update This Item?",
  /*text: "You Want to Logout!",*/
  type: "warning",
  confirmButtonClass: "sweet_ok",
  confirmButtonText: "Yes, Update!",
  cancelButtonClass: "sweet_cancel",
  cancelButtonText: "Cancel",
  showCancelButton: true,
},
function(isConfirm) {
  if (isConfirm) {
	  $("#ddd").submit();
  } 
  else{
	  return false;
  }
});
		
		
		});
	});
</script>
	<script type="text/javascript">
		ClassicEditor.create( document.querySelector( '#editor' ) )
                                .then( editor => {
                                        console.log( editor );
                                } )
                                .catch( error => {
                                        console.error( error );
                                } );
	</script>
	