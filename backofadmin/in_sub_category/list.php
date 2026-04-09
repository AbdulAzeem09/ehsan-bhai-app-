<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}


	$sql =  "SELECT * FROM in_sub_category WHERE insubstatus != '-7' ";
	$result  = dbQuery($dbConn, $sql);
	
	
?>

	<!-- Content Header (Page header) -->
	<section class="content-header ">
		<h1>All In-Sub Categories<small>[List]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content">
        <?php
        include "add.php";
        ?>
		<div class="box box-success">
			<div class="box-header text-right">
				<button type="button" name="btnButton"  class="btn btn-primary" onclick="addsubCat()"  ><i class="fa fa-plus"></i> Add In-Sub Category</button>
					
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
			
			
				<div class="table-responsive tbl-respon">
					<table id="example123" class="table table-bordered table-striped tbl-respon2">
						<thead>
							<tr>
								<th style="width: 100px;">Report No</th>
								<th>Category</th>
								<th>Sub Category</th>
								<th class="menu-action text-center">Action</th>
							</tr>
						</thead>
						<tbody id="sub_cat_list">
							<!-- <?php
							if ($result) {
								$i = 1;
								while ($row = dbFetchAssoc($result)) {
									extract($row);
									?>
									<tr>
										<td class="text-center"><?php echo $i; ?></td>
										<td><?php showCategoryForm($dbConn, $idsubCategory); ?></td>
										<td><?php echo $insubcatTitle; ?></td>
										
										<td class="menu-action text-center">
											<a href="javascript:modifySubCategory(<?php echo $idinsubcategory; ?>)" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>
	                                        <a href="javascript:deleteSubCategory(<?php echo $idinsubcategory; ?>)" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
	                                              
												
										</td>
									</tr>
									<?php
									$i++;
								}
							}
							?> -->
						</tbody>
					</table>
				</div>
			</div>
				<!--- End Table ---------------->
		</div>
        
		
	</section><!-- /.content -->

		<script type="text/javascript">
		
		$(document).ready( function () {
			  // var table = $('#example1').DataTable( {
			  //  "order": [[ 0, "desc" ]],
			  //   pageLength : 10,
			  //   lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100, ]]
			  // } );
			  $("#txtCategory").on("change",function(){
        	 var category_id=$("#txtCategory").find('option:selected').val();
        	 $("#sub_cat_list").empty();
        	 $.ajax({
			        url: "get_sub_cat.php",
			        data: { category_id:category_id },
			        datatype:"json",
			        type: "post",
			        success: function(data){
			        	console.log(data);
			           $("#sub_cat_list").append(data);
			        }
			    });
			}).trigger('change');
		} );

	</script>	
			