<form action="../publicpost/addcomment.php?groupid=<?php echo $_GET['groupid'] ?>&groupname=<?php echo $_GET['groupname'] ?>" id="comntform" method="post">
  <input type="hidden" name="spPostings_idspPostings" id="timlinepost" value="<?php echo $rows['idspPostings'] ?>">

  <input class="dynamic-pid" id="dynamic_pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $idspprofile ?>">
  <input name="userid" id="userid" type="hidden" value="<?php echo $_SESSION['uid'] ?>">
  <input name="callFromPostDetailPage" type="hidden" id="callFromPost" value="<?php echo (isset($callFromPostDetailPage) && $callFromPostDetailPage) ? true : false; ?>">
  <!--   <input name="profileid" id="profileid"  type="hidden" value="<?php echo $_SESSION['uid'] ?>"> -->
  <span id=text_error class="red" style="
    padding-left: 29px;"></span>
  <div class="row" style="margin-right: 1px;">
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



        <input type="text" class="form-control enterkey timelin_comm_text bradius-20" name="comment" id="timeline" data-id="<?php echo $rows['idspPostings'] ?>" required placeholder="Type your comment here..." autocomplete="off" style='height:45px;border-radius: 0px;margin-bottom: 0px; width:autocomplete;z-index: 0;'>
      </div>
    </div>
  </div>
  <style>
    #timeline_1 {
      margin-top: -39.5px;
      display: inline-block;
      border-radius: 20px;
      z-index: 40;
      position: relative;
      margin-right: 8px;
    }
  </style>
  <button type="button" class="float-right btn btn-primary fa fa-send-o" id="timeline_1" onclick="myFunction_1()" style="border-radius:20px;z-index: 0; margin-right: 20px;margin-top: 5px;"></button>
</form>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>-->

<script>
  function myFunction_1() {
    //$("#timeline_1").click(){
    var postid = $("#timlinepost").val();
    var pid = $("#dynamic_pid").val();
    var uid = $("#userid").val();
    var postdetail = $("#callFromPost").val();
    var comment = $("#timeline").val();


    $.ajax({
      url: "../publicpost/addcomment.php",
      type: "POST",
      data: {
        spPostings_idspPostings: postid,
        spProfiles_idspProfiles: pid,
        userid: uid,
        callFromPostDetailPage: postdetail,
        comment: comment
      },
      success: function(response) {
        // alert(response);
        Swal.fire({
                title: 'Success',
                text: 'Comment added successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            });
        $("#comment_field").append(response);
        $("#timeline").val("");
      }
    });
    //}
  }
</script>
<script>
  $(document).ready(function() {
    $("#timeline_1").on("click", function() {
      var dd = $('#timeline').val();

      if (dd != '') {

      } else {
        $('#text_error').html("Please Write the comment");
        return false;
      }


    });
  });
</script>
