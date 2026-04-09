<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
<?php
if (isset($_GET['grouptimelinePage']) && $_GET['grouptimelinePage'] == 'yes') {
} else { ?>
  <script src="<?php echo $BaseUrl; ?>/assets/js/home.js"></script>
<?php } ?>
<!-- <link href="<?php echo $BaseUrl; ?>/assets/css/sweetalert.css" rel="stylesheet" media="screen">
<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>        -->
<style>
  .left_grid ul li a p {
    margin-left: 35px;
  }

  .modal-title {
    font-family: Marksimon;
    font-size: none;
  }

  .left_group_gr {
    background-color: #fff;
    padding-left: 10px;
    padding-top: 5px;
    padding-bottom: 10px;
    border-radius: 15px;
    margin-top: 0px;
  }
</style>
<?php
include('../univ/main.php');
$dbConn = mysqli_connect(DBHOST, UNAME, PASS, DBNAME);
// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}
?>
<div class="w-100">

  <?php


  $group_id = isset($_GET['groupid']) ? (int) $_GET['groupid'] : 0;
  $g = new _spgroup;
  if (isset($group_id)) {
    $result_grp_admin = $g->readgroupAdmin($group_id);
    // echo $g->ta->sql;
    if ($result_grp_admin != false) {



      $row_grp_admin = mysqli_fetch_assoc($result_grp_admin);
      //print_r($row_grp_admin);die;


      $admin_profile = $row_grp_admin['spProfilePic'];

      $admin_Id = $row_grp_admin['idspProfiles'];
      $admin_Name = $row_grp_admin['spProfileName'];
      $create_date111 = $row_grp_admin['CreatedDate'];

      $admin_ptype = $row_grp_admin['spProfileType_idspProfileType'];
    }

    $result_ismember = $g->ismember($group_id, $_SESSION['pid']);
    //echo $g->ta->sql;
    if ($result_ismember != false) {



      $row_ismember = mysqli_fetch_assoc($result_ismember);

      // print_r($row_ismember);

      /*  $admin_Id = $row_ismember['idspProfiles'];
$admin_Name = $row_ismember['spProfileName'];

$admin_ptype = $row_ismember['spProfileType_idspProfileType'];*/

      $profile_exist = $row_ismember['spProfiles_idspProfiles'];


      $approve =   $row_ismember['spApproveRegect'];

      /*spApproveRegect*/
    }
  }


  $p      = new _spgroup_event;


  $res  = $p->publicgroup_event($group_id);
  //      echo $p->ta->sql;
  //echo $p->ta->sql;
  if ($res != false) {


    $row = mysqli_fetch_assoc($res);


    $adminprofileid = $row['spProfiles_idspProfiles'];
  }

  // print_r($admin_Id);
  ?>



  <style>
    .previous {
      text-decoration: none;
      display: inline-block;
      padding: 8px 16px;
    }

    .previous :hover {
      background-color: #ddd;
      color: black;
    }

    .previous {
      background-color: #f1f1f1;
      color: black;
    }

    .btn:hover {
      color: #0c030c !important;
      opacity: .8;
    }

    .left_grid ul li {
      padding-bottom: 0px !important;
    }

    .left_grid ul li a {
      margin-top: 0px !important;
    }

    .active_drp {
      margin-left: 0px !important;
    }




    .modal-title {
      font-family: Marksimon;
      font-size: 18px !important;
    }
  </style>
  <!-- <a href="<?php echo $baseurl; ?>/my-groups" class="previous-btn">&laquo; Group Home</a> -->
  <div class="left_grid left_group_gr " style="height : 270px;"><br>


    <?php if (isset($_GET['groupname'])) { ?>
      <?php if ($admin_Id == $_SESSION['pid']) { ?>
        <div class="dropdown">
          <button class="btn dropdown-toggle pull-right bg-white" type="button" id="menu1" data-toggle="dropdown" style="margin-top: -10px;">
            <span class="pull-right "><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/cog.png" class="img-responsive" alt=""></span>
          </button>
          <ul class="dropdown-menu pull-right mr-30" role="menu" aria-labelledby="menu1">
            <li role="presentation" style="margin-left:-5px;" class="<?php if ($row['spgroupflag'] == 1) {
                                                                        echo "active_drp";
                                                                      } ?>"><a role="menuitem" class="Group_status_private" data-id="<?php echo $row['idspGroup']; ?>" href="javascript:void(0);">
                <i class="fa fa-lock" aria-hidden="true" style="margin-left:-1px;"></i>&nbsp;&nbsp;Private</a></li>
            <li role="presentation" style="margin-left:-5px;" class="<?php if ($row['spgroupflag'] != 1) {
                                                                        echo "active_drp";
                                                                      } ?>"><a role="menuitem" class="Group_status_public" data-id="<?php echo $row['idspGroup']; ?>" href="javascript:void(0);"><i class="fa fa-users" aria-hidden="true" style="margin-left:0px;"></i>&nbsp;Public</a></li>

            <li role="presentation" style="margin-left:-5px;" data-toggle="modal" data-target="#StorebannerUpload"><a role="menuitem" data-id="<?php echo $row['idspGroup']; ?>" href="javascript:void(0);" class="" onclick="popp()"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;Settings</a></li>

            <li role="presentation" style="margin-left:-5px;"><a role="menuitem" data-id="<?php echo $row['idspGroup']; ?>" href="javascript:void(0);" class="Group_delete"><i class="fa fa-trash" aria-hidden="true"></i>&nbsp;&nbsp;Delete</a></li>

          </ul>
        </div>

      <?php  } ?>
      <style>
        .myclass {
          white-space: nowrap;

          overflow: hidden;
          text-overflow: ellipsis;
        }

        .left_grid ul li {

          margin-left: 0px;
        }

        .no_margin {
          word-wrap: break-word;
        }
      </style>



      <p class="no_margin 555 myclass" style="font-weight: bold;font-size: 17px;color: #202548;"><?php echo ucwords(strtolower($_GET['groupname'])); ?></p>

      <?php
      $p = new _spgroup;
      $res_1 = $p->get_spflage($group_id);
      if ($res_1) {
        $row_1 = mysqli_fetch_assoc($res_1);
      }

      if ($row_1['spgroupflag'] == 1) {
        echo '<h6><i class="fa fa-lock"></i> Private</h6>';
      } else {
        echo '<h6><i class="fa fa-globe"></i> Public</h6>';
      } ?> <?php
          } ?>

    <ul>


      <li><a href="javascript:void(0);">
          <?php
          if ($admin_profile != "") { ?>
            <img style="height: 30px;width: 30px;" src="<?php echo $admin_profile; ?>" class="img-circle img_posting_absolut" alt="admin" />

          <?php } else {
          ?>
            <img style="" src="<?php echo $BaseUrl; ?>/assets/images/icon/group/profileicons.png" class="img-responsive " alt="admin" />
          <?php } ?>
          <a href="<?php echo $BaseUrl . '/friends/?profileid=' . $admin_Id; ?>">
            <p style="white-space: nowrap; width: 130px; overflow: hidden; text-overflow: ellipsis;" class="top_margin text_size1"><?php echo ucfirst($admin_Name); ?></p><small><?php if ($admin_ptype == 1) {                                                                                                                                                   echo "Business Profile";                                                                                                                                                                          } ?>(Admin)</small>
          </a></a></br></br>

        <!-- <small style="color:dark black;"><b>Group Created &nbsp;&nbsp; </b></small>   <span><?php echo $create_date111; ?></span>-->

      </li>


      <li <?php if (isset($_GET['members'])) {
            echo "class='active_group'";
          } ?>>
        <a href="<?php echo $BaseUrl ?>/grouptimelines/member.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&members&tab=allmemder">
          <img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/members_icon_enable.png" class="img-responsive" alt="" />
          <?php

          $getPendingMembers = $g->joinedMembersOfGroup($group_id);

          if ($getPendingMembers != false) {
            $pendCounter = mysqli_num_rows($getPendingMembers);

            if ($pendCounter > 0) {
          ?>
              <p>Members <span>(<?php echo $pendCounter; ?>)</span></p>
        </a>
      <?php
            } else { ?>
        <p>0 Members</p></a>

    <?php }
          } else {

            echo " <p>0 Members</p></a>";
          } ?>
    </a>




    <?php

    if (empty($profile_exist)) {


      if (isset($user_profiles_list) && is_array($user_profiles_list) && in_array($admin_Id, $user_profiles_list)) {

        if (!in_array($_SESSION['pid'], $user_profiles_list)) {


    ?>
      <li class="join_timeline_main">
        <button class="join_timeline btn view_right_joinbtn" style="float: left;padding-left: 30px!important;padding-right: 30px!important;margin-left: 28px;width: 90px;" data-pid="<?php echo $_SESSION['pid'] ?>" data-gid="<?php echo $group_id ?>" id="addmemontimeline">
          Join


        </button>
      </li>





    <?php }
      } else {

        // print_r($_SESSION['pid']);
        // echo'fffffffffff';
        // 
    ?>


    <li class="join_timeline_main">
      <button class="join_timeline btn view_right_joinbtn" style="float: left;margin-left: 28px;width: 100px; margin-top: 22px;" data-pid="<?php echo $_SESSION['pid'] ?>" data-gid="<?php echo $group_id ?>" id="addmemontimeline">
        Request to Join
      </button>
    </li>
  <?php } ?>



<?php
    } else if (!empty($profile_exist) &&  $approve == 0) {

      // echo "hello";


?>

  <li class="join_timeline_main"><button class="join_timeline  btn view_right_joinbtn cancelreq" style=" float: left;margin-left:27px;width: 100px;margin-top:20px;" data-pid="<?php echo $_SESSION['pid'] ?>" data-gid="<?php echo $group_id ?>" onclick="CancelRequ(<?php echo $_SESSION['pid'] ?>,<?php echo $group_id ?>)" id="">Cancel Request</button></li>


  <?php
    } else {
      //  echo'fffffffffff';


  ?><?php

      if ($admin_Id == $_SESSION['pid']) {
    ?>

  <li><a href="<?php echo $BaseUrl ?>/grouptimelines/group_notification.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&notification"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/notifiction.png" class="img-responsive" alt="" />
      <?php
        $getPendingMembers_1 = $g->pendingRequestsOfGroup($group_id);

        if ($getPendingMembers_1 != false) {
          $pendCounter_1 = mysqli_fetch_assoc($getPendingMembers_1);
          //echo $g->ta->sql; die("");
          //print_r($pendCounter); 
          $pendCounter_1 = $pendCounter_1['pendingMembers'];
          if ($pendCounter_1 > 0) {
      ?>
          <p class="text_size1">Notifications <span>(<?php echo $pendCounter_1; ?>)</span></p>
    </a></li>
<?php
          } else { ?>
  <p class="text_size1">Notifications</p></a></li>
<?php }
        }
      }
    }
