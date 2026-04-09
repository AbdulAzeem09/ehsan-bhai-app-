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
    

?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
    </head>

    <body class="bg_gray">
        <?php include_once("../header.php");?>
        <section class="innerArtBannertwo">
            <div class="container">
                <div class="row">
                    
                    <div class="col-md-offset-2 col-md-8">
                        <div class="innerFormTop">
                            <form class="form-inline">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group" style="width: 100%;">
                                            <input type="text" name="" class="form-control" placeholder="Search images, vector, illustration">
                                            <select class="form-control">
                                                <option>Images</option>
                                                <option>Photo</option>
                                                <option>video</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="bg_white" style="border-bottom: 2px solid #CCC">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="art_scnd_levl">
                            <li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=1';?>">Visual Artist</a></li>
                            <li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=2';?>">Graphics Designer</a></li>
                            <li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=3';?>">Contemporary</a></li>
                            <li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=4';?>">Animation</a></li>
                            <li><a href="<?php echo $BaseUrl.'/photos/artist.php?cat=5';?>">Musician</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section> 
        <div class="space"></div> 
        <section class="">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 topbread">
                        <nav aria-label="breadcrumb">
                          <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/photos';?>"><i class="fa fa-home"></i></a></li>
                            
                            <li class="breadcrumb-item active" aria-current="page">Call For Artist</li>
                          </ol>
                        </nav>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 text-justify">
                        <p>Are you looking to participate in a festival, exhibition, contest, creative collective, art project? Scroll through the ads here below for all kinds of open calls. Please note that this is a free posting board, not curated or edited by TSP. We do not take any responsibility of double checking all the calls published on this page.</p>
                        <p>Artists are always in demand. You can sort this list by: deadline, date posted, region of eligible artists or discipline. You can also view additional opportunities on our public art list.</p>
                        <p>Note: Our database assigns an arbitrary deadline of January 1 of next year to Artist Calls submitted with no deadline. Don't delay in applying.</p>
                        <p>Looking for talent? Click here to post an Artist Call The Arts staff must review all submissions before publishing to the website, so your Artist Call may not immediately show up in our list.</p>
                    </div>
                    <div class="col-md-4">
                        <div class="rightCal">
                            <img src="<?php echo $BaseUrl.'/assets/images/art/call-to.jpg'?>" class="img-responsive">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <div class="space"></div>
        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
	</body>
</html>
<?php
}
?>
