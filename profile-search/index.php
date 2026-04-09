<?php
$page = 'profile_search';
include('../univ/baseurl.php');
include_once("../views/common/header.php");
require_once "../classes/Connection.php";
$con = new Connection();
function sp_autoloader($class) 
{
    include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

$txtCategory 	= $_REQUEST['txtCategory'];
$newString = preg_replace('/\d+/u', '', $txtCategory);
$string    = preg_replace('/-+/', '', $newString);
//get id from striing
$categoryId = preg_replace("/[^0-9]/", "", $txtCategory);
$txtSearch = $_REQUEST['term'];
$p = new _spprofiles;
$srpvt = $p->searchprofile($categoryId, $txtSearch);

$rowcount = ( $srpvt ? mysqli_num_rows($srpvt) : 0);
$pendingCount = 0;
$pendingData = $con->getPendingRequestCount($_REQUEST['term']);
if($pendingData['data']){
  $pendingCount = $pendingData['data'];
}

$myConnectionOBJ = new Connection();
$directMyConnection = $myConnectionOBJ->getFriendsList($_REQUEST['term']);

$friendCount = count($directMyConnection['data']);

$p = new _spprofiles;
$rpvt = $p->readProfiles($_SESSION["uid"]);
$user_profiles_list = array();
if ($rpvt != false) {
  while ($row = mysqli_fetch_assoc($rpvt)) {
    array_push($user_profiles_list, $row['idspProfiles']);
  }
}

?>
      <div class="create-post-wrapper">
          <div class="main-heading">
          <?= $rowcount ?> results found for the keyword '<?= $_REQUEST['term'] ?>'.
              <div class="menu-icon" onclick="sideBarOpen()">
                  <img src="./images/menu-icon.svg" alt="">
              </div>
          </div>
          <input type="hidden" id="profile-id" value="<?php echo $_SESSION['pid']; ?>">
          <div class="group-navigation">
              <div class="link active-link global" onclick="customTabFunction('global')">Public Profiles (<?= $rowcount ?>)</div>
              <div class="link pending" onclick="customTabFunction('pending')">Pending Requests (<?php echo $pendingCount; ?>)</div>
              <div class="link my-connection" onclick="customTabFunction('my-connection')">My Connections (<?php echo $friendCount; ?>)</div>
              <div class="link recently-added" onclick="customTabFunction('recently-added')">Recently Added</div>
              <div class="link connection-level" onclick="customTabFunction('connection-level')">Connection Level</div>
              <div class="link blocked-user" onclick="customTabFunction('blocked-user')">Blocked List</div>
            </div>
          <div id='main-content'>

          </div>
          <div class="main-content-global friend-list-wrapper">
            <?php if($rowcount>0){ while ($row = mysqli_fetch_assoc($srpvt)) { ?>
              <div class="friend">
                  <div class="img-wrapper">
                      <img src="<?= $row['spProfilePic'] ?? "/assets/images/icon/blank-img.png" ?>" onerror="this.src='/assets/images/icon/blank-img.png'" alt="">
                  </div>
                  <div class="detail">
                      <div class="name">
                        <a class='proname' href='<?php echo $BaseUrl ?>/friends/?profileid=<?= $row['idspProfiles'] ?>'>
                        <?= $row['spProfileName'] ?> - <span style='font-weight:200'>( <?= $row['spProfileTypeName'] ?> )</span>
                        </a>
                      </div>
                      <div class="mutual">Mutual Friends (0)</div>
                  </div>
                  <?php                                             
                    $profileObject = new _spprofilehasprofile;
                    $isAlreadyFriend = $profileObject->checkfriend($_SESSION["pid"], $row['idspProfiles']);
                    if ($isAlreadyFriend != false) {
                        $checkRow = mysqli_fetch_assoc($isAlreadyFriend);
                        $requestFlag = $checkRow["spProfiles_has_spProfileFlag"];
                    }else{
                      $requestFlag = false;
                    }
                    if ($requestFlag == false) {
                        $requestFlag = '';
                    }
                  ?>
                  <!-------->
                  <div class="icons">
                    <div class="three-dot" style="cursor: pointer;">
                        <img src="https://sharethepage.ashishsharma.co/assets/images/dot-2.svg" alt="" onclick="showMenu(<?= $row['idspProfiles'] ?>)">
                        <div class="three-dot-wrapper" id="three-dot-div<?= $row['idspProfiles'] ?>" style="display: none;">
                          <div class="option" onclick="follow(<?php echo $_SESSION['pid']; ?>, <?= $row['idspProfiles'] ?>)">
                            <img src="https://sharethepage.ashishsharma.co/assets/images/follow.svg" alt=""><span>Follow</span>
                          </div>
                          <div class="option groupinvite" data-pid="<?= $row['idspProfiles'] ?>">
                            <img src="https://sharethepage.ashishsharma.co/assets/images/add-4.svg" alt=""><span>Add to Group</span>
                          </div>
                          <div class="option" onclick="block(<?php echo $_SESSION['pid']; ?>, <?= $row['idspProfiles'] ?>)">
                            <img src="https://sharethepage.ashishsharma.co/assets/images/block.svg" alt=""><span>Block</span>
                          </div>
                        <!-----for friend start----->
                        <?php
                        if (($isAlreadyFriend == false && !in_array($row['idspProfiles'], $user_profiles_list, TRUE)) || ($isAlreadyFriend != false && $requestFlag == -1 && in_array($row['idspProfiles'], $user_profiles_list, TRUE))) { ?>
                          <?php
                            $flag = 'NULL';
                            $fv = new _spprofilefeature;
                            $checkIsBlocked = $fv->chkBlock($_SESSION['pid'], $row['idspProfiles']);
                            $checkIsBlocked2 = $fv->chkBlock($row['idspProfiles'], $_SESSION['pid']);
                            // Is friend blocked
                            if ($checkIsBlocked == false && $checkIsBlocked2 == false) { ?>
                              <div class="option" style='width: 20px;height: 20px;' onclick="send_request('<?php echo $_SESSION['pid']; ?>' , '<?php echo $row['idspProfiles']; ?>', '<?php echo ucwords($row['spProfileName']); ?>','<?php echo $flag; ?>')" >
                                <span style='background: #08B564;border-radius: 50%;padding: 2px;'><img src="../assets/images/connected-2.svg" alt=""></span><span>Connect</span>
                              </div>
                            <?php }
                        } 
                        else if (!in_array($row['idspProfiles'], $user_profiles_list, TRUE) && ($requestFlag == 0 || $requestFlag == NULL)) {
                          ?>
                          <div class="option" style='width: 20px;height: 20px;' onclick="cancel_request('<?php echo $_SESSION['pid']; ?>' , '<?php echo $row['idspProfiles']; ?>', '<?php echo ucwords($row['spProfileName']); ?>')" >
                          <span style='background: #08B564;border-radius: 50%;padding: 2px;'><img src="../assets/images/connected-2.svg" alt=""></span><span>Cancel</span>
                          </div>
                        <?php } else { ?>
                          <span class="btn " style="border-radius: 14px; background-color:#808080;">
                            Friend
                          </span>
                        <?php } ?>
                        <!-----for friend end----->
                        </div>
                    </div>
                    <div class="message" data-pid="3216"><img src="https://sharethepage.ashishsharma.co/assets/images/message-2.svg" alt="" class="option-icon"></div>
                    <div class="home"><img src="https://sharethepage.ashishsharma.co/assets/images/home-2.svg" alt="" class="option-icon"></div>
                  </div>
                  <!-------->
              </div>
            <?php }} ?> 
              
          </div>
      </div>
      <?php
      include_once("../views/common/right-bar.php");
      ?>
    </div>
    <?php
    // include_once("../views/common/footer.php");
    ?>
  </div>
  
  <div class="modal modal-4" id="messagebox" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Message</h1>
        </div>
        <div class="modal-body">
          <form id="messageform" action="">
            <input id="sender" name="sender" type="hidden" value="<?php echo $_SESSION['pid']?>">
            <input type="hidden" id="receiver" name="receiver">
            <div class="input-group in-1-col">
              <label>Message</label>
              <span style="color:red;" id="messageerror"></span>
              <textarea id="message" name="message" placeholder="Type a message" rows="4" cols="50"></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
          <button type="submit" id="send" class="btn btn-primary active">Send</button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal modal-4" id="addToGroup" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Add to group</h1>
        </div>
        <div class="modal-body">
          <form id="addToGroupForm" action="">
            <input id="addByWhom" name="addByWhom" type="hidden" value="<?php echo $_SESSION['pid']?>">
            <input type="hidden" id="newMember" name="newMember" value="">
            <div class="input-group in-1-col">
              <label>Choose Source</label>
              <select name="spShareToGroup" id="grouplist" class="form-select" aria-label="Default select example">
                <option value="0" selected>Choose Group</option>
              </select>
            </div>
          </form>
          <span style="color:red;display:none;" id="group-error"></span>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
          <button type="submit" id="addGroup" class="btn btn-primary active">Add</button>
        </div>
      </div>
    </div>
  </div>
  <?php include "../views/common/footer.php"; ?>
  <script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
  <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-ui.js"></script>
  <script src="<?php echo $BaseUrl; ?>/assets/emoji/vanillaEmojiPicker.js"></script>
  <script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions;?>"></script>
  <script src="<?php echo $BaseUrl; ?>/assets/js/connection.js"></script>
  <script src="<?php echo $BaseUrl; ?>/assets/js/posting/publicview.js"></script>
  <script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/sweetalert.min.js"></script>
  <script>
  function customTabFunction(type=''){
      $('.group-navigation .link').removeClass('active-link');
      $('.group-navigation .'+type).addClass('active-link');
      if(type=='global'){
        $('.main-content-global').show();
        $('#main-content').hide();
      }else{
        $('#main-content').show();
        $('.main-content-global').hide();
      }
      if(type=='pending'){
      getPending('recentlyAdded','<?= $_REQUEST['term'] ?>');
      }
      if(type=='my-connection'){
      getConnection('<?= $_REQUEST['term'] ?>');
      }
      if(type=='blocked-user'){
      getBlockedUser('recentlyAdded','<?= $_REQUEST['term'] ?>');
      }
      if(type=='recently-added'){
      getRecentlyAdded("recentlyAdded", "getRecentlyAdded",'<?= $_REQUEST['term'] ?>');
      }
      if(type=='connection-level'){
      getConnectionLevel('<?= $_REQUEST['term'] ?>');
      }
      
  }


  function send_request(senderId, reciverId, profilename, flag) {

    $.post('../friends/sendrequest.php', {
        sender: senderId,
        reciever: reciverId,
        profilename: profilename,
        flag: flag
    }, function(d) {
      Swal.fire({
        title: "Friend request is sent.",
        icon: "success",
        confirmButtonText: "Ok",          
        confirmButtonColor: '#FB8308',
        showCancelButton: false,
      }).then((result) => {
        if (result.isConfirmed) {
          var onclick = "cancel_request('" + senderId + "','" + reciverId + "','" + profilename + "')";
          $(".profile_section_" + reciverId).html('<span class="btn btnPosting cancelRequest" style="border-radius: 14px; background-color: red;" onclick="' + onclick + '">Cancel Request</span>');
          location.reload();
        }
      });
    });
  }


  function cancel_request(senderId, reciverId, profilename) {
    Swal.fire({
      title: "Cancel friend request?",
      icon: "warning",
      confirmButtonText: "Yes",
      cancelButtonText: "Cancel",
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6'
    }).then((result) => {
      if (result.isConfirmed) {
        $.post('../friends/cancelRequest.php', {
          sender: senderId,
          reciever: reciverId,
          profilename: profilename,
        }, function(d) {
          //$("#send_profile_section_" + reciverId).html("");
          var onclick = "send_request('" + senderId + "','" + reciverId + "','" + profilename + "','NULL')";
          $(".profile_section_" + reciverId).html('<span class="btn btnPosting sendRequestOnSearch" style="border-radius: 14px; background-color: green;" onclick = "' + onclick + ' ">Add Friend </span>');
          location.reload();
        });
      }
    });

  }
  </script>
</body>

</html>
