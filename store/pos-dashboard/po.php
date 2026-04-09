<?php
    include('../../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
    include_once ("../../authentication/islogin.php");
  
}else{
    function sp_autoloader($class){
      include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryid"] = "1";
?>
<!DOCTYPE html>
<html lang="en-US"> 
    
    <head>
        <?php include('../../component/f_links.php');?>
        <!-- ===== INPAGE SCRIPTS====== -->
        <?php include('../../component/dashboard-link.php'); ?>   
        

    </head>
	<style>
#header{margin-top: 25px!important;}
</style>

<style>
			   .swal2-popup {
    
    font-size: 2rem !important;
}
			    
			</style>
    <body class="bg_gray">
    	<?php
        
        $activePage = 1;
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
    
 <section class="main_box">
            <div class="container">
			<a href="<?php echo $BaseUrl.'/store/pos-dashboard/add_po.php'; ?>" class="btn btn-primary pull-right">Add PO</a>
			&nbsp;&nbsp;&nbsp;<a style="margin-right: 12px" href="<?php echo $BaseUrl.'/store/pos-dashboard/add_bulk_po.php'; ?>" class="btn btn-primary pull-right">Import PO</a>
                <div class="row">
				
				 <div id="sidebar" class="col-md-2 hidden-xs no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                               include('left-posmenu.php'); 
                            ?>
                        </div>
                    </div>
					
					
					 <div class="col-md-10 " style="padding-bottom: 15px; margin-top: 10px;">
					        <div class="box box-success">
                                            <div class="box-header">
											
											
                                                
                                            </div><!-- /.box-header -->
                                            <div class="box-body">
											
											
											
											<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
											
                                                <div class="table-responsive" style="overflow-x:hidden;">
                                                    <table class="table table-striped "  class="table table-striped table-bordered dashServ display" id="example" >
                                                        <thead>
                                                            <tr>
                                                                <th  class="text-center">Sr. No</th>
																 <th  class="text-center">Sr. No</th>
                                                               <th  class="text-center">Iteam</th>
                                                                <th  class="text-center">Ship</th>
                                                                
																<!--<th class="text-center">Date</th>-->
																<th><a href="">Action</a></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                           	$p = new _pos_po;
															
	                                                                $result = $p->read_data_po($_SESSION['uid']);
																	//echo $_SESSION['pid'];
																	//var_dump($result); die();
                                                            //echo $p->ta->sql;
                                                            if ($result) {
                                                                $i = 1;
                                                                while($row = mysqli_fetch_assoc($result)) {
																	
																	
																	//echo "<pre>";
																	//print_r($row); die("--------------------------");
                                                                    ?><tr>
																	<td></td>
										                               <td class="text-center "><?php echo $i ;?></td>
																	  <td class="text-center "><span class="smalldot"><?php echo $row['iteam']; ?></span></td>
																	   <td class="text-center "><span class="smalldot"><?php echo $row['ship']; ?></span></td>
                                                           
                                                           
															<!--<td class="text-center"> <?php //echo $row['date']; ?> </td>-->
															<td class="text-center">
										<a href="<?php echo $BaseUrl.'/store/pos-dashboard/update_po.php/?postid='.$row['id']; ?>" class="" data-postid="<?php echo $row['id'];?>"><i style="font-size: 18px;" class="fa fa-edit"></i></a>&nbsp;&nbsp;&nbsp;
										
										<a onclick="deletefun(<?php echo $row['id']; ?>)" ><i style="font-size: 18px; color:red" class="fa fa-trash"></i></a>
													<!--<span onclick ="deletefun('a')" ><i style="font-size: 18px;" class="fa fa-trash"></i></span>-->
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
                                        </div>
					 
	
					
				     </div>
				
				</div>
				</div>
 </section>










    	<?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        // <!-- ========DASHBOARD FOOTER CHARTS====== -->
        include('../../component/dash_btm_script.php');
        ?>
    </body>
</html>
<?php
}
?>

<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>
											
			<script type="text/javascript">
												$(document).ready(function() {
													
													var table = $('#example').DataTable({ 
														select: false,
														"columnDefs": [{
															className: "Name", 
															"targets":[0],
															"visible": false,
															"searchable":false
														}]
													});//End of create main table
													
													
													$('#example tbody').on( 'click', 'tr', function () {
														
														// alert(table.row( this ).data()[0]);
														
													} );
												});
											 </script>
											<script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
											
<script type="text/javascript">
   function deletefun(id){ 
	
 var my_path1 = $("#my_path1").val();
   
	 Swal.fire({
      title: 'Are you sure?',
      text: "It will deleted permanently !",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
         $.ajax({
			type: "GET",
			url: "delete_po.php",
			data: {postid:id}, 
			success: function(response){
				
            window.location.href = "po.php";
			
			}

			});
      }
    })  
	
	
	
}   
      
	  
	   
    </script>

