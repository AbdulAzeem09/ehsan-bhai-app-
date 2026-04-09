<?php
	
	
	/*error_reporting(E_ALL);
ini_set('display_errors', '1');*/

	
    require_once("../../univ/baseurl.php" );
     session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="dashboard/";
    include_once ("../../authentication/islogin.php");
  
}else{
     function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
    
    $pageactive = 80;
?>


<?php 

if(isset($_POST['btnupdate'])){
	$name=$_POST['name'];
	$email=$_POST['email'];
	$psw=$_POST['psw'];
	$id=$_GET['uid'];

$arr=array(
	"name"=>$name,
	"email"=>$email,
	"password"=>$psw,
	);
//print_r($arr);die();

$aa = new _spPoints;
$result=$aa->update2($arr,$id);
header('location:'.$BaseUrl.'/dashboard/sppoint/testing.php');
	
}

//print_r($result);die('======');

 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../../component/f_links.php');?>
        <!--This script for posting timeline data End-->
        <!-- ===========DSHBOARD LINKS================= -->
        <?php include('../../component/dashboard-link.php');?>
        <!-- ===========PAGE SCRIPT==================== -->
        <script src="<?php echo $BaseUrl; ?>/assets/js/bootstrap-checkbox.js" defer></script>
        
					
    </head>
    <body class="bg_gray" onload="pageOnload('details')">
        <?php
       
        include_once("../../header.php");		
        ?>
        
        <section class="">
            <div class="container-fluid no-padding">
                <div class="row">
                    <!-- left side bar -->
                    <div class="col-md-2 no_pad_right">
                        <?php
                        ;
                        include('../../component/left-dashboard.php');
                        ?>
                    </div>
                    <!-- main content -->
                    <div class="col-md-10 no_pad_left">
                       
						
							
							
						<div class="content">
							<div class="col-md-12 ">
								
		               
								<div class="row">
                         

                     
                           
                         <div class="col-md-12 ">
		<div class="panel with-nav-tabs panel-warning" style=" border-color: #BACCE8;">

				<div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1warning">
						

                   <link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>

<style type="text/css">
    .paginate_button {
  border-radius: 0 !important;
}
</style>
						 
                                <div class="col-md-12 no-padding">
								<span style="text-align:center;"><h4>SpPoint</h4></span>
  <form action="" method="post">
  
  
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" name ="name"id="name" value="<?php echo $row['name']; ?>" aria-describedby="emailHelp" placeholder="Enter name">
   
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">email</label>
    <input type="email" class="form-control" name="email" id="email" value="<?php echo $row['email']; ?>"  aria-describedby="emailHelp" placeholder="Enter email">
   
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="psw" value="<?php echo $row['password']; ?>"  id="exampleInputPassword1" placeholder="Password">
  </div>
  
  <button type="submit" class="btn btn-primary" name="btnupdate">Update</button>
</form>



									
                                </div>
                                </div>
							
 
                                </div>
                                </div>
                            </div>







          

                        </div>
							</div>
							</div>
							
							
							
							
							
                        </div>
                    </div>
                </div>
                




            </div>
        </section>

        
        <?php include('../../component/f_footer.php');?>
        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->
        <?php include('../../component/f_btm_script.php'); ?>
		
		<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
											<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
										
		
		
		
		
		
		
		
        
		

		
		
		
		
		
		
		
		
		
    </body> 
</html>
<?php
} ?>





