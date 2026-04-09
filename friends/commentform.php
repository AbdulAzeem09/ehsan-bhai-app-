<?php
//session_start();
?>

<!-- <form action="../publicpost/addcomment.php" id="comntform" method="post"> -->
<form action="addcomment.php" id="comntform" method="post">
  <input type="hidden" name="spPostings_idspPostings" id="timlinepost" value="<?php echo $rows['idspPostings'] ?>">
  <input class="dynamic-pid" id="dynamic-pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $idspprofile ?>">

  <input name="userid" id="userid" type="hidden" value="<?php echo $_SESSION['uid'] ?>">


  <input name="profileid" id="pid" type="hidden" value="<?php echo $_GET['profileid'] ?>">





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
              echo "<img alt='profilepic' class='' src=' " . ($row["spProfilePic"]) . "' style='width: 30px; height: 30px;' >";
            else
              echo "<img alt='profilepic' class='' src='../assets/images/blank-img/default-profile.png' style='width: 30px; height: 30px;' >";
          }
          ?>
        </div>
        <input type="text" class="form-control enterkey  bradius-20" name="comment" id="timeline" data-id="<?php echo $rows['idspPostings'] ?>" placeholder="Type your comment here..." autocomplete="off" style='height:45px;border-radius: 0px;margin-bottom: 0px;'>
      </div>
      <span id=text_error class="red"></span>
    </div>
  </div>
</form>



<script type="text/javascript">
  $(document).ready(function() {
    $("#comntform").on("submit", function() {


      var txtIndusrtyType = $("#timeline").val();

      var flag = 0;

      if (txtIndusrtyType != "") {
        var strArr = new Array();
        strArr = txtIndusrtyType.split("");

        if (strArr[0] == " ") // this is the the key part. you can do whatever you want here!
        {
          flag = 1;
        }


      }

      if (txtIndusrtyType == "") {


        $("#text_error").text("Please Enter comment.");
        return false;

      } else if (flag == 1) {
        $("#text_error").text("Space not allowed.");
        return false;

      } else {

        $("#comntform").submit();
        return true;
      }

    });
  });
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
  function post() {
    var comment = document.getElementById("timeline").value;
    if (comment) {
      $.ajax({
        type: 'post',
        url: 'addcomment.php',
        data: {
          user_comm: comment,
          user_name: name
        },
        success: function(response) {
          /*      document.getElementById("all_comments").innerHTML=response+document.getElementById("all_comments").innerHTML;
           */
          document.getElementById("timeline").value = "";
          /*        document.getElementById("username").value="";
           */
        }
      });
    }

    return false;
  }
</script>