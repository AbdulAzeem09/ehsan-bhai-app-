<div class="modal modal-4" id="sharePost" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Share Post</h1>
      </div>
      <div class="modal-body">
        <form id="shareform" action="">
          <div class="input-group in-1-col" >
            <label>Choose Source</label>
            <select id="sourceSelect" class="form-select" aria-label="Default select example">
              <option value="0" selected>Choose Source</option>
              <option id="groupshare" value="1">Share with a group</option>
              <option id="friendshare" value="2">Share with a friend</option>
            </select>
          </div> 
          <input id="sp-Profiles-idspProfiles" name="spShareByWhom" type="hidden" value="<?php echo $_SESSION['pid']?>">
          <input type="hidden" id="sharePostingId" name="spPostings_idspPostings" value="">
          <div class="input-group in-1-col hidden" id="groupshow">
            <label>Select Group <span style="color:red;">*</span></label>
            <select class="select3 form-control" name="spShareToGroup[]" id="groupSelect" multiple>
              <option value=""></option>
            </select>
          </div>
          <div class="input-group in-1-col hidden" id="profileshow">
            <label>Select Friend <span style="color:red;">*</span></label>
            <select class="select2 form-control" name="spShareToWhom[]" id="friendSelect" multiple>
              <option value=""></option>
            </select>
          </div>
          <div class="input-group in-1-col">
            <label>Say Something about this</label>
            <textarea id="aboutshare" name="spShareComment" placeholder="Say Something about this.." rows="4" cols="50"></textarea>
          </div>
        </form>
        <span style="color:red;display:none;" id="checkingtoggle">error</span>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
        <button type="submit" id="share" class="btn btn-primary active">Share</button>
      </div>
    </div>
  </div>
</div>
