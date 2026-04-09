    <?php
        include('../univ/baseurl.php');
        include('../mlayer/SmsEmailCampaign.php');
        if(isset($_GET['groupid']) && isset($_GET['groupname'])){
            $txtgroupid = $_GET['groupid'];
            $txtgroupname = $_GET['groupname'];
        }

    ?>
    
            <div class="row">
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border" align="center">
                            <h3 class="box-title"><i class="fa fa-user-plus"></i> Add SMS Campaign</h3>
                        </div><!-- /.box-header -->
                        <!-- form start -->

                        <div class="box-body">
                            <div class="form-group">
                                <label for="name">Campaign Name</label>
                                <input class="form-control" id="name" placeholder="Name..." type="text" required>
                            </div>
                            <div class="form-group">
                                <label for="text">Text Message</label>
                                <textarea id="text" placeholder="Message..." class="form-control" rows="8" cols="30" maxlength="140" ></textarea>
                                <div id="textarea_feedback">140 characters remaining</div>
                            </div>

                            <div class="form-group">
                                <label for="pass">Date</label>
                                <input class="form-control" value="" id="datetoo"
                                placeholder="Date..." type="text">
                            </div>

                            <div class="form-group">
                                <label for="pass">Time</label>
                                <select class="form-control" id="time">
                                    <?php
                                    $start = "00:00";
                                    $end = "23:59";

                                    $tStart     = strtotime($start);
                                    $tEnd       = strtotime($end);
                                    $tNow       = $tStart;

                                    while($tNow <= $tEnd){
                                      echo '<option value="'.date("H:i",$tNow).'">'.date("H:i",$tNow).'</option>';
                                      $tNow = strtotime('+15 minutes',$tNow);
                                    }
                                    ?>
                                </select>

                            </div>
                            <div class="form-group">
                                <label for="pass">User / Group / Import Users</label>
                                <br>
                                <label class="radio-inline">
                                    <input type="radio" name="user_group" id="userOption" value="user" checked>User
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="user_group" id="groupOption" value="group">Group
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="user_group" id="importuserOption" value="importuser">Uploaded Users
                                </label>
                            </div>
                            <div id="user">
                                <div class="form-group">
                                    <h5><strong>Select User</strong></h5>
                                    <select id="users" name="users" multiple="multiple" class="form-control" style="width: 300px">  
                                        <?php
                                        $r = new _spprofilehasprofile;
                                        $unread = new _friendchatting;
                                        $a = array();
                                        $res = $r->friends($_SESSION["uid"]);//As a receiver
                                        //echo $r->ta->sql;
                                        if($res != false){
                                            while($rows = mysqli_fetch_assoc($res)){
                                                $rslt = $g->friendprofile($_SESSION["uid"],$rows["spProfiles_idspProfileSender"]);
                                                $groupname = "";
                                                $groupid = 0;
                                                $g = new _spgroup;
                                                if($rslt != false)
                                                {
                                                    $rws = mysqli_fetch_assoc($rslt);
                                                    $groupid = $rws["idspGroup"];
                                                    $groupname = $rws["spGroupName"];
                                                    $groupname = str_replace(' ', '', $groupname);
                                                }
                                                
                                                array_push($a,$rows["spProfiles_idspProfileSender"]);
                                                $p = new _spprofiles;
                                                
                                                $sender = $rows["spProfiles_idspProfileSender"];//Friend
                                                $receiver = $rows["spProfiles_idspProfilesReceiver"];//My
                                                $total = 0;
                                                $unres = $unread->unreadmessage($sender,$_SESSION["uid"]);//$receiver
                                                if($unres != false)
                                                {
                                                    $total = $unres->num_rows;
                                                }
                                                
                                                $result = $p->read($rows["spProfiles_idspProfileSender"]);
                                                if($result != false)
                                                {   
                                                    $row = mysqli_fetch_assoc($result);
                                                    echo "<option value='".$row['idspProfiles']."' id='".$row['idspProfiles']."' >".$row['spProfileName']."</option>";
                                                }
                                            }
                                        }
                                        //RECEIVER PROFILE NAME
                                        $b = array();
                                        $r = new _spprofilehasprofile;
                                        $res = $r->friend($_SESSION["uid"]);//As a sender
                                        //echo $r->ta->sql;
                                        if($res != false)
                                        {               
                                            while($rows = mysqli_fetch_assoc($res))
                                            {
                                                
                                                array_push($b,$rows["spProfiles_idspProfilesReceiver"]);
                                                
                                                
                                                $r = in_array($rows["spProfiles_idspProfilesReceiver"],$a,true);
                                                
                                                $receiver = $rows["spProfiles_idspProfilesReceiver"];//Friend
                                                $sender = $rows["spProfiles_idspProfileSender"];//My
                                                $total = 0;
                                                $unres = $unread->unreadmessage($receiver,$_SESSION["uid"]);
                                                //echo $unread->ta->sql;
                                                if($unres != false)
                                                {
                                                    $total = $unres->num_rows;
                                                }
                                                
                                                if($r == "")
                                                {
                                                    $p = new _spprofiles;
                                                    $groupid = 0;
                                                    $groupname = "";
                                                    $g = new _spgroup;
                                                    $rslt = $g->friendprofile($_SESSION["uid"],$rows["spProfiles_idspProfilesReceiver"]);
                                                    
                                                    if($rslt != false)
                                                    {
                                                        $rws = mysqli_fetch_assoc($rslt);
                                                        $groupid = $rws["idspGroup"];
                                                        $groupname = $rws["spGroupName"];
                                                        $groupname = str_replace(' ', '', $groupname);
                                                    }
                                                    
                                                    $result = $p->read($rows["spProfiles_idspProfilesReceiver"]);
                                                    if($result != false)//All friend details
                                                    {   
                                                        $row = mysqli_fetch_assoc($result);
                                                        echo "<option value='".$row['idspProfiles']."' id='".$row['idspProfiles']."' >".$row['spProfileName']."</option>";
                                                    }
                                                }
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div id="group" style="display:none">
                                <div class="form-group">
                                    <h5><strong>Select Group</strong></h5>
                                    <select id="groups" name="groups" multiple="multiple" class="form-control" style="width: 300px">  
                                        <?php 
                                            $g = new _spgroup;
                                            $result = $g->groupmember($_SESSION['uid']);
                                            //echo $p->ta->sql;
                                            //echo $g->ta->sql;
                                            if ($result != false){
                                                while($row = mysqli_fetch_assoc($result)) {
                                                    echo "<option value='".$row['idspGroup']."' id='".$row['idspGroup']."' >".$row['spGroupName']."</option>";
                                                }
                                            }
                                            
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div id="importuser" style="display:none">
                                <div class="form-group">
                                    <h5 ><strong>Select Uploaded Users</strong></h5>
                                    <select id="importusers" name="importusers" multiple="multiple" class="form-control" style="width: 300px">  
                                        <?php 
                                            $g = new emailCampaignUser;
                                            $result2 = $g->getImportEmail($_SESSION['uid']);
                                            if ($result2 != false){
                                                while($row2 = mysqli_fetch_assoc($result2)) {
                                                    echo "<option value='".$row2['id']."' id='".$row2['id']."' >".$row2['name']."</option>";
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="optionValue" id="optionValue" value="user" />
                            <input type="hidden" name="Ids" id="Ids" value="" />

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <button id="save" class="btn btn-primary">Start Campaign</button>
                            <input type="hidden" name="emails" id="emails" value="" />
                        </div>
                        <div class="box-footer">
                            <form style="border: 4px solid #a1a1a1;margin-top: 15px;padding: 10px;" action="<?php echo $BaseUrl;?>/grouptimelines/?groupid=<?php echo $txtgroupid;?>&groupname=<?php echo $txtgroupname?>&importFile" class="form-horizontal" method="post" enctype="multipart/form-data">
                                <input type="file" name="import_file"  id="import_file" required="" />
                                <br>
                                <button class="btn btn-primary" name="import" value="0" id="importEmail">Import Excel File</button>
                            </form>
                        </div>
                        <div class="box-footer downloadxlx">
                            <a href="<?php echo $BaseUrl?>/documents/users.xls"><i class="fa fa-file"></i> Download Sample Format</a> 
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box box-primary">
                        <div class="box-header with-border" align="center">
                            <h3 class="box-title"><i class="fa fa-user-plus"></i> SMS Campaign List</h3>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-left">Campaign Name</th>
                                        <th class="text-center">Date / Time</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Report</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $g = new SmsEmailCampaign;
                                    $result2 = $g->getsmmEmailCampaign($_SESSION['uid'] , 'sms');
                                    if ($result2 != false){
                                        while($row2 = mysqli_fetch_assoc($result2)) { ?>
                                            <tr>
                                                <td class="text-left"><?php echo $row2['name'];?></td>
                                                <td class="text-center"><?php echo $row2['date'];?><br><?php date('H:i',strtotime($row2['time']));?></td>
                                                <td class="text-center">
                                                    <?php
                                                    if($row2['status'] == 'pending'){ ?>
                                                        <font class="pending btn btn-warning"><?php echo $row2['status'];?></font> <?php
                                                    }
                                                    if($row2['status'] == 'Ok'){ ?>
                                                        <a href="Javascript:void(null)"><font class="doubleok btn btn-danger"><?php echo $row2['status'];?></font></a> <?php
                                                    }
                                                    if($row2['status'] == 'progress'){ ?>
                                                        <font class="progress1"><?php echo $row2['status'];?></font> <?php
                                                    }
                                                    ?>
                                                    
                                                </td>
                                                <?php
                                                if($row2['status'] == 'Ok'){ ?>
                                                    <td class="text-center">
                                                        <!-- <span class="btn btn-primary report" id="report" data-datac="<?php /// echo $campaign->job_id; ?>" ><a data-id="<?php //echo $campaign->job_id; ?>"> Report </a></span> -->
                                                        <a href="<?php echo $BaseUrl;?>/grouptimelines/?groupid=<?php echo $txtgroupid;?>&groupname=<?php echo $txtgroupname?>&Smsreport&jopid=<?php echo $row2['job_id']?>" data-id="<?php echo $row2['id']; ?>"> <button id="report" class="btn btn-success btn-report report"  data-datac="<?php echo $row2['job_id']; ?>">Report</button></a>
                                                    </td> <?php
                                                }
                                                ?>
                                                
                                               
                                            </tr> <?php
                                        }
                                    }
                                ?>
                           
                        </tbody>
                    </table>
                </div>
            </div>

                </div>
            </div>

    <!--MY SCRIPTS FOR FINAL TESTING START-->
    <script type="text/javascript">
        //SEND SMS API LINK
        $('#save').on('click', function () {
            $("#Ids").val('');
            var optionValue = $("#optionValue").val();
            if( optionValue == 'user'){
                var option = 'user';
                var selected = $("#user option:selected");
                
                var ids = "";
                selected.each(function () {
                     ids += + $(this).val() + ",";
                 });
                $("#Ids").val(ids);
            } else if(optionValue == 'group'){
                var option = 'group';
                var selected = $("#group option:selected");
                var ids = "";
                selected.each(function () {
                     ids += + $(this).val() + ",";
                 });
                $("#Ids").val(ids);
            }else{
                var option = 'importuser';
                var selected = $("#importuser option:selected");
                var ids = "";
                selected.each(function () {
                     ids += + $(this).val() + ",";
                 });
                $("#Ids").val(ids);
            }
            $.ajax({
                type:'POST',
                url:'http://127.0.0.1/the-share-page/grouptimelines/sms_campaign/sendSmsCampaign.php',
                data:{
                    'name':$('#name').val(),
                    'type':'Sms',
                    'text':$('#text').val(),
                    'date':$('#datetoo').val(),
                    'time':$('#time').val(),
                    'user_id':$('#user_id').val(),
                    'user_or_group':option,
                    'group_id':$('#groupOption').val(),
                    'status':'pending',
                    'Ids': $("#Ids").val(),

                },
                success:function (data) {
                    if(data=='success'){
                        swal('Success','Campaign added','success');
                        $('#name').val(''),
                        $('#text').val(''),
                        $('#datetoo').val(''),
                        $('#time').val('');
                        //location.reload();
                    }
                    else{
                        swal('Error',data,'error');
                    }
                },
                error:function (data) {                    
                    swal('Error',data,'error');
                }
            });
           
        })


        $(document).ready(function() {
            var text_max = 140;
            $('#textarea_feedback').html(text_max + ' characters remaining');
            $('#text').keyup(function() {
                var text_length = $('#text').val().length;
                var text_remaining = text_max - text_length;
                $('#textarea_feedback').html(text_remaining + ' characters remaining');
            });
        });



       
    </script>
    <!--MY SCRIPTS FOR FINAL TESTING END-->
   

    <script type="text/javascript">
   

$('#sendEmail').on('click', function () {
    $.ajax({
        type:'POST',
        url:'{{url('/send/campaign/email')}}',
        data:{
            'emails':$('#emails').val(),
        },
        success:function (data) {
            if(data=='success'){
                swal('Success','Campaign added','success');
                location.reload();    
            }
            else{
                swal('Error',data,'error');
            }
        },
        error:function (data) {
            swal('Error',data,'error');
        }
    });
})

$("#import").click(function(){
    var filename = $("#import_file").val();
    if ( filename == '' ){
        swal('Error','Please select the file','error');
        return false;
    }

    var ext = $('#import_file').val().split('.').pop().toLowerCase();
    if($.inArray(ext, ['xls']) == -1) {
        swal('Error','Invalid file choosen','error');
        return false;
    }
    
})


$(".report").click(function(){
    var datavalue = $(this).attr('data-id');
    return;
    $("#job_id").val(datavalue);
}); 



</script> 



