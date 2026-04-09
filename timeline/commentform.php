
<input type="hidden" name="spPostings_idspPostings" id="timlinepost" value="<?php echo $rows['idspPostings'] ?>">

<input class="dynamic-pid" id="dynamic_pid" name="spProfiles_idspProfiles" type="hidden" value="<?php echo $idspprofile ?>">
<input name="userid" id="userid" type="hidden" value="<?php echo $_SESSION['uid'] ?>">
<input name="callFromPostDetailPage" type="hidden" id="callFromPost" value="<?php echo (isset($callFromPostDetailPage) && $callFromPostDetailPage) ? true : false; ?>">
<!--   <input name="profileid" id="profileid"  type="hidden" value="<?php echo $_SESSION['uid'] ?>"> -->

<span id="text_error_<?php echo $rows["idspPostings"] ?>" class="red" style="
padding-left: 29px;"></span>
<div class="row" style="margin-right: 10px;">
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

<?php ?>

<input type="text" maxlength="70" class="form-control enterkey timelin_comm_text bradius-20" name="comment" id="timeline_msg" data-id="<?php echo $rows['idspPostings'] ?>" required placeholder="Type your comment here..." autocomplete="off" style='height:45px;border-radius: 0px;margin-bottom: 0px; width:autocomplete;z-index: 0;'>
</div>
</div>
</div> 
<style>
#timeline_1 {
    margin: 0 !important;
    position: relative;
    top: -36px;
    right: 33px;
    border-radius:20px;
}
</style>

<button onclick="myFunction();"  class="float-right btn btn-primary alert-button fa fa-send-o"  id="timeline_1" data-id="<?php echo $rows["idspPostings"] ?>" ></button>

<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>-->
<script>
function myFunction() {
    var postid = $("#timlinepost").val();
    var pid = $("#dynamic_pid").val();
    var uid = $("#userid").val();
    var postdetail = $("#callFromPost").val();
    var comment = $("#timeline_msg").val();
if(comment == ""){
   Swal.fire({
                title: 'Warning',
                text: 'Please write any text on comment',
                icon: 'danger',
                confirmButtonText: 'OK'
            });}else{ 
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
            // SweetAlert ka istemal success message dikhane ke liye
            Swal.fire({
                title: 'Success',
                text: 'Comment added successfully!',
                icon: 'success',
                confirmButtonText: 'OK'
            });

            // Comment ko append karna
            $("#comment_field").append(response);
            $("#timeline_msg").val("");
        },
        error: function() {
            // SweetAlert ka istemal error message dikhane ke liye
            Swal.fire({
                title: 'Error',
                text: 'An error occurred while adding a comment.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
}
}

</script>

<script>




function submitformcomment() {
         e.preventDefault();
        alert('aaaaa');
        var form = $(this);
        var actionUrl = form.attr('action');
        
        $.ajax({
            type: "POST",
            url: actionUrl,
            data: form.serialize(),
            dataType: "json",
            success:function(data){
                // Process with the response data
            }
        });
 
}

</script>