?>






    </ul>
  </div>





  <?php if (!empty($profile_exist) &&  $approve == 1) { ?>
    <div class="topstatus timeline-topstatus right_sidebar top_margin" style="background:darkblue !important;">

      <div class="left_grid left_group_gr">
        <ul>
          <li <?php if (isset($_GET['timeline'])) {
                echo "class='active_group'";
              } ?>><a href="<?php echo $BaseUrl ?>/grouptimelines/?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&timeline&page=1"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/timeline_icon_enable.png" class="img-responsive" alt="" />
              <p>Timeline</p>
            </a></li>

          <?php
          $g = new _spgroup;
          $result = $g->pendingRequests($group_id);
          if ($result != false) {
            $row1 = mysqli_fetch_assoc($result);
            //print_r($pendCounter); 
            $spProfiles_idspProfiles = $row1['spProfiles_idspProfiles'];
          }

          if ($spProfiles_idspProfiles == $_SESSION['pid']) {

            $p = new _spgroup;
            $res_1 = $p->get_spflage($group_id);
            if ($res_1) {
              $row_1 = mysqli_fetch_assoc($res_1);
            }

            if ($row_1['spgroupflag'] == 1) {
            } else {


          ?>


              <li <?php if (isset($_GET['pendingtimeline'])) {
                    echo "class='active_group'";
                  } ?>><a href="<?php echo $BaseUrl ?>/grouptimelines/?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&pendingtimeline"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/timeline_icon_enable.png" class="img-responsive" alt="" />
                  <p>Pending Timeline</p>
                </a></li>

          <?php }
          } ?>


          <li <?php if (isset($_GET['members'])) {
                echo "class='active_group'";
              } ?>>
            <a href="<?php echo $BaseUrl ?>/grouptimelines/member.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&members&tab=allmemder"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/members_icon_enable.png" class="img-responsive" alt="" />
              <?php
              $getPendingMembers = $g->joinedMembersOfGroup($group_id);
              if ($getPendingMembers != false) {
                $pendCounter = mysqli_num_rows($getPendingMembers);
                // $pendCounter = $pendCounter['pendingMembers'];
                if ($pendCounter > 0) {
              ?>
                  <p>Members <span>(<?php echo $pendCounter; ?>)</span></p>
            </a></p>
          <?php
                } else { ?>
            <p>Members</p></a></p>
        <?php }
              } ?>
        </a>
          </li>
          <?php
          if ($admin_Id == $_SESSION['pid']) {
          ?>
            
            <li <?php if (isset($_GET['emailCampaigns'])) {
                  echo "class='active_group'";
                } ?>><a href="<?php echo $BaseUrl ?>/grouptimelines/addEmail.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&emailCampaigns"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/emailcamp_icon_enable.png" class="img-responsive" alt="" />
                <p>Email Campaigns</p>
              </a></li>

          <?php
          }
          ?>

  
          <li <?php if (isset($_GET['direct'])) {
                echo "class='active_group'";
              } ?>>
            <a href="<?php echo $BaseUrl ?>/grouptimelines/pending-member.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?> &tab=allmemder&direct=pendingmemder"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/members_icon_enable.png" class="img-responsive" alt="" />

              <?php

              //COMMENTED TO DEBUG THE CODE ISSUE - GANESH

             /* $pid = $_SESSION['pid'];

              $obj2 = new _spAllStoreForm;
              $ress2 = $obj2->readdatabymulid_assitant($getid, $pid);

              $g = new _spgroup;

              $result_grp_admin = $g->readgroupAdmin($_POST["spPostingVisibility"]);

              if ($result_grp_admin != false) {
                $row_grp_admin = mysqli_fetch_assoc($result_grp_admin);
                $admin_Id = $row_grp_admin['idspProfiles'];
              }


              if ($pid == $admin_Id or $ress2 == true) {
   
                $rpvtt = $p->members_pending($getid);
                $notapprove = 0;
                if ($rpvtt != false) {
                  $i = 0;
                  while ($row = mysqli_fetch_assoc($rpvtt)) {
                    $notapprove++;
                  }
                }
                
             } */

             ?>


                <p>Pending Members<span>(<?php echo $notapprove; ?>)</span></p>
            </a>
          </li>

         <li <?php if (isset($_GET['disc'])) {
              echo "class='active_group'";
            } ?>><a href="<?php echo $BaseUrl ?>/grouptimelines/discussion-board.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&disc"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/discussionboard_icon_enable.png" class="img-responsive" alt="" />
            <p>Discussion Board</p>
          </a></li> 
         <li <?php if (isset($_GET['photo'])) {
              echo "class='active_group'";
            } ?>><a href="<?php echo $BaseUrl ?>/grouptimelines/group-photo.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&photo"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/photos_icon_enable.png" class="img-responsive" alt="" />
            <p>Photos</p>
          </a></li> 
        <li <?php if (isset($_GET['announcement'])) {
              echo "class='active_group'";
            } ?>><a href="<?php echo $BaseUrl ?>/grouptimelines/group-announcement.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&announcement"><img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSu-U-eqKGofLNmM6z6_1G1KCPddGX63rwOSg&usqp=CAU" class="img-responsive" alt="" />
            <p>Announcement</p>
          </a></li>

         <li <?php if (isset($_GET['video'])) {
              echo "class='active_group'";
            } ?>><a href="<?php echo $BaseUrl ?>/grouptimelines/group-video.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&video"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/videos_icon__enable.png" class="img-responsive" alt="" />
            <p>Videos</p>
          </a></li> 

         <li id="event-pr" <?php if (isset($_GET['event'])) {
                            echo "class='active_group'";
                          } ?>><a href="<?php echo $BaseUrl ?>/grouptimelines/group-event.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&event"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/events_icon_enable.png" class="img-responsive" alt="" />
            <p>
              Events
              <span class="caret"></span>
            </p>
          </a></li>


        <style>
          .eve-hd {
            display: none;
          }
        </style>
        <?php
        $_SERVER['REQUEST_URI'];
        $parts = parse_url($_SERVER['REQUEST_URI']);
        // print_r($parts);
        parse_str($parts['query'], $query);
        if (isset($parts['path']) && ($parts['path'] == '/grouptimelines/group-event.php' || $parts['path'] == '/grouptimelines/group-sponsorlist.php'
          || $parts['path'] == '/grouptimelines/group-bookedevent.php' || $parts['path'] == '/grouptimelines/group-activeevent.php' || $parts['path'] == '/grouptimelines/group-pastevent.php')) {
        ?>
          <ul class="event-child" style="padding-left: 15px;">
            <?php
            if ($adminprofileid == $_SESSION['pid']) {
            ?>

              <li <?php if (isset($_GET['sponsor'])) {
                    echo "class='active_group'";
                  } ?>>
                <a href="<?php echo $BaseUrl ?>/grouptimelines/group-sponsorlist.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&sponsor"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/sponsor.png" class="img-responsive" alt="" />
                  <p>Sponsor</p>
                </a>
              </li>

              <li <?php if (isset($_GET['bookedevent'])) {
                    echo "class='active_group'";
                  } ?>>
                <a href="<?php echo $BaseUrl ?>/grouptimelines/group-bookedevent.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&bookedevent"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/booked-event.png" class="img-responsive" alt="" />
                  <p>Booked Event</p>
                </a>
              </li>

            <?php } ?>

            <li <?php if (isset($_GET['activeevents'])) {
                  //echo($_GET['activeevents']);die('aaaaaa');
                  echo "class='active_group'";
                } ?>>
              <a href="<?php echo $BaseUrl ?>/grouptimelines/group-activeevent.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&activeevents"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/event-history.png" class="img-responsive" alt="" />
                <p>Active Events</p>
              </a>
            </li>

            <li <?php if (isset($_GET['pastevents'])) {
                  echo "class='active_group'";
                } ?>>
              <a href="<?php echo $BaseUrl ?>/grouptimelines/group-pastevent.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&pastevents"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/home/classified-ads.png" class="img-responsive" alt="" />
                <p>Past Events</p>
              </a>
            </li>
          </ul>
        <?php
        }
        ?>





        <li <?php if (isset($_GET['files'])) {
              echo "class='active_group'";
            } ?>><a href="<?php echo $BaseUrl ?>/grouptimelines/group-folder.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&files&page=1"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/files_icon_enable.png" class="img-responsive" alt="" />
            <p>Files</p>
          </a></li>

         <li <?php if (isset($_GET['store'])) {
              echo "class='active_group'";
            } ?>><a href="<?php echo $BaseUrl ?>/grouptimelines/group-store.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&store"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/stores_icon_enable.png" class="img-responsive" alt="" />
            <p>Store</p>
          </a></li> 
        <li <?php if (isset($_GET['about'])) {
              echo "class='active_group'";
            } ?>><a href="<?php echo $BaseUrl ?>/grouptimelines/about.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&about"><img src="<?php echo $BaseUrl; ?>/assets/images/icon/group/about_icon_enable.png" class="img-responsive" alt="" />
            <p>About</p>
          </a></li>
        <?php if ($admin_Id == $_SESSION['pid']) { ?>
          <li <?php if (isset($_GET['setting'])) {
                echo "class='active_group'";
              } ?>><a href="<?php echo $BaseUrl ?>/grouptimelines/group-setting.php?groupid=<?php echo $group_id ?>&groupname=<?php echo $_GET['groupname']; ?>&setting"><img src="<?php echo $BaseUrl; ?>/assets/images/inner_group/setting-2.svg" class="img-responsive" alt="" />
              <p>Setting</p>
            </a></li>
        </ul>
      <?php  } ?>

      </div>
    </div>

  <?php } ?>
  
