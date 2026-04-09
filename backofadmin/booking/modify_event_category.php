<?php
    require_once '../library/config.php';
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$errorMessage = (isset($_GET['error']) && $_GET['error'] != '') ? $_GET['error'] : '&nbsp;';

	if(isset($_GET['id']) && ($_GET['id']) != ''){
		$ArtCat  = $_GET['id'];
	}else {
		redirect('shareindex.php');
	}
	$sql = "SELECT * FROM sharepage_event_category WHERE cat_id = $ArtCat";
	$result = dbQuery($dbConn, $sql);
	$row    = dbFetchAssoc($result);
	
	extract($row);
   
?>



<!-- Content Header (Page header) -->
<section class="content-header top_heading">
    <h1>Modify Event Category</h1>
</section>
<!-- Main content -->
<section class="content">
    <!-- start any work here. -->
    <form name="frmAddMainNav" id="frmAddMainNav" method="post" action="share_process_category.php?action=modify"
        enctype="multipart/form-data" onsubmit="return validate(this)">
        <input type="hidden" name="id" id="id" value="<?php echo $ArtCat;?>" />

        <div class="box box-success">
            <div class="box-body">
                <div class="row" id="alertmsg" style="margin: 10px 0px 0px 5px;">
                    <?php 
						if(isset($_SESSION['errorMessage']) && isset($_SESSION['count'])){
							if($_SESSION['count'] <= 1){
								$_SESSION['count'] +=1; ?>
                    <div style="min-height:10px;"></div>
                    <div class="alert alert-<?php echo $_SESSION['data'];?>">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <?php echo $_SESSION['errorMessage'];  ?>
                    </div> <?php
								unset($_SESSION['errorMessage']);
							}
						} ?>
                </div>

                <div class="row">

                    <!-- Event Title -->
                    <div class="col-md-4 col-sm-4" style="margin-bottom:20px;">
                        <label for="category_title">Category Title:</label><br>
                        <input type="text" name="category_title" id="category_title" class="form-control" required="required"
                            value="<?php echo isset($row['category_title']) ? $row['category_title'] : ''; ?>" />
                    </div>

                </div>
                <div class="box-footer">
                    <input type="submit" name="btnButton" value="Update" class="btn vd_btn vd_bg-green finish" /> &nbsp;
                    <input type="button" name="btnButton" value="Back" class="btn vd_btn vd_bg-yellow"
                        onclick="window.location.href='eventCategory_index.php?view=event_categories'" /> &nbsp;
                </div>
            </div>
        </div>
    </form>
</section><!-- /.content -->