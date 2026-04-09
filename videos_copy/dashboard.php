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
                    <button type="button" class="btn btn-outline-secondary btn-block"><i class="fa fa-dashboard"></i> Dashboard</button>    
                </div>
                <div class="input-group">
                    <button type="button" class="btn btn-primary btn-block"><i class="fa fa-upload"></i> Upload</button>    
                </div>      

                <div>                   
                    <ul>
                        <li><a href="index.php" class="btn-block"><i class="fa fa-home"></i>Home</a></li>                           
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
            </div>
            <div class="col-sm-9 col-md-10 main">
                <ol class="breadcrumb">
                    <li><a href="#">Video Home</a></li>  
                    <li><a href="#">Dashboard</a></li>          
                </ol>
                <div class="border_bg">
                    <div class="row placeholders">
                        <div class="col-xs-6 col-sm-3 placeholder">
                            <div class="panel panel-default">
                                <div class="panel-body sp_color"> 150 <i class="fa fa-ellipsis-v"></i></div>
                                <div class="panel-footer sp_color_footer">SP Points</div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3 placeholder">
                            <div class="panel panel-default">
                                <div class="panel-body my_earn"> 150 <i class="fa fa-dollar"></i></div>
                                <div class="panel-footer my_earn_footer">My Earning</div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3 placeholder">
                            <div class="panel panel-default">
                                <div class="panel-body my_video"> 150 <i class="fa fa-video-camera"></i></div>
                                <div class="panel-footer my_video_footer">My Video</div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-3 placeholder">
                            <div class="panel panel-default">
                                <div class="panel-body contribution"> 150 <i class="fa fa-handshake-o"></i></div>
                                <div class="panel-footer contribution_footer">Contributions</div>
                            </div>
                        </div>
                    </div>              
                </div>
                <div class="border_bg">
                    <div class="row placeholders">
                        <div class="col-xs-6 col-sm-6 placeholder">
                            <div class="panel panel-default">
                                <div class="panel-heading">My Purchase Video</div>
                                <div class="panel-body"> 150 <i class="fa fa-play"></i></div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 placeholder">
                            <div class="panel panel-default">
                                <div class="panel-heading">My Playlist </div>
                                <div class="panel-body"> 150 <i class="fa fa-list"></i></div>
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 placeholder">
                            <div class="panel panel-default">
                                <div class="panel-heading">My Album</div>
                                <div class="panel-body"> 150 <i class="fa fa-file-video-o"></i></div>                               
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 placeholder">
                            <div class="panel panel-default">
                                <div class="panel-heading">My Favourite</div>
                                <div class="panel-body"> 150 <i class="fa fa-heart"></i></div>
                            </div>
                        </div>
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

</body>


<?php 
include('../component/f_footer.php');
include('../component/f_btm_script.php'); 
?>
<?php
}
?>
