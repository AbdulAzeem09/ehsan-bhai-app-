<?php
    if (!defined('WEB_ROOT')) {
        exit;
    }

    if (isset($_GET['uid']) && $_GET['uid'] > 0 && isset($_GET['pid']) && $_GET['pid'] > 0) {
        $uid = $_GET['uid'];
        $pid = $_GET['pid'];
    }else {
        // redirect to index.php if user id is not present
        //redirect('index.php');
    }
    $sql		=	"SELECT * FROM spuser AS t INNER JOIN spprofiles AS p ON t.idspUser = p.spUser_idspUser WHERE p.idspProfiles = $pid ";
    $result     = dbQuery($dbConn,$sql);
    $row = dbFetchAssoc($result);
    extract($row);


?>



<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>Profile Detail</h1>
    <ol class="breadcrumb">
        <li><a href="<?php echo WEB_ROOT_ADMIN; ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li><a href="<?php echo WEB_ROOT_ADMIN.'allprofiles'; ?>"><i class="fa fa-circle-o"></i> All Profiles</a></li>
        <li class="active">Profile Detail</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-3">
            <?php
             echo "<img class='img-responsive margin-bottom' src=' " . ($row["spProfilePic"]) . "'  >";
            ?>
           <!--  <img src="" class="img-responsive" alt=""> -->
            <a href="<?php echo WEB_ROOT_ADMIN.'allprofiles/index.php?view=singleprofile&uid='.$_GET['uid'].'&pid='.$_GET['pid'].'&module=profile'; ?>" class="btn btn-primary btn-block margin-bottom" style="color: #FFF;"><?php echo ucwords($spProfileName);?></a>
            <a href="<?php echo WEB_ROOT_ADMIN.'allprofiles/index.php?view=singleprofile&uid='.$_GET['uid'].'&pid='.$_GET['pid'].'&module=dashboard'; ?>" class="btn btn-warning btn-block margin-bottom" style="color: #FFF;">Dashboard</a>
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
                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'store')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'allprofiles/index.php?view=singleprofile&uid='.$_GET['uid'].'&pid='.$_GET['pid'].'&module=store'; ?>"><i class="fa fa-circle-o"></i> Stores <span class="label label-store pull-right"><?php totalMyStoreProduct($dbConn, 1, $pid);?></span></a></li>
                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'freelancer')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'allprofiles/index.php?view=singleprofile&uid='.$_GET['uid'].'&pid='.$_GET['pid'].'&module=freelancer'; ?>"><i class="fa fa-circle-o"></i> Freelancer <span class="label label-freelance pull-right"><?php totalMyStoreProduct($dbConn, 5, $pid);?></span></a></li>
                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'job-board')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'allprofiles/index.php?view=singleprofile&uid='.$_GET['uid'].'&pid='.$_GET['pid'].'&module=job-board'; ?>"><i class="fa fa-circle-o"></i> Job Board <span class="label label-jobboard pull-right"><?php totalMyStoreProduct($dbConn, 2, $pid);?></span></a></li>
                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'real-estate')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'allprofiles/index.php?view=singleprofile&uid='.$_GET['uid'].'&pid='.$_GET['pid'].'&module=real-estate'; ?>"><i class="fa fa-circle-o"></i> Real Estate <span class="label label-realestate pull-right"><?php totalMyStoreProduct($dbConn, 3, $pid);?></span></a></li>
                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'events')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'allprofiles/index.php?view=singleprofile&uid='.$_GET['uid'].'&pid='.$_GET['pid'].'&module=events'; ?>"><i class="fa fa-circle-o"></i> Events <span class="label label-events pull-right"><?php totalMyStoreProduct($dbConn, 9, $pid);?></span></a></li>
                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'art-gallery')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'allprofiles/index.php?view=singleprofile&uid='.$_GET['uid'].'&pid='.$_GET['pid'].'&module=art-gallery'; ?>"><i class="fa fa-circle-o"></i> Art Gallery <span class="label label-artgallery pull-right"><?php totalMyStoreProduct($dbConn, 13, $pid);?></span></a></li>
                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'music')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'allprofiles/index.php?view=singleprofile&uid='.$_GET['uid'].'&pid='.$_GET['pid'].'&module=music'; ?>"><i class="fa fa-circle-o"></i> Music <span class="label label-music pull-right"><?php totalMyStoreProduct($dbConn, 14, $pid);?></span></a></li>
                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'video')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'allprofiles/index.php?view=singleprofile&uid='.$_GET['uid'].'&pid='.$_GET['pid'].'&module=video'; ?>"><i class="fa fa-circle-o"></i> Video <span class="label label-video pull-right"><?php totalMyStoreProduct($dbConn, 10, $pid);?></span></a></li>
                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'trainings')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'allprofiles/index.php?view=singleprofile&uid='.$_GET['uid'].'&pid='.$_GET['pid'].'&module=trainings'; ?>"><i class="fa fa-circle-o"></i> Trainings <span class="label label-trainings pull-right"><?php totalMyStoreProduct($dbConn, 8, $pid);?></span></a></li>
                        <li class="<?php echo (isset($_GET['module']) && $_GET['module'] == 'classifiedAds')?'active':'';?>"><a href="<?php echo WEB_ROOT_ADMIN.'allprofiles/index.php?view=singleprofile&uid='.$_GET['uid'].'&pid='.$_GET['pid'].'&module=classifiedAds'; ?>"><i class="fa fa-circle-o"></i> Classified ads <span class="label label-clasified pull-right"><?php totalMyStoreProduct($dbConn, 7, $pid);?></span></a></li>
                        
                        

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
