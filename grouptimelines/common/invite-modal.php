<div class="modal invite-modal" id="invite" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Invite</h1>
            </div>
            <div class="modal-body">
                <div class="search-wrapper">
                    <div class="search-box">
                        <input type="text" class="srchKey" placeholder="Search by keyword...">
                        <div class="icon invite_srch">
                            <img src="./images/search-4.svg" alt="">
                        </div>
                    </div>
                    <div class="selected-info">
                        <div class="title"><span id="ttl_invtee">0</span> Selected</div>
                        <button class="cncl_all">Unselect All</button>
                    </div>
                </div>
                <div class="list-wrapper">
                    <div class="list" id="invite_list"></div>
                    <div class="selected"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary cncl_invite" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary disabled user_invite" style="background-color: #7649B3; color : white;">Invite</button>
            </div>
        </div>
    </div>
</div>