<!-- Bootstrap Modal for PDF Cover Letter -->
<div class="modal fade" id="pdfModal" tabindex="-1" aria-labelledby="pdfModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="post" action="">
                <input type="hidden" name="uid" value="<?php echo htmlspecialchars($_SESSION['uid']); ?>">
                <input type="hidden" name="pid" value="<?php echo htmlspecialchars($_SESSION['pid']); ?>">

                <div class="modal-header">
                    <h5 class="modal-title" id="pdfModalLabel">Upload Cover Letter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="text" id="pdf-title-input" class="form-control">
                    <!-- Quill Editor Container -->
                    <div id="editor" style="height: 200px;"></div>
                    <!-- Hidden Textarea to Store Quill Content -->
                    <textarea id="pdf-content" name="pdfContent" rows="10" class="form-control" style="display:none;"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" id="submitPdf" class="btn btn-secondary">Submit</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
