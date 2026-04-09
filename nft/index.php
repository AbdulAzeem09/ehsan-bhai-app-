<?php 
include('../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {
	$_SESSION['afterlogin'] = "nft/";
	include_once ("../authentication/check.php");

}else{


	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$conn = _data::getConnection();
	$sql = "SELECT * FROM nft_setting WHERE id=1 LIMIT 1";
      $result = $conn->query($sql);

      $nft_setting = [];

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
        
          $nft_setting = $row;
        
        }
      } 


	$_GET["categoryID"] = 13;
	$header_photo = "header_photo";

	?>
	<!DOCTYPE html>
	<html lang="en-US">

	<head>
		<?php include('../component/f_links.php');?>
		<!-- owl carousel -->
		<link href="<?php echo $BaseUrl;?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo $BaseUrl;?>/assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />

		<script src="<?php echo $BaseUrl;?>/assets/js/owl.carousel.min.js"></script>
		<!--NOTIFICATION-->
		<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css'>
		<!-- this script for slider art -->
		<script>
			$(document).ready(function() {
				$('.owl-carousel').owlCarousel({
					loop: true,
					autoPlay: true,
					responsiveClass: true,
					responsive: {
						0: {
							items: 1,
							nav: false
						},
						600: {
							items: 3,
							nav: false
						},
						1000: {
							items: 4,
							nav: false
						}
					}
				});
			});    
		</script>
		<!-- Magnific Popup core CSS file -->
		<link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
		<!-- Magnific Popup core JS file -->

		<script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
		
		<style>
			body{
				font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
			}
			.bg_orange{
				background-color:#000080;
			}

			.section_event_art {
				display:none;
			}

			.artExhibition{
				display:none;
			}
			#profileDropDown li.active{
				
				background-color: #99068a;
			}
			#profileDropDown li.active a {
               color: #fff;
               }
		}
	}
	
</style>
</head>

<body class="bg_gray">
	<?php include_once("../header.php");?>
	<div id="alertNotEmpProfile" class="modal fade" role="dialog" data-backdrop="static"  data-keyboard="false" >
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content no-radius">

				<div class="modal-body nobusinessProfile text-center" id="jobseakrAlert">
					<h1><i class="fa fa-info" aria-hidden="true"></i></h1>
					<h2>Your current profile does not have <br>access to this page. Please create or  switch<br> your current profile to either  <span>"Professional Profile"</span> to access this page.</h2>
					<div class="space-md"></div>
					<a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn">Create or Switch Profile</a>
					<a href="<?php echo $BaseUrl.'/artandcraft';?>" class="btn">Back to Home</a>
				</div>
			</div>
		</div>
	</div>
	<?php include 'nft_app.php'; ?>
	
       



						<?php include('postshare.php');?>
						<?php 
						include('../component/f_footer.php');
						include('../component/f_btm_script.php'); 
						?>
						<!-- notification js -->
						<script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>







<?php include 'nft_script.php'; ?>
					</body>
					</html>
					<?php
				}
			?>								