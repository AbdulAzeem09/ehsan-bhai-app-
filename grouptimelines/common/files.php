<?php  if($role=="pending" || $role=="blocked" || $role=="rejeted" || $role=="nomember" ) {return false;} ?>
<?php 
    $g = new _spgroup;
    $pid = $_SESSION['pid'];
    $groupid = $_GET['groupid'];
    $groupname = $_GET['groupname'];
    $folders = $g->getGroupAlbums($groupid, 'file');
?>
<div class="files">
    <div class="heading-wrapper">
        <div class="main-heading">
            Folders
        </div>
        <div class="more-btn">
            <div class="btn" onclick="resetModal();" data-bs-toggle="modal" data-bs-target="#add-folder">
                <img src="./images/add-4.svg" alt="">
                <span>Create Folder</span>
            </div>
            <?php if($folders){ ?>
                <div class="btn" data-bs-toggle="modal" data-bs-target="#add-file">
                    <img src="./images/add-4.svg" alt="">
                    <span>Upload files</span>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="table-wrapper">        
        <?php if($folders){ ?>
            <table>
                <thead>
                    <tr>
                        <th style="width:35%;">Folder Name</th>
                        <th class="text-center">Files</th>
                        <th class="text-center">Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_assoc($folders)) {
                        $itemCount = $g->albumItemCount($row['idspPostingAlbum']);
                        $p = new _spprofiles;
                        $name = $p->getProfileName($row['spProfiles_idspProfiles']);
                    ?>
                        <tr>
                            <td style="padding-left: 20px;">
                                <a href="<?php echo "/grouptimelines/?groupid=".$groupid."&groupname=".$groupname."&timeline&page=file&folder_id=".$row['idspPostingAlbum'];?>">
                                    <img src="./images/folder.svg" alt="" style="display: inline-block; margin-right: 10px;">
                                    <?= $row['spPostingAlbumName'] ?>
                                </a>
                            </td>
                            <td class="text-center"><?= $itemCount ?></td>
                            <td class="text-center date-td" style="padding-left: 20px;">
                                <div class="date">
                                    <?= date('M d, Y H:i A', strtotime($row['created_at'])) ?>
                                </div>
                                <div class="title">
                                    By <?= $name; ?>
                                </div>
                            </td>
                            <?php if($pid == $row['spProfiles_idspProfiles']) { ?>
                                <td class="action" style="padding-left: 20px;">
                                    <div class="link">
                                        <span class="img edit_album" data-id="<?= $row['idspPostingAlbum'] ?>" data-title="<?= $row['spPostingAlbumName'] ?>" data-description="<?= $row['spPostingAlbumDescription'] ?>" style="cursor:pointer;">
                                            <img src="./images/edit-3.svg" alt="">
                                        </span>
                                        <span style="cursor:pointer;" class="img" onclick="deleteAlbumItem('<?= $row['idspPostingAlbum'] ?>', 'album')">
                                            <img src="./images/delete.svg" alt="">
                                        </span>
                                    </div>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        <?php } else { ?>
            <h6>Folder not found.</h6>
        <?php } ?>
    </div>
</div>

<div class="modal add-album-modal" id="add-folder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5 folder_title" id="staticBackdropLabel">Create Folder</h1>
            </div>
            <div class="modal-body">
                <form onSubmit="return false;">
                    <div class="input-group in-1-col">
                        <label>Folder Name (max 100 characters)<span style="color: #EF1D26;">*</span></label>
                        <input id="album_title" maxlength="100" type="text" placeholder="Type Folder Name">
                    </div>
                    <div class="input-group in-1-col">
                        <label>Description (max 100 characters) <span style="color: #EF1D26;">*</span></label>
                        <textarea id="album_description" placeholder="Enter description"></textarea>
                    </div>
                    <input type="hidden" id="folder_id" name="folder_id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary save_album" data-gid="<?= $_GET['groupid']?>" data-type="file" id="create_group_album" style="background-color: #7649B3; color : white;">Create</button>
            </div>
        </div>
    </div>
</div>

<div class="modal add-image-modal" id="add-file" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload Files</h1>
            </div>
            <div class="modal-body">
                <form action="upload.php" class="dropzone" id="myDropzone" enctype="multipart/form-data">
                    <div class="input-group in-1-col">
                        <label>Select Album <span style="color: #EF1D26;">*</span></label>
                        <select id="albumId" name="albumId" required class="form-select" aria-label="Default select example">
                            <?php
                                $albums = $g->getGroupAlbums($groupid, 'file');
                                if($albums){
                                    while($row = mysqli_fetch_assoc($albums)) { ?>
                                        <option value="<?= $row['idspPostingAlbum'] ?>"><?= $row['spPostingAlbumName'] ?></option>
                            <?php } }?>
                        </select>
                    </div>

                    <div class="dz-message">
                        <span>Drag and drop files here or click to select files</span>
                    </div>
                </form>
                <span style="font-size:12px;text-align:center;">File Type : .pdf, .doc, .docx, .csv</span>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/dropzone@5.9.3/dist/min/dropzone.min.js"></script>
<script>
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#myDropzone", {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 10, // Maximum filesize in MB
        acceptedFiles: ".pdf, .doc, .docx, .csv",
        addRemoveLinks: false,
        init: function() {
            this.on('success', function(file, response){
                let res = JSON.parse(response);
                if (res.status === "error") {
                    toastr.error("Error: " + res.message);
                } else {
                    toastr.success("Success: " + res.message);
                }

                if (this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0) {
                    setTimeout(function(){
                        location.reload();
                    }, 3000);
                }
            });
            this.on('error', function(file, errorMessage, xhr){
                toastr.error("An error occurred: " + errorMessage);
            })
        }
    });  

    $(".edit_album").click(function(){
        var id = $(this).data('id');
        var title = $(this).data('title');
        var description = $(this).data('description');
        $(".folder_title").text('Update Folder');
        $(".save_album").text('Update');
        $("#folder_id").val(id);
        $("#album_title").val(title);
        $("#album_description").val(description);
        $("#add-folder").modal('show');
    });

    function resetModal(){
        $(".folder_title").text('Create Folder');
        $(".save_album").text('Create');
        $("#folder_id").val('');
        $("#album_title").val('');
        $("#album_description").val('');
    }
</script>