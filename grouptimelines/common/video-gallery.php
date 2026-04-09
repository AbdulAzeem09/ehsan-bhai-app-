<?php  if($role=="pending" || $role=="blocked" || $role=="rejeted" || $role=="nomember" ) {return false;} ?>

<?php 
    $g = new _spgroup;
    $pid = $_SESSION['pid'];
    $aid = $_GET['album_id'];
    $groupid = $_GET['groupid'];
    $groupname = $_GET['groupname'];

    function getFileType($type){
        $array = [
            'mov' => 'video/quicktime',
            'ogg' => 'video/ogg',
            'webm' => 'video/webm',
            'mp4' => 'video/mp4',
        ];

        return $array[$type];
    }
?>
<link href="https://cdn.jsdelivr.net/npm/video.js@7.11.4/dist/video-js.min.css" rel="stylesheet">
<style>
    .video-item {
        margin-bottom: 15px;
    }

    video {
        width: 100%;
        height: auto;
        border-radius: 8px;
    }

    video:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/video.js@7.11.4/dist/video.min.js"></script>
<div class="videos">
    <div class="heading-wrapper">
        <div class="main-heading">
            Albums Video's
        </div>
        <div class="more-btn">
            <div class="btn" data-bs-toggle="modal" data-bs-target="#add-video">
                <img src="./images/add-4.svg" alt="">
                <span>Add Video</span>
            </div>
        </div>
    </div>
    <div class="album-wrapper">
        <div class="row">
            <?php 
                $albumvideos = $g->getGroupAlbumsItems($aid);
                if($albumvideos){
                while($row = mysqli_fetch_assoc($albumvideos)) {
                    $videoid = "video".$row['id'];
                    $fileName = $row['file_path'];
                    $fileInfo = pathinfo($fileName);
                    $extension = $fileInfo['extension'];
                ?>
                    <div class="video-item col-md-6">
                        <?php if($pid == $row['pid']) { ?>
                            <span style="cursor:pointer;z-index: 99999999;position: relative;padding:5px;" class="img" onclick="deleteAlbumItem('<?= $row['id'] ?>')">
                                <img src="./images/delete.svg" alt="">
                            </span>
                        <?php } ?>
                        <video width="400" class="video-js" controls preload="auto" data-setup='{}'>
                            <source src="<?= $row['file_path'] ?>" type="<?= getFileType($extension) ?>">
                            Your browser does not support the video tag.
                        </video>
                    </div>
            <?php } 
            }else{ ?>
                <h5>No album videos available.</h5>
            <?php } ?>
        </div>
    </div>
</div>


<div class="modal add-video-modal" id="add-video" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload Video</h1>
            </div>
            <div class="modal-body">
                <form action="upload.php" class="dropzone" id="myDropzoneVideo" enctype="multipart/form-data">
                    <div class="input-group in-1-col">
                        <label>Select Album <span style="color: #EF1D26;">*</span></label>
                        <select id="albumId" name="albumId" required class="form-select" aria-label="Default select example">
                            <?php
                                $albums = $g->getGroupAlbums($groupid, 'video');
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
                <span style="font-size:12px;text-align:center;">File Type : .mp4, .webm, .ogv, .mov</span>
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
    var myDropzoneVideo = new Dropzone("#myDropzoneVideo", {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 10, // Maximum filesize in MB
        acceptedFiles: ".mp4, .webm, .ogv, .mov",
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
