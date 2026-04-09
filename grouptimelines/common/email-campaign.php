<?php  if($role=="pending" || $role=="blocked" || $role=="rejeted" || $role=="nomember" ) {return false;} ?>
<?php 
if(in_array($role, ['owner','admin'])){
    $g = new _spgroup;
    $pid = $_SESSION['pid'];
    $groupid = $_GET['groupid'];
    $groupname = $_GET['groupname'];
    $campaigns = $g->getGroupCampaign($groupid);
?>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />    
    <script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <style>
        .select2-search__field, .select2-search, .select2-search--inline{
            width: 100% !important;
        }
    </style>
    <div class="photos files">
        <div class="heading-wrapper">
            <div class="main-heading">
                Email Campaign
            </div>
            <div class="more-btn">
                <div class="btn" data-bs-toggle="modal" data-bs-target="#add-Campaign" style="width:max-content !important;">
                    <img src="./images/add-4.svg" alt="">
                    <span>Create Campaign</span>
                </div>
            </div>
        </div>

        <div class="table-wrapper">        
            <?php
            if($campaigns){ ?>
                <table id="example" class="display" style="width:100%">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Message</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                </table>
            <?php } else { ?>
                <h6>No Campaign Data Found .</h6>
            <?php } ?>
        </div>
    </div>

    <div class="modal add-album-modal" id="add-Campaign" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Campaign</h1>
                </div>
                <div class="modal-body">
                    <form onSubmit="return false;">
                        <div class="input-group in-1-col">
                            <label>Campaign Title<span style="color: #EF1D26;">*</span></label>
                            <input id="campaign_title" type="text" name="title" placeholder="Enter Title">
                        </div>
                        <div class="input-group in-2-col">
                            <label>Date <span style="color: #EF1D26;">*</span></label>
                            <input id="campaign_date" type="date" name="date" placeholder="Enter Date" value="<?= date('Y-m-d') ?>">
                        </div>
                        <div class="input-group in-2-col">
                            <label>Time <span style="color: #EF1D26;">*</span></label>
                            <input id="campaign_time" type="time" name="time" placeholder="Enter Time" value="<?= date('H:i:s') ?>">
                        </div>
                        <div class="input-group in-1-col">                        
                            <label>Enter Message <span style="color: #EF1D26;">*</span></label>
                            <div id="campaign_message" class="postBox" style="height: 125px; width:-webkit-fill-available;width:inherit;"></div>
                        </div>

                        <div class="input-group in-1-col">
                            <label>Select Users <span style="color: #EF1D26;">*</span></label>
                            <select id="campaign_users" class="form-select select2" multiple="multiple" aria-label="Default select example">
                                <option value="select-all"> Select All</option>
                                <?php 
                                if ($activeCounter !='') {
                                    foreach($getActiveMembers as $key => $row)
                                    {
                                ?>
                                    <option value="<?= $row['idspProfiles'] ?>"><?= $row['spProfileName'] ?></option>
                                <?php 
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-gid="<?= $_GET['groupid']?>" data-type="photo" id="create_group_campaign" style="background-color: #7649B3; color : white;">Create</button>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <h6>You are not allowed to access this page.</h6>
<?php } ?>

<script>
    $(document).ready(function() {
        var quillFullComp = new Quill("#campaign_message", {
            modules: {
            toolbar: toolbarOptions,
            },
            theme: "snow",
            placeholder: "Type your message...",
        });

        //group create campaign
        $(document).on('click', '#create_group_campaign', function(e){  
            var campaign_title = $("#campaign_title").val();
            var campaign_message = '';
            var campaign_date = $("#campaign_date").val();
            var campaign_time = $("#campaign_time").val();
            var campaign_users = $("#campaign_users").val();
            var error = false;

            if(campaign_title == ''){
                toastr.error('Please enter title');
                error = true;
            }

            if(quillFullComp.getText().trim() == ""){
                toastr.error("Please enter message.");
                error = true;
            }
            
            if (quillFullComp != undefined) {
                campaign_message = quillFullComp.root.innerHTML;
            }

            if(campaign_date == ''){
                toastr.error('Please enter date');
                error = true;
            }

            if(campaign_time == ''){
                toastr.error('Please enter time');
                error = true;
            }

            if(campaign_users == ''){
                toastr.error('Please select user');
                error = true;
            }

            if(error == true){
                return false;
            }

            $("div.global_spanner").addClass("show");
            $("div.global_overlay").addClass("show");
            $.post("common/group_action.php", {
                grpid: $(this).data("gid"),
                create_group_campaign: true,
                user_or_group: 'user',
                type: 'Email',
                title : campaign_title,
                message : campaign_message,
                date: campaign_date,
                time: campaign_time,
                users: campaign_users
            }, function (r) {
                let res = JSON.parse(r);
                $("div.global_spanner").removeClass("show");
                $("div.global_overlay").removeClass("show");
                if(res.status=="create_group_campaign"){
                $.alert({
                    title: res.title,
                    content: res.message,
                    buttons: {          
                        OK: function () {
                            window.location.reload();
                        }
                    } 
                });
                }
                else {
                $.alert({
                    title: 'Error!',
                    content: res.message,
                });
                }
            
            });
        })
        //group end create campaign

        // Initialize Select2
        $('.select2').select2({
            multiple: true,
            width: '100%'
        });
        
        // Handle "Select All" logic
        $('.select2').on('change', function(e) {
            if ($('.select2').val().includes('select-all')) {
                var allValues = [];
                $('.select2 option').each(function() {
                    if ($(this).val() !== 'select-all') {
                        allValues.push($(this).val());
                    }
                });
                $('.select2').val(allValues).trigger('change');
            }
        });
    });

    $(document).ready(function() {
        $('#example').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": { 
                "url": "../../ajax-datatable.php",
                "type": "POST",
                data: {
                    table: 'sms_email_campaigns',
                    primaryKey: 'sms_email_campaigns.id',
                    where : " email_campaign_user_groups.group_id = <?= $groupid ?> ",
                    join : " left join email_campaign_user_groups on sms_email_campaigns.id = email_campaign_user_groups.campaign_id ",                    
                    dbRows : {
                        'sms_email_campaigns.name' : '0',
                        'sms_email_campaigns.text' : '1',
                        'sms_email_campaigns.date' : '2',
                        'sms_email_campaigns.time' : '3',
                        'sms_email_campaigns.status' : '4'
                    }
                }
            },
            "columns": [
                { "data": "0" },
                { "data": "1" },
                { "data": "2" }, 
                { "data": "3" },
                { "data": "4" }
            ],
            "language": {
                "infoFiltered": ""
            }
        });
    });
</script>
