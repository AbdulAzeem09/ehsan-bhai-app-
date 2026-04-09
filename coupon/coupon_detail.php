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
    

   // $_GET["categoryID"] = "9";
   // $_GET["categoryName"] = "Events";
    $header_coupon = "header_coupon";
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
    
    <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
     <style>
         .header_coupon{
            background-color: #912A86; 
            padding: 0px 10px 5px; 
     }
    </style>

    </head>

    <body class="bg_gray">
          <?php include_once("../header.php");?>
        <section>
            
<nav class="navbar navbar-inverse couponnavbar">
  <div class="container-fluid">
    
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Deals</a></li>
       <li><a href="#">Coupons</a></li>
      <li><a href="#">Stores</a></li>
      <li><a href="#">Saved Coupon</a></li>
       <li><a href="#">Favorite</a></li>
        <li><a href="#">My Account</a></li>
    </ul>


    <form class="navbar-form navbar-left couponsearch" action="/action_page.php">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Enter A Keyword" name="search">
        <div class="input-group-btn">
          <button class="btn btn-default" type="submit">
            <i class="glyphicon glyphicon-search"></i>
          </button>
        </div>
      </div>
    </form>

  </div>
</nav>

        </section>

             <section class="main_box">
            <div class="container">

            	<ol class="breadcrumb" style="padding: 8px 0px;margin-bottom: 6px!important;list-style: none;background-color: unset!important;border-radius: 4px;">
      <li><a href="" style="color: #178010;" ><i class="fa fa-home"></i></a></li>
       <li><a href="" style="color: #545454;" >Coupons</a></li>
      <li class="active">Coupon name </li>
    </ol>

                <div class="row">

                    <div class="col-md-8">
                        <div class=" bg_white">
                            <img src="<?php echo $BaseUrl.'/assets/images/coupon/Beauty.jpg';?>" style="width:100%; height: 350px;">
                           
                        </div>
                    </div>

                     <div class="col-md-4">
                        <div class="coupon_detailright_1 bg_white">
                        	<h4 style="padding-right: 50px;   font-size: 20px; padding-left: 15px;">Wyndham Garden at Palma del Mar - Puetro</h4>

                        	<div class="detailright">
                        		<span style="padding-left: 20px;"><i class="fa fa-globe" aria-hidden="true"></i> Ebay</span>
                        		<span style="padding-left: 40px;"><i class="fa fa-map-marker" aria-hidden="true"></i> Canada</span>
                        		<span style="padding-left: 40px;"><i class="fa fa-shopping-basket" aria-hidden="true"></i> 42 bought</span>
                        	</div>

                        	<div class="detailright" style="padding-left: 55px;">
                        		<span style="font-size: 20px; color: red;">$ 300,00</span>
                                <span style="font-size: 33px;   padding-left: 15px; color: #178010;">$ 150.00</span>
                                        </div>

                                         <div class="detailright">
              <a href="" class="btn butn_cancel coupon_buynowbtn buynowbtn" style="margin-right: 5px;">Buy Now</a>
        </div>
        <p class="detailright" style="text-align: center;">HURRY UP ONLY A FEW DEALS LIFT</p>

       
          <p class="" style="text-align: center;"><i class="fa fa-map-marker" aria-hidden="true"></i> 12 WEEKS OO DAYS 10:12:50</p>

                           
                        </div>
                    </div>




                </div>

                  <div class="row">

                    <div class="col-md-8">
                        <div class="coupon_detailleft_1 bg_white">
                          <h4 style="font-size: 21px;  color: #178010;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</h4>
                            <p id='eventrating' class="rating" style="    margin-right: 80%; margin-bottom: 0px; line-height: 16px;">
                                            <input class="stars" type="radio" id="star5" name="rating" value="5" />
                                            <label  style="cursor:pointer; color: #8C8C8C;" class = "full" for="star5" title="Awesome - 5 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star4" name="rating" value="4" />
                                            <label style="cursor:pointer; color: #8C8C8C;" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star3" name="rating" value="3" />
                                            <label style="cursor:pointer; color: #8C8C8C;" class = "full" for="star3" title="Meh - 3 stars"></label>
                                            
                                            <input style="cursor:pointer; " class="stars" type="radio" id="star2" name="rating" value="2" />
                                            <label style="cursor:pointer; color: #8C8C8C;" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                            
                                            <input class="stars" type="radio" id="star1" name="rating" value="1" />
                                            <label style="cursor:pointer; color: #8C8C8C;" class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                          
                            
                                        </p> 

                                        <h1 style="font-size: 3em; color: #178010;">$ v300</h1>

                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                                        <br>	
                                        It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
                                        <br>
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. 
                                    </p>
                        </div>
                    </div>

                     <div class="col-md-4">
                        <div class="coupon_detailright_1 bg_white" style="padding-left: 25px;   padding-right: 25px;">
                        	<h3>About Seller</h3>
                        	<hr>
                        	<a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/amazon.png';?>" class='img-responsive' alt="" style="padding-left: 55px; padding-right: 55px;" >
                                        </a>

                                        <p style="font-size: 20px;text-align: center;">Amazon Store</p>
                                          <p id='eventrating' class="rating" style="margin-left: 25%; margin-bottom: 0px; line-height: 16px;">
                                            <input class="stars" type="radio" id="star5" name="rating" value="5" />
                                            <label  style="cursor:pointer; color: #178010;" class = "full" for="star5" title="Awesome - 5 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star4" name="rating" value="4" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star3" name="rating" value="3" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star3" title="Meh - 3 stars"></label>
                                            
                                            <input style="cursor:pointer; " class="stars" type="radio" id="star2" name="rating" value="2" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                            
                                            <input class="stars" type="radio" id="star1" name="rating" value="1" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                          
                            
                                        </p>  <span>(205)</span>

                                        <p style="padding-bottom: 15px;margin-top: 16px;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

                                        <a href="" class="btn butn_cancel coupon_buynowbtn buynowbtn" style="margin-right: 5px;">Follow</a>

                           
                        </div>
                    </div>




                </div>

                  <div class="row">

                    <div class="col-md-8">
                        <div class="coupon_detailleft_1 bg_white" style="padding: 12px;">
                        	<h3>Reviews</h3>
                        	<div class="row">
                        		
                        		<div class="col-md-2">
                        		<a href=""><img src="../assets/images/blank-img/default-profile.png" class="img-responsive" style="height: 100px; "></a>
                        		</div>

                        		<div class="col-md-10">
                        			 <div class="coupon_littledetailleft_1 ">
                        			 	<p style="font-size: 18px;">John Due </p><p id='eventrating' class="rating" style=" margin-right: 65%; margin-bottom: 0px; line-height: 16px;">

                                            <input class="stars" type="radio" id="star5" name="rating" value="5" />
                                            <label  style="cursor:pointer; color: #178010;" class = "full" for="star5" title="Awesome - 5 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star4" name="rating" value="4" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star3" name="rating" value="3" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star3" title="Meh - 3 stars"></label>
                                            
                                            <input style="cursor:pointer; " class="stars" type="radio" id="star2" name="rating" value="2" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                            
                                            <input class="stars" type="radio" id="star1" name="rating" value="1" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                          
                            
                                        </p>

                                        <p>September 9,2016</p>

                                        <p> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                        			 </div>
                        			
                        			
                        		</div>
                        	</div>


                        		<div class="row">
                        		
                        		<div class="col-md-2">
                        		<a href=""><img src="../assets/images/blank-img/default-profile.png" class="img-responsive" style="height: 100px; "></a>
                        		</div>

                        		<div class="col-md-10">
                        			 <div class="coupon_littledetailleft_1 ">
                        			 	<p style="font-size: 18px;">John Due </p><p id='eventrating' class="rating" style=" margin-right: 65%; margin-bottom: 0px; line-height: 16px;">

                                            <input class="stars" type="radio" id="star5" name="rating" value="5" />
                                            <label  style="cursor:pointer; color: #178010;" class = "full" for="star5" title="Awesome - 5 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star4" name="rating" value="4" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star3" name="rating" value="3" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star3" title="Meh - 3 stars"></label>
                                            
                                            <input style="cursor:pointer; " class="stars" type="radio" id="star2" name="rating" value="2" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                            
                                            <input class="stars" type="radio" id="star1" name="rating" value="1" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                          
                            
                                        </p>

                                        <p>September 9,2016</p>

                                        <p> Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p>

                        			 </div>
                        			
                        			
                        		</div>
                        	</div>


                           
                          
                        </div>
                    </div>

                     <div class="col-md-4">
                        <div class="coupon_detailright_1 bg_white" style="padding: 20px;">

                        		<div class="row">
                        		
                        		<div class="col-md-3">
                        		<a href=""><img src="../assets/images/blank-img/default-profile.png" class="img-responsive" style="height: 80px; "></a>
                        		</div>

                        		<div class="col-md-9">
                        			
                        			 	<p style="font-size: 18px;">Aenean ut vel massa </p><p id='eventrating' class="rating" style=" margin-right: 25%; margin-bottom: 0px; line-height: 16px;">

                                            <input class="stars" type="radio" id="star5" name="rating" value="5" />
                                            <label  style="cursor:pointer; color: #178010;" class = "full" for="star5" title="Awesome - 5 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star4" name="rating" value="4" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star3" name="rating" value="3" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star3" title="Meh - 3 stars"></label>
                                            
                                            <input style="cursor:pointer; " class="stars" type="radio" id="star2" name="rating" value="2" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                            
                                            <input class="stars" type="radio" id="star1" name="rating" value="1" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                          
                            
                                        </p>

                                        <p style="font-size: 20px; color: #178010;">$60.00</p>

                                    

                        </div>
                    </div>

                       <div class="row">
                        		
                        		<div class="col-md-3">
                        		<a href=""><img src="../assets/images/blank-img/default-profile.png" class="img-responsive" style="height: 80px; "></a>
                        		</div>

                        		<div class="col-md-9">
                        			
                        			 	<p style="font-size: 18px;">Aenean ut vel massa </p><p id='eventrating' class="rating" style=" margin-right: 25%; margin-bottom: 0px; line-height: 16px;">

                                            <input class="stars" type="radio" id="star5" name="rating" value="5" />
                                            <label  style="cursor:pointer; color: #178010;" class = "full" for="star5" title="Awesome - 5 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star4" name="rating" value="4" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star3" name="rating" value="3" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star3" title="Meh - 3 stars"></label>
                                            
                                            <input style="cursor:pointer; " class="stars" type="radio" id="star2" name="rating" value="2" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                            
                                            <input class="stars" type="radio" id="star1" name="rating" value="1" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                          
                            
                                        </p>

                                        <p style="font-size: 20px; color: #178010;">$60.00</p>

                                       

                        			
                        			
                        			
                        		</div>
                        	</div>


                        	 <div class="row">
                        		
                        		<div class="col-md-3">
                        		<a href=""><img src="../assets/images/blank-img/default-profile.png" class="img-responsive" style="height: 80px; "></a>
                        		</div>

                        		<div class="col-md-9">
                        			
                        			 	<p style="font-size: 18px;">Aenean ut vel massa </p><p id='eventrating' class="rating" style=" margin-right: 25%; margin-bottom: 0px; line-height: 16px;">

                                            <input class="stars" type="radio" id="star5" name="rating" value="5" />
                                            <label  style="cursor:pointer; color: #178010;" class = "full" for="star5" title="Awesome - 5 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star4" name="rating" value="4" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star3" name="rating" value="3" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star3" title="Meh - 3 stars"></label>
                                            
                                            <input style="cursor:pointer; " class="stars" type="radio" id="star2" name="rating" value="2" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                            
                                            <input class="stars" type="radio" id="star1" name="rating" value="1" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                          
                            
                                        </p>

                                        <p style="font-size: 20px; color: #178010;">$60.00</p>

                                       

                        			
                        			
                        			
                        		</div>
                        	</div>

                        	 <div class="row">
                        		
                        		<div class="col-md-3">
                        		<a href=""><img src="../assets/images/blank-img/default-profile.png" class="img-responsive" style="height: 80px; "></a>
                        		</div>

                        		<div class="col-md-9">
                        			
                        			 	<p style="font-size: 18px;">Aenean ut vel massa </p>
                        			 	<p id='eventrating' class="rating" style=" margin-right: 25%; margin-bottom: 0px; line-height: 16px;">

                                            <input class="stars" type="radio" id="star5" name="rating" value="5" />
                                            <label  style="cursor:pointer; color: #178010;" class = "full" for="star5" title="Awesome - 5 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star4" name="rating" value="4" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star3" name="rating" value="3" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star3" title="Meh - 3 stars"></label>
                                            
                                            <input style="cursor:pointer; " class="stars" type="radio" id="star2" name="rating" value="2" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                            
                                            <input class="stars" type="radio" id="star1" name="rating" value="1" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                          
                            
                                        </p>

                                        <p style="font-size: 20px; color: #178010;">$60.00</p>

                                       

                        			
                        			
                        			
                        		</div>
                        	</div>





                </div>
            </div>


                  <div class="row">

                    <div class="col-md-12">
                        <div class="coupon_detailcenter_1 bg_white">
                            <h2>Post a Review</h2>

                             <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
               <!--   <label for="spPostingTitle" class="lbl_1">Coupon Code</label> -->
                <input type="text" class="form-control" id="" name=""  placeholder="Name"/>

                </div>
            </div>

            <div class="col-md-6">
                    <div class="form-group">
                <!--  <label for="spPostingTitle" class="lbl_1">Coupon Name<span style="color:red;">*</span></label> -->
                <input type="text" class="form-control" id="" name=""  placeholder="Email"/>

                </div>
            </div>
        </div>

          <div class="row" style="margin-top: 10px;  margin-bottom: 20px;">
            <div class="col-md-12">
             <label for="spPostingTitle" class="lbl_1" style="float: left;">Your Rating :</label>

             <p id='eventrating' class="rating" style=" margin-left: 2%; margin-bottom: 0px; line-height: 16px;">

                                            <input class="stars" type="radio" id="star5" name="rating" value="5" />
                                            <label  style="cursor:pointer; color: #178010;" class = "full" for="star5" title="Awesome - 5 stars"></label>
                                                
                            
                                        </p>

                                           <p id='eventrating' class="rating" style="margin-left: 15px; margin-bottom: 0px; line-height: 16px;">

                                          <input class="stars" type="radio" id="star4" name="rating" value="4" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star3" name="rating" value="3" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star3" title="Meh - 3 stars"></label>
                                            
                                         
                                        </p>

                                          <p id='eventrating' class="rating" style="margin-left: 15px; margin-bottom: 0px; line-height: 16px;">

                                          <input class="stars" type="radio" id="star3" name="rating" value="3" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star3" title="Meh - 3 stars"></label>
                                            
                                            <input style="cursor:pointer; " class="stars" type="radio" id="star2" name="rating" value="2" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                            
                                            <input class="stars" type="radio" id="star1" name="rating" value="1" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                            
                                         
                                        </p>

                                          <p id='eventrating' class="rating" style=" margin-left: 2%; margin-bottom: 0px; line-height: 16px;">

                                            <input class="stars" type="radio" id="star5" name="rating" value="5" />
                                            <label  style="cursor:pointer; color: #178010;" class = "full" for="star5" title="Awesome - 5 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star4" name="rating" value="4" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star3" name="rating" value="3" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star3" title="Meh - 3 stars"></label>
                                            
                                            <input style="cursor:pointer; " class="stars" type="radio" id="star2" name="rating" value="2" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                            
                                           
                                          
                            
                                        </p>


                                        <p id='eventrating' class="rating" style=" margin-left: 2%; margin-bottom: 0px; line-height: 16px;">

                                            <input class="stars" type="radio" id="star5" name="rating" value="5" />
                                            <label  style="cursor:pointer; color: #178010;" class = "full" for="star5" title="Awesome - 5 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star4" name="rating" value="4" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star3" name="rating" value="3" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star3" title="Meh - 3 stars"></label>
                                            
                                            <input style="cursor:pointer; " class="stars" type="radio" id="star2" name="rating" value="2" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                            
                                            <input class="stars" type="radio" id="star1" name="rating" value="1" />
                                            <label style="cursor:pointer; color: #178010;" class = "full" for="star1" title="Sucks big time - 1 star"></label>

                                          
                            
                                        </p>




         </div>
          </div>


                             <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
               <!--   <label for="spPostingTitle" class="lbl_1">Coupon Code</label> -->
               
                  <textarea class="form-control" id="spPostingNotes" name="spPostingNotes" maxlength="500"  rows="6" placeholder="Your Review"> </textarea>


                </div>
            </div>
        </div>

        <div class="row">
              <a href="" class="btn butn_cancel pull-right coupon_reviewbtn coupon_reviewsubmit" style="margin-right: 5px;">Submit Review</a>
        </div>

                          
                           
                        </div>
                    </div>

                  




                </div>

                 <div class="row">
                    <div class="col-md-10">
                        <div class="Latestdeals">
                            <h2>POPULAR STORES</h2>
                           
                        </div>
                    </div>
                     <div class="col-md-2">
                        <div class="Latestdealsbtn">
                          <a href="" class="btn viewsall">VIEW ALL</a>
                           
                        </div>
                    </div>
                     
                           <div class="row" style="margin-top: 11%;">
                                <div class="col-md-2">
                                    <div class="coupon_Popularstore">
                                        <a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/walmart2.png';?>" class='img-responsive' alt="">
                                        </a>
                                          
                                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="coupon_Popularstore">
                                        <a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/amazon.png';?>" class='img-responsive' alt="" style="padding-top: 35px;">
                                        </a>
                                          
                                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="coupon_Popularstore">
                                        <a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/lacoste1.jpg';?>" class='img-responsive' alt="">
                                        </a>
                                          
                                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="coupon_Popularstore">
                                        <a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/eBay1.png';?>" class='img-responsive' alt="">
                                        </a>
                                          
                                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="coupon_Popularstore">
                                        <a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/bestbuy1.png';?>" class='img-responsive' alt="" style="height: 93px;">
                                        </a>
                                          
                                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="coupon_Popularstore">
                                        <a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/target.png';?>" class='img-responsive' alt="" style="padding-top: 12px;">
                                        </a>
                                          
                                        
                                    </div>
                                </div>
                              
                         </div> 
                     
                            

                        <div class="row">
                                <div class="col-md-2">
                                    <div class="coupon_Popularstore">
                                        <a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/puma.png';?>" class='img-responsive' alt="" style="    height: 100px;">
                                        </a>
                                          
                                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="coupon_Popularstore">
                                        <a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/esprit.jpg';?>" class='img-responsive' alt="" style="height: 98px;">
                                        </a>
                                          
                                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="coupon_Popularstore">
                                        <a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/mexx1.jpg';?>" class='img-responsive' alt="" style="height: 98px;">
                                        </a>
                                          
                                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="coupon_Popularstore">
                                        <a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/eBay1.png';?>" class='img-responsive' alt="">
                                        </a>
                                          
                                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="coupon_Popularstore">
                                        <a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/lacoste1.jpg';?>" class='img-responsive' alt="" style="height: 93px;">
                                        </a>
                                          
                                        
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="coupon_Popularstore">
                                        <a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/walmart2.png';?>" class='img-responsive' alt="" >
                                        </a>
                                          
                                        
                                    </div>
                                </div>
                              
                         </div> 
                              
                    

                </div>


                 <div class="row">
                    <div class="col-md-10">
                        <div class="Latestdeals">
                            <h2>POPULAR CATEGORIES</h2>
                           
                        </div>
                    </div>
                     <div class="col-md-2">
                        <div class="Latestdealsbtn">
                          <a href="" class="btn viewsall">VIEW ALL</a>
                           
                        </div>
                    </div>
                     
                     <div class="row" style="margin-top: 11%;">
                                <div class="col-md-12">
                                    <div class="coupon_Popularcategory">
                                     
                                     <div class="row" style="margin-top: 50px">
                                  <div class="col-md-3" style="width: 20%; padding-left: 50px;">
                                     
                                        <p class='rightclick'>&#10004; <span>Baby Kids</span></p>
                                        <p class='rightclick'>&#10004; <span>Books & Magazines</span></p>
                                        <p class='rightclick'>&#10004; <span>Computers</span></p>
                                        <p class='rightclick'>&#10004; <span>Cameras</span></p>
                                        <p class='rightclick'>&#10004; <span>Electronics</span></p>
                                        <p class='rightclick'>&#10004; <span>Games</span></p>
                                        

                              
                                      </div>

                                      <div class="col-md-3" style="width: 20%; padding-left: 50px;">
                                     
                                        <p class='rightclick'>&#10004; <span>Gifts</span></p>
                                        <p class='rightclick'>&#10004; <span>Home Garden</span></p>
                                        <p class='rightclick'>&#10004; <span>Health Beauty</span></p>
                                        <p class='rightclick'>&#10004; <span>Home Supplies</span></p>
                                        <p class='rightclick'>&#10004; <span>Laptops</span></p>
                                        <p class='rightclick'>&#10004; <span>Entertainment</span></p>
              

                              
                                      </div>


                                      <div class="col-md-3" style="width: 20%; padding-left: 50px;">
                                     
                                        <p class='rightclick'>&#10004; <span>Digital Stores</span></p>
                                        <p class='rightclick'>&#10004; <span>Marketplace</span></p>
                                        <p class='rightclick'>&#10004; <span>Musicians</span></p>
                                        <p class='rightclick'>&#10004; <span>Movies & Films</span></p>
                                        <p class='rightclick'>&#10004; <span>Phones</span></p>
                                        <p class='rightclick'>&#10004; <span>Travel</span></p>
                                    
                                      </div>

                                      <div class="col-md-3" style="width: 20%; padding-left: 50px;">
                                     
                                        <p class='rightclick'>&#10004; <span>Televisions</span></p>
                                        <p class='rightclick'>&#10004; <span>Telegraphers</span></p>
                                        <p class='rightclick'>&#10004; <span>Baby Toys</span></p>
                                        <p class='rightclick'>&#10004; <span>Clothings</span></p>
                                        <p class='rightclick'>&#10004; <span>Jewellry</span></p>
                                        <p class='rightclick'>&#10004; <span>Car Suppplies</span></p>
         
                              
                                      </div>

                                  <div class="col-md-3" style="width: 20%; padding-left: 50px;">
                                     
                                        <p class='rightclick'>&#10004; <span>Watches</span></p>
                                        <p class='rightclick'>&#10004; <span>Medical</span></p>
                                        <p class='rightclick'>&#10004; <span>Pet Shops</span></p>
                                        <p class='rightclick'>&#10004; <span>LifeStyle</span></p>
                                        <p class='rightclick'>&#10004; <span>Sports</span></p>
                                        <p class='rightclick'>&#10004; <span>Glassess</span></p>
                                  
           
                                      </div>

                                       </div>
                                        
                                        
                                     
                                    </div>
                                </div>
                              

                             </div> 
                     
                              
                              
                    

                </div>


            </div>
        </section>



           <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
    </body>
</html>
<?php
}
?>