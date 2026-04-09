<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}


    if(isset($_POST['submit_module'])){
   
        $user=$_POST['general'];
       $aa= "INSERT INTO tbl_setting (general_comm) VALUES ($user)";
       //echo $aa;die('=====');
       $result4  = dbQuery($dbConn, $aa);
       
    }
   

?>
<style>
	<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}
	</style>
	
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>General Commission <small>[List]</small></h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
        <form action ="" method="post">
			<div class="box-body"> 
            <label for="fname">General Commission %:</label> 
           
		   <input type="number" id="quantity" name="general" min="0" max="100">
		   
		   <br><br>
				
			
				
			</div>
            <button class="pull-right btn btn-warning" type="submit" name="submit_module">Save </button> 
            </form>
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
		