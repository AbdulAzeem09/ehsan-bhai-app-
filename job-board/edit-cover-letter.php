<!-- edit-coverletter-modal.php -->
<div class="modal fade" id="editCoverLetterModal" tabindex="-1" aria-labelledby="editCoverLetterModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCoverLetterModalLabel">Edit Cover Letter</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editCoverForm">
          <!-- Hidden input to store cover letter ID -->
          <input type="hidden" id="editCoverletterId" name="coverletter_id">
          <input type="hidden" name="uid" value="<?php echo htmlspecialchars($_SESSION['uid']); ?>">
          <input type="hidden" name="pid" value="<?php echo htmlspecialchars($_SESSION['pid']); ?>">
          <!-- Title input -->
          <div class="mb-3">
            <label for="editModalTitle" class="form-label">Cover Letter Title</label>
            <input type="text" class="form-control" id="editModalTitle" name="title" required>
          </div>
          
          <!-- Content textarea -->
          <div class="mb-3">
            <label for="editModalContent" class="form-label">Cover Letter Content</label>
            <textarea class="form-control" id="editModalContent" rows="6" name="coverletter" required></textarea>
          </div>
          <button id="updateButton" class="btn btn-primary">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
