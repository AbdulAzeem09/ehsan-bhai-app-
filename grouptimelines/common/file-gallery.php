<?php  if($role=="pending" || $role=="blocked" || $role=="rejeted" || $role=="nomember" ) {return false;} ?>

<?php 
    $g = new _spgroup;
    $pid = $_SESSION['pid'];
    $fid = $_GET['folder_id'];
    $groupid = $_GET['groupid'];
    $groupname = $_GET['groupname'];
?>

<div class="files">
    <div class="heading-wrapper">
        <div class="main-heading">
            Folder File's
        </div>
        <div class="more-btn">
            <div class="btn" data-bs-toggle="modal" data-bs-target="#add-file">
                <img src="./images/add-4.svg" alt="">
                <span>Add Files</span>
            </div>
        </div>
    </div>

    <div class="table-wrapper">        
        <?php 
        $folder_files = $g->getGroupAlbumsItems($fid);
        if($folder_files){ ?>
            <table>
                <thead>
                    <tr>
                        <th style="width:60%;">File Name</th>
                        <th class="text-center">Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_assoc($folder_files)) {
                    ?>
                        <tr>
                            <td style="padding-left: 20px;">
                                <a href="<?= $row['file_path'] ?>">
                                    <img src="./images/folder.svg" alt="" style="display: inline-block; margin-right: 10px;">
                                    <?= $row['file_name'] ?>
                                </a>
                            </td>
                            <td class="text-center date-td" style="padding-left: 20px;">
                                <div class="date">
                                    <?= date('M d, Y H:i A', strtotime($row['created_at'])) ?>
                                </div>
                            </td>
                            <?php if($pid == $row['pid']) { ?>
                                <td class="action" style="padding-left: 20px;">
                                    <div class="link">
                                        <span style="cursor:pointer;" class="img" onclick="deleteAlbumItem('<?= $row['id'] ?>')">
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
            <h6>No files available.</h6>
        <?php } ?>
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
                                        <option <?php if($row['idspPostingAlbum'] == $_GET['folder_id']) { echo "selected";} ?> value="<?= $row['idspPostingAlbum'] ?>"><?= $row['spPostingAlbumName'] ?></option>
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

</script>