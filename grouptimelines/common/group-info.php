<?php

function generate_allmember_thumb($row){
    $BaseUrl = $GLOBALS['BaseUrl'];
    $profilename = $row['spProfileName'];
    $profileid = $row['idspProfiles'];
    $profile_type = $row['profile_type'];
    $profile_pic = isset($row['spProfilePic']) ? $row['spProfilePic'] :  $BaseUrl."/assets/images/icon/blank-img.png";
    $div = ' <div class="box">
                <div class="img-wrapper">
                     <a href="#" class="view_prof" data-prof="'.$profileid.'"><img src="'.$profile_pic.'" alt=""></a>
                </div>                                
            </div>';
    return $div;
}

$logo_image = (!empty($group_logo_image)) ? $group_logo_image : './images/group-logo.svg';

?>
<style>
    .logo-wrapper .logo-img-edit{
        position: fixed;
        color: white;
        top: -12px;
        right: -6px;
        cursor:pointer;
    }
</style>
<div class="group-info">
    <div class="logo">
        <img src="./images/bg.svg" alt="" class="bg">
        <div class="logo-wrapper">
            <?php 
                if(in_array($role, ["owner", "admin", "asstadmin"])){ ?>
                    <input type="hidden" id="logo_group_id" value="<?= $_GET['groupid']; ?>">
                    <input type="file" style="display:none;" id="editgoruplogo" accept="image/jpeg, image/png">
                    <span class="logo-img-edit" id="editgoruplogoButton"><i class="fa fa-edit"></i></span>
            <?php } ?>
            <img id="logo-img" src="<?= $logo_image ?>" alt="">
        </div>
    </div>
    <div class="name">
        <?php echo $_GET["groupname"]; ?>
    </div>
    <div class="popup-detail">
        <div class="privacy">                            
            <?php echo $group_type ; ?>
        </div>
        <span>.</span>
        <div class="member">
            <?php echo "Members $activeCounter " ; ?>
        </div>
    </div>
    <div class="line"></div>
    <div class="members">
        <?php
            if ($activeCounter !='') {               
                while ($row = mysqli_fetch_assoc($getActiveMembers)) {
                    echo generate_allmember_thumb($row);                    
                }
            }
            else {
                echo "No Members.";
            }
        ?>                                             
        <div class="box box-text">
            <?php $total_member_of_group = (float) $total_member_count ?? 0; ?>
            <?= number_format_short($total_member_of_group) ?>
        </div>
    </div>

    <?php 
        $invite_btn = '<div class="invite-btn" data-bs-toggle="modal" data-bs-target="#invite">
                        <img src="./images/add-4.svg" alt="">
                        <span>Invite</span>
                    </div>';                      

        if(in_array($role, ["owner", "admin", "asstadmin"]) && $group_row_data && $group_row_data['status'] == "active" && $group_row_data['spgroupflag'] == 1){
            echo  $invite_btn;
        }
    ?>
    
    <div class="line"></div>
    <a href="/my-groups/" class="view-all">
        <div class="link">
            <div class="icon">
                <img src="./images/arrow.svg" alt="">
            </div>
            <span>Return To Home</span>
        </div>
    </a>
</div>

<script>
    //edit group logo
    $('#editgoruplogoButton').on('click', function() {
        $('#editgoruplogo').click();
    });

    $('#editgoruplogo').on('change', function() {
        $("div.global_spanner").addClass("show");
        $("div.global_overlay").addClass("show");
        // localStorage.setItem('logo_validate', "fail");
        var file = this.files[0]; 

        // var reader = new FileReader();
        // reader.readAsDataURL(file);
        // reader.onload = function (e) {
        //     var image = new Image();
        //     image.src = e.target.result;
        //     image.onload = function () {
        //         var height = this.height;
        //         var width = this.width;
        //         if (height > 300 || width > 300) {
        //             toastr.error(`Sorry, this image doesn't look like the size we wanted. It's ${width} x ${height} but we require 300 x 300 size image.`);
        //             localStorage.setItem('logo_validate', 'fail');
        //             $("div.global_spanner").removeClass("show");
        //             $("div.global_overlay").removeClass("show");
        //         }else{
        //             localStorage.setItem('logo_validate', 'pass');
        //         }
        //     };
        // }

        setTimeout(() => {
            // localStorage.getItem('logo_validate') == 'pass' &&
            // Note add condition if size validation
            if ( file) {
                var fileType = file.type;
                if (fileType === 'image/jpeg' || fileType === 'image/png') {
                    var formData = new FormData();
                    formData.append('groupid', $("#logo_group_id").val());
                    formData.append('editGrouopLogo', "yes");
                    formData.append('spgrouplogo', file);
                    $.ajax({
                        type: "POST",
                        url: '/grouptimelines/common/group_action.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $("div.global_spanner").removeClass("show");
                            $("div.global_overlay").removeClass("show");
                            response = JSON.parse(response);
                            if(response.status == "success"){ 
                                toastr.success(response.message);
                                localStorage.setItem('logo_validate', '');
                                localStorage.removeItem('logo_validate');
                                $("#logo-img").prop('src', response.path);
                            }else{
                                toastr.error(response.message);
                            }
                        }
                    });
                } else {
                    toastr.error('Please upload image in jpeg, png format only.');
                }
            }
        }, 4000);        
    });
</script>