</div>
<div id="StorebannerUpload" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <form id="address" action="uploadgroupbanner.php" method="post" enctype="multipart/form-data">
      <div class="modal-content sharestorepos bradius-15" style="width: 800px;">
        <div class="modal-header br_radius_top bg-white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Group Settings For <?php echo $_GET['groupname'] ?></h4>
        </div>

        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <h4>Group Name (Max 25 Character allowed ) <span style="color:red; font-size:12px">*</span></h4>
              <div id=""></div>
              <input type="hidden" name="gname" value="<?php echo $_GET['groupname']; ?>">
              <input type="text" id="gname" maxlength="25" name="gname" onkeyup="clearerror();" value="<?php echo $_GET['groupname']; ?>" class="form-control " required>
              <span style="color:red; font-size:12px" id="msg1"></span>
            </div>


          </div>



          <div class="row">
            <div class="col-md-6">



              <input type="text" onkeyup="clearerror();" class="form-control bradius-10" id="spgroupLocation" name="spgroupLocation" value="<?php echo $spgroupLocation; ?>"  />

              <?php
              //$p = new _spuser

              $res = $g->read($group_id);
              if ($res != false) {

                $ruser = mysqli_fetch_assoc($res);

                $spUserCountry = $ruser["spUserCountry"];
                $spUserState = $ruser["spUserState"];
                $spUserCity = $ruser["spUserCity"];
                $address = $ruser["address"];
                $zipcode = $ruser["zipcode"];
                $spgroupflag1 = $ruser["spgroupflag"];
                $spGroupAbout = $ruser["spGroupAbout"];
                //print_r($ruser);
                //echo $spUserCity;
                //die('==');
              }
              //die('===');            




              ?>

              <input type="hidden" name="profile_Id" value="<?php echo $_SESSION['pid']; ?>">
              <input type="hidden" name="user_Id" value="<?php echo $_SESSION['uid']; ?>">
              <div class="form-group">

                <label for="spProfilesCountry" class="add_shippinglabel">
                  <h4 style="color:#333333">Country <span style="font-size:12px" class="red">*</span></h4>
                </label>
                <select id="spUserCountry_default_address" class="form-control " name="spUserCountry" required>
                  <option value="0">Select Country</option>
                  <?php
                  $co = new _country;
                  $result3 = $co->readCountry();
                  if ($result3 != false) {
                    while ($row3 = mysqli_fetch_assoc($result3)) {
                  ?>
                      <option value='<?php echo $row3['country_id']; ?>' <?php echo (isset($spUserCountry) && $spUserCountry == $row3['country_id']) ? 'selected' : ''; ?>>
                        <?php echo $row3['country_title']; ?>
                      </option>
                  <?php
                    }
                  }
                  ?>
                </select>
                <span style="font-size:12px" class="red" id="msg2"></span>
                <span id="shippcounrty_error" style="color:red;"></span>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <div class="loadUserState">
                  <label for="spUserState" class="add_shippinglabel">
                    <h4 style="color:#333333">State <span style="font-size:12px" class="red">*</span></h4>
                  </label>
                  <select class="form-control" name="spUserState" id="spUserState" required>
                    <option value="0">Select State</option>
                    <?php
                    //echo $spUserState; die('');
                    // if (isset($spUserState) && $spUserState > 0) {
                    $pr = new _state;
                    $result2 = $pr->readState($spUserCountry);
                    if ($result2 != false) {
                      while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                        <option value='<?php echo $row2["state_id"]; ?>' <?php echo (isset($spUserState) && $spUserState == $row2["state_id"]) ? 'selected' : ''; ?>><?php echo $row2["state_title"]; ?> </option>
                    <?php
                      }
                    }
                    //  }
                    ?>
                  </select><span style="font-size:12px" class="red" id="msg3"></span>
                  <span id="shippstate_error" style="color:red;"></span>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <div class="loadCity">
                  <label class="add_shippinglabel" for="spUserCity">
                    <h4 style="color:#333333">City <span style="font-size:12px" class="red">*</span></h4>
                  </label>
                  <!--<input type="text" class="form-control" name="city" id="shipp_city">-->
                  <select class="form-control" name="spUserCity" id="spUserCity" required>
                    <option value="0">Select City</option>
                    <?php
                    //    if (isset($usercity) && $usercity > 0) {
                    $co = new _city;
                    $result3 = $co->readCity($spUserState);
                    if ($result3 != false) {
                      while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                        <option value='<?php echo $row3['city_id']; ?>' <?php echo (isset($spUserCity) && $spUserCity == $row3['city_id']) ? 'selected' : ''; ?>><?php echo $row3['city_title']; ?></option> <?php
                                                                                                                                                                                                            }
                                                                                                                                                                                                          }
                                                                                                                                                                                                          //    } 
                                                                                                                                                                                                              ?>
                  </select>
                  <span style="font-size:12px" class="red" id="msg4"></span>
                  <span id="shippcity_error" style="color:red;"></span>
                </div>
              </div>
            </div>
            <div class="col-md-6">
