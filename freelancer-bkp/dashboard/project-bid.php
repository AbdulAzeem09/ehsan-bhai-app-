<?php
include('../../univ/baseurl.php');
session_start();
if (!isset($_SESSION['pid'])) {

$_SESSION['afterlogin'] = "freelancer/";
include_once ("../../authentication/islogin.php");
} else {

function sp_autoloader($class) {
include '../../mlayer/' . $class . '.class.php';
}

spl_autoload_register("sp_autoloader");

//$p = new _postingview;

$sf = new _freelancerposting;

$fps = new _freelance_project_status;

$r = new _redirect;

$res = $sf->singletimelines1($_GET['postid']);

//echo $p->ta->sql;
if ($res) {
$row = mysqli_fetch_assoc($res);
if ($_SESSION['pid'] != $row['idspProfiles']) {

// $url = $r->redirect($BaseUrl.'/freelancer/dashboard/active-bid.php');
}
$title = $row['spPostingtitle'];
} else {
// $url = $r->redirect($BaseUrl.'/freelancer/dashboard/active-bid.php');
}
$activePage = 18;
//echo $_SESSION["uid"]; exit;
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
<?php include('../../component/f_links.php'); ?>
<!--This script for posting timeline data End-->

<!-- ===== INPAGE SCRIPTS====== -->
<?php include('../../component/dashboard-link.php'); ?>
<!-- Morris chart -->
<link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl ?>/assets/css/design.css">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
</head>

<body class="bg_gray">
<?php
$header_select = "freelancers";
include_once("../../header.php");
?>
<section class="main_box" id="freelancers-page">
    <div class="container nopadding projectslist dashboardpage">
        <div class="sidebar col-xs-3 col-sm-3" id="sidebar" >
<?php include('left-menu.php'); ?>
        </div>
        <div class="col-xs-12 col-sm-6 nopadding   111">

            <div class="col-md-12 nopadding dashboard-section" style="margin-top: 24px;">
                <div class="col-xs-12 dashboardbreadcrum">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo $BaseUrl; ?>/freelancer/dashboard/poster_dashboard.php">Dashboard</a></li>
                        <li><a href="<?php echo $BaseUrl; ?>/freelancer/dashboard/active-bid.php">Active Projects</a></li>
                        <li>Detail </li>

                    </ul>

                </div>
                
            </div>
            


            <!--  <div class="col-md-12 nopadding dashboard-section freelancer_dashboard">
                 <div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
                     <ul class="breadcrumb freelancer_dashboard">
                       <li><a href="<?php //echo $BaseUrl; ?>/freelancer/dashboard/">Dashboard</a></li>
                       <li><a href="<?php //echo $BaseUrl; ?>/freelancer/dashboard/active-bid.php">Active Bids</a></li>
                       <li><?php //echo $title; ?></li>
                     </ul>
                 </div>
             </div> -->
            <div class="col-xs-12 nopadding dashboard-section">

                <div class="">
<?php
//$p = new _postingview;
$sf = new _freelancerposting;
$sp = new _spprofiles;
// $res = $p->singletimelines($_GET['postid']);
$res = $sf->singletimelines1($_GET['postid']);

//echo $p->ta->sql;
$row = array();
$row5 = array();
// $profilesname = array();
// echo $sf->ta->sql;
//echo $p->ta->sql;
if ($res) {
$row = mysqli_fetch_assoc($res);
//echo $_SESSION["pid"];
//echo "<pre>"; print_r($row); exit;
$title = $row['spPostingTitle'];
$overview = $row['spPostingNotes'];

$price = $row['spPostingPrice'];
$dt = new DateTime($row['spPostingDate']);
$member = new DateTime($row['spProfileSubscriptionDate']);
$clientId = $row['idspProfiles'];

//$pf = new _postfield;
$result_pf = $sf->read1($row['idspPostings']);

$get_profile = $sp->get_user_id($row['spProfiles_idspProfiles']);
//echo $sp->ta->sql;
$profilesname = mysqli_fetch_assoc($get_profile);

//echo "<pre>"; print_r($profilesname); exit;
//echo $pf->ta->sql."<br>";
if ($result_pf) {
$closingdate = "";
$Fixed = "";
$Category = "";
$hourly = "";
$skill = "";
$projectType = "";

while ($row22 = mysqli_fetch_assoc($result_pf)) {
    if ($closingdate == '') {
        //if($row2['spPostFieldName'] == 'spClosingDate_'){
        //$closingdate = $row2['spPostFieldValue']; 
        $closingdate = $row22['spPostingExpDt'];
        //}
    }
    /* if($Fixed == ''){
      if($row2['spPostFieldName'] == 'spPostingPriceFixed_'){
      if($row2['spPostFieldValue'] == 1){
      $Fixed = "Fixed";
      }
      }
      } */
    if ($Fixed == '') {

        if ($row22['spPostingPriceFixed'] == 1) {
            $Fixed = "Fixed Rate";
        } else {
            $hourly = "Hourly Rate";
        }
    }
    if ($Category == '') {
        /* if($row2['spPostFieldName'] == 'spPostingCategory_'){
          $Category = $row2['spPostFieldValue'];
          } */
        $Category = $row22['spPostingCategory'];
    }
    /* if($hourly == ''){
      if($row2['spPostFieldName'] == 'spPostingPriceHourly_'){
      if($row2['spPostFieldValue'] == 1){
      $hourly = "Rate Per hour";
      }
      }
      } */
    if ($skill == '') {
        /* if($row2['spPostFieldName'] == 'spPostingSkill_'){
          $skill = explode(',', $row2['spPostFieldValue']);
          } */

        $skill = explode(',', $row22['spPostingSkill']);
    }
    if ($projectType == '') {
        if ($row2['spPostFieldName'] == 'spPostingProfiletype_') {
            $projectid = $row22['spPostFieldValue'];
        }
    }
}
$postingDate = $sf->get_timeago1($row["spPostingDate"]);
}
}
?>
                    <div class="col-xs-12 freelancer-post-detail">
                        <h2 class="designation-haeding freelancer_capitalize"><?php echo $title; ?>

                            <div style="font-size:15px;float:right">
                    <?php
                    if ($_SESSION["pid"] != $row['spProfiles_idspProfiles']) {
                        ?>

<?php echo $profilesname["spProfileName"]; ?>
                                    <br><a href="<?php echo $BaseUrl . '/business-directory/detail.php?business=' . $profilesname["idspProfiles"]; ?>" >Business Profile</a>
<?php if ($row['complete_status'] == 1) { ?>
                                        <br><span>Project - Close</span>
                                    <?php } else { ?>
                                        <br><span>Project - Open</span>
                                    <?php } ?>


                                <?php } ?>

                                <?php
                                $acceptpr = $fps->readAceptproject($_GET['postid']);

                                if ($acceptpr != FALSE) {
                                    if ($row['complete_status'] == 0) {
                                        ?>

                                        <?php if ($_SESSION['ptid'] != 2) { ?>

                                            <a class="btn btn-warning incomplete" style="float:right;color: #fff;" href="<?php echo $BaseUrl . '/freelancer/dashboard/complete_posted_project.php?status=2&postid=' . $_GET['postid']; ?>" >In Complete</a>&nbsp;&nbsp;
                                            <a class="btn btn-info complete" style="float:right;color: #fff;margin-right: 10px;" href="<?php echo $BaseUrl . '/freelancer/dashboard/complete_posted_project.php?status=1&postid=' . $_GET['postid']; ?>" >Complete</a>


                                        <?php } ?>  


                                    <?php
                                    } elseif ($row['complete_status'] == 1) {

                                        echo "<br><span style='font-size:15px;float:right;'>Project is Completed</span>";
                                    } else {

                                        echo "<br><span style='font-size:15px;float:right;'>In Completed</span>";
                                    }
                                }
                                ?>  



                            </div>



                        </h2>
                  <!--      <p class="timing-week"><?php // echo ($Fixed != '')? $Fixed: $hourly;?></p>   -->
                        <div class="col-xs-12 nopadding">
                                <?php
                                if (count($skill) > 0) {
                                    foreach ($skill as $key => $value) {
                                        if ($value != '') {
                                            echo "<span class='skills-tags freelancer_uppercase'>" . $value . "</span>";
                                        }
                                    }
                                }
                                ?>

                        </div>
                        <div class="col-xs-12 nopadding margin-top-13">
                            <div class="col-xs-12 col-sm-6 nopadding 2222">
                                <!--  <div class="col-xs-2 col-sm-1 nopadding">
                                     <img src="<?php echo $BaseUrl ?>/assets/images/freelancer/timer.png">
                                 </div> -->
                                <div class="col-xs-10 col-sm-11 nopadding">
                                    <p><span class="time-level">Category</span>
                                    </p>
                                    <p class="time-level-detail"><?php echo $Category; ?></p>

                                </div>
                            </div>

                            <div class="col-xs-12 col-sm-6 nopadding 3333">
                                <div class="">
                                <!--    <p>$<?php // echo $price;?></p> -->
                                </div>

                            </div>

                        </div>
                        <div class="col-xs-12 detail-description text-justify">
                            <p style=" word-break: break-all;"><?php echo $overview; ?></p>
                        </div>
                    </div>
                </div>
            </div>
<?php
$fm = new _freelance_milestone;
$result = $fm->readMymilestone($_GET['postid']);
//echo $fm->ta->sql;
if ($result) {
?>
                <h2>Milestone</h2>
                <div class="col-md-12 nopadding dashboard-section">
                    <div class="table-responsive dashboardtable" style="height: auto;">
                        <table class="table tbl_activebid text-left">
                            <thead>
                                <tr>
                                    <th>Freelancer Name</th>
                                    <th>Price</th>
                                    <th>Deliver Day</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                <?php
                $i = 1;
                while ($row3 = mysqli_fetch_assoc($result)) {
                    $d = new _spprofiles;

                    $MileStonePersonName = $d->getProfileName($row3['spProfiles_idspProfiles']);
                    ?>
                                    <tr>
                                        <td><a href="<?php echo $BaseUrl . '/freelancer/user-profile.php?profile=' . $row3['spProfiles_idspProfiles']; ?>" class="red"><?php echo $MileStonePersonName; ?></a></td>
                                        <td>$<?php echo $row3['milestonePrice']; ?></td>
                                        <td><?php echo $row3['milestoneDeliverDay']; ?></td>
                                        <td><?php echo $row3['milestoneDescription']; ?></td>
                                        <td>
<?php
if ($row3['milestoneStatus'] == 0) {
    echo "Pending";
    if ($i == 1) {
        ?>
                                                    <a href="<?php echo $BaseUrl . '/freelancer/dashboard/apv_milestone.php?milestone=' . $row3['id_milestone']; ?>" class="btn create_add"><i class="fa fa-check"></i></a>
                                            <?php
                                            $i++;
                                        }
                                    } else if ($row3['milestoneStatus'] == 1) {
                                        echo "Completed";
                                    }
                                    ?>
                                        </td>
                                    </tr>
<?php
}
?>

                            </tbody>
                        </table>
                    </div>
                </div>
                                        <?php
                                        //$post = new _postings;
                                        $sf = new _freelancerposting;
                                        $fpsss = new _freelance_project_status;

                                        // $result = $post->chkProjectStatus1($row['idspPostings']);
                                        //echo "<pre>"; print_r($row); exit;
                                        $result = $sf->chkProjectStatus1($row['idspPostings']);

                                        if ($result == false) {
                                            ?>
                    <!-- Modal -->
                    <div id="projectCancel" class="modal fade" role="dialog">
                        <div class="modal-dialog">
                            <!-- Modal content-->
                            <form method="post" action="project-status.php">
                                <div class="modal-content no-radius">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"><?php echo $row['spPostingTitle']; ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="spPosting_idspPostings" value="<?php echo $row['idspPostings']; ?>">
                                        <div class="row add_form_body">

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Description">Why cancel this project?</label>
                                                    <textarea name="txtCancelDescription" class="form-control"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" name="btnCancel">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="row no-margin text-right">
                        <a href="<?php echo $BaseUrl . '/freelancer/project-status.php?postid=' . $_GET['postid'] . '&action=complete'; ?>" class="btn create_add">Completed</a>
                        <a href="#" data-toggle="modal" data-target="#projectCancel" class="btn btn_freelancer">Canceled</a>
                    </div>
<?php
}
}

if ($_SESSION["pid"] == $row['spProfiles_idspProfiles']) {
// $post = new _postings;
$sf = new _freelancerposting;

$result = $sf->chkProjectStatus1($row['idspPostings']);

$result_status = $fps->getstatus($row['idspPostings']);

//echo "<pre>"; print_r($result_status); exit;													
//echo $fpsss->ta->sql;
$status_on_bid = mysqli_fetch_assoc($result_status);
//echo $status_on_bid['status'];
//echo "<pre>"; print_r($status_on_bid);
//exit;


if ($result == true) {
?>
                    <h2>Bids</h2>
                    <div class="col-md-12 nopadding dashboard-section">
                        <div class="col-xs-12 dashboardtable">
                            <!--  <div class="table-responsive"> -->
                            <div class="">

                                <table class="table text-center tbl_activebid">
                                    <thead>
                                        <tr>
                                            <th style="text-align: justify;">Freelancer Name</th>
                                            <th>Bids</th>
                                           <!--  <th>Upfront</th> -->
                                            <th>Days Delivered</th>
                                            <th>Chat</th>
                                           <!--  <th style="text-align: center;">Short List</th> -->
                                            <th class="action">Proposal</th>
                    <?php
                    if ($status_on_bid['status'] == 0 || $status_on_bid['status'] == 2 || $status_on_bid['status'] == 3) {
                        //echo $status_on_bid['status'];
                        ?>
                                                                                <!--		<th class="action">Cancel</th>  -->
                    <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                    <?php
                    //  $sf  = new _freelancerposting;
                    //$p = new _postfield;

                    if($_GET['sort']){
                        $srt=$_GET['sort'];
                        if($srt== 'lowestbid'){
                            $order= 'ORDER BY t.bidPrice ASC';
                        }
                         if($srt== ' highestbid'){
                            $order= ' ORDER BY t.bidPrice DESC';
                        }
                         if($srt== ' latestbid'){
                        $order= 'ORDER BY t.id DESC';
                        }
                         if($srt== ' oldbid'){
                    $order= 'ORDER BY t.id ASC';
                        }
                    }
else {
     $order= '';
}



                 $sf1 = new _freelance_placebid;

                    $res2 = $sf1->readallbids($_GET['postid'],$order);

                    //echo $sf->ta->sql;
                    // print_r($res);

                    if ($res2 == true) {

                        while ($row2 = mysqli_fetch_assoc($res2)) {
                            //get bid detail

                            $d = new _spprofiles;
                            $freelancerName = $d->getProfileName($row2['spProfiles_idspProfiles']);

                            //echo $bd->ta->sql;


                            if ($result_pf) {
                                $bidPrice = "";
                                $initialPercentage = "";
                                $totalDays = "";
                                $coment = "";
                                //chek if project is rejected
                                $result4 = $fps->chekProjectReject($_GET['postid']);
                                //chek project assign howa b ha ya ni
                                //$result5 = $fps->readFreelanceProject($_GET['postid']);
                                $result5 = $fps->readAceptid($_GET['postid']);

                                //echo $fps->ta->sql;
                                /* while($row2 = mysqli_fetch_assoc($result_pf)){ */

                                /* echo "<pre>";
                                  print_r($row2); */

                                if ($bidPrice == "") {
                                    /* if($row2['spPostFieldName'] == 'bidPrice'){ */
                                    $bidPrice = $row2['bidPrice'];
                                    /* } */
                                }

                                if ($initialPercentage == "") {
                                    /* if($row2['spPostFieldName'] == 'initialPercentage'){ */
                                    $initialPercentage = $row2['initialPercentage'];
                                    /* } */
                                }
                                if ($totalDays == "") {
                                    /* if($row2['spPostFieldName'] == 'totalDays'){ */
                                    $totalDays = $row2['totalDays'];
                                    /* } */
                                }

                                if ($coment == "") {
                                    /* if($row2['spPostFieldName'] == 'comment'){ */
                                    $coment = $row2['coverLetter'];
                                    /* } */
                                }



                                /* } */
                                ?>

                        <tr>
<td style="text-align: left;"><a class="red" href="<?php echo $BaseUrl . '/freelancer/user-profile.php?profile=' . $row2['spProfiles_idspProfiles']; ?>"><?php echo $freelancerName; ?></td>
            <td>$<?php echo $bidPrice; ?></td>
    <!-- <td><?php //echo $initialPercentage; ?>%</td> -->
    <td><?php echo $totalDays; ?> Days</td>
            <td>


<a href="javascript:void(0)"  onclick="javascript:chatWith(<?php echo $row2['spProfiles_idspProfiles']; ?>)" class="red"><i class='fas fa-comment-dots'></i></a>


                                                        </td>

                                                        <td>
                                        <?php
                                                    //$acceptpr = $fps->readAceptid($_GET['postid']);
                                                    //print_r($acceptpr);
                                                    //project aprove howa b ha ya ni

                                        if ($result5 == false) {
                                                        ?>

    <a href="<?php echo $BaseUrl . '/freelancer/dashboard/status.php?status=accept&postid=' . $_GET['postid'] . '&pid=' . $row2['spProfiles_idspProfiles'] . '&price=' . $bidPrice; ?>" class="btn btn-info" >Award</a>
                                                                <!--  <div class="dropdown">
                                                                     <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Status
                                                                     <span class="caret"></span></button>
                                                                     <ul class="dropdown-menu setting_left">
                                                                         <li><a href="<?php echo $BaseUrl . '/freelancer/dashboard/status.php?status=accept&postid=' . $_GET['postid'] . '&pid=' . $row2['spProfiles_idspProfiles'] . '&price=' . $bidPrice; ?>">Award</a></li>
                                                                         <li><a href="<?php echo $BaseUrl . '/freelancer/dashboard/status.php?status=reject&postid=' . $_GET['postid'] . '&pid=' . $row2['spProfiles_idspProfiles']; ?>">Reject</a></li>
                                                                         
                                                                     </ul>
                                                                 </div> --> <?php
                        } else {

                            $row5 = mysqli_fetch_assoc($result5);

                            /* print_r($row5); */


                            if ($row5['spProfiles_idspProfiles'] == $row2['spProfiles_idspProfiles']) {
                                echo "Awarded";
                                ?>  
                    <?php
                    //echo $status_on_bid['status']; exit;
                    if ($status_on_bid['status'] == 0 || $status_on_bid['status'] == 2 || $status_on_bid['status'] == 3) {
                        ?>
                                                                    <td>

                                <!--   <a href="<?php // echo $BaseUrl.'/freelancer/dashboard/cancel_status.php?status=cancel&postid='.$_GET['postid'].'&pid='.$row2['spProfiles_idspProfiles'].'&price='.$bidPrice;?>" class="btn btn-info" >Cancel</a>
                                </td>  -->
                                                                    <?php } ?>
                                                                    <?php } else {
                                                                    ?>
                                                                    <?php
                                                                    if ($status_on_bid['status'] == 0 || $status_on_bid['status'] == 2 || $status_on_bid['status'] == 3) {
                                                                        echo "N/A";
                                                                    } else {
                                                                        ?>

                                                                        <a href="<?php echo $BaseUrl . '/freelancer/dashboard/status.php?status=accept&postid=' . $_GET['postid'] . '&pid=' . $row2['spProfiles_idspProfiles'] . '&price=' . $bidPrice; ?>" class="btn btn-info" >Award</a>
                    <?php } ?>
                    <?php
                }
            }
            ?>


                                                        </td>
                                                    </tr> <?php
                                                        }
                                                    }
                                                } else {
                                                    ?> 
                                        <td colspan="7" style="text-align: center;">No Bid Found</td>

                                                <?php } ?>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> <?php }
                                            ?>


                <!--    Milestone -->

<?php
// print_r($row);
?>

                                            <?php
                                            if ($acceptpr != FALSE) {

                                                if ($_SESSION['ptid'] != 2) {
                                                    ?>

                        <div class="col-md-12 nopadding dashboard-section" style="margin-top: 24px;"> 


                            <h4 style="padding-left: 10px;">Create Milestone Payment <h4>
                                    <div style="padding-left: 10px;">
                                        <form class="form-inline" id="milestone_frm" action="create_milestone.php" method="post">
                                            <input type="hidden" name="freelancer_projectid" value="<?php echo $row['idspPostings'] ?>">
                                            <input type="hidden" name="freelancer_profileid"  value="<?php echo $row5['spProfiles_idspProfiles']; ?>">
                                            <input type="hidden" name="bussiness_profile_id" value="<?php echo $_SESSION['pid'] ?>">
                                            <input type="hidden" name="hired" value="0">
                                            <input type="hidden" name="created" value="<?php echo date('Y-m-d h:i:s'); ?>">
                                            <div class="form-group">
                                                <label for="amount">Amount $:</label>
                                                <input type="text" class="form-control" id="amount" name="amount">
                                                <br><span id="amt_err" style="color:red"></span>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Milestone Name:</label>
                                                <input type="text" class="form-control" id="description" name="description">
                                                <br><span id="desc_err" style="color:red"></span>
                                            </div>
                                            <button type="button" id="m_submit" class="btn btn-info btn-md">Create Milestone</button>
                                        </form> 
                                    </div>
                                    </div>
<?php
}
}
?>


                            <div class="col-md-12 nopadding dashboard-section" style="margin-top: 24px;"> 

<?php
if ($acceptpr != FALSE) {

if ($_SESSION['ptid'] != 2) {
    ?>

                                        <!--  <a class="btn btn-info btn-md" data-toggle="modal" data-target="#myModal" style="color: #fff;float: right;margin: 3px 6px 0px 0px;">Create Milestone</a>
                                        -->
                    <?php
                    }
                }
                ?>



                                <h4 style="padding-left: 10px;">Milestone  </h4>

                <?php
                $pre = new _freelance_project_status;

                $free = $pre->readAceptproject($row['idspPostings']);

                //echo $pre->ta->sql;

                $freelancerhire = mysqli_fetch_assoc($free);

                /*  print_r($freelancerhire['spProfiles_idspProfiles']);
                  print_r($_SESSION['pid']); */
                ?>
                                <!--
              <div class="modal fade" id="myModal" role="dialog">
                                                            <div class="modal-dialog">
                                                            
                                                            
                                                              <div class="modal-content">
                                                                <div class="modal-header">
                                                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                  <h4 class="modal-title">Create Milestone</h4>
                                                                </div>
                                                                 <form action="create_milestone.php" id="milestone_frm" method="post">
                                                                <div class="modal-body">
                                                                 
                                                                    <input type="hidden" name="freelancer_projectid" value="<?php echo $row['idspPostings'] ?>">
                                                                    <input type="hidden" name="freelancer_profileid"  value="<?php echo $freelancerhire['spProfiles_idspProfiles'] ?>">
                                                                    <input type="hidden" name="bussiness_profile_id" value="<?php echo $_SESSION['pid'] ?>">

                                                                    <input type="hidden" name="hired" value="0">
                                                                    <input type="hidden" name="created" value="<?php echo date('Y-m-d h:i:s'); ?>">
                                                                      <div class="form-group">
                                                                        <label for="amount" style="float:left;">Amount <span id="amt_err" style="color:red"></span></label>
                                                                        <input type="number" class="form-control" name="amount" id="amount">
                                                                      </div>
                                                                      <div class="form-group">
                                                                        <label for="description" style="float:left;">Milestone Name <span id="desc_err" style="color:red"></span></label>
                                                                        
                                                                        <textarea class="form-control" maxlength="100" name="description" id="description"></textarea>
                                                                      </div>
                                                                                                                                    
                                                                </div>
                                                                <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                  <button type="button" id="m_submit" class="btn btn-info">Submit</button>
                                                                </div>
                                                                  </form>
                                                              </div>  
                                                            </div>
                                                       </div> -->


                                <div class="table-responsive">

                                    <table class="table table-striped tbl_store_setting">
                                        <thead style="background-color: #3e3e3e;color: #fff;">
                                            <tr>
                                                <th style="color:#fff;">ID</th>
                                                <th style="color:#fff;">Date </th>
                                                <th style="color:#fff;">Description </th>

                                                <th style="color:#fff;">Amount</th>
                                                <th style="color:#fff;">Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                <?php
                                //  $p = new _postingview;
                                $i = 1;
                                $sf = new _milestone;
                                //$res = $p->myExpireProduct(5, $_SESSION['pid']);
                                $resm = $sf->checkmilestoneposted($_GET['postid']);

                                // echo $sf->ta->sql;

                                if ($resm) {
                                    while ($rowm = mysqli_fetch_assoc($resm)) {


                                        //print_r($row);
                                        $f = new _spprofiles;

                                        $pro = $f->read($rowm['receiver_idspProfiles']);

                                        $pro_data = mysqli_fetch_assoc($pro);
                                        ?>
                                                    <tr>

                                                        <td><?php echo $i; ?></td>
                                                        <td ><p><?php echo date('d-m-Y', (strtotime($rowm['created']))); ?></p></td>

                                                        <td><?php echo $rowm['description']; ?></td>
                                                        <td>$<?php echo $rowm['amount']; ?></td>

                                                        <td class="">
    <?php
    if ($rowm['request_status'] == 0) {


        if ($rowm['bussiness_profile_id'] == $_SESSION['pid']) {
            ?>
<a href="<?php echo $BaseUrl . '/freelancer/dashboardmilestone_posted_update.php?status=1&postid=' . $rowm['id']; ?>" class="btn btn-info" style="color:#fff;">Release</a>

                                                                    <a href="<?php echo $BaseUrl . '/freelancer/dashboard/milestone_posted_update.php?status=2&postid=' . $rowm['id']; ?>" class="btn btn-primary rejmile" style="color:#fff;">Cancel</a>

                                                                    <!--      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Status
                                                                                               <span class="caret"></span></button>
                                                                           <ul class="dropdown-menu setting_left">
<li><a href="<?php echo $BaseUrl . '/freelancer/dashboard/milestone_posted_update.php?status=1&postid=' . $rowm['id']; ?>">Realease</a></li>
<li><a href="<?php echo $BaseUrl . '/freelancer/dashboard/milestone_posted_update.php?status=2&postid=' . $rowm['id']; ?>">Cancel</a></li>
                                                                               
                                                                           </ul> -->


            <?php
        } else {

            echo "Pending";
        }
    } elseif ($rowm['request_status'] == 1) {

        echo "Released";
        ?>




                                                        <?php
                                                    } elseif ($rowm['request_status'] == 2) {

                                                        echo "cancelled";
                                                    }
                                                    ?>

                                                            </section>

                                                        </td>


                                                    </tr> <?php
                                                    $i++;
                                                }
                                            } else {
                                                echo "<td colspan='5'><center>No Milestone </center></td>";
                                            }
                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
<?php } ?> 
                        <!-- 
                                            End Milestone -->


                       </div>

                        <?php 

                        $bdp= new _freelance_placebid;


                        $bds= $bdp->bidsp($_GET['postid']);
                        if($bds){
                            $total_bid =$bds->num_rows;

                          $sum=0;
                        //$count= mysqli_fetch_assoc($bds);
                        while($count= mysqli_fetch_assoc($bds)){
                            
                          $cnt=  $count['bidPrice'];
                            $sum=$sum +  $cnt;

                        }

                        $avg=$sum/$total_bid;
                    }
                    else{
                        $avg=0;
                        $total_bid=0;
                    }
?>

     <div class="sidebar col-xs-12 col-sm-3  " class="float-right"class="right_freelance_top" style="margin-top:24px;">
    
<style>
*{
box-sizing: border-box;
}

/* Create two equal columns that floats next to each other */
.column {
float: left;
width: 50%;
padding: 10px;
height: 200px; /* Should be removed. Only for demonstration */
}

/* Clear floats after the columns */
.row:after {
content: "";
display: inline-flex;
/*clear: both;*/
}

</style>

<div class="row">
<div class="column" style="background-color:#FFFFFF;">
 <h5 style="text-align: center;">Total Bids<?php echo '<br><br>'.$total_bid;?></h5><br>


<label for="Sort By">Sort By:</label><br>
<a href=<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]".'&sort=lowestbid' ;  ?> >Lowest Bid </a><br>
<a href=<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]".'&sort=highestbid' ; ?> >Highest Bid </a><br>
<a href=<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]".'&sort=latestbid' ; ?> >Latest Bid </a><br>
<a href=<?php echo (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]".'&sort=oldbid' ; ?> >Oldest Bid </a>
</div>
<div class="column" style="background-color:#FFFFFF;">
<h5 style="text-align: center;">Average Bid<?php echo '<br><br>'.$avg;?></h5>



