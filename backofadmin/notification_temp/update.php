<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}

	
	
?>

<?php 
	
if(isset($_POST['up_module'])){
    $id1=$_GET['id'];
    
	

	$name=$_POST['temp_name'];
    $body_name=$_POST['temp_body'];
	$subject=$_POST['subject'];
  $aa= "UPDATE `notification_temp` SET `temp_name`='$name',`notification_description`=' $body_name',`subject`='$subject' WHERE id=$id1";
   //echo $aa;die('=====');
   $result4  = dbQuery($dbConn,$aa);

    redirect("index.php");

}

$id=$_GET['id'];

$sql =  "SELECT * FROM notification_temp Where id=$id";
$result2  = dbQuery($dbConn, $sql);

$row1 = dbFetchAssoc($result2);



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
		<h1>Edit Template</h1>
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
    <input type="text" class="form-control" id="temp_name" value="<?php echo $row1['temp_name'] ?>" name="temp_name" placeholder="Enter Name" readonly>
	                      
    <label for="exampleInputEmail1">Subject</label>
    <input type="text" class="form-control" id="subject" value="<?php echo $row1['subject'] ?>" name="subject" placeholder="Enter Subject">
    <!-- <textarea> --><br>
	<label for="exampleInputEmail1">Template Body</label>


	<textarea id="compose-textarea" name="temp_body" class="form-control" style="height: 300px">
<?php echo $row1['notification_description'] ?>
</textarea>


<!--     <textarea  class="form-control" id="temp_body" name="temp_body" rows="15"><?php //echo $row1['notification_description'] ?></textarea>
     -->
    <button class="pull-right btn btn-primary" type="submit" name="up_module" style="margin-top: 15px;">Update</button>
                          </div>
                        </div>
                      </div>
					
				</div>
			</div><br>
            
            </form>
				<!--- End Table ---------------->
		</div>
        
		
	</section><!-- /.content -->

	
	
  
		        
