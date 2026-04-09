<div class="modal cancel-group-modal" id="cancel-group" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Cancel Group Request</h1>
            </div>
            <div class="modal-body">                 
                <div class="text-center">
                    Are you sure you want to cancel the request?
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cancel-button" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary cncl_self_rqst" <?php gid_pid(); ?> style="background-color: #7649B3; color : white;">Cancel my request</button>
            </div>
        </div>
    </div>
</div>