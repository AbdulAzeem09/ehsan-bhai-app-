
<?php

  //Without Group
  $a = array();
  $r = new _spprofilehasprofile;
  $res = $r->readall($_SESSION["pid"]);//As a receiver
  $i = 0;
  if ($res != false) {
      while ($rows = mysqli_fetch_assoc($res)) {
          $i++;
          array_push($a, $rows["spProfiles_idspProfileSender"]);
      }
  }

  $res = $r->readallfriend($_SESSION["pid"]);//As a sender
  //$res = $r->friend($_SESSION["uid"]); //As a sender
  if ($res != false) {
      while ($rows = mysqli_fetch_assoc($res)) {

          $rs = in_array($rows["spProfiles_idspProfilesReceiver"], $a, true);
          if ($rs == "") {
              $i++;
          }
      }
  }
?>