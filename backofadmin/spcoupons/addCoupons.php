<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
if (!defined('WEB_ROOT')) {
  exit;
}

checkUser();

if (isset($_POST["btnButton"])) {
  $coupon_code = isset($_POST["coupon_code"]) ? $_POST["coupon_code"] : '';
  $expiry_date = isset($_POST["expiry_date"]) ? $_POST["expiry_date"] : '';
  $percentage = isset($_POST["percentage"]) ? $_POST["percentage"] : '';
  $userId = $_SESSION['userId'];
  if (strtotime($expiry_date) < strtotime(date("Y-m-d"))) {
    redirect('index.php?view=add_coupons')->withError('Expiry date is not valid.');
  } else {
    $sql = "INSERT INTO `discount_coupons`(`coupon_code`, `expiry_date`, `created_user`, `created_at`, `percentage`) VALUES ('$coupon_code', '$expiry_date', '$userId', NOW(), '$percentage')";
    $result = dbQuery($dbConn, $sql);
    redirect('index.php/view=list');
  }
}

?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Add Coupons</h1>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <!-- start any work here. -->
      <form action="" method="post" name="frmAddAdmin" id="couponForm" onsubmit="return validateForm()">
        <div class="box box-primary">
          <div class="box-body">
            <div class="row">

              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputTitle" class="col-form-label">Code</label>
                  <input type="text" name="coupon_code" id="coupon_code" placeholder="Enter coupon code" class="form-control" required>
                  <small id="codeValidationMessage" class="text-danger"></small>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputTitle" class="col-form-label">Expiry date</label>
                  <input type="date" name="expiry_date" id="expiry_date" placeholder="Enter expiry date" class="form-control" required>
                  <small id="dateValidationMessage" class="text-danger"></small>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="inputTitle" class="col-form-label">Percentage</label>
                  <input type="number" name="percentage" id="percentage" placeholder="Enter percentage" class="form-control" required>
                  <small id="percentageValidationMessage" class="text-danger"></small>
                </div>
              </div>
            </div>
          </div>

          <div class="box-footer">
            <input type="submit" name="btnButton" value="Add" class="btn vd_btn vd_bg-green finish" /> &nbsp;
            <input type="button" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php'" /> &nbsp;
          </div>
        </div>
      </form>
    </div>
  </div>
</section><!-- /.content -->
<script>
  function validateForm() {
    var valid = true;
	 
  // Validate Expiry date
    var expiryDate = document.getElementById("expiry_date").value;
    if (!expiryDate) {
      document.getElementById("dateValidationMessage").innerText = "Expiry date is required";
      valid = false;
    } else {
      var currentDate = new Date();
      var selectedDate = new Date(expiryDate);
      if (selectedDate < currentDate) {
        document.getElementById("dateValidationMessage").innerText = "Expiry date cannot be in the past";
        valid = false;
      } else {
        document.getElementById("dateValidationMessage").innerText = "";
      }
    }
// Validate Percentage
    var percentage = document.getElementById("percentage").value;
    if (percentage <= 0 || percentage > 100) {
        document.getElementById("percentageValidationMessage").innerText = "Percentage must be greater than 0 and less than or equal to 100";
        valid = false;
    } else {
        document.getElementById("percentageValidationMessage").innerText = "";
    }
    return valid;
  }
</script>

