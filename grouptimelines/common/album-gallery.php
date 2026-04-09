<?php  if($role=="pending" || $role=="blocked" || $role=="rejeted" || $role=="nomember" ) {return false;} ?>

<?php 
    $g = new _spgroup;
    $pid = $_SESSION['pid'];
    $aid = $_GET['album_id'];
    $groupid = $_GET['groupid'];
    $groupname = $_GET['groupname'];
?>
<link href="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/css/lightbox.min.css" rel="stylesheet">
<style>
    .gallery {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .gallery a {
        width: 200px;
        height: 200px;
        overflow: hidden;
        border-radius: 8px;
    }

    .gallery img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .gallery img:hover {
        transform: scale(1.1);
    }

</style>

<div class="photos">
    <div class="heading-wrapper">
        <div class="main-heading">
            Album Photo's
        </div>
        <div class="more-btn">
            <div class="btn" data-bs-toggle="modal" data-bs-target="#add-image">
                <img src="./images/add-4.svg" alt="">
                <span>Add Image</span>
            </div>
        </div>
    </div>

    <div class="album-wrapper">
        <div class="gallery">
            <?php 
                $albumPhotos = $g->getGroupAlbumsItems($aid);
                if($albumPhotos){
                    while($row = mysqli_fetch_assoc($albumPhotos)) {
                ?>
                    <a href="<?= $row['file_path'] ?>" data-lightbox="roadtrip" data-title="<?= $row['file_name']?>" data-alt="<?= $row['file_name']?>">
                        <?php if($pid == $row['pid']) { ?>
                            <span style="cursor:pointer;z-index: 999;position: absolute;padding:5px;" class="img" onclick="deleteAlbumItem('<?= $row['id'] ?>')">
                                <img src="./images/delete.svg" alt="">
                            </span>
                        <?php } ?>
                        <img src="<?= $row['file_path'] ?>" alt="<?= $row['file_name']?>" title="<?= $row['file_name']?>">
                    </a>
            <?php } 
            }else{ ?>
                <h5>No album photos available.</h5>
            <?php } ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/lightbox2@2.11.3/dist/js/lightbox-plus-jquery.min.js"></script>
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
                                        <option <?php if($row['idspPostingAlbum'] == $_GET['album_id']) { echo "selected";} ?> value="<?= $row['idspPostingAlbum'] ?>"><?= $row['spPostingAlbumName'] ?></option>
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