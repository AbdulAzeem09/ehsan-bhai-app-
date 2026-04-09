<?php
 

require_once '../library/config.php';
require_once '../library/functions.php';
error_reporting(0);
@ini_set('display_errors', 0);
	if (!defined('WEB_ROOT')) {
		exit;
    }
    
?>
<section class="content-header top_heading">
    <h1>Add Event Category</h1>
</section>
<section class="content">
    <form name="frmAddMainNav" id="frmAddMainNav" method="post" action="share_process_category.php?action=add"
        enctype="multipart/form-data" onsubmit="return validate(this)">
        <div class="box box-success">
            <div class="box-body">
                <div class="row" id="alertmsg" style="margin: 10px 0px 0px 5px;">
                    <?php if (isset($_SESSION['errorMessage']) && isset($_SESSION['count'])) {
                        if ($_SESSION['count'] <= 1) {
                            $_SESSION['count'] += 1; ?>
                    <div class="alert alert-<?php echo $_SESSION['data'];?>">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $_SESSION['errorMessage']; ?>
                    </div>
                    <?php unset($_SESSION['errorMessage']); } } ?>
                </div>

                <div class="row">
                    <!-- Other Form Fields -->
                    <div class="col-md-4" style="margin-bottom: 20px;">
                        <label for="category_title">Category Title:</label>
                        <input type="text" name="category_title" id="category_title" class="form-control" />
                    </div>
                </div>
            </div>

            <div class="box-footer">
                <input type="submit" name="btnButton" value="Save" class="btn vd_btn vd_bg-green" /> &nbsp;
                <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow"
                    onclick="window.location.href='eventCategory_index.php?view=event_categories'" /> &nbsp;
            </div>
        </div>
    </form>
</section>