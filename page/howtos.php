<?php
    session_start();
    include("../univ/baseurl.php" );
    include("../backofadmin/library/config.php");
    require_once('../common.php');
	
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
		
	}
    spl_autoload_register("sp_autoloader");
	
    if (isset($_GET['page']) && $_GET['page'] != '') {
        $paget = str_replace('_', ' ', strtolower($_GET['page'])) ;
		
        $m = new _spAllStoreForm;
		
		
        $result = $m->readPageTitle($paget);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $pageTitle = $row['page_title'];
            $pageDesc = $row['page_content']; 
			}else{
            $pageTitle = "";
            $pageDesc = "";
		}
		}else{
        $pageTitle = "";
        $pageDesc = "";
	}
	

?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
    <link rel="stylesheet" href="../assets/css/landingpage/style.css">
    <link rel="stylesheet" href="../assets/css/landingpage/all.css">  <!-- fontawesome icon -->
    <link rel="stylesheet" href="../image/bootstrap-4.0.0-dist/css/bootstrap.css">
    <link rel="stylesheet" href="../image/bootstrap-4.0.0-dist/css/bootstrap.min.css">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css?family=Rancho" rel="stylesheet">
     <link rel="stylesheet" href="<?php echo $BaseUrl?>/assets/css/custom.css">
    <link rel="stylesheet" href="<?php echo $BaseUrl?>/assets/css/time-line.css">
    <script src="<?php echo $BaseUrl?>/assets/js/jquery_3.5.1/jquery.min.js"></script> 
    <link rel="icon" type="image/x-icon" href="../image/logosharepage 1.png">
        <?php include('../component/f_links.php');
			
			
			?> 
			<?php // include '../component/custom.css.php';?>
		<script>document.getElementsByTagName("html")[0].className += " js";</script>
        
		<link rel="stylesheet" href="assets/css/style.css">
		<link rel="stylesheet" href="assets/css/style.scss">
	</head>
	<style>
 .cd-faq__category {
    position: relative;
    display: block;
    height: 50px;
    line-height: 50px;
    padding: 0 2em 0 1.05em;
    padding: 0 var(--space-lg) 0 calc(var(--space-sm) * 1.4);
    color: hsl(0, 0%, 100%);
    color: var(--cd-color-4);
    background-color: hsl(213, 7%, 33%);
    background-color: hsl(217deg 82% 28%);  
    -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        --border-color: hsl(213, 7%, 36.3%);
        --border-color: hsl(var(--cd-color-1-h), var(--cd-color-1-s), calc(var(--cd-color-1-l) * 1.1));
        border-bottom: 1px solid hsl(213, 7%, 36.3%);
        border-bottom: 1px solid var(--border-color);
    }
		a.cd-faq__trigger {
		color: hsl(218deg 74% 29%);
		font-weight: 500 !important;
		}
		.contentpage p span, .contentpage ul li, .contentpage ul li span {
		font-size: 24px!important;
		}
		.text-component p {
		font-size:17px !important; 
		}
		a.cd-faq__category {
		font-size: 13px !important;
		}
		.cd-faq__categories {
		width: 250px !important;
		    height: max-content;
		}
		a{
		text-decoration:none !important;
		}
        @media(max-width: 767px) {
            .cd-faq__categories {
		width: 100% !important;
		}
            .text-component p {
		font-size:16px !important; 
		}
        }
		.navright {
        text-decoration: none;
        line-height: 13px;
        width: 195px;
        font-size: 14pt!important;
        font-family: tahoma;
        margin-top: 1px;
        margin-right: -126px;
        position: absolute;
        top: 53px;
        right: 273px;
        color: white;
    }
    .mytime{background-color:#17ab56!important; padding:13px 29px; border-radius:4px;margin-top: -26px;margin-right: -278px;}
	.mytime:hover{background-color:#15974c!important;}	
	.headers{
        min-height : auto !important;
    }
	.nav{ margin-top: -25px!important;}
	.collapse_ ul li a.navright { padding: 10px!important; }  
	.headers {
        min-height: 0px;
    }
	</style>  
	
    <body>
	<header class="header inr-logo">
        <div class="container-fluid">
            <nav class="row">
                <div class="col-md-3 logo">
                    <a href="<?php echo $BaseUrl; ?>">
                    <img src="../image/logosharepage 1.png" alt="logo">
                    <span class="a">The SharePage</span>
                    </a>
                </div>
                <div class="col-md-9">
                    <div class="row justify-content-lg-end">
                        <div id="slide-bar" >
                            <div id="toggle" class="d-flex"></div>
                        </div>
                        <ul id="sidebar" class="row menu">
                            <li><a href="<?php echo $BaseUrl; ?>" class="active">Home</a></li>
                            <!-- <li><a href="<?php echo $BaseUrl;?>/page/?page=investment_opportunities">Investment Opportunities</a></li> -->
                            <!-- <li><a href="<?php echo $BaseUrl;?>/page/?page=referral__commissions">Earning Opportunities</a></li> -->
                            <!-- <li><a href="<?php echo $BaseUrl;?>/page/event.php?page=event">Event</a></li> -->
                            <!-- <li><a href="<?php echo $BaseUrl;?>/page/howtos.php?page=howtos">How To</a></li> -->
                            <?php if (isset($_SESSION['uid'])) { ?>
                                <li><a href="<?php echo $BaseUrl . '/timeline'; ?>"  class="timeline btn-border-radius">My Timeline</a></li>
                                <li><a href="<?php echo $BaseUrl . '/authentication/logout.php'; ?>"  class="timeline btn-border-radius">Log Out</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    
                </div>
                <!-- <div class="col-md-2 bar">
                    <div class="bar-1"></div>
                    <div class="bar-2"></div>
                    <div class="bar-3"></div>
                </div> -->
            </nav>
        </div>
    </header>
    	  <header class="headers inr-logo">
            <div class="container">
                <nav class="navbar navbar_" style="margin-top: 20px;">
                    <div class="">
                        <div class="navbar-header">
                          <button type="button" class="navbar-toggle navbartog" data-toggle="collapse" data-target="#myNavbar">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span> 
                          </button>
						 
                          <a class="navbar-brand navbarbnrand" href="<?php echo $BaseUrl;?>"><img src="../image/logo.png" alt="The SharePage" class="img-responsive" style="width:218px;"></a>

                        </div>
						
                        <div class="collapse navbar-collapse collapse_ pull-right" id="myNavbar">
                            <ul class="nav navbar-nav">
                                <?php 
                                if (isset($_SESSION['uid'])) { ?>
                                    <li>
									<!--<a href="<?php echo $BaseUrl;?>/timeline">MY TIMELINE</a>-->
									<a href="<?php echo $BaseUrl;?>/timeline"  class="navright pull-right mytime btn-border-radius">MY TIMELINE</a></li>
                                    <?php

                                } else {
                                    ?>
                                    <li><a class="btn-border-radius" href="<?php echo $BaseUrl;?>/login.php" style="background-color:#17ab56!important; border-radius:4px;margin-right: 16px;">LOGIN</a></li>
                                     
                                    <li><a class="btn-border-radius" style="background-color:#17ab56!important; border-radius:4px" href="<?php echo $BaseUrl;?>/sign-up.php">REGISTER</a></li>
                                    <?php
                                }
                                ?>
                                
                               <!-- <li><a href="<?php echo $BaseUrl.'/store'; ?>" class="btn btn-green">SUBMIT AN AD</a></li>  -->
                            </ul>
                            
                        </div>
                    </div>
                </nav>
                <div class="row">
                    - <div class="col-md-12">
                        <div class="topsearch text-center"> 
                             <h2>Learn more about The SharePage.</h2>
                            <!-- <h3>The SharePage is not just a platform,
                                it's a transformative movement.</h3> -->
                            <!-- <h2>Share Whats in your mind</h2>
                            <h3>Post what you like to share with your friends - message, photo,  audio/video or documents</h3> -->
                         </div>
                        
                    </div>
                    <div style="display:none;" class="col-md-offset-1 col-md-10">
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
            <div class="container-faq">
				<div class="row">
				 
					<div class="col-md-12">
						
						
						<?php 
							$readFAQ = $m->readFAQ();
							$readFAQ_qa= $m->readFAQ();
							
						?>
						
						
						<section class="cd-faq js-cd-faq container max-width-md margin-top-lg margin-bottom-lg">
							<ul class="cd-faq__categories">
								
								
								<?php
									
									while ($row = mysqli_fetch_assoc($readFAQ)) { ?>
									
									<li><a class="cd-faq__category cd-faq__category-selected" href="#<?php echo $row['position']; ?>"><?php echo $row['module_name']; ?></a></li>
									<?php }
								?>
									
							</ul> <!-- cd-faq__categories -->
							
							<div class="cd-faq__items">
											
											<?php  
								if($readFAQ_qa!=false){
								while ($row_q_a = mysqli_fetch_assoc($readFAQ_qa)) { 
								?>
								
								<ul id="<?php echo $row_q_a['position']; ?>" class="cd-faq__group">
									<li class="cd-faq__title">
										<h2><?php echo $row_q_a['module_name']; ?></h2>
									</li>
									
									
									<?php       $getqanq= $m->getqanq($row_q_a['id']); 
										//echo $row_q_a['id'];
										//print_r($getqanq); die('=====');
										if($getqanq!=false){
										while ($row = mysqli_fetch_assoc($getqanq)) {  
											
										?>
										
										
										
										<li class="cd-faq__item">
											<a class="cd-faq__trigger" href="#0"> <span>
                                            <?php
                                            $question = ucwords(strtolower($row['question']));
                                            echo $question;
                                             //echo $row['question'];  
                                             
                                             ?></span></a>

											<div class="cd-faq__content">
												<div class="text-component">
													<p><?php echo $row['answer'];  ?></p>
												</div>


												
											<?php	$readFAQ_attach= $m->faqaattac($row['id']);  
											if($readFAQ_attach!=false){
												while ($row_attac = mysqli_fetch_assoc($readFAQ_attach)) {  

													if($row_attac['type']=='1'){ 

														?>
															<div class="row">
													<div class="col-md-3">
													</div>

														<div class="col-md-6">
												<video width="100%" controls>
												  <source src="<?php echo $row_attac['file']; ?>" type="video/mp4">
												</video>
												<br>
													</div>
													</div>

												<?php	}
														else {  ?>
															<div class="row">

															<div class="col-md-3">
													</div>
																<div class="col-md-6">
															<img src="<?php echo $row_attac['file']; ?>">
																											<br>

															</div>
																</div>


	
											<?php }  }}?>	
											</div> <!-- cd-faq__content -->
										</li>
										<?php } }?>
								</ul>	
								
								<?php }} ?>
								
								
							</div> <!-- cd-faq__items -->
							
							<a href="#0" class="cd-faq__close-panel text-replace">Close</a>
							
							 <div class="cd-faq__overlay" aria-hidden="true"></div>
						</section> <!-- cd-faq -->
						
						
						<!--	<h2><?php echo $pageTitle; ?></h2>
						<p><?php echo $pageDesc; ?></p>   -->
					</div>
				</div>
				
			</div>
		</section>
		
		
		
		
<script>
    //side menu bar
    const toggle = document.getElementById('toggle');
    const sidebar = document.getElementById('sidebar');

    document.onclick = function(e){
        if(e.target.id !== 'sidebar' && e.target.id !== 'toggle')
        {
            toggle.classList.remove('active')
            sidebar.classList.remove('active')
        }
    }
    toggle.onclick = function () {
        toggle.classList.toggle('active');
        sidebar.classList.toggle('active');

    }
</script>
        <?php 
			// include('../component/f_footer.php');
            include_once("../views/common/footer.php");                        
		    include('../component/f_btm_script.php'); ?>
		
		<script src="assets/js/util.js"></script> 
		<script src="assets/js/main.js"></script>
	</body>
</html>