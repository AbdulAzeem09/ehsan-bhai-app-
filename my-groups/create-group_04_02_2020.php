<?php
    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="my-groups/";
    include_once ("../authentication/check.php");
    
}else{

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }

    spl_autoload_register("sp_autoloader");

    // ===========get ip and then get location
    $ip = $_SERVER['REMOTE_ADDR']; // your ip address here
    
    $que_rec = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
    if($que_rec && $que_rec['status'] == 'success'){
        $currentLoc = $que_rec['city'];
    }else{
        $currentLoc = "";
    }


?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
        <!--This script for posting timeline data End-->
        
    </head>

    <body class="bg_gray">
        <?php include('../header.php');?>
        <section class="create_grp_top bg_white">
            <div class="container">
                <div class="row">
                    <div class="col-md-2">
                        <div class="dropdown pull-right" id="trans_drop">
                            <button class="btn  dropdown-toggle" type="button" data-toggle="dropdown">My Groups <span>(All)</span>
                            <span class="caret"></span></button>
                        </div>
                    </div>
                    <div class="col-md-7"></div>
                    <div class="col-md-3">
                        <div class="dropdown" id="trans_drop">
                            <button class="btn  dropdown-toggle" type="button" data-toggle="dropdown">Explore <span>(All)</span>
                            <span class="caret"></span></button>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="detail_group">
            <div class="container">
                <div class="row">
                    <div class="col-md-2 no-padding">
                        <?php
                        $g = new _spgroup;
                        $result = $g->groupmember($_SESSION['uid']);
                        //echo $g->ta->sql;
                        if($result != false){
                            while ($row = mysqli_fetch_assoc($result)) { ?>
                                <div class="left_create row">
                                    <div class="left_img_create">
                                        <?php
                                        $result2 = $g->groupdetails($row['idspGroup']);
                                        if ($result2 != false) {
                                            $row2 = mysqli_fetch_assoc($result2);
                                            $gimage = $row2["spgroupimage"];
                                        }
                                        if($gimage == ""){ ?>
                                            <img src="<?php echo $BaseUrl;?>/assets/images/icon/group_main_banner.jpg" class="img-circle main_grp_img" alt="" /><?php
                                        }else{ ?>
                                            <img src="<?php echo ($gimage); ?>" class="img-circle main_grp_img" alt="" /><?php
                                        }
                                        ?>
                                    </div>
                                    <h4>
                                        <a href="<?php echo $BaseUrl;?>/grouptimelines/?groupid=<?php echo $row['idspGroup']?>&groupname=<?php echo $row['spGroupName']?>&timeline" data-toggle="tooltip" title="<?php echo $row["spGroupName"];?>">
                                            <?php
                                            if(strlen($row["spGroupName"]) > 12){
                                                echo $string = substr($row["spGroupName"], 0, 12).'...';
                                            }else{
                                                echo $row["spGroupName"];
                                            } ?>
                                        </a>
                                        <span class="pull-right"><img src="<?php echo $BaseUrl;?>/assets/images/icon/group/cog.png" class="img-responsive" alt=""></span></h4>
                                    <h5>10+ unread Post</h5>
                                    <?php
                                    if($row['spgroupflag'] == 1){
                                        echo '<h6><i class="fa fa-lock"></i> Private</h6>';
                                    }else{
                                        echo '<h6><i class="fa fa-globe"></i> Public</h6>';
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                        }
                        ?>
                        
                    </div>
                    <div class="col-md-7">
                        <div class="mid_creat_form">
                            <h4><i class="fa fa-pencil"></i> Create New Group</h4>
                            <div class="bg_white form_grp">
                                <p>Groups are great for getting things done and staying in touch with just the people you want. Share photos and videos, have conversations, make plans and more.</p>
                                
                                <div class="row groupfield">
                                    <form class="creaate_new_grp" action="../post-ad/addgroup.php" method="post" id="sp-add-group">
                                        <!-- all the hidden value-->
                                        <input class="dynamic-pid" type="hidden" id="myprofileid" name="pid_" value="<?php echo $_SESSION['pid']; ?>">
                                        <input id="spProfileTypes_idspProfileTypes" type="hidden" value="<?php echo $_SESSION['ptid']; ?>">
                                        <input id="userid" type="hidden" value="<?php echo $_SESSION['uid']; ?>" value="1">

                                        <div class="form-group col-md-12">
                                            <label for="email">Name Your Group</label>
                                            <input type="text" id="spGroupName" name="spGroupName" class="form-control" required="" >
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Group Category</label>
                                            <select class="form-control" id="grpcategory" name="spgroupCategory" >
                                                <?php
                                                    $m = new _subcategory;
                                                    $catid = 17;
                                                    $result = $m->read($catid);
                                                    if($result){
                                                        while($rows = mysqli_fetch_assoc($result)){ ?>
                                                            <option value='<?php echo $rows["subCategoryTitle"]; ?>' ><?php echo $rows["subCategoryTitle"];?></option>
                                                            <?php
                                                        }
                                                    }
                                                ?>
                                                
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="email">Location/City</label>
                                            <input type="text" class="form-control" id="locationcity" name="spgroupLocation" value="<?php echo $currentLoc; ?>" readonly />
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="email">Short Description (Max 50 words)</label>
                                            <input type="text" class="form-control" id="spGroupTagline" name="spGroupTag">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="email">Select Privacy</label>
                                            <div class="form-control bg_gray_light no-radius">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label class="checkbox-inline"><input type="radio" name="spgroupflag" class="groupflag" value="0">Public</label>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label class="checkbox-inline"><input type="radio" name="spgroupflag" class="groupflag" value="1">Private</label>
                                                    </div>
                                                    
                                                </div>                                                
                                            </div>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="email">Description</label>
                                            <textarea class="form-control" id="spGroupAbout" name="spGroupAbout"></textarea>
                                        </div>
                                        <div class="form-group col-md-4">

                                            <label for="email">Group Banner images</label>
                                            <div class="box">
                                                <input type="file" name="spgroupimage[]" multiple="multiple" id="file-1" class="grpbnrimg inputfile inputfile-1" >
                                                <label for="file-1"> <span>Choose from</span></label>
                                                <img src="" alt="" class="grpbannerpic"  >
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                           
                                        </div>
                                        <div class="form-group col-md-4">
                                            <button type="submit" id="spgroupSubmit" class="btn btn-create-form">Create</button>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 no-padding">
                        <div class="right_create">
                            <?php
                            $notgrp = new _spgroup;
                            $result = $notgrp->notgroupmember($_SESSION['uid']);
                            //echo $notgrp->ta->sql;
                            if($result != false){
                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                    <div class="explore_box row">
                                        <div class="righ_img">
                                            <?php
                                            $result2 = $g->groupdetails($row['idspGroup']);
                                            if ($result2 != false) {
                                                $row2 = mysqli_fetch_assoc($result2);
                                                $gimage = $row2["spgroupimage"];
                                            }
                                            if($gimage == ""){ ?>
                                                <img src="<?php echo $BaseUrl;?>/assets/images/icon/group_main_banner.jpg" class="img-circle main_grp_img" alt="" /><?php
                                            }else{ ?>
                                                <img src="<?php echo ($gimage); ?>" class="img-circle main_grp_img" alt="" /><?php
                                            }
                                            ?>
                                            
                                        </div>
                                        <a href="#" class="btn btn-green pull-right">+1 Join</a>
                                        <h3>
                                            <a href="<?php echo $BaseUrl;?>/grouptimelines/?groupid=<?php echo $row['idspGroup']?>&groupname=<?php echo $row['spGroupName']?>&timeline" data-toggle="tooltip" title="<?php echo $row["spGroupName"];?>">
                                                <?php
                                                if(strlen($row["spGroupName"]) > 12){
                                                    echo $string = substr($row["spGroupName"], 0, 12).'...';
                                                }else{
                                                    echo $row["spGroupName"];
                                                } ?>
                                            </a>
                                        </h3>
                                        <p>1 friend · 1,408,491 members</p>
                                    </div> <?php
                                }
                            }
                            ?>
                            

                            <div class="text-center right_show_all">
                                <a href="#" class="">Show All</a>
                            </div>
                        </div>
                    </div>
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