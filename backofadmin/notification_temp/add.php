<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}

	
	
?>

<?php 
	
if(isset($_POST['submit_module'])){
    
	$name=$_POST['temp_name'];
	$body_name=$_POST['temp_body'];
	$subject=$_POST['temp_body'];

   $aa="INSERT INTO `notification_temp`(`temp_name`, `notification_description`, `subject`) VALUES ('$name','$body_name','$subject')";
   //echo $aa;die('=====');
   $result4  = dbQuery($dbConn,$aa);

    redirect("index.php");

}



?>
<style>
	.content {
    min-height: 150px!important;
	}
	.select2 {
		width: 400px!important;
	}
    
	</style>

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1> Add Template</h1>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="box box-success">
        <form action ="" method="post">
			<div class="box-body">
				
				
			
				<div class="table-responsive tbl-respon">
				<div class="col-md-8 padding-y-sm mt-2 ">
                        <div class="row mb-4 ">
                          <div class="col-md-12" class="form-control">
                          
    <label for="exampleInputEmail1">Template Name</label>
    <input type="text" class="form-control" id="temp_name" name="temp_name" placeholder="Enter Name">
	<br>
	<label for="exampleInputEmail1">Subject</label>
    <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter Subject">
	 <!-- <textarea> --><br>
	<label for="exampleInputEmail1">Template Body</label>

<textarea id="compose-textarea" name="temp_body" class="form-control" style="height: 300px">
<h1><u>Heading Of Message</u></h1>
<h4>Subheading</h4>
<p>Type Your Content for Email</p>

<p>Thank,</p>
<p>TheSharePage</p>
</textarea>


<!--     <textarea  class="form-control" id="temp_body" name="temp_body" rows="15">Enter...</textarea> -->
   
	<button class="pull-right btn btn-primary" type="submit" name="submit_module" style="margin-top: 15px;">Submit</button> 
                          </div>
                        </div>
                      </div>
					
				</div>
			</div><br>
            
            </form>
				<!--- End Table ---------------->
		</div>
        
		
	</section><!-- /.content -->

	
	
  
		        
