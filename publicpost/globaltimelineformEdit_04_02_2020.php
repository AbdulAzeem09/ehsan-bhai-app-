    
    <!-- Modal for edit any post -->
    <div id="myPostEdit" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content no-radius sharestorepos">
                <form method="post" action="../post-ad/dopost.php"  id="sp-form-post-edit" class="editPostTimeline" enctype="multipart/form-data" >
                    <div class="modal-header">
                        
                        <h4 class="modal-title">Edit Post</h4>
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
                        <button id="spPostEditTimeline" type="button" class="btn btnPosting pull-right editing"  >Save Post</button>
                        <button type="button" class="btn btnPosting pull-right" data-dismiss="modal"  style="margin-right: 5px;">Cancel</button>
                    </div>             
                </form>
            </div>
        </div>
    </div>