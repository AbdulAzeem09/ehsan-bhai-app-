<?php
    include('../univ/baseurl.php');
    session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "trainings/";
    include_once ("../authentication/check.php");
    
}else{
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryID"] = "8";
    $_GET["categoryName"] = "Trainings";
    $header_train = "header_train";

$artistId = isset($_GET['intructor']) ? (int) $_GET['intructor'] : 0;

    if ($artistId > 0) {
        $p = new _spprofiles;
        //$artistId = $_GET['intructor'];
        $pres2 = $p->readUserId($artistId);
        //echo $p->ta->sql;
        if($pres2 != false){
            $row2 = mysqli_fetch_assoc($pres2);
			//print_r($row2);
			//die('=======');
            $artistName = $row2['spProfileName'];
            $picture    = $row2['spProfilePic'];
            $about      = $row2['spProfileAbout'];
            $email      = $row2['spProfileEmail'];
            $phone      = $row2['spProfilePhone'];
            $longitude      = $row2['longitude'];

            $po = new _postings;
            $res = $po->read_training_pid($artistId);
            
            if($res != false){
                $TotalSOng = $res->num_rows;
            }else{
                $TotalSOng = 0;
            }
        }
    }else{
        $re = new _redirect;
        $redirctUrl = "../trainings";
        $re->redirect($redirctUrl);
    }


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
            <div class="container">
                <div class="row no-margin">
                    <div class="col-md-12 no-padding">
                        <div class="fulmainarttab">
                            <ul class='nav nav-tabs' id='navtabVdo' >
                                <li><a href="<?php echo $BaseUrl.'/trainings';?>">Home</a></li>
                                <li><a href="<?php echo $BaseUrl.'/trainings/instructor.php';?>">Instructors</a></li>  
                                <li role="presentation" class="active"><a href="#video1" aria-controls="home" role="tab" data-toggle="tab"><?php echo ucwords($artistName); ?></a></li> 
                                
                                                    
                            </ul>
                            <div class="linebtm"></div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="top_detail_train">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <h2><?php echo ucwords($artistName); ?></h2>
                       <br>
                        <p>
                            Total Courses 
                            <?php echo $TotalSOng; ?>
                            &nbsp;&nbsp;&nbsp;
                            <!-- <i class="fa fa-user"></i> Total Students 0 -->
                        </p>
                    </div>
					<div class="col-md-5">
                        
                        <p class="text-justify">Email :  <?php echo $email; ?></p>
                        <p class="text-justify">Phone No. :  <?php echo $phone; ?></p>
                        <p class="text-justify">Longitude :  <?php echo $longitude; ?></p>
                        <p class="text-justify">About :  <?php echo $about; ?></p>
                        
                    </div>
					
                    <div class="col-md-3">
                        <div class="right_head_box" style="min-height: 200px;">
                            <img id="profilepicture" alt="Profile Pic" class="img-responsive" src="<?php echo ((isset($picture))?" ". ($picture)."":"../assets/images/blank-img/no-store.png");?>" style="height: 200px;width: 100%;" > 
                            

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="space-lg"></div>
        <div class="space-lg"></div>
        <section>
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <h3>All Courses</h3>
                    </div>
                    <?php
                        
                        $res = $po->read_training_pid($artistId);
                        //$res = $p->publicpost_music($limit, $_GET["categoryID"], $orderBy);
                        //echo $p->ta->sql;
                        if($res){
                            while ($row = mysqli_fetch_assoc($res)) { 
								//print_r($row);?>
                                <div class="col-xs-5ths">
                                    <div class="course_Box">
                                        <div class="img_fe_box">
                                            <a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$row['id'];?>">
                                                <?php
                                                    $pic = new _postings;
                                                    $res2 = $pic->read_cover_images($row['id']);
                                                    //echo $pic->ta->sql;
                                                    if($res2 != false){                                                
                                                        $rp = mysqli_fetch_assoc($res2);
                                                        $pic2 = $rp['filename'];
                                                        echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " .$BaseUrl.'/post-ad/uploads/'. ($pic2) . "' >"; 
                                                        
                                                    }else{
                                                        echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive blank'>";
                                                    }
                                                ?>
                                            </a>
                                        </div>
                                        <div class="innerBoxvdo">
                                            <a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$row['id'];?>" class="title" data-toggle="tooltip" title="<?php echo $row['spPostingTitle'];?>" style="font-size:17px;" >
                                                <?php 
                                                if(strlen($row['spPostingTitle']) < 12){
                                                    echo $row['spPostingTitle'];
                                                }else{
                                                    echo substr($row['spPostingTitle'], 0,12)."...";
                                                } 
                                                ?>     
                                            </a>
                                            <?php
                                            $p = new _spprofiles;
                                            $pres1 = $p->readUserId($row['idspProfiles']);
                                            if($pres1 != false){
                                                $prow = mysqli_fetch_assoc($pres1);
                                                ?>
                                                <a href="javascript:void(0)" class="name"><?php echo $prow['spProfileName']; ?></a>
                                                <?php
                                            
                                            }
                                            ?>
                                           <!-- <a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$row['idspPostings'];?>" class="btn butn_train_cart">Add To Cart</a>-->
                                            <p><?php echo ($row['spPostingPrice'] > 0)?$row['default_currency'].' '.$row['spPostingPrice']:'Free';?></p>
                                        </div>
                                    </div>
                                </div> <?php
                            }
                        }
                        ?>
                </div>
            </div>
        </section>


        
        <div class="space-lg"></div>

        <?php 
        include('../component/f_footer.php');
        include('../component/btm_script.php'); 
        ?>
    </body>
</html>
<?php
}
?>
