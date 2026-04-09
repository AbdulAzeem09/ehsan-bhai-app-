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
        <script>
            $(function(){
                // bind change event to select
                $('#dynamic_select').on('change', function () {
                    var url = "view-list.php?catName=" + $(this).val(); // get selected value
                    if (url) { // require a URL
                        window.location = url; // redirect
                    }
                    return false;
                });
                //dynamic price
                $('#dynamic_price').on('change', function () {
                    var url = "view-list.php?orderby=" + $(this).val(); // get selected value
                    if (url) { // require a URL
                        window.location = url; // redirect
                    }
                    return false;
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
                        <?php 
                        include('top-dashboard.php');
                        include('searchform.php');
                        
                        ?>
                        
                        
                        
                        <div class="breadcrumb_box m_btm_10">
                            <div class="row no-margin">
                                <div class="col-md-7 no-padding">
                                    <ol class="breadcrumb">
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
                                        ?>
                                        <li class="breadcrumb-item active">All Products</li>
                                        
                                    </ol>
                                </div>

                                <div class="col-md-5 no-padding" >
                                    <div class="" style="display: inline;">
                                        <select class="form-control pull-right no-radius" id="dynamic_price" style="width: 100px;display: inline;margin-left: 5px;">
                                            <option>Price</option>
                                            <option value="Asc" <?php if(isset($_GET['orderby'])){ echo ($_GET['orderby'] == 'Asc')?'selected': '';} ?> >Asc</option>
                                            <option value="Desc" <?php if(isset($_GET['orderby'])){ echo ($_GET['orderby'] == 'Desc')?'selected': '';} ?> >Desc</option>
                                        </select>
                                    </div>
                                    <div class="" style="display: inline">
                                        <?php
                                        if(isset($_GET['catName'])){
                                            $selectValue = str_replace('_', ' ', $_GET['catName']);
                                            $SelectTitle = str_replace('-', '&', $selectValue);
                                            
                                        }
                                        $p = new _postfield;
                                        $catid = 1;
                                        $result2 = $p->readlabel($catid);
                                        //echo $p->ta->sql;
                                        if ($result2 != false){
                                            $catCount = 0;
                                            while($row2 = mysqli_fetch_assoc($result2)){
                                                if($row2['spPostFieldLabel'] == 'Subcategory'){
                                                    if($catCount == 0){
                                                        ?>
                                                        <select class="form-control pull-right no-radius" id="dynamic_select" style="width: 150px;">
                                                            <option value="">Select Category</option><?php
                                                            $values = $p->readvalues($catid, $row2['spPostFieldLabel']);
                                                          
                                                            if($values != false){
                                                                while($vals = mysqli_fetch_assoc($values)){
                                                                    $fieldValue = str_replace(' ', '_', $vals["spPostFieldValue"]);
                                                                    $FinalTitle = str_replace('&', '-', $fieldValue);
                                                                  ?>
                                                                  <option value="<?php echo $FinalTitle;?>" <?php if(isset($SelectTitle)){ echo ($SelectTitle == $vals["spPostFieldValue"])?'selected': '';}?>  ><?php echo $vals["spPostFieldValue"];?></option>
                                                                  <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                        <?php
                                                    }
                                                }
                                            }
                                        }  ?>
                                    </div>
                                    <div class="listingview pull-right" style="display: inline">
                                        <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php';?>"><i class="fa fa-th" aria-hidden="true"></i></a>
                                        <a href="<?php echo $BaseUrl.'/'.$folder.'/view-list.php';?>" class="active" ><i class="fa fa-th-list" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row no-margin">
                            <div class="heading03">
                                <h3><?php 
                                if(isset($_GET['catName'])){
                                    echo $SelectTitle;
                                }else{
                                    echo "All Products";
                                }
                                ?></h3>
                            </div>
                        </div>
                        <div class="row no-margin bg_white " style="padding: 5px 0px;border: 1px solid #c7c7c7;">
                            
                            <?php

                            //$ca = new _categories
                            $p = new _postingview;
                            if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                              //my store
                                if(isset($_GET['catName'])){
                                    $result3 = $p->single_my_post($SelectTitle, $_SESSION['uid']);
                                }else if(isset($_GET['orderby'])){
                                    $result3 = $p->myall_store_order_by($_SESSION['uid'], $_GET['orderby']);
                                }else{
                                    $result3 = $p->myall_store($_SESSION['uid']);
                                }
                              
                            }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
                              //friend store
                                if(isset($_GET['catName'])){
                                    $result3 = $p->single_store_friends_Posting($SelectTitle, $_SESSION['uid']);
                                }else if(isset($_GET['orderby'])){
                                    $result3 = $p->store_friends_Posting_order_by($_SESSION['uid'], $_GET['orderby']);
                                }else{
                                    $result3 = $p->store_friends_Posting($_SESSION['uid']);
                                }
                              
                            }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
                                //group post
                                if(isset($_GET['catName'])){
                                    $result3 = $p->single_group_main_Posting($SelectTitle, $_SESSION['pid']); 
                                }else if(isset($_GET['orderby'])){
                                    $result3 = $p->all_group_store_order_by($_SESSION['pid'], $_GET['orderby']);
                                }else{
                                    $result3 = $p->all_group_store($_SESSION['pid']);
                                }
                              
                            }else if(isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2){
                                //retail store
                                if(isset($_GET['catName'])){
                                    $result3 = $p->single_retail_store($SelectTitle);
                                }else if(isset($_GET['orderby'])){
                                    $result3 = $p->retailpost_order_by($_GET['orderby']);
                                }else{
                                    $result3 = $p->retailpost(1);
                                }
                                
                            }else{
                                //public store
                                if(isset($_GET['catName'])){
                                    $result3 = $p->single_publicpost($SelectTitle);
                                }else if(isset($_GET['orderby'])){
                                    $result3 = $p->publicpost_price($_GET['orderby']);
                                }else{
                                    $result3 = $p->publicpost(isset($start), 1);
                                }
                            }
                            
                            //echo $p->ta->sql;
                            if ($result3 != false) {
                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                    $dt = new DateTime($row3['spPostingDate']);                                    
                                    ?>
                                    <div class="col-md-12 no-padding">
                                        <div class="grid_view_store">
                                            <div class="row no-margin">
                                                <div class="col-md-2 no-padding">
                                                    <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>">
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
                                                </div>
                                                <div class="col-md-10">
                                                    <h4>
                                                        <?php
                                                        if(!empty($row3['spPostingtitle'])){
                                                            ?>
                                                            <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $row3['spPostingtitle']; ?>"><?php echo ucwords(strtolower($row3['spPostingtitle'])); ?></a><?php
                                                        }else{
                                                            echo "&nbsp;";
                                                        } ?>
                                                        <span class="pull-right">
                                                            <?php
                                                            if ($row3['spPostingPrice'] != false) {
                                                                echo "<div class='postprice' style='display: inline-block;' data-price='" . $row3['spPostingPrice'] . "'>$" . $row3['spPostingPrice'] . "</div><span class='" . ($row3['idspCategory'] == 5 || $row3['idspCategory'] == 18 || $row3['idspCategory'] == 9 || $row3['idspCategory'] == 3 ? "hidden" : "") . "'></span>";
                                                            }else{
                                                                echo "Expires on ".$row3['spPostingExpDt'];
                                                            }
                                                            ?>
                                                        </span>
                                                    </h4>
                                                    <?php
                                                    $rc = new _country; 
                                                    $result_cntry = $rc->readCountryName($row3['spPostingsCountry']);
                                                    if ($result_cntry) {
                                                        $row4 = mysqli_fetch_assoc($result_cntry);
                                                        $countryName = $row4['country_title'];
                                                    }

                                                    $rcty = new _city;
                                                    $result_cty = $rcty->readCityName($row3['spPostingsCity']);
                                                    if ($result_cty) {
                                                        $row5 = mysqli_fetch_assoc($result_cty);
                                                        $cityName = $row5['city_title'];
                                                    }
                                                    ?>
                                                    
                                                    <p class="city"><?php echo $cityName.', '.$countryName;?> <span class="date pull-right"><?php echo $dt->format('d M Y'); ?> | <?php echo $dt->format('H:i a'); ?></span></p>
                                                    <h6 class="name"><?php echo ucwords(strtolower($row3['spProfileName']));?></h6>  
                                                    <a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>">View Detail</a>                                         
                                                </div>
                                            </div>
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
