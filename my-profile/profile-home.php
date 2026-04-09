<?php
$page = 'profilehomepage';
include_once("../views/common/header.php");
require_once "../classes/CreateProfile.php";
?>
            <div class="create-profile-wrapper">
                <div class="main-heading">
                    Create Profile
                    <div class="menu-icon" onclick="sideBarOpen()">
                        <img src="<?php echo $BaseUrl?>/assets/images/menu-icon.svg" alt="">
                    </div>
                </div>
                <div class="sub-heading">
                    At The SharePage, you have the option to create multiple profiles for various functions such as a personal profile for your social networking, a family profile to connect with your family members, or a business profile to connect with all your business professionals, professional profile to create your professional page as well as a job seeker profile and freelancer profile.
                </div>
                <?php
                  $t = new CreateProfile();
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
                <div class="profiles-wrappers">
                    <div class="img-name">
                        <div class="name">PERSONAL PROFILE</div>
                        <div class="title">(Default PROFILE )</div>
                        <div class="img-wrapper">
                            <img src="<?php echo $BaseUrl?>/assets/images/personal-profile.svg" alt="">
                        </div>
                    </div>
                    <div class="detail">
                        <div class="desc-title">
                            The first profile you get when you register is the "Personal" profile and it is the default profile.
                        </div>
                        <div class="text">
                            You can visit any module with this profile. Personal profile is mostly used as a public profile for friends. So feel free to update your personal profile the way you want your friends to know you! 
                        </div>
                        <div class="text-title">
                            Limitation:
                        </div>
                        <div class="text">
                            You can not access the Freelancer module . Can not apply to jobs as well as you can not apply to projects on freelancer module. You also can not have a webspace with this profile .You will need to create a Business profile for the webspace. 
                        </div>
                        <button id="edit-personal" class="main-btn">CREATE PROFILE</button>
                    </div>
                </div>
                <div class="profiles-wrappers">
                    <div class="img-name">
                        <div class="name">FAMILY PROFILE</div>
                        <div class="title">(Create only 1 profile)</div>
                        <div class="img-wrapper">
                            <img src="<?php echo $BaseUrl?>/assets/images/family-profile.svg" alt="">
                        </div>
                    </div>
                    <div class="detail">
                        <div class="desc-title">
                            As the name suggests, the Family profile is to stay connectedd with all your family members - uncles, aunties, cousins, brothers, sisters and even your parents and communicate with your family members in privacy!</div>
                        <div class="text">
                            What goes in the family stays in the family! Finally you are free to share anything you want with your family and your friends or business contacts will not have any access to your personal life!</div>
                        <div class="text-title">
                            Limitation:
                        </div>
                        <div class="text">
                            The family profile will not be able access job module and freelancer module.
                        </div>
                        <?php
                          if($famCount < 1){
                        ?>
                        <button data-type="family" class="main-btn create-btn">CREATE PROFILE</button>
                         <?php
                          }
                        ?>
                    </div>
                </div>
                <div class="profiles-wrappers">
                    <div class="img-name">
                        <div class="name">BUSINESS PROFILE</div>
                        <div class="title">(Create up to 5 profiles)</div>
                        <div class="img-wrapper">
                            <img src="<?php echo $BaseUrl?>/assets/images/business-profile.svg" alt="">
                        </div>
                    </div>
                    <div class="detail">
                        <div class="desc-title">
                            Now you can seamlessly manage multiple businesses from the same platform and connect with your business associates with confidence through business profiles!                        </div>
                        <div class="text">
                            As a business profile you can access all the modules and sell products in Store module (Retail, Wholesale, Auction) and also post jobs, projects, events, classifed ads, real estate ads. You can create five (5) business profiles.                        </div>
                        <div class="text-title">
                            Limitation:
                        </div>
                        <div class="text">
                            You can pretty much access all the modules with your business profile. The only limitation is that you can not bid on a project in the Freelancer module with the Business Profile. To bid on a project, you will need to have a Freelancer profile.
                        </div>
                        <?php
                          if($bussCount < 5){
                        ?>
                        <button data-type="business" class="main-btn create-btn" >CREATE PROFILE</button>
                        <?php
                          }
                        ?>
                    </div>
                </div>
                <div class="profiles-wrappers">
                    <div class="img-name">
                        <div class="name">FREELANCER PROFILE</div>
                        <div class="title">(Create up to 2 profiles)</div>
                        <div class="img-wrapper">
                            <img src="<?php echo $BaseUrl?>/assets/images/freelancer-profile.svg" alt="">
                        </div>
                    </div>
                    <div class="detail">
                        <div class="desc-title">
                            Would you like to make some extra income in your free time doing freelancing work? Then create a Freelancer profile and start earning!                        </div>
                        <div class="text">
                            If you are multi-talented then create two different freelancer profiles and keep your freelancing work completely private from others! Freelancer profile is used in Freelancer module only to bid on projects.                         </div>
                        <div class="text-title">
                            Limitation:
                        </div>
                        <div class="text">
                          You can not access any other module using the Freelancer profile. This profile is only meant to be used in the Freelancer Module. You can have two freelancer profiles with complete different information.            </div>
                        <?php
                          if($freelancerCount < 2){
                        ?>
                        <button  data-type="freelancer" class="main-btn create-btn">CREATE PROFILE</button>
                        <?php
                          }
                        ?>
                    </div>
                </div>
                <div class="profiles-wrappers">
                    <div class="img-name">
                        <div class="name">PROFESSIONAL PROFILE</div>
                        <div class="title">(Create up to 2 profiles)</div>
                        <div class="img-wrapper">
                            <img src="<?php echo $BaseUrl?>/assets/images/professional-profile.svg" alt="">
                        </div>
                    </div>
                    <div class="detail">
                        <div class="desc-title">
                            With a Professional profile, you can showcase your qualification, professional achievements and create a professional network by connecting with like-minded professionals.                        </div>
                        <div class="text">
                            You can create two professional profiles. You can access all modules and do pretty much everything using the Professional Profile with a few exceptions.                        </div>
                        <div class="text-title">
                            Limitation:
                        </div>
                        <div class="text">
                            You can not bid on a project or apply for a job, for that you will have to create a Freelancer profile or a an Employment Profile.                         </div>
                        <?php
                          if($proCount < 2){
                        ?>
                        <button  data-type="professional" class="main-btn create-btn" >CREATE PROFILE</button>
                        <?php
                          }
                        ?>
                    </div>
                </div>
                <div class="profiles-wrappers">
                    <div class="img-name">
                        <div class="name">EMPLOYMENT PROFILE</div>
                        <div class="title">(Create only 1 profile )</div>
                        <div class="img-wrapper">
                            <img src="<?php echo $BaseUrl?>/assets/images/employment-profile.svg" alt="">
                        </div>
                    </div>
                    <div class="detail">
                        <div class="desc-title">
                            Employment profile is a private profile, it is not searchable unless you want to make it searchable                         </div>
                        <div class="text">
                          and it will only be used within the Job Module. Employment profile will be visible to the employer when you apply to a job. Unless you share your employment profile with another employment profile or business profile, and unless you change the status of your profile to "Public", your employment profile will be kept private and not searchable. You have one employement profile but you can create multiple resumes within this profile.                </div>
                        <?php
                          if($empCount < 1){
                        ?>
                        <button  data-type="employment" class="main-btn create-btn">CREATE PROFILE</button>
                        <?php
                          }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <?php
    include_once("../views/common/footer.php");
    ?>
    <script src="../assets/js/posting/timeline.js"></script>
    <script src="../assets/js/posting/profilehome.js"></script>
    <script>
       

        function sideBarOpen() {
            const sideBar = document.getElementById('side-bar');
            sideBar.style.transform = 'translateY(0)';
            console.log('Side--bar working')
        }
        function sideBarClose() {
            const sideBar = document.getElementById('side-bar');
            sideBar.style.transform = 'translateY(-150%)';
        }

    </script>
</body>
</html>
