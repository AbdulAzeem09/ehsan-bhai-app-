<style>

.select2-results__option, .input-group {

font-size: 14px!important;
}


</style>

<div class="bg-white p-4 rounded shadow">
<?php
if (isset($_SESSION['errorMessage']) && isset($_SESSION['count'])) {
if ($_SESSION['count'] <= 1) {
$_SESSION['count'] += 1; ?>
<div class="alert alert-success alert-dismissible">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
<?php echo $_SESSION['errorMessage'];  ?>
</div> <?php
unset($_SESSION['errorMessage']);
}
} ?>


<form method="post" action="<?php echo $BaseUrl . '/public_rfq/?page=1'; ?>" class="searchRfqfrom">
<div class="row">

<h2>Search RFQ(Request for Quotations)</h2>
<div class="col-md-2">
<div class="input-group">                                
<select class="form-select SelExample" name="rfqCategory" id="rfqCategory" value="<?php if (isset($_POST['rfqCategory'])) {echo $_POST['rfqCategory'];} ?>">
<option value="all">All</option>
<?php
$m = new _subcategory;
$catid = 1;
$result = $m->read($catid);
if ($result) {
while ($rows = mysqli_fetch_assoc($result)) {
?>
<option value="<?php echo ucwords(strtolower($rows["subCategoryTitle"])); ?>" <?php if ($_POST['rfqCategory'] == ucwords(strtolower($rows["subCategoryTitle"]))) {
echo "selected";
} ?>><?php echo ucwords(strtolower($rows["subCategoryTitle"])); ?></option>                                            
<?php
}
}
?>
</select>
</div>
</div>
<div class="col-md-6">
<div class="input-group">
<input type="text" style="height:28px!important" class="form-control" name="rfqTitle" value="<?php if (isset($_POST['rfqTitle'])) {echo $_POST['rfqTitle'];} ?>" placeholder="Search Keyword" />
<label style="display: block;">&nbsp;</label>
<button class="btn btn-primary" style="height:28px!important"><i class="fa fa-search"></i></button>                                
<button href="<?php echo $BaseUrl.'/public_rfq/?page=1';?>"  class=" btn">Reset</button>
</div>
</div>


<div class="col-md-4">
<div class="d-flex justify-content-between">
<a href="<?php echo $BaseUrl; ?>/public_rfq/request_for_quote.php" style="height:28px!important" class="btn btn-primary btn-border-radius">Create Public RFQ</a>

<?php if ($_SESSION['ptid'] == "2" || $_SESSION['ptid'] == "5") {
} else { ?>
<!-- <a href="<?php echo $BaseUrl; ?>/post-ad/sell/?post" class="btn btn-warning  sell" s>Sell Product</a> -->
<?php } ?>
</div>
</div>


</div>
</form>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

</script>


<script type="text/javascript">
$('.SelExample').select2({
selectOnClose: true
});
</script>