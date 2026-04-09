
	<div class="store_searchbox">
	    <form method="POST" action="search.php">
	        <div class="">
	            <input type="hidden" name="txtSearchCategory" value="<?php echo (isset($_GET['mystore']))?$_GET['mystore']:'1'?>">
	            <input type="text" class="form-control" name="txtStoreSearch" placeholder="Search For Products" />
	            <button type="submit" class="btn store_search_btn" name="btnSearchStore">Search</button>
	        </div>                                
	    </form>
	</div>
	<div class="btmLinks m_btm_10">
	  	<div class="row">
	      	<div class="col-md-12">
	        	<ul>
	        		<li><a href="<?php echo $BaseUrl.'/my-store/';?>">My Store</a></li>
	        		<li><a href="<?php echo $BaseUrl.'/store/';?>">Public Store</a></li>
	        		<li><a href="<?php echo $BaseUrl.'/retail/';?>">Retail Store</a></li>
	        		<li><a href="<?php echo $BaseUrl.'/wholesale/';?>">Wholesale</a></li>
	        		<li><a href="<?php echo $BaseUrl.'/private-store/';?>">Group Store</a></li>
	        		<li><a href="<?php echo $BaseUrl.'/friend-store/';?>">Friends Store</a></li>
	        		<li><a href="<?php echo $BaseUrl.'/store/view-all.php?type=auction';?>">Auction</a></li>
	        		<li><a href="<?php echo $BaseUrl.'/public_rfq/'; ?>">RFQ</a></li>
	        		<li><a href="<?php echo $BaseUrl.'/store/category_search.php'; ?>">Categories</a></li>
	        	</ul>
	        	<ul class="pull-right">
	        		<?php
	        		$u = new _spuser;
				    // IS EMAIL IS VERIFIED
				    $p_result = $u->isverify($_SESSION['uid']);
				    if ($p_result == 1) {
				    	if ($_SESSION['ptid'] != 2 && $_SESSION['ptid'] != 5) {
				    		?>
					    	<li><a href="<?php echo $BaseUrl?>/post-ad/sell/?post">Sell</a></li>
					    	<?php
				    	}
				    }
	        		?>
	        		
	        		<li><a href="<?php echo $BaseUrl.'/store/dashboard.php';?>">My Dashboard</a></li>
	        	</ul>
	      	</div>
	  	</div>
	</div>