<?php
    include("../univ/baseurl.php" );
    session_start();

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include('../component/f_links.php');?> 
<style>

.mytime{
	background-color:#17ab56;
	border-radius: 3px;
}
.mytime:hover{
	background-color:#15974c!important;
}
.navbarbnrand img{width: 220px;}
</style>		
	</head>
	<body >
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
                          <a class="navbar-brand navbarbnrand" href="<?php echo $BaseUrl;?>"><img src="<?php echo $BaseUrl ?>/img/main_logo.png" alt="The SharePage" class="img-responsive"/></a>
                        </div>
                        <div class="collapse navbar-collapse collapse_ pull-right" id="myNavbar">
                            <ul class="nav navbar-nav">
                                <?php 
                                if (isset($_SESSION['uid'])) { ?>
                                    <li><a href="<?php echo $BaseUrl;?>/timeline"  class="mytime">MY TIMELINE</a></li>
                                    <?php

                                } else {
                                    ?>
                                    <li><a href="<?php echo $BaseUrl;?>/login.php" style="padding-right: 0px!Important;">LOGIN</a></li>
                                    <li><a href="<?php echo $BaseUrl;?>/sign-up.php">REGISTER</a></li>
                                    <?php
                                }
                                ?>
                                
                             <!-- <li><a href="<?php echo $BaseUrl.'/store'; ?>" class="btn btn-green">Submit An AD</a></li> -->
                            </ul>
                            
                        </div>
                    </div>
                </nav>
                <div class="row">
                    <div class="col-md-12">
                        <div class="topsearch text-center">
                            <h2>The SharePage!</h2>
                            <h3>Now you can find some awesome ways to connect with friends, share, post and earn money while socializing!</h3>
                            <!-- <h2>Share Whats in your mind</h2>
                            <h3>Post what you like to share with your friends - message, photo,  audio/video or documents</h3> -->
                        </div>
                    </div>
                    <div class="col-md-offset-1 col-md-10">
                        <form id="searchform" method="post" action="<?php echo $BaseUrl.'/search/search.php'?>" >
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
		<div class="container" style="padding: 50px;">
			<!-- <hr class='hrline'> -->
			<div class="bhome <?php echo (isset($_GET["login"]) ? '"style="display: none;"' : 'curr"'); ?>">
				
				<div class="row" style="min-height: 400px;">
					
				<?php
				$conn = _data::getConnection();
				if(isset($_POST['btnSearchHome'])){
					$txtCategoryHome	= mysqli_real_escape_string($conn, $_POST['txtCategory']);
					$txtSearchHome 		= mysqli_real_escape_string($conn, $_POST['txtSearchHome']);
					
					$newString = preg_replace('/\d+/u', '', $txtCategoryHome);
					$string    = preg_replace('/-+/', '', $newString); 
					//get id from striing
					$categoryId = preg_replace("/[^0-9]/","",$txtCategoryHome);

					if($string == 'p'){
						$p = new _spprofiles;
						$srpvt = $p->searchprofile($categoryId, $txtSearchHome);
						//echo $p->ta->sql;
						if ($srpvt != false){ ?>
							<div class=""> <?php
								while($row = mysqli_fetch_assoc($srpvt)){ ?>
									<div class="col-md-2 no-padding">
	                                    <div class="alluserserch text-center">
	                                        <a href="../friends/?profileid=<?php echo $row['idspProfiles'];?>">
	                                        	<div class="allUserImgBox">
	                                        		<img alt="<?php echo $row['spProfileName']; ?>" class="img-responsive center-block" src="<?php echo ((isset($row['spProfilePic']))?" ". ($row['spProfilePic'])."":"../assets/images/blank-img/default-profile.png");?>">
	                                            </div>
	                                            <?php
	                                            if (strlen($row['spProfileName']) > 10) {
	                                            	?>
	                                            	<h2 data-toggle="tooltip" title="<?php echo ucwords(strtolower($row['spProfileName'])); ?>" ><?php echo substr(ucwords(strtolower($row['spProfileName'])), 0,10).'...' ; ?></h2>
	                                            	<?php
	                                            }else{
	                                            	?>
	                                            	<h2 data-toggle="tooltip" title="<?php echo ucwords(strtolower($row['spProfileName'])); ?>" ><?php echo substr(ucwords(strtolower($row['spProfileName'])), 0,10) ; ?></h2>
	                                            	<?php
	                                            }
	                                            ?>	                                            
	                                            <h5><?php echo $row['spProfileTypeName'];?> Profile</h5>
	                                            <span>View Profile</span>
	                                        </a>
	                                    </div>
	                                </div>
									

									
								 	<?php
								} ?>
							</div><?php
						}else{ ?>
							<div class="row" style="background-color:#f2f2f2;margin-bottom: 5px;">
								<div class="col-md-7 title" style="color:#1a936f;">
									<h2>Result Not Found</h2>
								</div>
							</div> <?php
						}


					}else if($string == 'c'){
						$p = new _sppostreview;
						$sres = $p->searchproduct($categoryId, $txtSearchHome);
						//GET IMAGES FORM POSTINGPIC
						if ($sres != false){ ?>
							<div class="row"> <?php
								while ($row2 = mysqli_fetch_assoc($sres)) { 
									$pc = new _postingpic;
									$res = $pc->read($row2['idspPostings']);
									if ($res != false){
										$postr = mysqli_fetch_assoc($res);
									}
									?>
									<div class="col-md-2 no-padding">
										<div class="alluserserch text-center">
	                                        <a href="../store/detail.php?catid=1&postid=<?php echo $row2['idspPostings'];?>&back=back">
	                                        	<div class="allUserImgBox">
	                                        		<img alt="<?php echo $row2['spPostingTitle']; ?>" class="img-responsive center-block" src="<?php echo ((isset($postr['spPostingPic']))?" ". ($postr['spPostingPic'])."":"../assets/images/blank-img/no-store.png");?>">
	                                            </div>
	                                            <div style="min-height: 30px;">
	                                            	<?php
		                                            if (strlen($row2['spPostingTitle']) > 10) {
		                                            	?>
		                                            	<h2 data-toggle="tooltip" title="<?php echo ucwords(strtolower($row2['spPostingTitle'])); ?>" ><?php echo substr(ucwords(strtolower($row2['spPostingTitle'])), 0,10).'...' ; ?></h2>
		                                            	<?php
		                                            }else{
		                                            	?>
		                                            	<h2 data-toggle="tooltip" title="<?php echo ucwords(strtolower($row2['spPostingTitle'])); ?>" ><?php echo substr(ucwords(strtolower($row2['spPostingTitle'])), 0,10) ; ?></h2>
		                                            	<?php
		                                            }
		                                            ?>	   

	                                            	
	                                            </div>
	                                            <span>View Detail</span>
	                                        </a>
	                                    </div>
									</div>


									 <?php									
								} ?>
							</div><?php
						}
					}
				}else{
					$re = new _redirect;
					$re->redirect('../');
					//header('location:../');
				}

				?>

				</div>
			</div>

		</div>
		
		<?php
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
	</body>
</html>