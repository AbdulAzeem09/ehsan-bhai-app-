<?php

//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
	
	include '../univ/baseurl.php';
	session_start();
	
	if (!isset($_SESSION['pid'])) {
		$_SESSION['afterlogin'] = "videos/";
		include_once "../authentication/check.php";
		
		} else {
		function sp_autoloader($class)
		{
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		
		$f = new _spprofiles;
		//check profile is freelancer or not
		$chekIsEmployment = $f->readEmployment($_SESSION['pid']);
		if($chekIsEmployment !== false){
			$_SESSION['count'] = 0;
			$_SESSION['msg'] = "Employment Profile can not post any video. Please switch to any other profiles.";
		}
		
		$_GET["categoryID"]   = "26";
		$_GET["categoryName"] = "News";
		
		$f = new _spprofilehasprofile;
		
		$totalFrnd = array();
		$result3   = $f->readallfriend($_SESSION['pid']);
		if ($result3 != false) {
			while ($row3 = mysqli_fetch_assoc($result3)) {
				array_push($totalFrnd, $row3['spProfiles_idspProfilesReceiver']);
			}
		}
		
		$result4 = $f->readall($_SESSION['pid']);
		if ($result4 != false) {
			while ($row4 = mysqli_fetch_assoc($result4)) {
				array_push($totalFrnd, $row4['spProfiles_idspProfileSender']);
			}
		}
		
		$friend_ids = implode("','", $totalFrnd);
		$friend_id  = "'" . $friend_ids . "'";
		//echo $friend_id; exit;
		
		$pageactive = 17;
		
	?>
	
	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<?php include '../component/f_links.php';?>
			
			<link rel="stylesheet" href="css/bootstrap.min.css" >
			<!-- Optional theme -->
			<link rel="stylesheet" href="css/bootstrap-theme.min.css">
			<!-- <link rel="stylesheet" type="text/css" href="css/docs.theme.min.css"> -->
			<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<link rel="stylesheet" type="text/css" href="css/newsviews.css">
			<script type="text/javascript">
				let h = window.innerHeight;
				document.getElementById("wrapper").style.height = h+'px';
				alert(h);
			</script>
			<style>
			.imgres a img{
			width:100px;height:100px;	
		 
		}
		.imgres{
			margin-top:-15px;
		}
			</style>
		</head>
		<?php
			//session_start();
			
			$header_select = "header_video";
			include_once "../header.php";
		?>
		
		
		<body cz-shortcut-listen="true">
			<div class="container-fluid">
				<div class="row">
					<div class="lsbar">
						<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars"></i></a>
						<div id="wrapper" class="wrapper">
							
							<?php  include_once("newsSidebar.php"); ?>
							
							<!-- Page Content -->
							<div id="page-content-wrapper">
								<?php
									$msg=$_GET['msg'];
									if($msg=='notaccess'){
									?>
									
									
									<div class='alert alert-danger' role='alert'>
										
										The Channel <b>(<?php echo $_GET['website']; ?>)</b> can not be added as it has been already blocked by the SharePage Admin
									</div>
									
									<?php
									}
									//$mssg=$_GET['mssg'];
									
									//if($mssg=='success'){
										
									?>
									
									
									<!--div class='alert alert-success' role='alert'>
										Your comment is sent successfully.								
										
									</div-->
									
									
									
									
									
									
								
								<div class="container-fluid">
									<div class="row">
										<div class="col-md-6 h style-1">
										<div class="newscontent">
 							<h3>Blocked User</h3> 
										</div>
									<!---------BLOCK USER  LIST--------->
									<?php  
									$pr = new _news;									
									$result=$pr->read_blocklist($_SESSION['pid']);
									if($result!=false){
									while($row=mysqli_fetch_assoc($result)){
										
											//print_r($row); 
									       // die("OOOOOOOOOOOOOOOOOO");	
										
										$whom=$row['whom'];
										$res=$pr->name_of__blocklist($whom);
										$row2=mysqli_fetch_assoc($res);
										$spProfileName=$row2['spProfileName'];
										$spProfilePic=$row2['spProfilePic'];
										
										//print_r($row2);
										//die("OOOOOO");
										
										?>
											
											<a href='<?php echo $BaseUrl;?>/news/profile.php?id=<?php echo $whom;?>'>
											<div class="form-group"style="border-color: red;border:2px solid blue;border-radius:5px;margin-top: 10px;">
												<tr style="border-color: red;"> 
													<?php if($spProfilePic!=false){ ?>
														<td><img  src="<?php echo $spProfilePic; ?>"style="width:80px;height:80px;border-radius:50%;"></td><?php } else
														{		  ?>
														<td><img  src="https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-15.png"style="width:80px;height:80px;border-radius:50%;"></td>
													<?php } ?>
													<td><?php echo $spProfileName;?></td>
													<?php 
														$ids=$_SESSION['pid'];
														$spids=$row2['idspProfiles'];
													 
														
																 $obb=new _news;
													   $blockres=$obb->read_profile_block($ids,$spids); 
													   //print_r($blockres);
													  // die("****************");
															if($blockres!=false){  
														?>
														<td><a href="unblock.php?whom=<?php echo $row2['idspProfiles']; ?>"><span style="font-size:20px;color:blue;margin-left:40px;float: right; padding: 23px;">UnBlock</span></a></td>
														<?php  
														}
														?>
												</tr>
											</div></a>
											<?php 
									}}else{  
										?>
									<div class="alert alert-danger" role="alert">
									Don't have any matching records!
									</div>
									
							<?php	
							} 
							?>
									
										<!---------BLOCK USER  LIST END--------->
										
										
										</div>
										<div class="col-md-6 h style-1">
											<?php  include_once("rightSidebar.php"); ?>
											
										</div>
									</div>
								</div>
							</div>
							<!-- /#page-content-wrapper -->				
						</div>
					</div>
				</div>
			</div>
			<!--================================================== -->
			<script type="text/javascript">
				$("#menu-toggle").click(function(e) {
					e.preventDefault();
					$("#wrapper").toggleClass("toggled");
				});
				
			</script>
			
			<script type="text/javascript">
				$('[data-toggle="collapse"]').on('click', function() {
					var $this = $(this),
					$parent = typeof $this.data('parent')!== 'undefined' ? $($this.data('parent')) : undefined;
					if($parent === undefined) { /* Just toggle my  */
						$this.find('.fa').toggleClass('fa-plus fa-minus');
						return true;
					}
					
					/* Open element will be close if parent !== undefined */
					var currentIcon = $this.find('.fa');
					currentIcon.toggleClass('fa-plus fa-minus');
					$parent.find('.fa').not(currentIcon).removeClass('fa-minus').addClass('fa-plus');
					
				});
				
				
				
				/*$(document).ready(function() {
					$('.check').on('click',function(){
						//alert("KKKKKKKKKKKKKKKK");
						
						var val = $(this).val();
						
						//alert(val);  
						$.ajax({
							type: 'post',
							url: 'update_settings.php',  
							cache:false,
							data: {
								radio: val,
								status:1  
							},
							
							success: function(response){ 
								  
								
								//$("#commentbody").append(html);
							} 				
						});				
					});
					});*/
				
				
				
				
			</script>
		</body>
	</html>
	
	<?php 
	    include('../component/f_footer.php');
	    include('../component/f_btm_script.php'); 
	?>
    <?php
	}
?>