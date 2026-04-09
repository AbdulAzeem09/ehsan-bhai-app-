<?php
	
    include('../../univ/baseurl.php');
    session_start();
	if(!isset($_SESSION['pid'])){ 
		$_SESSION['afterlogin']="job-board/";
		include_once ("../../authentication/islogin.php");
		
		}else{
		function sp_autoloader($class) {
			include '../../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		
		
		
		
	?>
	<!DOCTYPE html>
	<html lang="en-US">
		
		<head>
			<?php include('../../component/f_links.php');?>
			<!--This script for sticky left and right sidebar STart-->
			
			
			<!-- ===== INPAGE SCRIPTS====== -->
			<!-- High Charts script -->
			<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
			<!-- Morris chart -->
			<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
			
			
			<link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
			<?php include('../../component/dashboard-link.php'); ?>
			
			
			
		</head>
		
		<body class="bg_gray">
			<?php
				include_once("../../header.php");
			?>
			<section class="landing_page">
				<div class="container">
					<div class="row">
						
						<?php
							
							
							if(isset($_POST['submit'])){
								//die('dsfghjk');
								$fname = $_POST['fname'];
								$lname = $_POST['lname'];
								$email = $_POST['email'];
								$phone = $_POST['phone'];
								$password = $_POST['password'];
								$cpassword = $_POST['cpassword'];
								
								$data = array(
								"Fname"=>$fname,
								"Lname"=>$lname,
								"Email"=>$email,
								"Phone"=>$phone,
								"Password"=>$password,
								"CPassword"=>$cpassword
								
								);
								$text = new _jobpostings;
								$text->insertmahesh($data);
								
								
								
							}
							
							
							//update code
							
							if($_GET['status'] == 'update'){
								
								
								
								$upid= $_GET['id'];
								$upget= $text->readbyid($upid);
								$row = mysqli_fetch_assoc($upget);
								//print_r($row);
								
								
								
								
								//die('dsfghjk');
								$id = $row['ID'];
								$fname = $row['Fname'];
								$lname = $row['Lname'];
								$email = $row['Email'];
								$phone = $row['Phone'];
								$password = $row['Password'];
								$cpassword = $row['CPassword'];
								
								
								
								//$text->upmahesh($_GET['id']);
								if(isset($_POST['update2'])){
									//die("hhhh");
							    $id = $_POST['id'];
								$fnamef = $_POST['fname'];
								$lnamef = $_POST['lname'];
								$emailf = $_POST['email'];
								$phonef = $_POST['phone'];
								$passwordf = $_POST['password'];
								$cpasswordf = $_POST['cpassword'];
								
								
								$data = array(
								"Fname"=>$fnamef,
								"Lname"=>$lnamef,
								"Email"=>$emailf,
								"Phone"=>$phonef,
								"Password"=>$passwordf,
								"CPassword"=>$cpasswordf
								
								);	
									$text->upmahesh($data, $id);
									}
								
								
							
							
						?>
						
						
						
						
						
						<form method="POST" action = "">
							<div class="mb-3">
								<h1 style = "text-align:center">UPDATE FORM </h1>
								 <input type="hidden" name="id" class="form-control" value="<?php echo $id?>"
								  
								<label for="exampleInputEmail1" class="form-label">Fname</label>
								<input type="text" class="form-control" value="<?php echo $fname ?>"
								name="fname" id="exampleInputEmail1" aria-describedby="emailHelp">
								<div id="emailHelp" class="form-text"></div>
							</div>
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">Lname</label>
								<input type="text" class="form-control" value="<?php echo $lname ?>" name="lname">
							</div>
							
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">Email</label>
								<input type="email" class="form-control" value="<?php echo $email ?>" name="email" >
							</div>
							
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">Phone</label>
								<input type="number" class="form-control" value="<?php echo $phone ?>" name="phone" >
							</div>
							
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">Password</label>
								<input type="password" class="form-control" value="<?php echo $password ?>" name="password" >
							</div>
							
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">CPassword</label>
								<input type="password" class="form-control" value="<?php echo $cpassword ?>" name="cpassword" >
							</div>
							
							<button type="submit" name="update2" class="btn btn-primary">update</button>
							
						</form>
						<?php
						}
						else{
						?>		
						
						
						
						<form method="POST" action = "">
							<div class="mb-3">
								<h1 style="text-align:center">INSERT FORM</h1>
								<label for="exampleInputEmail1" class="form-label">Fname</label>
								<input type="text" class="form-control" name="fname" id="exampleInputEmail1" aria-describedby="emailHelp">
								<div id="emailHelp" class="form-text"></div>
							</div>
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">Lname</label>
								<input type="text" class="form-control" name="lname">
							</div>
							
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">Email</label>
								<input type="email" class="form-control"name="email" >
							</div>
							
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">Phone</label>
								<input type="number" class="form-control" name="phone" >
							</div>
							
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">Password</label>
								<input type="password" class="form-control" name="password" >
							</div>
							
							<div class="mb-3">
								<label for="exampleInputPassword1" class="form-label">CPassword</label>
								<input type="password" class="form-control" name="cpassword" >
							</div>
							
							<button type="submit" name="submit" class="btn btn-primary">Submit</button>
							
						</form>
						<?php
							
						}
					?>
					
					
					
					
					
					
					<table class="table tabletable-hover justify-content-center">
						<tr>
							<th>id</th>
							<th>Fname</th>
							<th>Lname</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Password</th>
							<th>CPassword</th>
							<th>Update</th>
							<th>Delete</th>
							
						</tr>
						
						
						<?php
							$result=$text->readhari();
							
							if($_GET['status'] == 'delete'){
								$text->delmahesh($_GET['id']);
								
								
								
							}
							
							if ($result) {
								while ($row = mysqli_fetch_assoc($result)) { 
								?> 
								
								
								<tr>
									<td> <?php echo $row['ID'];?> </td>
									<td> <?php echo $row['Fname'];?> </td>
									<td> <?php echo $row['Lname'];?></td>
									<td><?php echo $row['Email'];?></td>
									<td><?php echo $row['Phone'];?></td>
									<td><?php echo $row['Password'];?></td>
									<td><?php echo $row['CPassword'];?></td>
									
									<td> <a href="?id=<?php echo $row['ID'] ?>&status=update"><i class="fa-solid fa-pen-to-square"></i></a></td>
									<td> <a href="?id=<?php echo $row['ID'] ?>&status=delete"><i class="fa-solid fa-trash-can"></i></a> </td>
									
								</<tr>
								<?php
								}
							}
						?>
						
						
						
					</table>					</div>
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
