<?php
    include('../univ/baseurl.php');
    session_start();
    if(!isset($_SESSION['pid']))
    { 
      include_once ("../authentication/check.php");
      $_SESSION['afterlogin']="my-posts/";
    }
    function sp_autoloader($class)
    {
      include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    if(isset($_GET['catName'])){

    }else{
        $re = new _redirect;
        $re->redirect($BaseUrl.'/store');
    }
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
        <script type="text/javascript">
            $(document).ready(function(){
                $('#itemslider').carousel({ interval: 3000 });
                $('.carousel-showmanymoveone .item').each(function(){
                  var itemToClone = $(this);
                for (var i=1;i<3;i++) {
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
                        <?php
                            include('../component/left-store.php');
                        ?>
                    </div>
                    <div class="col-md-10">
                        
                        
                        <div class="retail_level_two m_btm_10 banner_btn" id="top_page_heading">
                            <div class="row">
                                <div class="col-md-8">
                              		<?php
                              		if(isset($_GET['gname'])){
                              			$catTitle = $_GET['gname'];
                              		}else{
                              			$catTitle = ucwords(strtolower($categoryTitle));
                              		}
                              		?>
                                    <h3><?php echo $storeTitle." (".$catTitle.")";?></h3>
                                </div>
                                <div class="col-md-4">
                                    <a href="<?php echo $BaseUrl.'/my-store/products.php?view=all';?>" class="btn btn_st_dash" >My Account</a>
                                    <a href="<?php echo $BaseUrl?>/post-ad/sell/?post" class="btn btn_st_post text-right">Sell</a>

                                    
                                </div>
                            </div>
                        </div>
                        <?php include('searchform.php');?>
                        <div class="breadcrumb_box m_btm_10 row no-margin">
                            <div class="col-md-8 no-padding">
                                <ol class="breadcrumb" >
                                    <li class="breadcrumb-item"><a href="<?php echo $BaseUrl;?>/">Home</a></li>
                                    <?php
                                    if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                                        $storeTitle = "My Store";
                                        echo '<li class="breadcrumb-item"><a href="'.$BaseUrl.'/'.$folder.'">'.$storeTitle.'</a></li>';
                                    }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){

                                        echo '<li class="breadcrumb-item"><a href="'.$BaseUrl.'/'.$folder.'">'.$storeTitle.'</a></li>';
                                    }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 5){

                                        echo '<li class="breadcrumb-item"><a href="'.$BaseUrl.'/'.$folder.'">'.$storeTitle.'</a></li>';
                                    }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 99){

                                        echo '<li class="breadcrumb-item"><a href="'.$BaseUrl.'/'.$folder.'">'.$storeTitle.'</a></li>';
                                    }else if(isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2){
                                        
                                        echo '<li class="breadcrumb-item"><a href="'.$BaseUrl.'/'.$folder.'">'.$storeTitle.'</a></li>';
                                    }else{
                                        $storeTitle = "Public Store";
                                        echo '<li class="breadcrumb-item"><a href="'.$BaseUrl.'/'.$folder.'">'.$storeTitle.'</a></li>';
                                    } 

                                    if(isset($gname)){
                                        $fieldValue = str_replace('_', ' ', $_GET['gname']);
                                        $groupTitle = str_replace('-', '&', $fieldValue);
                                        
                                        echo '<li class="breadcrumb-item active">'.$groupTitle.'</li>';
                                    }else{
                                        echo '<li class="breadcrumb-item active">'.$categoryTitle.'</li>';
                                    }?>
                                                                
                                </ol>
                            </div>

                            <div class="col-md-4 text-right right_link" >
                                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php';?>" class="btn btn-default">All Listings</a>
                                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?type=auction';?>" class=" btn btn-default">Auction</a>
                                <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?type=buypost';?>" class=" btn btn-default">Buy It Now</a>
                            </div>
                        </div>
                        
                            
                        <div class="row no-margin ">
                            <div class="heading03">
                                <h3><?php echo (isset($categoryTitle))?$categoryTitle : $groupTitle;?></h3>
                            </div>
                            <?php

                            //$ca = new _categories
                            $p = new _postingview;
                            if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                                //my store
                                $result3 = $p->single_my_post($categoryTitle, $_SESSION['uid']);
                            }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
                                //friends store
                                $result3 = $p->single_store_friends_Posting($categoryTitle, $_SESSION['uid']);
                            }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 5){
                                //if group selected then show this one
                                if(isset($_GET['gid']) && $_GET['gid'] > 0){
                                    $result3 = $p->single_group_Store($_GET['gid']);
                                    //$result3 = $p->single_group_main_Posting($categoryTitle, $_SESSION['pid']);
                                }else{
                                    $result3 = $p->single_group_main_Posting($categoryTitle, $_SESSION['pid']);   
                                }
                                
                            }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 99){
                                //wholesale store
                                $result3 = $p->single_wholesale($categoryTitle, $_SESSION['pid']);
                            }else if(isset($_GET["spPostingsFlag"]) && $_GET["spPostingsFlag"] == 2){
                                //retail store
                                $result3 = $p->single_retail_store($categoryTitle);
                            }else{
                                //public store
                                $result3 = $p->single_publicpost($categoryTitle);
                            }
                            
                            //echo $p->ta->sql;
                            if ($result3 != false) {
                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                    $dt = new DateTime($row3['spPostingDate']);
                                    if(isset($_GET['gname'])){
                                        $fieldValue = str_replace(' ', '_', $_GET['gname']);
                                        $FinalTitle = str_replace('&', '-', $fieldValue);
                                        $linkFinal = "gid=".$_GET['gid']."&grpName=".$FinalTitle;
                                    }else{
                                        $fieldValue = str_replace(' ', '_', $categoryTitle);
                                        $FinalTitle = str_replace('&', '-', $fieldValue);
                                        $linkFinal = "catName=".$FinalTitle;
                                    }
                                    
                                    ?>
                                    <div class="col-xs-5ths">
                                        <div class="featured_box text-center subcategory_box">

                                            <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&'.$linkFinal.'&postid='.$row3['idspPostings'];?>">
                                                
                                                <?php
                                                $pic = new _postingpic;
                                                $result4 = $pic->read($row3['idspPostings']);
                                                //echo $pic->ta->sql;
                                                if ($row3['idspCategory'] != 5 && $row3['idspCategory'] != 2) {
                                                    if ($result4 != false) {
                                                        if(mysqli_num_rows($result4) > 0){
                                                            $rp = mysqli_fetch_assoc($result4);
                                                            $picture = $rp['spPostingPic'];
                                                            
                                                            echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($picture) . "' >";
                                                        }
                                                    } else{
                                                        echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                                                    }
                                                }else{
                                                    echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>";
                                                }
                                                ?>
                                                
                                            </a>
                                            <?php
                                            if(!empty($row3['spPostingtitle'])){
                                                if(strlen($row3['spPostingtitle']) < 15){
                                                    ?><h4><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&'.$linkFinal.'&postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $row3['spPostingtitle']; ?>"><?php echo ucwords(strtolower($row3['spPostingtitle'])); ?></a></h4><?php
                                                    
                                                }else{
                                                    ?><h4><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&'.$linkFinal.'&postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $row3['spPostingtitle']; ?>"><?php echo substr(ucwords(strtolower($row3['spPostingtitle'])), 0,15).'...'; ?></a></h4><?php
                                                }
                                            }else{
                                                echo "<h4>&nbsp;</h4>";
                                            } ?>
                                            <h5 >
                                                <?php
                                                if ($row3['spPostingPrice'] != false) {
                                                    echo "<div class='postprice' style='display: inline-block;' data-price='" . $row3['spPostingPrice'] . "'>$" . $row3['spPostingPrice'] . "</div><span class='" . ($row3['idspCategory'] == 5 || $row3['idspCategory'] == 18 || $row3['idspCategory'] == 9 || $row3['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                                                }else{
                                                    echo "Expires on ".$row3['spPostingExpDt'];
                                                }
                                                  ?>
                                            </h5>
                                            <h6 class="name"><a href="<?php echo $BaseUrl.'/store/user-product.php?userid='.$row3['idspProfiles']?>"><?php echo ucwords(strtolower($row3['spProfileName']));?></a></h6>
                                            
                                            <p class="date"><?php echo $dt->format('d M Y'); ?> | <?php echo $dt->format('H:i a'); ?></p>
                                        </div>
                                    </div>
                                    <?php
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
