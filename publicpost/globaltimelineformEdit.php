<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/style.css">
<!-- Modal for edit any post -->
<div id="myPostEdit" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content no-radius bradius-15">
            <form method="post" action="../post-ad/dopostedit.php" id="sp-form-post-edit" class="editPostTimeline" enctype="multipart/form-data">
                <div class="modal-header">
                    <!-- SearchingUpdatePost7474 -->
                    <h4 class="modal-title">Edit Post<span id="edit" style="color:red;"></span></h4>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="posteditloader">
                                <div class="loader"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="sp-post-edit">

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">

                    <button id="spPostEditTimeline" type="button" required class="btn btnPosting pull-right editing db_btn db_primarybtn">Update Post</button>
                    <button type="button" id="cancelbtn" class="btn btnPosting pull-right db_btn db_orangebtn" data-dismiss="modal" style="margin-right: 5px;background-color:#d9534f!important;">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    document.getElementById("spPostEditTimeline").addEventListener("click", function(event) {
        event.preventDefault();

    });
</script>