<div class="form-group">
<label class="add_shippinglabel" for="shipp_address">
<h4 style="color:#333333">Address <span style="color:red;font-size:12px">*</span></h4><span class="red"></span>
</label>


<input class="form-control" type="text" id="shipp_address" value="<?php
                                                                  echo (isset($address) && !empty($address)) ? $address : ''; ?>" name="address" autocomplete="off" required />
<span style="color:red;font-size:12px" id="msg5"></span>
<span id="shippaddress_error" style="color:red;"></span>
</div>
</div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label class="add_shippinglabel" for="shipp_zipcode">
                  <h4 style="color:#333333">Zipcode (Max 6 Characters) <span style="color:red;font-size:12px">*</span></h4>
                </label>
                <!--maxlength="6"-->
                <input type="text" class="form-control" maxlength="8" placeholder="6 digits [0-9] zipcode" name="zipcode" id="shipp_zipcode" value="<?php echo $zipcode; ?>" required>
                <span style="color:red;font-size:12px" id="msg6"></span>
                <span id="shippzipcode_error" style="color:red;"></span>
              </div>
            </div>


            <div class="col-md-6">
              <h4>Select Privacy</h4>
              <div id=""></div>


              <div class="form-control bg_gray_light no-radius ">
                <div class="row">
                  <div class="col-md-4">
                    <label class="checkbox-inline"><input type="radio" id="spgroupflag" style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="0" <?php if ($spgroupflag1 == 0) {                                                                                                                                                                                                 echo "checked";                                                                                                                                                                                                } ?>>Public</label>
                  </div>
                  <div class="col-md-4">
                    <label class="checkbox-inline"><input type="radio" id="spgroupflag" style="    margin-bottom: 2px;" onclick="clearerror();" name="spgroupflag" class="groupflag" value="1" <?php if ($spgroupflag1 == 1) {                                                                                                                                                                                                  echo "checked";                                                                                                                                                                                                } ?>>Private</label>
                  </div>

                </div>
              </div>
            </div>

          </div>

          <div class="row">
            <div class="col-md-6">
              <input type="hidden" name="groupid" value="<?= $group_id; ?>">
              <h4>Short Description (Max 50 words) <span style="color:red;font-size:12px">*</span></h4>
              <div id=""></div>


              <input type="text" class="form-control " id="spGroupTagline" name="spGroupTag" maxlength="50" value="<?php echo $row['spGroupTagline']; ?>" required>
              <span style="color:red;font-size:12px" id="msg7"></span>
            </div>

            <div class="col-md-6">
              <h4>Group Category <span style="color:red;font-size:12px">*</span></h4>
              <div id=""></div>


              <select class="form-control " onclick="clearerror();" id="grpcategory" name="spgroupCategory" required>
                <option value="<?php echo $id; ?>">Select Category </option>

                <?php
                $g = new _spgroup;
                $result = $g->groupdetails($group_id);
                //echo $g->ta->sql;die;
                if ($result != false) {
                  $row = mysqli_fetch_assoc($result);
                  $spgroupCategory = $row['spgroupCategory'];
                }
                // echo $spgroupCategory.'===================================';

                $sql =  "SELECT * FROM `group_category` WHERE `status` = 0 ";


                $result = mysqli_query($dbConn, $sql);
                //var_dump($result);
                if ($result) {
                  while ($rows = mysqli_fetch_assoc($result)) {
                    //print_r($rows);die('===');
                ?>
                    <?php echo $spgroupCategory;
                    ?>
                    <option value='<?php echo $rows['id']; ?>' <?php if ($spgroupCategory == $rows["id"]) {
                                                                  echo "selected";
                                                                } ?>>
                      <?php echo $rows["group_category_name"]; ?>
                    </option>


                <?php
                  }
                }
                ?>

              </select>
              <span style="color:red;font-size:12px" id="msg8"></span>
            </div>
          </div>



          <div class="row">
            <div class="col-md-12">
              <h4>Description <span style="color:red;font-size:12px">*</span></h4>
              <div id=""></div>


              <textarea onkeyup="clearerror();" class="form-control " id="spGroupAbout" name="spGroupAbout" required>

