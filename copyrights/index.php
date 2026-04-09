<?php
    include("../univ/baseurl.php" );
    session_start();

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>   
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
        <!-- Owl Carousel Assets -->
        <link href="<?php echo $BaseUrl; ?>/assets/css/owl-carousel/owl.carousel.css" rel="stylesheet">
        <link href="<?php echo $BaseUrl; ?>/assets/css/owl-carousel/owl.theme.css" rel="stylesheet">     
    </head>

    <body>
    	<header class="headers">
            <div class="container">
                <nav class="navbar navbar_">
                    <div class="">
                        <div class="navbar-header">
                          <button type="button" class="navbar-toggle navbartog" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span> 
                          </button>
                          <a class="navbar-brand navbarbnrand" href="<?php echo $BaseUrl;?>"><img src="<?php echo $BaseUrl;?>/assets/images/logo/logo-share-page.png" alt="The SharePage" class="img-responsive"/></a>
                        </div>
                        <div class="collapse navbar-collapse collapse_ pull-right" id="myNavbar">
                            <ul class="nav navbar-nav">
                                <?php 
                                if (isset($_SESSION['uid'])) { ?>
                                    <li><a href="<?php echo $BaseUrl;?>/timeline">TIMELINE</a></li>
                                    <?php
                                } else {
                                    ?>
                                    <li><a href="<?php echo $BaseUrl;?>/login.php" style="padding-right: 0px!Important;">LOGIN</a></li>
                                    <li><a href="<?php echo $BaseUrl;?>/sign-up.php">REGISTER</a></li>
                                    <?php
                                }
                                ?>
                                
                                <li><a href="#" class="btn btn-green">Submit an AD</a></li>
                            </ul>
                            
                        </div>
                    </div>
                </nav>
                <div class="row">
                    <div class="col-md-12">
                        <div class="topsearch text-center">
                            <h2>What do you Love?</h2>
                            <h3>Do more of it with SharePage</h3>
                        </div>
                    </div>
                    <div class="col-md-offset-1 col-md-10">
                        <form id="searchform" method="post" action="search/search.php" >
                            <div class="form-group">
                                <select class="form-control" name="txtCategory" id="searchdropbox">
                                    <optgroup label="Profiles">
                                        <option value="-p">All</option>
                                        <?php
                                        $pt = new _profiletypes;
                                        $rpt = $pt->read();
                                        while ($row = mysqli_fetch_assoc($rpt)) {
                                            if ($row['idspProfileType'] != 6 && $row['idspProfileType'] != 5) {
                                                ?>
                                                <option value="<?php echo $row['idspProfileType']; ?>-p" <?php
                                                if (isset($categoryvalue)) {
                                                    if ($categoryvalue == $row['idspProfileType']) {
                                                        echo "selected";
                                                    }
                                                }
                                                ?> ><?php echo $row['spProfileTypeName'] ?></option> <?php
                                                    }
                                                }
                                                ?>
                                    </optgroup>
                                    <optgroup label="Product">
                                        <option value="-c" <?php
                                        if (isset($categoryvaluepro)) {
                                            if ($categoryvaluepro == "") {
                                                echo "selected";
                                            }
                                        }
                                        ?>>All</option>
                                                <?php
                                                $ca = new _categories;
                                                $result = $ca->read();
                                                //echo $ca->ta->sql;
                                                if ($result != false) {
                                                    while ($rows = mysqli_fetch_assoc($result)) {
                                                        ?>
                                                        <option value="<?php echo $rows['idspCategory']; ?>-c" <?php
                                                        if (isset($categoryvaluepro)) {
                                                            if ($categoryvaluepro == $rows['idspCategory']) {
                                                                echo "selected";
                                                            }
                                                        }
                                                        ?>><?php echo $rows['spCategoryName']; ?></option> <?php
                                                    }
                                                } ?>
                                    </optgroup>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="txtSearchHome" id="sp-auto-post" class="form-control" placeholder="Search" />
                                <button class="btn searchbtnmob" name="btnSearchHome" id="btnsearch" type="submit"><i class="fa fa-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <section class="contentpage">
            <div class="container">
				<div class="row">
					<div class="col-md-12">
						<?php
						$m = new _spAllStoreForm;
						$pageid = 1;
						$result = $m->readPage($pageid);
						if ($result) {
							$row = mysqli_fetch_assoc($result);
							$pageTitle = $row['page_title'];
							$pageDesc = $row['page_content'];
						}else{
							$pageTitle = "";
							$pageDesc == "";
						}
						?>
						<h2><?php echo $pageTitle; ?></h2>
						<p><?php echo $pageDesc; ?></p>
					</div>
				</div>

			</div>
        </section>

	



		 <footer >
            <div class="foot">
                <div class="container">
                    <div class="row">
                        <div class="col-md-4">
                            <a href="<?php echo $BaseUrl;?>"><img src="<?php echo $BaseUrl;?>/assets/images/logo/logo-share-page.png" class="img-responsive" alt="The SharePage" /></a>
                            <h3>The SharePage</h3>
                            <p>Fusce congue, risus et pulvinar cursus, orci arcu tristique lectus, sit amet placerat justo ipsum eu diam. Pellentesque tortor urna, pellentesque nec molestie eget, volutpat in arcu. Maecenas a lectus mollis.</p>
                            <div class="sociallinks">
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </div>
                        </div>
                        <div class="col-md-offset-1 col-md-3">
                            <h2>Useful links</h2>
                            <p><a href="<?php echo $BaseUrl?>/copyrights/">Copyrights</a></p>
                            <p><a href="<?php echo $BaseUrl?>/sitemap/">Site Map</a></p>
                            <p><a href="<?php echo $BaseUrl?>/helps/">Help</a></p>
                            <p><a href="<?php echo $BaseUrl?>/jobs/">Jobs</a></p>
                            <p><a href="<?php echo $BaseUrl?>/legal/">Legal</a></p>
                        </div>
                        <div class="col-md-4">
                            <h2>Contact Us</h2>
                            <ul>
                                <li><?php echo PHONE ?></li>
                                <li><?php echo CONTACT ?></li>
                                <li>Head Office:<br>
                                    Fusce congue, risus et pulvin<br>
                                    ar cursus, orci
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
            <div class="btm_foot text-center">
                <p>&copy; TheSharePage, <?php echo date('Y');?> All rights reserved</p>
            </div>
        </footer>
        <?php include('../component/btm_script.php'); ?>
        <script src="<?php echo $BaseUrl; ?>/assets/css/owl-carousel/owl.carousel.js"></script>

        <script>
            $(document).ready(function () {
                $("#owl-demo").owlCarousel({
                    items: 4,
                    lazyLoad: true,
                    navigation: true
                });

            });
        </script>
        <script type="text/javascript" >
            $(document).ready(function () {
                $('#Carousel').carousel({
                    interval: 5000
                })
            });
        </script>
 	</body>
</html>