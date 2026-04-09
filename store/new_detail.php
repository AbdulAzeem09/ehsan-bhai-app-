
<?php
	
    include('../univ/baseurl.php');
    session_start();
	if(!isset($_SESSION['pid'])){ 
		$_SESSION['afterlogin']="store/";
		include_once ("../authentication/check.php");
		
		}else{
		
		
		if(isset($_GET["postid"]) && $_GET["postid"] >0 && isset($_GET['catid']) && $_GET['catid'] == 1){
			
			}else if(isset($_GET["postid"]) && $_GET["postid"] >0){
            
		}
		
		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		
		spl_autoload_register("sp_autoloader");
		
		$_GET['categoryID'] = 1;
		
		$pr = new _spprofiles;
		$result  = $pr->read($_SESSION["pid"]);
		if ($result != false) {
			$sprows = mysqli_fetch_assoc($result);
			$profileType = $sprows["spProfileType_idspProfileType"];
		}
		
	?>
	<!DOCTYPE html>
	<html lang="en-US">
		<head>
			
			<!--	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
			<!-- <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">  -->
			<?php include('../component/f_links.php');?>
			
			<script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
			<script>
				
				function pageload(id) {
				window.location.href = "detail.php?postid=<?php echo $_GET["postid"];?>&colorid="+id;
				}
				
				
				function execute(settings) {
				$('#sidebar').hcSticky(settings);
				}
				// if page called directly
				jQuery(document).ready(function($){
				if (top === self) {
				execute({
				top: 20,
				bottom: 50
			});
		}
	});
	
	function execute_right(settings) {
		$('#sidebar_right').hcSticky(settings);
	}
	// if page called directly
	jQuery(document).ready(function($){
		if (top === self) {
			execute_right({
				top: 20,
				bottom: 50
			});
		}
	});
	
</script>

<link href="<?php echo $BaseUrl;?>/assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
<script src="<?php echo $BaseUrl;?>/assets/js/bootstrap-multiselect.js" type="text/javascript"></script>

<!-- 	<link rel="stylesheet" type="text/css" href="<?php // echo $BaseUrl;?>/assets/css/design.css">  -->
<script type="text/javascript">
	//USER ONE
	$(function () {
		$('#leftmenu').multiselect({
			includeSelectAllOption: true
		});
		
	});
	
</script>

<script type="text/javascript">
	jQuery(document).ready(function($) {
		
		$('#carousel-text').html($('#slide-content-0').html());
		//Handles the carousel thumbnails
		$('[id^=carousel-selector-]').click( function(){
			var id = this.id.substr(this.id.lastIndexOf("-") + 1);
			var id = parseInt(id);
			$('#myCarousestore').carousel(id);
		});
		// When the carousel slides, auto update the text
		$('#myCarousestore').on('slid.bs.carousel', function (e) {
			var id = $('.item.active').data('slide-number');
			$('#carousel-text').html($('#slide-content-'+id).html());
		});
	});
</script>


<style type="text/css">
	
	.btn_box button, .btn_box input[type="submit"] {
    width: 40%;
    margin-right: 5px;
	}
	
	.panel-heading {
    height: 42px;
    padding: 0px 0px;
    border-bottom: 1px solid transparent;
    border-top-left-radius: 3px;
    border-top-right-radius: 3px;
}

ul.lSPager.lSGallery {
    height: 40px;
}

.right_head_top ul li p {
    color: #fff;
    font-family: lucidaSans;
    font-size: 12px;
    margin: 0;
    padding-top: 0px;
    float: left;
}

.col-md-4.col-xs-12.no-padding {
    height: 20px;
}

	
	.rating-box {
	position:relative!important;
	vertical-align: middle!important;
	font-size: 18px;
	font-family: FontAwesome;
	display:inline-block!important;
	color: lighten(@grayLight, 25%);
	}
	
	.rating-box:before{
	content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
	}
	
	.ratings {
	position: absolute!important;
	left:0;
	top:0;
	white-space:nowrap!important;
	overflow:hidden!important;
	color: Gold!important;
	
	}
	.ratings:before {
	content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
	}
	
	.flag:hover{
	color:#428bca!important;
	}
	
	
	
	.heading {
	font-size: 25px;
	margin-right: 10px;
	}
	
	.checked {
	color: gold;
	}
	
	.side {
	float: left;
	width: 15%;
	margin-top:10px;
	}
	
	.middle {
	margin-top:10px;
	float: left;
	width: 68%;
	padding-left: 10px;
	}
	
	.right {
	text-align: right;
	}
	
	.row:after {
	content: "";
	display: table;
	clear: both;
	}
	
	html {
	scroll-behavior: smooth;
	}
	
	.bar-container {
	width: 100%;
	background-color: #f1f1f1;
	text-align: center;
	color: white;
	}
	
	.bar-5 {width: 60%; height: 18px; background-color: #4CAF50;}
	.bar-4 {width: 30%; height: 18px; background-color: #2196F3;}
	.bar-3 {width: 10%; height: 18px; background-color: #00bcd4;}
	.bar-2 {width: 4%; height: 18px; background-color: #ff9800;}
	.bar-1 {width: 15%; height: 18px; background-color: #f44336;}
	
	/* Responsive layout - make the columns stack on top of each other instead of next to each other */
	@media (max-width: 400px) {
	.side, .middle {
	width: 100%;
	}
	.right {
	display: none;
	}
	}
</style>


</head>

<body lang="en">
	
	<?php
		
		//this is for store header
		$header_store = "header_store";
		
		$folder = "store";
		include("../header.php");
		
		$ponv = new _spproductoptionsvalues;
		$pro = new _spprofiles;
		$p = new _productposting;
		$rd = $p->read($_GET["postid"]);
		
		if ($rd != false) {
			
			$row = mysqli_fetch_assoc($rd);
			
			
			$poster_id = $row['spProfiles_idspProfiles'];    
			$poster_detail = $pro->read($poster_id);
			
			if($poster_detail!= false){
				$poster_row = mysqli_fetch_assoc($poster_detail);
			}
			
			$auctionStatus = $row['auctionStatus'];
			$selltype = $row['sellType'];
			
			if($selltype == "Auction"){
				
				$Quantity = $row['auctionQuantity'];
				
				}elseif($selltype == "Retail"){
				
				$Quantity = $row['retailQuantity'];
				}elseif($selltype == "Wholesaler"){
				
				$Quantity = $row['supplyability'];
			}
			
			if($selltype == "Auction"){
				
				$ItemCondition = $row['auctionStatus'];
				
				}elseif($selltype == "Retail"){
				
				$ItemCondition = $row['retailStatus'];
			}
			
			$price = $row['spPostingPrice'];
			
			if($selltype == "Auction"){
				
				$ExpiryDate = $row['spPostingExpDt'];
				
				}elseif($selltype == "Retail"){
				
				$ExpiryDate = $row['spPostingExpDt'];
			}
			
			
			
			$minorderqty = $row['minorderqty'];
			$supplyability = $row['supplyability'];
			$paymentterm = $row['paymentterm'];
			
			
			$spid = $row['idspPostings'];
			$myuserid   = $poster_row['idspProfiles'];
			
			
			$postingexpire = $row['spPostingExpDt'];
			$PostTitle  = $row['spPostingTitle'];
			$price      = $row['spPostingPrice']; 
			$catid      = $row["spCategories_idspCategory"];
			$wholesaleflag = $row["spPostingsFlag"];
			$button     = $row["spCategoriesButton"];
			$comment    = $row["sppostingscommentstatus"];
			$Country    = $row['spPostingsCountry'];
			$City       = $row['spPostingsCity'];
			$dt         = new DateTime($row['spPostingDate']);
			$desc       = $row['spPostingNotes'];
			$specification       = $row['specification'];
			
			$SellName   = $poster_row['spProfileName'];
			$SellEmail  = $poster_row['spProfileEmail'];
			$SellPhone  = $poster_row['spProfilePhone'];
			$SellAdres  = $row['spprofilesAddress'];
			$SellCity   = $poster_row['spProfilesCity'];
			$SellCounty = $poster_row['spProfilesCountry'];
			$SellId     = $row['spProfiles_idspProfiles'];
			$producttype = $row['product_type'];
			
			$category     = $row['subcategory'];
			
			$p = new _productposting;
			$result4 = $p->publicpost_count($SellId);
			if($result4 != false){
				$SelProduct = mysqli_num_rows($result4);
				}else{
				$SelProduct = 0;
			}
		}
		
		
		$pv = new _productposting;
		$rdf = $pv->read($_GET["postid"]);
		
		if ($rdf != false) {
			
			$rowf = mysqli_fetch_assoc($rdf);
			$spPostFieldValue = $rowf['spPostFieldValue'];
			
		}
		
		$currentDateTime = date('Y-m-d H:i:s');
		$pv = new _spproduct_view;
		
		$allreadyviews =  $pv->readviewed($_SESSION['uid'],$spid);
		
		if($allreadyviews != ""){
			$viewed = mysqli_fetch_assoc($allreadyviews);
			if(empty($allreadyviews)){
				$resv = $pv->insertrecent_viewproduct($spid,$SellId,$_SESSION['uid'],$currentDateTime);
			}
		}
	?>
	<!-- html part -->
	<!DOCTYPE html>
	<html>
		
		<head>
			<meta charset="utf-8">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title></title>
			<link rel="stylesheet" type="text/css" href="css/style.css">
			
			<!-- 
				<link rel="stylesheet" href="css/bootstrap.min.css" >
				<link rel="stylesheet" href="css/bootstrap-theme.min.css">
				
				
			Optional theme -->
			
			
			
			<!-- <link rel="stylesheet" type="text/css" href="css/docs.theme.min.css"> -->
			<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			
			<link rel='stylesheet' href='https://sachinchoolur.github.io/lightslider/dist/css/lightslider.css'>
			<!-- jQuery (necessary for Bootstrap's JavaScript plugins)
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
				-->
			
			<!-- Latest compiled and minified JavaScript
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>	
				-->
			
		</head>
		<style type="text/css">
			
			.btn-light.wishlist {
			background-color: white;
			}
			.card {
			background-color: #fff;
			padding: 14px;
			border: none
			}
			
			.demo {
			width: 100%
			}
			
			ul {
			list-style: none outside none;
			padding-left: 0;
			margin-bottom: 0
			}
			
			
			
			img {
			display: block;
			height: auto;
			width: 100%
			}
			
			.stars i {
			color: #f6d151
			}
			
			.stars span {
			font-size: 13px
			}
			
			hr {
			color: #d4d4d4
			}
			
			.badge {
			padding: 5px !important;
			padding-bottom: 6px !important
			}
			
			.badge i {
			font-size: 10px
			}
			
			.profile-image {
			width: 35px
			}
			
			.comment-ratings i {
			font-size: 13px
			}
			
			.username {
			font-size: 12px
			}
			
			.comment-profile {
			line-height: 17px
			}
			
			.date span {
			font-size: 12px
			}
			
			.p-ratings i {
			color: #f6d151;
			font-size: 12px
			}
			
			.btn-long {
			padding-left: 35px;
			padding-right: 35px
			}
			
			.buttons {
			margin-top: 15px
			}
			
			.buttons .btn {
			height: 46px
			}
			
			.buttons .cart {
			border-color: #fff;
			color: #fff;
			}
			
			.buttons .cart:hover {
			background-color: #e86464 !important;
			color: #fff
			}
			
			.buttons .buy {
			color: #fff;
			background-color: #ff7676;
			border-color: #ff7676
			}
			
			.buttons .buy:focus,
			.buy:active {
			color: #fff;
			background-color: #ff7676;
			border-color: #ff7676;
			box-shadow: none
			}
			
			.buttons .buy:hover {
			color: #fff;
			background-color: #e86464;
			border-color: #e86464
			}
			
			.buttons .wishlist {
			background-color: #fff;
			border-color: #ff7676
			}
			
			.buttons .wishlist:hover {
			background-color: #e86464;
			border-color: #e86464;
			color: #fff
			}
			
			.buttons .wishlist:hover i {
			color: #fff
			}
			
			.buttons .wishlist i {
			color: #ff7676
			}
			
			.comment-ratings i {
			color: #f6d151
			}
			
			.followers {
			font-size: 9px;
			color: #d6d4d4
			}
			
			.store-image {
			width: 42px
			}
			
			.dot {
			height: 10px;
			width: 10px;
			background-color: #bbb;
			border-radius: 50%;
			display: inline-block;
			margin-right: 5px
			}
			
			.bullet-text {
			font-size: 12px
			}
			
			.my-color {
			margin-top: 10px;
			margin-bottom: 10px;
			display: flex;
			}
			
			label.radio {
			cursor: pointer
			}
			
			label.radio input {
			position: absolute;
			top: 0;
			left: 0;
			visibility: hidden;
			pointer-events: none
			}
			
			label.radio span {
			border: 2px solid #8f37aa;
			display: inline-block;
			color: #8f37aa;
			border-radius: 50%;
			width: 25px;
			height: 25px;
			text-transform: uppercase;
			transition: 0.5s all
			}
			
			label.radio .red {
			background-color: red;
			border-color: red
			}
			
			label.radio .blue {
			background-color: blue;
			border-color: blue
			}
			
			label.radio .green {
			background-color: green;
			border-color: green
			}
			
			label.radio .orange {
			background-color: orange;
			border-color: orange
			}
			
			label.radio input:checked+span {
			color: #fff;
			position: relative
			}
			
			label.radio input:checked+span::before {
			opacity: 1;
			content: '\2713';
			position: absolute;
			font-size: 13px;
			font-weight: bold;
			left: 4px
			}
			
			.card-body {
			padding: 0.3rem 0.3rem 0.2rem
			}
			.font-weight-bold{
			font-weight: bold;
			}
			.similar-products{
			display: flex;
			}
			.checkbox+.checkbox, .radio+.radio {
			margin-top: 10px; 
			}
			.border{
			border: thin solid #ccc; 
			border-radius: 5px ;
			padding: 2px; 
			width: 18rem;
			margin-right: 3px;
			}
		</style>
		
		
		
		
		
		<body cz-shortcut-listen="true"> 
			<div class="container">
			
			
			<div class="row">
                                <div class="col-md-8">
									<?php if ($selltype == 'Retail') { ?>                        
                           
                          <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;  margin-bottom: 12px;">
                            <li><a href="<?php echo $BaseUrl.'/store'; ?>" style="color:#428bca"><i class="fa fa-home" style="color: #337ab7;"></i> Home</a></li>

       <li><a href="<?php echo $BaseUrl.'/retail/view-all.php?condition=All&folder=retail'; ?>" style="color:#428bca">Retail</a></li>

                          <li><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rowf['idspPostings'];?>" style="color:#428bca">Product Detail</a></li>
                                      
                          </ul>

                        <?php }?>

                           <?php if ($selltype == 'Wholesaler') { ?>
                                     
                                    
                                    
                           
                          <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;margin-bottom: 12px;">
                            <li><a href="<?php echo $BaseUrl.'/store'; ?>" style="color:#428bca"><i class="fa fa-home"style="color: #337ab7;"></i> Home</a></li>

                          <li><a href="<?php echo $BaseUrl.'/wholesale'; ?>" style="color:#428bca">Wholesaler</a></li>

                          <li><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rowf['idspPostings'];?>" style="color:#428bca">Product Detail</a></li>
                                      
                          </ul>

                        <?php }?>

                           <?php if ($selltype == 'Auction') { ?>
                                     
                                    
                                    
                           
                          <ul class="breadcrumb" style="padding-bottom: 0px;font-size: 20px; padding: 4px 0px; list-style: none;background: none !important;margin-bottom: 12px;">
                            <li><a href="<?php echo $BaseUrl.'/store'; ?>" style="color:#428bca"><i class="fa fa-home" style="color: #337ab7;"></i> Home</a></li>

                          <li><a href="<?php echo $BaseUrl.'/store/view-all.php?type=auction'; ?>" style="color:#428bca">Auction</a></li>
                          <li><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rowf['idspPostings'];?>" style="color:#428bca">Product Detail</a></li>
                                      
                          </ul>

                        <?php }?>

                                </div>
                             </div>
							 
							 
							 <div class="store_searchbox" style="background-color: #ffff;border-radius: 36px; height:60px" >  
      <form method="POST" action="<?php echo $BaseUrl.'/store/search.php'; ?>">
          <div class="">
              <input type="hidden" name="txtSearchCategory" value="<?php echo (isset($_GET['mystore']))?$_GET['mystore']:'1'?>">
                <?php if($profileType != '2' && $profileType != '5') { 
                    $priceWidth = "74%!important";
                } else {
                    $priceWidth = "88%!important";
                }
                ?> 
              <input style="border-radius: 19px;background-color: #e6eeff;padding:18px 10px;width: <?php echo $priceWidth ?>;" type="text" class="form-control" name="txtStoreSearch" placeholder="Search For Products in <?php echo $selltype;?>" />
              <button type="submit" class="btn btnd_store" name="btnSearchStore" style="padding: 10px 36px;border-radius: 20px;background-color: #035049;">Search</button>
              <?php if($profileType != '2' && $profileType != '5') { ?>
                  <a href="<?php echo $BaseUrl?>/post-ad/sell/?post" class="btn store_search_btn db_btn db_orangebtn sell" style="width: auto;background-color:#2ba805!important;padding: 10px 33px!important;">Sell Product</a>
                <?php } ?>
          </div>                                
      </form>
      
  </div>
			

				<div class="col-md-7 pr-2">
					<div class="card">
						<div class="demo">
							<ul id="lightSlider">
								<?php 
									$pc = new _productpic;
									$res2 = $pc->read($_GET["postid"]);
									if ($res2 != false) {
										
										$x=4;
										while ($rp = mysqli_fetch_assoc($res2)) {
											$pic2 = $rp['spPostingPic'];
										?>
										
										
										<li data-thumb="<?= $pic2; ?>"> <img src="<?= $pic2; ?>" width="200px" height="180px" /> </li>
									<?php } } ?>
									
									<!--		<li data-thumb="https://i.imgur.com/GwiUmQA.jpg"> <img src="https://i.imgur.com/GwiUmQA.jpg" /> </li>
										<li data-thumb="https://i.imgur.com/DhKkTrG.jpg"> <img src="https://i.imgur.com/DhKkTrG.jpg" /> </li>
										<li data-thumb="https://i.imgur.com/kYWqL7k.jpg"> <img src="https://i.imgur.com/kYWqL7k.jpg" /> </li>
										<li data-thumb="https://i.imgur.com/c9uUysL.jpg"> <img src="https://i.imgur.com/c9uUysL.jpg" /> </li>
										<li data-thumb="https://i.imgur.com/KZpuufK.jpg"> <img src="https://i.imgur.com/KZpuufK.jpg" /> </li>
										<li data-thumb="https://i.imgur.com/GwiUmQA.jpg"> <img src="https://i.imgur.com/GwiUmQA.jpg" /> </li>
										<li data-thumb="https://i.imgur.com/DhKkTrG.jpg"> <img src="https://i.imgur.com/DhKkTrG.jpg" /> </li>
										<li data-thumb="https://i.imgur.com/kYWqL7k.jpg"> <img src="https://i.imgur.com/kYWqL7k.jpg" /> </li>
										<li data-thumb="https://i.imgur.com/c9uUysL.jpg"> <img src="https://i.imgur.com/c9uUysL.jpg" /> </li>
										<li data-thumb="https://i.imgur.com/KZpuufK.jpg"> <img src="https://i.imgur.com/KZpuufK.jpg" /> </li>
										<li data-thumb="https://i.imgur.com/GwiUmQA.jpg"> <img src="https://i.imgur.com/GwiUmQA.jpg" /> </li>
										<li data-thumb="https://i.imgur.com/DhKkTrG.jpg"> <img src="https://i.imgur.com/DhKkTrG.jpg" /> </li>
										<li data-thumb="https://i.imgur.com/kYWqL7k.jpg"> <img src="https://i.imgur.com/kYWqL7k.jpg" /> </li>
									<li data-thumb="https://i.imgur.com/c9uUysL.jpg"> <img src="https://i.imgur.com/c9uUysL.jpg" /> </li>   -->
									
									
							</ul>
						</div>
					</div>
					<div class="card mt-2">
						<div class="panel panel-default">
							<div class="panel-heading panel-heading-nav">
								<ul class="nav nav-tabs">
									<li role="presentation" class="active">
										<a href="#reviews" aria-controls="reviews" role="tab" data-toggle="tab">Reviews</a>
									</li>
									<li role="presentation">
										<a href="#tab1default" aria-controls="tab1default" role="tab" data-toggle="tab">Description</a>
									</li>
									<li role="presentation">
										<a href="#tab2default" aria-controls="tab2default" role="tab" data-toggle="tab">Specifications</a>
									</li>
									<li role="presentation">
										<a href="#tab3default" aria-controls="tab3default" role="tab" data-toggle="tab" >Seller</a>
									</li>
								</ul>
							</div>
							<div class="panel-body">
								<div class="tab-content">
									<div role="tabpanel" class="tab-pane fade in active" id="reviews">
										<div class="d-flex flex-row">
											<div class="stars"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div> <span class="ml-1 font-weight-bold">4.6</span>
										</div>
										<hr>
										<div class="badges"> <span class="badge bg-dark ">All (230)</span> <span class="badge bg-dark "> <i class="fa fa-image"></i> 23 </span> <span class="badge bg-dark "> <i class="fa fa-comments-o"></i> 23 </span> <span class="badge bg-warning"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <span class="ml-1">2,123</span> </span> </div>
										<hr>
										<div class="comment-section">
											<div class="d-flex justify-content-between align-items-center">
												<div class="d-flex flex-row align-items-center"> <img src="https://i.imgur.com/o5uMfKo.jpg" class="rounded-circle profile-image">
													<div class="d-flex flex-column ml-1 comment-profile">
														<div class="comment-ratings"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div> <span class="username">Lori Benneth</span>
													</div>
												</div>
												<div class="date"> <span class="text-muted">2 May</span> </div>
											</div>
											<hr>
											<div class="d-flex justify-content-between align-items-center">
												<div class="d-flex flex-row align-items-center"> <img src="https://i.imgur.com/tmdHXOY.jpg" class="rounded-circle profile-image">
													<div class="d-flex flex-column ml-1 comment-profile">
														<div class="comment-ratings"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> </div> <span class="username">Timona Simaung</span>
													</div>
												</div>
												<div class="date"> <span class="text-muted">12 May</span> </div>
											</div>
										</div>
									</div>
									<div class="tab-pane fade in active" id="tab1default">
										<p style="word-break: break-word;"><?php echo $desc;?></p>
										<p><strong style="color: #333333;">Item Condition</strong>: <?php echo $ItemCondition;?></p>
									</div>
									<div class="tab-pane fade" id="tab2default">
										<p><?php if(!empty($specification)){
											echo $specification;
											}else{
											
											echo "No Specification Found";
										}
										
										
										?></p> 
									</div>
									<div  class="tab-pane fade" id="tab3default"  >
										<style>
											
											.seller_info {
											
											background-color: #ffffff;
											border: none;
											padding: 10px;
											}
										</style>
										<p><?php
											
											include('../component/seller-info-tips.php');
											
										?></p>
									</div>	
									
									
									
								</div>
								
							</div>
							
						</div>
						
					</div>
					
				</div>
				
				
				<div class="col-md-5">
					<div class="pull-right">
						<ul>
							<li> <td style="font-size: 12px;">Product:</td>
							<td style="font-size: 12px;"> &nbsp;AEF-<?php echo $_GET['postid'];?></td></li>
						</ul>
					</div>
					<div class="card">
						<div class="about"> <h2 class="font-weight-bold"><?php echo ucwords($PostTitle); ?> </h2>
							
							<table class="table-responsive table-bordered">
								<?php	if($selltype == "Wholesaler"){ ?>
								<tr>
									<td>Whole Sale</td>
									<td>Min Order Qty: <?php echo $minorderqty;?></td>
								</tr>
								<?php
								}
									$or = new _order;
									$total = 0;
									$res = $or->quantityavailable($_GET["postid"]);
									
									if ($res != false) {
										while ($order = mysqli_fetch_assoc($res)) {
											if ($order["spOrderStatus"] == 0) {
												$soldquantity += $order["spOrderQty"];
											}
										}
									}
									
									if (isset($soldquantity)) {
										$available = $Quantity - $soldquantity;
										}else{
										$available = $Quantity;
									}
									if($producttype==1)
									{
										$resultadata = $ponv->readminmaxprice($_GET["postid"],'Store');
										if($resultadata != false){                          
											$attribadata = mysqli_fetch_assoc($resultadata);
										}
										$available = $attribadata['maxqty'];
									}
									
									$userid=$_SESSION['uid'];
									//$profid=$_SESSION['pid'];
									
									$c= new _spuser;
									
									
									$currency= $c->getcurrency($userid);
									$res1= mysqli_fetch_assoc($currency);
									
									//print_r($res1);
									//die();
								?>
								<tr>
									<td><strong>Price</strong></td>
									<td><?php echo $res1['currency'].' '.$price; ?></td>
								</tr>
								<?php  if($producttype==0)
									{?>
									<tr>
										<td><strong>In Stock</strong></td>
										<td><?php echo $available;?></td>
									</tr>
									<?php }
									elseif($producttype!=0)
									{
									?>
									
									<tr>
										<td><strong>In Stock</strong></td>
										<td><?php echo $available;?></td>
									</tr>
									<?php
									}
									
								?>
								<tr>
									<td class="font-weight-bold">Quantity:</td>
									<td class="font-weight-bold">
										<div class="input-group">
											<span class="input-group-btn">
												<button type="button" class="quantity-left-minus btn btn-primary btn-number"  data-type="minus" data-field="">
													<span class="glyphicon glyphicon-minus"></span>
												</button>
											</span>
											<input type="text" id="liveQty" name="spOrderQty" class="form-control input-number" value="20" min="20" max="100">
											<span class="input-group-btn">
												<button type="button" class="quantity-right-plus btn btn-primary btn-number" data-type="plus" data-field="">
													<span class="glyphicon glyphicon-plus"></span>
												</button>
											</span>
										</div>
									</td>
								</tr>
								
								
								
								<!--			<tr>
									<td class="font-weight-bold">Colors:</td>
									<td class="font-weight-bold">
									<div class="my-color"> 
									<label class="radio"> 
									<input type="radio" name="gender" value="MALE" checked> 
									<span class="red"></span> 
									</label> 
									<label class="radio"> 
									<input type="radio" name="gender" value="FEMALE"> 
									<span class="blue"></span> 
									</label> 
									<label class="radio"> 
									<input type="radio" name="gender" value="FEMALE"> 
									<span class="green"></span> 
									</label> 
									<label class="radio"> 
									<input type="radio" name="gender" value="FEMALE"> 
									<span class="orange"></span> 
									</label> 
									</div>
									</td>
								</tr> -->
							</table>
							
						</div>
						
						
						<form enctype="multipart/form-data" action="../buy-sell/sendquotation.php" method="post" id="quotationform">
							
								
							
							<!-- Modal -->
							<div class="modal fade" id="myModal3" role="dialog">
								<div class="modal-dialog">
									
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title">Request For Quotations</h4>
										</div>
										<div class="modal-body">
											<input type="hidden" name="buyeremail_" value=""/>
											<input type="hidden" name="buyername_" value=""/>
											<!-- ==================== -->
											<!-- jo product buy kr raha ha -->
											<input type="hidden" name="spQuotationBuyerid" value="<?php echo $_SESSION['pid']?>" />
											<!-- jo product sale kr raha ha -->
											<input type="hidden" class="dynamic-pid" name="spQuotationSellerid" id="spQuotationSellerid" value="<?php echo $row['spProfiles_idspProfiles']?>" />
											
											
											<!--  <?php   //echo $_POST['data-selrid'];?>  -->
											
											<input type="hidden" name="spPostings_idspPostings" id="spPosting" value="<?php echo $_GET['postid']?>">
											
											<input type="hidden" class="dynamic-pid" name="createddatetime"  value="<?php echo(date("F d, Y h:i:s", $timestamp));?>" />
											<div class="row">
												<div class="col-md-6">
													<div class="form-group">
														<label for="spQuotationTotalQty" class="control-label contact">Quantity Required <span class="red">*</span></label>
														<span id="spQuotationTotalQty_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
														<input type="number" class="form-control" id="spQuotationTotalQty" name="spQuotationTotalQty" onkeyup="keyupQuotationfun()" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group">
														<label for="deleverytime" class="control-label contact">Delivery (Days) <span class="red">*</span></label>
														<span id="deleverytime_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
														<input type="number" required class="form-control" id="deleverytime" name="spQuotationDelevery" min="1" max="50" onkeyup="keyupQuotationfun()">
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label for="spPostingCountry">Country <span class="red">*</span></label>
														<span id="spUserCountry_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
														<select id="spUserCountry" class="form-control " name="spQuotationCountry" onkeyup="keyupQuotationfun()">
															<option value="">Select Country</option>
															<?php
																
																
																
																
																$u = new _spuser; 
																$res = $u->read($_SESSION['uid']);
																if($res != false){ 
																	
																	$ruser = mysqli_fetch_assoc($res);
																	
																	$default_country = $ruser["spUserCountry"];
																	$default_state = $ruser["spUserState"]; 
																	$default_city = $ruser["spUserCity"];
																	
																}
																
																
																
																$co = new _country;
																$result3 = $co->readCountry();
																if($result3 != false){
																	while ($row3 = mysqli_fetch_assoc($result3)) {
																		//print_r($row3);
																	?>
																	<option value='<?php echo $row3['country_id'];?>' <?php echo ($default_country == $row3['country_id'])?'selected':''; ?>><?php echo $row3['country_title'];?></option>
																	<?php
																	}
																}
															?>
														</select>
													</div>
												</div>
												<div class="col-md-4">
													<div class="loadUserState">
														<div class="form-group">
															<label for="spPostingCity">State <span class="red">*</span></label>
															<span id="spUserState_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
															<select class="form-control" name="spQuotationState" id="spUserState" onkeyup="keyupQuotationfun()">
																<option value="">Select State</option>
																<?php if (isset($default_state) && $default_state > 0) {
																	$countryId = $usercountry;
																	$pr = new _state;
																	$result2 = $pr->readState($default_country);
																	if($result2 != false){
																		while ($row2 = mysqli_fetch_assoc($result2)) { ?>
																		<option value='<?php echo $row2["state_id"];?>' <?php echo (isset($default_state) && $default_state == $row2["state_id"] )?'selected':'';?> ><?php echo $row2["state_title"];?> </option>
																		<?php
																		}
																	}
																}
																?>
															</select>
														</div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="loadCity">
														<div class="form-group">
															<label for="spPostingCity">City <span class="red">*</span></label>
															<span id="spUserCity_error" style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
															<select class="form-control" name="spQuotationCity" id="spUserCity" onkeyup="keyupQuotationfun()">
																<option value="">Select City</option>
																<?php 
																	// $stateId = $userstate;
																	
																	$co = new _city;
																	$result3 = $co->readCity($default_state);
																	//echo $co->ta->sql;
																	if($result3 != false){
																		while ($row3 = mysqli_fetch_assoc($result3)) { ?>
																		<option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($default_city) && $default_city == $row3['city_id'])?'selected':''; ?> ><?php echo $row3['city_title'];?></option> <?php
																		}
																		
																	} ?>
															</select>
														</div>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<div class="form-group">
														<label for="productdetails" class="control-label contact">Comments <span class="red">*</span></label>
														<span id="productdetails_error"  style="color:red; margin-bottom: 0px;  font-size: 12px;"></span>
														<textarea class="form-control" id="productdetails" required name="spQuotatioProductDetails" onkeyup="keyupQuotationfun()"></textarea>
													</div>
												</div>
											</div>
										</div>
										
										<div class="modal-footer">
											<div class="modal-footer bg-white br_radius_bottom">
												<button type="button" class="btn btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
												<button type="submit" class="btn btn-submit  db_btn db_primarybtn" id="quotationsubmit">Submit</button>
											</div>
										</div>
									</div>
									
								</div>
							</div>
						</form>
						
						
						
						<form action="<?php echo ($available == 0 ?" ":"../cart/addorder.php");?>" method="post">
							
							
							<table class="table table-striped table-hovered">
								<tbody>
									
									
									<?php
										
										
										
										if($selltype == "Auction"){
											
											$bid = new _spauctionbid;
											$result_bid = $bid->auctionbid($_GET['postid']);
											$result_au  = $bid->get_heigh_auction_priceof_product($_GET['postid']);
											if($result_au != false){
												$row_he = mysqli_fetch_assoc($result_au);
												$HeighestBid = $row_he['auctionPrice'];
												}else{
												$HeighestBid = $price;
											}
											
											if($result_bid != false){
												$totalBid = $result_bid->num_rows;
												}else{
												$totalBid = 0;
											}
										?>
										<div class="auction_box">
											<input type="hidden" id="auctionexp" name="" value="<?php echo $postingexpire;?>">
											<p><strong style="color: #333333;">Expired Date</strong>: <span id="auction_enddate"></span></p>
											<p><strong style="color: #333333;">Total Bids</strong><a href="#tab4default" data-toggle="tab">: <?php echo $totalBid; ?></a></p>
											<p><strong style="color: #333333;">Current Bid</strong>: <strong style="color: #333333;">$<?php echo $HeighestBid;?></strong></p>
											
											<p><strong style="color: #333333;">My Bid</strong>: <strong style="color: #333333;">$<?php 
												$po = new _spauctionbid;
												
												$my_bid = $po->Mylastbid($_GET['postid'],$_SESSION['pid']);
												
												if($my_bid !=""){
													$mybid = mysqli_fetch_assoc($my_bid);
													if(!empty($mybid)){
														echo $mybid['auctionPrice'];
														}else{
														echo '0';
													}  
												}
												
												
											?></strong></p>                                   
											
										</div>
										<?php
											}else{ 
											if ($price != false) {
												$pr = new _postfield;
												$re = $pr->readprice($_GET["postid"]);
												if ($re != false) {
													
													$fprice = "$ ".$price."/hour"; 
													
													} else {
													if ($catid == 9) {
														$ticketprice = $price;
														$fprice = "Ticket Price $". $price; 
														
														} else{
														$fprice = '$'.$price; 
													}
												}
											} 
											if ($catid == 1 || $catid == 9 || $catid == 15 || $selltype =="Retail"){
												//echo $available;
											?>
											<?php
												if($producttype==0)
												{
													
													
													include("variants.php");
													
												}}      
										}
									?>
									
									
								</tbody>
							</table>
							<div class="btn_box <?php echo ($SellId == $_SESSION['pid'])?'hidden':'';?>">
								<input type="hidden" id="spOrderAdid_" name="spOrderAdid_" value="<?php echo $_GET["postid"]?>">
								<input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="<?php echo $_SESSION['pid']?>"/>
								
								<input type="hidden" class="dynamic-pid" id="spBuyeruserId" name="spBuyeruserId" value="<?php echo $_SESSION['uid']?>"/>
								
								<input type="hidden" class="dynamic-pid" id="size" name="size" />
								
								<input type="hidden" class="orderamount" id="sporderAmount" name="sporderAmount" value="<?php echo $price ?>"/>
								<input type="hidden" id="spSellerProfileId" name="spSellerProfileId" value="<?php  echo $row['spProfiles_idspProfiles'];?>"/>
								<input type="hidden" id="cartItemType" name="cartItemType" value="Store"/>
								<!-- <input type="hidden" id="spOrdrQty" name="spOrderQty" value="1" > -->
								
								<?php
									
									//print_r($catid );
									if($catid == 18){
										echo "<button type='button' class='btn btn-primary btn-sm pull-right' data-toggle='modal' data-target='#quotation'><span class='fa fa-quote-left' aria-hidden='true'></span> Send Quotation</button>";
										
										}elseif($catid == 2){
										$p = new _postfield;
										$res = $p->readfield($_GET["postid"]);
										if ($res != false)
										{
											while($rows = mysqli_fetch_assoc($res))
											{
												//echo "<pre>";
												//print_r($rows);
												if($rows["spPostFieldLabel"] == "Closing Date")
												$closingdate = $rows["spPostFieldValue"];
											}
										}
										//Checking already applyed or not
										$profile = new _spprofiles;
										$profileid ="";
										$result = $profile->readjobseeker($_SESSION["uid"]);
										if($result != false)
										{
											$row = mysqli_fetch_assoc($result);
											//print_r($row);die('========');
											$profileid = $row['idspProfiles'];
										}
										
										$p = new _sppost_has_spprofile;
										$res = $p->read($_GET["postid"], $profileid);
										if($res != false)
										{
											echo "<button type='button' class='btn btn-primary btn-sm pull-right disabled'>Applied</button>";
										}
										else{
											
											echo "<button type='button' class='btn btn-primary btn-sm pull-right' data-toggle='modal' data-target='#coverletter' id='applybtn'>Apply Job</button>";
											
										}    
										
										
										include("coverletter.php");
										
										}else if($catid == 5){
										
										echo "<button type='button' class='btn btn-success btn-sm pull-right' data-toggle='modal' data-categoryid='".$catid."' data-postid='".$_GET["postid"]."' data-target='#bid-system' data-profileid='".$_SESSION['pid']."'><span class='fa fa-hand-paper-o'> </span> Bid</button>";
										
										}else if($catid != 18 && $catid != 2 && $catid != 5 && $catid != 7 && $catid != 12) {
										// echo "here";
										if( $catid == 9 ){
											if($ticketprice > 0){
												$buyerid = $_SESSION['pid'];
												$od = new  _order;
												$res = $od->checkorder($_GET["postid"] , $buyerid);
												
												//echo $od->ta->sql;
												if ($res != false)
												{
													echo "<button type='button' class='btn btn-primary btn-sm pull-right disabled' data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."'><span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span> Added to cart</button>";
												}
												else{
													echo "<button type='submit' class='btn btn-primary btn-sm pull-right ".($available == 0 ? "disabled":"")."' id='".($available == 0 ? "":"addtocart")."'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."'><span class='glyphicon glyphicon-shopping-cart' aria-hidden='true'></span>  Buy Ticket</button>";
												}
												}else{
												
												$buyerid = $_SESSION['pid'];
												$od = new  _order;
												$res = $od->checkevent($_GET["postid"] , $buyerid);
												if ($res != false){
													echo "<button type='button' class='btn btn-primary btn-sm pull-right disabled' data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."'>Joined</button>";
												}
												else{
													echo "<button type='button' class='btn btn-primary btn-sm pull-right joinevent' data-profileid='".$_SESSION["pid"]."'  data-postid='".$_GET["postid"]."' data-seller='".$row['idspProfiles']."'>Join</button>";
												}
											}
											
											}else{
											
											$po = new _postfield;
											$result_po = $po->checkAuction($_GET['postid']);
											if($selltype == "Auction"){
												
											?>
											<form id="auct_bid" action="post">
												
												
												<div id="aucdiv" style="padding-bottom: 10px;display: none;padding-top: 27px;padding-bottom: 5px;padding-left: 5px;background-color: whitesmoke;">
													<input type="text" class="form-control activity" id="AuctionPrice" name="auctionPrice" data-filter="0" placeholder="Auction Bid Price...." aria-describedby="basic-addon1" onkeypress="javascript:return isNumber(event)" maxlength="9"   style="margin:0px;" />&nbsp;&nbsp;
													<button type='button' class='btn btn_cart btn_buy_now placebidAuction' style='float:right;padding: 8px;'  >Bid</button>
													
												</div>
												<label for="AuctionPrice" id="bidmsg" style="font-weight: unset;font-size: 12px;padding-top: 4px;padding-right: 220px;background-color: whitesmoke;padding-left: 10px;display: none;">Your bid must be $<?php echo $HeighestBid; ?>  or more</label>
												<div id="invalidBid"></div>
												<!--Hidden attribute-->
												<input type="hidden" name="lastBid" id="lastBid" value="<?php echo $HeighestBid; ?>">
												<input type="hidden" id="spPostings_idspPostings"  name="spPostings_idspPostings" value="<?php echo $_GET['postid'];?>" >
												<input type="hidden" id="spPostFieldBidFlag" value="1">
												<input type="hidden" class="auctioncat" value="1"/>
												<input class="dynamic-pid" id="spProfiles_idspProfiles" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid'] ?>"> 
												
											</form>
											<?php                                                                   
												
												}else{
												
												$exda = date("Y-m-d" , strtotime($ExpiryDate));
												
												$today = date("Y-m-d");
												
												
												if($selltype == "Wholesaler" || $selltype == "Retail"){
													//die('======');
	echo "<button type='submit' class='btn btn_cart_buy btn_buy_now ' id='".($available == 0 ? "":"buytocart")."'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."' name='' ".($available == 0 || $exda < $today ? "":"")."style='background-color:#ff901d!important;'>Buy Now</button>";
													}else{
													echo "<button type='submit' class='btn btn_cart_buy btn_buy_now ' id='".($available == 0 ? "":"buytocart")."'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."' name='' ".($available == 0 || $exda < $today ? "disabled":"")."style='background-color:#ff901d!important;'>Buy Now</button>";
												}
												$buyerid = $_SESSION['pid'];
												$od = new  _order;
												$res = $od->checkorder($_GET["postid"] , $buyerid);
												
												//echo $od->ta->sql;
												if ($res != false && $selltype != "Retail"){
													echo "<button type='button' class='btn btn_cart disabled btn_add_to_cart' data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."'  ".($available == 0 || $exda < $today ? "disabled":"").">Added to cart</button>";
													}else{
													echo "<button type='submit' class='btn btn_cart btn_add_to_cart ".($available == 0 ? "disabled":"")."' id='".($available == 0 ? "":"addtocart")."'  data-postid='".$_GET["postid"]."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."'>Add to cart</button>";
												}
												
												
											}
											
										}
									}
									
								?>
							
							</form>		
							
							
							
							
							
							<?php
								$fv = new _store_favorites;
								
								$res_fv = $fv->chekFavourite($_GET['postid'], $_SESSION['pid'], $_SESSION['uid']);
								if($res_fv != false){   ?>
								
								
								<a href="del_heart.php?catid=<?= $_GET['catid'];?>&postid=<?= $_GET['postid'];?>" class="wholsaleunfav" data-pid="<?php echo $_SESSION['pid'];?>" 
								data-postid="<?php echo $_GET['postid'] ?>"><i class="fa fa-heart" style="font-size:25px;padding:7px 0px"></i> </a>
								
								<?php
									}else{
								?>
							 <a href="add_heart.php?catid=<?= $_GET['catid'];?>&postid=<?= $_GET['postid'];?>" class="wholsalefav" data-pid="<?php echo $_SESSION['pid'];?>" data-postid="<?php echo $_GET['postid'] ?>"><i class="fa fa-heart-o" style="font-size:25px;padding:7px 0px"></i></a>  
								
								<?php
								}
							?>
							
							
							</div>
							<br>
								<!-- Trigger the modal with a button -->
								<a href="javascript:void(0)" data-toggle="modal" data-target="#myModal3" style="color:#337ab7;padding:10px; margin:10px"> Request For Quote </a>
							<hr>
							<div class="product-description">
								<div class="d-flex flex-row align-items-center"> <i class="fa fa-calendar-check-o"></i> 
									<span class="ml-1"><?php      echo "<a href='https://www.google.com/maps/place/". $fullAddr."' target='_blank' style='padding-left: 10px;'>". $fullAddr."</a>"; ?></span> 
								</div>
								<div class="d-flex flex-row align-items-center"> <i class="fa fa-shield"></i>
									<span>Safety Tips for Buyers</span>
									<p>Meet seller at a safe location
										Check the item before you buy
									Pay only after collecting item</p>
									
								</div>				
							</div>
					</div>
					<div class="card mt-2"> <span>Similar items:</span>
						<div class="similar-products mt-2 d-flex flex-row">
							
							<?php
								$p = new _productposting;
								$ps = $p->moreseller_product($SellId,$_GET["postid"]);
								
								
								if(isset($ps) && !empty($ps) && $ps !=" "){
									
									while($row_ps = mysqli_fetch_assoc($ps)){
										
										
										if($row_ps['sellType'] == "Retail"){
											$pic = new _productpic;
											$result = $pic->read($row_ps['idspPostings']);
										?>
										
										<div class="card border p-1" style="width:10rem"> 
											<?php	if ($result != false) {
												$rp = mysqli_fetch_assoc($result);
												$picture = $rp['spPostingPic'];
												echo "<img alt='Posting Pic' style='width:100px;height:100px' class='card-img-top' src=' " . ($picture) . "' >";
												} else{
												echo "<img alt='Posting Pic' src='../img/no.png' style='width:100px;height:100px' class='card-img-top'>";
											}  ?>
											<div class="card-body">
												<h6 class="card-title">
													
													$<?php echo ($row_ps['spPostingPrice'] > 0)?$row_ps['spPostingPrice']:"0";?>
													
												</h6>
												<p><?php echo $row_ps['spPostingTitle']; ?></p>
											</div>
											
										
							</div>		
							<?php }}}?>
						</div>
	
					</div>
				</div>
				<div>
					<?php
					//include('product-seller.php');?>
					
				</div>
				
				
				<!--<div class="similar-products mt-2 d-flex flex-row">
					<div class="card border p-1"> <img src="https://i.imgur.com/KZpuufK.jpg" class="card-img-top" alt="...">
					<div class="card-body">
					<h6 class="card-title">$1,999</h6>
					</div>
					</div>
					<div class="card border p-1"> <img src="https://i.imgur.com/GwiUmQA.jpg" class="card-img-top" alt="...">
					<div class="card-body">
					<h6 class="card-title">$1,699</h6>
					</div>
					</div>
					<div class="card border p-1"> <img src="https://i.imgur.com/c9uUysL.jpg" class="card-img-top" alt="...">
					<div class="card-body">
					<h6 class="card-title">$2,999</h6>
					</div>
					</div>
					<div class="card border p-1" style=""> <img src="https://i.imgur.com/kYWqL7k.jpg" class="card-img-top" alt="...">
					<div class="card-body">
					<h6 class="card-title">$3,999</h6>
					</div>
					</div>												
				</div>-->
				<!--	-->
			</div>
		</div>
		
		<!--================================================== -->
		
		<script src='https://sachinchoolur.github.io/lightslider/dist/js/lightslider.js'></script>
		<script>
			$('#lightSlider').lightSlider({
			gallery: true,
			item: 1,
			loop: true,
			slideMargin: 0,
			thumbItem: 9
			});
		</script>
		<script type="text/javascript">
			$(document).ready(function(){
				
				var quantitiy=20;
				$('.quantity-right-plus').click(function(e){
					
					// Stop acting like a button
					e.preventDefault();
					// Get the field name
					var quantity = parseInt($('#quantity').val());
					
					// If is not undefined
					
					$('#quantity').val(quantity + 1);
					
					
					// Increment
					
				});
				
				$('.quantity-left-minus').click(function(e){
					// Stop acting like a button
					e.preventDefault();
					// Get the field name
					var quantity = parseInt($('#quantity').val());
					
					// If is not undefined
					
					// Increment
					if(quantity>20){
						$('#quantity').val(quantity - 1);
					}
				});
				
			});
		</script>
	</body>
</html>
<!-- html part end-->

<?php include('postshare.php');?>

<div class="modal fade" id="lowestbid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content no-radius bradius-15">
			<form action="../store/auction-bid/rebid.php" method="POST" id="lowestbidfrm" class="sharestorepos">
				<div class="modal-header bg-white br_radius_top">
					<h4 class="modal-title success" style="color:red;"><span id="lowoldbid"></span> </h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					
				</div>
				
				<div class="modal-body sharedimage">
					<span id="lowbidtime" style="float: right;padding-top: 20px;"></span>
					<div class="row">
						
						<div class="col-md-12">
							<p style="color:red"><i class="fa fa-warning" style="color:red"></i>&nbsp;You've been outbid by someone else max bid!<br><p  style="color:black;    padding-left: 22px;">You can Still Win! Try bidding Again!</p></p>
						</div>
					</div>
					
					<div class="row">
						
						<div class="col-md-12">
							
							
							
							<input type="hidden" name="spPostings_idspPostings" id="lownewspPostings_idspPostings" >
							<input type="hidden" name="spProfiles_idspProfiles" id="lownewspProfiles_idspProfiles" >
							<input type="hidden" name="lastBid" id="lownewlastBid" >
							
							<div class="" style="padding-top: 27px;padding-bottom: 10px;display: flex;background-color: whitesmoke;margin-bottom: 15px;">
								
								
								
								
								<div class="col-md-8">
									
									<input type="text" class="form-control activity" id="AuctionPricenewlow" maxlength="7" name="auctionPrice" data-filter="0" placeholder="Auction Bid Price...." onkeypress="javascript:return isNumber(event)" aria-describedby="basic-addon1" style="margin:0px;">&nbsp;&nbsp;
								</div>
								<div class="col-md-4">
									
									<button type="button" class="btn btn_cart btn_buy_now placenewbidAuctionlow"  style="float:left;padding: 8px;background: #1c6121!important;border-radius: 20px!important;width: 90%;">Bid</button>
									<span id="lowpriceerror" style="color:red;"></span>
								</div>
								
							</div>
							
							<p>By placing a bid,You're committing to buy this item if you Win.</p>
							
						</div>
						
					</div>
					
				</div>
				
			</form>
		</div>
	</div>
</div>


<div class="modal fade" id="higestbid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content no-radius bradius-15">
			<form action="../store/auction-bid/rebid.php" method="POST"  id="higestbidfrm" class="sharestorepos">
				<div class="modal-header bg-white br_radius_top">
					<h4 class="modal-title success" style="color:green;"><span id="oldbid"></span> </h4><button type="button" class="close" data-dismiss="modal">&times;</button>
					
					
				</div>
				
				<div class="modal-body sharedimage">
					
					<span id="oldbidtime" style="float: right;padding-top: 20px;"></span>
					<div class="row">
						
						<div class="col-md-12">
							
							<p style="color:green;"><i class="fa fa-check-circle" aria-hidden="true" style="color:green;"></i>&nbsp;You're the highest bidder!</p>
							<p>Your high bid amount &nbsp;<span id="highbid" style="font-weight: 600;font-size: 19px;"></span></p>
							
							<input type="hidden" name="spPostings_idspPostings" id="newspPostings_idspPostings" >
							<input type="hidden" name="spProfiles_idspProfiles" id="newspProfiles_idspProfiles" >
							<input type="hidden" name="lastBid" id="newlastBid" >
							
							<div class="" style="padding-top: 27px;padding-bottom: 10px;display: flex;background-color: whitesmoke;margin-bottom: 15px;">
								
								
								
								<div class="col-md-8">
									<input type="text" class="form-control activity" id="AuctionPricenewhigh"  onkeypress="javascript:return isNumber(event)" maxlength="7" name="auctionPrice" data-filter="0" placeholder="Auction Bid Price...." aria-describedby="basic-addon1" style="margin-left: 19px;">&nbsp;&nbsp;
								</div>
								<div class="col-md-4">
									<button type="button" class="btn btn_cart btn_buy_now placenewbidAuctionhigh" style="float:left;padding: 8px;background: #1c6121!important;border-radius: 20px!important;width: 90%;">Bid</button>
									<span id="highpriceerror"></span>
								</div>
								
							</div>
							
							<p>By placing a bid,You're committing to buy this item if you Win.</p>
							
						</div>
						
					</div>
					
				</div>
				
			</form>
		</div>
	</div>
</div>

<!--modal for Enquery-->
<div class="modal fade" id="enqueryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content no-radius sharestorepos bradius-15" >
			<div class="modal-header bg-white br_radius_top">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title" id="enquireModalLabel" ><b>Send a Message</b></h3>
			</div>
			<form action="../enquiry/addmsgenquire.php" method="post" id="enquirymessege">
				<div class="modal-body">
					<?php
						
						$p = new _productposting;
						$res = $p->read($_GET['postid']);
						
						if($res != false){
							while ($row2 = mysqli_fetch_assoc($res)) {
								$spProfile = $row2['spProfiles_idspProfiles'];
							}
						}
						
					?>
					<input type="hidden" class="dynamic-pid" id="buyerProfileid" name="buyerProfileid" value="<?php echo $_SESSION['pid']?>"/>
					
					<input type="hidden" id="sellerProfileid" name="sellerProfileid" value="<?php  echo $spProfile;?>"/>
					
					<input type="hidden" id="spPostings_idspPostings" name="spPostings_idspPostings" value="<?php echo $_GET["postid"]?>">
					
					<div class="form-group">
						<label for="message-text" class="form-control-label contact">Message</label>
						<textarea class="form-control" id="message-text" name="message" 
						rows="5" maxlength="500" onkeyup="keyupmessage()"></textarea>
						
						<span id="messagetext_error" style="color:red; font-size: 14px;"></span>
					</div>
				</div>
				
				<div class="modal-footer bg-white br_radius_bottom">
					<button type="button" class="btn btn-close db_btn db_orangebtn" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-submit postenquiry db_btn db_primarybtn" >Send message</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!--complete-->
<!--Auction bid system-->
<div class="modal fade" id="bid-auction" tabindex="-1" role="dialog" aria-labelledby="bidModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content no-radius sharestorepos bradius-15">
			<div class="modal-header bg-white br_radius_top">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title" id="bidModalLabel">Bid on Auction <span id="projecttitle" style="color:#1a936f;"></span></h4>
			</div>
			<form>
				<div class="modal-body">
					
					<label for="AuctionPrice">Your bid must be greater than $<?php echo $HeighestBid; ?></label>
					<div class="input-group" style="width:6cm;margin-bottom: 10px;">
						<span class="input-group-addon" id="basic-addon1">$</span>
						<input type="text" class="form-control activity" id="AuctionPrice" name="AuctionPrice" data-filter="0" placeholder="Auction Bid Price...." aria-describedby="basic-addon1" style="margin:0px;" />
					</div>
					<div id="invalidBid"></div>
					<!--Hidden attribute-->
					<input type="hidden" name="lastBid" id="lastBid" value="<?php echo $HeighestBid; ?>">
					<input type="hidden" id="bidpost" name="spPostings_idspPostings" value="<?php echo $_GET['postid'];?>" >
					<input type="hidden" id="spPostFieldBidFlag" value="1" >
					<input type="hidden" class="auctioncat" value="1" />
					<input class="dynamic-pid" name="spProfiles_idspProfiles"  type="hidden" value="<?php echo $_SESSION['pid'] ?>"> 
					<!--Complete-->
					
				</div>
				<div class="modal-footer bg-white br_radius_bottom">
					<button type="button" class="btn btn-secondary db_btn db_orangebtn" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary placebidAuction db_btn db_primarybtn">Place Bid</button>
				</div>
			</form>
		</div>
	</div>
</div>


<?php 
	include('../component/f_footer.php');
	include('../component/f_btm_script.php'); 
?>


</body>
</html>
<?php
} ?>
<script type="text/javascript">
	
	
	// WRITE THE VALIDATION SCRIPT.
	function isNumber(evt) {
		var iKeyCode = (evt.which) ? evt.which : evt.keyCode
		
		if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57) ){
			return false;
			}else  if (evt.which == 13) {
			evt.preventDefault();
			}else{
			return true;
		}
	}    
	
	$(".placenewbidAuctionlow").on("click", function () {
		var currentBid = $("#AuctionPricenewlow").val();
		var logo = MAINURL+"/assets/images/logo/tsplogo.PNG";
		
		if(currentBid == ""){
			swal({
				title: 'Please Enter Your bid.',
				imageUrl: logo
			});
			}else{
			var postid = $("#spPostings_idspPostings").val();
			var  profileid = $("#spProfiles_idspProfiles").val();
			$.ajax({
				type:'POST',
				url:'checkbidcondition.php',
				data:{'spPostings_idspPostings':postid},
				success:function(data){
					var obj = JSON.parse(data);
					var highestbid = obj.auctionPrice;
					var logo = MAINURL+"/assets/images/logo/tsplogo.PNG";
					if(obj.auctionPrice != 0){
						var highestbid = obj.auctionPrice;
						
						if(currentBid == highestbid ){
							swal({
								title: 'Your bid Should be greater than $'+highestbid+'',
								imageUrl: logo
							});
							
							}else if(currentBid > highestbid){
							$.post("../store/auction-bid/addactivity.php", {spPostings_idspPostings:postid,spProfiles_idspProfiles:profileid,auctionPrice:currentBid,lastBid:highestbid }, function (r) {
							});
							var newoldbid = " $"+highestbid;
							var newhighbid = " $"+currentBid;
							$("#oldbid").html(newoldbid);
							$("#highbid").html(newhighbid);
							
							$("#newspPostings_idspPostings").val(postid);
							$("#newspProfiles_idspProfiles").val(profileid);
							$("#newlastBid").val(highestbid);
							$("#higestbid").modal('show');
							}else if(currentBid < highestbid){
							var newoldbid = " $"+highestbid;
							var newhighbid = " $"+currentBid;
							
							$("#lowoldbid").html(newoldbid);
							$("#lowbid").html(newhighbid);
							
							$("#lownewspPostings_idspPostings").val(postid);
							$("#lownewspProfiles_idspProfiles").val(profileid);
							$("#lownewlastBid").val(highestbid);
							
							$("#lowestbid").modal('show');
							
						}
						}else{
						$.post("../store/auction-bid/addactivity.php", {spPostings_idspPostings:postid,spProfiles_idspProfiles:profileid,auctionPrice:currentBid,lastBid:lastBid }, function (r) {
						});
						location.reload();
					}
				}
			});
		}
	});
	
	
	
	$(".placenewbidAuctionhigh").on("click", function () {
		var currentBid = $("#AuctionPricenewhigh").val();
		var logo = MAINURL+"/assets/images/logo/tsplogo.PNG";
		if(currentBid == ""){
			swal({
				title: 'Please Enter Your bid.',
				imageUrl: logo
			});
			}else{
			var postid = $("#spPostings_idspPostings").val();
			var  profileid = $("#spProfiles_idspProfiles").val();
			$.ajax({
				type:'POST',
				url:'checkbidcondition.php',
				data:{'spPostings_idspPostings':postid},
				success:function(data){
					
					var obj = JSON.parse(data);
					var highestbid = obj.auctionPrice;
					var logo = MAINURL+"/assets/images/logo/tsplogo.PNG";
					
					if(obj.auctionPrice != 0){
						var highestbid = obj.auctionPrice;
						if(currentBid == highestbid ){
							swal({
								title: 'Your bid Should be greater than $'+highestbid+'',
								imageUrl: logo
							});
							}else if(currentBid > highestbid){
							$.post("../store/auction-bid/addactivity.php", {spPostings_idspPostings:postid,spProfiles_idspProfiles:profileid,auctionPrice:currentBid,lastBid:highestbid }, function (r) {
							});
							var newoldbid = " $"+highestbid;
							var newhighbid = " $"+currentBid;
							
							$("#oldbid").html(newoldbid);
							$("#highbid").html(newhighbid);
							
							$("#newspPostings_idspPostings").val(postid);
							$("#newspProfiles_idspProfiles").val(profileid);
							$("#newlastBid").val(highestbid);
							$("#higestbid").modal('show');
							}else if(currentBid < highestbid){
							var newoldbid = " $"+highestbid;
							var newhighbid = " $"+currentBid;
							
							$("#lowoldbid").html(newoldbid);
							$("#lowbid").html(newhighbid);
							
							$("#lownewspPostings_idspPostings").val(postid);
							$("#lownewspProfiles_idspProfiles").val(profileid);
							$("#lownewlastBid").val(highestbid);
							
							$("#lowestbid").modal('show');
						}
						}else{
						$.post("../store/auction-bid/addactivity.php", {spPostings_idspPostings:postid,spProfiles_idspProfiles:profileid,auctionPrice:currentBid,lastBid:lastBid }, function (r) {
							//alert(r);
						});
						location.reload();
					}
				}
			});
			
		}
	});
	
	
	
	
	
	function keyupmessage() {
		
		//alert();
		var messagetext= $("#message-text").val()
		
		if(messagetext != "")
		{
			$('#messagetext_error').text(" ");
			
		}
		
		
	}
	
	
	
	$(document).ready(function() {
		
		var auction_exp = $("#auctionexp").val();
		
		var selltype = $("#selltype").val();
		
		//alert();
		if(selltype == "Auction"){
			
			var countDownDate = new Date(auction_exp).getTime();
			
			var x = setInterval(function() {
				// Get today's date and time
				var now = new Date().getTime();
				
				var distance = countDownDate - now;
				
				var days = Math.floor(distance / (1000 * 60 * 60 * 24));
				var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
				var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
				var seconds = Math.floor((distance % (1000 * 60)) / 1000);
				
				// Output the result in an element with id="demo"
				document.getElementById("auction_enddate").innerHTML = days + "d " + hours + "h "
				+ minutes + "m " + seconds + "s ";
				
				document.getElementById("oldbidtime").innerHTML = days + "d " + hours + "h "
				+ minutes + "m " + seconds + "s ";
				
				document.getElementById("lowbidtime").innerHTML = days + "d " + hours + "h "
				+ minutes + "m " + seconds + "s ";
				
				
				if(days == 0 && hours == 0 && minutes <= 5 ){
					
					$('#auction_end').show();
					$('#AuctionPrice').hide();
					$('.placebidAuction').hide();
					$('#bidmsg').hide();
				}
				// If the count down is over, write some text 
				if (distance < 0) {
					clearInterval(x);
					document.getElementById("auction_enddate").innerHTML = "EXPIRED";
					
					
					
					}else{
					
					var x = document.getElementById("aucdiv");
					
					var y = document.getElementById("bidmsg");
					
					x.style.display = "flex";
					
					y.style.display = "block";
					
				}
				
				
			}, 1000);
			
			
		}
		
		
	});
	
	
	var number = document.getElementById('liveQty');
	
	// Listen for input event on numInput.
	number.onkeydown = function(e) {
		if(!((e.keyCode > 95 && e.keyCode < 106)
		|| (e.keyCode > 47 && e.keyCode < 58) 
		|| e.keyCode == 8)) {
			return false;
		}
	}    
	function minmax(value, min, max) 
	{
		
		if(parseInt(value) > max) 
		return max; 
		else return value;
	}
	
	
	
	
	$("#enquire_sell").click(function(){
		
		var logo = MAINURL+"/assets/images/logo/tsplogo.PNG";
		
		swal({
			title: "This is My Product.",
			imageUrl: logo
		});
		
	});
	
	
	
	
	$('#showsize').on('change', function() {
		/*alert( this.value );*/
		$("#size").val(this.value);
	});
	
	$('#clothsize').on('change', function() {
		/*alert( this.value );*/
		$("#size").val(this.value);
	});
	
	</script>																																												