<?php
echo $spGroupAbout;
?>

</textarea>
              <span style="color:red;font-size:12px" id="msg9"></span>
            </div>


          </div>
          <div class="row">
            <div class="col-md-6">
              <h4>Choose your banner <span style="color:red;font-size:12px" id="msg10">*</span></h4>
              <div id=""></div>

              <?php //echo  $bannerfile.'---------';
              ?>

              <input type="file" name="bannerfile" onchange="readURL(this);" class="basestorebanner" id="basestorebannerid" style="display: block;" />
              <input type="hidden" id="spProfileId" value="<?php echo  $profileId; ?>">



              <input type="hidden" id="spuserId" value="<?php echo $spUserid; ?>">
              <input type="hidden" id="sgroupid" value="<?php echo $group_id ?>">
              <span id="bannerfile_error" class="red"></span>

            </div>

            <?php
            $g = new _spgroup;
            $result = $g->groupdetails($group_id);
            // echo $g->ta->sql;die;
            if ($result != false) {
              $row = mysqli_fetch_assoc($result);

              $bannerpicture = $row["spgroupimage"];
            }

            ?>




            <div class="col-md-6">

              <!-- <input type="file" onchange="readURL(this);" />
        <img id="blah" src="#" alt="your image" /> -->

              <h4>Your selected banner will appear here...</h4>
              <div id="bannerresults" style="width: 100%; height: 200px;overflow: hidden;">
                <?php if ($bannerpicture) { ?>
                  <img id="profilepic" data-media="<?php echo (isset($bannerpicture) ? "1" : "0"); ?>" src="<?php echo $BaseUrl; ?>/uploadimage/<?php echo $bannerpicture; ?>" alt="Profile Pic22" class="img-responsive" style="width: 100%;">
                <?php } else { ?>
                  <img id="profilepic" data-media="<?php echo (isset($bannerpicture) ? "1" : "0"); ?>" src="<?php echo $BaseUrl; ?>/assets/images/bg/top_banner.jpg " alt="Profile Pic22" class="img-responsive" style="width: 100%;height:175px;">

                <?php } ?>
              </div>
            </div>

          </div>

          <div class="modal-footer bg-white br_radius_bottom">


            <button type="button" class="btn btn-danger  btn-border-radius" style="   padding-top: 5px!important;
