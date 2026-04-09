<div class="body-wrapper">
    <div class="job-wrapper">
        <div class="job-body-wrapper">
            <div class="filters-3">
                <div class="top-name">
                    Apply
                </div>
                <button class="add-btn" onclick="javascript:history.back()">
                    Back
                </button>
            </div>
            <div class="main-wrapper">
                <div class="resume-detail">
                    <input type="file" id="upload" name="coverletter" accept=".doc, .docx, .pdf" hidden />
                    <label class="upload-resume" for="upload">
                        <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/upload.svg" alt=""> Cover Letter
                    </label>
                    <!-- Include the PDF Modal -->
                    <?php include 'pdf-modal.php'; ?>
                    <img src="./images/or.svg" alt="" class="or">
                    <div class="input-group in-1-col">
                        <select class="form-select" aria-label="Default select example" id="coverletterSelect">
                            <?php  
                             $cl = new _coverletter;
                             $coverletter = $cl->read_coverletter($_SESSION['uid']);
                             if ($coverletter && $coverletter->num_rows > 0) {
                             while ($row = $coverletter->fetch_assoc()) {
                             ?>
                            <option value="<?php echo htmlspecialchars($row['id']); ?>"
                                data-title="<?php echo htmlspecialchars($row['title']); ?>"
                                data-coverletter="<?php echo htmlspecialchars($row['coverletter']); ?>">
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
                    <div class="cover-wrapper" id="coverLetterId">
                        <div class="top-detail">
                            <div class="name" id="coverTitle">title</div>
                            <div class="delete-icon">
                                <img src="./images/edit.svg" alt="" id="editIcon">
                            </div>
                        </div>
                        <div class="text" id="coverContent">
                            Cover Letter
                        </div>
                    </div>
                    <img src="./images/or.svg" alt="" class="or">
                    <div class="add-title">Type a Cover Letter</div>
                    <form id="coverForm" method="POST">
                        <input type="hidden" name="uid" value="<?php echo htmlspecialchars($_SESSION['uid']); ?>">
                        <input type="hidden" name="pid" value="<?php echo htmlspecialchars($_SESSION['pid']); ?>">
                        <input type="hidden" name="coverletter_id" id="coverletter_id" value="">
                        <div class="input-group in-1-col">
                            <label>Title</label>
                            <input type="text" name="title" id="inputTitle" placeholder="Enter Title">
                        </div>
                        <div class="input-group in-1-col desc">
                            <label>Cover Letter</label>
                            <textarea placeholder="Type Cover Letter" name="coverletter" id="inputContent" rows="10" cols="50"></textarea>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="check-box">
                                    <label class="main-container"> Save This Cover Letter
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="main-btns">
                            <button class="skip">Skip</button>
                            <button id="saveButton">Continue</button>
                        </div>
                    </form>
                </div>
                <!-- Other content of job-coverletter.php -->
            </div>
        </div>
    </div>
</div>

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
                alert('Application submitted successfully!');
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
