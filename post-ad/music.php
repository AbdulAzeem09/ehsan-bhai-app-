	
	
	
	<input type="hidden" name="spMusicmediaId_" id="spMusicmediaId_" class="spPostField" value="<?php echo $_GET['post']; ?>">
	<input class="dynamic-pid" type="hidden" id="myprofileid" value="<?php echo $_SESSION['pid'];?>">	
	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="musiccategory_" class="lbl_2">Category</label>
				<select class="form-control spPostField" id="musiccategory_" data-filter="1" name="musiccategory_" value="<?php echo (empty($row["Category"]) ? "" : $row["Category"]);?>">
					<?php
						$m = new _subcategory;
						$catid = 14;
						$result = $m->read($catid);
						if($result){
							while($rows = mysqli_fetch_assoc($result)){ ?>
								<option value='<?php echo $rows["subCategoryTitle"]; ?>' <?php echo (isset($category) && $category == $rows['subCategoryTitle'])?'selected': '';?>><?php echo $rows["subCategoryTitle"]; ?></option>
								<?php
							}
						}
					?>
					
			  </select>
			</div>
		</div>
		<div class="col-md-6">
			 <div class="form-group">
	            <label for="spPostMusicLyrics_" class="lbl_3">Music Lyricist</label>
	            <input type="text" id="spPostMusicLyrics_" class="form-control spPostField" name="spPostMusicLyrics_" value="<?php echo (isset($musicLyric) && $musicLyric != '')?$musicLyric:'';?>">
	           
	        </div>
		</div>
		<div class="col-md-6">
			 <div class="form-group">
	            <label for="spPostNewRelease_">New Release</label>
	            <select class="form-control spPostField" name="spPostNewRelease_">
	            	<option value="No" <?php echo (isset($newReleas) && $newReleas == 'No')?'selected':'';?> >No</option>
	            	<option value="Yes" <?php echo (isset($newReleas) && $newReleas == 'Yes')?'selected':'';?> >Yes</option>
	            </select>
	        </div>
		</div>
		<div class="col-md-6">
			 <div class="form-group">
	            <label for="spPostMusicDirector_" class="lbl_4">Music Director</label>
	            <input type="text" id="spPostMusicDirector_" class="form-control spPostField" name="spPostMusicDirector_" value="<?php echo (isset($musiDirct))?$musiDirct:'';?>">
	           
	        </div>
		</div>
		
		<div class="col-md-6">
	        <div class="form-group">
	            <label for="spPostArtistName_" class="lbl_5">Artist name</label>
	            <input type="text" class="form-control spPostField" name="spPostArtistName_" id="spPostArtistName_"  value="<?php echo (isset($artistName))?$artistName:'';?>" required >
	        </div>
	    
	    </div>
	    <div class="col-md-6">
	        <div class="form-group">
	            
	            <label for="spPostingMusicCmpId_" class="lbl_6">Music Composer</label>
	            <input type="hidden" id="spPostingMusicCmpId_" class="spPostField" name="spPostingMusicCmpId_" value="<?php echo (isset($musiComp))?$musiComp:'';?>">
	            <input type="text" class="form-control spPostField" id="spPostingMusicCmp"  value="" required autocomplete="off" >            
	        </div>
    	</div>
	    <div class="col-md-6">
	    	<div class="form-group">
	    		<label for="spPostLanguage_">Music Language</label>
	    		<select class="form-control spPostField" name="spPostLanguage_">
	    			<?php
	    			$av = new _spAllStoreForm;
	    			$result2 = $av->readMusicLanguage();
	    			if ($result2) {
	    				while ($row2 = mysqli_fetch_assoc($result2)) {
	    					?>
	    					<option value="Hindi" <?php echo (isset($musicLang) && $musicLang == $row2['spMusicTitle'])?'selected':'';?> ><?php echo $row2['spMusicTitle']; ?></option>
	    					<?php
	    				}
	    			}
	    			?>
	    			

	    		</select>
	    	</div>
	    </div>
	    
		<div class="col-md-6">
			<div class="form-group">
				<label for="musiccost_">Price</label>
				<label class="radio-inline"><input type="radio" data-filter="0" class="spPostField postMusiccost" id="musiccost_" <?php echo (isset($ePrice) && $ePrice >0)?'checked':'';?> name="musiccost_">Sell</label>
				<label class="radio-inline"><input type="radio" data-filter="0" class="spPostField postMusicfree" id="musiccost_" <?php echo (isset($ePrice) && $ePrice == 0)?'checked':'';?> name="musiccost_">Free</label>
				<div class="cost">
					<div class='input-group'>
						<span class='input-group-addon'>$</span>
						<input type='text' id='sppostcost' class='form-control' name='spPostingPrice' <?php echo (isset($ePrice) && $ePrice == 0)?'readonly':''; ?> value="<?php echo (isset($ePrice) && $ePrice > 0)?$ePrice:$ePrice;?>">
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-6 discountHid" style="<?php echo (isset($ePrice) && $ePrice == 0)?'display:none':''; ?>">
			<div class="form-group m_btm_20">
				<label for="txtDiscount_">Discount (%)</label>
				<input type="text" name="txtDiscount_" value="" class="form-control spPostField" id="txtDiscount_">
			</div>
		</div>
		<div class="col-md-6 ">
	    	<div class="form-group m_btm_20">
	    		<label for="spPostingVisibility">Post As</label>
	    		<select class="form-control" name="spPostingVisibility">
	    			<option value="-1" <?php echo (isset($visiblty) && $visiblty == '-1')?'selected':'';?> >Public </option>
					<option value="0" <?php echo (isset($visiblty) && $visiblty == '0')?'selected':'';?> >Private</option>
					
	    		</select>
	    	</div>
	    </div>
	    
		<!-- <div class="col-md-6">
			<div class="form-group m_btm_20">
				<label for="txtLink_">Link an youtube file</label>
				<input type="text" name="txtLink_" value="" class="form-control spPostField" id="txtLink_">
			</div>
		</div> -->
		<div class="col-md-6">
			<div class="form-group m_btm_20">
				<label for="musicalbum_">Album</label>
				<div class="dropdown">
				  <button style="width: 100%;text-align: left;" class="btn btn-default dropdown-toggle myalbum" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?php echo (empty($row["Album"]) ? "Select Album" : $row["Album"]);?>
					<span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu albumdroupdown" aria-labelledby="my_album">
					<?php
						$p = new _album;
						$res = $p->music($_SESSION['uid']);
						if ($res != false){
							while($rows = mysqli_fetch_assoc($res)) {
								echo "<li><a href='#' class='my-album-dd' data-albumid='".$rows['idspPostingAlbum']."' data-albumname='".$rows['spPostingAlbumName']."'>".$rows['spPostingAlbumName']."</a></li>";					
							}
						}
					?>
					<li role="separator" class="divider"></li>
					<!--<li><a href="../../album/">Create New Album</a></li>-->
					<li><a href="#" data-toggle="modal" data-target="#exampleModal">Create New Album</a></li>
				  </ul>
				</div>
				<input type ="hidden" class="album_id" name="spPostingAlbum_idspPostingAlbum_">
				<input type="hidden" class="form-control spPostField" id="musicalbum_" data-filter="1" name="musicalbum_" value="<?php echo (empty($row["Album"]) ? "" : $row["Album"]);?>">
			</div>
		</div>
		
		<div class="col-md-12">
			<div class="form-group">
				<label for="tag_" class="lbl_7">Tag</label>
				<textarea name="tag_" class="form-control spPostField" id="tag_"><?php echo (isset($tag) && $tag !='')?$tag:'';?></textarea>
			</div>
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="lyrics_">Music Lyrics</label>
				<script type="text/javascript">
					jQuery(document).ready(function() {
						$(".Editor-editor").text("<?php echo (isset($lyric) && $lyric !='')?$lyric:''; ?>");
					});
				</script>
				<textarea name="lyrics_" id="lyrics_" class="form-control spPostField"><?php echo (isset($lyric) && $lyric !='')?$lyric:'';?></textarea>
			</div>
		</div>
	</div>
	

	
	

	