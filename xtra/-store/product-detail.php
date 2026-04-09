<?php
  include('../univ/baseurl.php');
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <script type="text/javascript">
             jQuery(document).ready(function($) {
                $('#myCarousel').carousel({
                        interval: 5000
                });         
                $('#carousel-text').html($('#slide-content-0').html());
                //Handles the carousel thumbnails
               $('[id^=carousel-selector-]').click( function(){
                    var id = this.id.substr(this.id.lastIndexOf("-") + 1);
                    var id = parseInt(id);
                    $('#myCarousel').carousel(id);
                });
                // When the carousel slides, auto update the text
                $('#myCarousel').on('slid.bs.carousel', function (e) {
                         var id = $('.item.active').data('slide-number');
                        $('#carousel-text').html($('#slide-content-'+id).html());
                });
            });
        </script>
    </head>

    <body class="bg_gray">
    	<?php
        session_start();
        if(!isset($_SESSION['pid']))
        { 
          include_once ("../authentication/check.php");
          $_SESSION['afterlogin']="my-posts/";
        }
        function sp_autoloader($class)
        {
          include '../mlayer/' . $class . '.class.php';
        }
        spl_autoload_register("sp_autoloader");
        //this is for store header
        $header_store = "header_store";

        include_once("../header.php");
        
        
      ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 no-padding">
                        <div class="left_store">
                            <select class="form-control">
                                <option>Category</option>
                                <option>Looking For</option>
                                <option>Job Boards</option>
                            </select>
                            <h2><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/game-icon.png" class="img-responsive" alt=""> Computing & Gaming</h2>

                            <h3 class="active_store">Laptops</h3>
                            <ul>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Notebooks</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Macbooks</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Refurbished Laptops</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Tablet PCs</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Mini & Netbooks</a></li>
                            </ul>

                            <h3 >Printers & Scanners</h3>
                            <ul>
                                <li><a href=""><i class="fa fa-chevron-right"></i> All-in-Ones</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Laser Printer</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Diskjet, Inkjet & Officejet Printers</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Scanners</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Ink Cartridges & Toners</a></li>
                            </ul>

                            <h3 >Storage</h3>
                            <ul>
                                <li><a href=""><i class="fa fa-chevron-right"></i> External Hard Drives</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> USB/Flash Drives</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Memory Cards</a></li>
                            </ul>

                            <h3 >Peripherals & Accessories</h3>
                            <ul>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Laptop Bags & Sleeves</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Other Computer Accessories</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Networking</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Keyboard</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Mouse</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Software</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Headphones & Speakers</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Projectors</a></li>
                            </ul>

                            <h3 >Gaming PC & Peripherals</h3>
                            <ul>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Gaming Peripherals</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> PC Games</a></li>
                                <li><a href=""><i class="fa fa-chevron-right"></i> Gaming Graphics Cards</a></li>
                            </ul>

                            
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="row no-margin">
                            <div class="col-md-12 no-padding">
                                <div class="top_banner">
                                    <img src="<?php echo $BaseUrl;?>/assets/images/icon/store/banner.png" class="img-responsive" alt="" />
                                    <h2>318 Products Found</h2>
                                </div>
                            </div>
                        </div>
                        <div class="store_searchbox m_btm_10">
                            <form>
                                <div class="">
                                    <input type="text" class="form-control" placeholder="Search For Products" />
                                    <button type="submit" class="btn store_search_btn">Search</button>
                                </div>                                
                            </form>
                        </div>
                        <div class="breadcrumb_box m_btm_10">
                            <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="#">Home</a></li>
                              <li class="breadcrumb-item"><a href="#">Computing $ Gaming</a></li>
                              <li class="breadcrumb-item"><a href="#">Laptops</a></li>
                              <li class="breadcrumb-item"><a href="#">HP</a></li>
                              <li class="breadcrumb-item active">15-bs095nia Notebook - 15.6&quot; HD LED</li>
                            </ol>
                        </div>
                        <div class="row">
                            <div class="col-md-9">
                                <div class="pro_detail_box">
                                    <h2>Broadcast Quality HD Camera</h2>
                                    <div class="row no-margin">
                                        <div class="col-md-6 no-padding">
                                            <div class="product_slider_box">
                                                <div id="carousel-bounding-box">
                                                    <div class="carousel slide" id="myCarousel">
                                                        <!-- Carousel items -->
                                                        <div class="carousel-inner productslider">
                                                            <div class="active item" data-slide-number="0">
                                                                <img src="<?php echo $BaseUrl;?>/assets/images/icon/store/product-main.jpg" class="img-responsive" alt="" />
                                                            </div>

                                                            <div class="item" data-slide-number="1">
                                                                <img src="http://placehold.it/770x300&text=two">
                                                            </div>

                                                            <div class="item" data-slide-number="2">
                                                                <img src="http://placehold.it/770x300&text=three">
                                                            </div>

                                                            <div class="item" data-slide-number="3">
                                                                <img src="http://placehold.it/770x300&text=four">
                                                            </div>
                                                        </div><!-- Carousel nav -->
                                                                                     
                                                    </div>
                                                </div>
                                                <div class="hidden-xs" id="slider-thumbs">
                                                    <!-- Bottom switcher of slider -->
                                                    <ul class="row hide-bullets">
                                                        <li class="col-sm-2 padding_5 thumb_box">
                                                            <a class="thumbnail" id="carousel-selector-0">
                                                                <img src="<?php echo $BaseUrl;?>/assets/images/icon/store/pro-1.jpg" class="img-responsive" alt="" />
                                                            </a>
                                                        </li>
                                                        <li class="col-sm-2 padding_5 thumb_box">
                                                            <a class="thumbnail" id="carousel-selector-1">
                                                                <img src="<?php echo $BaseUrl;?>/assets/images/icon/store/pro-2.jpg" class="img-responsive" alt="" />
                                                            </a>
                                                        </li>

                                                        <li class="col-sm-2 padding_5 thumb_box">
                                                            <a class="thumbnail" id="carousel-selector-2">
                                                                <img src="<?php echo $BaseUrl;?>/assets/images/icon/store/pro-3.jpg" class="img-responsive" alt="" />
                                                            </a>
                                                        </li>

                                                        <li class="col-sm-2 padding_5 thumb_box">
                                                            <a class="thumbnail" id="carousel-selector-3">
                                                                <img src="<?php echo $BaseUrl;?>/assets/images/icon/store/pro-4.jpg" class="img-responsive" alt="" />
                                                            </a>
                                                        </li>
                                                    </ul>                 
                                                </div>

                                                <ul class="produc_quote_box">
                                                    <li><a href="#"><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/quote.png"> Quote</a></li>
                                                    <li><a href="#"><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/enquiry.png"> Enquiry</a></li>
                                                    <li><a href="#"><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/favourite.png"> Favourite</a></li>
                                                    <li><a href="#"><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/wishlist.png"> Wishlist</a></li>
                                                    <li><a href="#"><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/share.png"> Share</a></li>
                                                </ul>

                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="product_detail_right">
                                                <ul class="pro_add">
                                                    <li>London, UK | Added on 3 Sep,<br>
                                                        Ad ID: 839417874</li>
                                                </ul>
                                                <p>Item Condition: <span class="black_clr">New</span> <span class="pull-right qty_box">Quantity: <input type="text" name="" placeholder="1" /></span></p>
                                                <div class="price_box">
                                                    <p>$ 1,85,000</p>
                                                    <span class="left_old_price"><strike>$215,000</strike></span>
                                                    <span class="red_box"><strike>7%</strike></span>
                                                </div>
                                                <div class="btn_box">
                                                    <input type="submit" name="" value="Buy Now" class="btn btn_cart_buy">
                                                    <input type="submit" name="" value="Add to Cart" class="btn btn_cart">
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="space"></div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            
                                            <div class="panel with-nav-tabs panel-default main_panel_pro">
                                                <div class="panel-heading no-padding product_desc">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active"><a href="#tab1default" data-toggle="tab">Description</a></li>
                                                        <li><a href="#tab2default" data-toggle="tab">Specification</a></li>
                                                        <li><a href="#tab3default" data-toggle="tab">Reviews</a></li>
                                                        <li><a href="#tab4default" data-toggle="tab">Transaction Overview</a></li>
                                                    </ul>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade in active" id="tab1default">
                                                            <p>Panasonic HVX200A camera with 2 P2 32GB cards + remote + 2 batteries + strap + Rokinon wide angle adapter lens. Single user. Very good condition. Content filmed with camera has aired on Al Jazeera and NHK. *Broadcast quality HD Camera*</p>
                                                        </div>
                                                        <div class="tab-pane fade" id="tab2default">
                                                            <p>Panasonic HVX200A camera with 2 P2 32GB cards + remote + 2 batteries + strap + Rokinon wide angle adapter lens. Single user. Very good condition. Content filmed with camera has aired on Al Jazeera and NHK. *Broadcast quality HD Camera*</p>
                                                        </div>
                                                        <div class="tab-pane fade" id="tab3default">
                                                            <p>Panasonic HVX200A camera with 2 P2 32GB cards + remote + 2 batteries + strap + Rokinon wide angle adapter lens. Single user. Very good condition. Content filmed with camera has aired on Al Jazeera and NHK. *Broadcast quality HD Camera*</p>
                                                        </div>
                                                        <div class="tab-pane fade" id="tab4default">
                                                            <p>Panasonic HVX200A camera with 2 P2 32GB cards + remote + 2 batteries + strap + Rokinon wide angle adapter lens. Single user. Very good condition. Content filmed with camera has aired on Al Jazeera and NHK. *Broadcast quality HD Camera*</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="heading02 text-center">
                                            <h1><span>More Products from Seller</span></h1>
                                        </div>
                                    </div>
                                </div>
                                <div class="row no-margin">
                                    <div class="col-md-4 no-padding">
                                        <div class="product_box">
                                            <img src="<?php echo $BaseUrl;?>/assets/images/icon/store/product-2.jpg" class="img-responsive" alt="" />
                                            <h2>Nikon</h2>
                                            <p class="desc">D5600 - DSLR Camera 24.2 MP with AF-P DX NIKKOR Lens - Black</p>
                                            <p class="price_pro">US $ 760,075 <span class="pull-right per_box">-8%</span></p>
                                            <p class="rating_box">4.0 <i class="fa fa-star yellow_clr"></i> <i class="fa fa-star yellow_clr"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <a href="#">(12)</a></p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 no-padding">
                                        <div class="product_box">
                                            <img src="<?php echo $BaseUrl;?>/assets/images/icon/store/product-2.jpg" class="img-responsive" alt="" />
                                            <h2>Nikon</h2>
                                            <p class="desc">D5600 - DSLR Camera 24.2 MP with AF-P DX NIKKOR Lens - Black</p>
                                            <p class="price_pro">US $ 760,075 <span class="pull-right per_box">-8%</span></p>
                                            <p class="rating_box">4.0 <i class="fa fa-star yellow_clr"></i> <i class="fa fa-star yellow_clr"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <a href="#">(12)</a></p>
                                        </div>
                                    </div>
                                    <div class="col-md-4 no-padding">
                                        <div class="product_box">
                                            <img src="<?php echo $BaseUrl;?>/assets/images/icon/store/product-2.jpg" class="img-responsive" alt="" />
                                            <h2>Nikon</h2>
                                            <p class="desc">D5600 - DSLR Camera 24.2 MP with AF-P DX NIKKOR Lens - Black</p>
                                            <p class="price_pro">US $ 760,075 <span class="pull-right per_box">-8%</span></p>
                                            <p class="rating_box">4.0 <i class="fa fa-star yellow_clr"></i> <i class="fa fa-star yellow_clr"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <i class="fa fa-star-o"></i> <a href="#">(12)</a></p>
                                        </div>
                                    </div>

                                    
                                </div>


                            </div>
                            <div class="col-md-3 no_pad_left_right">
                                <div class="seller_info">
                                    <div class="row no-margin">
                                        <div class="col-md-2 no-padding">
                                            <img src="<?php echo $BaseUrl;?>/assets/images/icon/store/seller_id.jpg" class="img-responsive" alt="" />
                                        </div>
                                        <div class="col-md-10">
                                            <h4>Rosey Toms</h4>
                                            <p class="pro_qty">(350 Products)</p>
                                        </div>
                                    </div>
                                    <div class="row no-margin">
                                        <div class="col-md-12 no-padding">
                                            <p class="active_site">Active on site since 9 Months </p>
                                            <p class="adds">User Ads</p>
                                            <p><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/phone.png"> 3008293882</p>
                                            <p><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/email.png"> rosey@gmail.com</p>
                                            <p><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/location.png"> XYZ , Hongkong 12345</p>
                                            <p class="sel_chat"><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/chat.png"> <a href="">Lets Chat</a></p>

                                        </div>
                                    </div>
                                </div>

                                <div class="saftey_box">
                                    <h2>Safety Tips for Buyers</h2>
                                    <ol>
                                        <li>Meet seller at a safe location</li>
                                        <li>Check the item before you buy</li>
                                        <li>Pay only after collecting item</li>
                                    </ol>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </section>



    	<?php 
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
    </body>
</html>