padding-bottom: 7px!important; " data-dismiss="modal">Close</button>

            <button type="submit" class="btn btn-primary  btn-border-radius" id="update3" style="">Update </button>
          </div>
        </div>
      </div>
    </form>
  </div>
</div>

<script src="<?php echo $baseurl ?>/assets/js/sweetalert.js"></script>
<script type="text/javascript">
  $(".Group_delete").on("click", function() {
    //alert('okkk');
    var groupid = $(this).attr("data-id");
    // alert(groupid);

    var flag = 1;
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.get("../my-groups/deletegroup.php", {
          groupid: groupid
        }, function(data) {
          //console.log(data);
          window.location = '../my-groups';

        });
        $(".groupdiv_" + groupid).html("");

      }
    })
  });


  $(".Group_status_private").on("click", function() {
    var groupid = $(this).attr("data-id");
    var type = 1;
    //alert(groupid);
    /* alert(postid);*/
    var flag = 1;
    Swal.fire({
      title: 'Are you sure?',
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Make It Private!'
    }).then((result) => {
      if (result.isConfirmed) {
        $.get("../my-groups/updategrouptype.php", {
          groupid: groupid,
          type: type
        }, function(data) {
          //console.log(data);
          window.location.reload();
        });
        $(".groupdiv_" + groupid).html("");

      }
    })
  });


  $(".Group_status_public").on("click", function() {
    var groupid = $(this).attr("data-id");
    var type = 0;
    //alert(groupid);
    /* alert(postid);*/
    var flag = 1;
    Swal.fire({
      title: 'Are you sure?',
      text: "",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, Change to Public !'
    }).then((result) => {
      if (result.isConfirmed) {
        $.get("../my-groups/updategrouptype.php", {
          groupid: groupid,
          type: type
        }, function(data) {
          //console.log(data);
          window.location.reload();
        });
        $(".groupdiv_" + groupid).html("");

      }
    })
  });


  $(".Group_status_public1111111").on("click", function() {
    var groupid = $(this).attr("data-id");
    var type = 0;
    /*alert(groupid);*/
    /* alert(postid);*/
    var flag = 1;
    swal({
        title: "Make this group Public?",
        type: "warning",
        confirmButtonClass: "sweet_ok",
        confirmButtonText: "Yes",
        cancelButtonClass: "sweet_cancel",
        cancelButtonText: "No",
        showCancelButton: true,
      },
      function(isConfirm) {
        if (isConfirm) {
          $.get("../my-groups/updategrouptype.php", {
            groupid: groupid,
            type: type
          }, function(data) {
            //console.log(data);
            window.location.reload();
          });
          $(".groupdiv_" + groupid).html("");
          /* $(".groupdiv_"+postid).removeClass('searchable');
          $(".deldiv_"+postid).removeClass('post_timeline');*/
        }
      });
  });

  function popp() {
    // $("#edit_group").click();
  }
  /*
  $("#event-pr").hover(function() {
  alert("here");
  ("#event-child").toggleClass("eve-hd");
  });
  */
