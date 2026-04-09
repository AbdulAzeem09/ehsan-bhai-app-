<?php
$postid = isset($_GET['postid']) ? (int)$_GET['postid'] : 0;
?>
<div class="row">
	<div class="col-md-6">
		<div class="form-group">
			<?php if (isset($_GET["postid"])) {
				$p = new _postings;
				$r = $p->read_training($postid);
				if ($pro_id != false) {
					$proid =  mysqli_fetch_assoc($pro_id);
					$profile_id = $proid['spProfiles_idspProfiles'];
				}
				//echo $p->ta->sql;
				if ($r != false) {
					$row = mysqli_fetch_assoc($r);
				}
			}
			?>
			<label for="trainingcategory_" class="lbl_2">Category <span>*</span></label>
			<select class="form-control spPostField" id="trainingcategory_" data-filter="1" name="trainingcategory_" value="<?php echo (empty($row["trainingcategory"]) ? "" : $row["trainingcategory"]); ?>" >
				<?php
				$m = new _subcategory;
				$catid = 8;
				$result = $m->read($catid);
				if ($result) {
					while ($rows = mysqli_fetch_assoc($result)) { ?>
						<option value='<?php echo $rows["subCategoryTitle"]; ?>' <?php echo (isset($row["trainingcategory"]) && $row["trainingcategory"] == trim($rows['subCategoryTitle'])) ? 'selected' : ''; ?>><?php echo $rows["subCategoryTitle"]; ?></option>
				<?php
					}
				}
				?>

			</select>
		</div>
	</div>

	<?php
	$p = new _postings;
	$r = $p->read_training($postid);
	if ($r != false) {
		$row = mysqli_fetch_assoc($r);
		$spPostingCompany = $row['spPostingCompany'];
		$totalhour = $row['totalhour'];
		$spPostingTraimnerBio = $row['spPostingTraimnerBio'];
		$spRequiremnt = $row['spRequiremnt'];
	}
	?>
	<div class="col-md-6">
		<div class="form-group">
			<label for="spPostingCompany_" class="lbl_3">Company <span style="color:red">*</span> </label>
			<input type="text" class="form-control spPostField" id="train_id" data-filter="1" name="spPostingCompany_" value="<?php echo (empty($spPostingCompany) ? "" : $spPostingCompany); ?>" >
			<span id="error_2" class="text-danger"></span>
		</div>
	</div>


	<div class="col-md-6">
		<div class="form-group">
			<label for="musiccost_">Price</label>
			<label class="radio-inline"><input type="radio" data-filter="0" class="spPostField postMusiccost" id="musiccost_" <?php echo (isset($ePrice) && $ePrice > 0) ? 'checked' : ''; ?> value="Sell" name="musiccost_">Sell</label>
			<label class="radio-inline"><input type="radio" data-filter="0" class="spPostField postMusicfree" id="musiccost_" <?php echo (isset($ePrice) && $ePrice == 0) ? 'checked' : ''; ?> value="Free" name="musiccost_">Free</label>
			<div class="cost">
				<div class='input-group'>
					<?php 
					
					
					$ree2 = $p->dolar_training($_SESSION['uid']);
					if ($ree2) {
						$row222 = mysqli_fetch_assoc($ree2);
					}
					?>
					<span class='input-group-addon'><?php echo $row222['currency']; ?></span>
					<input type='text' id='sppostcost' class='form-control' name='spPostingPrice' <?php echo (isset($ePrice) && $ePrice == 0) ? 'readonly' : ''; ?> value="<?php echo (isset($ePrice) && $ePrice > 0) ? $ePrice : $ePrice; ?>">
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6 discountHid" style="<?php echo (isset($ePrice) && $ePrice == 0) ? 'display:none' : ''; ?>">
		<div class="form-group m_btm_20">
			<label for="txtDiscount_">Discount (%)</label>
			<input type="number" name="txtDiscount_" value="<?php echo (empty($row["txtDiscount"]) ? "" : $row["txtDiscount"]); ?>" class="form-control spPostField" id="txtDiscount_">
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group m_btm_20">
			<label for="videolevel_">Video Level</label>
			<select class="form-control spPostField" id="videolevel_" data-filter="1" name="videolevel_" value="">
				<option value='Beginners' <?php if ($videolevel == "Beginners") {
												echo "Selected";
											} ?>>Beginners</option>
				<option value='Intermediate' <?php if ($videolevel == "Intermediate") {
													echo "Selected";
												} ?>>Intermediate</option>
				<option value='Experienced' <?php if ($videolevel == "Experienced") {
												echo "Selected";
											} ?>>Experienced</option>

			</select>
		</div>
	</div>
	<div class="col-md-6">
		<div class="form-group m_btm_20">
			<label for="totalhour_" class="lbl_4">Total Duration <span>*</span></label>
			<input type="text" id="duration" name="totalhour_" value="<?php echo (empty($totalhour) ? "" : $totalhour); ?>" class="form-control spPostField" id="totalhour_" >
			<span id="error_3" class="text-danger"></span>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label for="spPostingTraimnerBio_" class="lbl_5">Trainer Bio <span>*</span></label>
			<textarea name="spPostingTraimnerBio_" id="trainer_id"  class="form-control spPostField"  ><?php echo (empty($spPostingTraimnerBio) ? "" : $spPostingTraimnerBio); ?></textarea>
			<span id="error_4" class="text-danger"></span>
		</div>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<label for="spRequiremnt_" class="lbl_6">Requirements <span>*</span></label>
			<textarea name="spRequiremnt_" class="form-control spPostField"  id="spRequiremnt_"><?php echo (empty($spRequiremnt) ? "" : $spRequiremnt); ?></textarea>
			<span id="error_5" class="text-danger"></span>
		</div>
	</div>





</div>
