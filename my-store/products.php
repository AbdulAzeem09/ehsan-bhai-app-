<?php
	include('../univ/baseurl.php');
    session_start();
    $_GET["mystore"] = "6";
    $folderName = "my-store";
    
    if(!isset($_SESSION['pid'])){ 
        include_once ("../authentication/check.php");
        $_SESSION['afterlogin']="my-posts/";
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
                    var url = "view-all.php?catName=" + $(this).val(); // get selected value
                    if (url) { // require a URL
                        window.location = url; // redirect
                    }
                    return false;
                });
                //dynamic price
                $('#dynamic_price').on('change', function () {
                    var url = "view-all.php?orderby=" + $(this).val(); // get selected value
                    if (url) { // require a URL
                        window.location = url; // redirect
                    }
                    return false;
                });
            });
        </script>
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
                    <div id="sidebar"  class="col-md-2 no-padding">
                        <?php
                            include('../component/left-store.php');
                        ?>
                    </div>
                    <div class="col-md-10">
                        <div class="retail_level_two m_btm_10 banner_btn" id="top_page_heading">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3>Store: <?php echo $storeTitle;?></h3>
                                </div>
                            </div>
                        </div>
                        
                        <div class="breadcrumb_box m_btm_10">
                            <div class="row no-margin">
                                <div class="col-md-7 no-padding right_link">
                                   
                                    <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php';?>" class="btn btn-default">All Listings</a>
                                    <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?type=auction';?>" class=" btn btn-default">Auction</a>
                                    <a href="<?php echo $BaseUrl.'/'.$folder.'/view-all.php?type=buypost';?>" class=" btn btn-default">Buy It Now</a>
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
                                        $pr = new _spprofilehasprofile;
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
                                        <a href="<?php echo $BaseUrl.'/'.$folder.'/view-list.php';?>"><i class="fa fa-th-list" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <?php include('../store/searchform.php');?>
                            
                        <div class="row no-margin ">
                            <div class="heading03">
                                <h3><?php 
                                if(isset($_GET['catName'])){
                                    echo $SelectTitle;
                                }else if(isset($_GET['friendlevel'])){
                                    if($_GET['friendlevel'] == 1){
                                        echo "1st Level Friends Products";
                                    }else if($_GET['friendlevel'] == 2){
                                        echo "2nd Level Friends Products";
                                    }else if($_GET['friendlevel'] == 3){
                                        echo "3rd Level Friends Products";
                                    }else{
                                        header('location:'.$BaseUrl.'/'.$folder);
                                    }
                                    
                                }else{
                                    echo "All Products";
                                }
                                ?></h3>
                            </div>
                            <?php

                            //$ca = new _categories
                            $p = new _postingview;
                            if(isset($_GET['friend']) && $_GET['friend'] >0){
                                //seller store if user wants to show
                                $result3 = $p->singlefriendstore($_GET['friend']);
                            }else if(isset($_GET['type']) && $_GET['type'] !=  ''){

                                $result3 = $p->auction($_GET['type'], $_SESSION['uid']);
                            }else if(isset($_GET['mod']) && $_GET['mod'] !=  ''){
                                //left module vise filter
                                if($_GET['mod'] == 'retail'){
                                    $result3 = $p->retailpost(1);
                                }else if($_GET['mod'] == 'wholesale'){
                                    $result3 = $p->allwholesellpost();
                                }else if($_GET['mod'] == 'manufacturer'){
                                    $result3 = $p->manufacturePost();
                                }else if($_GET['mod'] == 'distributor'){
                                    $result3 = $p->distributorPost();
                                }
                                else if($_GET['mod'] == 'personal'){
                                    $result3 = $p->personalSalePost();
                                }
                                
                            }else{
                                if(isset($_GET['friendlevel']) && $_GET['friendlevel'] > 0){
                                    
                                    if($_GET['friendlevel'] == 1){
                                        $result5 = $pr->frndLevelone($_SESSION['pid']);
                                        $levelpass = "1st Degree";
                                    }else if($_GET['friendlevel'] == 2){
                                        $result5 = $pr->frndLevelScnd($_SESSION['pid']);
                                        $levelpass = "2nd Degree";
                                    }else if($_GET['friendlevel'] == 3){
                                        $result5 = $pr->frndLevelThird($_SESSION['pid']);
                                        $levelpass = "3rd Degree";
                                    }

                                    if($result5){
                                        foreach ($result5 as $key => $value5) {
                                            if($_SESSION['pid'] != $value5){
                                                friendlevel($value5, $BaseUrl, $folder, $levelpass);
                                            }
                                            
                                        }
                                    }
                                }else if(isset($_GET['mystore']) && $_GET['mystore'] == 6){
                                  //my store
                                    if(isset($_GET['catName'])){
                                        $result3 = $p->single_my_post($SelectTitle, $_SESSION['uid']);
                                    }else if(isset($_GET['orderby'])){
                                        $result3 = $p->myall_store_order_by($_SESSION['uid'], $_GET['orderby']);
                                    }else if(isset($_GET['condition'])){
                                        $result3 = $p->myall_store_condition($_SESSION['uid'], $_GET['condition']);
                                    }else if(isset($_POST['btnPriceRange'])){
                                        $txtStartPrice = $_POST['txtStartPrice'];
                                        $txtEndPrice = $_POST['txtEndPrice'];

                                        $result3 = $p->myall_store_prange($_SESSION['uid'], $txtStartPrice, $txtEndPrice);
                                    }else if(isset($_GET['country'])){
                                        $result3 = $p->myall_store_country($_SESSION['uid'], $_GET['country']);
                                    }else{
                                    	//show for my products all , active, inactive
                                        //$result3 = $p->myall_store($_SESSION['pid']);
                                        if(isset($_GET['view']) && $_GET['view'] == 'all'){
                                        	$result3 = $p->myStoreProduct($_SESSION['pid']);
                                        }else if(isset($_GET['view']) && $_GET['view'] == 'active'){
                                        	$result3 = $p->myStoreProduct_Active($_SESSION['pid']);
                                        }else if(isset($_GET['view']) && $_GET['view'] == 'inactive'){
                                        	$result3 = $p->myStoreProduct_Inactive($_SESSION['pid']);
                                        }
                                        
                                    }
                                  
                                }else if(isset($_GET["mystore"]) && $_GET["mystore"] == 4){
                                    //friend store
                                    if(isset($_GET['catName'])){
                                        $result3 = $p->single_store_friends_Posting($SelectTitle, $_SESSION['uid']);
                                    }else if(isset($_GET['orderby'])){
                                        $result3 = $p->store_friends_Posting_order_by($_SESSION['uid'], $_GET['orderby']);
                                    }else if(isset($_GET['condition'])){
                                        $result3 = $p->store_friends_Posting_condition($_SESSION['uid'], $_GET['condition']);
                                    }else if(isset($_POST['btnPriceRange'])){
                                        $txtStartPrice = $_POST['txtStartPrice'];
                                        $txtEndPrice = $_POST['txtEndPrice'];

                                        $result3 = $p->store_friends_Posting_prange($_SESSION['uid'], $txtStartPrice, $txtEndPrice);
                                    }else if(isset($_GET['country'])){
                                        $result3 = $p->store_friends_Posting_country($_SESSION['uid'], $_GET['country']);
                                    }else{
                                        $result3 = $p->store_friends_Posting($_SESSION['uid']);
                                    }
                                  
                                }else if(isset($_GET['mystore']) && $_GET['mystore'] == 5){
                                    //group post
                                    if(isset($_GET['catName'])){
                                        $result3 = $p->single_group_main_Posting($SelectTitle, $_SESSION['pid']); 
                                    }else if(isset($_GET['orderby'])){
                                        $result3 = $p->all_group_store_order_by($_SESSION['pid'], $_GET['orderby']);
                                    }else if(isset($_GET['condition'])){
                                        $result3 = $p->all_group_store_condition($_SESSION['pid'], $_GET['condition']);
                                    }else if(isset($_POST['btnPriceRange'])){
                                        $txtStartPrice = $_POST['txtStartPrice'];
                                        $txtEndPrice = $_POST['txtEndPrice'];

                                        $result3 = $p->all_group_store_prange($_SESSION['pid'], $txtStartPrice, $txtEndPrice);
                                    }else if(isset($_GET['country'])){
                                        $result3 = $p->all_group_store_country($_SESSION['pid'], $_GET['country']);
                                    }else{
                                        $result3 = $p->all_group_store($_SESSION['pid']);
                                    }
                                  
                                }else if(isset($_GET['spPostingsFlag']) && $_GET['spPostingsFlag'] == 2){
                                    //retail store
                                    if(isset($_GET['catName'])){
                                        $result3 = $p->single_retail_store($SelectTitle);
                                    }else if(isset($_GET['orderby'])){
                                        $result3 = $p->retailpost_order_by($_GET['orderby']);
                                    }else if(isset($_GET['condition'])){
                                        $result3 = $p->retailpost_condition($_GET['condition']);
                                    }else if(isset($_POST['btnPriceRange'])){
                                        $txtStartPrice = $_POST['txtStartPrice'];
                                        $txtEndPrice = $_POST['txtEndPrice'];

                                        $result3 = $p->retailpost_prange($txtStartPrice, $txtEndPrice);
                                    }else if(isset($_GET['country'])){
                                        $result3 = $p->retailpost_country($_GET['country']);
                                    }else{
                                        $result3 = $p->retailpost(1);
                                    }
                                    
                                }else{
                                    //public store
                                    if(isset($_GET['catName'])){
                                        $result3 = $p->single_publicpost($SelectTitle);
                                    }else if(isset($_GET['orderby'])){
                                        $result3 = $p->publicpost_price($_GET['orderby']);
                                    }else if(isset($_GET['condition'])){
                                        $result3 = $p->publicpost_condition($_GET['condition']);
                                    }else if(isset($_POST['btnPriceRange'])){
                                        $txtStartPrice = $_POST['txtStartPrice'];
                                        $txtEndPrice = $_POST['txtEndPrice'];

                                        $result3 = $p->publicpost_prange($txtStartPrice, $txtEndPrice);
                                    }else if(isset($_GET['country'])){
                                        $result3 = $p->publicpost_country($_GET['country']);
                                    }else{
                                        $result3 = $p->publicpost(isset($start), 1);
                                    }
                                }
                            }
                            function friendlevel($value, $BaseUrl, $folder, $levelpass){
                                $p = new _postingview;
                                //$result3 = $p->store_friends_Posting($value);
                                $result3 = $p->singlefriendstore($value);
                                //echo $p->ta->sql;
                                if ($result3 != false) {
                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                        $dt = new DateTime($row3['spPostingDate']);
                                        
                                        
                                        ?>
                                        <div class="col-xs-5ths">
                                            <div class="featured_box text-center subcategory_box">

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
                                                <?php
                                                if(!empty($row3['spPostingtitle'])){
                                                    if(strlen($row3['spPostingtitle']) < 15){
                                                        ?><h4><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $row3['spPostingtitle']; ?>"><?php echo ucwords(strtolower($row3['spPostingtitle'])); ?></a></h4><?php
                                                        
                                                    }else{
                                                        ?><h4><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $row3['spPostingtitle']; ?>"><?php echo substr(ucwords(strtolower($row3['spPostingtitle'])), 0,15).'...'; ?></a></h4><?php
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
                                                <h6 class="name"><?php echo ucwords(strtolower($row3['spProfileName']));?></h6>
                                                <span><?php echo $levelpass;?></span>
                                                <p class="date"><?php echo $dt->format('d M Y'); ?> | <?php echo $dt->format('H:i a'); ?></p>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                }
                            }
                            //echo $p->ta->sql;
                            if ($result3) {
                                while ($row3 = mysqli_fetch_assoc($result3)) {
                                    $dt = new DateTime($row3['spPostingDate']);                                    
                                    ?>
                                    <div class="col-xs-5ths">
                                        <div class="featured_box text-center subcategory_box">

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
                                            <?php
                                            if($_SESSION['pid'] != $rows['idspProfiles']){
                                        
                                                $result6 = $pr->frndLeevel($_SESSION['pid'], $row3['idspProfiles']);
                                                //echo $pr->ta->sql;
                                                //echo $result3;
                                                if($result6 == 0){
                                                  $level = '1st Degree';
                                                }else if($result6 == 1){
                                                  $level = '1st Degree';
                                                }else if($result6 == 2){
                                                  $level = '2nd Degree';
                                                }else if($result6 == 3){
                                                  $level = '3rd Degree';
                                                }else{
                                                  $level = 'Not Define';
                                                }
                                            }else{
                                                $level = '1st Degree';
                                            }
                                            if(!empty($row3['spPostingtitle'])){
                                                if(strlen($row3['spPostingtitle']) < 15){
                                                    ?><h4><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $row3['spPostingtitle']; ?>"><?php echo ucwords(strtolower($row3['spPostingtitle'])); ?></a></h4><?php
                                                    
                                                }else{
                                                    ?><h4><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $row3['spPostingtitle']; ?>"><?php echo substr(ucwords(strtolower($row3['spPostingtitle'])), 0,15).'...'; ?></a></h4><?php
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
                                            <h6 class="name"><?php echo ucwords(strtolower($row3['spProfileName']));?></h6>
                                            <span><?php echo $level;?></span>
                                            <p class="date"><?php echo $dt->format('d M Y'); ?> | <?php echo $dt->format('H:i a'); ?></p>
                                        </div>
                                    </div>
                                    <?php
                                }
                            } ?>

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

