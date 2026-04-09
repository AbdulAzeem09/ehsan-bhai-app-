<?php 
    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="events/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "9";
    $_GET["categoryName"] = "Events";
    $header_event = "events";

     if($_SESSION['ptid'] == 3 || $_SESSION['ptid'] == 1 || $_SESSION['ptid'] == 4 || $_SESSION['ptid'] == 6){ 

    }else{
        $re = new _redirect;
        $re->redirect($BaseUrl."/events");
    }
?>

<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
        <!-- Magnific Popup core CSS file -->
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/magnific-popup.css">
        <!-- Magnific Popup core JS file -->
        <script src="<?php echo $BaseUrl; ?>/assets/css/magnific-popup/jquery.magnific-popup.js"></script>
        <!-- this script for slider art -->
         <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
         <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/events/bootstrap.min.css">
         <script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>

        
    </head>
    
<style>
	/*------------------Edit-button-css---------------*/
	.upEventBox.upcomingbox {
		position: relative;
	}
	.upEventBox.upcomingbox .eidt-con {
		position: absolute;
		left: auto;
		right: 9px;
		margin-top: 14px;
	}
	.upEventBox.upcomingbox .eidt-con a {
		color: #fff;
	}
	.upEventBox.upcomingbox .eidt-con i.fa {
		border: 1px solid #da1919;
		background: -webkit-linear-gradient(90deg,#9c0202 0,#da1919 100%);
		text-align: center;
		border-radius: 6px;
		padding: 4px 4px;
	}
	</style>



    <!-- for the bootstrap Exclude for this Page Only-->
    <style>
.accordion-button:not(.collapsed) {
    color: #e40c0c;
    background-color: #e7f1ff;
    box-shadow: inset 0 -1px 0 rgb(0 0 0 / 13%);
}
    </style>


<!-- Script and style For Carsole - Slider --> 
<script>
$(document).ready(function(){
	$(".wish-icon i").click(function(){
		$(this).toggleClass("fa-heart fa-heart-o");
	});
});	
</script>

<style>

.carousel {
	margin: 12px auto;
	padding: 0 0px;
}
.carousel .item {
	color: #747d89;
	min-height: 325px;
	text-align: center;
	overflow: hidden;
}
.carousel .thumb-wrapper {
	padding: 200px 15px;
	background: #fff;
	border-radius: 6px;
	text-align: center;
	position: relative;
	box-shadow: 0 2px 3px rgba(0,0,0,0.2);
}
.carousel .item .img-box {
	height: 120px;
	margin-bottom: 20px;
	width: 100%;
	position: relative;
}
.carousel .item img {	
	max-width: 100%;
	max-height: 100%;
	display: inline-block;
	position: absolute;
	bottom: 0;
	margin: 0 auto;
	left: 0;
	right: 0;
}
.carousel .item h4 {
	font-size: 18px;
}
.carousel .item h4, .carousel .item p, .carousel .item ul {
	margin-bottom: 5px;
}
.carousel .thumb-content .btn {
	color: #7ac400;
	font-size: 11px;
	text-transform: uppercase;
	font-weight: bold;
	background: none;
	border: 1px solid #7ac400;
	padding: 6px 14px;
	margin-top: 5px;
	line-height: 16px;
	border-radius: 20px;
}
.carousel .thumb-content .btn:hover, .carousel .thumb-content .btn:focus {
	color: #fff;
	background: #7ac400;
	box-shadow: none;
}
.carousel .thumb-content .btn i {
	font-size: 14px;
	font-weight: bold;
	margin-left: 5px;
}
.carousel .item-price {
	font-size: 13px;
	padding: 2px 0;
}
.carousel .item-price strike {
	opacity: 0.7;
	margin-right: 5px;
}
.carousel-control-prev, .carousel-control-next {
	height: 44px;
	width: 46px;
	background: #000000c4;	
	margin: auto -23px;
	border-radius: 22px;
	opacity: 0.8;
}
.carousel-control-prev:hover, .carousel-control-next:hover {
	background: #78bf00;
	opacity: 1;
}
.carousel-control-prev i, .carousel-control-next i {
	font-size: 36px;
	position: absolute;
	top: 50%;
	display: inline-block;
	margin: -19px 0 0 0;
	z-index: 5;
	left: 0;
	right: 0;
	color: #fff;
	text-shadow: none;
	font-weight: bold;
}
.carousel-control-prev i {
	margin-left: -2px;
}
.carousel-control-next i {
	margin-right: -4px;
}		
.carousel-indicators {
	bottom: -50px;
}
.carousel-indicators li, .carousel-indicators li.active {
	width: 10px;
	height: 10px;
	margin: 4px;
	border-radius: 50%;
	border: none;
}
.carousel-indicators li {	
	background: rgba(0, 0, 0, 0.2);
}
.carousel-indicators li.active {	
	background: rgba(0, 0, 0, 0.6);
}
.carousel .wish-icon {
	position: absolute;
	right: 10px;
	top: 10px;
	z-index: 99;
	cursor: pointer;
	font-size: 16px;
	color: #abb0b8;
}
.carousel .wish-icon .fa-heart {
	color: #ff6161;
}
.star-rating li {
	padding: 0;
}
.star-rating i {
	font-size: 14px;
	color: #ffc000;
}
.ghpwgb {
    margin: 0px;
    word-break: break-word;
    color: rgb(102, 102, 102);
    font-family: Roboto;
    font-size: 16px;
    font-weight: normal;
    line-height: 1.5;
    overflow: hidden;
    text-overflow: ellipsis;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}
#myCarousel .item {
    height: 516px!important;
    overflow: hidden;
}
.col-sm-3 {
    flex: 0 0 auto;
    width: 20%;
}
.h2, h2 {
    font-size: 24px;
}
.gUjRuq {
    margin: 0px;
    word-break: break-word;
    color: rgb(220, 53, 88);
    font-family: Roboto;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.43;
}
.carousel-control-next, .carousel-control-prev {
    
    bottom: 108px;
   
}
.innerEvent {
    padding: 50px;
    background-position: center;
}
.header_events {
    background-color: #6710A1;
    padding: 0px 10px 5px;
}
</style>



    <body class="bg_gray">
        <?php include_once("../header.php");?>
        <section class="topDetailEvent innerEvent">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <h3>Events</h3>
                    </div>
                </div>
            </div>
        </section>
        
       
          
                <div class="row">
                    <div class="col-sm-12 ">
                       <div class="col-md-2 ">

                             </div>
                       <div class="col-md-10">
                      
        <section class="main_box no-padding">
            
            <div class="container eventExplrthefun explorecontainer">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="topBoxEvent text-right">
                            <a href="<?php echo $BaseUrl.'/events';?>" class="btn btn_event homeeventbtn">
                                <i class="fa fa-home"></i>Home</a>
                            <a href="<?php echo $BaseUrl.'/events/dashboard/';?>" class="btn btn_event eventdashboard"><i class="fa fa-dashboard"></i> Dashboard</a>
                            <a href="<?php echo $BaseUrl.'/post-ad/events/?post'?>" class="btn btn_event submitevent">Submit an event</a>

                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="">
                            <h1>Explore the <span>fun</span></h1>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <?php include('search-form.php');?>
                    </div>
                </div>
            </div>
            
        </section>
        <section class="UpcomingSec">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="titleEvent text-center">
                            
                            <p>Your local upcoming events</p>
                        </div>
                    </div>
                </div>
                
                <div class="container-xl">
	<div class="row">
		<div class="col-sm-12">
			<h2> <b> Cultural Events</b><a href="https://in.bookmyshow.com/explore/movies-kolkata" class="sc-133848s-11 bYEMkh pull-right"><div class="sc-7o7nez-0 gUjRuq">See All ›</div></a></h2>
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>   
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner">
				<div class="item carousel-item active">
					<div class="row">
						<div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
						
                        
					</div>
				</div>
				<div class="item carousel-item">
					<div class="row">
                    <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                       
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>					
					</div>
				</div>
				<div class="item carousel-item">
					<div class="row">
                    <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                         <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
						
					
					</div>
				</div>
			</div>
			<!-- Carousel controls -->
			<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control-next" href="#myCarousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>
    <div class="row">
		<div class="col-sm-12">
			<h2> <b>Music Concerts</b><a href="https://in.bookmyshow.com/explore/movies-kolkata" class="sc-133848s-11 bYEMkh pull-right"><div class="sc-7o7nez-0 gUjRuq">See All ›</div></a></h2>
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>   
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner">
				<div class="item carousel-item active">
					<div class="row">
						<div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
						
                        
					</div>
				</div>
				<div class="item carousel-item">
					<div class="row">
                    <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                       
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>					
					</div>
				</div>
				<div class="item carousel-item">
					<div class="row">
                    <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                         <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
						
					
					</div>
				</div>
			</div>
			<!-- Carousel controls -->
			<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control-next" href="#myCarousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>
    <div class="row">
		<div class="col-sm-12">
			<h2> <b> Sport Events</b><a href="https://in.bookmyshow.com/explore/movies-kolkata" class="sc-133848s-11 bYEMkh pull-right"><div class="sc-7o7nez-0 gUjRuq">See All ›</div></a></h2>
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>   
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner">
				<div class="item carousel-item active">
					<div class="row">
						<div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
						
                        
					</div>
				</div>
				<div class="item carousel-item">
					<div class="row">
                    <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                       
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>					
					</div>
				</div>
				<div class="item carousel-item">
					<div class="row">
                    <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                         <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
						
					
					</div>
				</div>
			</div>
			<!-- Carousel controls -->
			<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control-next" href="#myCarousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>
    <div class="row">
		<div class="col-sm-12">
			<h2> <b> Community Events</b><a href="https://in.bookmyshow.com/explore/movies-kolkata" class="sc-133848s-11 bYEMkh pull-right"><div class="sc-7o7nez-0 gUjRuq">See All ›</div></a></h2>
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>   
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner">
				<div class="item carousel-item active">
					<div class="row">
						<div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
						
                        
					</div>
				</div>
				<div class="item carousel-item">
					<div class="row">
                    <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                       
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>					
					</div>
				</div>
				<div class="item carousel-item">
					<div class="row">
                    <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                         <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
						
					
					</div>
				</div>
			</div>
			<!-- Carousel controls -->
			<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control-next" href="#myCarousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>
    <div class="row">
		<div class="col-sm-12">
			<h2> <b> General Events</b><a href="https://in.bookmyshow.com/explore/movies-kolkata" class="sc-133848s-11 bYEMkh pull-right"><div class="sc-7o7nez-0 gUjRuq">See All ›</div></a></h2>
			<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="0">
			<!-- Carousel indicators -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
			</ol>   
			<!-- Wrapper for carousel items -->
			<div class="carousel-inner">
				<div class="item carousel-item active">
					<div class="row">
						<div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT"><div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
						
                        
					</div>
				</div>
				<div class="item carousel-item">
					<div class="row">
                    <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>
                       
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>					
					</div>
				</div>
				<div class="item carousel-item">
					<div class="row">
                    <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                        <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
                         <div class="col-sm-3">
							<div class="thumb-wrapper" style="border-radius: 8px;">
								<span class="wish-icon"><i class="fa fa-heart-o"></i></span>
                                <img src="https://in.bmscdn.com/discovery-catalog/events/tr:w-400,h-600,bg-CCCCCC:w-400.0,h-660.0,cm-pad_resize,bg-000000,fo-top:ote-RnJpLCA3IEphbg%3D%3D,ots-29,otc-FFFFFF,oy-612,ox-24/et00318272-lrrbcpejdw-portrait.jpg" class="img-fluid" style="width: 100%; height:100%;border-radius: 8px;" alt="">									
								
								<div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
																	
									
									
								</div>						
							</div>
                            <div class="thumb-content" style="margin: 4px 0px 0px; padding: 4px 0px 0px;">
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ksSobQ"><h4>Tadap</h4></div></div>
                            <div class="sc-133848s-2 sc-133848s-12 WfspT">
                                <div class="sc-7o7nez-0 ghpwgb">Action/Romantic/Thriller</div>
                            </div>
                        </div>
						</div>	
						
					
					</div>
				</div>
			</div>
			<!-- Carousel controls -->
			<a class="carousel-control-prev" href="#myCarousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			</a>
			<a class="carousel-control-next" href="#myCarousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			</a>
		</div>
		</div>
	</div>
    
