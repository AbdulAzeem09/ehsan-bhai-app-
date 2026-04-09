<div class="row">

 <div class="form-group">
<div class="col-md-6">
       <label for="spPostingStartDate_" class="lbl_9">Event Address <span style="color:red;">*</span><span id="evadd_err" class="label_error"></span></label>
    <textarea class="form-control" name="eventaddress" id="eventaddress"><?php echo (empty($eeventaddress) ? "" : $eeventaddress); ?></textarea>
</div>
</div>
   
    <div class="col-md-6">
        <div class="form-group">
            <?php
            $pr = new _spprofiles;

            if(isset($organizerId)){
                $resultpr = $pr->read($organizerId);
                //echo $p->ta->sql;
                if($resultpr != false){
                    $row2 = mysqli_fetch_assoc($resultpr);
                    echo $row2['spProfileName'];
                }
            }
            ?>
            <label for="spPostingEventOrgId_">Organizer Name <span style="color:red;">*</span><span style="color:blue;font-weight: 500;font-size: 11px;">(Type the name of organizer)</span> <span id="org_err" class="label_error"></span></label>
            <input type="hidden" id="spPostingEventOrgId_" class="spPostField" name="spPostingEventOrgId" value="<?php echo (isset($organizerId) && $organizerId != '')?$organizerId:''; ?>">
            
            <input type="text" class="form-control spPostField" id="spPostingEventOrgName" name="spPostingEventOrgName"  value="<?php echo (isset($organizerName))? $organizerName:''; ?>" required autocomplete="off" >            
        </div>
    </div>
    
