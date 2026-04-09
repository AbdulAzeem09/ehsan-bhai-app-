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

if(isset($_POST['btnsubmit'])){
	$name=$_POST['name'];
    $email=$_POST['email'];
    $psw=$_POST['psw'];

$arr=array(
"name"=>$name,
"email"=>$email,
"password"=>$psw,

);
//print_r($arr);die();

$aa = new _spPoints;
$result=$aa->insert($arr);


	
}

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
  <form action="" method="post" onsubmit="return validate()">
  
  
  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="text" class="form-control" name ="name"id="name" aria-describedby="emailHelp" placeholder="Enter name">
   
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">email</label>
    <input type="email" class="form-control" name="email" id="email" aria-describedby="emailHelp" placeholder="Enter email">
   
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" name="psw" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" class="form-control" name="cpsw" id="exampleInputPassword2" placeholder="RePassword">
    <span id="span1"></span>
  </div>
  
  <button type="submit" class="btn btn-primary" name="btnsubmit">Submit</button>
</form>



<div class="table-responsive mt-3">
  <table class="table tbl_store_setting display" id="example1" cellspacing="0" width="100%" >
                             <thead>
                                <tr><th></th>          
                                <th>Id</th>
                                <th>Name</th>
                                 <th>Email</th>
                                <th>Password</th>
								 <th>Action</th>
                                 </tr>
                            </thead>

     <tbody>
  
        
		  <?php 
		  
		 // echo $BaseUrl;die('==');
		      $bb = new _spPoints;
          $res=$bb->get_data();
		  //print_r($res);die('====');	
		  while($row=mysqli_fetch_assoc($res)){	
//print_r($row);die('======');		  
		  
		  ?>
		    <tr>
			  <td></td>
			  <td><?php echo $row['uid']; ?></td>
			   <td><?php echo $row['name']; ?></td>
			   <td><?php echo $row['email']; ?></td>	
			  <td><?php echo $row['password']; ?></td>
              <td>
			   <a href="<?php echo $BaseUrl . '/dashboard/sppoint/delete.php?uid=' . $row['uid']; ?>" class=""><i class="fa fa-trash btn btn-primary"></i>
			   </a>
               <a href="<?php echo $BaseUrl . '/dashboard/sppoint/update.php?uid=' . $row['uid']; ?>" class=""><i class="fa fa-edit btn btn-primary"></i>
			   </a> 
          </td>
			  </tr>
		  <?php  } ?>
			 
			 
	</tbody>
                                        </table>
                                    </div>
                                </div>
                                </div>


								<!--<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>-->
<!-- <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js'></script> -->
<script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

  <script type="text/javascript">
    $(document).ready(function() {

  var table = $('#example1').DataTable({ 
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
<script>
 function validate(){
	
	 var psw=$("#exampleInputPassword1").val();
	  var cpsw=$("#exampleInputPassword2").val();
	 //alert(psw);
	  //alert(cpsw);
	  if(psw==cpsw){
		  alert("Password Matched");
	  }
	  else{
		  //alert('not');
		  $("#span1").html('Password Not Matche');
		 return false;
	  }
	 
 }
 </script>