</div>

</div>


    <!-- <div class="col-xs-12 col-sm-6 nopadding ">total bids</div> -->
                            
                          </div>

                        </section>


                        <script type="text/javascript">


                            $(".complete").click(function (e) {
                                // alert();
                                e.preventDefault();
                                /*var postid = $(this).attr("data-postid");*/
                                var link = $(this).attr('href');

                                // alert(link);
                                // alert(postid);

                                swal({
                                    title: "Are you sure you want to Complete Project?",
                                    type: "warning",
                                    confirmButtonClass: "sweet_ok",
                                    confirmButtonText: "Yes",
                                    cancelButtonClass: "sweet_cancel",
                                    cancelButtonText: "No",
                                    showCancelButton: true,
                                },
                                        function (isConfirm) {
                                            if (isConfirm) {
                                                window.location.href = link;
                                            }
                                        });

                            });


                            $(".incomplete").click(function (e) {
                                // alert();
                                e.preventDefault();
                                /*var postid = $(this).attr("data-postid");*/
                                var link = $(this).attr('href');

                                // alert(link);
                                // alert(postid);

                                swal({
                                    title: "Are you sure you want to In Complete Project?",
                                    type: "warning",
                                    confirmButtonClass: "sweet_ok",
                                    confirmButtonText: "Yes",
                                    cancelButtonClass: "sweet_cancel",
                                    cancelButtonText: "No",
                                    showCancelButton: true,
                                },
                                        function (isConfirm) {
                                            if (isConfirm) {
                                                window.location.href = link;
                                            }
                                        });

                            });




                            $(".rejmile").click(function (e) {
                                // alert();
                                e.preventDefault();
                                /*var postid = $(this).attr("data-postid");*/
                                var link = $(this).attr('href');

                                // alert(link);
                                // alert(postid);

                                swal({
                                    title: "Are you sure you want to Cancel Milestone?",
                                    type: "warning",
                                    confirmButtonClass: "sweet_ok",
                                    confirmButtonText: "Yes",
                                    cancelButtonClass: "sweet_cancel",
                                    cancelButtonText: "No",
                                    showCancelButton: true,
                                },
                                        function (isConfirm) {
                                            if (isConfirm) {
                                                window.location.href = link;
                                            }
                                        });

                            });


                            $('#m_submit').on('click', function () {

                                var amount = $("#amount").val();
                                var description = $("#description").val();

                                if (amount == "" && description == "") {

                                    $("#amt_err").text("Please Enter Amount");
                                    $("#desc_err").text("Please Enter Milestone Name");
                                    $("#amount").focus();

                                } else if (amount == "") {

                                    $("#amt_err").text("Please Enter Amount");
                                    $("#amount").focus();

                                } else if (description == "") {

                                    $("#desc_err").text("Please Enter Milestone Name");
                                    $("#amt_err").text("");
                                    $("#description").focus();
                                } else {

                                    $("#milestone_frm").submit();

                                }


                            });



                        </script>   

<?php
include('../../component/f_footer.php');
include('../../component/f_btm_script.php');
?>
                        </body>
                        </html>
<?php }
?>