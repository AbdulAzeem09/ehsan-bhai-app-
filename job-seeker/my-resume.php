<?php
include('../univ/baseurl.php');

session_start();
include "check_job_seeker.php";
if (!isset($_SESSION['uid'])) {
    $_SESSION['afterlogin'] = "job-board/";
    include_once("../authentication/check.php");
} else {
    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");

    $_GET["categoryid"] = "2";
    $_GET["categoryName"] = "Job Board";

    $postId = isset($_REQUEST['postid']) ? (int)$_REQUEST['postid'] : 0;
    
    if(isset($_REQUEST['save_resume']) && $_REQUEST['save_resume'] == "yes"){
        $_SESSION['success_message'] = 'Resume saved successfully';
        echo "<script>window.location.href = 'my-resume.php';</script>";
        die();
    }
    if(isset($_GET['delete_id'])){
        include_once "../ssp/custom-mysql.php";
        updateQuery('spboard_resumes', ['resume_deleted' => 1 ], ['idResume' => $_GET['delete_id'],'pid' => $_SESSION['pid'] ]);
        $_SESSION['success_message'] = 'Resume deleted successfully';
        echo "<script>window.location.href = 'my-resume.php';</script>";
        die();
    }
?>
<?php include_once("../views/common/header.php"); ?>
<?php $job_seeker_nav = 'my-resume'; ?>
<link rel="stylesheet" href="./job-seeker.css">
<div class="body-wrapper">
    <div class="job-wrapper">
        <div class="job-body-wrapper">
            <?php include "job-seeker-nav.php"; ?>
            <div class="main-body">
                <button style='background: #3e1f48;padding: 6px 10px;border-radius: 4px;' class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                   <img src='../assets/images/menu-icon-2.svg'>
                </button>
                <div class="main-heading">My Resume</div>
                <div class="active-job">
                    <?php if (isset($_SESSION['success_message'])) { ?>
                        <script>
                            toastr.success("<?php echo $_SESSION['success_message']; ?>");
                        </script>
                    <?php unset($_SESSION['success_message']); } ?>
                    <div class="filters company-news-filter">
                        <div class="input-group" style="width: 300px; margin-bottom: 0px;">
                            <label>Select Resume</label>
                            <select class="form-select" id="resumeSelect" aria-label="Default select example">
                                <option selected>Select Resume</option>
                                <?php    
                                $cl = new _resumeget;
                                $resume = $cl->get_sp_resume($_SESSION['pid']); 
                                if ($resume && $resume->num_rows > 0) {
                                    while ($row = $resume->fetch_assoc()) {
                                        // Construct the file name and URL
                                        $fileName = htmlspecialchars($row['fileName']);
                                        $resumeUrl = htmlspecialchars($row['resume_url']);
                                        $resumeType = htmlspecialchars(pathinfo($row['fileName'], PATHINFO_EXTENSION));
                                        // Generate the <option> tag
                                        echo '<option value="'.htmlspecialchars($row['idResume']).'" data-resume-url="'.$resumeUrl.'" data-resume-type="'.$resumeType.'">'.htmlspecialchars($row['fileName']).'</option>';
                                    }
                                } else {
                                    echo '<option disabled>No resumes available</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <!-- Add a file input element to the upload button -->
                     <button class="add-btn" style="width: 220px;" data-toggle="modal" data-target="#resumeModal">
                    <span><img src="images/upload.svg" alt=""></span>Upload Resume</button>
                    </div>
                    <div class="resume-wrapper">
                        <div class="delete-icon">   
                            <a title="Set Default Resume" href='javascript:void(0);' data-id="0" id='resumeSelectDefault'><img src="./images/favouit-resume.svg" alt=""></a>  
                            <a title="Delete Resume" href='javascript:void(0);' id='delete-a'><img src="./images/delete.svg" alt=""></a>
                        </div>
                        <div class="top-detail" id="topDetail">
                            <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/doc.svg" alt="" class="doc-wrapper">
                            <div class="name" id="resumeName">Select a Resume</div>
                        </div>
                        <div class="main-img-wrapper">
                            <iframe id="resumeViewer" style="width: 100%; height: 500px; display: none;" frameborder="0"></iframe>
                            <div id="unsupportedMessage" style="display: none;">Preview not available for this file type.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Modal -->
<!-- Bootstrap Modal -->
<div class="modal fade" id="resumeModal" tabindex="-1" aria-labelledby="resumeModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resumeModalLabel">Upload Resume</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <!-- Modal Content here -->
        <form action="" method="post" id="sub_resume">
            <!-- <form action="process_form.php" method="post" id="sub_resume" enctype="multipart/form-data">                            -->
            <div class="filetype" style="font-size: 14px; margin: 0px 0px 5px 10px;">Allowed file types : pdf</div>
            <div class="upload-resume">
                <input type="file" id="upload" name="resume" accept=".pdf" hidden />
                <label class="upload-resume modal-button" style="padding:8px;" for="upload"><img src="images/upload.svg" alt=""> Upload Resume</label>
            </div>

            <span id="res_err" style="color: red;"></span>
            <div class="resume-wrapper" id="resume_view_seciton" style="display: none;">
                <div class="top-detail">
                    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/doc.svg" alt="" class="doc-wrapper">
                    <div class="name" id="resume_name"></div>
                    <div class="name" id="resume_download" style="color:#212529; font-size: 14px;">
                        <a href="" id="resume_link" target="_blank">Download</a>
                    </div>
                </div>
            </div>

            <input type="hidden" name="postid" id="upload_postid" value="<?php echo  $_SESSION["pid"]; ?>">
            <input type="hidden" name="save_resume" value="yes">
            <button type="button" class="upload-resume modal-button" style="margin-top: 20px;float:right;" onclick="saveResume();">
                Continue
            </button>
        </form>
      </div>
    </div>
  </div>
</div>

</div>

<style>
    .modal-button{
        width: 180px;
        border-radius: 75px;
        border: none;
        background-color: #7649B3;
        color: white;
        height: 40px;
        /* margin: 10px 0px; */
        cursor: pointer;
    }
</style>

<?php include "../views/common/footer.php"; ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
<script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions;?>"></script>
<script src="<?php echo $BaseUrl; ?>/job-board/assets/js/script.js?v=<?php echo $versions;?>"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.2/js/select2.min.js" charset="utf-8"></script>

<script type="text/javascript">
    $("#resumeSelectDefault").click(function(){
        var  id = $(this).data('id');
        if(id == 0){
            toastr.info('Please select resume')
            return false;
        }

        $.ajax({
          type: 'POST',
          url: "../my-profile/make_resume_default.php",
          data: {
            'id' : id
          },
          dataType: "json",
          success: function(response) {
            toastr.success('Resume set as default resume successfully.')
          }
        })
      })
    $(document).on("change", "#upload", function() {
        var file_data = $("#upload").prop("files")[0]; // Get the properties of the file from the file field
        var value = file_data ? file_data.name : ''; 
        
        if (value === '') {
            $('#resume_view_seciton').hide();
        } else {
            var extension = value.substr((value.lastIndexOf('.') + 1)).toLowerCase();
            const allowedExtensions = ['pdf'];

            if ($.inArray(extension, allowedExtensions) === -1) {
                $("#res_err").text("Please upload a file in DOC, DOCX, or PDF format.");
                return false;
            }

            var form_data = new FormData(); // Create a FormData object
            form_data.append("document", file_data); // Append file data
            form_data.append("postid", $('#upload_postid').val()); // Append additional form data
            form_data.append("save_resume", "<?= $_SESSION['pid'];?>"); // Append additional form data

            $.ajax({
                url: "ajaxupload.php", // Server-side script to process the upload
                dataType: 'script',
                cache: false,
                contentType: false,
                processData: false,
                data: form_data, // Set the data to the FormData object
                type: 'post',
                success: function(data) {
                    var response = $.parseJSON(data);
                    if (response.status === 'success') {
                        var url = response.url;
                        var fileName = response.fileName;

                        // Update iframe source depending on file type
                        if (extension === 'pdf') {
                            $('#pdf-view').attr('src', url);
                        } else {
                            $('#pdf-view').attr('src', 'https://docs.google.com/viewer?url=' + encodeURIComponent(url) + '&embedded=true');
                        }

                        // Show file preview and download link
                        $('#resume_view').show();
                        $('#resume_name').html(fileName);
                        $('#resume_link').attr('href', url);
                        $('#resume_download').show();
                        $('#resume_view_seciton').show();
                    } else {
                        $('#res_err').html(response.message);
                    }
                }
            });
        }
    });

    function displayFile() {
        var fileInput = document.getElementById('upload');
        var value = fileInput.value;

        if (value === '') {
            $('#resume_view_seciton').hide();
        } else {
            var extension = value.substr((value.lastIndexOf('.') + 1)).toLowerCase();
            const allowedExtensions = ['doc', 'docx', 'pdf'];

            if ($.inArray(extension, allowedExtensions) === -1) {
                $("#res_err").text("Please upload a file in DOC, DOCX, or PDF format.");
                return false;
            }

            // Show file preview
            readURL(fileInput, $("#pdf-view"));
            $('#resume_view').show();
            $('#resume_download').html(fileInput.files[0].name);
            $('#resume_download').show();
            $('#resume_view_seciton').show();
        }
    }

    function readURL(input, target) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $(target).attr('src', e.target.result); // Set the iframe source to the file content
        }
        reader.readAsDataURL(input.files[0]); // Read the file
    }

    function saveResume() {
        var selectedResume = $("#idspPostingMedia").val();
        
        if (!selectedResume && $('#upload').get(0).files.length === 0) {
            $("#res_err").text("Please upload a resume or select an existing resume.");
            return false;
        }

        if ($('#upload').get(0).files.length !== 0) {
            var fileInput = document.getElementById('upload');
            var value = fileInput.value;
            var extension = value.substr((value.lastIndexOf('.') + 1)).toLowerCase();
            const allowedExtensions = ['doc', 'docx', 'pdf'];

            if ($.inArray(extension, allowedExtensions) === -1) {
                $("#res_err").text("Please upload a file in DOC, DOCX, or PDF format.");
                return false;
            }
        }

        $("#sub_resume").submit(); // Submit the form if validation passes
    }

    $('#idspPostingMedia').on('change', function() {
        var value = this.value;
        var resume_data = $('#resume_data').val();
        var resumeData = $.parseJSON(resume_data);

        if (value !== '') {
            var selectedResume = resumeData[value];
            var extension = selectedResume.sppostingmediaExtension.toLowerCase();
            const imageExtensions = ['png', 'gif', 'jpeg', 'jpg', 'bmp'];

            if ($.inArray(extension, imageExtensions) !== -1) {
                // Show image preview
                $('#resume_view').hide();
                $('#resume_download').show();
                $("#resume_download a").attr("href", selectedResume.spPostingMedia);
            } else {
                // Show document preview in iframe
                $('#resume_view').show();
                $('#resume_download').hide();
                $("#resume_view img").attr("src", selectedResume.spPostingMedia);
            }

            $('#resume_view_seciton').show();
        } else {
            $('#resume_view_seciton').hide();
        }
    });
    </script>



    <script>
    document.getElementById('resumeSelect').addEventListener('change', function() {
        let selectedOption = this.options[this.selectedIndex];
        let resumeUrl = selectedOption.getAttribute('data-resume-url');
        let resumeType = selectedOption.getAttribute('data-resume-type');
        let selectedValue = selectedOption.value;
        $('#delete-a').attr('href', '?delete_id='+selectedValue);
        $("#resumeSelectDefault").data('id', selectedValue);
        if (resumeUrl) {
            document.getElementById('resumeName').textContent = resumeUrl.substring(resumeUrl.lastIndexOf('/') + 1); // Show the file name
            if (resumeType === 'pdf') {
                document.getElementById('resumeViewer').src = resumeUrl;
                document.getElementById('resumeViewer').style.display = 'block';
                document.getElementById('unsupportedMessage').style.display = 'none';
            } else {
                document.getElementById('resumeViewer').style.display = 'none';
                document.getElementById('unsupportedMessage').style.display = 'block';
            }
        } else {
            document.getElementById('resumeName').textContent = 'No Resume Available';
            document.getElementById('resumeViewer').src = ''; // Clear the iframe src
            document.getElementById('unsupportedMessage').style.display = 'none';
        }
    });

</script>
</body>
</html>
<?php
}
?>
