<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


</head>
<body>

<div class="container">

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Atendee Details</h4>
        </div>
        <div class="modal-body">
          <p><b>Username : </b><span id="user_name"></span></p>
          <p><b>Useremail : </b><span id="user_email"></span></p>
          <p><b>Userphone : </b><span id="user_phone"></span></p>
          <p><b>Usercompany : </b><span id="user_company"></span></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>






<?php
include('../../univ/baseurl.php');
session_start();
function sp_autoloader($class)
{
  include '../../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");
if (!isset($_SESSION['pid'])) {
  include_once("../../authentication/check.php");
  $_SESSION['afterlogin'] = "../timeline/";
}
$_GET["categoryID"] = "9";
$_GET["categoryName"] = "Events";
$header_event = "events";

$postId = isset($_GET['postid']) ? (int) $_GET['postid'] : 0;

if ($postId > 0) {
  $p = new _spevent;
  //$pf  = new _postfield;

  $result = $p->singletimelines($postId);
  // echo $p->ta->sql;
  if ($result != false) {
    $row = mysqli_fetch_assoc($result);

    // echo "<pre>";
    // print_r($row);
    $ProTitle   = $row['spPostingTitle'];
    $register   = $row['registration_req'];
    $Proname   = $row['Username'];
    
    
    $ProDes     = $row['spPostingNotes'];
    $ArtistName = $row['spProfileName'];
    $ArtistId   = $row['idspProfiles'];
    $ArtistAbout = $row['spProfileAbout'];
    $ArtistPic  = $row['spProfilePic'];
    $price      = $row['spPostingPrice'];
    $country    = $row['spPostingsCountry'];
    $city      = $row['spPostingsCity'];
    $expDate    = $row['spPostingExpDt'];

    $venu = "";
    $startDate = "";
    $endDate = "";
    $startTime    = "";
    $endTime = "";
    // $OrganizerId = "";
    $Quantity = '';


    $venu = $row['spPostingEventVenue'];
    $startDate = $row['spPostingStartDate'];
    $endDate = $row['spPostingEndDate'];
    // $OrganizerId = $row['spPostFieldValue'];
    $Quantity = $row['spPostFieldValue'];
    $organizerName = $row['spPostingEventOrgName'];
    $OrganizerId = $row['spPostingEventOrgId'];
    $startTime = $row['spPostingStartTime'];
    $endTime = $row['spPostingEndTime'];
    $Organizers = $row['spPostingEventOrgName'];
    $hallcapacity = $row['hallcapacity'];

    $dtstrtTime = strtotime($startTime);
    $dtendTime = strtotime($endTime);




    $pr = new _spprofilehasprofile;
    $result3 = $pr->frndLeevel($_SESSION['pid'], $row['idspProfiles']);
    if ($result3 == 0) {
      $level = '1st Connection';
    } else if ($result3 == 1) {
      $level = '1st Connection';
    } else if ($result3 == 2) {
      $level = '2nd Connection';
    } else if ($result3 == 3) {
      $level = '3rd Connection';
    } else {
      $level = 'Not Define';
    }

    // $result_pf = $pf->read($row['idspPostings']);
    //echo $pf->ta->sql."<br>";
    /*if($result_pf){
$venu = "";
$startDate = "";
$endDate = "";
$startTime    = "";
$endTime = "";
$OrganizerId = "";
$Quantity = '';
while ($row2 = mysqli_fetch_assoc($result_pf)) {

if($venu == ''){
if($row2['spPostFieldName'] == 'spPostingEventVenue_'){
$venu = $row2['spPostFieldValue'];

}
}
if($startDate == ''){
if($row2['spPostFieldName'] == 'spPostingStartDate_'){
$startDate = $row2['spPostFieldValue'];

}
}
if($endDate == ''){
if($row2['spPostFieldName'] == 'spPostingEndDate_'){
$endDate = $row2['spPostFieldValue'];

}
}
if($startTime == ''){
if($row2['spPostFieldName'] == 'spPostingStartTime_'){
$startTime = $row2['spPostFieldValue'];

}
}
if($endTime == ''){
if($row2['spPostFieldName'] == 'spPostingEndTime_'){
$endTime = $row2['spPostFieldValue'];

}
}
if($OrganizerId == ''){
if($row2['spPostFieldName'] == 'spPostingEventOrgId_'){
$OrganizerId = $row2['spPostFieldValue'];

}
}
if($Quantity == ''){
if($row2['spPostFieldName'] == 'ticketcapacity_'){
$Quantity = $row2['spPostFieldValue'];

}
}
}
$dtstrtTime = strtotime($startTime);
$dtendTime = strtotime($endTime);
}*/
  }
} else {
  $re = new _redirect;
  $redirctUrl = $BaseUrl . "/events";
  $re->redirect($redirctUrl);
}

if (isset($_GET['visibility']) && $_GET['visibility'] == -1) {
  $visibil = 1;
} else {
  $visibil = 0;
}
$activePage = 2;
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
  <?php include('../../component/links.php'); ?>
  <!--This script for posting timeline data Start-->
  <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-2.1.4.min.js"></script>
  <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-1.11.4-ui.min.js"></script>
  <!--This script for posting timeline data End-->


  <!-- ===== INPAGE SCRIPTS====== -->
  <!-- High Charts script -->
  <script src="<?php echo $BaseUrl; ?>/assets/js/highcharts.js"></script>
  <?php include('../../component/dashboard-link.php'); ?>
  <!-- Morris chart -->
  <link href="<?php echo $BaseUrl; ?>/assets/admin/plugins/morris/morris.css" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">

</head>

<body class="bg_gray">
  <?php include_once("../../header.php"); ?>
  <section class="topDetailEvent innerEvent">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 text-center">
          <h3>Active Events</h3>
        </div>
      </div>
    </div>
  </section>
  <section class="m_top_15">
    <div class="container">
      <div class="row">
        <div class="sidebar col-md-2 no-padding left_event_menu whiteevent" id="sidebar">
          <?php include('left-menu.php'); ?>
        </div>
        <div class="col-md-10">
          <!-- <div class="main_box eventExplrthefun" style="border-top-right-radius: 25px; border-top-left-radius: 25px;">
            <?php //include('../top-button-dashboard.php'); ?>
            <h1>Explore the <span>fun</span></h1>
            <?php //include('../search-form.php'); ?>
          </div> -->
          <div class="row">
            <div class="col-sm-12">
              <div class="eventDashDetail bg_white" style="
border-bottom-right-radius: 25px;
border-bottom-left-radius: 25px;">
                <h2>Title: <span><?php echo ucwords(strtolower($ProTitle)); ?></span></h2>
                <p><i class="fa fa-map-marker"></i> <?php echo $venu; ?></p>
                <h2>Event Detail</h2>
                <p class="eventcapitalize"><?php echo $ProDes; ?></p>
                <div class="row">
                  <div class="col-md-6">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <td><strong>Start Date</strong></td>
                            <td><?php echo $startDate; ?></td>
                          </tr>
                          <tr>
                            <td><strong>Start Time</strong></td>
                            <td><?php echo date("h:i A", $dtstrtTime); ?></td>
                          </tr>
                          <?php

                          $pev = new _spevent_type_price;
                          //$pf  = new _postfield;

                          $result_1 = $pev->read($postId);
                          //echo $p->tal->sql;
                          if ($result_1 != false) {
                            $row1 = mysqli_fetch_assoc($result_1);

                            //echo "<pre>";
                            //print_r($row);
                            $event_limit   = $row1['event_limit'];
                            $event_price     = $row1['event_price'];
                          }







                          ?>

                          <!--<tr>
<td><strong>Ticket Price</strong></td>
<td>$<?php echo $event_price; ?></td>
</tr>-->
                          <tr>
                            <td><strong>Organizers</strong></td>
                            <td><?php echo $Organizers; ?>
                              <?php
                              $pf  = new _postfield;
                              $pro = new _spprofiles;
                              $ei  = new _eventJoin;
                              $limit = 0;
                              if ($postId > 0) {
                                $fieldName = "spPostingCohost_";
                                $result6 = $pf->readCustomPost($postId, $fieldName);
                                //echo $pf->ta->sql."<br>";
                                if ($result6 != false) {
                                  while ($row6 = mysqli_fetch_assoc($result6)) {
                                    if ($row6['spPostFieldValue'] != '') {
                                      $profileId = $row6['spPostFieldValue'];
                                      $result7 = $pro->read($profileId);
                                      if ($result7 != false) {
                                        $row7 = mysqli_fetch_assoc($result7);
                              ?>
                                        <a class="cohost" href="<?php echo $BaseUrl . '/friends/?profileid=' . $profileId; ?>"><?php echo $row7['spProfileName']; ?></a>,
                              <?php
                                        $limit++;
                                        if ($limit == 3) {
                                          break;
                                        }
                                      }
                                    }
                                  }
                                }
                              }
                              ?>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <tbody>
                          <tr>
                            <td><strong>End Date</strong></td>
                            <td><?php echo $expDate; ?></td>
                          </tr>
                          <tr>
                            <td><strong>End Time</strong></td>
                            <td><?php echo date("h:i A", $dtendTime); ?></td>
                          </tr>

                          <!--<tr>
<td><strong>Ticket Quantity</strong></td>
<td><?php echo $event_limit; ?></td>
</tr>-->

                        </tbody>
                      </table>
                    </div>
                  </div>


                  <div class="col-sm-12">
                    <h2><span>Tickets Type</span></h2>
                    <div class="table-responsive">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Ticket Type</th>
                            <th>Ticket Quantity Limit</th>
                            <th>Ticket Price</th>

                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $prictype = new _spevent_type_price;
                          $resultdata = $prictype->read($postId);

                          $c = new _spuser;
                          $cu = $c->readcurrency($_SESSION['uid']);
                          if ($cu) {
                            $cur = mysqli_fetch_assoc($cu);
                            $currency = $cur['currency'];
                          }
                          if ($resultdata != false) {
                            $i = 1;
                            while ($pricedata = mysqli_fetch_assoc($resultdata)) {

                          ?>
                              <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $pricedata['event_type']; ?></td>
                                <td><?php echo $pricedata['event_limit']; ?></td>
                                <td><?php echo $currency; ?>&nbsp;&nbsp;&nbsp;<?php echo number_format((float)$pricedata['event_price'], 2, '.', '');; ?></td>
                              <tr>
                            <?php
                              $i++;
                            }
                          }


                            ?>

                        </tbody>


                      </table>
                    </div>



                  </div>

                  <div class="col-sm-12">
                    <h2><span>Tickets Purchase Detail</span></h2>
                    <div class="table-responsive tkttab">
                    <link rel='stylesheet' href='https://cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css'>
                      <table class="table table-striped" id="example">
                        <thead>
                          <tr>
                          
                            <th>ID</th>
                            <th>Ticket Type</th>
                            <th>Buyer</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Purchase Date</th>
                            <th>Transaction ID</th>


                            <?php

                            //  $sha = $row['register'];
                            //  echo $sha;
                            //  die("yhgdhs");

                          

                            if( $register == 1)
                            
                            {
                              ?>
                            <th>Atendee</th>
                            <?php
                            }
                            ?>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $or = new _order;
                          $pro = new _spprofiles;
                          $i = 1;
                          //$result4 = $or->readMyEventTkt($_SESSION['pid'], $_GET['categoryID'], $_GET['postid']);
                          //$result4 = $or->readMyEventTkt($_SESSION['pid'], $_GET['categoryID'], $_GET['postid']);
                          //echo $or->ta->sql;

                          $pet = new _spevent_transection;
                          $res_11 = $pet->postread($postId);
                          if ($res_11) {
                            while ($row4 = mysqli_fetch_assoc($res_11)) {
                              $curr = $row4['currency'];
                          ?>
                              <tr>
                                <td><?php echo $i; ?></td>

                                <?php

                                $prictype = new _spevent_type_price;
                                $resultdata = $prictype->readtypid($row4['ticket_type']);

                                if ($resultdata != false) {

                                  $pricedata = mysqli_fetch_assoc($resultdata);

                                  $event_type = $pricedata['event_type'];
                                }


                                ?>
                                <td><?php echo $event_type; ?></td>
                                <td>
                                  <?php
                                  $result5 = $pro->readprofileid($row4['buyer_pid']);
                                  if ($result5) {
                                    $row5 = mysqli_fetch_assoc($result5);

                                  ?>
                                    <a class="cohost" href="<?php echo $BaseUrl . '/friends/?profileid=' . $row4['buyer_pid']; ?>"><?php echo $row5['spProfileName']; ?></a>
                                  <?php
                                  
                                  }
                                  ?>
                                </td>
                                <?php
  
                                 
                                ?>
                                <td><?php echo $row4['quantity']; ?></td>
                                <td><?php echo $curr . ' ' . $row4['payment_gross']; ?></td>
                                <td><?php echo date("Y-m-d H:i:A", strtotime($row4['payment_date'])); ?></td>
                                <td><?php echo $row4['txn_id']; ?></td>

                                <?php
                                if( $register == 1)
                              
                                {
                                ?>
                                
                                <td>  <button type="button"    onclick="data_append('<?php echo $row4['Username']; ?>',
                                '<?php echo $row4['Useremail']; ?>','<?php echo $row4['Userphone']; ?>','<?php echo $row4['Usercompany']; ?>')">View</button></td>
                                <?php
                                }
                                ?>

                              </tr>


                          <?php
                              $i++;
                            }
                          }

                          /*if ($result4) {
while ($row4 = mysqli_fetch_assoc($result4)) {
$dt = new DateTime($row4['sporderdate']);
?>
<tr>
<td><?php echo $i; ?></td>
<td>
<?php 
$result5 = $pro->read($row4['spByuerProfileId']);
if ($result5) {
$row5 = mysqli_fetch_assoc($result5);
?>
<a class="cohost" href="<?php echo $BaseUrl.'/friends/?profileid='.$row4['spByuerProfileId'];?>"><?php echo $row5['spProfileName'];?></a>,
<?php
}
?>                                                                            
</td>
<td>$<?php echo $row4['sporderAmount']; ?></td>
<td><?php echo $dt->format('d-M-Y'); ?></td>
</tr> <?php
$i++;
}
} */ ?>

                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <h2><span>Gallery</span></h2>
                    <div class="row">
                      <?php
                      $pic = new _eventpic;
                      $res2 = $pic->read($postId);
                      if ($res2 != false) {
                        while ($rp = mysqli_fetch_assoc($res2)) {
                          $pic2 = $rp['spPostingPic'];
                      ?>
                          <div class="col-md-3">
                            <div class="EvntImg">
                              <a class="thumbnail" rel="" href="javascript:void(0)" title="<?php echo $ProTitle; ?>">
                                <img class="group1" src="<?php echo ($pic2); ?>">
                              </a>
                            </div>
                          </div>
                      <?php
                        }
                      } ?>
                    </div>
                  </div>

                  <div class="col-sm-12">
                    <h2><span>Sponsor</span></h2>
                    <div class="row">
                      <?php
                      $pf  = new _spevent;
                      $pro = new _spprofiles;
                      $spo = new _sponsorpic;

                      $result6 = $pf->readSponsorPost($postId);
                      //echo $pf->ta->sql."<br>";
                      if ($result6) {
                        while ($row6 = mysqli_fetch_assoc($result6)) {

                          if ($row6['sponsorId'] != '') {
                            $sponsorIds = $row6['sponsorId'];
                            $sponsorId = explode(",", $sponsorIds);
                            for ($k = 0; $k < count($sponsorId); $k++) {
                              $result8 = $spo->readSponsor($sponsorId[$k]);
                              //echo $spo->ta->sql;
                              if ($result8) {
                                $row8 = mysqli_fetch_assoc($result8);
                      ?>

                                <ul>
                                  <li>
                                    <h3><?php echo $row8['sponsorTitle']; ?></h3>
                                    <a href="<?php echo $row8['sponsorWebsite']; ?>" target="_blank"><?php echo $row8['sponsorWebsite']; ?></a>
                                  </li>
                                </ul>


                                <div class="">
                                  <div class="row m_btm_20">
                                    <div class="col-md-3">
                                      <img src="<?php echo ($row8['sponsorImg']); ?>" class="img-responsive" alt="">
                                    </div>
                                    <div class="col-md-9">

                                    </div>
                                  </div>
                                </div>
                      <?php
                              }
                            }
                          }
                        }
                      }
                      ?>
                    </div>
                  </div>
                  <div class="col-sm-12">
                    <h2><span>Featuring</span></h2>
                    <div class="row">
                      <?php
                      $pf  = new _spevent;
                      $pro = new _spprofiles;
                      $result6 = $pf->readFeaturPost($postId);
                      //echo $pf->ta->sql."<br>";
                      if ($result6 != false) {
                        while ($row6 = mysqli_fetch_assoc($result6)) {
                          if ($row6['addfeaturning'] != '') {
                            $profileId = $row6['addfeaturning'];
                            $allFeature = explode(",", $profileId);
                            for ($l = 0; $l < count($allFeature); $l++) {
                              $result7 = $pro->read($allFeature[$l]);
                              if ($result7 != false) {
                                $row7 = mysqli_fetch_assoc($result7);
                      ?>
                                <div class="col-md-3">
                                  <div class="featuringBox row bg_white no-margin">
                                    <a href="<?php echo $BaseUrl . '/friends/?profileid=' . $allFeature[$l]; ?>">
                                      <div class="col-md-3 no-padding">
                                        <?php
                                        echo "<img  alt='profile-Pic' class='img-responsive' src='" . (isset($row7['spProfilePic']) ? " " . ($row7['spProfilePic']) . "" : "https://www.seekpng.com/png/full/114-1149972_avatar-free-png-image-avatar-png.png") . "'>";
                                        ?>
                                      </div>
                                      <div class="col-md-9 no-padding">
                                        <h4><?php echo $row7['spProfileName']; ?></h4>
                                      </div>
                                    </a>
                                  </div>
                                </div>
                      <?php
                              }
                            }
                          }
                        }
                      }
                      ?>
                    </div>
                  </div>
                  <div class="col-sm-12">
                     <h2><span>Contact Organizer's</span></h2> 
                    <div class="row">
                      <?php
                      //organizer id......
                      $pro = new _spprofiles;
                      $result7 = $pro->read($OrganizerId);
                      if ($result7 != false) {
                        $row7 = mysqli_fetch_assoc($result7);
                      ?>
                        <div class="col-md-3">
                          <div class="featuringBox row bg_white no-margin">
                            <a href="<?php echo $BaseUrl . '/friends/?profileid=' . $OrganizerId; ?>">
                              <div class="col-md-3 no-padding">
                                <?php
                                echo "<img  alt='profile-Pic' class='img-responsive' src='" . (isset($row7['spProfilePic']) ? " " . ($row7['spProfilePic']) . "" : "https://www.seekpng.com/png/full/114-1149972_avatar-free-png-image-avatar-png.png") . "'>";
                                ?>
                              </div>
                              <div class="col-md-9 no-padding">
                                <h4><?php echo $row7['spProfileName']; ?></h4>
                              </div>
                            </a>
                            <div class="col-sm-12">
                              <span data-toggle="modal" data-target="#sendAsms" data-receiver="<?php echo $OrganizerId; ?>" data-sender="<?php echo $_SESSION['pid']; ?>" class="sendasms"></span>
                            </div>
                          </div>
                        </div>
                        <?php
                      }
                      //co-Host persons.
                      $pf  = new _postfield;
                      $pro = new _spprofiles;
                      $ei  = new _eventJoin;
                      if ($postId > 0) {
                        $fieldName = "spPostingCohost_";
                        $result6 = $pf->readCustomPost($postId, $fieldName);
                        //echo $pf->ta->sql."<br>";
                        if ($result6 != false) {
                          while ($row6 = mysqli_fetch_assoc($result6)) {
                            if ($row6['spPostFieldValue'] != '') {
                              $profileId = $row6['spPostFieldValue'];
                              $result7 = $pro->read($profileId);
                              if ($result7 != false) {
                                $row7 = mysqli_fetch_assoc($result7);
                        ?>
                                <div class="col-md-3">
                                  <div class="featuringBox row bg_white no-margin">
                                    <a href="<?php echo $BaseUrl . '/friends/?profileid=' . $profileId; ?>">
                                      <div class="col-md-3 no-padding">
                                        <?php
                                        echo "<img  alt='profile-Pic' class='img-responsive' src='" . (isset($row7['spProfilePic']) ? " " . ($row7['spProfilePic']) . "" : "../img/default-profile.png") . "'>";
                                        ?>
                                      </div>
                                      <div class="col-md-9 no-padding">
                                        <h4><?php echo $row7['spProfileName']; ?></h4>
                                      </div>
                                    </a>
                                    <div class="col-sm-12">
                                      <span data-toggle="modal" data-target="#sendAsms" data-receiver="<?php echo $profileId; ?>" data-sender="<?php echo $_SESSION['pid']; ?>" class="sendasms getCntactid">Contact Organizer</span>
                                    </div>
                                  </div>
                                </div>
                                <!-- <a class="cohost" href="<?php echo $BaseUrl . '/friends/?profileid=' . $profileId; ?>"><?php echo $row7['spProfileName']; ?></a>, -->
                      <?php
                              }
                            }
                          }
                        }
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
  </section>
  <div class="space"></div>

  <script>
  function  data_append(username,useremail,userphone,usercompany)
  {
    $("#user_name").text(username);
    $("#user_email").text(useremail);
    $("#user_phone").text(userphone);
    $("#user_company").text(usercompany);
    
    $('#myModal').modal('show');

    
  }
  </script>



  <script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>
  <script type="text/javascript">
$(document).ready(function() {

var table = $('#example').DataTable({
select: false,
"columnDefs": [{
className: "Name",
"targets": [0],
"visible": false,
"searchable": false
}]
}); //End of create main table


$('#example tbody').on('click', 'tr', function() {

// alert(table.row( this ).data()[0]);

});
});

</script>

  <?php
  include('../../component/footer.php');
  include('../../component/btm_script.php');
  ?>


</body>

</html>
