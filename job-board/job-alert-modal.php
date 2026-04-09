<!-- job-alert-modal.php -->
<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');
include('../univ/baseurl.php');
require_once("../helpers/start.php");
require_once "../classes/Base.php";
require_once "../classes/CreateProfile.php";

?>
<div class="notify">
    <img src="<?php echo $BaseUrl; ?>/job-board/assets/images/notify-2.svg" alt="Notify" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#jobAlertModal">
</div>

<!-- Modal -->
<div class="modal fade" id="jobAlertModal" tabindex="-1" aria-labelledby="jobAlertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="jobAlertModalLabel">
                    I want to receive the latest job alert for <?= $title ?> in <?= (isset($tbl_city4) ? $tbl_city4 . ', ' : '') ?><?= (isset($statename) ? $statename : '') ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="jobAlertForm" method="POST">
                    <input type="hidden" name="uid" value="<?php echo $_SESSION['uid']; ?>">
                    <input type="hidden" name="pid" value="<?php echo $_SESSION['pid']; ?>">
                    <input type="hidden" name="keywords" value="<?php echo $title; ?>">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Your email" required>
                    </div>
                    <button type="submit" class="active apply-btn" id='updateprofile' disabled>Activate</button>
                </form>

                <div class="alert alert-success" style='display:none'>
                    <table>
                        <tr>
                            <td width='5%' style='vertical-align: baseline;'>
                                <strong><i class='fa fa-check' style='background: green; color: #fff; padding: 5px; border-radius: 50%;'></i></strong>
                            </td>
                            <td>
                                Your job alert has been created!
                                <p> You'll receive an email update as soon as new jobs become available.</p>
                            </td>
                        </tr>
                    </table>
                </div>

                <p style="font-size: 12px; color: #666; margin-top: 10px;">
                    By creating a job alert, you agree to our <a href="#" style="color: #007bff; text-decoration: none;">Terms <i class='fa fa-up-right-from-square'></i></a>. You can change your consent settings at any time by unsubscribing or as detailed in our terms.
                </p>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
    $("#jobAlertForm").on("submit", function(e){
        e.preventDefault(); // Prevent form from submitting normally
        $.ajax({
            url: 'process_form.php',
            type: "POST",
            data: $(this).serialize(),
            success: function(response) {
                if(response == 0){
                    alert('Email already registerd for job alert.');
                }else{
                    $(".alert-success").show(); 
                    $("#jobAlertForm").hide(); 
                    $("#jobAlertForm")[0].reset(); // Reset the form
                }
            }
        });
    });

    // Enable button when email is entered
    $("#email").on("input", function(){
        if($(this).val() !== '') {
            $("#updateprofile").removeAttr("disabled");
        } else {
            $("#updateprofile").attr("disabled", "disabled");
        }
    });
});
</script>
