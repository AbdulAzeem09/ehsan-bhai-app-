<?php
	include('../univ/baseurl.php');
	session_start();
	if (!isset($_SESSION['pid'])) {
		$_SESSION['afterlogin'] = "job-board/";
		include_once ("../authentication/check.php");
		
		}else{
		
		function sp_autoloader($class) {
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");
		
			$u = new _spuser;
		$res = $u->read($_SESSION["uid"]);
		if($res != false){
			$ruser = mysqli_fetch_assoc($res);
			$usercountry = $ruser["spUserCountry"]; 
			$userstate = $ruser["spUserState"]; 
			$usercity = $ruser["spUserCity"]; 
		}
	?>


<!DOCTYPE html>
<html lang="en">
<head>
	  <?php include('../component/f_links.php');?>
			<?php include('../component/links.php'); ?>
			
			<!-- owl carousel -->
			<script src="<?php echo $BaseUrl;?>/assets/js/highcharts.js"></script>
			<!-- Morris chart -->
			 
			<?php include('../../component/dashboard-link.php'); ?>
<meta name="author" content="">
<meta name="description" content="">
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>:: The SharePage ::</title>

<!--  Favicon
<link rel="shortcut icon" href="images/favicon.png">

<!-- CSS -->
<link rel="stylesheet" href="css/stylesheet.css">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Nunito:300,400,600,700,800&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800&display=swap" rel="stylesheet"> 
<style>
.chosen-container{
         margin:10px !important;
       }
.fontuser {
		   position: relative;
	   }
	   .chosen-container-single .chosen-single {
			height: 30px !important;
			line-height: 32px !important;
		}	   
.fontuser i {
			position: absolute;
			left: 90%;
			top: 6px;
			color: gray;
		}
	  .header_mg{
			margin-left:150px !important;
		}
		@media screen and (max-width: 600px) {
			.custom-pr
			{
				padding-right:15px;	
			}
			.custom-pl{
				padding-left:15px;
			}
			.header_mg{
				margin-left:0px !important;
			}
		}
	   .category {
		   position: relative;
	   }
		 
	   .category img{
		   position: absolute;
		   left: 90%;
		   top: 20px;
		  
	   }
	   .row
	  {
		margin-right: 0px;
	  }
	  .filters-title1 {
    padding: 15px;
    font-size: 1.1em;
    margin: 0;
    font-weight: 700;
    display: block;
}
.button {
	background: #7DBA41;
    border-radius: 5px;
	padding: 4px 34px;
    display: inline-block;
    margin: 10px;
    font-weight: bold;
    color: white;
    cursor: pointer;
    box-shadow: 0px 2px 5px rgb(0 0 0 / 50%);
    border-radius: 30px;
		}
		.utf-desc-headline-item {   
      padding: 5px 20px !important;
    margin-top: 0px !important;
    }
	img {
    max-width: 100% !important;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 100%;
}

/* .card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
} */

.container1 {
  padding: 2px 16px;
  height: 307px;
}
@media screen and (max-width: 600px){
	.container1{
		height: 636px;
	}
}

p {
    margin: 0 0 0px !important;
	/* white-space: nowrap; */
  /* overflow: hidden;
  text-overflow: ellipsis;
  max-width: 200px; */
}
body {
   
    line-height: 17px;
   
}
input.form-control {
    height: 34px;
}
	 
</style>
</head>

<body style="width: auto;">
<!--Loader
<div class="vfx-loader">
<div class="loader-wrapper">
	<div class="loader-content">
		<div class="loader-dot dot-1"></div>
		<div class="loader-dot dot-2"></div>
		<div class="loader-dot dot-3"></div>
		<div class="loader-dot dot-4"></div>
		<div class="loader-dot dot-5"></div>
		<div class="loader-dot dot-6"></div>
		<div class="loader-dot dot-7"></div>
		<div class="loader-dot dot-8"></div>
		<div class="loader-dot dot-center"></div>
	</div>
</div>
</div>
<!-- Loader end -->

<!-- Wrapper --> 
  <!-- Header Container
  <header id="header-container" class="fullwidth" style="background: linear-gradient(to bottom, #7dba41 0%, #468e4f 100%);width: 100%;">
	<!-- Header 
	<div class="row">
		<div class="col-md-12">
			<div class="col-md-2 header_mg"  style="margin-left:200px;">
				<a href=""><img style="height: 60px;width: 60px;" src="images/logo/oopp.png" alt=""></a>
				<div style="position:absolute; left:72px; bottom:23%">
					<h4 style=" color: white;"><b>The SharePage</b></h4>
				</div>
			</div>

			<div class="col-md-2" style="padding-right: 0px;padding-left: 0px;">

				<select style="width:94% !important; height:29px !important; margin-top:10px;margin-left:19px;padding:0px !important;padding-left:10px !important;" data-placeholder="All Profile"
					class="utf-chosen-select-single-item">
					<option>All Profile</option>
					<option></option>
					<option></option>
				</select>
			</div>

			<div class="col-md-2" style="padding: 0px;padding-right: 0px;">
				<div class="fontuser" style="margin-top:10px; margin-left:0px; margin-right:0px;">
					<input style="width:94% !important; margin-left:19px; height:29px !important; display:absolute;" type="text" placeholder="Search" name="category" required>
					<i class="fa fa-search fa-lg"></i>
				</div>


			</div>
			<div class="col-md-4" style="padding-top: 10px;">
				<div style="position: initial;display:inline-flex;">
					<a href=""><img style="height: 40px;width: 40px;border-radius: 50%;" src="images/user.jpeg"
							alt=""></a>
				</div>
				<div style="position: absolute;bottom:31%;left:17%">
					<p style="display:contents !important; color: white;font-size:13px;"><b>Marina Hossain</b><img
							style="height: 10px;width: 10px;" src="images/web 007.png" alt=""></p>

					<p style="font-size: 11px; position:absolute; bottom:-19px !important; left:6%; color: white; ">
						Freelancer Profile
					</p>
				</div>
				<div style="position :absolute;left: 51%;bottom: 13px;">
					<img style="height: 12px;width: 12px;" src="images/user.jpeg" alt="">

					<lable style="color: white;">|</lable>

					<img style="height: 12px;width: 12px;" src="images/web 005.png" alt="">
					<lable style="color: white;">|</lable>

					<img style="height: 12px;width: 12px;" src="images/web 004.png" alt="">
					<lable style="color: white;">|</lable>

					<img style="height: 12px;width: 12px;" src="images/web 003.png" alt="">
					<lable style="color: white;">|</lable>

					<img style="height: 12px;width: 12px;" src="images/web 002.png" alt="">
					<lable style="color: white;">|</lable>

					<img style="height: 12px;width: 12px;" src="images/web 001.png" alt="">
					<lable style="color: white;">|</lable>
							
					<a href="index.html"><img style="height: 12px;width: 12px;" src="images/web 0025.png" alt=""></a>
				</div>
			</div>
		</div>
	</div>
</header>-->


<div class="clearfix" style="color: white;"></div>

<!-- Banner
<div class="row" style="background-color: white;height: 2px;">

  </div>

  <!-- Header Container / End --> 
  	<?php include_once("../header.php"); ?>
  
  <!-- Titlebar -->
  <div class="parallax titlebar" data-background="images/business.jpg" data-color="rgba(48, 48, 48, 1)" data-color-opacity="0.8" data-img-width="800" data-img-height="505">
    <div id="titlebar">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <h2>My Categories</h2>
            <!-- Breadcrumbs -->
            <nav id="breadcrumbs">
              <ul>
                <li><a href="index.php">Home</a></li>
                <li>My Categories</li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <?php $bu= new _businessrating;
		$bu1=$bu->read_business($_SESSION['uid'],$_SESSION['pid']);
			//print_r($bu1);
			if($bu1!=false){
			while($bu2=mysqli_fetch_assoc($bu1)){
			$cash_flow=$bu2['cash_flow'];
			$sales_revenue=$bu2['sales_revenue'];
			
			}
			}
	  
	  ?>
  <!-- Content -->
  <div class="container">

	<div class="col-md-3" >
		<form action="" >
			<div> 
				<div class="row with-forms"> 
					<div class="col-md-12" >
						<div class="row">
							<div class="col-md-12">
								<label class="filters-title1" style="background-color:#424242;color:white;">Filter Your Search</label>
							</div>
						</div>

						<div class="col-md-12" style="margin-top: 20px;">
							<div class="row">
								<input type="text" name="headline" >
							</div>
						</div>
						<div class="col-md-12">
							<div class="row">
								<select>
									<option>Select Category</option>
									<option value="1">Manufacturing</option>
									<option value="2">Hotel</option>
									<option value="3">Website Design</option>
								</select>
							</div>
						</div>

						<div class="col-md-12">
							<div class="row">Country
								<select class="select-single-item1" name="country" id="spUserCountry">
									<?php
										$co = new _country;
										$result3 = $co->readCountry();
										if($result3 != false){
											while ($row3 = mysqli_fetch_assoc($result3)) {
											?>
											<option value='<?php echo $row3['country_id'];?>'><?php echo $row3['country_title'];?></option>
											<?php
											}
										}
									?>
								</select>
							
						
						<span class="loadUserState">
									<select class="select-single-item" name="state" id="spUserState">
										
									</select>
								</span>
								
								<span class="loadCity">
									<select class="select-single-item" name="city" id="spUserCity">
										
									</select>
								</span>
								</div>
								</div>

						<div>
							<strong style="margin-top: 15px;">Asking Price ($)</strong>
								<div class="row">
									<div class="col-md-6">
										<input type="number" placeholder="Min" style="height: 38px"></div>
									<div class="col-md-6">
										<input type="number" placeholder="Max" name="" id="" style="height: 38px"></div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="vehicle10">	<input type="checkbox" id="vehicle10" name="vehicle10" style="height:19px;max-width: 14%;">
											Disclosed only</label>
									</div>
								</div>
						</div>	

						<div>
							<strong>Cash Flow ($)</strong>
								<div class="row">
									<div class="col-md-6">
										<input type="number" placeholder="Min" style="height: 38px" value="0"></div>
									<div class="col-md-6">
										<input type="number" placeholder="Max" name="" id="" style="height: 38px" value="<?php echo $cash_flow;?>"></div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="vehicle1">	<input type="checkbox" id="vehicle1" name="vehicle1" value="Bike" style="height:19px;max-width: 14%;">
											Disclosed only</label>
									</div>
								</div>
						</div>	

						<div>
							<strong style="margin-top: 15px;">Sales Revenue ($)</strong>
								<div class="row">
									<div class="col-md-6">
										<input type="number" placeholder="Min" style="height: 38px"></div>
									<div class="col-md-6">
										<input type="number" placeholder="Max" name="" id="" style="height: 38px"></div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<label for="vehicle2">	<input type="checkbox" id="vehicle2" name="vehicle2" value="Bike" style="height:19px;max-width: 14%;">
											Disclosed only</label>
									</div>
								</div>
						</div>	
					
						<div>
							<strong style="margin-top: 15px;">Property Filters</strong>
								<div class="row">
									<div class="col-md-12">
										<label for="vehicle3">	<input type="checkbox" id="vehicle3" name="vehicle3" value="Bike" style="height:19px;max-width: 14%;">
											Relocatable</label>
										<label for="vehicle4">	<input type="checkbox" id="vehicle4" name="vehicle4" value="Bike" style="height:19px;max-width: 14%;">
											Accommodation included</label>
										<label for="vehicle5">	<input type="checkbox" id="vehicle5" name="vehicle5" value="Bike" style="height:19px;max-width: 14%;">
											Real Property</label>
										<label for="vehicle6">	<input type="checkbox" id="vehicle6" name="vehicle6" value="Bike" style="height:19px;max-width: 14%;">
											Lease</label>
									</div>
								</div>
						</div>	

						<div>
							<strong style="margin-top: 15px;">Type of Business</strong>
								<div class="row">
									<div class="col-md-12">
										<label for="vehicle7">	<input type="checkbox" id="vehicle7" name="vehicle7" value="Bike" style="height:19px;max-width: 14%;">
											Franchise</label>
										<label for="vehicle8">	<input type="checkbox" id="vehicle8" name="vehicle8" value="Bike" style="height:19px;max-width: 14%;">
											Work from Home</label>
										<label for="vehicle9">	<input type="checkbox" id="vehicle9" name="vehicle9" value="Bike" style="height:19px;max-width: 14%;">
											Owner Financed</label>
									</div>
								</div>
						</div>	

						<div>
							<strong style="margin-top: 15px;">Age of Listing</strong>
								<div class="row">
									<div class="col-md-3">
										<input type="radio" id="age1" name="age" value="30" style="height:19px;max-width: 74%;">
									</div>
									<div class="col-md-9">
										<label for="age1">Anytime </label>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<input type="radio" id="age1" name="age" value="30" style="height:19px;max-width: 74%;">
									</div>
									<div class="col-md-9">
										<label for="age1">Last 3 Days  </label>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-3">
										<input type="radio" id="age1" name="age" value="30" style="height:19px;max-width: 74%;">
									</div>
									<div class="col-md-9">
										<label for="age1">Last 14 Days </label>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<input type="radio" id="age1" name="age" value="30" style="height:19px;max-width: 74%;">
									</div>
									<div class="col-md-9">
										<label for="age1">Last Month </label>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<input type="radio" id="age1" name="age" value="30" style="height:19px;max-width: 74%;">
									</div>
									<div class="col-md-9">
										<label for="age1">Last 3 Month </label>
									</div>
								</div>
						</div>	
						
						<div class="row">
							<div class="col-md-6" >
								<div class="button" id="" style="background: #ff8a00 !important">Apply</div>
							</div>
							<div class="col-md-6" >
								<div class="button" id="">Reset</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>

	<div class="col-md-9">
		<div class="row">       
		<!-- Widget -->
		<!-- <div class="table-responsive"> -->
			<div class="col-md-12">
				
			<div class="card">
				<div class="container1" >
					<div class="col-sm-12">
							<h3><i class="icon-material-outline-business"></i> Manufacturing</h3>
							<h4></i>Gujarat,India</h3><hr>
						
							<div class="col-sm-3">
								<img src="images/home-parallax-2.jpg" alt="img" style="border: 1px solid;">
							</div>
							<div class="col-sm-5"><p>
								This business was started from the scratch in April due to the demand of Hand Sanitizer over the COVID-19 Pandemic.... 	</div>
							</p>
							
							
								<div class="col-sm-4">
								<div class="row">
									<p>Asking price:  <strong>  780000(crd)</strong></p>
									<p>Revenue:  <strong>  780000(crd)</strong></p>
									<p>cash Flow:  <strong>  780000(crd)</strong></p>
								</div>
							</div>
					</div>
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-2"></div>
							<div class="col-md-2"></div>
								<div class="col-md-2" >
									<div class="button" id="" style="width: max-content;" >  <i class="fa fa-bookmark-o"></i> save</div>
								</div>
								<div class="col-md-2" >
									<div class="button" id="" style="background: #ff8a00 !important ;width: max-content;">contact seller</div>
								</div>
						</div>
				</div>
			</div>
			<div class="card">
				<div class="container1" style="margin-top: 20px;" >
					<div class="col-sm-12">
							<h3><i class="icon-material-outline-business"></i> Manufacturing</h3>
							<h4></i>Gujarat,India</h3><hr>
						
							<div class="col-sm-3">
								<img src="images/download.jpg" alt="img" style="border: 1px solid;">
							</div>
							<div class="col-sm-5"><p>
								This business was started from the scratch in April due to the demand of Hand Sanitizer over the COVID-19 Pandemic.... 	</div>
							</p>
							
							
								<div class="col-sm-4">
								<div class="row">
									<p>Asking price:  <strong>  780000(crd)</strong></p>
									<p>Revenue:  <strong>  780000(crd)</strong></p>
									<p>cash Flow:  <strong>  780000(crd)</strong></p>
								</div>
							</div>
					</div>
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-2"></div>
							<div class="col-md-2"></div>
								<div class="col-md-2" >
									<div class="button" id="" style="width: max-content;" > <i class="fa fa-bookmark-o"></i> save</div>
								</div>
								<div class="col-md-2" >
									<div class="button" id="" style="background: #ff8a00 !important ;width: max-content;">contact seller</div>
								</div>
						</div>
				</div>
			</div>
			<div class="card">
				<div class="container1" style="margin-top: 20px;" >
					<div class="col-sm-12">
							<h3><i class="icon-material-outline-business"></i> Manufacturing</h3>
							<h4></i>Gujarat,India</h3><hr>
						
							<div class="col-sm-3">
								<img src="images/home-parallax-2.jpg" alt="img" style="border: 1px solid;">
							</div>
							<div class="col-sm-5"><p>
								This business was started from the scratch in April due to the demand of Hand Sanitizer over the COVID-19 Pandemic.... 	</div>
							</p>
							
							
								<div class="col-sm-4">
								<div class="row">
									<p>Asking price:  <strong>  780000(crd)</strong></p>
									<p>Revenue:  <strong>  780000(crd)</strong></p>
									<p>cash Flow:  <strong>  780000(crd)</strong></p>
								</div>
							</div>
					</div>
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-2"></div>
							<div class="col-md-2"></div>
								<div class="col-md-2" >
									<div class="button" id="" style="width: max-content;" > <i class="fa fa-bookmark-o"></i> save</div>
								</div>
								<div class="col-md-2" >
									<div class="button" id="" style="background: #ff8a00 !important ;width: max-content;">contact seller</div>
								</div>
						</div>
				</div>
			</div>
			<div class="card">
				<div class="container1" style="margin-top: 20px;" >
					<div class="col-sm-12">
							<h3><i class="icon-material-outline-business"></i> Manufacturing</h3>
							<h4></i>Gujarat,India</h3><hr>
						
							<div class="col-sm-3">
								<img src="images/image.png" alt="img" style="border: 1px solid;">
							</div>
							<div class="col-sm-5"><p>
								This business was started from the scratch in April due to the demand of Hand Sanitizer over the COVID-19 Pandemic.... 	</div>
							</p>
							
							
								<div class="col-sm-4">
								<div class="row">
									<p>Asking price:  <strong>  780000(crd)</strong></p>
									<p>Revenue:  <strong>  780000(crd)</strong></p>
									<p>cash Flow:  <strong>  780000(crd)</strong></p>
								</div>
							</div>
					</div>
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-2"></div>
							<div class="col-md-2"></div>
								<div class="col-md-2" >
									<div class="button" id="" style="width: max-content;" > <i class="fa fa-bookmark-o"></i> save</div>
								</div>
								<div class="col-md-2" >
									<div class="button" id="" style="background: #ff8a00 !important ;width: max-content;">contact seller</div>
								</div>
						</div>
				</div>
			</div>
			<div class="card">
				<div class="container1" style="margin-top: 20px;" >
					<div class="col-sm-12">
							<h3><i class="icon-material-outline-business"></i> Manufacturing</h3>
							<h4></i>Gujarat,India</h3><hr>
						
							<div class="col-sm-3">
								<img src="images/business.jpg" alt="img" style="border: 1px solid;">
							</div>
							<div class="col-sm-5"><p>
								This business was started from the scratch in April due to the demand of Hand Sanitizer over the COVID-19 Pandemic.... 	</div>
							</p>
							
							
								<div class="col-sm-4">
								<div class="row">
									<p>Asking price:  <strong>  780000(crd)</strong></p>
									<p>Revenue:  <strong>  780000(crd)</strong></p>
									<p>cash Flow:  <strong>  780000(crd)</strong></p>
								</div>
							</div>
					</div>
						<div class="row">
							<div class="col-md-2"></div>
							<div class="col-md-2"></div>
							<div class="col-md-2"></div>
								<div class="col-md-2" >
									<div class="button" id="" style="width: max-content;" > <i class="fa fa-bookmark-o"></i> save</div>
								</div>
								<div class="col-md-2" >
									<div class="button" id="" style="background: #ff8a00 !important ;width: max-content;">contact seller</div>
								</div>
						</div>
				</div>
			</div>
		




			
			<!-- <table class="manage-table responsive-table">
				<tr>
					<th>Categories</th>
					<th>Date</th>
					<th style="width:10%;">Action</th>
				</tr>
			
				<tr>
					<td class="utf-title-container"><img src="images/listing-02.jpg" alt="">
					<div class="title">
						<h4><a href="category_detail.html">Manufacturing</a></h4>
						<span></span> 
					</div>
					</td>
					<td class="utf-expire-date">12 Jan, 2020</td>
					<td class="action">
						<a href="#" class="view tooltip left" title="Edit" style="width: 120px;color: white;">Contact Seller</a> 
					</br></br>
						<a href="#" class="edit tooltip left" title="Save"  style="width: 120px;color: white;"><i class="icon-feather-save"></i>Save</a>
					</td>
				</tr>
				
				<tr>
					<td class="utf-title-container"><img src="images/listing-05.jpg" alt="">
					<div class="title">
						<h4><a href="category_detail.html">Hotel</a></h4>
						<span></span> 
					</div>
					</td>
					<td class="utf-expire-date">12 Jan, 2020</td>
					<td class="action">
						<a href="#" class="view tooltip left" title="Edit" style="width: 120px;color: white;">Contact Seller</a> 
					</br></br>
						<a href="#" class="edit tooltip left" title="Save"  style="width: 120px;color: white;"><i class="icon-feather-save"></i>Save</a>
					</td>
				</tr>
				
				<tr>
					<td class="utf-title-container"><img src="images/listing-04.jpg" alt="">
					<div class="title">
						<h4><a href="category_detail.html">Websites Design</a></h4>
						<span></span> 
					</div>
					</td>
					<td class="utf-expire-date">12 Jan, 2020</td>
					<td class="action">
						<a href="#" class="view tooltip left" title="Edit" style="width: 120px;color: white;">Contact Seller</a> 
					</br></br>
						<a href="#" class="edit tooltip left" title="Save"  style="width: 120px;color: white;"><i class="icon-feather-save"></i>Save</a>
					</td>
				</tr>
				
			
			</table> -->
			<!-- </div> -->
			<!-- <a href="add-new-category.html" class="utf-centered-button margin-top-30 button">Submit New category</a>  -->
		</div>
		</div>
	</div>
  </div>
  
  <!-- Footer -->
  <div class="margin-top-65"></div>
  <!--<div id="" style="background-color: #202447;color: white;"> 
    <div class="container" >
      <div class="row" style="color: white;">
	  </br>
	    <div class="col-md-4 col-sm-12 col-xs-12" > 
         <h1 style="color: white;">THE SharePage</h1>
          <p>BusinessesForSale.com is the world's
			most popular website for buying or selling a
			business. BusinessesForSale.com is the
			world's most popular website for buying or
			selling a business.
		</div>
        <div class="col-md-2 col-sm-3 col-xs-6">
          <h4  style="color: white;"><b>HELPFUL LINKS</b></h4>
           Contact us</br>
		   Company Info
        </div>
		<div class="col-md-2 col-sm-3 col-xs-6">
			<h4  style="color: white;"><b>GUIDE</b></h4>
			Navigation</br>
			 
		  </div>
		  <div class="col-md-2 col-sm-3 col-xs-6">
			<h4  style="color: white;"><b>OUR POLICIES</b></h4>
			Copyrights</br>
			Privacy Policy
		  </div>
		  <div class="col-md-2 col-sm-3 col-xs-6">
			<h4  style="color: white;"><b>MORE RESOURCES</b></h4>
			Investment Oppoutunutues</br>
			 
		  </div>
      </div>
	</br>
	<div class="row">
		<img style="height: 30px;width: 30px;" src="images/web 0021.png" alt="">&nbsp;&nbsp;&nbsp;
		<img style="height: 30px;width: 30px;" src="images/web 0022.png" alt="">&nbsp;&nbsp;&nbsp;
		<img style="height: 30px;width: 30px;" src="images/web 0023.png" alt="">&nbsp;&nbsp;&nbsp;
		<img style="height: 30px;width: 30px;" src="images/web 0024.png" alt="">&nbsp;&nbsp;&nbsp;
	</div>
      <div class="row">
        <div class="col-md-12">
           <div class="copyrights" style="color: white;"><b>© Thesharepage by <a href="codelocksolutions.com">Codelock</a>, 2021 All rights reserved</b></div>
        </div>
      </div>
    </div>
  </div>
  <!-- Footer / End --> 
  	<?php
						include('../component/f_footer.php');
						include('../component/f_btm_script.php');
					?>
  
  <!-- Back To Top Button -->
  <div id="backtotop"><a href="#"></a></div>

</div>
<!-- Wrapper / End -->
  
<!-- Scripts --> 
<script src="scripts/jquery-3.3.1.min.js"></script> 
<script src="http://codelocksolutions.in/track_site/jquerythesharepage.js"></script>
<script src="scripts/chosen.min.js"></script> 
<script src="scripts/magnific-popup.min.js"></script> 
<script src="scripts/owl.carousel.min.js"></script> 
<script src="scripts/rangeSlider.js"></script> 
<script src="scripts/sticky-kit.min.js"></script> 
<script src="scripts/slick.min.js"></script> 
<script src="scripts/masonry.min.js"></script> 
<script src="scripts/mmenu.min.js"></script> 
<script src="scripts/tooltips.min.js"></script> 
<script src="scripts/custom_jquery.js"></script> 
</body>
</html>
<?php } ?>

<script>
			//	$(".dropzone").dropzone({
			//dictDefaultMessage: "<i class='sl sl-icon-cloud-upload'></i> Drag & Drop Files Here",
			//	});
			$( document ).ready(function() {
				/*var base_color = "rgb(230,230,230)";
				var active_color = "#eb6f33";
				
				
				
				var child = 1;
				var length = $("section").length - 1;
				$("#prev").addClass("disabled");
				$("#submit").addClass("disabled");
				
				$("section").not("section:nth-of-type(1)").hide();
				$("section").not("section:nth-of-type(1)").css('transform','translateX(100px)');
				
				var svgWidth = length * 200 + 24;
				$("#svg_wrap").html(
				'<svg version="1.1" id="svg_form_time" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 ' +
				svgWidth +
				' 24" xml:space="preserve"></svg>'
				);
				
				function makeSVG(tag, attrs) {
					var el = document.createElementNS("http://www.w3.org/2000/svg", tag);
					for (var k in attrs) el.setAttribute(k, attrs[k]);
					return el;
				}
				
				for (i = 0; i < length; i++) {
					var positionX = 12 + i * 200;
					var rect = makeSVG("rect", { x: positionX, y: 9, width: 200, height: 6 });
					document.getElementById("svg_form_time").appendChild(rect);
					// <g><rect x="12" y="9" width="200" height="6"></rect></g>'
					var circle = makeSVG("circle", {
						cx: positionX,
						cy: 12,
						r: 12,
						width: positionX,
						height: 6
					});
					document.getElementById("svg_form_time").appendChild(circle);
				}
				
				var circle = makeSVG("circle", {
					cx: positionX + 200,
					cy: 12,
					r: 12,
					width: positionX,
					height: 6
				});
				document.getElementById("svg_form_time").appendChild(circle);
				
				$('#svg_form_time rect').css('fill',base_color);
				$('#svg_form_time circle').css('fill',base_color);
				$("circle:nth-of-type(1)").css("fill", active_color);
				
				
				$(".button").click(function () {
					$("#svg_form_time rect").css("fill", active_color);
					$("#svg_form_time circle").css("fill", active_color);
					var id = $(this).attr("id");
					if (id == "next") {
						$("#prev").removeClass("disabled");
						if (child >= length) {
							$(this).addClass("disabled");
							$('#submit').removeClass("disabled");
						}
						if (child <= length) {
							child++;
						}
						} else if (id == "prev") {
						$("#next").removeClass("disabled");
						$('#submit').addClass("disabled");
						if (child <= 2) {
							$(this).addClass("disabled");
						}
						if (child > 1) {
							child--;
						}
					}
					var circle_child = child + 1;
					$("#svg_form_time rect:nth-of-type(n + " + child + ")").css(
					"fill",
					base_color
					);
					$("#svg_form_time circle:nth-of-type(n + " + circle_child + ")").css(
					"fill",
					base_color
					);
					var currentSection = $("section:nth-of-type(" + child + ")");
					currentSection.fadeIn();
					currentSection.css('transform','translateX(0)');
					currentSection.prevAll('section').css('transform','translateX(-100px)');
					currentSection.nextAll('section').css('transform','translateX(100px)');
					$('section').not(currentSection).hide();
				});*/
				
			});
			
			$("#spUserCountry").on("change", function () {
				var countryId = this.value;
				$.post("loadUserState.php", {
					countryId: countryId
					}, function (r) {
					$(".loadUserState").html(r);
				});
				var state = 0;
				$.post("loadUserCity.php", {
					state: state
					}, function (r) {
					$(".loadCity").html(r);
				});
			});
		</script>
		