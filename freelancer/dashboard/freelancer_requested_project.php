  <?php
  /*error_reporting(E_ALL);
  ini_set('display_errors', '1');*/

  include('../../univ/baseurl.php');
  session_start();
  if (!isset($_SESSION['pid'])) {

  $_SESSION['afterlogin'] = "freelancer/";
  include_once("../../authentication/islogin.php");
  } else {
  function sp_autoloader($class)
  {
  include '../../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");
  $activePage = 21;

  $fps = new _freelance_project_status;

 
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
  <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
  <!-- Design css  -->
  <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/design.css">
  <script src='https://kit.fontawesome.com/a076d05399.js'></script>

  <style>
  .btn_h:hover {
  background-color: orange;
  }

  #profileDropDown li.active {
  background-color: #c45508;
  }

  #profileDropDown li.active a {
  color: white;
  }
  </style>

  </head>

  <body class="bg_gray">
  <?php
  //session_start();

  $header_select = "freelancers";
  include_once("../../header.php");
  ?>
  <section class="main_box" id="freelancers-page">
  <div class="container nopadding projectslist dashboardpage">

  <div class="sidebar col-xs-3 col-sm-3" id="sidebar">

  <?php include('left-menu.php'); ?>
  </div>
  <div class="col-xs-12 col-sm-9 nopadding">

  <div class="col-sm-12 nopadding dashboard-section" style="margin-top: 24px;">
  <div class="col-xs-12 dashboardbreadcrum">
  <ul class="breadcrumb">
  <li><a href="<?php echo $BaseUrl; ?>/freelancer/dashboard">Dashboard</a></li>
  <li>Requested Project</li>

  <!-- <li><?php echo $title; ?></li> -->

  </ul>
  </div>
  </div>

  <!-- <div class="col-xs-12 nopadding dashboard-section freelancer_dashboard">
  <div class="col-xs-12 dashboardbreadcrum freelancer_dashboard">
  <ul class="breadcrumb freelancer_dashboard">
  <li><a href="<?php echo $BaseUrl; ?>/freelancer">Dashboard</a></li>
  <li>Expired Projects</li>

  </ul>
  </div>
  </div> -->

  <script>
  /* function pass(a, b) {
  //alert(a);
  $('#txtReceiver').val(a);
  //alert(b);
  $('#name').text(b);

  }*/
  </script>

  <div class="col-xs-12 nopadding dashboard-section" style="margin-top: 10px;">

  <div class="col-xs-12 dashboardtable">
  <div class="table-responsive">

  <table class="table table-striped tbl_store_setting" id="example1">
  <thead style="background-color: #3e3e3e;color: #fff;">
  <tr>
  <th style="color:#fff;">ID</th>
  <th style="color:#fff;">Project Title</th>
  <th style="color:#fff;">Chat</th>

  <th style="color:#fff;">Price</th>
  <th style="color:#fff;">Price type</th>
  <th style="color:#fff;">created</th>

  <th class="action" style="color:#fff;">Status</th>
  </tr>
  </thead>
  <tbody>
  <?php
  $st = new _spuser;
  $st1 = $st->readdatabybuyerid($_SESSION['uid']);
  if ($st1 != false) {
  $stt = mysqli_fetch_assoc($st1);
  $account_status = $stt['deactivate_status'];
  }
  //  $p = new _postingview;
  $i = 1;
  $sf  = new _freelance_chat_project;
  //$res = $p->myExpireProduct(5, $_SESSION['pid']);
  $res = $sf->getfreelancerConversation($_SESSION['pid']);

  /* echo $sf->ta->sql;*/
  if ($account_status != 1) { 
  if ($res) {

  while ($row = mysqli_fetch_assoc($res)) {

  $sf = new _freelancerposting;
  $result = $sf->singletimelines1($row['id']);
   // echo $sf->ta->sql;
   // die('======');
  if ($result != false) {
    
  $row2 = mysqli_fetch_assoc($result);
  $id = $row2['spProfiles_idspProfiles'];
  }
  $f = new _spprofiles; 

  $pro = $f->read($row['sender_idspProfiles']);
  if ($pro != false) {
  $pro_data = mysqli_fetch_assoc($pro);

  //die('=====');
  $freelancer_name = $pro_data['spProfileName'];
  }
  //print_r($pro_data);

  /*print_r($pro_data['spProfileName']);*/
  $dt = new DateTime($row['chat_date']);
  ?>
  <tr>

  <td><?php echo $row['id']; ?></td>
  <td>
  <!-- <a href="<?php echo $BaseUrl . '/freelancer/dashboard/detail.php?postid=' . $row['idspPostings']; ?>" class="red freelancer_capitalize"  > -->

  <a href="<?php echo $BaseUrl . '/freelancer/dashboard/freelance_project_detail.php?postid=' . $row['id']; ?>" class="red freelancer_capitalize"><?php echo "Requested By " . ucfirst($pro_data['spProfileName']); ?></a>
  </td>
  <td>
  <div class="col-sm-12 zoom" data-toggle="modal" data-target="#composeNewTxt_<?php echo $row['id']; ?>" style="cursor: pointer;"> <a href="javascript:void(0)" id="composeNewTxt2" class="red" data-id="<?php echo $id; ?>" data-receiver_name="<?php echo $freelancer_name; ?>"><i class='fas fa-comment-dots' style="color: #ff7208;"></i></a></div>
  </td>

  <td><?php echo $row2['Default_Currency'] . ' ' . $row['bidPrice']; ?></td>
  <td><?php echo $row['PriceFixed']; ?></td>

  <td><?php echo $dt->format('d-M-Y'); ?></td>
  <td class="text-center">
  <?php if ($row['status'] == 0) {
  ?>

  <a href="<?php echo $BaseUrl . '/freelancer/dashboard/requested_project.php?status=1&postid=' . $row['id']; ?>" class="btn btn-info" style="color:#fff; background-color: #c45508; border:1px solid black;">Accept</a>

  <a href="<?php echo $BaseUrl . '/freelancer/dashboard/requested_project.php?status=2&postid=' . $row['id']; ?>" class="btn btn-danger rejpro" style="color:#fff; border:1px solid black;">Reject</a>

  <!--     <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Status
  <span class="caret"></span></button>
  <ul class="dropdown-menu setting_left">
  <li><a href="<?php echo $BaseUrl . '/freelancer/dashboard/requested_project.php?status=1&postid=' . $row['id']; ?>">Accept</a></li>
  <li><a href="<?php echo $BaseUrl . '/freelancer/dashboard/requested_project.php?status=2&postid=' . $row['id']; ?>">Reject</a></li>

  </ul>
  -->



  <?php

  } elseif ($row['status'] == 1) {

  echo "Accepted";

  /*         ?>

  <?php
  $m = new _milestone;

  $checkm = $m->checkmilestone($row['id']);

  //print_r($checkm);
  if($checkm->num_rows>0){
  ?>
  <br>

  <a href="view_milestone.php?project_id=<?php echo $row['id']; ?>" class="btn btn-primary btn-md"  style="color: #fff;margin-top: 10px;">View Milestone</a>

  <?php   
  }*/
  } else {

  echo "Rejected";
  }



  ?>
  <!--   <a href="<?php echo $BaseUrl . '/freelancer/dashboard/detail.php?postid=' . $row['idspPostings']; ?>" class="red" ><i class="fa fa-eye"></i></a>
  <a href="<?php echo $BaseUrl . '/post-ad/freelancer/?postid=' . $row['idspPostings'] . '&exp=1'; ?>"><img src="<?php echo $BaseUrl . '/assets/images/icon/edit.png' ?>" class="img-responsive" alt="Edit" ></a> -->

  </td>

  </tr>
  <div id="composeNewTxt_<?php echo $row['id']; ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
  <div class="modal-content no-radius sharestorepos">
  <form method="post">
  <div class="modal-header">
  <h4 class="modal-title"><i class="fa fa-pencil"></i> Compose Message</h4>
  </div>
  <div class="modal-body">
  <?php
  $txtReceiver = ($pro_data['idspProfiles']);
  ?>
  <input type="hidden" name="txtSender" id="txtSender" value="<?php echo $_SESSION['pid']; ?>">
  <input type="hidden" name="txtReceiver" id="txtReceiver" value="<?php echo $txtReceiver; ?>">
  <input type="hidden" name="module" id="module" value="freelancer">
  <div class="form-group">
  <label>To (<span id="name"><?php echo ucfirst($pro_data['spProfileName']); ?></span>)<span class="red"> * <span class="error_user"></span></span></label>

  </div>
  <div class="form-group">
  <label>Message<span class="red"> * <span class="error_msg"></span></span></label>
  <textarea class="form-control" name="spfriendChattingMessage" id="friendMessage" required=""></textarea>
  </div>
  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-secondary btn_h" data-dismiss="modal">Close</button>
  <input type="button" class="btn btn-primary composTxtNow" id="composTxtNow1" name="" value="Send Message" data-dismiss="modal">
  </div>
  </form>
  </div>
  </div>
  </div>
  <?php
  $i++;
  }
  }
  } else {
  echo "<td colspan='7'><center>No Record Found</center></td>";
  }
  ?>


  </tbody>
  </table>
  </div>
  </div>
  </div>
  </div>
  </div>
  </section>

  <script type="text/javascript">
  $(".rejpro").click(function(e) {
  // alert();
  e.preventDefault();
  /*var postid = $(this).attr("data-postid");*/
  var link = $(this).attr('href');

  // alert(link);
  // alert(postid);

  swal({
  title: "Are you sure you want to Reject?",
  type: "warning",
  confirmButtonClass: "sweet_ok",
  confirmButtonText: "Yes",
  cancelButtonClass: "sweet_cancel",
  cancelButtonText: "No",
  showCancelButton: true,
  },
  function(isConfirm) {
  if (isConfirm) {
  window.location.href = link;
  }
  });

  });
  </script>
  <script src='https://cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js'></script>

  <script>
  var table = $('#example1').DataTable({ 
  select: false,
  "columnDefs": [{
  className: "Name", 
  "targets":[0],
  "visible": false,
  "searchable":false
  }]
  });
  </script>   

  <?php
  include('../../component/f_footer.php');
  include('../../component/f_btm_script.php');
  ?>
  </body>

  </html>
  <?php
  } ?>