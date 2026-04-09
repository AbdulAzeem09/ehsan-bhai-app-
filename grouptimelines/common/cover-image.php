<div class="cover-img-wrapper">
    <?php 
        $banner_image = (!empty($group_banner_image)) ? $group_banner_image : $prf->random_image();
    ?>
    <style>
        .covimg {
            background: url('<?= $banner_image; ?>') ;
            background-size:cover ; background-position: center ;
            width: 100%; height: 359px;
            overflow: hidden; border-radius: 12px;
        }
    </style>
    <div class="covimg"></div>
    <?php if(in_array($role, ['owner','admin'])) { ?>
        <input type="hidden" id="image_group_id" value="<?= $_GET['groupid']; ?>">
        <input type="file" style="display:none;" id="editgorupimage" accept="image/jpeg, image/png">
        <div class="edit-icon" id="editgorupimageButton">
            <span ><img src="./images/edit-2.svg" alt=""> Edit</span>
        </div>
    <?php } ?>
</div>