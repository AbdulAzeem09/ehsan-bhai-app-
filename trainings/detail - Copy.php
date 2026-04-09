<?php
    include('../univ/baseurl.php');
    session_start();
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "8";
    $_GET["categoryName"] = "Trainings";
    $header_train = "header_train";


    if (isset($_GET['postid']) && $_GET['postid'] > 0) {
        $postid = $_GET['postid'];
        $p = new _postingview;
        $pf  = new _postfield;

        $result = $p->singletimelines($postid);
        //echo $p->ta->sql;
        if($result != false){
            $row = mysqli_fetch_assoc($result);
            $ProTitle   = $row['spPostingtitle'];
            $ProDes     = $row['spPostingNotes'];
            $ArtistName = $row['spProfileName'];
            $ArtistId   = $row['idspProfiles'];
            $ArtistAbout= $row['spProfileAbout'];
            $ArtistPic  = $row['spProfilePic'];
            $price      = $row['spPostingPrice'];
            $country    = $row['spPostingsCountry'];
            $city      = $row['spPostingsCity'];

            //posting fields
            $result_pf = $pf->read($row['idspPostings']);
            //echo $pf->ta->sql."<br>";
            if($result_pf){
                $outline = "";
                $txtDiscount = "";
                $spPostingCompany    = "";
                $spPostingTraimnerBio = "";
                $trainingcategory = "";
                
                while ($row2 = mysqli_fetch_assoc($result_pf)) {
                    if($outline == ''){
                        if($row2['spPostFieldName'] == 'outline_'){
                            $outline = $row2['spPostFieldValue'];
                        }
                    }
                    if($txtDiscount == ''){
                        if($row2['spPostFieldName'] == 'txtDiscount_'){
                            $txtDiscount = $row2['spPostFieldValue'];
                        }
                    }
                    if($spPostingCompany == ''){
                        if($row2['spPostFieldName'] == 'spPostingCompany_'){
                            $spPostingCompany = $row2['spPostFieldValue'];
                        }
                    }
                    if($spPostingTraimnerBio == ''){
                        if($row2['spPostFieldName'] == 'spPostingTraimnerBio_'){
                            $spPostingTraimnerBio = $row2['spPostFieldValue'];
                        }
                    }
                    if($trainingcategory == ''){
                        if($row2['spPostFieldName'] == 'trainingcategory_'){
                            $trainingcategory = $row2['spPostFieldValue'];
                        }
                    }
                    

                }
            }
        }
        
    }else{
        $re = new _redirect;
        $redirctUrl = "../trainings";
        $re->redirect($redirctUrl);
    }


?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <!--This script for posting timeline data Start-->
        <script src="<?php echo $BaseUrl; ?>/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/js/jquery-1.11.4-ui.min.js"></script>
        <!--This script for posting timeline data End-->
       

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
        <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/fckeditor/fckeditor.js"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/calendar/calendar.css" media="screen">
        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/calendar/alternate.css" media="screen">
        <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/calendar/mootools.js"></script>
        <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/calendar/calendar.js"></script>
        <script type="text/javascript">     
            //<![CDATA[
            window.addEvent('domready', function() { 
                myCal1 = new Calendar({ txtNewsDate: 'd-m-Y' }, { classes: ['alternate'], navigation: 2 } , { direction: 0, tweak: { x: 6, y: 0 }});
            });
            window.onload = function()
            {
                // Automatically calculates the editor base path based on the _samples directory.
                // This is usefull only for these samples. A real application should use something like this:
                // oFCKeditor.BasePath = '/fckeditor/' ;    // '/fckeditor/' is the default value.
                var sBasePath = '<?php echo $BaseUrl; ?>/assets/fckeditor/' ;
                var oFCKeditor = new FCKeditor( 'lyric' ) ;
                oFCKeditor.BasePath = sBasePath ;
                oFCKeditor.ReplaceTextarea() ;
                
            }
            
        </script>
    </head>

    <body class="bg_gray">
         <?php
        include_once("../header.php");
        ?>
        
        <section>
            <div class="row no-margin">
                <div class="col-md-3 no-padding">
                    <?php include('../component/left-training.php');?>
                </div>
                <div class="col-md-9 no-padding">
                    <div class="head_right_enter">
                        <div class="row no-margin">
                            <div class="col-md-12 no-padding">
                                <div class="fulmainarttab">
                                    <ul class='nav nav-tabs' id='navtabVdo' >
                                        <li role="presentation" class="active"><a href="#video1" aria-controls="home" role="tab" data-toggle="tab">Training Detail</a></li> 
                                        <!-- <li><a href="<?php echo $BaseUrl.'/trainings/album.php';?>">My Album</a></li>
                                        <li><a href="<?php echo $BaseUrl.'/trainings/dashboard.php';?>">My Playlist</a></li>          -->                       
                                    </ul>
                                    <div class="linebtm"></div>
                                </div>
                            </div>
                            <div class="col-md-12 no-padding">
                                <div class="row no-margin topVdoBread">
                                    <div class="col-md-12 no-padding">
                                        <nav aria-label="breadcrumb">
                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/trainings';?>"><i class="fa fa-home"></i></a></li>
                                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/trainings/category.php';?>">All Trainings</a></li> 
                                                <li class="breadcrumb-item active" aria-current="page"><?php echo ucwords($ProTitle); ?></li> 
                                            </ol>
                                        </nav>
                                    </div>
                                </div>
                                <div class="tab-content no-radius otherTimleineBody" style="padding: 0px 20px;">
                                    <!--PopularArt-->
                                    <div role="tabpanel" class="tab-pane active" id="video1">
                                        <div class="artistDetail">

                                            <div class="bg_white ArtistSong">
                                                <div class="row">
                                                    
                                                    <div class="col-md-7">

                                                        <div class="rightDetailVideo">
                                                            <h3><?php echo ucwords($ProTitle); ?></h3>
                                                            <p class="text-justify"><?php echo $ProDes; ?></p>
                                                            <h3>Course Outline</h3>
                                                            <p><?php echo $outline; ?></p>
                                                            <div class="table-responsive">
                                                                <table class="table table-striped table-bordered">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Category</td>
                                                                            <td><?php echo $trainingcategory; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Price</td>
                                                                            <td><?php echo ($price > 0)?'$'.$price:'Free';?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Discount (%)</td>
                                                                            <td><?php echo $txtDiscount; ?>%</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Company</td>
                                                                            <td><?php echo $spPostingCompany; ?></td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5 text-justify">
                                                        <div class="rightDetailVideo midLyricbox">
                                                            <h3>Videos</h3>
                                                            <div class="row">
                                                                <?php
                                                                $mus = new _postingmusicmedia;
                                                                $res3 = $mus->readPostMusic($_GET['postid']);
                                                                //echo $mus->ta->sql;
                                                                if ($res3 != false) {
                                                                    while($au = mysqli_fetch_assoc($res3)){
                                                                        ?>
                                                                        <div class="col-md-6">
                                                                            <video controls style="width: 100%;">
                                                                                <source src="<?php echo $BaseUrl.'/upload/training/'.$au['musicmediaTitle'];?>" type="video/mp4">                                                                  
                                                                                Your browser does not support the video tag.
                                                                            </video>
                                                                        </div>
                                                                            <?php
                                                                    }                                                                
                                                                }
                                                                ?>
                                                            </div>


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="space"></div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </section>
        <div class="space-lg"></div>

        <?php 
        
        include('../component/footer.php');
        include('../component/btm_script.php'); 
        ?>
	</body>
</html>
