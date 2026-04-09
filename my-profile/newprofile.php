<?php
$page = 'profilepage';
include_once("../views/common/header.php");
require_once "../classes/CreateProfile.php";
$t = new CreateProfile();
$type = isset($_GET['type']) ? trim($_GET['type']) : "";
?> 
      <form class="profile" id="profile-form" method="post">
        <div class="create-profile">
          <div class="main-heading">
          Create New Profile
          </div>
          <div class="desc center">
            <a class="description" href="<?php echo $BaseUrl?>/my-profile/profile-home.php">
            Profile Description   
            </a>
          </div>
          <?php
            $bussCount = 0;
            $businessCount = $t->getUserProfileCount($_SESSION['uid'], 1);
            if(isset($businessCount['data']) && isset($businessCount['data']['total_count'])){
              $bussCount = $businessCount['data']['total_count'];
            }
            $freelancerCount = 0;
            $freelancerCountData = $t->getUserProfileCount($_SESSION['uid'], 2);
            if(isset($freelancerCountData['data']) && isset($freelancerCountData['data']['total_count'])){
              $freelancerCount = $freelancerCountData['data']['total_count'];
            }
            $proCount = 0;
            $professionalCount = $t->getUserProfileCount($_SESSION['uid'], 3);
            if(isset($professionalCount['data']) && isset($professionalCount['data']['total_count'])){
              $proCount = $professionalCount['data']['total_count'];
            }
            $empCount = 0;
            $employmentCount = $t->getUserProfileCount($_SESSION['uid'], 5);
            if(isset($employmentCount['data']) && isset($employmentCount['data']['total_count'])){
              $empCount = $employmentCount['data']['total_count'];
            }
            $famCount = 0;
            $familyCount = $t->getUserProfileCount($_SESSION['uid'], 6);
            if(isset($familyCount['data']) && isset($familyCount['data']['total_count'])){
              $famCount = $familyCount['data']['total_count'];
            }
          ?>
          <div class="creat-profile-wrapper">
            <div class="input-group">
              <label for="profile-select">Select Profile<span style="color: #EF1D26;">*</span></label>
              <select class="form-select" aria-label="Default select example" id = "profile-select" name="spProfileType_idspProfileType">
                <option value="0">Select profile</option>
                <?php
                  if($bussCount < 5){
                ?>
                <option value="1" <?php if ($type == 'business') { echo 'selected'; }?> >Business</option>
                <?php
                  }
                  if($proCount < 2){
                ?>
                <option value="3" <?php if ($type == 'professional') { echo 'selected'; } ?> >Professional</option>
                <?php
                  }
                  if($freelancerCount < 2){
                ?>
                <option value="2" <?php if ($type == 'freelancer') { echo 'selected'; } ?> >Freelancer</option>
                <?php
                  }
                  if($empCount < 1){
                ?>
                <option value="5" <?php if ($type == 'employment') { echo 'selected'; } ?> >Employment</option>
                <?php
                  }
                  if($famCount < 1){
                ?>
                <option value="6" <?php if ($type == 'family') { echo 'selected'; } ?> >Family</option>
                <?php
                  }
                ?>
              </select>
            </div>
            <div class="input-group">
              <label for="profilename" >Profile Name</label>
              <input type="text" placeholder="Enter Profile Name" id="profilename" name="spProfileName" >
            </div>
          </div>
        </div>
        <div id="additional-content"></div>
      </form>
      <div class="right-bar"style="display: none;">
        <div class="heading">
        Profile Picture
        </div>
        <div class="icon-wrapper" id="icon-wrapper">
          <img id="profile-image" src="../assets/images/profile-img1.svg" alt="">
        </div>
        <span class="error-message" id="upload-image-error" style="color:red;"></span>
        <div class="title">
          <a style="text-decoration: none; color: #4A0080;" href="#" id="upload-image-link">Upload Image</a>
          <input type="file" id="upload-image" accept="image/*" style="display:none;">
        </div>
        <div class="or">
        OR
        </div>
        <div class="title">
          <a style="text-decoration: none; color: #4A0080;" href="#" id="capture-photo-link">Capture Photo from Camera</a>
        </div>
        <div id="camera-container" style="display:none;">
          <video id="camera" width="320" height="240" autoplay></video>
          <a href="#" id="take-photo-link">Take Photo</a>
          <canvas id="canvas" style="display:none;"></canvas>
          <button id="upload-photo-link" class="button">Upload</button>
          <button id="cancel-photo-link" class="button">Cancel</button>
        </div>
        <div id="captured-image-container" style="display:none;">
          <img id="captured-image" alt="Captured Image">
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include_once("../views/common/footer.php");
include('../views/common/experienceModal.php');
?>
<script src="../assets/js/create-profile.js "></script>
<script src="../assets/js/posting/timeline.js"></script>  
<script src="../assets/js/validations.js"></script>
</body>
</html>
