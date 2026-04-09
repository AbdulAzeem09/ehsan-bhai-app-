	
	<?php
	// this name is changed because error is arise for duplicate sp_autoloader
	function sp_autoloaderr($class){
        include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloaderr");

	?>
	<div class="col-md-4 ">
		<div class="form-group">
			<label for="industryType_">Industry Type</label>
			<select class="form-control spPostField" data-filter="1" name="industryType_" id="industryType_">
				<?php
				$it = new _spAllStoreForm;
				$result2 = $it->readIndustryType();
				if ($result2) {
					while ($row2 = mysqli_fetch_assoc($result2)) {
						?>
						<option value="<?php echo str_replace( ' ', '', $row2['industryTitle'] ); ?>"><?php echo ucwords(strtolower($row2['industryTitle'])); ?></option>
						<?php
					}
				}
				?>	
		  </select>
		</div>
	</div>
	<!--Retail code of Sell-->
	<div class="retail-wholesheller">
		<?php
			include_once ("retail.php");
		?>
	</div>