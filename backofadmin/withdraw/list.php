<?php
if (!defined('WEB_ROOT')) {
    exit;
}

$sql =  "SELECT wr.id, sp.spUserName, wr.user_id, wr.userprofile_id, wr.amount, wr.status, wr.module, wr.spBankusername, wr.spBankname, wr.spBanknumber, wr.spBranchnumber, wr.spAccountnumber, wr.spBankcode, wr.date, wr.action_date, wr.converted_currency, wr.actionStatus FROM spwithdrawalreq_store as wr inner join spuser as sp  on wr.user_id = sp.idspUser";
$result  = dbQuery($dbConn, $sql);
?>
<!-- Content Header (Page header) -->
<section class="content-header top_heading">
    <h1>All Withdraw Request</h1>
</section>
<!-- Main content -->
<section class="content">
    <div class="box box-success">

        <?php
        if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
            if($_SESSION['count'] <= 1){
                $_SESSION['count'] +=1; ?>
                <div class="row" id="alertmsg" style="margin: 5px 0px 0px 5px;" >
                <div style="min-height:10px;"></div>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <?php echo $_SESSION['errorMessage'];  ?>
                </div>
                </div><?php
                unset($_SESSION['errorMessage']);
            }
        } ?>

        <div class="box-body" >
            <div class="row">
                <div class="col-xs-12">
                    <div class="table-responsive  tbl-respon">
                        <table id="example1" class="table table-bordered table-striped tbl-respon2">
                            <thead>
                            <tr>
                                <th style="width: 80px;">Report No</th>
                                <th>Username</th>
                                <th>User Profile Id</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Module</th>
                                <th>Bank Username</th>
                                <th>Bank Name</th>
                                <th>Bank Number</th>
                                <th>Branch Number</th>
                                <th>Account Number</th>
                                <th>Bank Code</th>
                                <th>Date</th>
                                <th>Action Date</th>
                                <th>Converted Currency</th>
                                <th class="text-center">Action</th>
                                <th>Action Status</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            if ($result) {
                                $i = 1;
                                while ($row = dbFetchAssoc($result)) {
                                    extract($row);
                                    ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i; ?></td>
                                        <td><?php echo $spUserName; ?></td>
                                        <td><?php echo $userprofile_id; ?></td>
                                        <td><?php echo $amount; ?></td>
                                        <td><?php echo ($status == 0)? "deactive": "active"; ?></td>
                                        <td><?php echo $module; ?></td>
                                        <td><?php echo $spBankusername; ?></td>
                                        <td><?php echo $spBankname; ?></td>
                                        <td><?php echo $spBanknumber; ?></td>
                                        <td><?php echo $spBranchnumber; ?></td>
                                        <td><?php echo $spAccountnumber; ?></td>
                                        <td><?php echo $spBankcode; ?></td>
                                        <td><?php echo $date; ?></td>
                                        <td><?php echo $action_date; ?></td>
                                        <td><?php echo $converted_currency; ?></td>
                                        <td class="menu-action text-center">
                                            <a data-target="#myModal_<?php echo $i; ?>" class="btn btn-primary" data-toggle="modal">Change Status</a>
                                            <div class="modal fade" id="myModal_<?php echo $i; ?>" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <button type="button" id="closeButton_<?php echo $i; ?>" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h3 id="myModalLabel">Select an Action</h3>
                                                        </div>
                                                        <div class="modal-body">
                                                             <div class="spinner-border" id="loader" style="display: none;"></div>
                                                            <input type="hidden" name="withdrawRequestId" id="withdrawRequestId_<?php echo $i; ?>" value="<?php echo $id; ?>">
                                                            <input type="hidden" name="userId" id="userId_<?php echo $i; ?>" value="<?php echo $user_id; ?>">
                                                            <input type="hidden" name="withdrawAmount" id="amount_<?php echo $i; ?>" value="<?php echo $amount; ?>">
                                                            <input type="hidden" name="assignedUserId" id="assignedUserId_<?php echo $i; ?>" value="<?php echo $_SESSION['userId']; ?>">
                                                            <input type="hidden" name="profileId" id="profileId_<?php echo $i; ?>" value="<?php echo $userprofile_id; ?>">
                                                            <input type="hidden" name="module" id="module_<?php echo $i; ?>" value="<?php echo $module; ?>">
                                                            <select id="dropdownlist_<?php echo $i; ?>" onchange="toggleInputField('<?php echo $i; ?>')">
                                                                <option selected>Pending</option>
                                                                <option>Approve</option>
                                                                <option>Reject</option>
                                                                <option>Need More Info</option>
                                                            </select>
                                                            <div id="adminMessage_<?php echo $i; ?>" style="display: none; padding-top: 10px;"></div>
                                                            <div id="inputField_<?php echo $i; ?>" style="display: none; padding-top: 10px;">
                                                                <div class="scroll-container" style="max-height: 200px; overflow-y: auto;">
                                                                    <ul class="list-group list-group-flush">
                                                                    <?php
                                                                        $sql =  "SELECT status.message, profile.spProfileName FROM spwithdrawalreq_store AS request INNER JOIN tbl_withdrawalreq_status AS status ON request.id = status.withdrawalreq_id INNER JOIN spprofiles AS profile ON status.profileid = profile.idspProfiles WHERE status.withdrawalreq_id = ".$id;
                                                                        $result1  = dbQuery($dbConn, $sql);
                                                                        if ($result1) {
                                                                            $j = 1;
                                                                            while ($row1 = dbFetchAssoc($result1)) {
                                                                                extract($row1);
                                                                                ?>
                                                                                <li class="list-group-item"><?php echo $spProfileName.': '.$message; ?></li>
                                                                                <?php
                                                                                $j++;
                                                                            }
                                                                        }
                                                                    ?>
                                                                </div>
                                                                Message:
                                                                <textarea id="message_<?php echo $i; ?>" rows="6" cols="10" class="form-control" style="max-width: 100%; min-width: 100%; overflow-y: auto;"></textarea>
                                                            </div>
                                                            <div>
                                                                <span id="message_error_<?php echo $i; ?>" style="color:red;"></span>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn" data-dismiss="modal" id="closeButton_<?php echo $i; ?>" aria-hidden="true">Close</button>
                                                            <button class="btn btn-primary" onclick="saveChanges('<?php echo $i; ?>')">Save changes</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <!--<a href="<?php //echo '?view=update&id='.$user_id; ?>" data-original-title="delete" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bg-yellow" onclick="return confirm('Are you sure you want to delete this item')"> <i class="fa fa-trash"></i> </a>-->

                                        </td>
                                        <td><?php echo $actionStatus; ?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--- End Table ---------------->
    </div>


</section><!-- /.content -->
<script type="text/javascript">
    var dataTableInstance;
    $(document).ready( function () {
        $('button[id^="closeButton_"]').on('click', function() {
            var buttonId = $(this).attr('id');
            var modalId = buttonId.split('_')[1];
            $('#myModal_' + modalId + ' #dropdownlist_' + modalId).val('Pending');
            $('#myModal_' + modalId + ' #adminMessage_' + modalId).hide();
            $('#myModal_' + modalId + ' #inputField_' + modalId).hide();
            $('#myModal_' + modalId + ' #message_' + modalId).val('');
            $('#myModal_' + modalId + ' #message_error_' + modalId).text('');
        });
        dataTableInstance = $('#example1').DataTable({
            "order": [[ 0, "desc" ]],
            pageLength : 10,
            lengthMenu: [[10, 20, 50, 100], [10, 20, 50, 100]]
        });
    } );

    function toggleInputField(rowId) {
        var dropdown = document.getElementById("dropdownlist_"+rowId);
        var inputField = document.getElementById("inputField_"+rowId);

        if (dropdown.value === "Reject" || dropdown.value === "Need More Info") {
            inputField.style.display = "block";
        }  else {
            inputField.style.display = "none";
        }
    }

    function saveChanges(rowId) {
        var originalState = $('#myModal_'+rowId).clone();
        var loader = document.getElementById('loader').style.display;
        loader = 'none';
        var dropdown = document.getElementById("dropdownlist_"+rowId).value;
        var requestId = document.getElementById("withdrawRequestId_"+rowId).value;
        var assignedUserId = document.getElementById("assignedUserId_"+rowId).value;
        var module = document.getElementById("module_"+rowId).value;
        var profileId = document.getElementById("profileId_"+rowId).value;
        var amount = document.getElementById("amount_"+rowId).value;
        var userId = document.getElementById("userId_"+rowId).value;
        if (dropdown === "Reject" || dropdown === "Need More Info") {
            if(dropdown === "Need More Info"){
                dropdown = "need_more_info"
            }
            var message = $("#message_"+rowId).val();
            if(message == ""){
                $("#message_error_"+rowId).text("Please Enter Message.");
                $("#message_"+rowId).focus();
                return false;
            }
            $.ajax({
                type: 'POST',
                url: 'withdraw_status.php',
                data: {
                    "status": dropdown,
                    "message": message,
                    "requestId": requestId,
                    "assignedUSerId": assignedUserId,
                    "module": module,
                    "profileId": profileId,
                },

                success: function(response){
                    loader = 'block';
                    response = JSON.parse(response);
                    if (response.status == 0){
                        alert(response.message);
                    } else {
                        alert(response.message);
                        $('#myModal_'+rowId).modal('hide');
                        window.location.reload();
                    }
                }
            });
        } else if(dropdown === "Approve"){

            $.ajax({
                type: 'POST',
                url: 'withdraw_approve.php',
                data: {
                    "amount": amount,
                    "userId": userId,
                    "module": module,
                },

                success: function(response){
                    response = JSON.parse(response);
                    if (response.status == 0){
                        alert(response.message);
                    } else {
                        var messagediv = document.getElementById("inputField_"+rowId);
                        messagediv.style.display = "block";
                        messagediv.innerHTML = 'the approved withdrawal is '+ response.data.approved_amount + ' and the commission is '+ response.data.commission;
                        var modalFooter = $('#myModal_' + rowId + ' .modal-footer');
                        modalFooter.empty();
                        modalFooter.append($('<button/>', {
                            class: 'btn btn-success',
                            text: 'Proceed',
                            click: function() {
                                //$('#myModal_' + rowId).modal('hide');
                            }
                        }));
                        modalFooter.append($('<button/>', {
                            class: 'btn btn-danger',
                            text: 'Cancel',
                            click: function() {
                                $('#myModal_'+rowId).modal('hide');
                                originalState.css('display', 'none');
                                setTimeout(function() {
                                  $('#myModal_'+rowId).replaceWith(originalState.clone());
                                }, 500);
                            }
                        }));
                    }
                }
            });
        }
    }
</script>


