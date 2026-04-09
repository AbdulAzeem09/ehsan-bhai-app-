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
            <div id="alertNotEmpProfile" class="modal fade" role="dialog" data-backdrop="static"  data-keyboard="false" >
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content no-radius">
                    
                    <div class="modal-body nobusinessProfile text-center" id="jobseakrAlert">
                        <h1><i class="fa fa-info" aria-hidden="true"></i></h1>
                        <h2>Your current profile does not have <br>access to this page. Please create or  switch<br> your current profile to either  <span>"Professional Profile"</span> to access this page.</h2>
                        <div class="space-md"></div>
                        <a href="<?php echo $BaseUrl.'/my-profile';?>" class="btn">Create or Switch Profile</a>
                        <a href="<?php echo $BaseUrl.'/coupon';?>" class="btn">Back to Home</a>
                    </div>
                    
                </div>
            </div>
        </div>
 <section class="main_box no-padding" id="coupon-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-center">
                            <h2>Save a bunch with our savings punch!</h2>
                            <p>Save Money With The Best Coupons.</p>
                            <form class="form-inline" method="post" action="search.php">
                                <div class="row">
                                    <div class="col-md-offset-1 col-md-10">
                                        <div class="form-group " style="width: 100%;">
                                            <input type="text" name="txtSearchBox" class="form-control" required="" placeholder="Enter A Keyword">
                                            <select class="form-control" name="txtType">
                                                <option value="all">Select Location</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                            <input type="submit" name="btnSearch" class="btn butn_coupon" value="Search">
                                        
                                        </div>
                                    </div>
                                </div>
                            </form>

                     </div>
                    </div>
                </div>
            </div>
       
        </section>

        <section class="main_box">
            <div class="container">
                <div class="row">
                    <div class="sidebar col-md-2 no-padding left_coupon_menu" id="sidebar" >
                        <?php include('left-menu.php'); ?> 
                    </div>
                    <div class="col-md-10">
                        <div class="col-md-12 text-center" style="padding-right: 0px;">
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
      <div class="item active">
        <img src="<?php echo $BaseUrl.'/assets/images/coupon/Beauty.jpg';?>" style="width:100%; height: 494px;">
       
     </div>

      <div class="item">
        <img src="<?php echo $BaseUrl.'/assets/images/coupon/fashion.jpg';?>" alt="Chicago" style="width:100%; height: 494px;">
      </div>
    
      <div class="item">
        <img src="<?php echo $BaseUrl.'/assets/images/coupon/Fitness.jpg';?>" alt="New york" style="width:100%; height: 494px;">
      </div>


      
       <div class="carousel-caption d-none d-md-block" style="left: -12%;">

        <div class="top-righticon"><span class="topimgdot">
          <p class="doticontopimg">-70%</p></span></div>

      <h2>Save a bunch with our savings punch!</h2>
       
       <p id='eventrating' class="rating" style="margin-left: 20%; margin-bottom: 0px; line-height: 16px;">
                                            <input class="stars" type="radio" id="star5" name="rating" value="5" />
                                            <label  style="cursor:pointer; color: #fff;" class = "full" for="star5" title="Awesome - 5 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star4" name="rating" value="4" />
                                            <label style="cursor:pointer; color: #fff;" class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                           
                                            <input class="stars" type="radio" id="star3" name="rating" value="3" />
                                            <label style="cursor:pointer; color: #fff;" class = "full" for="star3" title="Meh - 3 stars"></label>
                                            
                                            <input style="cursor:pointer; " class="stars" type="radio" id="star2" name="rating" value="2" />
                                            <label style="cursor:pointer; color: #fff;" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                            
                                            <input class="stars" type="radio" id="star1" name="rating" value="1" />
                                            <label style="cursor:pointer; color: #fff;" class = "full" for="star1" title="Sucks big time - 1 star"></label>
                            
                                        </p>


                                   <!--  <div class="expiredate"> 
                                        <p style="color: #fff;font-size: 17px;">Expires in <span style="color: #32B818;font-size: 17px;">5 Days</span></p>
                                     </div> -->   
    
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
                        </div>
                        
                        

                    </div>
                </div>
           
       
         <div class="row" style="margin-top: 25px; margin-bottom: 20px;">
           <div class="couponcricle">
               
                <div class="col-md-4" >
                  
                 <div class="row circletext">
                     <div class="col-md-2"><span class="dot"><i class="fa fa-check-circle-o doticon" aria-hidden="true"></i></span></div>
                     <div class="col-md-10"><p style=" font-family: Marksimon;">24/7 SUPPORT SATICFACTION</p></div>
                 </div> 
                    </div>

                    <div class="col-md-4" >
                     <div class="row circletext">
                     <div class="col-md-2"><span class="dot"><i class="fa fa-gift doticon" aria-hidden="true"></i></span></div>
                     <div class="col-md-10"><p style=" font-family: Marksimon;">TELL A FRIEND AND GET 5%</p></div>
                    </div> 
                    </div>

                    <div class="col-md-4" >
                      <div class="row circletext">
                     <div class="col-md-2"><span class="dot"><i class="fa fa-money doticon" aria-hidden="true" style="margin-left: -4px;"></i></span></div>
                     <div class="col-md-10" style=" font-family: Marksimon;"><p>MONEY BACK GUARANTEE</p></div>
                      </div> 
                    </div>
           </div>

       </div> 
     
     
                <div class="row ">
                
                    <div class="col-md-4">
                        <div class="left_couponoffer bg_white">
                            <div class="row">
                               
                                    <div class="col-md-4">
                                    <a href="">
                                        <img src="<?php echo $BaseUrl.'/assets/images/icon/sphome/technical-support.png';?>" class="img-responsive" alt="" style="padding-top: 35px;">
                                            
                                            </a>
                                        </div>
                                        <div class="col-md-8">
                                            <h3><a href="">DEALS & COUPONS</a></h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                           
                                           
                                            
                                        </div> 
                            </div>
                        </div>
                    </div>
                   <div class="col-md-4">
                        <div class="left_couponoffer bg_white">
                            <div class="row">
                               
                                        <div class="col-md-4">
                                            <a href="">
                                            <img src="<?php echo $BaseUrl.'/assets/images/icon/sphome/technical-support.png';?>" class="img-responsive" alt="" style="padding-top: 35px;">
                                            </a>
                                        </div>
                                        <div class="col-md-8">
                                            <h3><a href="">FIND BEST OFFERS</a></h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                           
                                           
                                            
                                        </div> 
                            </div>
                        </div>
                    </div>
                   
                       
                     <div class="col-md-4">
                        <div class="left_couponoffer bg_white">
                            <div class="row">
                               
                                        <div class="col-md-4">
                                            <a href="">
                                             <img src="<?php echo $BaseUrl.'/assets/images/icon/sphome/technical-support.png';?>" class="img-responsive" alt="" style="padding-top: 35px;">
                                            </a>
                                        </div>
                                        <div class="col-md-8">
                                            <h3><a href="">SAVE MONEY</a></h3>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                           
                                           
                                            
                                        </div> 
                            </div>
                        </div>
                    </div>

                

                </div>
           <!--  </div> -->
             <div class="row">
                    <div class="col-md-10">
                        <div class="Latestdeals">
                            <h2>LATEST DEALS</h2>
                           
                        </div>
                    </div>
                     <div class="col-md-2">
                        <div class="Latestdealsbtn">
                          <a href="<?php echo $BaseUrl ?>/coupon/postcoupon.php" class="btn viewsall">VIEW ALL</a>
                           
                        </div>
                    </div>
                     
                       <div class="row" style="margin-top: 11%;">
                                <div class="col-md-4">
                                    <div class="coupon_box_1">
                                        <a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/stock-market-online.jpg';?>" class='img-responsive' alt="">

                                          <div class="top-lefticon"><span class="dot"><i class="fa fa-check-circle-o doticon" aria-hidden="true"></i></span></div>
                                        </a>
                                          
                                        <a href="" class="title">
                                          <p class="western">Westrn Degital USB 3.0 Hard Drives</p>
                                                
                                        </a>
                                        
                                        
                                        <span class="views"><i class="fa fa-map-marker" aria-hidden="true"></i> Canada</span>
                                        <span class="expiry"><i class="fa fa-shopping-basket" aria-hidden="true"></i> 42 bought</span>

                                         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

                                          <a href="" class="title">   
                                         <h4>$ 150.00</h4>
                                         </a>
                                        
                                    </div>
                                </div>
                              
                      <div class="col-md-4">
                                    <div class="coupon_box_1">
                                        <a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/stock-market-online.jpg';?>" class='img-responsive' alt="">

                                         <div class="top-lefticon"><span class="dot"><i class="fa fa-check-circle-o doticon" aria-hidden="true"></i></span></div>
                                        </a>
                                          
                                        <a href="" class="title">
                                          <p class="western">Westrn Degital USB 3.0 Hard Drives</p>
                                                
                                        </a>
                                        
                                        
                                        <span class="views"><i class="fa fa-map-marker" aria-hidden="true"></i> Canada</span>
                                        <span class="expiry"><i class="fa fa-shopping-basket" aria-hidden="true"></i> 42 bought</span>

                                         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

                                        <a href="" class="title">   
                                         <h4>$ 150.00</h4>
                                         </a>
                                        
                                    </div>
                                </div>
                              
                                <div class="col-md-4">
                                    <div class="coupon_box_1">
                                        <a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/stock-market-online.jpg';?>" class='img-responsive' alt="">
                                         <div class="top-lefticon"><span class="dot"><i class="fa fa-check-circle-o doticon" aria-hidden="true"></i></span></div>

                                        </a>
                                          
                                        <a href="" class="title">
                                         <p class="western">Westrn Degital USB 3.0 Hard Drives</p>
                                                
                                        </a>
                                        
                                        
                                        <span class="views"><i class="fa fa-map-marker" aria-hidden="true"></i> Canada</span>
                                        <span class="expiry"><i class="fa fa-shopping-basket" aria-hidden="true"></i> 42 bought</span>

                                         <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                            
                                         <a href="" class="title">   
                                         <h4>$ 150.00</h4>
                                         </a>
                                    </div>
                                </div>
                         </div>       

                              

                </div>


            


                <div class="row">
                    <div class="col-md-10">
                        <div class="Latestdeals">
                            <h2>HOT DEALS</h2>
                           
                        </div>
                    </div>
                     <div class="col-md-2">
                        <div class="Latestdealsbtn">
                          <a href="" class="btn viewsall">VIEW ALL</a>
                           
                        </div>
                    </div>
                     
                     <div class="row" style="margin-top: 11%;">
                                <div class="col-md-3">
                                    <div class="coupon_codebox">
                                        <a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/coffecup.jpg';?>" class='img-responsive' alt="">
                                        </a>
                                          
                                        <a href="" class="codetitle">
                                          <p class="Verfiedcode"><span style="color: #39D11B;">Verfied</span> 125 Used</p>
                                                
                                        </a>
                                        
                                        
                                        <span class="OFF">10% OFF</span>
                                       

                                         <h4>10% offf select XPS & Alienware laptops</h4>

                                         <p style="text-align: center;">Expire on 01/01/2018</p>    

                                          <a href="" class="btn getcoupon">GET COUPON CODE</a>
                                    </div>
                                </div>
                              

                              <div class="col-md-3">
                                    <div class="coupon_codebox">
                                        <a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/coffecup.jpg';?>" class='img-responsive' alt="">
                                        </a>
                                          
                                        <a href="" class="codetitle">
                                          <p class="Verfiedcode"><span style="color: #39D11B;">Verfied</span> 125 Used</p>
                                                
                                        </a>
                                        
                                        
                                        <span class="OFF">10% OFF</span>
                                       

                                         <h4>10% offf select XPS & Alienware laptops</h4>

                                         <p style="text-align: center;">Expire on 01/01/2018</p>    

                                          <a href="" class="btn getcoupon">GET COUPON CODE</a>
                                    </div>
                                </div>
                              

                              <div class="col-md-3">
                                    <div class="coupon_codebox">
                                        <a href="">
                                          

                                        <img src="<?php echo $BaseUrl.'/assets/images/coupon/coffecup.jpg';?>" class='img-responsive' alt="">
                                        </a>
                                          
                                        <a href="" class="codetitle">
                                          <p class="Verfiedcode"><span style="color: #39D11B;">Verfied</span> 125 Used</p>
                                                
                                        </a>
                                        
                                        
                                        <span class="OFF">10% OFF</span>
                                       

                                         <h4>10% offf select XPS & Alienware laptops</h4>

                                         <p style="text-align: center;">Expire on 01/01/2018</p>    

                                          <a href="" class="btn getcoupon">GET COUPON CODE</a>
                                    </div>
                                </div>
                              

                              <div class="col-md-3">
                                    <div class="coupon_codebox">
                                        <a href="">
                                          

                                         <img src="<?php echo $BaseUrl.'/assets/images/coupon/coffecup.jpg';?>" class='img-responsive' alt="">
                                        </a>
                                          
                                        <a href="" class="codetitle">
                                          <p class="Verfiedcode"><span style="color: #39D11B;">Verfied</span> 125 Used</p>
                                                
                                        </a>
                                        
                                        
                                        <span class="OFF">10% OFF</span>
                                       

                                         <h4>10% offf select XPS & Alienware laptops</h4>

                                         <p style="text-align: center;">Expire on 01/01/2018</p>    

                                          <a href="" class="btn getcoupon">GET COUPON CODE</a>
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