</script>
<?php
if (isset($_POST['submit'])) {
  $date = $_POST['date'];
  $title = $_POST['title'];
  $texarea = $_POST['textarea'];
  $groupid = $group_id;
  $crent = date("Y-m-d");
  $data = array(
    'announcemt_date' => $date,
    'title' => $title,
    'message' => $texarea,
    'group_id' => $groupid,
    'user_id' => $_SESSION['uid'],
    'profile_id' => $_SESSION['pid'],
    'date' => $crent

  );

  $obj =  new _groupsponsor;
  $obj->create22($data);
}

?>

<script>
  function readURL(input) {

    if (input.files && input.files[0]) {
      var reader = new FileReader();

      reader.onload = function(e) {
        $('#blah').attr('src', e.target.result);
      }

      reader.readAsDataURL(input.files[0]);
    }
  }
</script>
<script>
  function CancelRequ(pid, gid) {
    //alert(pid);
    $.ajax({
      method: "POST",
      url: "../my-groups/cancel_join.php",
      data: {
        'pid': pid,
        'gid': gid
      },
      cache: false,
      success: function(data) {
        location.reload();
      },
    });

  }
</script>
<script>
  document.getElementById("basestorebannerid").addEventListener("change", function() {
    var file = this.files[0];
    var fileExtension = file.name.split('.').pop().toLowerCase();
    var allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'tif', 'tiff', 'bmp', 'svg', 'webp', 'heic', 'heif'];

    if (!allowedExtensions.includes(fileExtension)) {
      document.getElementById("bannerfile_error").innerHTML = "Please select a valid image file.";
      this.value = ''; // Clear the selected file
    } else {
      document.getElementById("bannerfile_error").innerHTML = "";
    }
  });
</script>