<?php
    include('../univ/baseurl.php');
    session_start();
if (!isset($_SESSION['pid'])) {
    $_SESSION['afterlogin'] = "my-groups/";
    include_once ("../authentication/check.php");
    
}else{

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include('../component/f_links.php');?>
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
    <body onload="pageOnload('admin')" class="bg_gray" >
        <?php
       
        include_once("../header.php");
        $p = new _spprofiles;
        $rp = $p->readProfiles($_SESSION['uid']);
        ?>
        <section class="landing_page">
            <div class="container">
                
                    <div id="sidebar" class="col-md-2 no-padding">
                        <?php include('../component/left-landing.php');?>
                    </div>
                    <div class="col-md-7">
                        
                        <div class="row">
                            <input type ="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum_" class="album_id" value="">
                            <div class="col-md-12 m_top_10">
                                <div class="topstatus">
                                    <div class="createbox">
                                        <span><label><img src="<?php echo $BaseUrl;?>/assets/images/icon/time-line/create_post_icon_enable.png" alt="" class="img-responsive" > <strong>Create Group</strong></label></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="commentprofile">
                                    <div class="main_grop_timeline">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <img src="<?php echo $BaseUrl;?>/assets/images/icon/group-main.png" alt="" class="img-responsive" />
                                            </div>
                                            <div class="col-md-8">
                                                <h2>Create Group</h2>
                                                <h3>The SharePage</h3>
                                                <div class="pull-right">
                                                    <a href="<?php echo $BaseUrl;?>/my-groups/create-group.php" class="btn visit_group">Create Group</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="heading01 text-center">
                                    <?php
                                    $count = new _spgroup;
                                    $result_count = $count->groupmember($_SESSION['uid']);
                                    //echo $count->ta->sql;
                                    $private_count = 0;
                                    $public_count = 0;

                                    if($result_count != false){
                                        
                                        while ($row7 = mysqli_fetch_assoc($result_count)) {
                                            if($row7['spgroupflag'] == 1){
                                                $private_count++;
                                            }else{
                                                $public_count++;
                                            }
                                        }
                                    }
                                    ?>
                                    <h2>My Groups <span>(<?php echo $private_count; ?> Private | <?php echo $public_count; ?> Public)</span></h2>
                                    <a href="#"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group_main_inbox.png" class="img-responsive right_img_1" alt="" /></a>
                                    <a href="#"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group_main_email.png" class="img-responsive right_img_2" alt="" /></a>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
                                    <ul id="myTab" class="nav nav-tabs nav-tabs-responsive text-center" role="tablist">
                                        <li role="presentation" class="active">
                                            <a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">
                                                <span class="text">Private</span>
                                            </a>
                                        </li>
                                        <li role="presentation" class="next">
                                            <a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">
                                                <span class="text">Public</span>
                                            </a>
                                        </li>
                                        
                                    </ul>
                                    <div id="myTabContent" class="tab-content  ">
                                        <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
                                            <div class="cententdatadetail bg_white">
                                                <div class="row no-margin" >
                                                    <?php
                                                    $g = new _spgroup;
                                                    $result = $g->groupmember($_SESSION['uid']);
                                                    //echo $g->ta->sql;
                                                    if ($result != false) {
                                                        $bg_clr = 1;
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            //color background
                                                            if($bg_clr == 1){
                                                                $bg_clr_box = "bg_black";
                                                            }else if($bg_clr == 2){
                                                                $bg_clr_box = "bg_green_dark";
                                                            }else if($bg_clr == 3){
                                                                $bg_clr_box = "bg_pink_dark";
                                                            }else if($bg_clr == 4){
                                                                $bg_clr_box = "bg_red_dark";
                                                            }else if($bg_clr == 5){
                                                                $bg_clr_box = "bg_color_2";
                                                            }else if($bg_clr == 6){
                                                                $bg_clr_box = "bg_color_1";
                                                            }
                                                            
                                                            if($row['spgroupflag'] == 1){
                                                                //$g = new _spgroup;
                                                                //GET GROP BANNER, GROP DESCRIPTION 
                                                                $result2 = $g->groupdetails($row['idspGroup']);
                                                                if ($result2 != false) {
                                                                    $row2 = mysqli_fetch_assoc($result2);
                                                                    $gname = $row2["spGroupName"];
                                                                    $gtag = $row2["spGroupTag"];
                                                                    $gdes = $row2["spGroupAbout"];
                                                                    $gtype = $row2["spgroupflag"];
                                                                    $gcategory = $row2["spgroupCategory"];
                                                                    $glocation = $row2["spgroupLocation"];
                                                                    $gimage = $row2["spgroupimage"];
                                                                }
                                                                //GET ADMIN  NAME OR IMAGE
                                                                //$p = new _spgroup; //Admin will come on top
                                                                $rpvt = $g->members($row['idspGroup']);
                                                                //echo $g->ta->sql;
                                                                if ($rpvt != false) {
                                                                    while ($row3 = mysqli_fetch_assoc($rpvt)) {
                                                                        if ($row3['spProfileIsAdmin'] == 0) {
                                                                            $spProfilePic = $row3['spProfilePic'];
                                                                            $Group_Admin_Name = $row3['spProfileName'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                                <div class="col-md-4 no-padding">
                                                                    <a href="<?php echo $BaseUrl;?>/grouptimelines/?groupid=<?php echo $row['idspGroup']?>&groupname=<?php echo $row['spGroupName']?>&timeline" >
                                                                        <div class="main_grop_box <?php echo $bg_clr_box; ?>">
                                                                            <?php
                                                                            if($gimage == ""){ ?>
                                                                                <img src="<?php echo $BaseUrl;?>/assets/images/icon/group_main_banner.jpg" class="img-responsive group_banner" alt="" /><?php
                                                                            }else{ ?>
                                                                                <img src="<?php echo ($gimage); ?>" class="img-responsive group_banner" alt="" /><?php
                                                                            }
                                                                            
                                                                            if($spProfilePic != ""){?>
                                                                                <img src="<?php echo ($spProfilePic);?>" class="img-circle group_create" alt="" /> <?php
                                                                            }else{?>
                                                                                <img src="<?php echo $BaseUrl;?>/assets/images/icon/blank-img.png" class="img-circle group_create" alt="" /> <?php
                                                                            }?>
                                                                            <h4><?php echo $Group_Admin_Name; ?></h4>
                                                                            <h2><?php echo ucwords(strtolower($row['spGroupName']));?></h2>
                                                                            <?php
                                                                            //count member old and new
                                                                            $result3 = $g->allgrpmember($row['idspGroup']);
                                                                            $total_member = mysqli_num_rows($result3);
                                                                            $result4 = $g->newgrpmember($row['idspGroup']);
                                                                            //echo $g->tad->sql;
                                                                            if(!empty($result4)){
                                                                                $new_tot_member = mysqli_num_rows($result4);
                                                                            }else{
                                                                                $new_tot_member = 0;
                                                                            }
                                                                            ?>
                                                                            <h6><?php echo $total_member;?> members · <?php echo $new_tot_member;?> new members</h6>
                                                                            <span class="btn pull-right btn_gray_light"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group_multi_user_btn.png" class="img-responsive" alt="" />Timeline</span>
                                                                        </div>
                                                                    </a>
                                                                </div>
                                                                <?php
                                                                if($bg_clr < 6){
                                                                    $bg_clr++;
                                                                }else{
                                                                    $bg_clr = 1;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>

                                                </div>
                                                <div class="space"></div><div class="space-md"></div>
                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <div class="footer_see_all text-center">
                                                            <a href="#">See All</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="heading01 text-center">
                                                        <h2>Friends Groups</h2>
                                                        <a href="#"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group_main_inbox.png" class="img-responsive right_img_1" alt="" /></a>
                                                        <a href="#"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group_main_email.png" class="img-responsive right_img_2" alt="" /></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="cententdatadetail bg_white">
                                                <?php include('friendsGroup.php');?>
                                            </div>

                                        </div>
                                        <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
                                            
                                            <div class="cententdatadetail bg_white">
                                                <div class="row no-margin">
                                                    
                                                    <?php
                                                    $g = new _spgroup;
                                                    $result = $g->groupmember($_SESSION['uid']);
                                                    //echo $g->ta->sql;
                                                    if ($result != false) {
                                                        $bg_clr = 1;
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            //color background
                                                            if($bg_clr == 1){
                                                                $bg_clr_box = "bg_black";
                                                            }else if($bg_clr == 2){
                                                                $bg_clr_box = "bg_green_dark";
                                                            }else if($bg_clr == 3){
                                                                $bg_clr_box = "bg_pink_dark";
                                                            }else if($bg_clr == 4){
                                                                $bg_clr_box = "bg_red_dark";
                                                            }else if($bg_clr == 5){
                                                                $bg_clr_box = "bg_color_2";
                                                            }else if($bg_clr == 6){
                                                                $bg_clr_box = "bg_color_1";
                                                            }
                                                            
                                                            if($row['spgroupflag'] == 0){
                                                                //$g = new _spgroup;
                                                                //GET GROP BANNER, GROP DESCRIPTION 
                                                                $result2 = $g->groupdetails($row['idspGroup']);
                                                                if ($result2 != false) {
                                                                    $row2 = mysqli_fetch_assoc($result2);
                                                                    $gname = $row2["spGroupName"];
                                                                    $gtag = $row2["spGroupTag"];
                                                                    $gdes = $row2["spGroupAbout"];
                                                                    $gtype = $row2["spgroupflag"];
                                                                    $gcategory = $row2["spgroupCategory"];
                                                                    $glocation = $row2["spgroupLocation"];
                                                                    $gimage = $row2["spgroupimage"];
                                                                }
                                                                //GET ADMIN  NAME OR IMAGE
                                                                //$p = new _spgroup; //Admin will come on top
                                                                $rpvt = $g->members($row['idspGroup']);
                                                                //echo $g->ta->sql;
                                                                if ($rpvt != false) {
                                                                    while ($row3 = mysqli_fetch_assoc($rpvt)) {
                                                                        if ($row3['spProfileIsAdmin'] == 0) {
                                                                            $spProfilePic = $row3['spProfilePic'];
                                                                            $Group_Admin_Name = $row3['spProfileName'];
                                                                        }
                                                                    }
                                                                }
                                                                ?>
                                                                <div class="col-md-4 no-padding">
                                                                    <a href="<?php echo $BaseUrl;?>/grouptimelines/?groupid=<?php echo $row['idspGroup']?>&groupname=<?php echo $row['spGroupName']?>&timeline">
                                                                    <div class="main_grop_box <?php echo $bg_clr_box; ?>">
                                                                        <?php
                                                                        if($gimage == ""){ ?>
                                                                            <img src="<?php echo $BaseUrl;?>/assets/images/icon/group_main_banner.jpg" class="img-responsive group_banner" alt="" /><?php
                                                                        }else{ ?>
                                                                            <img src="<?php echo ($gimage); ?>" class="img-responsive group_banner" alt="" /><?php
                                                                        }
                                                                        
                                                                        if($spProfilePic != ""){?>
                                                                            <img src="<?php echo ($spProfilePic);?>" class="img-circle group_create" alt="" /> <?php
                                                                        }else{?>
                                                                            <img src="<?php echo $BaseUrl;?>/assets/images/icon/blank-img.png" class="img-circle group_create" alt="" /> <?php
                                                                        }?>
                                                                        <h4><?php echo $Group_Admin_Name; ?></h4>
                                                                        <h2><?php echo ucwords(strtolower($row['spGroupName']));?></h2>
                                                                        <?php
                                                                        //count member old and new
                                                                        $result3 = $g->allgrpmember($row['idspGroup']);
                                                                        $total_member = mysqli_num_rows($result3);
                                                                        $result4 = $g->newgrpmember($row['idspGroup']);
                                                                        //echo $g->tad->sql;
                                                                        if(!empty($result4)){
                                                                            $new_tot_member = mysqli_num_rows($result4);
                                                                        }else{
                                                                            $new_tot_member = 0;
                                                                        }
                                                                        ?>
                                                                        <h6><?php echo $total_member;?> members · <?php echo $new_tot_member;?> new members</h6>
                                                                        
                                                                        <span class="btn pull-right btn_gray_light"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group_multi_user_btn.png" class="img-responsive" alt="" />Timeline</span>
                                                                        
                                                                    </div>
                                                                    </a>
                                                                </div>
                                                                <?php
                                                                if($bg_clr < 6){
                                                                    $bg_clr++;
                                                                }else{
                                                                    $bg_clr = 1;
                                                                }
                                                            }
                                                        }
                                                    }
                                                    ?>

                                                
                                                </div>
                                                <div class="space"></div><div class="space-md"></div>
                                                <div class="row">
                                                    <div class="col-md-12">

                                                        <div class="footer_see_all text-center">
                                                            <a href="#">See All</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="heading01 text-center">
                                                        <h2>Friends Groups</h2>
                                                        <a href="#"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group_main_inbox.png" class="img-responsive right_img_1" alt="" /></a>
                                                        <a href="#"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group_main_email.png" class="img-responsive right_img_2" alt="" /></a>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="cententdatadetail bg_white">
                                                <?php include('friendsGroup.php');?>
                                            </div>
                                        
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>



                        </div>

                        
                    </div>
                    <div id="sidebar_right" class="col-md-3 no-padding">
                        <?php include('../component/right-landing.php');?>
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
} ?>