
<?php
	//all my products
	$res = $p->myStoreProduct($_SESSION['pid']);
	//echo $p->ta->sql;
	if($res->num_rows > 0){
		$totalMyProduct = $res->num_rows;
	}else{
		$totalMyProduct = 0;
	}
	//my active products specefic profile
	$res2 = $p->myStoreProduct_Active($_SESSION['pid']);
	if($res2->num_rows > 0){
		$totalMyActiveProduct = $res2->num_rows;
	}else{
		$totalMyActiveProduct = 0;
	}
	$totalMyInactiveProduct = $totalMyProduct - $totalMyActiveProduct;
?>
<div class="row no-margin">
  	<div class="col-md-4 no-padding">
	    <a href="<?php echo $BaseUrl.'/'.$folder.'/products.php?view=all';?>">
	        <div class="s_m_box text-center">
	            <h2>Total Products</h2>
	            <h4><?php echo $totalMyProduct;?></h4>
	        </div>
	    </a>
  	</div>
  	<div class="col-md-4 no-padding">
	    <a href="<?php echo $BaseUrl.'/'.$folder.'/products.php?view=active';?>">
	        <div class="s_m_box text-center">
	            <h2>Active Products</h2>
	            <h4><?php echo $totalMyActiveProduct;?></h4>
	        </div>
	    </a>
  	</div>
  	<div class="col-md-4 no-padding">
	    <a href="<?php echo $BaseUrl.'/'.$folder.'/products.php?view=inactive';?>">
	        <div class="s_m_box text-center">
	            <h2>Inactive Products</h2>
	            <h4><?php echo $totalMyInactiveProduct;?></h4>
	        </div>
	    </a>
  	</div>
</div>