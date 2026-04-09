<?php
include('../univ/baseurl.php');
session_start();

if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "videos/";
    include_once ("../authentication/check.php");

}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "10";
    $_GET["categoryName"] = "Videos";
    $header_video = "header_video";

    $f = new _spprofilehasprofile;

    $totalFrnd = array();
    $result3 = $f->readallfriend($_SESSION['pid']);
    if($result3 != false){
        while ($row3 = mysqli_fetch_assoc($result3)) {
            array_push($totalFrnd, $row3['spProfiles_idspProfilesReceiver']);
        }
    }

    $result4 = $f->readall($_SESSION['pid']);
    if($result4 != false){
        while ($row4 = mysqli_fetch_assoc($result4)) {
            array_push($totalFrnd, $row4['spProfiles_idspProfileSender']);
        }
    }

    $friend_ids = implode("','",$totalFrnd);
    $friend_id = "'".$friend_ids."'";
    //echo $friend_id; exit;
    ?>

    <!DOCTYPE html>
    <html lang="en-US">
    
    <head>        
        <?php include('../component/f_links.php');?>
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">
        <!-- owl carousel -->
        <link href="<?php echo $BaseUrl;?>/assets/css/owl.carousel.min.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $BaseUrl;?>/assets/css/owl.theme.default.min.css" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/percentage.css">
        <!-- responsive tabs -->
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/easy-responsive-tabs.css">
        <link href="<?php echo $BaseUrl;?>/assets/css/jquerysctipttop.css" rel="stylesheet" type="text/css">    
        <link rel="stylesheet" type="text/css" href="css/video.css">    
        <script src="<?php echo $BaseUrl;?>/assets/js/owl.carousel.min.js"></script>
        <script src="<?php echo $BaseUrl;?>/assets/js/easy-responsive-tabs.js"></script>
        <script src="<?php echo $BaseUrl;?>/assets/js/dropzone.min.js"></script>
        <link rel="stylesheet" href="<?php echo $BaseUrl;?>/assets/css/dropzone.min.css">
        <script type="text/javascript" src="js/video.js"></script>
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
                        items: 7,
                        nav: false
                    }
                }
            });
                $('#horizontalTab').easyResponsiveTabs({
                type: 'default', //Types: default, vertical, accordion           
                width: 'auto', //auto or any width like 600px
                fit: true,   // 100% fit in a container
                closed: 'accordion', // Start closed if in accordion view
                activate: function(event) { // Callback function if tab is switched
                    var $tab = $(this);
                    var $info = $('#tabInfo');
                    var $name = $('span', $info);
                    $name.text($tab.text());
                    $info.show();
                }
            });
            });            
        </script>  

    </head>
    <?php
        //session_start();

    $header_select = "header_video";
    include_once("../header.php");
    ?>
    <!--body content-->
