<?php
//require_once('../common.php');
include('../univ/baseurl.php');

session_start();
include "check_job_seeker.php";
if (!isset($_SESSION['uid'])) {
$_SESSION['afterlogin'] = "job-board/";
include_once("../authentication/check.php");
} else {

function sp_autoloader($class)
{
include '../mlayer/' . $class . '.class.php';
}
spl_autoload_register("sp_autoloader");

if( isset($_REQUEST['delete']) ){
    include "../ssp/custom-mysql.php";
    deleteQuery('job_coverletter',[ 'id' => $_REQUEST['delete'] ]);
    $_SESSION['coverletter_deleted'] = true;
    header('Location: my-cover-letters.php');
    exit;
}

$_GET["categoryid"] = "2";
$_GET["categoryName"] = "Job Board";


$uid = $_SESSION['uid'];
$pid = $_SESSION['pid'];
    //position-relative
    $page = "jobBoard";
	//echo "<pre>";
  //  var_dump($_SESSION);

     //echo "</pre>";
     //exit;
	?>
<?php include_once("../views/common/header.php"); ?>
<?php $job_seeker_nav = 'my-cover-letters'; ?>
<link rel="stylesheet" href="./job-seeker.css">
    <div class="body-wrapper">
        
        <div class="job-wrapper">
            <div class="job-body-wrapper">
                <?php include "job-seeker-nav.php"; ?>
                <div class="main-body">
                <button style='background: #3e1f48;
    padding: 6px 10px;
    border-radius: 4px;' class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                   <img src='../assets/images/menu-icon-2.svg'>
                </button>
                    <div class="main-heading">
                        My Cover Letters
                    </div>
                    <?php if (isset($_SESSION['coverletter_deleted'])) { ?>
                        <div class="alert alert-success" role="alert" style='background: #7649b3;color:#fff;'>
                            Cover letter deleted successfully!
                        </div>
                        <?php unset($_SESSION['coverletter_deleted']); ?>
                    <?php } ?>

                    <?php if (isset($_SESSION['coverletter_create_update'])) { ?>
                        <div class="alert alert-success" role="alert" style='background: #7649b3;color:#fff;'>
                        <?php echo $_SESSION['coverletter_update_msg']; ?>
                        </div>
                        <?php unset($_SESSION['coverletter_create_update']); ?>
                        <?php unset($_SESSION['coverletter_update_msg']); ?>
                    <?php } ?>

                    <div class="active-job">
                        <div class="filters  company-news-filter">
                            <div class="input-group" style="width: 300px; margin-bottom: 0px;">
                                <label>Select Cover Letter</label>
                                <select class="form-select" aria-label="Default select example" id="coverletterSelect">
                              <?php  
                              $cl = new _coverletter;
                              $coverletter = $cl->read_coverletter($_SESSION['uid']);
                              if ($coverletter && $coverletter->num_rows > 0) {
                                  while ($row = $coverletter->fetch_assoc()) {
                              ?>
                              <option value="<?php echo htmlspecialchars($row['id']); ?>" data-id="<?= $row['id'] ?>" data-title="<?php echo htmlspecialchars($row['title']); ?>" data-coverletter="<?php echo htmlspecialchars($row['coverletter']); ?>">
                                  <?php echo htmlspecialchars($row['title']); ?>
                              </option>
                              <?php 
                                  }
                              } else {
                                  echo '<option disabled>No covers available</option>';
                              }
                              ?>
                          </select>
                          


                            </div>
                             <button class="add-btn" style="width: 220px;" data-bs-toggle="modal"
                                data-bs-target="#add-cover">
                              <input type="file" id="upload" name="coverletter" accept=".doc, .docx, .pdf" hidden />
                              <label class="upload-resume" for="upload">
                               <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/upload.svg" alt=""> Cover Letter
                               </label>

                    <input type="file" id="upload" style="display: none;">
                  
                            </button>
                          
                    <?php include 'pdf-modal.php'; ?>
                        </div>
                           <div class="cover-wrapper" id="coverLetterId">
                            <div class="top-detail">
                                <div class="name" id="coverTitle">title</div>
                                <div class="delete-icon">
                                    <img src="./images/edit.svg" alt="" id="editIcon">
                                </div>
                                <div class="delete-icon">
                                    <a id="deletIcon">
                                       <img src="../job-employee/images/delete.svg" alt="" >
                                    <a>
                                </div>
                            </div>
                            <div class="text" id="coverContent">
                                Cover Letter
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <!-- <div class="modal change-location-modal" id="add-cover" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload A Cover Letter</h1>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="input-group in-1-col">
                            <label>Name</label>
                            <input type="text" placeholder="Enter Cover Letter Name">
                        </div>
                        <div class="input-group in-1-col desc">
                            <label>Cover Letter<span style="color: #EF1D26;">*</span></label>
                            <textarea placeholder="Type Enter Cover Letter" rows="6" cols="50"></textarea>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                    <button type="button" style="color: white ; background-color: #7649B3;"
                        class="btn btn-primary">SAVE</button>
                </div>
            </div>
        </div>
    </div>  -->
    <div class="modal fade" id="edit-cover" tabindex="-1" aria-labelledby="editCoverLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCoverLabel">Edit Cover Letter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editCoverForm">
                <input type="hidden" id="editCoverletterId" name="coverletter_id">
          <input type="hidden" name="uid" value="<?php echo htmlspecialchars($_SESSION['uid']); ?>">
          <input type="hidden" name="pid" value="<?php echo htmlspecialchars($_SESSION['pid']); ?>">
                    <div class="mb-3">
                        <label for="modalTitle" class="form-label">Title</label>
                        <input type="text" class="form-control" name="title" id="modalTitle" required>
                    </div>
                    <div class="mb-3">
                        <label for="modalContent" class="form-label">Cover Letter</label>
                        <textarea class="form-control" name="coverletter" id="modalContent" rows="6" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveChangesButton">Update</button>
            </div>
        </div>
    </div>
</div>
                            </div>




    
<?php include "../views/common/footer.php"; ?>
        <script src="<?php echo $BaseUrl; ?>/assets/quill/quill.js"></script>
    <script src="<?php echo $BaseUrl; ?>/assets/js/posting/timeline.js?v=<?php echo $versions;?>"></script>
    <script src="<?php echo $BaseUrl; ?>/job-board/assets/js/script.js?v=<?php echo $versions;?>"></script>
  
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.6.347/pdf.min.js"
    integrity="sha512-Z8CqofpIcnJN80feS2uccz+pXWgZzeKxDsDNMD/dJ6997/LSRY+W4NmEt9acwR+Gt9OHN0kkI1CTianCwoqcjQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

</body>

</html>

<script>
$(document).ready(function() {
    // Handle cover letter selection
    $('#coverletterSelect').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var title = selectedOption.data('title');
        var coverletter = selectedOption.data('coverletter');
        var id = selectedOption.val(); // Get the ID of the selected cover letter
        $('#deletIcon').attr('href', '?delete=' + id);
        // Update the cover-wrapper section
        $('#coverTitle').text(title);
        $('#coverContent').html(coverletter);
    });

    // Handle edit icon click`
    $('#editIcon').on('click', function() {
        // Get the current cover letter data
        var currentTitle = $('#coverTitle').text();
        var currentContent = $('#coverContent').text();
        var selectedOption = $('#coverletterSelect').find('option:selected');
        var coverletterId = selectedOption.val(); // Get the ID of the selected cover letter

        // Set the values in the modal form fields
        $('#modalTitle').val(currentTitle);
        $('#modalContent').val(currentContent);
        $('#editCoverletterId').val(coverletterId); // Set the hidden input field value

        // Show the modal
        $('#edit-cover').modal('show');
    });

    // Handle save changes button click
    $('#saveChangesButton').on('click', function(e) {
        e.preventDefault(); // Prevent default form submission

        // Create FormData object from the form
        var formData = new FormData($('#editCoverForm')[0]);

        $.ajax({
            type: 'POST',
            url: 'coverletterform.php', // Path to your PHP script
            data: formData,
            contentType: false, // Important for FormData
            processData: false, // Important for FormData
            success: function(response) {
                // Handle the response from the server
                if (response.success) {
                    // Update the cover letter section with new data
                    $('#coverTitle').text($('#modalTitle').val());
                    $('#coverContent').text($('#modalContent').val());
                    // Hide the modal
                    $('#edit-cover').modal('hide');
                } else {
                    // Handle error
                    // alert('Cover letter update Success !');
                    location.reload();
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX error
                alert('An error occurred while sending the request: ' + error);
            }
        });
    });

    // Handle "Continue" button click
   
});
</script>
<!-- coverletter pdf upload from model box -->
<script>
$(document).ready(function() {

    // Initialize Quill Editor
    const quill = new Quill('#editor', {
        theme: 'snow'
    });

    // Handle PDF upload and display in modal
    $('#upload').change(function() {
        var fileInput = $('#upload')[0].files[0];
        if (fileInput) {
            var fileName = fileInput.name.replace('.pdf', ''); // Extract file name without .pdf extension
            var reader = new FileReader();
            reader.onload = function(e) {
                var typedArray = new Uint8Array(e.target.result);

                // Load PDF.js
                pdfjsLib.getDocument(typedArray).promise.then(function(pdf) {
                    pdf.getPage(1).then(function(page) {
                        page.getTextContent().then(function(textContent) {
                            var text = textContent.items.map(item => item.str).join(' ');

                            // Set file name in the input field and content in the Quill editor
                            $('#pdf-title-input').val(fileName);
                            quill.setText(text); // Set Quill editor content

                            // Show the modal
                            $('#pdfModal').modal('show');
                        });
                    });
                });
            };
            reader.readAsArrayBuffer(fileInput);
        }
    });

    // Handle the submit button click
    $('#submitPdf').click(function(e) {
        e.preventDefault(); // Prevent default form submission

        // Sync Quill content to the hidden textarea
        $('#pdf-content').val(quill.root.innerHTML);

        // Prepare the form data
        var formData = {
            uid: $('input[name="uid"]').val(),
            pid: $('input[name="pid"]').val(),
            pdfTitle: $('#pdf-title-input').val(),
            pdfContent: $('#pdf-content').val()
        };

        // Send the data via AJAX
        $.ajax({
            type: 'POST',
            url: 'coverlettermodel.php',
            data: formData,
            success: function(response) {
                // Handle the response from the server
                location.reload();
            },
            error: function(xhr, status, error) {
                // Handle any errors that occur
                alert('An error occurred: ' + error);
            }
        });

        return false; // Prevent form from submitting the traditional way
    });
});
</script>
<!-- endcoverletter pdf upload from model box -->
<!-- endcoverletter pdf upload from model box -->
<?php
}
?>