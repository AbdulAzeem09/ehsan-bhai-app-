
<?php
error_reporting(0);

include '../../univ/baseurl.php';
function sp_autoloader($class){
    include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

//unset($_SESSION['otp1']);

if(isset($_POST['submit_module_commmision'])){
   
    $Commsion_1=$_POST['Commsion_1'];
    $Commsion_2=$_POST['Commsion_2'];
    $Commsion_3=$_POST['Commsion_3'];
    


    $update1="UPDATE commission_level SET `first_level_co` = '$Commsion_1', `second_level_co` = '$Commsion_2', `third_level_co` = '$Commsion_3' WHERE id=1";
    
    $result4  = dbQuery($dbConn,$update1);
   
}


?>


<style>
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}
	</style>

    <?php  
       $bb="SELECT * FROM `commission_level` where id=1";
       $data  = dbQuery($dbConn,$bb);
       $row_data = dbFetchAssoc($data);
        
        ?>

<section class="content-header">
		<h1>Commsion Level  For General Friend<small>[List]</small></h1>
	</section>
    <section class="content">
		<div class="box box-success">
        <form action ="" method="post">
            <div class="row">
                <div class="col-md-4">
			<div class="box-body"> 
            <label for="fname">1st Level Commsion %:</label>
            <input type="number" id="Commsion_1" name="Commsion_1" min="0" max="100" value="<?php echo $row_data['first_level_co']; ?>">
            <br> <br>
    </div>
    </div>
    <div class="col-md-4">
    <div class="box-body"> 
           <label for="fname">2nd Level Commsion  %:</label>
            <input type="number" id="Commsion_2" name="Commsion_2" min="0" max="100" value="<?php echo $row_data['second_level_co']; ?>">
        </div>   
        </div> 
        <div class="col-md-4">  
        <div class="box-body">    
            <label for="fname">3rd Level Commsion  %:</label>
            <input type="number" id="Commsion_3" name="Commsion_3" min="0" max="100" value="<?php echo $row_data['third_level_co']; ?>">
          
			</div>
			</div>
            

        </div>
        <button class="pull-right btn btn-warning" type="submit" name="submit_module_commmision" style="margin: 13px;" >Update </button> 
            </form>
				<!--- End Table ---------------->
		</div>
        
		
	</section><!-- /.content -->
