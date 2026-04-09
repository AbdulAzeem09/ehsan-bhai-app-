<?php
    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="real-estate/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "3";
    $_GET["categoryName"] = "Realestate";
    $header_realEstate = "realEstate";

    
    $breadTitle = "Rent Entire Place";
    
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
    </head>

    <body class="bg_gray">
        <?php include_once("../header.php");?>
        <section class="realTopInn">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="text-right">
                           <?php include_once("top-buttons.php");?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="heading07 text-center">
                            <h2><span><?php echo $breadTitle; ?></span></h2>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="agentbreadCrumb text-center">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?php echo $BaseUrl.'/real-estate';?>">Home</a></li>
                                <li class="breadcrumb-item active"><?php echo $breadTitle; ?></li>
                            </ol>
                        </div>
                    </div>
                </div>  
            </div>
        </section>
        <section class="" style="padding: 30px;min-height: 400px;">
            <div class="container">
                
                <div class="row">

                    <?php
                    $start = 0;
                    $limit = 1;
                    
                    $p      = new _postingview;
                    $pf     = new _postfield;
                    $rentTitle = "Rent Entire Place";
                    //$res    = $p->publicpost_event($_GET["categoryID"]);
                    //$res = $p->real_room($_GET["categoryID"]);
                    $res = $p->real_rent_room($_GET['categoryID'], $rentTitle);
                    //echo $p->ta->sql;
                    if($res != false){
                        while ($row = mysqli_fetch_assoc($res)) {
                            //posting fields
                            $result_pf = $pf->read($row['idspPostings']);
                            //echo $pf->ta->sql."<br>";
                            if($result_pf){
                                $address = "";
                                $bedroom = "";
                                $bathroom = "";
                                $sqrfoot = "";
                                $basement = "";
                                $propertyType = "";
                                $roomType = "";
                                
                                while ($row2 = mysqli_fetch_assoc($result_pf)) {
                                    
                                    if($propertyType == ''){
                                        if($row2['spPostFieldName'] == 'spPostingPropertyType_'){
                                            $propertyType = $row2['spPostFieldValue'];
                                        }
                                    }
                                    if($address == ''){
                                        if($row2['spPostFieldName'] == 'spPostingAddress_'){
                                            $address = $row2['spPostFieldValue'];
                                        }
                                    }
                                    if($bedroom == ''){
                                        if($row2['spPostFieldName'] == 'spPostingBedroom_'){
                                            $bedroom = $row2['spPostFieldValue'];
                                        }
                                    }
                                    if($bathroom == ''){
                                        if($row2['spPostFieldName'] == 'spPostingBathroom_'){
                                            $bathroom = $row2['spPostFieldValue'];
                                        }
                                    }
                                    if($sqrfoot == ''){
                                        if($row2['spPostFieldName'] == 'spPostingSqurefoot_'){
                                            $sqrfoot = $row2['spPostFieldValue'];
                                        }
                                    }
                                    if($basement == ''){
                                        if($row2['spPostFieldName'] == 'spPostBasement_'){
                                            $basement = $row2['spPostFieldValue'];
                                        }
                                    }
                                    if($roomType == ''){
                                        if($row2['spPostFieldName'] == 'spRoomRent_'){
                                            $roomType = $row2['spPostFieldValue'];
                                        }
                                    }
                                    
                                }
                                
                            }
                            ?>
                            <div class="col-md-3">
                                <div class="realBox">
                                    <a href="<?php echo $BaseUrl.'/real-estate/room-detail.php?postid='.$row['idspPostings'];?>">
                                        <div class="boxHead">
                                            <h2><?php echo $row['spPostingtitle'];?></h2>
                                            <p>
                                                <i class="fa fa-map-marker"></i> 
                                                <?php
                                                if(strlen($address) < 30){
                                                    echo $address;
                                                }else{
                                                    echo substr($address, 0,30)."...";
                                                }
                                                ?>
                                            </p>
                                        </div>
                                        <?php
                                        $pic = new _postingpic;
                                        
                                        $res2 = $pic->readFeature($row['idspPostings']);
                                        if($res2 != false){
                                            if($res2->num_rows > 0){
                                                if ($res2 != false) {
                                                    $rp = mysqli_fetch_assoc($res2);
                                                    $pic2 = $rp['spPostingPic'];
                                                    echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >"; 
                                                }
                                            }else{
                                                $res2 = $pic->read($row['idspPostings']);
                                                if ($res2 != false) {
                                                    $rp = mysqli_fetch_assoc($res2);
                                                    $pic2 = $rp['spPostingPic'];
                                                    echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >"; 
                                                }
                                            }
                                        }else{
                                            $res2 = $pic->read($row['idspPostings']);
                                            if ($res2 != false) {
                                                $rp = mysqli_fetch_assoc($res2);
                                                $pic2 = $rp['spPostingPic'];
                                                echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " . ($pic2) . "' >"; 
                                            } else{
                                                echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive imgMain'>"; 
                                            }
                                        }?>
                                        
                                        <div class="boxFoot bg_white text-center">
                                            <p class="proType"><?php echo $propertyType;?></p>
                                            <p><span><?php echo $roomType;?></span></p>
                                        </div>
                                    </a>
                                </div>
                            </div> <?php
                        }
                    }
                    ?>
                    
                    

                

                </div>                
            </div>
        </section>
        
        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>

    </body>
</html>
<?php
}
?>