<!-- idspFSProduct, spFSProductName, spFSProductCategory, spFSProductDescription, spFSProductImage, spFSProductAmount, spFSProductDiscount, spFSProductQuantity, spFSProductMinQuantity, spFSProductUnit, spFSProductColors, spFSProductSizes, spFriendStore_idspFriendStore, spProfiles_idspProfiles
-->

	<form method="post" action="../mlayer/postservices.php">
		<input type="hidden" name="postservicerequest_" value="_spproducts">
		<input type="hidden" name="idspFSProduct" id="idspFSProduct" >
		<input type="hidden" name="spFriendStore_idspFriendStore" id="spFriendStore_idspFriendStore" >
		<div class="container-fluid">
		<div class="row">
			<div class="col-md-4">
				<img src="..." alt="..." class="img-responsive img-thumbnail"> 
				<div class="form-group">
					<input type="file">
				</div>

				<div class="container-fluid">
					<div class="row">	
						<div class="col-md-6">
						<div class="form-group">
						<label for="spFSProductAmount">Amount</label>
						<input type="text" class="form-control" name="spFSProductAmount" id="spFSProductAmount" placeholder="Amount" required></div>
						</div>
						<div class="col-md-6">
						<div class="form-group">
						<label for="spFSProductDiscount">Discount</label>
						<input type="text" class="form-control" name="spFSProductDiscount" id="spFSProductDiscount" placeholder="Discount"></div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6"> 
						<div class="form-group">
						<label for="spFSProductColors">Colors</label>
						<input type="text" class="form-control" name="spFSProductColors" id="spFSProductColors" placeholder="Colors"></div>
						</div>
						<div class="col-md-6">
						<div class="form-group">
						<label for="spFSProductSizes">Sizes</label>
						<input type="text" class="form-control" name="spFSProductSizes" id="spFSProductSizes" placeholder="Sizes"></div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6">
						<div class="form-group">
						<label for="spFSProductUnit">Unit</label>
						<input type="text" class="form-control" name="spFSProductUnit" id="spFSProductUnit" placeholder="Unit"></div>
						</div>
						<div class="col-md-6">
						<div class="form-group">
						<label for="spFSProductMinQuantity">Min. Qty.</label>
						<input type="text" class="form-control" name="spFSProductMinQuantity" id="spFSProductMinQuantity" placeholder="Minimum Quantity"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
					<label for="spFSProductName">Product Name</label>
					<input type="text" class="form-control" name="spFSProductName" id="spFSProductName" placeholder="Product Name" required>
				</div>
				<div class="form-group">
					<label for="spFSProductCategory">Categoryies</label>
					<input type="text" class="form-control" name="spFSProductCategory" id="spFSProductCategory" placeholder="Product Categories" required>
				</div>
				<div class="form-group">
					<label for="spFSProductDescription">Description</label>
					<textarea id="spFSProductDescription" name="spFSProductDescription" class="form-control" placeholder="Product Description" rows="3" required></textarea>
				</div>
				<button type="button" id="spPostClose" class="btn btn-default">Close</button>
				<button type="submit" id="spPostSubmit" class="pull-right btn btn-success" data-loading-text="Posting..." autocomplete="off">Post</button>
			</div>
		</div>
		</div>
	</form> 
	
