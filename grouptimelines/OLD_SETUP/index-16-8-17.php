<?php
ob_start();
include('../univ/baseurl.php');
include('email_campaign/Classes/PHPExcel/IOFactory.php');
include('../mlayer/emailCampaignUser.php');
?>

<!DOCTYPE html>
<html lang="en"> 
    <head>	
        <title>The SharePage</title>	
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/css/bootstrap.min.css">	
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/css/jquery-ui.min.css">	
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/css/home.css"> 
        	
        <script src="<?php echo $BaseUrl; ?>/js/jquery-2.1.4.min.js"></script>	
        <script src="<?php echo $BaseUrl; ?>/js/jquery-1.11.4-ui.min.js"></script>	
        <script src="<?php echo $BaseUrl; ?>/js/bootstrap.min.js"></script>	
        <script src="<?php echo $BaseUrl; ?>/js/fileinput.js"></script>	
        <!--<script data-main="<?php echo $BaseUrl ?>/elfinder/main.js" src="//cdnjs.cloudflare.com/ajax/libs/require.js/2.3.2/require.min.js"></script>-->	
        <script src="<?php echo $BaseUrl; ?>/js/home.js"></script> 
        <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/css/sweetalert.css">
<!--        <script src="<?php echo $BaseUrl; ?>/js/sweetalert-dev.js"></script>
        <script src="<?php echo $BaseUrl; ?>/js/sweetalert.min.js"></script>-->
        <script src="<?php echo $BaseUrl; ?>/js/gdocsviewer.min.js"></script>
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
        <!--<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.min.js"></script>-->

        <script type="text/javascript">

            //USER ONE
            $(function () {
                $('#users').multiselect({
                    includeSelectAllOption: true
                });
                $('#groups').multiselect({
                    includeSelectAllOption: true
                });
                $('#importusers').multiselect({
                    includeSelectAllOption: true
                });
            });
            //USER TWO
            $(function () {
                $('#userstoo').multiselect({
                    includeSelectAllOption: true
                });
                $('#groupstoo').multiselect({
                    includeSelectAllOption: true
                });
                $('#importuserstoo').multiselect({
                    includeSelectAllOption: true
                });
            });


        </script>
        <script>
            define('elFinderConfig', {
                // elFinder options (REQUIRED)
                // Documentation for client options:
                // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
                defaultOpts: {
                    url: '../elfinder/php/connector.minimal.php' // connector URL (REQUIRED)
                    , commandsOptions: {
                        edit: {
                            extraOptions: {
                                // set API key to enable Creative Cloud image editor
                                // see https://console.adobe.io/
                                creativeCloudApiKey: '',
                                // browsing manager URL for CKEditor, TinyMCE
                                // uses self location with the empty value
                                managerUrl: ''
                            }
                        }
                        , quicklook: {
                            // to enable preview with Google Docs Viewer
                            googleDocsMimes: ['application/pdf', 'image/tiff', 'application/vnd.ms-office', 'application/msword', 'application/vnd.ms-word', 'application/vnd.ms-excel', 'application/vnd.ms-powerpoint', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet']
                        }
                    }
                    // bootCalback calls at before elFinder boot up 
                    , bootCallback: function (fm, extraObj) {
                        /* any bind functions etc. */
                        fm.bind('init', function () {
                            // any your code
                        });
                        // for example set document.title dynamically.
                        var title = document.title;
                        fm.bind('open', function () {
                            var path = '',
                                    cwd = fm.cwd();
                            if (cwd) {
                                path = fm.path(cwd.hash) || null;
                            }
                            document.title = path ? path + ':' + title : title;
                        }).bind('destroy', function () {
                            document.title = title;
                        });
                    }
                },
                managers: {
                    // 'DOM Element ID': { /* elFinder options of this DOM Element */ }
                    'elfinder': {}
                }
            });
        </script>
        <script>
        //THIS IS FILE UPLOAD FOLDER TO CREATE NEW FOLDER OR NOT
        function selectNewFolder() {
            var x = document.getElementById("txtFolerName").value;
            if(x == 'New'){
                document.getElementById("txtDisable").style.display ="none";
                document.getElementById("txtFoldTitle").style.display ="inline";
            }else{
                document.getElementById("txtDisable").style.display ="inline";
                document.getElementById("txtFoldTitle").style.display ="none";
            }
        }
        </script>
    </head>
    <body onload="pageOnload('groupdd')">
        <?php
        session_start();

        function sp_autoloader($class) {
            include '../mlayer/' . $class . '.class.php';
        }

        spl_autoload_register("sp_autoloader");
        include_once ("../header.php");
        if (!isset($_SESSION['pid'])) {
            include_once ("../authentication/check.php");
            $_SESSION['afterlogin'] = "../grouptimelines/?groupid=" . $_GET["groupid"] . "&groupname=" . $_GET['groupname'] . "&timeline";
        }
        $g = new _spgroup;
        $result = $g->groupdetails($_GET["groupid"]);
        if ($result != false) {
            $row = mysqli_fetch_assoc($result);
            $gimage = $row["spgroupimage"];
        }
        ?>
        <div class="container-fluid">
            <input type="hidden" class="dynamic-pid" value="<?php echo $_SESSION['pid']; ?>">

            <input type="hidden" id="grpid" value="<?php echo $_GET["groupid"]; ?>">
            <input type="hidden" class="dynamic-profilename" value="<?php echo $_SESSION['myprofile']; ?>">
            <div class="row">		
                <div class="col-md-1 hidden-sm hidden-xs">			
                    <?php
                    include_once("../sidebar.php");
                    include_once("../categorysidebar.php");
                    ?>		
                </div>	
                <div class="pop-up" style="margin-top:100px; margin-left:200px;">
                    <p id="aboutprofile"></p>
                </div>
                <div class="col-md-11 grptimelinebg">	
                    <div class="well grptmline"><?php echo $_GET['groupname'] ?></div>

                    <div class="row">
                        <div class="col-md-2" >
                            <div class="navbarside"> 
                                <a data-toggle="collapse" href="#timeline" aria-expanded="false" aria-controls="collapseExample" class="navside <?php echo (isset($_GET["timeline"]) ? "selectgrpitem" : "deselectedgrpitem") ?>" data-url="&timeline"> <span class="glyphicon glyphicon-time" ></span>&nbsp;Timeline</a>
                                <a data-toggle="collapse" href="#memberlist" aria-expanded="false" aria-controls="collapseExample"  data-text="members" class="navside <?php echo (isset($_GET["members"]) ? "selectgrpitem" : "deselectedgrpitem") ?>" data-url="&members" > <span class="fa fa-users"></span>&nbsp;Users</a>
                                <!--<a data-toggle="collapse" href="#sendmessage" aria-expanded="false" aria-controls="collapseExample" class="navside" style="color:black; font-size:17px;"> <span class="glyphicon glyphicon-send "></span>&nbsp;Send Message</a>-->
                                <a data-toggle="collapse" href="#smsCampaignslist" aria-expanded="false" aria-controls="collapseExample" class="navside <?php echo (isset($_GET["smsCampaigns"]) ? "selectgrpitem" : "deselectedgrpitem") ?>" data-url="&smsCampaigns" id="sms"> <span class="glyphicon glyphicon-send" ></span>&nbsp;SMS Campaigns</a>
                                <a data-toggle="collapse" href="#emailCampaignslist" aria-expanded="false" aria-controls="collapseExample" class="navside <?php echo (isset($_GET["emailCampaigns"]) ? "selectgrpitem" : "deselectedgrpitem") ?>" data-url="&emailCampaigns" id="email"> <span class="glyphicon glyphicon-envelope" ></span>&nbsp;Email Campaigns</a>

                                <a data-toggle="collapse" href="#messageboard" aria-expanded="false" aria-controls="collapseExample" class="navside <?php echo (isset($_GET["message"]) ? "selectgrpitem" : "deselectedgrpitem") ?>" data-url="&message"> <span class="glyphicon glyphicon-envelope"></span>&nbsp;Message Board</a>
                                <a data-toggle="collapse" href="#event" aria-expanded="false" aria-controls="collapseExample" class="navside <?php echo (isset($_GET["event"]) ? "selectgrpitem" : "deselectedgrpitem") ?>" data-gid="<?php echo $_GET["groupid"]; ?>" data-text="event" data-url="&event"> <span class="fa fa-calendar"></span>&nbsp; Events</a>
                                <a data-toggle="collapse" href="#files" aria-expanded="false" aria-controls="collapseExample" class="navside <?php echo (isset($_GET["files"]) ? "selectgrpitem" : "deselectedgrpitem") ?>" data-url="&files"> <span class="glyphicon glyphicon-file"></span>&nbsp;Files</a>
                                <!--<a  href="../private-store/?gid=<?php //echo $_GET["groupid"];        ?>&gname=<?php //echo $_GET["groupname"];        ?>&groupflag=gflag&back=back" class="navside <?php //echo (isset($_GET["store"]) ? "selectgrpitem" : "deselectedgrpitem")        ?>" data-url="&store"> <span class="fa fa-home"></span>&nbsp;Store</a>-->

                                <a data-toggle="collapse"  href="#stores" aria-expanded="false" aria-controls="collapseExample" class="navside <?php echo (isset($_GET["stores"]) ? "selectgrpitem" : "deselectedgrpitem") ?>" data-url="&groupflag=gflag&back=back&stores"> <span class="fa fa-home"></span>&nbsp;Store</a>
                                <a data-toggle="collapse" href="#aboutgrp"aria-expanded="false" aria-controls="collapseExample" class="navside <?php echo (isset($_GET["aboutgroup"]) ? "selectgrpitem" : "deselectedgrpitem") ?>" data-url="&aboutgroup"> <span class="glyphicon glyphicon-info-sign"></span>&nbsp;About</a>
                            </div>
                        </div>

                        <div class="col-md-10">


                            <div class="panel panel-success" style="background-color: transparent;">
                                <div class="panel-heading">
                                    <div class="row">
                                        <?php
                                        $p = new _spprofiles;
                                        $result = $p->readMember($_SESSION['uid'], $_GET["groupid"]);
                                        if ($result != false) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $profileid = $row["idspProfiles"];
                                                $profilename = $row["spProfileName"];

                                                $g = new _spgroup;
                                                $pr = $g->admin_Member($profileid, $_GET["groupid"]);
                                                if ($pr != false) {
                                                    $rw = mysqli_fetch_assoc($pr);
                                                    if ($rw["spProfileIsAdmin"] == 0)
                                                        $admin = $rw["spProfileIsAdmin"];
                                                }
                                            }
                                        }
                                        ?>
                                        <div class="col-md-7 <?php echo (isset($admin) ? "" : "hidden"); ?> addfriend discussion <?php echo (isset($_GET["members"]) ? "" : "hidden") ?>" style="padding-top:12px;"><a href="../my-groups/?back=back&groupname=<?php echo $_GET['groupname']; ?>"><b><span class="glyphicon glyphicon-plus"></span> Users</b></a></div>

                                        <div class="col-md-7 addevent discussion <?php echo (isset($_GET["event"]) ? "" : "hidden") ?>" style="padding-top:12px;"><a href="../post-ad/events/?groupid=<?php echo $_GET["groupid"]; ?>&groupname=<?php echo $_GET['groupname']; ?>&back=back&groupflag=gflag"><b><span class="glyphicon glyphicon-plus"></span> Add Event</b></a></div>

                                        <div class="form-group" style="float:right;margin-bottom: 0px;" >
                                            <input type="text" class="form-control" placeholder="Search " id="searchtx">
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body previewdoc <?php echo (isset($_GET["members"]) ? "userbackgorund" : "") ?>" style="background-color: #F0F0F0 ;">
                                    <!--SHOW EMAIL REPORT START -->
                                    <div class="collapse <?php echo (isset($_GET["emailreport"]) ? "in" : "") ?> socials">
                                        <?php
                                        if (isset($_GET['emailreport'])) {
                                            include("email_campaign/emailCampaignReport.blade.php");
                                        }
                                        ?>
                                    </div>
                                    <!--SHOW EMAIL REPORT END -->
                                    <!--SHOW SMS REPORT START -->
                                    <div class="collapse <?php echo (isset($_GET["Smsreport"]) ? "in" : "") ?> socials">
                                        <?php
                                        if (isset($_GET['Smsreport'])) {
                                            include('sms_campaign/smsCampaignReport.blade.php');
                                        }
                                        ?>
                                    </div>
                                    <!--SHOW SMS REPORT END -->
                                    <!--IMPORT USER EMAIL FROM XLSX START -->
                                    <div class="collapse <?php echo (isset($_GET["importFile"]) ? "in" : "") ?> socials">
                                        <?php
                                        if (isset($_GET['importFile'])) {
                                            $conn = _data::getConnection();
                                            include("email_campaign/import_data.php");
                                            include("email_campaign/showImportFile.php");
                                        }
                                        ?>
                                    </div>
                                    <!--IMPORT USER EMAIL FROM XLSX END -->
                                    <!--TIMELINE START -->
                                    <div class="collapse <?php echo (isset($_GET["timeline"]) ? "in" : "") ?> socials" id="timeline">

                                        <div class="col-md-6">
                                            <div class="box box-primary">
                                                <?php
                                                $grouptimelines = 1;
                                                include("grouptimelineform.php");
                                                ?>
                                            </div>
                                            <div class="box box-primary">
                                                <?php
                                                include("../publicpost/globaltimelines.php");
                                                ?>	
                                            </div>
                                        </div>    
                                        <div class="col-md-3">
                                            <span class="who_online">Latest Updates</span>                                            
                                            <div class="box box-primary">
                                                <?php include('latest_updates.php'); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <span class="who_online">Who is Online?</span>
                                            <div class="box box-primary">
                                                <?php include('onlineusers.php'); ?>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="collapse <?php echo (isset($_GET["stores"]) ? "in" : "") ?>" id="stores">
                                        <?php
                                        include('stores.php');
                                        ?>
                                    </div>

                                    <div class="collapse <?php echo (isset($_GET["members"]) ? "in" : "") ?>" id="memberlist">
                                        <div>
                                            <?php
                                            include("memberlist.php");
                                            ?>	
                                        </div>
                                    </div>
                                    <!--SMS CAMPAIGNS START -->
                                    <div class="collapse <?php echo (isset($_GET["smsCampaigns"]) ? "in" : "") ?>" id="smsCampaignslist">
                                        <div>
                                            <?php
                                            include("sms_campaign/addSmsCampaign.blade.php");
                                            ?>	
                                        </div>
                                    </div>
                                    <!--SMS CAMPAIGNS END -->
                                    <!--EMAIL CAMPAIGNS START -->
                                    <div class="collapse <?php echo (isset($_GET["emailCampaigns"]) ? "in" : "") ?>" id="emailCampaignslist">
                                        <div>
                                            <?php
                                            include("email_campaign/addEmailCampaign.blade.php");
                                            ?>	
                                        </div>
                                    </div>
                                    <!--EMAIL CAMPAIGNS END -->
                                    <div class="collapse" id="sendmessage">
                                        <div>
                                            <?php
                                            $sendmessage = 1;
                                            include("messageboard.php");
                                            ?>
                                        </div>
                                    </div>
                                    <!--About Group-->
                                    <div class="collapse <?php echo (isset($_GET["aboutgroup "]) ? "in" : "") ?>" id="aboutgrp">
                                        <div>
                                            <?php
                                            include("aboutgrp.php");
                                            ?>
                                        </div>
                                    </div>
                                    <!--Testing Complete-->
                                    <div class="collapse <?php echo (isset($_GET["message "]) ? "in" : "") ?>" id="messageboard">
                                        <div style"">
                                            <div class="">
                                                <h4><span class="title" style="font-size:20px;">Discussions</span>
                                                    <a href="#" style='float:right;' data-toggle="modal" data-target="#conversationModal">
                                                        <span class="glyphicon glyphicon-plus"></span> New Discussions
                                                    </a>
                                                </h4>
                                                <?php
                                                $sendmessage = 2;
                                                    include("conversation.php");
                                                ?>	
                                            </div>
                                        </div>
                                    </div>
                                    <div class="collapse <?php echo (isset($_GET["event"]) ? "in" : "") ?>" id="event">
                                        <?php include("events.php"); ?>
                                    </div>

                                    <div class="pop-up" style="margin-top:150px;margin-left:-250px;">
                                        <p id="aboutprofile"></p>
                                    </div>
                                    <!--Folder files show-->
                                    <div class="collapse in" id="folder">
                                        
                                        <?php
                                        if(isset($_GET['folder']) &&  $_GET['folder'] > 0){
                                            include('folder.php');
                                        }

                                        if(isset($_GET['delfolder']) && $_GET['delfolder'] >0){
                                            $spf = new _postingalbum;
                                            $result_fold = $spf->allfolder_dell($_GET['delfolder']);
                                        }
                                        if(isset($_GET['trash']) && $_GET['groupid'] > 0){
                                            include('trash.php');
                                        }
                                        if(isset($_GET['restore']) && $_GET['restore'] > 0){
                                            $spf = new _postingalbum;
                                            $result_fold = $spf->restore_folder($_GET['restore']);
                                            $location = $BaseUrl.'/grouptimelines/?groupid='.$_GET['groupid'].'&groupname='.$_GET['groupname'].'&files';
                                            header('location:'.$location);
                                        }
                                        if(isset($_GET['restorefile']) && $_GET['restorefile'] > 0){
                                            $spf = new _postingalbum;
                                            $result_fold = $spf->restore_files($_GET['restorefile']);
                                            
                                            $location = $BaseUrl.'/grouptimelines/?groupid='.$_GET['groupid'].'&groupname='.$_GET['groupname'].'&files';
                                            header('location:'.$location);
                                        }
                                        ?>
                                        
                                    </div>
                                    
                                    <div class="collapse <?php echo (isset($_GET["files"]) ? "in" : "") ?>" id="files" style="margin: 10px;">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="box box-primary">
                                                    <div class="col-md-12">
                                                        <div id="elfinder"></div>
                                                        <a href="#" id="allfile" class="hidden"><b>See All</b></a>
                                                        
                                                        <a  href="#" class="pull-right btn butn-post" style="margin-bottom:20px;" data-toggle="modal" data-target="#newfile" id="nwfile"><span class="fa fa-upload"></span><b> Upload New Files</b></a> 
                                                    </div>
                                                    <div class="">
                                                        <div class="row mainheading_folder">
                                                            <div class="col-md-6">
                                                                <p>Title</p>
                                                            </div>
                                                            <div class="col-md-2 text-center">
                                                                <p>Creater</p>
                                                            </div>
                                                            <div class="col-md-2 text-center">
                                                                <p>Date</p>
                                                            </div>
                                                            <div class="col-md-2 text-center">
                                                                <p>Action</p>
                                                            </div>
                                                        </div>
                                                        <?php
                                                        $spf = new _postingalbum;
                                                        $result_fold = $spf->allfolder($_GET['groupid']);
                                                        //echo $spf->spf->sql;
                                                        
                                                        if ($result_fold) {
                                                            
                                                            while ($row = mysqli_fetch_assoc($result_fold)) { ?>
                                                                <div class="panel-group">
                                                                    <div class="panel panel-default">
                                                                        <div class="panel-heading">
                                                                            
                                                                            <h4 class="panel-title folder_title">
                                                                                <div class="row">
                                                                                    <div class="col-md-6 mainTitle">
                                                                                        <a href="<?php echo $BaseUrl.'/grouptimelines/?groupid='.$_GET['groupid'].'&groupname='.$_GET['groupname'].'&folder='.$row['spf_id'];?>"><p><i class="fa fa-folder"></i> <?php echo  $row['spf_title'];?></p></a>
                                                                                    </div>
                                                                                    <div class="col-md-2 text-center">
                                                                                            <p>
                                                                                            <?php //Uploader name
                                                                                            $p = new _spprofiles;
                                                                                            $creatName = $p->read($row['spProfiles_idspProfiles']);
                                                                                            if ($creatName != false) {
                                                                                                $spf_rpr = mysqli_fetch_assoc($creatName);
                                                                                                echo  $spf_rpr["spProfileName"];
                                                                                            }?></p>
                                                                                    </div>
                                                                                    <div class="col-md-2 text-center">
                                                                                        <p><?php echo $row['spf_date'];?></p>
                                                                                    </div>
                                                                                    <div class="col-md-2 text-center">
                                                                                        <?php
                                                                                        $profileid = $_SESSION['pid'];
                                                                                        $g = new _spgroup;
                                                                                        $pr = $g->admin_Member($profileid, $_GET["groupid"]);
                                                                                        foreach ($pr as $key => $isAdmin) {
                                                                                            $isAmdinha = $isAdmin['spProfileIsAdmin'];
                                                                                            $isAssAdmin = $isAdmin['spAssistantAdmin'];
                                                                                            if($isAmdinha == 0 || $isAssAdmin == 1){ ?>
                                                                                                <input type="hidden" name="" value="<?php echo $BaseUrl.'/grouptimelines/?groupid='.$_GET['groupid'].'&groupname='.$_GET['groupname'].'&files&delfolder='. $row['spf_id'];?>" id="txtDelfold<?php echo $row['spf_id']?>" />
                                                                                                <a href="javascript:void(0)" id="folderDel<?php echo $row['spf_id']?>" onclick="folderDel<?php echo $row['spf_id']?>();" class="btn btn-danger dellink" ><p><i class="fa fa-trash"></i></p></a>
                                                                                                <a href="#" id="folderView" class="btn btn-info dellink" data-toggle="modal" data-target="#updatefile<?php echo $row['spf_id']?>" ><p><i class="fa fa-eye"></i></p></a> 
                                                                                                
                                                                                                <!--Update Resume modal-->
                                                                                                <div class="modal fade" id="updatefile<?php echo $row['spf_id']?>" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
                                                                                                    <div class="modal-dialog" role="document">
                                                                                                        <div class="modal-content" style="background-color:white;">
                                                                                                            <div class="modal-header">
                                                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                                                                                <h3 class="modal-title" id="fileheader">Update Folder Name</h3>
                                                                                                            </div>
                                                                                                            <div class="modal-body">
                                                                                                                <form class="">
                                                                                                                    <input type="hidden" id="txtGroupId" value="<?php echo $_GET["groupid"]; ?>"/>
                                                                                                                    <input type="hidden" id="txtFolderId<?php echo $row['spf_id']?>" value="<?php echo $row['spf_id']; ?>"/>
                                                                                                                    <!--Choose your new Resume-->
                                                                                                                    <br>
                                                                                                                    <div class="row folder_form text-left">
                                                                                                                        <div class="col-md-12">
                                                                                                                            <div class="form-group">
                                                                                                                                <label for="recipient-name" class="control-label text-left">Rename Folder Name</label>
                                                                                                                                <input type="text" class="form-control" id="txtFolderTitle<?php echo $row['spf_id']?>" value="<?php echo $row['spf_title']?>"  required />
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                    <!--Choose resume code complete-->
                                                                                                                    <div class="modal-footer" class="uploadupdate">
                                                                                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                                                                        <button type="button" id="updateFolderFile<?php echo $row['spf_id']?>" class="btn butn-post">Submit</button>
                                                                                                                    </div>
                                                                                                                </form>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <script type="text/javascript">
                                                                                                    //Update folder Name
                                                                                                    $("#updateFolderFile<?php echo $row['spf_id']?>").on("click", function () {
                                                                                                        
                                                                                                        var txtGroupId = document.getElementById("txtGroupId").value;
                                                                                                        var txtFolderId = document.getElementById("txtFolderId<?php echo $row['spf_id']?>").value;
                                                                                                        var txtFolderTitle = document.getElementById("txtFolderTitle<?php echo $row['spf_id']?>").value;
                                                                                                        
                                                                                                        $.post("../myjobboard/updateresume.php", {txtGroupId: txtGroupId, txtFolderId: txtFolderId, txtFolderTitle: txtFolderTitle}, function () {
                                                                                                            location.reload();
                                                                                                            $(".modal").modal('hide');

                                                                                                        });

                                                                                                    })

                                                                                                    //Delete folder from group
                                                                                                    $("#folderDel<?php echo $row['spf_id']?>").on("click", function () {
                                                                                                        if (confirm("Are you sure you want to Delete Folder?")) {
                                                                                                            var txtDelfold = document.getElementById("txtDelfold<?php echo $row['spf_id']?>").value;
                                                                                                            window.location = txtDelfold;
                                                                                                        }
                                                                                                    })
                                                                                                </script>
                                                                                                <?php
                                                                                            }
                                                                                        }

                                                                                        ?>
                                                                                        
                                                                                    </div>
                                                                                </div>
                                                                            </h4>
                                                                            
                                                                        </div>

                                                                    </div>
                                                                </div> <?php
                                                            } ?>
                                                            <div class="row mainheading_folder">
                                                                <div class="col-md-12">
                                                                    <div class="panel-group">
                                                                        <div class="panel panel-default">
                                                                            <div class="panel-heading trashtitle">
                                                                                <a href="<?php echo $BaseUrl.'/grouptimelines/?groupid='.$_GET['groupid'].'&groupname='.$_GET['groupname'].'&trash'?>"><h4 class="panel-title folder_title"><i class="fa fa-folder"></i> Trash</h4></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            <?php
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
                </div>	

                <!--comment-->

                <!--Preview Resume-->
                <div class="modal fade" id="previewfile" tabindex="-1" role="dialog" aria-labelledby="previewModalLabel">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content" style="background-color:white;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" id="previewModalLabel">File Preview</h3>
                            </div>
                            <div class="modal-body">
                                <a id="" class='embed resumeid' href="#"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Preview Resume Complete-->

                <!--Adding new Resume modal-->
                <div class="modal fade" id="newfile" tabindex="-1" role="dialog" aria-labelledby="resumeModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content" style="background-color:white;">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h3 class="modal-title" id="fileheader">Upload New File</h3>
                            </div>
                            <div class="modal-body">
                                <form class="">
                                    <input type="hidden" id="grpid" value="<?php echo $_GET["groupid"]; ?>"/>
                                    <!--Choose your new Resume-->
                                    <br>
                                    <div class="row folder_form">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="recipient-name" class="control-label"><h4>Select Folder</h4></label>
                                                <select class="form-control" name="txtFolerName" id="txtFolerName" onchange="selectNewFolder()">
                                                    <option >Select Folder</option>
                                                    <?php
                                                        $profileid = $_SESSION['pid'];
                                                        $g = new _spgroup;
                                                        $pr = $g->admin_Member($profileid, $_GET["groupid"]);
                                                        foreach ($pr as $key => $isAdmin) {
                                                            $isAmdinha = $isAdmin['spProfileIsAdmin'];
                                                            $isAssAdmin = $isAdmin['spAssistantAdmin'];
                                                            if($isAmdinha == 0 || $isAssAdmin == 1){ ?>
                                                                <option value="New">Create New Folder</option>
                                                                <?php
                                                            }
                                                        }
                                                    
                                                        $spf = new _postingalbum;
                                                        $result_fold2 = $spf->allfolder($_GET['groupid']);
                                                        //echo $spf->spf->sql;
                                                        while ($row2 = mysqli_fetch_assoc($result_fold2)) { ?>
                                                            <option value="<?php echo $row2['spf_id'];?>"><?php echo $row2['spf_title'];?></option> <?php
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                                $profileid = $_SESSION['pid'];
                                                $g = new _spgroup;
                                                $pr = $g->admin_Member($profileid, $_GET["groupid"]);
                                                foreach ($pr as $key => $isAdmin) {
                                                    $isAmdinha = $isAdmin['spProfileIsAdmin'];
                                                    $isAssAdmin = $isAdmin['spAssistantAdmin'];
                                                    if($isAmdinha == 0 || $isAssAdmin == 1){ ?>
                                                        <div class="form-group">
                                                            <label for="recipient-name" class="control-label"><h4>Folder Title</h4></label>
                                                            <input type="text" class="form-control" id="txtDisable" disabled=""  required />
                                                            <input type="text" class="form-control" id="txtFoldTitle"  title="Please fill this field..."  required />
                                                        </div>
                                                    <?php
                                                    }
                                                }
                                            ?>
                                            
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="recipient-name" class="control-label"><h4>File Title</h4></label>
                                                <input type="text" class="form-control" id="mediatitle"  title="Please fill this field..." required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <input type="file" id="adddocument" class="spmedia" name="spPostingMedia[]" multiple="multiple" required>
                                            </div>
                                        </div>

                                    </div>
                                    

                                    
                                    
                                    <div id="media-container"></div>
                                    <!--Choose resume code complete-->

                                    <div class="modal-footer" class="uploadupdate">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="button" id="uploadfile" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Adding new resume modal complete-->

                <div class="modal fade" id="mycomment" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h4 class="modal-title" id="commentModalLabel">Comments</h4>
                            </div>
                            <div class="modal-body">
                                <div id="commentUploading"><!--comment loading--></div>
                                <form action="../social/addcomment.php" method="post">
                                    <div class="row">
                                        <div class="col-md-1" id="profilepictures">
                                            <!--Picture of session user-->
                                        </div>
                                        <div class="col-md-11" >

                                            <input type="text" class="form-control" name="comment" id="comment"  placeholder="Write a comment...">

                                            <input type="hidden" id="postcomment" name="spPostings_idspPostings" >

                                            <input class="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $_SESSION['pid'] ?>"> 
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Comment</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>


            </div>
        </div>	

        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL START-->

        <script type="text/javascript">

            //send email campaign start
            $('#saveEmail').on('click', function () {
                $("#Idstoo").val('');
                var optionValuetoo = $("#optionValuetoo").val();
                // alert(encodeURI(optionValue) );
                if (optionValuetoo == 'usertoo') {
                    var option = 'user';
                    var selected = $("#usertoo option:selected");
                    var ids = "";
                    selected.each(function () {
                        ids += +$(this).val() + ",";
                    });
                    $("#Idstoo").val(ids);
                } else if (optionValuetoo == 'grouptoo') {
                    var option = 'group';
                    var selected = $("#grouptoo option:selected");
                    var ids = "";

                    selected.each(function () {
                        ids += +$(this).val() + ",";
                    });
                    $("#Idstoo").val(ids);
                } else {
                    var option = 'importuser';
                    var selected = $("#importusertoo option:selected");
                    var ids = "";

                    selected.each(function () {
                        ids += +$(this).val() + ",";
                    });
                    $("#Idstoo").val(ids);
                }

                // alert();
                // return;
                var text = $("#txtEditor").Editor("getText");
                //var txtName = $('#txtName').val();
                //alert(txtName);
                $.ajax({
                    type: 'POST',
                    url: 'http://127.0.0.1/the-share-page/grouptimelines/email_campaign/sendEmailCampaign.php',
                    data: {
                        'name': $('#txtName').val(),
                        // 'email':$('#email').val(),
                        'text': text,
                        'type': 'Email',
                        'date': $('#date').val(),
                        'time': $('#txttime').val(),
                        'user_id': $('#user_id').val(),
                        'user_id': $('#userOptiontoo').val(),
                        'user_or_group': option,
                        'group_id': $('#groupOptiontoo').val(),
                        'status': 'pending',
                        'Ids': $("#Idstoo").val(),
                    },
                    success: function (data) {
                        if (data == 'success') {

                            swal('Success', 'Campaign added', 'success');
                            $('#txtName').val(''),
                                    // $('#email').val(''),
                                    $('#txtEditor').val(''),
                                    $('#date').val(''),
                                    $('#txttime').val('');
                            //location.reload();
                        } else {
                            swal('Error', data, 'error');
                        }
                    },
                    error: function (data) {
                        swal('Error', data, 'error');
                    }
                });
            })
            //send email campaign end


            //for user one grop
            $("#userOption").change(function () {
                $("#optionValue").val('');
                $("#optionValue").val('user');
                $("#group").css('display', 'none');
                $("#user").css('display', '');
                $("#importuser").css('display', 'none');
            });
            $("#groupOption").change(function () {
                $("#optionValue").val('');
                $("#optionValue").val('group');
                $("#user").css('display', 'none');
                $("#group").css('display', '');
                $("#importuser").css('display', 'none');
            });
            $("#importuserOption").change(function () {
                $("#optionValue").val('');
                $("#optionValue").val('importuser');
                $("#user").css('display', 'none');
                $("#group").css('display', 'none');
                $("#importuser").css('display', '');
            });
            //for user two group
            $("#userOptiontoo").change(function () {
                $("#optionValuetoo").val('');
                $("#optionValuetoo").val('usertoo');
                $("#grouptoo").css('display', 'none');
                $("#usertoo").css('display', '');
                $("#importusertoo").css('display', 'none');
            });
            $("#groupOptiontoo").change(function () {
                $("#optionValuetoo").val('');
                $("#optionValuetoo").val('grouptoo');
                $("#usertoo").css('display', 'none');
                $("#grouptoo").css('display', '');
                $("#importusertoo").css('display', 'none');
            });
            $("#importOptiontoo").change(function () {
                $("#optionValuetoo").val('');
                $("#optionValuetoo").val('importusertoo');
                $("#usertoo").css('display', 'none');
                $("#grouptoo").css('display', 'none');
                $("#importusertoo").css('display', '');
            });

        </script>


        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/css/bootstrap-multiselect.css"></script> -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
        <!-- <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script> -->
        <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js"></script> -->
        <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css" />
        <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js" type="text/javascript"></script> 


        <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>   
        <script type="text/javascript">
            $("#date").datepicker({dateFormat: 'yy-mm-dd'});
            $("#datetoo").datepicker({dateFormat: 'yy-mm-dd'});
        </script>

        <!-- INNER PAGE SCRIPTS STARTS FOR SMS AND EMAIL END-->

    </body>	
</html>