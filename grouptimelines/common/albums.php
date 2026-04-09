<?php  if($role=="pending" || $role=="blocked" || $role=="rejeted" || $role=="nomember" ) {return false;} ?>

<?php 
    $g = new _spgroup;
    $pid = $_SESSION['pid'];
    $groupid = $_GET['groupid'];
    $groupname = $_GET['groupname'];
    $albums = $g->getGroupAlbums($groupid, 'photo');
?>

<div class="photos">
    <div class="heading-wrapper">
        <div class="main-heading">
            Photo Albums
        </div>
        <div class="more-btn">
            <div class="btn" data-bs-toggle="modal" data-bs-target="#add-album">
                <img src="./images/add-4.svg" alt="">
                <span>Create Album</span>
            </div>
            <?php if($albums){ ?>
                <div class="btn" data-bs-toggle="modal" data-bs-target="#add-image">
                    <img src="./images/add-4.svg" alt="">
                    <span>Add Image</span>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="album-wrapper">
        <?php 
        if($albums){
            while($row = mysqli_fetch_assoc($albums)) {
            $photosCount = $g->albumItemCount($row['idspPostingAlbum']);
            ?>
                <div class="album">
                    <a href="<?php echo "/grouptimelines/?groupid=".$groupid."&groupname=".$groupname."&timeline&page=album&album_id=".$row['idspPostingAlbum'];?>">
                        <div class="img-wrapper">
                            <img src="./images/img.svg" alt="">
                        </div>
                        <?= $row['spPostingAlbumName'] ?> (<?= $photosCount?> Photos)
                    </a>
                    <p><?= ucfirst($row['spPostingAlbumDescription']) ?></p>
                </div>
            <?php } 
        }else{ ?>
            <h6>No Albums found.</h6>
        <?php } ?>
    </div>
</div>

<div class="modal add-album-modal" id="add-album" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Create Photo Album</h1>
            </div>
            <div class="modal-body">
                <form onSubmit="return false;">
                    <div class="input-group in-1-col">
                        <label>Album Name (max 100 characters)<span style="color: #EF1D26;">*</span></label>
                        <input id="album_title" maxlength="100" type="text" placeholder="Type Album Name">
                    </div>
                    <div class="input-group in-1-col">
                        <label>Description (max 100 characters) <span style="color: #EF1D26;">*</span></label>
                        <textarea id="album_description" placeholder="Enter description"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-gid="<?= $_GET['groupid']?>" data-type="photo" id="create_group_album" style="background-color: #7649B3; color : white;">Create</button>
            </div>
        </div>
    </div>
</div>

<div class="modal add-image-modal" id="add-image" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload Photo</h1>
            </div>
            <div class="modal-body">
                <form action="upload.php" class="dropzone" id="myDropzone" enctype="multipart/form-data">
                    <div class="input-group in-1-col">
                        <label>Select Album <span style="color: #EF1D26;">*</span></label>
                        <select id="albumId" name="albumId" required class="form-select" aria-label="Default select example">
                            <?php
                                $albums = $g->getGroupAlbums($groupid, 'photo');
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
                <span style="font-size:12px;text-align:center;">File Type : .jpeg, .png, .jpg, .gif</span>
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
        acceptedFiles: ".jpeg, .jpg, .png, .gif",
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