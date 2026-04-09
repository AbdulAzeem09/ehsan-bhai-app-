<?php
//session_start();
?>

<form id="comntformProfile_<?php echo $rows['idspPostings'] ?>" method="post">
  <input type="hidden" name="spPostings_idspPostings" id="timlinepost" value="<?php echo $rows['idspPostings'] ?>">
  <input class="dynamic-pid" id="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $idspprofile ?>">

  <input name="userid" id="userid" type="hidden" value="<?php echo $_SESSION['uid'] ?>">
  <input name="profileid" id="pid" type="hidden" value="<?php echo $_GET['profileid'] ?>">
  <?php if ($_SESSION['guet_yes'] != 'yes') { ?>
    <div class="row ">
      <div class="col-md-12">
        <div class="input-group">
          <div class="input-group-addon commentprofile inputgroupadon border_none">
            <?php
            $p = new _spprofiles;
            $result = $p->read($idspprofile);
            if ($result != false) {
              $row = mysqli_fetch_assoc($result);
              if (isset($row["spProfilePic"]))
                echo "<img alt='profilepic' class='' src=' " . ($row["spProfilePic"]) . "' style='width: 30px; height: 30px; border-radius:20px' >";
              else
                echo "<img alt='profilepic' class='' src='../assets/images/blank-img/default-profile.png' style='width: 30px; height: 30px; border-radius:20px' >";
            }
            ?>
          </div>
          <input type="text" style="position: relative;float: left;width: 100%;margin-bottom: 0;    z-index: 0;" class="form-control timelin_comm_text bradius-20 single_comm_box_<?php echo $rows['idspPostings'] ?>" name="comment" id="timeline" data-id="<?php echo $rows['idspPostings'] ?>" placeholder="Type your comment here..." style='height:45px;border-radius: 0px;margin-bottom: 0px;'>
        </div>
        <span id="text_error_<?php echo $rows['idspPostings'] ?>" class="red"></span>
      </div>
    </div>
  <?php } ?>
</form>