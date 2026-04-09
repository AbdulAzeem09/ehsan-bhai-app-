<?php  
    if($role=="pending" || $role=="blocked" || $role=="rejeted" || $role=="nomember" ) {return false;}

    $ge = new _spgroup_event;
    $groupid = $_GET['groupid'];
    if(isset($_GET['start']) && isset($_GET['end'])){
        $start = $_GET['start'];
        $end = $_GET['end'];
        $events = $ge->searchEventByDate($_GET['start'], $_GET['end']);
    }else{
        $start = $end = date("Y-m-d");
        $events = $ge->publicgroup_event($groupid);
    }
?>
<div class="events">
    <div class="heading-wrapper">
        <div class="main-heading">
            Events
        </div>
        <div class="more-btn">
            <div class="btn" data-bs-toggle="modal" data-bs-target="#add-event">
                <img src="./images/add-4.svg" alt="">
                <span>Add Event</span>
            </div>
        </div>
    </div>
    <style>
        .search-icon2 {
            width: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 36px !important;
            border-radius: 4px !important;
            cursor: pointer;
            background-color: #FB8308;
            margin-top: 30px;
        }
    </style>
    
    <div class="announcement" style="padding-bottom: 35px;">
        <div class="search-box filters">
            <?php 
                $getParams = $_GET;
                unset($getParams['grouptimelinePage']);
                unset($getParams['keyword']);
                $searchUrl = "/grouptimelines/?".http_build_query($getParams);
                unset($getParams['start']);
                unset($getParams['end']);
                $resetUrl = "/grouptimelines/?".http_build_query($getParams);
            ?>
            <form onSubmit="return false;" action="<?= $searchUrl ?>" id="search" style="display: flex;gap: 25px;">
                <div class="input-group">
                    <label>Start Date</span></label>
                    <input type="date" name="start" id="start" value="<?= $start; ?>">
                </div>
                <div class="input-group">
                    <label>End Date</span></label>
                    <input type="date" name="end" id="end" value="<?= $end; ?>">
                </div>
                <div class="search-icon2" onclick="window.location.href = $('#search').attr('action')+'&start='+$('#start').val()+'&end='+$('#end').val();">
                    <img src="./images/search-3.svg" alt="">
                </div>
                <div class="search-icon2" onclick='window.location.href = "<?= $resetUrl ?>"' style="color:#fff;width:65px;">
                    Reset
                </div>
            </form>
        </div>
    </div>
    
    <div class="event-wrapper">
        <?php 
        if($events){
            while($row = mysqli_fetch_assoc($events)) {
                $bannerRes = $ge->readEventBanner($row['idspPostings']);
                if($bannerRes){
                    $banner = mysqli_fetch_assoc($bannerRes);
                    $bannerImage = $banner['spPostingPic'];
                }else{
                    $bannerImage = "./images/event-2.svg";
                }

                $p = new _spprofiles;
                $name = $p->getProfileName($row['spProfiles_idspProfiles']);
                $description = (strlen($row['spPostingNotes']) > 25) ? substr($row['spPostingNotes'], 0, 25) . "..." : $row['spPostingNotes'];
        ?>
            <div class="event-box">
                <div class="img-wrapper">
                    <img src="<?= $bannerImage; ?>" alt="<?= $row['spPostingTitle'] ?>" style="min-height: 182px;">
                </div>
                <div class="main-title">
                    <?= ucfirst($row['spPostingTitle']); ?>
                </div>
                <div class="sub-title">
                    <span><?= date('M d, Y H:i A', strtotime($row['spPostingDate'])) ?></span>
                </div>
                <div class="location">
                    <img src="./images/location-2.svg" alt="Location">
                    <?= ucfirst($row['spPostingEventVenue']); ?>
                </div>
                <div class="text">
                    <?= ucfirst($description); ?>
                </div>
                <div class="text">
                    Hosted by <?= $name ?>
                </div>
            </div>
        <?php } 
            }else{ ?>
                <h6>No Events found.</h6>
        <?php } ?>   

    </div>

    <div class="modal add-album-modal" id="add-event" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 modal_title" id="staticBackdropLabel">Create Event</h1>
                </div>
                <div class="modal-body">
                    <form onSubmit="return false;">
                        <input type="hidden" name="spgroupid" id="spgroupid" value="<?= $_GET['groupid'] ?? "" ?>">
                        <input type="hidden" name="spgroupname" id="spgroupname" value="<?= $_GET['groupname'] ?? "" ?>">
                        <input type="hidden" name="spPostingDate" id="spPostingDate" value="<?= date('Y-m-d') ?>">
                        <input type="hidden" name="spPostingVisibility" id="spPostingVisibility" value="-1">
                        <input type="hidden" name="spProfiles_idspProfiles" id="spProfiles_idspProfiles" value="<?= $_SESSION['pid'] ?? "" ?>">
                        <input type="hidden" name="spPostingsCountry" id="spPostingsCountry" value="<?= $_SESSION['Countryfilter'] ?? "" ?>">
                        <input type="hidden" name="spPostingsState" id="spPostingsState" value="<?= $_SESSION['Statefilter'] ?? "" ?>">
                        <input type="hidden" name="spPostingsCity" id="spPostingsCity" value="<?= $_SESSION['Cityfilter'] ?? "" ?>">

                        <div class="input-group in-1-col">
                            <label>Choose Event Banner Image <span style="color: #EF1D26;">*</span></label>
                            <input id="spPostingPic" accept=".png,.jpg,.jpeg" type="file" name="spPostingPic" >
                        </div>

                        <div class="input-group in-1-col">
                            <label>Select Album <span style="color: #EF1D26;">*</span></label>
                            <select id="spCategories_idspCategory_categoryname" name="spCategories_idspCategory_categoryname" required class="form-select" aria-label="Default select example">
                                <?php
                                    $categories = $grp->read_all_category();
                                    if($categories){
                                        while($row = mysqli_fetch_assoc($categories)) { ?>
                                            <option value="<?= $row['id'] ?>|<?= $row['group_category_name'] ?>"><?= ucfirst($row['group_category_name']) ?></option>
                                <?php } }?>
                            </select>
                        </div>

                        <div class="input-group in-1-col">
                            <label>Event Title <span style="color: #EF1D26;">*</span></label>
                            <input id="spPostingTitle" type="text" name="spPostingTitle" placeholder="Type Title">
                        </div>
                        <div class="input-group in-1-col">
                            <label>Description (550 Charectors) <span style="color: #EF1D26;">*</span></label>
                            <textarea id="spPostingNotes" name="spPostingNotes" placeholder="Enter Description"></textarea>
                        </div>
                        <div class="input-group in-1-col">
                            <label>Event Expiry Date <span style="color: #EF1D26;">*</span></label>
                            <input id="spPostingExpDt" type="date" name="spPostingExpDt" placeholder="event expiry Date" value="<?= date('Y-m-d') ?>">
                        </div>

                        <div class="input-group in-2-col">
                            <label>Event Start Date <span style="color: #EF1D26;">*</span></label>
                            <input id="spPostingStartDate" type="date" name="spPostingStartDate" placeholder="Event Start Date" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="input-group in-2-col">
                            <label>Event Start Time <span style="color: #EF1D26;">*</span></label>
                            <input id="spPostingStartTime" type="time" name="spPostingStartTime" placeholder="Event Start time" value="<?= date('H:i:s') ?>">
                        </div>

                        <div class="input-group in-2-col">
                            <label>Event End Date <span style="color: #EF1D26;">*</span></label>
                            <input id="spPostingEndDate" type="date" name="spPostingEndDate" placeholder="Event End Time" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="input-group in-2-col">
                            <label>Event End Time <span style="color: #EF1D26;">*</span></label>
                            <input id="spPostingEndTime" type="time" name="spPostingEndTime" placeholder="Event End time" value="<?= date('H:i:s') ?>">
                        </div>

                        <div class="input-group in-1-col">
                            <label>Event Venue <span style="color: #EF1D26;">*</span></label>
                            <input id="spPostingEventVenue" type="text" name="spPostingEventVenue" placeholder="Type Venue">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary save_event" data-gid="<?= $_GET['groupid']?>" id="create_event" style="background-color: #7649B3; color : white;">Create</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    //group create campaign
    $(document).on('click', '#create_event', function(e){
        var fileInput = $('#spPostingPic')[0];
        var spPostingPic = fileInput.files[0];
        var spCategories_idspCategory_categoryname = $("#spCategories_idspCategory_categoryname").val();
        var spPostingTitle = $("#spPostingTitle").val();
        var spPostingNotes = $("#spPostingNotes").val();
        var spPostingExpDt = $("#spPostingExpDt").val();
        var spPostingStartDate = $("#spPostingStartDate").val();
        var spPostingStartTime = $("#spPostingStartTime").val();
        var spPostingEndDate = $("#spPostingEndDate").val();
        var spPostingEndTime = $("#spPostingEndTime").val();
        var spPostingEventVenue = $("#spPostingEventVenue").val();
        var error = false;

        if(!spPostingPic){
            toastr.error('Please choose banner image');
            error = true;
        }
        if(spCategories_idspCategory_categoryname == ''){
            toastr.error('Please select category');
            error = true;
        }
        if(spPostingTitle == ''){
            toastr.error('Please enter title');
            error = true;
        }
        if(spPostingNotes == ''){
            toastr.error('Please enter desciption');
            error = true;
        }
        if(spPostingExpDt == ''){
            toastr.error('Please enter expiry date');
            error = true;
        }
        if(spPostingStartDate == ''){
            toastr.error('Please enter start date');
            error = true;
        }
        if(spPostingEndDate == ''){
            toastr.error('Please enter end date');
            error = true;
        }
        if(spPostingStartTime == ''){
            toastr.error('Please enter start time');
            error = true;
        }
        if(spPostingEndTime == ''){
            toastr.error('Please enter end time');
            error = true;
        }
        if(spPostingEventVenue == ''){
            toastr.error('Please enter event venue');
            error = true;
        }

        if(error == true){
            return false;
        }

        $("div.global_spanner").addClass("show");
        $("div.global_overlay").addClass("show");

        var formData = new FormData();
        formData.append('groupid', $(this).data("gid"));
        formData.append('create_event', "yes");
        formData.append('spPostingPic', spPostingPic); 
        formData.append('spPostingPic', spPostingPic);
        formData.append('spCategories_idspCategory_categoryname', spCategories_idspCategory_categoryname);
        formData.append('spPostingTitle', spPostingTitle);
        formData.append('spPostingNotes', spPostingNotes);
        formData.append('spPostingExpDt', spPostingExpDt);
        formData.append('spPostingStartDate', spPostingStartDate);
        formData.append('spPostingStartTime', spPostingStartTime);
        formData.append('spPostingEndDate', spPostingEndDate);
        formData.append('spPostingEndTime', spPostingEndTime);
        formData.append('spPostingEventVenue', spPostingEventVenue);
        formData.append('spgroupid', $('#spgroupid').val());
        formData.append('spgroupname', $('#spgroupname').val());
        formData.append('spPostingDate', $('#spPostingDate').val());
        formData.append('spPostingVisibility', $('#spPostingVisibility').val());
        formData.append('spProfiles_idspProfiles', $('#spProfiles_idspProfiles').val());
        formData.append('spPostingsCountry', $('#spPostingsCountry').val());
        formData.append('spPostingsState', $('#spPostingsState').val());
        formData.append('spPostingsCity', $('#spPostingsCity').val());
        
        $.ajax({
          type: "POST",
          url: 'common/group_action.php',
          data: formData,
          processData: false,
          contentType: false,
          success: function(response) {
            res = JSON.parse(response);
            $("div.global_spanner").removeClass("show");
            $("div.global_overlay").removeClass("show");
            if(res.status == "create_event"){ 
                $.alert({
                    title: res.title,
                    content: res.message,
                    buttons: {          
                        OK: function () {
                            window.location.reload();
                        }
                    } 
                });
            }else{
                $.alert({
                    title: 'Error!',
                    content: res.message,
                });
            }
          }
        });
    })
    
</script>