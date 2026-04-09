<?php

include('univ/baseurl.php');

session_start();

if (!isset($_SESSION['pid'])) {
  $_SESSION['afterlogin'] = "freelancer/";    
  include_once ("authentication/check.php");
}
else{
  function sp_autoloader($class) {
    include 'mlayer/' . $class . '.class.php';
  }

  spl_autoload_register("sp_autoloader");

  $r = new _spprofilehasprofile; 
  
  $friendrequest = 0;
  $res11 = $r->friendReequestAll($_SESSION["pid"]); 
}

if ($res11 != false) {
  $friendrequest = $res11->num_rows;
}
else{
  $friendrequest = 0;
}


$r = new _spprofilehasprofile;
$friendrequest = 0;
$res11 = $r->friendReequestAll($_SESSION["pid"]);

if ($res11 != false) {
	$friendrequest = $res11->num_rows;
} else {
	$friendrequest = 0;
}

$aa = '';
$r = new _spprofilehasprofile;
$res = $r->friendReequestList($_SESSION["pid"]);
$total = 0;

if ($res != false) {
  $i = 1;
  while ($rows = mysqli_fetch_assoc($res)) {
    //print_r($rows);
    $total = $res->num_rows;
    //echo $total.'love';
    $p = new _spprofiles;
    $sender = $rows["spProfiles_idspProfileSender"];
    $receiver = $rows["spProfiles_idspProfilesReceiver"];
    $result = $p->read($sender);
    //var_dump($result);
    if ($result) {

      $row = mysqli_fetch_assoc($result);
      $aa .= '<div id="friend_boxx'.$i.'" class="row no-margin ">
          <div class="col-md-2 no-padding">';
              $aa .= '<img alt="profile-Pic" class="img-responsive" style="width:46px; height: 46px;margin-top:5px;" src="'.(isset($row['spProfilePic']) ? " ".$row['spProfilePic']." " : "../assets/images/icon/blank-img.png").'">';
          $aa .= '</div>
          <div class="col-md-10 friendsname no-padding-right">
              <a href="'.$BaseUrl.'/friends/?profileid='.$rows["spProfiles_idspProfileSender"].'">'.$row["spProfileName"]." (".$row["spProfileTypeName"].")".'</a>
              <div class="btn-group" role="group" aria-label="Basic example">
                  <button type="button" id="'.$i.'" class="btn btn-primary btn-sm" onclick="acceptrequest('.$sender.','.$receiver.')"  style="margin-right: 20px;" data-sender="'.$sender.'" data-receiver="'.$receiver.'">Confirm</button>
                  <button type="button" id="'.$i.'" class="btn btn-warning btn-sm" onclick="rejectrequest('.$sender.','.$receiver.')" data-sender="'.$sender.'" data-receiver="'.$receiver.'">Ignore</button>
              </div>
          </div>
      </div><hr>'; 
    }
    $i++;
  }
}

echo $aa;
?>
