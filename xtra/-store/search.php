<?php
	include('../univ/baseurl.php');
	session_start();
	if(!isset($_SESSION['pid'])){	
		include_once ("../authentication/check.php");
		$_SESSION['afterlogin'] = "store/";
	}

	function sp_autoloader($class){
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	if(isset($_POST['txtStoreSearch']) && isset($_POST['btnSearchStore'])){
		$txtStoreSearch = $_POST['txtStoreSearch'];
		$txtSearchCategory 	= $_POST['txtSearchCategory'];
		
	}else{
		$re = new _redirect;
  		$re->redirect("../store");
	}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	    <?php include('../component/links.php');?>
	    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>  
        <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
	    <!--This script for sticky left and right sidebar STart-->
	    <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
	    <script>
	        function execute(settings) {
	            $('#sidebar').hcSticky(settings);
	        }
	        // if page called directly
	        jQuery(document).ready(function($){
	            if (top === self) {
	                execute({
	                    top: 20,
	                    bottom: 50
	                });
	            }
	        });
	        function execute_right(settings) {
	            $('#sidebar_right').hcSticky(settings);
	        }
	         // if page called directly
	        jQuery(document).ready(function($){
	            if (top === self) {
	                execute_right({
	                    top: 20,
	                    bottom: 50
	                });
	            }
	        });
	        
	    </script>
	    <!--This script for sticky left and right sidebar END--> 
	</head>
	<body class="bg_gray">

		<?php
			
			
			//this is for store header
        	$header_store = "header_store";

			include_once("../header.php");
		?>
		<section class="main_box">
            <div class="container">
                <div class="row">
                    <div id="sidebar" class="col-md-2 no-padding">
                        <div class="left_grid store_left_cat">
                            <?php
                              include('../component/left-store.php');
                            ?>
                        </div>
                    </div>
		
					<div class="col-md-10">
						<?php
                        include('top-dashboard.php');
                        ?>
                        <div class="store_searchbox m_btm_10">
                            <form method="POST" action="search.php">
                                <div class="">
                                    <input type="hidden" name="txtSearchCategory" value="1">
                                    <input type="text" class="form-control" name="txtStoreSearch" placeholder="Search For Products" />
                                    <button type="submit" class="btn store_search_btn" name="btnSearchStore">Search</button>
                                </div>                                
                            </form>
                        </div>
                        <div class="row no-margin">
							<?php
							if(isset($_POST['txtStoreSearch'])){
								$txtSearchCategory 	= $_POST['txtSearchCategory'];
								$txtStoreSearch 	= $_POST['txtStoreSearch'];

								
								$p = new _postingview;

								if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                                  	//my store
                                  	$res = $p->search_myall_store($_SESSION['uid'], $txtStoreSearch);
                                }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
                                  	//friend store
                                 	 $res = $p->search_store_friends_Posting($_SESSION['uid'], $txtStoreSearch);
                                }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
                                  	//group post
                                  	$res = $p->search_all_group_store($_SESSION['pid'], $txtStoreSearch);
                                }else{
                                  	//public store
                                  	$res = $p->search_publicpost(isset($start), 1, $txtStoreSearch);
                                }
                               	
								
								//echo $p->ta->sql;
								//GET IMAGES FORM POSTINGPIC
								
                                if($res != false){
                                    while ($rows = mysqli_fetch_assoc($res)) {
                                      	$dt = new DateTime($rows['spPostingDate']);
                                      	?>
                                     
                                        <div class="col-md-3 no-padding">
                                          	<div class="featured_box text-center">
                                            	<div class="img_fe_box">
	                                              	<a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>">
		                                                <?php
		                                                  	$pic = new _postingpic;
		                                                  	$result = $pic->read($rows['idspPostings']);
		                                                  	//echo $pic->ta->sql;
		                                                  
		                                                    if ($result != false) {
		                                                        $rp = mysqli_fetch_assoc($result);
		                                                        $picture = $rp['spPostingPic'];
		                                                        echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
		                                                    } else{
		                                                        echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
		                                                    }
		                                                  
		                                                ?>
	                                              	</a>
                                            	</div>
	                                            <h4>
	                                            	<?php 
	                                            	//echo $rows['spPostingtitle'];
	                                                if(!empty($rows['spPostingtitle'])){
	                                                    if(strlen($rows['spPostingtitle']) < 15){
	                                                        ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $rows['spPostingtitle']; ?>"><?php echo $rows['spPostingtitle']; ?></a><?php
	                                                    }else{
	                                                        ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $rows['spPostingtitle']; ?>"><?php echo substr($rows['spPostingtitle'], 0,15).'...'; ?></a><?php
	                                                    }
	                                                }else{
	                                                    echo "&nbsp;";
	                                                }
	                                                ?>    
	                                            </h4>
	                                            <h5 >
	                                              	<?php
	                                              	if ($rows['spPostingPrice'] != false) {
	                                                  	echo "<div class='postprice' style='display: inline-block;' data-price='" . $rows['spPostingPrice'] . "'>$" . $rows['spPostingPrice'] . "</div>";
	                                              	}else{
	                                                  	echo "Expires on ".$rows['spPostingExpDt'];
	                                              	}
	                                              	?>
	                                            </h5>
	                                            <h6 class="name"><a href="<?php echo $BaseUrl.'/store/user-product.php?userid='.$rows['idspProfiles']?>"><?php echo ucwords(strtolower($rows['spProfileName']));?></a></h6>
                                            	<!-- <h6 class="name"><?php echo $rows['spProfileName'];?></h6> -->
                                            	<p class="date"><?php echo $dt->format('d F'); ?> | <?php echo $dt->format('H:i a'); ?></p>
                                          	</div>
                                        </div>
                                      	<?php
                                      	
                                    }
                                }else{
                                	echo "<div class'' style='min-height: 300px;'>No Record Found..!</div>";
                                }

							}
							?>	
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