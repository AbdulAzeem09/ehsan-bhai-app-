    <div class="modal exit-group-modal" id="exit-group" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Exit this Group</h1>
                </div>
                <div class="modal-body">
                   <div class="text-wrapper-2">
                    <div class="text-center">
                        Are you sure, you want to leave this group?                        
                    </div>         
                </div>
                
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary cancel-exit-button" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary self_exit_grp" <?php gid_pid(); ?> style="background-color: #7649B3; color : white;">Exit the group</button>
                </div>
            </div>
        </div>
    </div>