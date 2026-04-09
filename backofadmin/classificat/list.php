<?php

	if (!defined('WEB_ROOT')) {
		exit;
	}


  
	$sql =  "SELECT * FROM clasified_category ";
	$result  = dbQuery($dbConn, $sql);
	
	
?>


<style>
	.content {
    min-height: 150px!important;
	}
	.select2 {
		width: 400px!important;
	}
    
	</style>
	 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1> Classified Category<small>[List]</small></h1>
	</section>
	
	<?php
        include "add.php";
        ?>
		<div class="box box-success">
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
					<table id="example1" class="table table-bordered table-striped tbl-respon2">
                  
						<thead >
							<tr>
							<th style="width: 50px;">ID</th>
								<th>Type</th>
								<th >Title</th>
                                <th class="menu-action text-center">Action</th>
				
								
							</tr>
						</thead>
						<tbody >
						<?php
							if ($result) {
								$i = 1;
								while ($row = dbFetchAssoc($result)) {
									
									extract($row);
									?>
									<tr>
				<td class="text-center"><?php echo $i; ?></td>
				<td><?php echo ($clasifiedType == 0)?'Community':'Services'; ?></td>
				<td><?php echo $clasifiedTitle; ?></td>
                                        <td>
<a href="javascript:modifyCategory('<?php echo $idclasfied;  ?>')" data-original-title="Edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow"> <i class="fa fa-pencil"></i> </a>

<a href="javascript:deleteclassificateCategory('<?php echo $idclasfied;  ?>')" data-original-title="Delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-red"> <i class="fa fa-times"></i> </a>
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
		
		$(document).ready( function () {
  var table = $('#example1').DataTable( {

   "order": [[ 0, "desc" ]],
    pageLength : 10,
    lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
  } );
  
  $("#txtType").on("change",function(){
		     var category_name=$("#txtType").find('option:selected').attr("data-name");
        	 var category_id=$("#txtType").find('option:selected').val();
        	 $("#classificat_list").empty();
        	 $.ajax({
			        url: "get_classificat.php",
			        data: { category_id:category_id,category_name:category_name },
			        datatype:"json",
			        type: "post",
			        success: function(data){
			        	console.log(data);
			           $("#classificat_list").append(data);
			        }
			    });
			}).trigger('change'); 	        
		   
} );
</script>

