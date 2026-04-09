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
		
		
		$_GET["categoryid"] = "2";
		$_GET["categoryName"] = "Job Board";
		$activePage = 5;
		$header_jobBoard = "header_jobBoard";
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
			
	
			
			
			</form>
			
			<?php
			$objpr=new _addtoboard;
			$resultp=$objpr->readdd($_SESSION['uid']);
			while($row66=mysqli_fetch_array($resultp)){
				$res=$row66['City'];
				
				}
				$objcity = new _city;
				$resultp44=$objcity->readCityName($res);
				$row77=mysqli_fetch_assoc($resultp44);
				print_r($row77['city_title']);
				//die('kkkkk');
			
			
			$resultp=$objpr->reammm();
			while($row90=mysqli_fetch_array($resultp)){
			print_r($row90['State']);
				
				}
			?>
			
			
			<?php 
			//$objstore=new _storebanner;
			//$resurlstore=$objstore->read($_SESSION['uid']);
			//while($rowstor=mysqli_fetch_assoc($resurlstore)){
				//print_r($rowstor['spStorebanner']);
				//die('kkkkk');}
				
				
			
			
			?>
			
			
			
			<body class="bg_gray">
				<?php
					include_once("../../header.php");
				?>
				<?php
				if(isset($_POST['submit2'])){
					
					$fname = $_POST['fname'];
					$lname = $_POST['lname'];
					$email = $_POST['email'];
					
					$data=array(
					'Fname'=>$fname,
					'Lname'=>$lname,
					'Email'=>$email
					);
					$objinsert=new _hidepost;
					$objinsert->create33($data);
					}
				
				
				?>
				<div class =container>
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
							
							<button type="submit" name="update2" class="btn btn-primary">update</button>
				
				</form>
				</div>
				
				
					
				
<form action="" method="POST">
	<div class="container">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">InsertFname</label>
    <input type="text" class="form-control" name="fname" aria-describedby="emailHelp">
   
  </div>
  <div class="mb-3">
    <label  class="form-label">Lname</label>
    <input type="text" class="form-control" name="lname" >
  </div>
  
   <div class="mb-3">
    <label  class="form-label">Email</label>
    <input type="email" class="form-control" name="email" >
  </div>
  
  
  
  <button type="submit2" class="btn btn-primary" name="submit2">Submit</button>
  </div>
</form>
<div class="container">
<table class="table table-striped">
               <tr>
			   <th>Fnamne</th>
			   <th>Lname</th>
			   <th>Email</th>
			   <th>Action</th>
			   </tr>
			   <?php
			   $readobj = new _hidepost();
			   $readresult=$readobj->read33();
			   while($row=mysqli_fetch_assoc($readresult)){
				   ?>
				   <tr>
					   <td><?php echo $row['Fname'] ?></td>
					   <td><?php echo $row['Lname'] ?></td>
					   <td><?php echo $row['Email'] ?></td>
					 <td> <a href="?id=<?php echo $row['id'] ?>&status=delete"><i class="fa-solid fa-trash-can"></i></a> </td>
					 <td> <a href="?id=<?php echo $row['id'] ?>&status=update"><i class="fa-solid fa-pen-to-square"></i></a> </td>

					   </tr>
				   
				   <?php
				   }
			   
			   ?>
			   
			  
				
			                 </table>
			</div>
				<?php
				if(isset($_GET['id'])){
				$deleobj= new _hidepost;
				$deleobj->remove33($_GET['id']); 
				}
				
				?>
				
				
				
				
				
				
				
				<?php 
					include('../../component/f_footer.php');
					include('../../component/f_btm_script.php'); 
				?>
				</body>
				</html>
				<?php
			}?>
		