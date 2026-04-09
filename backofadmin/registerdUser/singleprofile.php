<?php

    // error_reporting(E_ALL);
	// ini_set('display_errors', '1');
    if (!defined('WEB_ROOT')) {
        exit;
    }

    if (isset($_GET['uid']) && $_GET['uid'] > 0 && isset($_GET['pid']) && $_GET['pid'] > 0) {
        $uid = $_GET['uid'];
        $pid = $_GET['pid'];
    }else {
        // redirect to index.php if user id is not present
        redirect('index.php');
    }
    $sql		=	"SELECT * FROM spuser AS t INNER JOIN spprofiles AS p ON t.idspUser = p.spUser_idspUser WHERE p.idspProfiles = $pid ";
    $result     = dbQuery($dbConn,$sql);
    $row = dbFetchAssoc($result);
    //extract($row);
    if (is_array($row)){
        extract($row);
    }


?>




<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Profile Detail / <span><a href="<?php echo WEB_ROOT_ADMIN.'registerdUser/index.php?view=detail&uid='.$uid; ?>"><?php echo $spUserName; ?></a></span></h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo WEB_ROOT_ADMIN; ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo WEB_ROOT_ADMIN.'registerdUser'; ?>"> User Profiles</a></li>
        <li><a href="<?php echo WEB_ROOT_ADMIN.'registerdUser/index.php?view=detail&uid='.$uid; ?>"> User Detail</a></li>
        <li class="active">Profile Detail</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <?php
             echo "<img class='img-responsive margin-bottom profileImg' src=' " . ($row["spProfilePic"]) . "'  >";
            ?>
           <!--  <img src="" class="img-responsive" alt=""> -->
            <a href="<?php echo WEB_ROOT_ADMIN.'registerdUser/index.php?view=singleprofile&uid='.$_GET['uid'].'&pid='.$_GET['pid'].'&module=profile'; ?>" class="btn btn-primary btn-block margin-bottom" style="color: #FFF;"><?php echo ucwords($spProfileName);?></a>
            <a href="<?php echo WEB_ROOT_ADMIN.'registerdUser/index.php?view=singleprofile&uid='.$_GET['uid'].'&pid='.$_GET['pid'].'&module=dashboard'; ?>" class="btn btn-warning btn-block margin-bottom" style="color: #FFF;">Dashboard</a>
            <div class="box box-solid">
                <div class="box-header with-border">
                    <h3 class="box-title">Modules</h3>
                    <div class='box-tools'>
                        <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
                    </div>
                </div>
                <div class="box-body no-padding">
                    <?php

                    ?>
                    <ul class="nav nav-pills nav-stacked">
                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'store')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'sppoint_redeemed/index.php?view=retail&pid='.$_GET['pid']; ?>"><i class="fa fa-circle-o"></i> Stores <span class="label label-store pull-right"><?php totalMyProduct($dbConn, 'spproduct', $pid);?></span></a></li>

                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'freelancer')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'freelancer/index.php?view=freelancerList&pid='.$_GET['pid']; ?>"><i class="fa fa-circle-o"></i> Freelancer <span class="label label-freelance pull-right"><?php totalMyProduct($dbConn, 'spfreelancer', $pid);?></span></a></li>

                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'job-board')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'jobboard/index.php?view=ListJobBoard&pid='.$_GET['pid']; ?>"><i class="fa fa-circle-o"></i> Job Board <span class="label label-jobboard pull-right"><?php totalMyProduct($dbConn, 'spjobboard', $pid);?></span></a></li>

                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'real-estate')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'realestate/index.php?view=ListRealState&pid='.$_GET['pid']; ?>"><i class="fa fa-circle-o"></i> Real Estate <span class="label label-realestate pull-right"><?php totalMyProduct($dbConn, 'sprealstate', $pid);?></span></a></li>

                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'events')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'events/index.php?view=ListEvents&pid='.$_GET['pid']; ?>"><i class="fa fa-circle-o"></i> Events <span class="label label-events pull-right"><?php totalMyProduct($dbConn, 'spevent', $pid);?></span></a></li>

                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'art-gallery')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'artgallery/index.php?view=ArtAndCraft&pid='.$_GET['pid']; ?>"><i class="fa fa-circle-o"></i> Art Gallery <span class="label label-artgallery pull-right"><?php totalMyProduct($dbConn, 'sppostingsartcraft', $pid);?></span></a></li>

                        <!-- <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'music')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'registerdUser/index.php?view=singleprofile&uid='.$_GET['uid'].'&pid='.$_GET['pid'].'&module=music'; ?>"><i class="fa fa-circle-o"></i> Music <span class="label label-music pull-right"><?php totalMyProduct($dbConn, 'spproduct', $pid);?></span></a></li> -->

                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'video')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'video/index.php?view=all_videos&pid='.$_GET['pid']; ?>"><i class="fa fa-circle-o"></i> Video <span class="label label-video pull-right"><?php totalMyProduct($dbConn, 'spvideo', $pid);?></span></a></li>

                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'trainings')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'trainings/index.php?view=ListTrainings&pid='.$_GET['pid']; ?>"><i class="fa fa-circle-o"></i> Trainings <span class="label label-trainings pull-right"><?php totalMyProduct($dbConn, 'sptraining', $pid);?></span></a></li>

                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'classifiedAds')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'clasifiedadds/index.php?view=ListClasifiedadds&pid='.$_GET['pid']; ?>"><i class="fa fa-circle-o"></i> Classified ads <span class="label label-clasified pull-right"><?php totalMyProduct($dbConn, 'spclassified', $pid);?></span></a></li>
                        
                        

                    </ul>
                </div><!-- /.box-body -->
            </div><!-- /. box -->
        </div><!-- /.col -->
        <div class="col-md-9">
            <div class="box box-primary" style="min-height: 500px;">
                <?php
                if (isset($_GET['module']) && $_GET['module'] == 'store') {
                    include 'store.php';
                }else if(isset($_GET['module']) && $_GET['module'] == 'dashboard'){
                    include 'dashboard.php';
                }else if(isset($_GET['module']) && $_GET['module'] == 'freelancer'){
                    include 'freelancer.php';
                }else if(isset($_GET['module']) && $_GET['module'] == 'job-board'){
                    include 'job-board.php';
                }else if(isset($_GET['module']) && $_GET['module'] == 'real-estate'){
                    include 'real-estate.php';
                }else if(isset($_GET['module']) && $_GET['module'] == 'events'){
                    include 'events.php';
                }else if(isset($_GET['module']) && $_GET['module'] == 'art-gallery'){
                    include 'art-gallery.php';
                }else if(isset($_GET['module']) && $_GET['module'] == 'music'){
                    include 'music.php';
                }else if(isset($_GET['module']) && $_GET['module'] == 'video'){
                    include 'video.php';
                }else if(isset($_GET['module']) && $_GET['module'] == 'trainings'){
                    include 'trainings.php';
                }else if(isset($_GET['module']) && $_GET['module'] == 'classifiedAds'){
                    include 'classifiedAds.php';
                }else if(isset($_GET['module']) && $_GET['module'] == 'profile'){
                    include 'profile.php';
                }else{
                    include 'dashboard.php';
                }
                ?>
                
            </div><!-- /. box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