</div>
</div>
<div class="row">
    

    <div class="col-md-6">
        <div class="form-group">
            <label for="eventcategory_" class="lbl_4">Category <span style="color:red;">*</span> <span id="lbl_4" class="label_error"></span></label>
            <select class="form-control spPostField" data-filter="1" id="eventcategory_" name="eventcategory" value="<?php echo (empty($category) ? "" : $category); ?>">
                 <option value="0">Select Category</option>
                <?php
                    $m = new _subcategory;
                    $catid = 9;
                    $result = $m->read($catid);

                  
                    if($result){
                        while($rows = mysqli_fetch_assoc($result)){ 
                           
                                  
                            ?>
                            <option value='<?php echo $rows["subCategoryTitle"]; ?>' <?php  if( trim($category) == trim($rows["subCategoryTitle"])){ echo 'selected'; } ?>><?php echo $rows["subCategoryTitle"];?></option>
                            <?php
                        }
                    }
                ?>
                
            </select>
        </div>
    </div>

    <div class="col-md-2">
        <label for="spPostingPrice" class="lbl_5">Ticket Price <span style="color:red;">*</span> <span id="lbl_5" class="label_error"></span></label>
        <div class="input-group">
            <span class="input-group-addon">USD</span>
            <input type="text" class="form-control" id="spPostingPrice" maxlength="5" data-filter="1" name="spPostingPrice" value="<?php if(isset($ePrice)){echo $ePrice;} ?>">
        </div>
        
    </div>
    <div class="col-md-4">
        <!-- <div class="form-group">
            <label for="spPostingCohost_">Co-Host Name</label>
            <input type="hidden" id="spPostingCohost_" class="spPostField" name="spPostingCohost_" value="">
            <input type="text" class="form-control spPostField" id="spPostingCohostName"  value="" required autocomplete="off" >            
        </div> -->

        <div class="form-group multi_select_cohost">
			<label for="spPostingCohost_">Co-Host Name <span style="color:blue;font-weight: 500;font-size: 11px;">(Do you have a co-host?)</span></label>
            <br>
            <?php
            $pf  = new _postfield;
            $pro = new _spprofiles;
            $allCohost = array();
            if(isset($_GET['postid']) && $_GET['postid'] > 0){
                $fieldName = "spPostingCohost_";
                $result6 = $pf->readCustomPost($_GET['postid'], $fieldName);
                //echo $pf->ta->sql."<br>";
                if($result6 != false){
                    while ($row6 = mysqli_fetch_assoc($result6)) {
                        if($row6['spPostFieldValue'] != ''){
                            
                            array_push($allCohost, $row6['spPostFieldValue']);
                        }
                    }
                }
            }
            //print_r($allFeature);
            ?>
            <select id="cohost" data-event="1" class="form-control spPostField" name="spPostingCohost" multiple="multiple"  style="width: 100%;">  
                <?php
                if(in_array($_SESSION['pid'], $allCohost)){
                    $selectco = "selected";
                }else{
                    $selectco = '';
                }
                
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
                            if(in_array($rows["spProfiles_idspProfileSender"], $allCohost)){
                                $selectco = "selected";
                            }else{
                                $selectco = '';
                            }
                            echo "<option value='".$rows["spProfiles_idspProfileSender"]."' ".$selectco." >".$row["spProfileName"]."</option>";
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
                                if(in_array($rows["spProfiles_idspProfilesReceiver"], $allCohost)){
                                    $selectco = "selected";
                                }else{
                                    $selectco = '';
                                }
                                echo "<option value='".$rows["spProfiles_idspProfilesReceiver"]."' ".$selectco." >".$row["spProfileName"]."</option>";
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
            <label for="spPostingEventVenue_" class="lbl_6">Venue <span style="color:red;">*</span> <span id="lbl_6" class="label_error"></span></label>
            <input type="text" class="form-control spPostField" data-filter="0" id="spPostingEventVenue_" name="spPostingEventVenue" value="<?php echo (empty($venu) ? "" : $venu); ?>" autocomplete="off" >
            <!-- <input id="geocomplete" class="form-control" type="text" placeholder="Type in an address" size="90" /> -->
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-group">
            <label for="hallcapacity_" class="lbl_7">Hall Capacity <span style="color:red;">*</span> <span id="lbl_7" class="label_error"></span></label>
            <input style="width:125px;" type="text" class="form-control spPostField" maxlength="5" data-filter="0" id="hallcapacity_" name="hallcapacity" step="5" value="<?php echo (empty($hallcapicty) ? "" : $hallcapicty); ?>"> 
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">
            <label for="ticketcapacity_" class="lbl_8">Ticket Capacity <span style="color:red;">*</span><span style="color:blue;font-weight: 500;font-size: 11px;">(How many ticket are you selling?)</span> <span id="tic_cap"></span> <span id="lbl_8" class="label_error"></span></label>
            <input type="text" style="width:125px;" class="form-control spPostField" maxlength="5" data-filter="0" id="ticketcapacity_" name="ticketcapacity" step="5" value="<?php echo (empty($ticketCapty) ? "" : $ticketCapty); ?>">
        </div>
		<div id="myDIV" style="display:none;color:red;">Ticket capacity should less than Hall Capacity</div>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label for="spPostingStartDate_" class="lbl_9">Start Date <span style="color:red;">*</span><span id="lbl_9" class="label_error"></span></label>
            <input type="text" class="form-control spPostField datepicker" data-filter="1" id="spPostingStartDate_" name="spPostingStartDate" value="<?php echo (empty($spStartDate) ? "" : $spStartDate); ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="spPostingExpDt" class="lbl_10">End Date <span style="color:red;">*</span>  <span id="end_date"></span><span id="lbl_10" class="label_error"></span></label>
            <input type="text" class="form-control datepicker" data-filter="0" id="spPostingExpDt" name="spPostingExpDt" value="<?php echo (empty($spEndDate) ? "" : $spEndDate); ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="spPostingStartTime_" class="lbl_11">Start Time <span style="color:red;">*</span> <span id="lbl_11" class="label_error"></span></label>
            <input type="time" class="form-control spPostField" data-filter="1"  id="spPostingStartTime_" name="spPostingStartTime" value="<?php echo (empty($srtTime) ? "" : $srtTime); ?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="spPostingEndTime_" class="lbl_12">End Time <span style="color:red;">*</span> <span id="end_time"></span><span id="lbl_12" class="label_error"></span></label>
            <input type="time" class="form-control spPostField"  data-filter="0" id="spPostingEndTime_" name="spPostingEndTime" value="<?php echo (empty($endTime) ? "" : $endTime); ?>">
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="form-group multi_select">
            <label for="addfeaturning_">Select Featuring</label>
            <br>
            <?php
            $pf  = new _postfield;
            $pro = new _spprofiles;
            $allFeature = array();
            if(isset($_GET['postid']) && $_GET['postid'] > 0){
                $result6 = $pf->readFeaturPost($_GET['postid']);
                //echo $pf->ta->sql."<br>";
                if($result6 != false){
                    while ($row6 = mysqli_fetch_assoc($result6)) {
                        if($row6['spPostFieldValue'] != ''){
                            $profileId = $row6['spPostFieldValue'];
                            array_push($allFeature, $profileId);
                        }
                    }
                }
            }
            //print_r($allFeature);
            ?>
            <select id="leftmenu" data-event="1" class="form-control spPostField" name="addfeaturning" multiple="multiple"  style="width: 100%;">  
                <?php
                if(in_array($_SESSION['pid'], $allFeature)){
                    $selected = "selected";
                }else{
                    $selected = '';
                }
                ?>
                <option value="<?php echo $_SESSION['pid'];?>" <?php echo $selected; ?>><?php echo $_SESSION['MyProfileName']; ?></option>
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
                            if(in_array($rows["spProfiles_idspProfileSender"], $allFeature)){
                                $selected = "selected";
                            }else{
                                $selected = '';
                            }
                            echo "<option value='".$rows["spProfiles_idspProfileSender"]."' ".$selected." >".$row["spProfileName"]."</option>";
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
                                if(in_array($rows["spProfiles_idspProfilesReceiver"], $allFeature)){
                                    $selected = "selected";
                                }else{
                                    $selected = '';
                                }
                                echo "<option value='".$rows["spProfiles_idspProfilesReceiver"]."' ".$selected." >".$row["spProfileName"]."</option>";
                            }
                        }
                    }
                }
                ?>
                
            </select>
        </div>
    </div>
    <div class="col-md-6">
        <label>&nbsp;</label>
        <div class="form-group showName">
            
        </div>
    </div>
</div>
<br>