<body cz-shortcut-listen="true"> 

    <div class="container-fluid">
        <div class="row">           
            <div class="col-sm-3 col-md-2 sidebar">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><i class="fa fa-search"></i></button>
                    </span>
                </div><!-- /input-group -->
                <div class="input-group">
                    <button type="button" class="btn btn-outline-secondary btn-block">
                        <a href="dashboard.php" style="color:inherit"><i class="fa fa-dashboard"></i> Dashboard </a>
                    </button>    
                </div>
                <div class="input-group">
                    <button type="button" class="btn btn-primary btn-block"><i class="fa fa-upload"></i> Upload</button>    
                </div>      

                <div>                   
                    <ul>
                        <li><a href="#" class="btn-block"><i class="fa fa-home"></i>Home</a></li>                           
                        <li><a href="#" class="btn-block"><i class="fa fa-video-camera"></i> My Videos </a></li>
                        <li><a href="#" class="btn-block"><i class="fa fa-list"></i> My Playlist </a></li>
                        <li><a href="#" class="btn-block"><i class="fa fa-file-video-o"></i> My Album </a></li>
                        <li><a href="#" class="btn-block"><i class="fa fa-heart"></i> My Favourites </a></li>
                        <li><a href="#" class="btn-block"><i class="fa fa-dollar"></i> My Earning </a></li>
                        <li><a href="#" class="btn-block"><i class="fa fa-file-video-o"></i> My Purchased Video </a></li>
                        <li><a href="#" class="btn-block"><i class="fa fa-handshake-o"></i> Contributions </a></li>
                        <li><a href="#" class="btn-block"><i class="fa fa-flag"></i> Flagged Videos </a></li>
                    </ul>                       
                </div>              
                <div>                   
                    <h4>Top Channels</h4>
                    <a href="#">
                        <div class="top_channels">
                            <div class="col-md-4">
                                <img src="https://dummyimage.com/70x70/000/fff" class="img-rounded img-responsive">
                            </div>
                            <div class="col-md-8">
                                <h4>I see you...</h4>
                                <p class="card-text">8 videos</p>
                                <p><i class="fa fa-eye"></i> 8469 views</p>                             
                            </div>  
                        </div>  <hr>                    
                    </a>
                    
                    <a href="#">
                        <div class="top_channels">
                            <div class="col-md-4">
                                <img src="https://dummyimage.com/70x70/000/fff" class="img-rounded img-responsive">
                            </div>
                            <div class="col-md-8">
                                <h4>I see you...</h4>
                                <p class="card-text">8 videos</p>
                                <p><i class="fa fa-eye"></i> 8469 views</p>                             
                            </div>  
                        </div>  <hr>                    
                    </a>                                
                </div>
                <div >                  
                        <h4>Top Categories</h4>
                    <ul>
                        <li>Comedy (13)</li>
                        <li>Crime (8)</li>
                        <li>Horror (15)</li>
                        <li>Sci-Fi (14)</li>
                        <li>Sport (20)</li>
                        <li>Romance (10)</li>
                        <li>TECH (10)</li>
                        <li>TV SHOW (9)</li>
                    </ul>
                    
                </div>
                
            </div>
            <div class="col-sm-9 col-md-10 main">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>  
                    <li><a href="#">Videos</a></li>          
                </ol>
                <div class="tags">
                    <button class="btn btn-outline-secondary btn-round">All</button>
                    <button class="btn btn-outline-secondary btn-round">Movie</button>
                    <button class="btn btn-outline-secondary btn-round">space</button>
                    <button class="btn btn-outline-secondary btn-round">funny</button>
                    <button class="btn btn-outline-secondary btn-round">classical</button>
                </div>
                <div>
                    <h3>Collection</h3><hr>
                    <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="000">
                        <div class="MultiCarousel-inner">
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary leftLst"><</button>
                        <button class="btn btn-primary rightLst">></button>
                    </div>
                </div>
                <div>
                    <h3>Top Videos</h3><hr>
                    <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="000">
                        <div class="MultiCarousel-inner">
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary leftLst"><</button>
                        <button class="btn btn-primary rightLst">></button>
                    </div>
                </div>
                <div>
                    <h3>Recent Videos</h3><hr>
                    <div class="MultiCarousel" data-items="1,3,5,6" data-slide="1" id="MultiCarousel"  data-interval="000">
                        <div class="MultiCarousel-inner">
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                            <div class="item">
                                <div class="pad15">
                                    <a href="watch.php"><img src="https://dummyimage.com/200x200/000/fff" class="img-responsive">                                
                                    <div class="play"><img src="http://cdn1.iconfinder.com/data/icons/flavour/button_play_blue.png" /> </div>
                                    <h4>Multi Item Carousel </h4> </a>
                                    <p>Short Description...</p>
                                    <p><i class="fa fa-eye"></i> 125K | <i class="fa fa-thumbs-up "></i> 250k | <a href=""><i class="fa fa-share"> </i> Share</a></p>
                                    
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary leftLst"><</button>
                        <button class="btn btn-primary rightLst">></button>
                    </div>
                </div>
            </div>          
        </div>
    </div>

    <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
            <script src="../../dist/js/bootstrap.min.js"></script>
            <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
            <script src="../../assets/js/vendor/holder.min.js"></script>
            <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
            <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>   
            <script type="text/javascript">
                $(document).ready(function () {
                    var itemsMainDiv = ('.MultiCarousel');
                    var itemsDiv = ('.MultiCarousel-inner');
                    var itemWidth = "";

                    $('.leftLst, .rightLst').click(function () {
                        var condition = $(this).hasClass("leftLst");
                        if (condition)
                            click(0, this);
                        else
                            click(1, this)
                    });

                    ResCarouselSize();




                    $(window).resize(function () {
                        ResCarouselSize();
                    });

                    //this function define the size of the items
                    function ResCarouselSize() {
                        var incno = 0;
                        var dataItems = ("data-items");
                        var itemClass = ('.item');
                        var id = 0;
                        var btnParentSb = '';
                        var itemsSplit = '';
                        var sampwidth = $(itemsMainDiv).width();
                        var bodyWidth = $('body').width();
                        $(itemsDiv).each(function () {
                            id = id + 1;
                            var itemNumbers = $(this).find(itemClass).length;
                            btnParentSb = $(this).parent().attr(dataItems);
                            itemsSplit = btnParentSb.split(',');
                            $(this).parent().attr("id", "MultiCarousel" + id);


                            if (bodyWidth >= 1200) {
                                incno = itemsSplit[3];
                                itemWidth = sampwidth / incno;
                            }
                            else if (bodyWidth >= 992) {
                                incno = itemsSplit[2];
                                itemWidth = sampwidth / incno;
                            }
                            else if (bodyWidth >= 768) {
                                incno = itemsSplit[1];
                                itemWidth = sampwidth / incno;
                            }
                            else {
                                incno = itemsSplit[0];
                                itemWidth = sampwidth / incno;
                            }
                            $(this).css({ 'transform': 'translateX(0px)', 'width': itemWidth * itemNumbers });
                            $(this).find(itemClass).each(function () {
                                $(this).outerWidth(itemWidth);
                            });

                            $(".leftLst").addClass("over");
                            $(".rightLst").removeClass("over");

                        });
                    }


                    //this function used to move the items
                    function ResCarousel(e, el, s) {
                        var leftBtn = ('.leftLst');
                        var rightBtn = ('.rightLst');
                        var translateXval = '';
                        var divStyle = $(el + ' ' + itemsDiv).css('transform');
                        var values = divStyle.match(/-?[\d\.]+/g);
                        var xds = Math.abs(values[4]);
                        if (e == 0) {
                            translateXval = parseInt(xds) - parseInt(itemWidth * s);
                            $(el + ' ' + rightBtn).removeClass("over");

                            if (translateXval <= itemWidth / 2) {
                                translateXval = 0;
                                $(el + ' ' + leftBtn).addClass("over");
                            }
                        }
                        else if (e == 1) {
                            var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
                            translateXval = parseInt(xds) + parseInt(itemWidth * s);
                            $(el + ' ' + leftBtn).removeClass("over");

                            if (translateXval >= itemsCondition - itemWidth / 2) {
                                translateXval = itemsCondition;
                                $(el + ' ' + rightBtn).addClass("over");
                            }
                        }
                        $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
                    }

                    //It is used to get some elements from btn
                    function click(ell, ee) {
                        var Parent = "#" + $(ee).parent().attr("id");
                        var slide = $(Parent).attr("data-slide");
                        ResCarousel(ell, Parent, slide);
                    }

                });
            </script>   
</body>


<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
<?php
}
?>
