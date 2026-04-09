<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');  

session_start();
function sp_autoloader($class){
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$conn = _data::getConnection();

$postid = $_POST["spPostings_idspPostings"];



$sql1 = "SELECT DISTINCT Reaction_id FROM splike  WHERE spPostings_idspPostings = $postid"; 
$rows1 = mysqli_query($conn, $sql1);

$active=0;

//print_r($rows1);die("ffffffffffffffffffff");

if( $rows1->num_rows > 0){
  //die("=================qqqqqqqqqqqqqqqqq");
while ($row = mysqli_fetch_assoc($rows1)) {
//print_r($row );

$rid = $row['Reaction_id'];
if($rid == 1){
$rection = "&#128525;";
}

if($rid == 2){
$rection = "&#128512;";
}
if($rid == 3){
$rection = "&#128546;";
}
if($rid == 4){
$rection = "&#129315;"; 
}
if($rid == 5){
$rection = "&#128563;";
}
if($rid == 6){
$rection = "&#128545;";
}
if($rid == 7){
$rection = "&#128077";
}

if($active==0){
$active1 = 'active';
}

if($active==1){
$active1 = '';
} 

echo '   <div role="tabpanel" class="tab-pane '.$active1.'" id="uploadTab'.$rid.'" style="padding:17px" >';

$sql2 = "SELECT * FROM splike  WHERE spPostings_idspPostings = $postid AND Reaction_id = $rid"; 
$rows2 = mysqli_query($conn, $sql2);
while($rows33 = mysqli_fetch_assoc($rows2)){
$profileid = $rows33['spProfiles_idspProfiles'];
$profileid_2 = $rows33['spProfiles_idspProfiles'];

$sql3 = "SELECT * FROM spprofiles  WHERE idspProfiles = $profileid"; 
$rows3 = mysqli_query($conn, $sql3);
$rows44 = mysqli_fetch_assoc($rows3);
// print_r($rows44);
// die("fffffffffffffffffffff");		
 $profileid=$rows44['spProfileType_idspProfileType']; 	

//$sql74="SELECT * FROM spprofiletype WHERE idspProfileType =$profileid";
//$rows74 = mysqli_query($conn, $sql74);
//print_r($rows74);die('=======++++'); 
$sp74 = new _spprofilehasprofile;
$resh74 = $sp74->shani44($profileid);
$rows55 = mysqli_fetch_assoc($resh74);
//print_r($rows55);die('=======++++');
          
// $hh=$rows55['spProfileTypeName'];
// echo $hh;die("==========");
echo "<div class='row'>";
echo "<div class='col-md-3'>";  
if($rows44['spProfilePic']){
echo "<img src=".$rows44['spProfilePic']." height='50px' width='50px' class='img img-circle'>";
} else {
echo "<img src='".$BaseUrl."/img/default-profile.png' height='50px' width='50px' style='border-radius:50px; margin-right:10px'>";
}
echo "</div>";
echo "<div class='col-md-9 posting'>";
echo "<a style='font-size:14px;' href='/friends/?profileid=".$profileid_2."'>".$rows44['spProfileName']."<br> (".$rows55['spProfileTypeName'].")</a>";
echo "<div class='row'>";
echo "<div class='col-md-12'>";  

$row['spProfileName']= $rows44['spProfileName'];

$row['idspProfiles']=  $profileid ;

if( $profileid !=$_SESSION["pid"] ){


$user_profiles_list = array(""); 

$profileObject = new _spprofilehasprofile;
$isAlreadyFriend = $profileObject->checkfriend($_SESSION["pid"],$row['idspProfiles']);

if($isAlreadyFriend!=false){
$checkRow = mysqli_fetch_assoc($isAlreadyFriend);
}
$requestFlag = $checkRow["spProfiles_has_spProfileFlag"];

if(($isAlreadyFriend == false && ! in_array($row['idspProfiles'], $user_profiles_list, TRUE))
|| 
($isAlreadyFriend != false 
&& $requestFlag == -1 && !
in_array($row['idspProfiles'], 
$user_profiles_list, TRUE))) {

$flag = 'NULL';
$fv = new _spprofilefeature;
$checkIsBlocked = $fv->chkBlock($_SESSION['pid'], $row['idspProfiles']);
$checkIsBlocked2 = $fv->chkBlock($row['idspProfiles'], $_SESSION['pid']);

// Is friend blocked
if($checkIsBlocked == false && $checkIsBlocked2 == false) {
?>
<div class="profile_section_<?php echo $row['idspProfiles'];?>">
<?php if($row['uid']!=$SESSION['uid']){ ?>
<span class="btn btnPosting sendRequestOnSearch" onclick="send_request('<?php echo $_SESSION['pid']; ?>' , '<?php echo $row['idspProfiles']; ?>', '<?php echo ucwords($row['spProfileName']); ?>','<?php echo $flag; ?>')" style="border-radius: 14px; background-color: green;color: white;">
Add Friend
</span>
<?php } ?>
</div>
<?php }
} else {
//elseif(!in_array($row['idspProfiles'], $user_profiles_list, TRUE) && ($requestFlag == 0 || $requestFlag == NULL)) { ?>
<div class="profile_section_<?php echo $row['idspProfiles'];?>">
<span class="btn btnPosting sendRequestOnSearch" onclick="cancel_request('<?php echo $_SESSION['pid']; ?>' , '<?php echo $row['idspProfiles']; ?>', '<?php echo ucwords($row['spProfileName']); ?>')" style="border-radius: 14px; background-color: green;color: white; padding-bottom: 4px; padding-top: 4px;">
Cancel Sent
</span>
</div>
<?php } 
//   echo "<a>Add Friend</a>";

}


echo "</div>";
echo "</div>";
echo "</div>";
echo "</div>";
}




echo '</div>';

$active ++;

}
}else{
 // die("=================ffffffff");
 
  echo "No Reaction";
}
?>
<script>
  function send_request(senderId, reciverId, profilename, flag) {
  
  $.post('../friends/sendrequest.php', {
  sender: senderId,
  reciever: reciverId,
  profilename: profilename,
  flag: flag
  }, function(d) {
  //window.location.reload();
  swal({
  title: "Friend request has been sent successfully.",
  type: "success",
  confirmButtonClass: "sweet_ok",
  confirmButtonText: "Ok",
  cancelButtonClass: "sweet_cancel",
  cancelButtonText: "No",
  showCancelButton: false,
  },
  function(isConfirm) {
  if (isConfirm) {
    
    //$(".send_profile_section_" + reciverId).html("");
    var onclick="cancel_request('"+senderId+"','"+reciverId+"','"+profilename+"')";
  $(".profile_section_" + reciverId).html('<span class="btn btnPosting cancelRequest" style="border-radius: 14px; color: white; background-color: green;" onclick="'+onclick+'">Cancel Sent</span>');
  //location.href = "<?php echo $BaseUrl; ?>/timeline/index.php";
  }
  });
  });
  }
  </script>

<script>
  function cancel_request(senderId, reciverId, profilename) {
  
  swal({
  title: "Do you want to Cancel Request?",

  type: "warning",
  confirmButtonClass: "sweet_ok",
  confirmButtonText: "Yes",
  cancelButtonClass: "sweet_cancel",
  cancelButtonText: "Cancel",
  showCancelButton: true,
  },
  function(isConfirm) {
  if (isConfirm) {

  $.post('../friends/cancelRequest.php', {
  sender: senderId,
  reciever: reciverId,
  profilename: profilename,
    

  }, function(d) { 
  //$("#send_profile_section_" + reciverId).html("");

  var onclick = "send_request('"+senderId+"','"+reciverId+"','"+profilename+"','NULL')";
  $(".profile_section_" + reciverId).html('<span class="btn btnPosting sendRequestOnSearch" style="border-radius: 14px; color: white; background-color: green;" onclick = "' + onclick + ' ">Add Friend </span>');
  });



  }
  });

  }
  </script>



<script type="text/javascript">
$(document).ready( function() {
//friend request send
$(".sendRequestOnSearch").click(function (i, e) {
var btn = this;
var senderId  = $(this).attr("data-sender");
//alert(senderId);
var reciverId  = $(this).attr("data-reciver");
// alert(reciverId);
var profilename  = $(this).attr("data-profilename");
//alert(profilename);
var flag  = $(this).attr("data-flag");
$.post('../friends/sendrequest.php', {sender: senderId, reciever: reciverId, profilename: profilename, flag:flag}, function (d) {
//window.location.reload();
swal({
//title: "Friend request has been sent successfully.",
type: "success",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Ok",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: false,
},
function(isConfirm) {
if (isConfirm) {
$("#send_profile_section_"+reciverId).html("");
$("#send_profile_section_"+reciverId).html('<span class="btn btnPosting" style="border-radius: 14px; color: white; background-color: green;">Cancel Sent</span>');
//location.href = "<?php echo $BaseUrl;?>/timeline/index.php";
}
});
});
});
});
</script>

<script type="text/javascript">
$(document).ready( function() {
//friend request send
$(".sendRequestOnSearch").click(function (i, e) {
var btn = this;
var senderId  = $(this).attr("data-sender");
//alert(senderId);
var reciverId  = $(this).attr("data-reciver");
// alert(reciverId);
var profilename  = $(this).attr("data-profilename");
//alert(profilename);
var flag  = $(this).attr("data-flag");
$.post('../friends/sendrequest.php', {sender: senderId, reciever: reciverId, profilename: profilename, flag:flag}, function (d) {
//window.location.reload();
swal({
//title: "Friend request has been cancel successfully.",
type: "success",
confirmButtonClass: "sweet_ok",
confirmButtonText: "Ok",
cancelButtonClass: "sweet_cancel",
cancelButtonText: "No",
showCancelButton: false,
},
function(isConfirm) {
if (isConfirm) {
$("#send_profile_section_"+reciverId).html("");
$("#send_profile_section_"+reciverId).html('<span class="btn btnPosting" style="border-radius: 14px;color: white; background-color: green;">Add friends</span>');
//location.href = "<?php echo $BaseUrl;?>/timeline/index.php";
}
});
});
});
});
</script>

