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
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../../component/f_links.php');?>
        <!-- ===== INPAGE SCRIPTS====== -->
        <?php include('../../component/dashboard-link.php'); ?>


    </head>

    <body class="bg_gray">
    	<?php
        
        
        //this is for store header
        $header_store = "header_store";

        include_once("../../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
				<?php 
				$object = new  _productposting ;
if(isset($_POST['submit']))
{
	$fname=$_POST['fname'];
	$lname=$_POST['lname'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$password=$_POST['password'];
	$confirm_password=$_POST['confirm_password'];
	$data=array('firstname'=>$fname,
				'lastname'=>$lname,
				'email'=>$email,
				'phone'=>$phone,
				'password'=>$password,
				'confirmpassword'=>$confirm_password);
	
             	$object->creathari($data);
	
	
	

}
			if($_GET["status"]=="update")
			{
			
           $res=$object->readbyid($_GET['id']);
			$mydat=mysqli_fetch_assoc($res)	;
			
				$fname=$mydat['firstname'];
				$lname=$mydat['lastname'];
				$email=$mydat['email'];
				$phone=$mydat['phone'];
				$password=$mydat['password'];
				$confirm_password=$mydat['confirmpassword'];
					
				if(isset($_POST['update2']))
				{
				    $fname=$_POST['fname'];
					$lname=$_POST['lname'];
					$email=$_POST['email'];
					$phone=$_POST['phone'];
					$password=$_POST['password'];
					$confirm_password=$_POST['confirm_password'];
					$id=$_POST['id'];
					
					$data=array('firstname'=>$fname,
				'lastname'=>$lname,
				'email'=>$email,
				'phone'=>$phone,
				'password'=>$password,
				'confirmpassword'=>$confirm_password);		
	
             	
					$object->updatehari($data,$id);
					
				}
					
			    ?>
				
<form class="m-auto w-50" enctype="multipart/form-data" action="" method="post">
                        <h3 class="text-center">Update Now</h3>
                        <div id="ajaxx"></div>
                        <div class="row">
						<div class="col-sm-6">
                        <div class="form-group">
						<input class="form-control" type="hidden" placeholder="Enter  Name" name="id" id="id" value="<?php echo $mydat['id'];?>">
                            <label>First Name :</label>
                            <input class="form-control" type="text" placeholder="Enter  Name" name="fname" id="fname" value="<?php echo $mydat['firstname'];?>">
                        </div>
						</div>
						<div class="col-sm-6">
                        <div class="form-group">
                            <label>Last Name :</label>
                            <input class="form-control" type="text" placeholder="last name" name="lname" id="lname"/ value="<?php echo $mydat['lastname'];?>">
                        </div>
						</div>
						</div>
                        <div class="row"> 
                       <div class="col-sm-6">
                        <div class="form-group mt-3">
                            <label>Email :</label>
                            <input class="form-control" type="email" placeholder="email" name="email" id="email" value="<?php echo $mydat['email'];?>" >
                            
                        </div>
                        <div id="email_val1" ></div>
                        <div class="email_val2" ></div>
                        </div>
						             <div class="col-sm-6">   
                        <div class="form-group mt-3">
                            <label>Phone :</label>
                            <input class="form-control" type="text" placeholder="mobile no" name="phone" id="phone" value="<?php echo $mydat['phone'];?>">
                        </div>
                        </div>
                        </div>
                       <div class="row"> 
                       <div class="col-sm-6">
                        <div class="form-group mt-3">
                            <label>Password :</label>
                            <input class="form-control" name="password" type="password" placeholder="enter your password" id="password" value="<?php echo $mydat['password'];?>">
                        </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group mt-3">
                            <label>Confirm Password :</label>
                            <input class="form-control" name="confirm_password" type="password" placeholder="please re-enter your password" id="confirm_password" value="<?php echo $mydat['confirmpassword'];?>">
                        </div>
                        </div>
                        </div>
                        
                                             
 						 
                       <div class="text-center mt-3">
					      <button type="submit" class="btn btn-primary" id="submit" name="update2">UPDATE</button>
					   </div>
                    </form>
					<?php
			          }
					  else{
					?>
					<form class="m-auto w-50" enctype="multipart/form-data" action="" method="post">
                        <h3 class="text-center">Register Now</h3>
                        <div id="ajaxx"></div>
                        <div class="row">
						<div class="col-sm-6">
                        <div class="form-group">
                            <label>First Name :</label>
                            <input class="form-control" type="text" placeholder="Enter  Name" name="fname"/ id="fname">
                        </div>
						</div>
						<div class="col-sm-6">
                        <div class="form-group">
                            <label>Last Name :</label>
                            <input class="form-control" type="text" placeholder="last name" name="lname" id="lname"/>
                        </div>
						</div>
						</div>
                        <div class="row"> 
                       <div class="col-sm-6">
                        <div class="form-group mt-3">
                            <label>Email :</label>
                            <input class="form-control" type="email" placeholder="email" name="email" id="email">
                            
                        </div>
                        <div id="email_val1" ></div>
                        <div class="email_val2" ></div>
                        </div>
						             <div class="col-sm-6">   
                        <div class="form-group mt-3">
                            <label>Phone :</label>
                            <input class="form-control" type="text" placeholder="mobile no" name="phone" id="phone">
                        </div>
                        </div>
                        </div>
                       <div class="row"> 
                       <div class="col-sm-6">
                        <div class="form-group mt-3">
                            <label>Password :</label>
                            <input class="form-control" name="password" type="password" placeholder="enter your password" id="password">
                        </div>
                        </div>
                        <div class="col-sm-6">
                        <div class="form-group mt-3">
                            <label>Confirm Password :</label>
                            <input class="form-control" name="confirm_password" type="password" placeholder="please re-enter your password" id="confirm_password">
                        </div>
                        </div>
                        </div>
                        
                                             
 						 
                       <div class="text-center mt-3">
					      <button type="submit" class="btn btn-primary" id="submit" name="submit">SUBMIT</button>
					   </div>
                    </form>
					<?php
					  }
					?>
					
					<table class="table table-bodered table-hover table-dark m-3">
					
							<tr>
								<th>ID</th>
								<th>First Name</th>
								<th>Last Name</th>
								<th>Email</th>
								<th>Mobile NO</th>
							  <th>Update</th>
							  <th>Delete</th>
							  
								
							</tr>
							<?php
							$result=$object->readhari();
												if($_GET['status']=='delete'){
													
												$object->delhari($_GET['id']);
												}
                                                if ($result) {
                                             while ($row = mysqli_fetch_assoc($result)) {
                                        							
							?>
								<tr>
									<td><?php echo $row["id"];?></td>
									<td><?php echo $row["firstname"];?></td>
									<td><?php echo $row["lastname"];?></td>
									<td><?php echo $row["email"];?></td>
									<td><?php echo $row["phone"];?></td>
									<td><a href="?id=<?php echo $row['id']?>&status=update" class="btn btn-success">Edit</a></td>
									<td><a href="?id=<?php echo $row['id']?>&status=delete" class="btn btn-danger">Delete</a></td>
								</tr>
								<?php 
												}
												}
								?>
							</table>
                </div>
            </div>
        </section>



    	<?php 
        include('../../component/f_footer.php');
        include('../../component/f_btm_script.php'); 
        ?>
        
    </body>
</html>
<?php
}?>