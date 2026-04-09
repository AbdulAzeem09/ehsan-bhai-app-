<?php
    include('../univ/baseurl.php');
    session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "services/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "7";
    $_GET["categoryName"] = "Services";
    $header_servic = "header_servic";
    
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
    </head>

    <body class="bg_gray">
         <?php
        include_once("../header.php");
        ?>
        
        <section>
            <div class="row no-margin">
                <div class="col-md-2 no-padding">
                    <?php 
                    include('../component/left-services.php');
                    ?>
                </div>
                <div class="col-md-10 no-padding">
                    <div class="head_right_enter">
                        <div class="row no-margin">
                            <?php
                            include('top-head-inner.php');
                            ?>
                            <div class="col-sm-12 no-padding">
                                <div class="tab-content no-radius otherTimleineBody m_top_20" style="padding: 0px 20px;">
                                    <!--PopularArt-->
                                    <div role="tabpanel" class="tab-pane active" id="video1">
                                        <div class="row">
                                            <div class="col-sm-12 topServBread">
                                                <nav aria-label="breadcrumb">
                                                    <ol class="breadcrumb">
                                                        <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/services';?>"><i class="fa fa-home"></i></a></li>
                                                        <?php
                                                        $ac = new _artCategory;
                                                        if(isset($_GET['catName'])){
                                                            ?>
                                                            <li class="breadcrumb-item active" aria-current="page"><?php echo $_GET['catName'];?></li><?php
                                                            
                                                        }else{ ?>
                                                            <li class="breadcrumb-item active" aria-current="page">Services</li> <?php
                                                        }
                                                        ?>
                                                    </ol>
                                                </nav>
                                            </div>
                                        </div>
                                        <?php include('search-form.php');?>
                                        <div class="bg_white" style="padding: 20px;">
                                            <div class="row ">
                                                <p><strong>Search Results For: </strong><?php if (isset($_POST['txtSearchBox'])) {
                                                   echo  $_POST['txtSearchBox'];
                                                   echo ' ,';
                                                }

                                                if (isset($_POST['spUserCity'])) {
															
	                                              $_SESSION['spPostCity'] =  $_POST['spUserCity'];
                                                    $ci  = new _city;
                                                    $result4 = $ci->readCityName($_POST['spUserCity']);
                                                    //echo $ci->ta->sql;
                                                    if($result4 != false){
                                                        $row4 = mysqli_fetch_assoc($result4);
                                                        $cityTitle = $row4['city_title'];
                                                        echo $cityTitle; echo ' ,';
                                                    }else{
                                                        $cityTitle = "";
                                                    }
                                                }

                                                 if (isset($_POST['spPostingsState'])) {
													 
													 $_SESSION['spPostState'] =$_POST['spPostingsState'];
                                                    $st  = new _state;
                                                    $result2 = $st->readStateName($_POST['spPostingsState']);
                                                    if($result2 != false){
                                                        $row2 = mysqli_fetch_assoc($result2);
                                                        $stateTitle = $row2['state_title'];
                                                        echo $stateTitle;
                                                    }else{
                                                        $stateTitle = "";
                                                    } 
                                                 }
                                                 ?></p>
                                                <?php

                                                $start = 0;
                                                $limit = 1;
                                                $orderBy = "DESC";
                                                $cf  = new _classified;
                                                $p = new _postingview;
                                                $pf  = new _postfield;
                                                $ud= new _spuser;

                                                $user_data=$ud->read($_SESSION['uid']);
                                                    $u_data = mysqli_fetch_assoc($user_data);
                                                    $u_country=$u_data['spUserCountry'];
                                                    $u_state=$u_data['spUserState'];
                                                    $u_city=$u_data['spUserCity'];
                                                    $txtSearchBox = $_POST['txtSearchBox'];
                                                if (isset($_POST['btnSearch'])) {
                                                    if (isset($_POST['txtSearchBox']) && $_POST['txtSearchBox'] != '') {
                                                        $res = $cf->search($_POST["txtSearchBox"],$_GET["categoryID"],$u_country,$u_state, $orderBy);
                                                    }else if (isset($_POST['spPostingsState']) && $_POST['spUserCity'] == '' || $_POST['spUserCity'] == 'Select City') {
                                                        $state = $_POST['spPostingsState'];
                                                        $res = $cf->findByState($_GET["categoryID"],$state);
                                                    }elseif (isset($_POST['spPostingsState']) && $_POST['spUserCity'] != 'Select City'){
                                                        $state = $_POST['spPostingsState'];
                                                        $city = $_POST['spUserCity'];
                                                        $res = $cf->findByStateCity($_GET["categoryID"],$state,$city);  
                                                    }
                                                    
                                                }else{
                                                    $res = $p->publicpost($start, $_GET["categoryID"]);
                                                }
                                                
                                                //echo $p->ta->sql;
                                                if($res != false){
                                                    while ($row = mysqli_fetch_assoc($res)) {
                                                        $result_pf = $pf->read($row['idspPostings']);
                                                        //echo $pf->ta->sql."<br>";
                                                        if($result_pf){
                                                            $sercom = "";
                                                            
                                                            while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                                                if($sercom == ''){
                                                                    if($row2['spPostFieldName'] == 'spPostSelection_'){
                                                                        $sercom = $row2['spPostFieldValue'];
                                                                    }
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                        <div class="col-md-3">
                                                            <div class="ser_box_1">
                                                                <!-- <a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>">
                                                                    <?php
                                                                    $pic = new _postingpic;
                                                                    $res2 = $pic->read($row['idspPostings']);
                                                                    if ($res2 != false) {
                                                                        $rp = mysqli_fetch_assoc($res2);
                                                                        $pic2 = $rp['spPostingPic'];
                                                                        echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
                                                                        <?php
                                                                    } else{
                                                                        echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; ?>
                                                                        <?php
                                                                    } ?>
                                                                </a>
                                                                <a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>" class="title">
                                                                   <?php 
                                                                    if(strlen($row['spPostingtitle']) < 15){
                                                                        echo ucwords(strtolower($row['spPostingtitle']));
                                                                    }else{
                                                                        echo substr(ucwords(strtolower($row['spPostingtitle'])), 0,15)."...";
                                                                    } 
                                                                    ?>          
                                                                </a>
                                                                <span class="views"><?php echo (isset($sercom) && $sercom != '')?$sercom:'&nbsp;'; ?></span>
                                                                <span class="expiry">Expires on <?php echo $row['spPostingExpDt'];?></span>
                                                                <a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>" class="btn ">View Detail</a> -->
                                                                <a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>">
                                                                        <?php
                                                                        $pic = new _classifiedpic;
                                                                        $res2 = $pic->readFeature($row['idspPostings']);
                                                                        if ($res2 != false) {
                                                                            $rp = mysqli_fetch_assoc($res2);
                                                                            $pic2 = $rp['spPostingPic'];
                                                                            echo "<img alt='Posting Pic' class='img-responsive' src=' " . ($pic2) . "' >"; ?>
                                                                            <?php
                                                                        } else{
                                                                            echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive'>"; ?>
                                                                            <?php
                                                                        } ?>
                                                                    </a>
                                                                      
                                                                    <a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>" class="title">
                                                                       <?php
                                                                        $in =  $row['spPostingTitle'];
                                                                         $out = strlen($in) > 15 ? substr($in,0,15)."..." :$in;
                                                                        echo $out; ?>  
                                                                            
                                                                    </a>
                                                                    
                                                                    
                                                                    <span class="views"><?php echo (isset($sercom) && $sercom != '')?$sercom:'&nbsp;'; ?></span>
                                                                    <span class="expiry">Expires on <?php echo $row['spPostingExpDt'];?></span>
                                                                    <a href="<?php echo $BaseUrl.'/services/detail.php?postid='.$row['idspPostings'];?>" class="btn ">View Detail</a>
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                }else{
                                                    echo "<h4 style='text-align: center;'>Your searched words did not produce any results, please search with different keywords.</h4>";
                                                }

                                                ?>
                                            </div>
                                        </div>

                                        
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>

                </div>
            </div>
        </section>
        <div class="space-lg"></div>

        <?php 
        include('postshare.php');
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
        <!-- notification js -->
        <script src='<?php echo $BaseUrl.'/assets/';?>js/bootstrap-notify.min.js'></script>
	</body>
</html>
<?php
} ?>