</div>
									
<section class="UpcomingSec">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="titleEvent text-center">
                            <h2>All Events Scheduled <span>Near Me</span></h2>
                            <p>Your local upcoming events</p>
                        </div>
                    </div>
                </div>
                <div class="row bg_white no-margin schedulecontainer" >
                    <div class="col-sm-12 no-padding">
                        <div class="">
                            <div class="board">
                                <!-- <h2>Welcome to IGHALO!<sup>™</sup></h2>-->
                                <div class="board-inner">
                                    <ul class="nav nav-tabs" id="myTab">
                                        <?php
                                        $arrWeek = array("sun", "mon", "tue", "wed", "thu", "fri", "sat");
                                        ?>
             <li class="active" style="padding: 10px 8px;">
                                            <a href="#sun" data-toggle="tab" title="">
                                                <span class="round-tabs one">
                                                    <i class="fa fa-calendar"></i>
                                                </span> 
                                                <div class="eventTab">
                                                    <p>
                                                        <?php 
                                                        $today = new DateTime(date('M-d-Y'));
                                                        // Display full day name
                                                        echo $today->format('l') . PHP_EOL; // lowercase L 
                                                        ?>
                                                    </p>
                                                    <p><?php echo date('M-d-Y');?></p>
                                                </div>
                                            </a>
                                        </li>

                                        <li style="padding: 10px 8px;">
                                            <a href="#mon" data-toggle="tab" title="">
                                                <span class="round-tabs one">
                                                    <i class="fa fa-calendar"></i>
                                                </span> 
                                                <div class="eventTab">
                                                    <p>
                                                        <?php 
                                                        $day1 = strtotime("+1 day", strtotime(date('M-d-Y')));
                                                        $today1 = new DateTime(date("M-d-Y", $day1));
                                                        // Look a year into the future for example sake
                                                        //$today->modify('+1 year 12 days');
                                                        // Display full day name
                                                        echo $today1->format('l') . PHP_EOL; // lowercase L 
                                                        ?>
                                                    </p>
                                                    <p>
                                                        <?php
                                                        $date1 = strtotime("+1 day", strtotime(date('M-d-Y')));
                                                        echo date("M-d-Y", $date1);
                                                        ?>
                                                    </p>
                                                </div>
                                            </a>
                                        </li>
                                        <li style="padding: 10px 8px;">
                                            <a href="#tue" data-toggle="tab" title="">
                                                <span class="round-tabs one">
                                                    <i class="fa fa-calendar"></i>
                                                </span> 
                                                <div class="eventTab">
                                                    <p>
                                                        <?php
                                                        $today2 = new DateTime(date('M-d-Y'));
                                                        // Look a year into the future for example sake
                                                        $today2->modify('+2 day');
                                                        // Display full day name
                                                        echo $today2->format('l') . PHP_EOL; // lowercase L
                                                        ?>
                                                    </p>
                                                    <p>
                                                        <?php
                                                        $date1 = strtotime("+2 day", strtotime(date('M-d-Y')));
                                                        echo date("M-d-Y", $date1);
                                                        ?>
                                                    </p>
                                                </div> 
                                            </a>
                                        </li>

                                        <li style="padding: 10px 8px;">
                                            <a href="#wed" data-toggle="tab" >
                                                <span class="round-tabs one">
                                                    <i class="fa fa-calendar"></i>
                                                </span> 
                                                <div class="eventTab">
                                                    <p>
                                                        <?php
                                                        $today3 = new DateTime(date('M-d-Y'));
                                                        // Look a year into the future for example sake
                                                        $today3->modify('+3 day');
                                                        // Display full day name
                                                        echo $today3->format('l') . PHP_EOL; // lowercase L
                                                        ?>
                                                    </p>
                                                    <p>
                                                        <?php
                                                        $date1 = strtotime("+3 day", strtotime(date('M-d-Y')));
                                                        echo date("M-d-Y", $date1);
                                                        ?>
                                                    </p>
                                                </div> 
                                            </a>
                                        </li>

                                        <li style="padding: 10px 8px;">
                                            <a href="#thu" data-toggle="tab" title="">
                                                <span class="round-tabs one">
                                                    <i class="fa fa-calendar"></i>
                                                </span> 
                                                <div class="eventTab">
                                                    <p>
                                                        <?php
                                                        $today4 = new DateTime(date('M-d-Y'));
                                                        // Look a year into the future for example sake
                                                        $today4->modify('+4 day');
                                                        // Display full day name
                                                        echo $today4->format('l') . PHP_EOL; // lowercase L
                                                        ?>
                                                    </p>
                                                    <p>
                                                        <?php
                                                        $date1 = strtotime("+4 day", strtotime(date('M-d-Y')));
                                                        echo date("M-d-Y", $date1);
                                                        ?>
                                                    </p>
                                                </div>
                                            </a>
                                         </li>
                                         <li style="padding: 10px 8px;">
                                            <a href="#fri" data-toggle="tab" title="">
                                                <span class="round-tabs one">
                                                    <i class="fa fa-calendar"></i>
                                                </span> 
                                                <div class="eventTab">
                                                    <p>
                                                        <?php
                                                        $today5 = new DateTime(date('M-d-Y'));
                                                        // Look a year into the future for example sake
                                                        $today5->modify('+5 day');
                                                        // Display full day name
                                                        echo $today5->format('l') . PHP_EOL; // lowercase L
                                                        ?>
                                                    </p>
                                                    <p>
                                                        <?php
                                                        $date1 = strtotime("+5 day", strtotime(date('M-d-Y')));
                                                        echo date("M-d-Y", $date1);
                                                        ?>
                                                    </p>
                                                </div>
                                            </a>
                                         </li>
                                         <li style="padding: 10px 8px;">
                                            <a href="#sat" data-toggle="tab" >
                                                <span class="round-tabs one">
                                                    <i class="fa fa-calendar"></i>
                                                </span> 
                                                <div class="eventTab">
                                                    <p>
                                                        <?php
                                                        $today6 = new DateTime(date('M-d-Y'));
                                                        // Look a year into the future for example sake
                                                        $today6->modify('+6 day');
                                                        // Display full day name
                                                        echo $today6->format('l') . PHP_EOL; // lowercase L
                                                        ?>
                                                    </p>
                                                    <p>
                                                        <?php
                                                        $date1 = strtotime("+6 day", strtotime(date('M-d-Y')));
                                                        echo date("M-d-Y", $date1);
                                                        ?>
                                                    </p>
                                                </div>
                                            </a>
                                         </li>
                                     
                                     </ul>
                                </div>

                                <div class="tab-content">
                                    <div class="tab-pane fade in active" id="sun">
                                        <?php 
                                        $showtoday = date('Y-m-d');
                                        include('event-show.php');
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="mon">
                                        <?php 
                                        $day1 = strtotime("+1 day", strtotime(date('Y-m-d')));
                                        $showtoday = date("Y-m-d", $day1);
                                        include('event-show.php');
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="tue">
                                        <?php 
                                        $day2 = strtotime("+2 day", strtotime(date('Y-m-d')));
                                        $showtoday = date("Y-m-d", $day2);
                                        include('event-show.php');
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="wed">
                                        <?php 
                                        $day3 = strtotime("+3 day", strtotime(date('Y-m-d')));
                                        $showtoday = date("Y-m-d", $day3);
                                        include('event-show.php');
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="thu">
                                        <?php 
                                        $day4 = strtotime("+4 day", strtotime(date('Y-m-d')));
                                        $showtoday = date("Y-m-d", $day4);
                                        include('event-show.php');
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="fri">
                                        <?php 
                                        $day5 = strtotime("+5 day", strtotime(date('Y-m-d')));
                                        $showtoday = date("Y-m-d", $day5);
                                        include('event-show.php');
                                        ?>
                                    </div>
                                    <div class="tab-pane fade" id="sat">
                                        <?php 
                                        $day6 = strtotime("+6 day", strtotime(date('Y-m-d')));
                                        $showtoday = date("Y-m-d", $day6);
                                        include('event-show.php');
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
                                      
                </div>
                                                                                    
								
                    <?php

                    $start = 0;
                    $p      = new _spevent;
                   // $pf     = new _postfield;
                    $res    = $p->publicpost($start, $_GET["categoryID"]);
                    //echo $p->ta->sql;
                    if($res != false){
                        while ($row = mysqli_fetch_assoc($res)) { 


                            $venu = "";
                            $startDate = "";
                            $startTime    = "";
                            $endTime = "";
                            $OrganizerName = "";


                             $venu = $row['spPostingEventVenue'];
                                     $startDate = $row['spPostingStartDate'];
                                     $startTime = $row['spPostingStartTime'];
                                     $endTime = $row['spPostingEndTime'];
                                    // $OrganizerName = $row2['spPostingEventOrgName'];

                                     $dtstrtTime = strtotime($startTime);
                                     $dtendTime = strtotime($endTime);
                            //posting fields
                           // $result_pf = $pf->read($row['idspPostings']);
                            //echo $pf->ta->sql."<br>";
                           /* if($result_pf){
                                $venu = "";
                                $startDate = "";
                                $startTime    = "";
                                $endTime = "";
                                while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                    
                                    if($venu == ''){
                                        if($row2['spPostFieldName'] == 'spPostingEventVenue_'){
                                            $venu = $row2['spPostFieldValue'];

                                        }
                                    }
                                    if($startDate == ''){
                                        if($row2['spPostFieldName'] == 'spPostingStartDate_'){
                                            $startDate = $row2['spPostFieldValue'];

                                        }
                                    }
                                    if($startTime == ''){
                                        if($row2['spPostFieldName'] == 'spPostingStartTime_'){
                                            $startTime = $row2['spPostFieldValue'];

                                        }
                                    }
                                    if($endTime == ''){
                                        if($row2['spPostFieldName'] == 'spPostingEndTime_'){
                                            $endTime = $row2['spPostFieldValue'];

                                        }
                                    }
                                }
                                $dtstrtTime = strtotime($startTime);
                                $dtendTime = strtotime($endTime);
                            }*/
                            ?>



                            </div> <?php
                        }
                    }
                    ?>
                    
                   
                </div>
            </div>
        </section>

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
}
?>
