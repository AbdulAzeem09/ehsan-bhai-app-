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
        <input type="text" class="form-control enterkey timelin_comm_text  bg-white" name="comment" id="timeline" data-id="<?php echo $rows['idspPostings'] ?>" required placeholder="Type your comment here..." autocomplete="off" style='height:52px;border-radius: 30px!important;margin-bottom: 0px; width:autocomplete;z-index: 0; border:1px solid #dee2e6; padding: 20px 50px 20px 20px;'>
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
  <button type="button" class="float-right btn text-white fa fa-send-o" id="timeline_1" onclick="myFunction_1()" style="width: 36px;
                    height: 36px;
                    border-radius: 50%;
                    background-color: #FB8308;
                    position: absolute;
                    right:12px;
                    z-index: 9;z-index: 0;margin-top: 3px;margin-right:15px"></button>
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
        $("#comment_field").append(response);
        $("#timeline").val("");
        location.reload();
        // Swal.fire({
        //   title: 'Success',
        //   text: 'Comment added successfully!',
        //   icon: 'success',
        //   confirmButtonText: 'OK'
        // });
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
