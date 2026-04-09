<?php
	include('../univ/baseurl.php');
	session_start();
	if(!isset($_SESSION['pid'])){ 
		include_once ("../authentication/check.php");
		$_SESSION['afterlogin']="timeline/";
	}
	function sp_autoloader($class){
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
        <!--CSS FOR MULTISELECTOR-->
        <link href="<?php echo $BaseUrl;?>/assets/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo $BaseUrl;?>/assets/js/bootstrap-multiselect.js" type="text/javascript"></script>
        
        <script type="text/javascript">
            //USER ONE
            $(function () {
                $('#leftmenu').multiselect({
                    includeSelectAllOption: true
                });
                
            });
            
        </script>
        
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
                        include('searchform.php');
                        ?>
                        <?php
                        $p = new _postingview;
                        if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                          //my store
                          $res = $p->myall_store($_SESSION['uid']);
                          $storeofmonth = $p->store_of_month(6, $_SESSION['uid'], $_SESSION['pid']);

                        }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
                          //friend store
                          $res = $p->store_friends_Posting($_SESSION['uid']);
                          $storeofmonth = $p->store_of_month(4, $_SESSION['uid'], $_SESSION['pid']);

                        }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
                          //group post
                          $res = $p->all_group_store($_SESSION['pid']);
                          $storeofmonth = $p->store_of_month(5, $_SESSION['uid'], $_SESSION['pid']);

                        }else if(isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2){
                          //retail post
                          $res = $p->retailpost(1);
                          $storeofmonth = $p->store_of_month(2, $_SESSION['uid'], $_SESSION['pid']);

                        }else{
                          //public store
                          $res = $p->publicpost(isset($start), 1);
                          $storeofmonth = $p->store_of_month(1, $_SESSION['uid'], $_SESSION['pid']);
                        }
                        $storeValue = str_replace(' ', '_', $storeofmonth);
                        $StoreTitle = str_replace('&', '-', $storeValue);
                        ?>
                        
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                              <div class="heading03">
                                <h3>New Arrival <span class="pull-right"><a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php';?>">(View All)</a></span></h3>
                              </div>

                              <div class="carousel carousel-showmanymovetwo slide" id="itemslider_two">
                                <div class="carousel-inner">
                                  <?php
                                  $p = new _postingview;
                                    if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                                      //my store
                                      $res = $p->myall_store($_SESSION['uid']);
                                    }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
                                      //friend store
                                      $res = $p->store_friends_Posting($_SESSION['uid']);
                                    }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
                                      //group post
                                      $res = $p->all_group_store($_SESSION['pid']);

                                    }else if(isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2){
                                        //group post
                                        $res = $p->retailpost(1);
                                    }else{
                                      //public store
                                      //$res = $p->publicpost(isset($start), 1);
                                      $res = $p->publicpost_store_pro(1, 20);
                                    }

                                  //echo $p->ta->sql;
                                  $active = 0;
                                  if($res != false){
                                    while ($rows = mysqli_fetch_assoc($res)) {?>
                                      <div class="item <?php echo ($active == 0)?'active':'';?>">
                                        <div class="col-xs-5ths">
                                          <div class="img_new_arriv text-center">
                                            <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>">
                                              <?php
                                                $pic = new _postingpic;
                                                $result = $pic->read($rows['idspPostings']);
                                                //echo $pic->ta->sql;
                                                if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
                                                  if ($result != false) {
                                                      $rp = mysqli_fetch_assoc($result);
                                                      $picture = $rp['spPostingPic'];
                                                      echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                  } else
                                                      echo "<img alt='Posting Pic' src='../img/no-pic.jpg' class='img-responsive'>";
                                                }else{
                                                  if ($result != false) {
                                                      $rp = mysqli_fetch_assoc($result);
                                                      $picture = $rp['spPostingPic'];
                                                      echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                  } else
                                                      echo "<img alt='Posting Pic' src='../img/no-pic.jpg' class='img-responsive'>";
                                                }
                                              ?>
                                              
                                            </a>
                                          </div>
                                        </div>
                                      </div>
                                      <?php
                                      $active++;
                                    }
                                  } ?>

                                  
                                </div>
                                <div id="slider-control" class="slideNewContrl">
                                  <a class="left carousel-control" href="#itemslider_two" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                  <a class="right carousel-control" href="#itemslider_two" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                </div>
                              </div>
                            </div>
                        
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
              								<div class="heading03">
              									<h3>All Products <span class="pull-right"><a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php';?>">(View All)</a></span></h3>
              								</div>

                              <div class="carousel carousel-showmanymoveone slide" id="itemslider">
                                <div class="carousel-inner">
                                  <?php
                                    $pr = new _spprofilehasprofile;
                                    $p = new _postingview;
                                    if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                                      //my store
                                      $res = $p->myall_store_random($_SESSION['uid']);
                                    }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
                                      //friend store
                                      $res = $p->store_friends_Posting_randm($_SESSION['uid']);
                                    }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
                                      //group post
                                      $res = $p->all_group_store_random($_SESSION['pid']);
                                    }else if(isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2){
                                        //retail post
                                        $res = $p->retailpost_random(1);
                                    }else{
                                      //public store
                                      $res = $p->publicpost_random(1, 30);
                                    }
                                    
                                  //echo mysqli_num_rows($res);
                                  //echo $p->ta->sql;
                                  $active = 0;
                                  if($res != false){
                                    while ($rows = mysqli_fetch_assoc($res)) {
                                      $dt = new DateTime($rows['spPostingDate']);
                                      //echo $rows['idspProfiles'];
                                      if($_SESSION['pid'] != $rows['idspProfiles']){
                                        
                                        $result3 = $pr->frndLeevel($_SESSION['pid'], $rows['idspProfiles']);
                                        //echo $pr->ta->sql;
                                        //echo $result3;
                                        if($result3 == 0){
                                          $level = '1st Degree';
                                        }else if($result3 == 1){
                                          $level = '1st Degree';
                                        }else if($result3 == 2){
                                          $level = '2nd Degree';
                                        }else if($result3 == 3){
                                          $level = '3rd Degree';
                                        }else{
                                          $level = 'Not Define';
                                        }
                                      }else{
                                        $level = '1st Degree';
                                      }
                                      
                                     ?>
                                      <div class="item <?php echo ($active == 0)?'active':'';?>">
                                        <div class="col-xs-5ths">
                                          <div class="featured_box text-center">
                                            <div class="img_fe_box">
                                              <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>">
                                                <?php
                                                  $pic = new _postingpic;
                                                  $result = $pic->read($rows['idspPostings']);
                                                  //echo $pic->ta->sql;
                                                  if ($rows['idspCategory'] != 5 && $rows['idspCategory'] != 2) {
                                                    if ($result != false) {
                                                        $rp = mysqli_fetch_assoc($result);
                                                        $picture = $rp['spPostingPic'];
                                                        echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                    } else
                                                        echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                                                  }else{
                                                    if ($result != false) {
                                                        $rp = mysqli_fetch_assoc($result);
                                                        $picture = $rp['spPostingPic'];
                                                        echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                    } else
                                                        echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                                                  }
                                                ?>
                                              </a>
                                            </div>
                                            <h4>
                                              <?php 
                                                if(!empty($rows['spPostingtitle'])){
                                                    if(strlen($rows['spPostingtitle']) < 15){
                                                        ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $rows['spPostingtitle']; ?>"><?php echo ucwords($rows['spPostingtitle']); ?></a><?php
                                                    }else{
                                                        ?><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$rows['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $rows['spPostingtitle']; ?>"><?php echo ucwords(substr($rows['spPostingtitle'], 0,15)).'...'; ?></a><?php
                                                    }
                                                }else{
                                                    echo "&nbsp;";
                                                }
                                                ?>    
                                            </h4>
                                            <h5 >
                                              <?php
                                              if ($rows['spPostingPrice'] != false) {
                                                  echo "<div class='postprice' style='display: inline-block;' data-price='" . $rows['spPostingPrice'] . "'>$" . $rows['spPostingPrice'] . "</div><span class='" . ($rows['idspCategory'] == 5 || $rows['idspCategory'] == 18 || $rows['idspCategory'] == 9 || $rows['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                                              }else{
                                                  echo "Expires on ".$rows['spPostingExpDt'];
                                              }
                                              ?>
                                            </h5>
                                            <h6 class="name"><a href="<?php echo $BaseUrl.'/store/user-product.php?userid='.$rows['idspProfiles']?>"><?php echo ucwords(strtolower($rows['spProfileName']));?></a></h6>
                                            <span><?php echo $level;?></span>
                                            <p class="date"><?php echo $dt->format('d M Y'); ?> | <?php echo $dt->format('H:i a'); ?></p>
                                          </div>
                                        </div>
                                      </div> <?php
                                      $active++;
                                    }
                                  } ?>
                                  
                                </div>

                                <div id="slider-control" class="scndSlideStr" >
                                  <a class="left carousel-control" href="#itemslider" data-slide="prev"><i class="fa fa-angle-left"></i></a>
                                  <a class="right carousel-control" href="#itemslider" data-slide="next"><i class="fa fa-angle-right"></i></a>
                                </div>
                              </div>
                            </div>
                        </div>
                        
                        <div class="row">
                          <div class="col-md-12">
                            <div class="btm_img_str">
                              <img src="<?php echo $BaseUrl;?>/assets/images/icon/store/quote.jpg" class="img-responsive" />
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
        
         
        <script type="text/javascript">
          $(document).ready(function(){
            $('#itemslider').carousel({ interval: false });
            $('.carousel-showmanymoveone .item').each(function(){
              var itemToClone = $(this);
            for (var i=1;i<5;i++) {
              itemToClone = itemToClone.next();
              if (!itemToClone.length) {
                itemToClone = $(this).siblings(':first');
              }
              itemToClone.children(':first-child').clone()
                .addClass("cloneditem-"+(i))
                .appendTo($(this));
              }
            });
          });
        </script>
        <script type="text/javascript">
          $(document).ready(function(){
            $('#itemslider_two').carousel({ interval: false });
            $('.carousel-showmanymovetwo .item').each(function(){
              var itemToClone = $(this);
              for (var i=1;i<5;i++) {
                itemToClone = itemToClone.next();
                if (!itemToClone.length) {
                  itemToClone = $(this).siblings(':first');
                }
                itemToClone.children(':first-child').clone()
                  .addClass("cloneditem-"+(i))
                  .appendTo($(this));
                }
              });
          });
        </script>
    </body>
</html>
