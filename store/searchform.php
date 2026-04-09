   <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

	<div class="store_searchbox" style="background-color: #ffff" >
	    <form method="POST" action="<?php echo $BaseUrl.'/store/search.php'; ?>">
	        <div class="">
	            <input type="hidden" name="txtSearchCategory" value="<?php echo (isset($_GET['mystore']))?$_GET['mystore']:'1'?>">
	            <input style="border-radius: 19px;background-color: #e6eeff;" type="text" class="form-control" name="txtStoreSearch" placeholder="Search For Products" />
<button type="submit" class="btn btnd_store" name="btnSearchStore" style="    background-color: #0f8f46;">Search</button></div>                                
	    </form>
	</div>
	