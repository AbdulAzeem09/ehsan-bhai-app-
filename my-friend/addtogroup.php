    
    <!-- Modal for add a member in a group -->
    <div id="addToGroup" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content no-radius bradius-15">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Add to group</h4>
                </div>
                <form method="post" action="addtogroupmember.php"  id="sp-form-post-edit" class="editPostTimeline" enctype="multipart/form-data" >
                    <input type="hidden" name="txtidspProfile" id="txtidspProfile" value="">
                    <input type="hidden" name="spDate" value="<?php echo date('Y-m-d');?>">
                    <div class="modal-body">
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="sp-post-edit">
                                    <div class="form-group">
                                        <label>Choose group</label>

                                        <select class="form-control no-radius bradius-15" name="spProfileGroup">
                                            <option>Select a group</option>
                                            <?php
                                            $count = new _spgroup;

                                            $result = $count->groupmemberprofile($_SESSION['pid']);
                                            //echo $count->ta->sql;
                                            if(($result!=false)){
                                                while ($row = mysqli_fetch_assoc($result)) { ?>
                                                    <option value="<?php echo $row['idspGroup'];?>"><?php echo $row['spGroupName'];?></option> <?php
                                                }
                                            }
                                            ?>                                            
                                        </select>
                                    </div>
                                </div>
                                <button type="submit" class="btn pull-right db_btn db_primarybtn" name="btnspGroup" >Add to group</button>
                                <button type="button" class="btn pull-right db_btn db_orangebtn" data-dismiss="modal" style="margin-right: 5px;">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal for send a sms -->
    <div id="sendAsms" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content no-radius bradius-15">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Send Message</h4>
                </div>
                <form method="post" action="../friendmessage/sendSms.php"  id="sp-form-post-edit" class="editPostTimeline" enctype="multipart/form-data" >
                    <input type="hidden" name="spProfiles_idspProfilesSender" id="spProfiles_idspProfilesSender" value="">
                    <input type="hidden" name="spprofiles_idspProfilesReciver" id="spprofiles_idspProfilesReciver" value="">
                    

                    <div class="modal-body">
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="sp-post-edit">
                                    <div class="form-group">
                                        <label>Message</label>
                                        <textarea class="form-control" name="spfriendChattingMessage"></textarea>
                                        
                                    </div>
                                </div>
                                <button type="submit" class="btn pull-right btnSendSms db_btn db_primarybtn">Send Message</button>
                                <button type="button" class="btn pull-right db_btn db_orangebtn" data-dismiss="modal" style="margin-right: 5px;">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>