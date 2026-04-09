<br>
<div class="row">
	<div class="col-md-4">
		<div class="form-group">
			<label for="doccategory_">Category</label>
			<select class="form-control spPostField" id="doccategory_" data-filter="1" name="doccategory_" value="<?php echo (empty($row["Category"]) ? "" : $row["Category"]);?>">
				<!--<option value="Fiction">Fiction</option>
				<option value="Biography">Biography</option>
				<option value="Art">Art</option>
				<option value="History">History</option>
				<option value="Technology">Technology</option>
				<option value="Science">Science</option>
				<option value="Geography">Geography</option>
				<option value="Music">Music</option>
				<option value="General">General</option>-->
				<?php
					$m = new _masterdetails;
					$masterid = 7;
					$result = $m->read($masterid);
					
					if($result != false)
					{
						while($rows = mysqli_fetch_assoc($result))
						{
							echo "<option value='".$rows["masterDetails"]."'>".$rows["masterDetails"]."</option>";
						}
					}
				?>
		  </select>
		</div>
	</div>
		<div class="col-md-1"></div>
		<div class="col-md-3">
			<div class="form-group">
				<label for="documentalbum_">Album</label>
				<!--Testing-->
				<div class="dropdown">
				  <button class="btn btn-default dropdown-toggle myalbum" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"><?php echo (empty($row["Album"]) ? "Select Album" : $row["Album"]);?><span class="caret"></span>
				  </button>
				  <ul class="dropdown-menu albumdroupdown" aria-labelledby="my_album">
					<?php
						$p = new _album;
						$res = $p->document($_SESSION['uid']);
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
				<input type ="hidden" class="album_id" data-filter="0" name="spPostingAlbum_idspPostingAlbum_">
				<input type="hidden" class="form-control spPostField" data-filter="1" id="documentalbum_" name="documentalbum_" value="<?php echo (empty($row["Album"]) ? "" : $row["Album"]);?>">
			</div>
		</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="spPostingDocumentCost_">Document Cost &nbsp; &nbsp;</label>
			<label class="radio-inline"><input type="radio" class=" spPostField postcost" id="spPostingDocumentCost_" data-filter="0" name="spPostingDocumentCost_">Price</label>
			<label class="radio-inline"><input type="radio" class=" spPostField postfree" id="spPostingDocumentCost_" data-filter="0" name="spPostingDocumentCost_">Free</label>
			<div class="cost"></div>
		</div>
	</div>
  
</div>		
  
	<br><br>
		<div class="row">
			<div class="form-group">
				<label for="adddocument">Add Document</label>
				<input type="file" id="adddocument" class="spmedia" name="spPostingMedia[]" multiple="multiple">
				<p class="help-block"><small>Browse</small></p>
			</div>
			<div id="media-container"></div>
		</div>
<br>

