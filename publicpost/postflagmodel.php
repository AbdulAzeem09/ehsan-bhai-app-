<div id="myModal<?php if($rows['idspPostings']) { echo $rows['idspPostings']; } ?>" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content ">
            <form class="" method="post" id="flagpostfrm<?php if($rows['idspPostings']) { echo $rows['idspPostings']; }?>">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h4 class="modal-title">Flag this Post</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="spProfile_idspProfile" value="<?php if(isset($_SESSION['pid'])) { echo $_SESSION['pid']; }?>">
                        <input type="hidden" name="flagpostprofileid" value="<?php if(isset($rows['idspProfiles'])) { echo $rows['idspProfiles']; }?>">
                        <input type="hidden" name="spPosting_idspPosting" value="<?php if($rows['idspPostings']) { echo $rows['idspPostings']; }?>">
                        <div class="col-md-12" style="display: grid;">
                            <label><input type="radio" name="radReport" id="radReport" class="mr_right_7" value="This person is annoying me">This post is annoying me</label>
                            <label><input type="radio" name="radReport" id="radReport" class="mr_right_7" value="They're pretending to be me or someone I know">They're pretending to be me or someone I know</label>
                            <label><input type="radio" name="radReport" id="radReport" class="mr_right_7" value="This is a fake account">This is a fake account Post</label>
                            <label><input type="radio" name="radReport" id="radReport" class="mr_right_7" value="This profile represents a business or organization">This Post represents a business or organization</label>
                            <label><input type="radio" name="radReport" id="radReport" class="mr_right_7" value="They're using a different name than they use in everyday life">They're using a different name than they use in everyday life</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn_gray db_btn db_orangebtn" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn_blue db_btn db_primarybtn" onclick="flagpost(<?php if($rows['idspPostings']) { echo $rows['idspPostings']; } ?>);" name="btnReport" id="flagtimelinepost">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div> 
