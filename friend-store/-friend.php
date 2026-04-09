<?php
    $_GET["mystore"] = "4";
    $folderName = "friend-store";
    //include "../store/index.php";

   // echo $_POST['txtMember'];
    
   	
?>
<?php
    include('../univ/baseurl.php');
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/links.php');?>
        <script src="<?php echo $BaseUrl; ?>/js/jquery-2.1.4.min.js"></script>  
        <script src="<?php echo $BaseUrl; ?>/js/jquery-1.11.4-ui.min.js"></script> 
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
        //this is for store header

        $nameofpost = array();
        $us = new _spprofiles;
        foreach($_POST['txtMember'] as $value){
            //echo $value."<br>";
            $Name = $us->getProfileName($value);
            array_push($nameofpost, $Name);
        }


        $header_store = "header_store";

        include_once("../header.php");
        ?>
        <section class="main_box">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 no-padding">
                        <?php
                            include('../component/left-store.php');
                        ?>
                    </div>
                    <div class="col-md-10">
                        <div class="row no-margin">
                            <div class="col-md-12 no-padding">
                                <div class="top_banner">
                                    <img src="<?php echo $BaseUrl;?>/assets/images/icon/store/category-banner.jpg" class="img-responsive" alt="" />
                                    
                                </div>
                            </div>
                        </div>
                        <?php include('../store/searchform.php');?>
                        <div class="breadcrumb_box m_btm_10">
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
                                <li class="breadcrumb-item active">
                                    <?php
                                    $i= 1;
                                    //print_r($nameofpost);
                                    foreach ($nameofpost as $key => $value) {
                                        if($i == 1){
                                            echo $value;
                                        }else{
                                            echo ", ".$value;
                                        }
                                        
                                        $i++;
                                    }
                                    ?>
                                </li>
                                
                                                            
                            </ol>
                        </div>
                        
                            
                        <div class="row no-margin ">
                            <div class="heading03">
                                <h3>All Products</h3>
                            </div>
                            <?php

                            //$ca = new _categories
                            foreach($_POST['txtMember'] as $value){
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
	                                                    ?><h4><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $row3['spPostingtitle']; ?>"><?php echo $row3['spPostingtitle']; ?></a></h4><?php
	                                                    
	                                                }else{
	                                                    ?><h4><a href="<?php echo $BaseUrl.'/'.$folder.'/detail.php?catid=1&postid='.$row3['idspPostings'];?>" data-toggle="tooltip" title="<?php echo $row3['spPostingtitle']; ?>"><?php echo substr($row3['spPostingtitle'], 0,15).'...'; ?></a></h4><?php
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
	                                            <h6 class="name"><?php echo $row3['spProfileName'];?></h6>
	                                            <p class="date"><?php echo $dt->format('d F'); ?> | <?php echo $dt->format('H:i a'); ?></p>
	                                        </div>
	                                    </div>
	                                    <?php
	                                }
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
        <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
        <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js" type="text/javascript"></script> 
        
    </body>
</html>
