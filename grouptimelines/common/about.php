<div class="text-wrapper-2">
    <div class="main-heading">
        <div class="top-heading">
            About
        </div>
    </div>
    <div class="text">
        <?php echo $abt['spGroupAbout'];  ?>
    </div>                    
                        
    <div class="heading">
        Location
    </div>
    <div class="text">
        <i class="fa fa-globe"></i>
        <?php
            echo getLocation($abt["spUserCountry"], $abt["spUserState"], $abt["spUserCity"]);
        ?>
    </div>
</div>
