<?php if($role=="pending" || $role=="blocked" || $role=="rejeted" || $role=="nomember" ) {return false;} ?>

<?php if(in_array($role, ['owner','admin'])) { ?>
    <div class="setting">
        <div class="main-heading">
            <div class="top-heading">
                Setting
            </div>
        </div>
        <div class="tag" data-bs-toggle="modal" data-bs-target="#change-name-desc">
            <div class="text">Group Details</div>
            <span><img src="./images/edit-4.svg" alt=""></span>
        </div>
        <div class="tag" data-bs-toggle="modal" data-bs-target="#group-privacy">
            <div class="text">Group Privacy</div> <?php echo "($grouptype)"; ?>
            <span><img src="./images/edit-4.svg" alt=""></span>
        </div>                   
        <div class="tag" data-bs-toggle="modal" data-bs-target="#group-rules">
            <div class="text">Group Rules</div>
            <span><img src="./images/edit-4.svg" alt=""></span>
        </div>
        
        <div class="tag" data-bs-toggle="modal" data-bs-target="#member-location">
            <div class="text">Location</div>
            <span><img src="./images/edit-4.svg" alt=""></span>
        </div>

        <div class="tag" data-bs-toggle="modal" data-bs-target="#asst-admin-right">
            <div class="text">Asst Admin Rights</div>
            <span><img src="./images/edit-4.svg" alt=""></span>
        </div>
        <div class="tag" data-bs-toggle="modal" data-bs-target="#member-right">
            <div class="text">Members Rights</div>
            <span><img src="./images/edit-4.svg" alt=""></span>
        </div>
    </div>

    <div class="modal add-album-modal" id="change-name-desc" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Group Details</h1>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="input-group in-1-col">
                            <?php echo $abt['spGroupName'];  ?>
                        </div>
                        <div class="input-group in-1-col">
                            <label>Description<span style="color: #EF1D26;">*</span></label>
                            <textarea placeholder="Enter Description" id="grp_dsc" rows="6" cols="50"><?php echo $abt['spGroupAbout'];  ?></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="grp_abt_upd" <?php gid_pid(); ?> style="background-color: #7649B3; color : white;">Update</button>
                </div>
            </div>
        </div>
    </div>                


    <!-- privacy model -->

    <div class="modal add-album-modal" id="group-privacy" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Set Group Privacy</h1>
                </div>
                <div class="modal-body">
                    <div class="row set_priv">
                        <div class="col-md-6">
                            <label class="radio-label">Public</label>    
                            <input type="radio" id="grp_public" name="grp_type" <?php echo ($grouptype == "Public") ? "checked" : ""; ?> value="0">                                                    
                        </div>
                        <div class="col-md-6">
                            <label class="radio-label">Private</label>
                            <input type="radio" id="grp_private" name="grp_type" <?php echo ($grouptype == "Private") ? "checked" : "" ; ?> value="1">    
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="grp_pvc_upd" <?php gid_pid(); ?> style="background-color: #7649B3; color : white;">Update</button>
                </div>
            </div>
        </div>
    </div>   

    <!-- group-rules -->

    <div class="modal add-album-modal" id="group-rules" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Group Rules</h1>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="input-group in-1-col">
                            <label><b>Enter Group Rule Title</b></label>
                            <input placeholder="Enter Rule Title" id="grp_rule_title" value="<?php echo $abt['spgroupruletitle']; ?>">
                        </div>
                        <div class="input-group in-1-col">
                            <label><b>Enter Group Rules</b><br><i>use [spgrp] to get the group name, e.g. welcome to my [spgrp].</i> </label>
                            <textarea placeholder="Enter Rules" id="grp_rule" rows="6" cols="50"><?php echo $abt['spGroupRules'];  ?></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="grp_rul_upd" <?php gid_pid(); ?> style="background-color: #7649B3; color : white;">Update</button>
                </div>
            </div>
        </div>
    </div>   

    <!-- asst admin rights -->

    <?php
    $rights = [
        [   'user'=>["admin","member","asst_admin"],  'right'=>"Invite member"],
        [   'user'=>["admin"],  'right'=>"Remove member"],
        [   'user'=>["admin","asst_admin"],  'right'=>"Block member"],
        [   'user'=>["admin","asst_admin"],  'right'=>"Reject member"],
        [   'user'=>["admin","asst_admin"],  'right'=>"Approve member"],
        [   'user'=>["admin","asst_admin"],  'right'=>"Approve post"],
        [   'user'=>["admin","asst_admin"],  'right'=>"Delete post"],
        [   'user'=>["admin","asst_admin"],  'right'=>"Group Privacy"],
        [   'user'=>["admin","asst_admin"],  'right'=>"Group Details"],
        [   'user'=>["admin","asst_admin"],  'right'=>"Update Banner"],
        [   'user'=>["admin"],  'right'=>"Group Setting"],
        [   'user'=>["admin","asst_admin"],  'right'=>"Email Campaign"],
        [   'user'=>["admin","asst_admin"],  'right'=>"Manage Media"],
        [   'user'=>["admin","asst_admin"],  'right'=>"Manage Album"],
        [   'user'=>["admin","asst_admin"],  'right'=>"Manage Event"],
        [   'user'=>["admin","asst_admin"],  'right'=>"Manage Store"],
    ];
        

    ?>

    <div class="modal add-album-modal" id="asst-admin-right" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Assistant Admin Rights</h1>
                </div>
                <div class="modal-body">
                    <form action="" >
                        <ul class="rights">
                        <?php
                            foreach($rights as $r){
                                foreach ($r['user'] as $u) {                                    
                                    if ($u == 'admin'){
                                        echo  '<li><input type="checkbox" /> <label> ' .$r['right'].' </label></li>';
                                    }
                                }
                            }
                        ?>                            
                        </ul>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="grp_astrul_upd" <?php gid_pid(); ?> style="background-color: #7649B3; color : white;">Update</button>
                </div>
            </div>
        </div>
    </div>   

    <!-- member rights -->

    <div class="modal add-album-modal" id="member-right" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Member Rights</h1>
                </div>
                <div class="modal-body">
                    <form action="">
                        <ul class="rights">
                        <?php
                            foreach($rights as $r){
                                foreach ($r['user'] as $u) {                                    
                                    if ($u == 'member'){
                                        echo  '<li><input type="checkbox" /> <label> '.$r['right'].'</label></li>';
                                    }
                                }
                            }
                        ?>
                        </ul>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="grp_mmbrul_upd" <?php gid_pid(); ?> style="background-color: #7649B3; color : white;">Update</button>
                </div>
            </div>
        </div>
    </div>   

    <!-- member-location -->
    <div class="modal add-album-modal" id="member-location" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Change Location</h1>
                </div>
                <div class="modal-body">
                    <h6>Current Location</h6>
                    <div class="input-group in-1-col">
                        <p>
                            <i class="fa fa-globe"></i>
                            <?php
                                $country = $abt["spUserCountry"];
                                $state = $abt["spUserState"];
                                $city = $abt["spUserCity"];
                                echo getLocation($country, $state, $city);
                            ?>
                        </p>
                    </div>
                    <form action="">
                    <div class="input-group in-1-col">
                            <label>Country<span style="color: red">*</span></label>
                            <select class="form-select" name="spUserCountry" id="spUserCountry">
                                <option value="">Select Country</option>
                                <?php
                                    $co = new _country;
                                    $result3 = $co->readCountry();
                                    if ($result3 != false) {
                                    while ($row3 = mysqli_fetch_assoc($result3)) {
                                    ?>
                                <option value='<?php echo $row3['country_id']; ?>'
                                    <?php echo (isset($country) && $country  == $row3['country_id']) ? 'selected' : ''; ?>>
                                    <?php echo $row3['country_title']; ?></option>
                                <?php
                                    }
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="input-group in-1-col loadUserState">
                            <label>State<span style="color: red">*</span></label>
                            <select class="form-select" name="spUserState" id="spUserState">
                                <option>Select State</option>
                                <?php
                                    if (isset($state) && $state > 0) {
                                    $countryId = $country;
                                    $pr = new _state;
                                    $result2 = $pr->readState($countryId);
                                    if ($result2 != false) {
                                    while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                                <option value='<?php echo $row2["state_id"]; ?>'
                                    <?php echo (isset($state) && $state == $row2["state_id"]) ? 'selected' : ''; ?>>
                                    <?php echo $row2["state_title"]; ?> </option>
                                <?php
                                    }
                                    }
                                    }
                                    ?>
                            </select>
                        </div>
                        <div class="input-group in-1-col loadCity">
                            <label>City</label>
                            <select id="spUserCity" class="form-select" name="spUserCity">
                                <option>Select City</option>
                                <?php
                                    if (isset($city) && $city > 0) {
                                        $stateId = $state;
                                        $co = new _city;
                                        $result3 = $co->readCity($stateId);
                                        if ($result3 != false) {
                                        while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                                <option value='<?php echo $row3['city_id']; ?>'
                                    <?php echo (isset($city) && $city==$row3['city_id']) ? 'selected' : ''; ?>>
                                    <?php echo $row3['city_title']; ?></option> <?php
                                        }
                                        }
                                    } ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="grp_location_upd" <?php gid_pid(); ?> style="background-color: #7649B3; color : white;">Update</button>
                </div>
            </div>
        </div>
    </div>   

    <script type="text/javascript">
        //==========ON CHANGE LOAD COUNTRY IN ACCOUNT SETTING=======
        $("#spUserCountry").on("change", function () {
            var countryId = this.value;
            $.post("../loadUserState.php", {
                countryId: countryId
            }, function (r) {
                $(".loadUserState").html(r);
            });
            $("#spUserCity").html('');
        
        });
        //==========ON CHANGE LOAD COUNTRY IN ACCOUNT SETTING=======


        //==========ON CHANGE LOAD CITY==========

        $("#spUserState").on("change", function() {
            var state = this.value;
            $.post("../loadUserCity.php", {
                state: state
            }, function(r) {
                $(".loadCity").html(r);
            });
        });
        //==========ON CHANGE LOAD CITY==========

    </script>
<?php } else{ ?>
    <div class="setting">
        <h6><i class="fa fa-info-circle" > </i> You are not allowed to access this page.</h6>
    </div>
<?php } ?>