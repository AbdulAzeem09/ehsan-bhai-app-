<?php 
    include('../univ/baseurl.php');
    session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "photos/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
  
    $_GET["categoryID"] = 13;
    
    if(isset($_GET['cat']) AND $_GET['cat']>0){
        if($_GET['cat'] == 1){
            $breadcrumb = "Visual Artist";
        }else if($_GET['cat'] == 2){
            $breadcrumb = "Graphics Designer";
        }else if($_GET['cat'] == 3){
            $breadcrumb = "Contemporary";
        }else if($_GET['cat'] == 4){
            $breadcrumb = "Animation";
        }else if($_GET['cat'] == 5){
            $breadcrumb = "Musician";
        }

    }
    $header_photo = "header_photo";
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
        <!--This script for posting timeline data End-->
    </head>

    <body class="bg_gray">
        <?php include_once("../header.php");?>
        <section class="innerArtBanner">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-2 col-md-8">
                        <h1>Art Gallery</h1>
                    </div>
                    <?php include('top-search.php');?>
                </div>
            </div>
        </section>
        <section class="m_btm_40">
            <div class="mainArtist">
                <div class="container">
                    <div class="fulmainarttab">
                        <ul class='nav nav-tabs' id='navtabart' style="width: 100%">
                            <li role="presentation" class="<?php echo ($_GET['cat'] == 1)?'active':'';?>"><a href="#visualArt" aria-controls="home" role="tab" data-toggle="tab">Visual Artist</a></li>
                            <li role="presentation" class="<?php echo ($_GET['cat'] == 2)?'active':'';?>"><a href="#graphicDesigner" aria-controls="home" role="tab" data-toggle="tab">Graphics Designer</a></li>
                            <li role="presentation" class="<?php echo ($_GET['cat'] == 3)?'active':'';?>"><a href="#contemporary" aria-controls="home" role="tab" data-toggle="tab">Contemporary</a></li>
                            <li role="presentation" class="<?php echo ($_GET['cat'] == 4)?'active':'';?>"><a href="#animation" aria-controls="home" role="tab" data-toggle="tab">Animation</a></li>
                            <li role="presentation" class="<?php echo ($_GET['cat'] == 5)?'active':'';?>"><a href="#musician" aria-controls="home" role="tab" data-toggle="tab">Musician</a></li>
                               
                        </ul>
                        
                    </div>
                </div>
            </div>
            <div class="space"></div>
            <div class=" container">
                
                <div class="row">
                    
                    <div class="col-md-12">
                        <div class="tab-content no-radius otherTimleineBody m_top_20" style="min-height: 500px;">
                            <!--PopularArt-->
                            <div role="tabpanel" class="tab-pane <?php echo ($_GET['cat'] == 1)?'active':'';?>" id="visualArt">
                                <?php
                                $module = "Visual Artist";
                                $moduleId = 1;
                                $catName = "visual Artist";
                                include('bread-artist.php');
                                ?>
                                
                            </div>
                            <!--graphicDesigner-->
                            <div role="tabpanel" class="tab-pane <?php echo ($_GET['cat'] == 2)?'active':'';?>" id="graphicDesigner">
                                <?php
                                $module = "Graphics Designer";
                                $moduleId = 2;
                                $catName = "graphics designer";
                                include('bread-artist.php');
                                ?>
                                
                            </div>
                            <!--contemporary-->
                            <div role="tabpanel" class="tab-pane <?php echo ($_GET['cat'] == 3)?'active':'';?>" id="contemporary">

                                <?php
                                $module = "Contemporary";
                                $moduleId = 3;
                                $catName = "contemporary";
                                include('bread-artist.php');
                                ?>
                            </div>
                            <!--animation-->
                            <div role="tabpanel" class="tab-pane <?php echo ($_GET['cat'] == 4)?'active':'';?>" id="animation">
                                <?php
                                $module = "Animation";
                                $moduleId = 4;
                                $catName = "animation";
                                include('bread-artist.php');
                                ?>
                                
                            </div>
                            <!--musician-->
                            <div role="tabpanel" class="tab-pane <?php echo ($_GET['cat'] == 5)?'active':'';?>"  id="musician">
                                <?php
                                $module = "Musician";
                                $moduleId = 5;
                                $catName = "musician";
                                include('bread-artist.php');
                                ?>
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