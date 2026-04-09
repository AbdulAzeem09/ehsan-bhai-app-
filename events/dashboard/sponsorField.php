    
    <?php
    session_start();
    function sp_autoloader($class) {
        include '../../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
    if(isset($_POST['sponsorId']) && $_POST['sponsorId'] > 0){
        $sp  = new _sponsorpic;
        $sponsorId = $_POST['sponsorId'];
        $res = $sp->readSponsor($sponsorId);
        if($res != false){
            $row2 = mysqli_fetch_assoc($res);

        }
    }
    ?>

    <script type="text/javascript">
        $(function () {
            //changer sponsor logo
            $(".sponsorPic").change(function () {
                if (typeof (FileReader) != "undefined") {
                    var spPreview = $("#spPreview");
                    //spPreview.html("");
                    var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
                    $($(this)[0].files).each(function () {
                        var file = $(this);
                        //alert(file[0].size);
                        if(file[0].size <= 2097152){
                            if (regex.test(file[0].name.toLowerCase())) {
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    var img = $("<div class='col-md-3 sponsorpost'><span class='fa fa-remove dynamicspimg closed'></span><img class='sponsorimg overlayImage' style='width:100%; height: 80px; margin-right:5px;' src='" + e.target.result + "'/></div>");
                                    //img.attr("style", "width:72px; height: 80px; margin-right:5px;");
                                    //img.attr("src", e.target.result);
                                    spPreview.html(img);
                                    document.getElementById("spPreview").classList.remove('hidden');
                                }
                                reader.readAsDataURL(file[0]);
                            } else {
                                alert(file[0].name + " is not a valid image file.");
                                //spPreview.html("");
                                return false;
                            }
                        }else{
                            alert(file[0].name + " is too large. Please upload image less then 2Mb.");
                            return false;
                        }
                    });
                } else {
                    alert("This browser does not support HTML5 FileReader.");
                }
            });
        });
    </script>
        
        <input type="hidden" name="idspSponsor" value="<?php echo $sponsorId;?>">
        <div class="row">
            
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sponsorTitle">Sponsor Name</label>
                    <input type="text" class="form-control" id="sponsorTitle" name="sponsorTitle" value="<?php echo $row2['sponsorTitle']?>" required />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sponsorWebsite">Company Website</label>
                    <input type="text" class="form-control" id="sponsorWebsite" name="sponsorWebsite" value="<?php echo $row2['sponsorWebsite'];?>" required />
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sponsor_idspProfile">Profile</label>
                    <select class="form-control" name="sponsor_idspProfile" value="<?php echo $row2['spProfile_idspProfile'];?>">  
                        <?php
                        $b = array();
                        $r = new _spprofilehasprofile;
                        $pv = new _postingview;
                        $res = $r->readall($_SESSION["pid"]);//As a receiver
                        //echo $r->ta->sql;
                        if($res != false){
                            while($rows = mysqli_fetch_assoc($res)){
                                $p = new _spprofiles;
                                $sender = $rows["spProfiles_idspProfileSender"];
                                array_push($b,$sender);
                                $result = $p->read($rows["spProfiles_idspProfileSender"]);
                                //echo $p->ta->sql;
                                if($result != false){
                                    $row = mysqli_fetch_assoc($result);
                                    echo "<option value='".$rows["spProfiles_idspProfileSender"]."'  >".$row["spProfileName"]."</option>";
                                }
                            }
                        }
                        //show profile as sender
                        $r = new _spprofilehasprofile;
                        $res = $r->readallfriend($_SESSION["pid"]);//As a sender
                        //echo $r->ta->sql;
                        if($res != false){
                            while($rows = mysqli_fetch_assoc($res)){
                                $rm = in_array($rows["spProfiles_idspProfilesReceiver"],$b,true);
                                if($rm == ""){
                                    $p = new _spprofiles;
                                    $result = $p->read($rows["spProfiles_idspProfilesReceiver"]);
                                    if($result != false){
                                        $receive = $rows["spProfiles_idspProfilesReceiver"];
                                        $row = mysqli_fetch_assoc($result);
                                        echo "<option value='".$rows["spProfiles_idspProfilesReceiver"]."'  >".$row["spProfileName"]."</option>";
                                    }
                                }
                            }
                        }
                        ?>
                        
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="sponsorCategory">Sponsorship Category</label>
                    <select class="form-control" name="sponsorCategory" value="<?php echo $row2['sponsorCategory'];?>">
                        <option class="Prime" <?php echo (isset($row2['sponsorCategory']) && $row2['sponsorCategory'] == 'Prime')?'selected':'';?> >Prime</option>
                        <option class="Platinum" <?php echo (isset($row2['sponsorCategory']) && $row2['sponsorCategory'] == 'Platinum')?'selected':'';?> >Platinum</option>
                        <option class="Gold" <?php echo (isset($row2['sponsorCategory']) && $row2['sponsorCategory'] == 'Gold')?'selected':'';?> >Gold</option>
                        <option class="Silver" <?php echo (isset($row2['sponsorCategory']) && $row2['sponsorCategory'] == 'Silver')?'selected':'';?> >Silver</option>
                        <option class="Media" <?php echo (isset($row2['sponsorCategory']) && $row2['sponsorCategory'] == 'Media')?'selected':'';?> >Media</option>
                    </select>
                </div>
            </div>
            
            <div class="col-sm-12">
                <div class="form-group">
                    <label for="sponsorDesc">Short Description</label>
                    <textarea class="form-control" name="sponsorDesc"><?php echo $row2['sponsorDesc'];?></textarea>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="spSponsorPic">Add Logo</label>
                            <input type="file" class="sponsorPic" name="spSponsorPic">
                            <p class="help-block"><small>Browse files from your device</small></p>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="form-group">
                            <label for="sponsorPreview">Logo Preview</label>
                            <div id="sponsorPreview"></div>
                            <div id="postingsponsorPreview">
                                <div class="row">
                                    <div id="spPreview" >
                                        <div class="col-md-3">
                                            <img src="<?php echo ($row2['sponsorImg']);?>" class="img-responsive" alt="">
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
        </div>
        

        