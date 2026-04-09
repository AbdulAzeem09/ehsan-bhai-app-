<?php
$page = 'connection';
include_once("../views/common/header.php");
require_once "../classes/Connection.php";
$con = new Connection();
$pendingCount = 0;
$pendingData = $con->getPendingRequestCount();
if($pendingData['data']){
  $pendingCount = $pendingData['data'];
}
$friendCount = 0;
$friendData = $con->getFriendsCount();
if(isset($friendData['data'])){
  $friendCount = $friendData['data'];
}
?>
            <div class="create-post-wrapper">
                <div class="main-heading">
                    Connections
                    <div class="menu-icon" onclick="sideBarOpen()">
                        <img src="./images/menu-icon.svg" alt="">
                    </div>
                </div>
                <input type="hidden" id="profile-id" value="<?php echo $_SESSION['pid']; ?>">
                <div class="group-navigation">
                    <div class="link active-link" onclick="showContent(event, 'connection')" data-sec="connection" >My Connections (<?php echo $friendCount; ?>)</div>
                    <div class="link" onclick="showContent(event, 'pending')" data-sec="pending" >Pending (<?php echo $pendingCount; ?>)</div>
                    <div class="link" onclick="showContent(event, 'recent')" data-sec="recent" >Recently Added</div>
                    <div class="link" onclick="showContent(event, 'birthday')" data-sec="birthday" >Birthdays</div>
                    <div class="link" onclick="showContent(event, 'connectionlevel')" data-sec="connectionlevel" >Connection Level</div>
                    <div class="link" onclick="showContent(event, 'following')" data-sec="following" >Following</div>
                    <div class="link" onclick="showContent(event, 'followers')" data-sec="followers" >My Followers</div>
                    <div class="link" onclick="showContent(event, 'blocklist')" data-sec="blocklist" >Blocked List</div>
                </div>
                <div id="content-error"></div>
                <div id="main-content">
                </div>
            </div>
            <?php
            include_once("../views/common/right-bar.php");
            ?>
        </div>
        <?php
        include_once("../views/common/footer.php");
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
    
    <script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/jquery-ui.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/emoji/vanillaEmojiPicker.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions;?>"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/connection.js?v=<?php echo $versions;?>"></script> 
    
</body>

</html>
