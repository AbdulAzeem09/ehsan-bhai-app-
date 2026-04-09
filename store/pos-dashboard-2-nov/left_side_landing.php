<?php


if($_SESSION['ptid'] == 1 ){

//	if(($final_date >= 90) ){ 

$mb = new _spmembership;
$result = $mb->readpid($_SESSION['pid']);
if($result != false){

while($rows = mysqli_fetch_assoc($result)){
//print_r($rows);
$payment_date = $rows["createdon"];
$duration=$rows['duration'];

/*$res = $mb->readmember($rows["membership_id"]);
if($res != false)
{ 
$row = mysqli_fetch_assoc($res);
//echo $row["spMembershipName"]."<br>";
//$count=$row["spMembershipPostlimit"]; 
$duration=$row["duration"];*/

//print_r($row);
$date7 =  date('Y-m-d H:i:s');
$date8=date('Y-m-d', strtotime($date7));
$date5= date('Y-m-d', strtotime($payment_date));	
$date6= date('Y-m-d', strtotime($payment_date. ' +'. $duration.' days'));
//echo  $date5."<br>".$date6."<br>".$date8; die;
if(!(($date5 <= $date8)  && ($date6 >=  $date8))){ ?>
<script>
window.location.replace("/membership?msg=notaccess"); 
</script>

<?php   
}
//}
}
}
else {
	
?> 
<script>
window.location.replace("/membership?msg=notaccess");
</script>
<?php
}
//	}
}
?>


<div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-side"> 
<div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100 mainnav">
<a href="#" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
<span class="fs-5 d-none d-sm-inline">POINT OF SALE</span>
</a>
<ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
<li>
<a href="index.php" class="nav-link px-0 align-middle"><i class="fas fa-tachometer-alt"></i> <span class="ms-1 d-none d-sm-inline">Dashboard</span> </a>
</li>
<li>
<a href="<?php echo $BaseUrl; ?>/store/pos-dashboard/pos.php" target="_blank" rel="noopener noreferrer" class="nav-link px-0 align-middle"><i class="fas fa-cash-register"></i> <span class="ms-1 d-none d-sm-inline">POS</span> </a>
</li>
<li>
<a href="#product" data-bs-toggle="collapse" class="nav-link px-0 align-middle"><i class="fab fa-product-hunt"></i> <span class="ms-1 d-none d-sm-inline">Products</span> </a>
<ul class="collapse nav flex-column ms-1" id="product" data-bs-parent="#menu">
<li class="w-100">
<a href="category.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Categories</span></a>
</li>
<li>
<a href="attributes.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Attributes</span></a>
</li>
<li>
<a href="brands.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Brands</span></a>
</li>
<!--<li>
<a href="add-product.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Add Product</span></a>
</li>-->
<li>
<a href="product-list.php?key=all" class="nav-link px-0"> <span class="d-none d-sm-inline">Product List</span></a>
</li>
</ul>
</li>
<!--<li>
<a href="#customer" data-bs-toggle="collapse" class="nav-link px-0 align-middle"><i class="fas fa-users"></i> <span class="ms-1 d-none d-sm-inline">Customers</span> </a>
<ul class="collapse nav flex-column ms-1" id="customer" data-bs-parent="#menu">
<li class="w-100">
<a href="customer-add.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Add Customer</span></a>
</li>
<!--<li class="w-100">
<a href="customer-import.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Import Customer</span></a>
</li>-->
<li>
<a href="customer-list.php" class="nav-link px-0"><i class="fas fa-users"></i> <span class="d-none d-sm-inline">Customers</span></a>
</li>
<!--<li>
<a href="customer-sale-history.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Sales History</span></a>
</li>-->
<!--</ul>
</li>-->
<li>
<a href="#suppliers" data-bs-toggle="collapse" class="nav-link px-0 align-middle"><i class="fas fa-users"></i> <span class="ms-1 d-none d-sm-inline">Suppliers</span> </a>
<ul class="collapse nav flex-column ms-1" id="suppliers" data-bs-parent="#menu">
<li class="w-100">
<a href="supplier-add.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Add Suppliers</span></a>
</li>

<!--<li class="w-100">
<a href="supplier-import.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Import Suppliers</span></a>
</li>-->
<li>
<a href="supplier-list.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Suppliers's List</span></a>
</li>

<!--<li>
<a href="suppliers-sale-history.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Sales History</span></a>
</li>-->
</ul>
</li>
<li>
<a href="#inventory" data-bs-toggle="collapse" class="nav-link px-0 align-middle"><i class="fas fa-th-large"></i> <span class="ms-1 d-none d-sm-inline">Inventory</span> </a>
<ul class="collapse nav flex-column ms-1" id="inventory" data-bs-parent="#menu">
<li class="w-100">
<a href="receive-inventory.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Receive Inventory</span></a>
</li>
<li class="w-100">
<a href="return-inventory.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Return Inventory</span></a>
</li>
<li>
<a href="adjust-inventory.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Adjust Inventory</span></a>
</li>
<li>
<a href="transfer-inventory.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Transfer Inventory</span></a>
</li>
<li>
<a href="unposted-inventory.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Unposted Inventory</span></a>
</li>
<li>
<a href="inventory-audit.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Inventory Audit</span></a>
</li>
</ul>
</li>
<li>
<a href="#purchase" data-bs-toggle="collapse" class="nav-link px-0 align-middle"><i class="fas fa-cart-arrow-down"></i> <span class="ms-1 d-none d-sm-inline">Purchase</span> </a>
<ul class="collapse nav flex-column ms-1" id="purchase" data-bs-parent="#menu">
<!--<li class="w-100">
<a href="create-po.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Create PO</span></a>
</li>
<li class="w-100">
<a href="sent-po.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Sent PO</span></a>
</li>-->
<li>
<a href="draft-po.php?list=all" class="nav-link px-0"> <span class="d-none d-sm-inline">Draft PO</span></a>
</li>
<li>
<a href="receive-inventory-by-po.php?list=all" class="nav-link px-0"> <span class="d-none d-sm-inline">Received Inventory by PO</span></a>  
</li>

<!--<li>
<a href="unposted-purchase.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Unposted purchase</span></a>
</li>-->
<!--<li>
<a href="purchase-audit.php" class="nav-link px-0"> <span class="d-none d-sm-inline">purchase Audit</span></a>
</li>-->
</ul>
</li>
<li>
<a href="#reports" data-bs-toggle="collapse" class="nav-link px-0 align-middle"><i class="fas fa-scroll"></i> <span class="ms-1 d-none d-sm-inline">Reports</span> </a>
<ul class="collapse nav flex-column ms-1" id="reports" data-bs-parent="#menu">
<li class="w-100">
<a href="sale-history.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Sales History</span></a>
</li>
<!--<li class="w-100">
<a href="sale-by-items.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Sales by Items</span></a>
</li>
<li>
<a href="sale-by-customer.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Sale by Customer</span></a>
</li>
<li>
<a href="sale-by-category.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Sales By Category</span></a>
</li>
<li>
<a href="sale-by-country.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Sales By Country</span></a>
</li>
<li>
<a href="purchase-history.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Purchase History</span></a>
</li>
<li>
<a href="purchase-by-item.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Purchase by Item</span></a>
</li>
<li>
<a href="purchase-by-customer.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Purchase By Customer</span></a>
</li>
<li>
<a href="purchase-by-supplier.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Purchase By Supplier</span></a>
</li>
<li>
<a href="purchase-by-category.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Purchase by Category</span></a>
</li>
<li>
<a href="purchase-by-country.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Purchase by Country</span></a>
</li>-->  
<!--<li>
<a href="custom-purchase.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Custom Purchase Report</span></a>
</li>-->  
<li>
<a href="stock-movement.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Stock Movement</span></a>
</li>
<!--<li>
<a href="stock-by-item.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Stock by Item</span></a>
</li>
<li>
<a href="stock-by-location.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Stock by Location</span></a>
</li>
<li>
<a href="stock-by-category.php" class="nav-link px-0"> <span class="d-none d-sm-inline">Stock by Category</span></a>
</li>-->
</ul>
</li>

<!--<li> 
<a href="giftcard.php" class="nav-link px-0 align-middle"><i class="fas fa-gifts"></i> <span class="ms-1 d-none d-sm-inline">Gift Card</span> </a>
</li>-->
<!--<li>
<a href="store.php" class="nav-link px-0 align-middle"><i class="fas fa-store"></i> <span class="ms-1 d-none d-sm-inline">Store</span></a>
</li>-->
<li>
<a href="pos_sales_record.php?action=all" class="nav-link px-0 align-middle"><i class="fas fa-store"></i> <span class="ms-1 d-none d-sm-inline">Sales</span></a>  
</li>
<li>
<a href="pos_payment_record.php?action=all" class="nav-link px-0 align-middle"><i class="fas fa-store"></i> <span class="ms-1 d-none d-sm-inline">Payment Details</span></a>  
</li>

<li>
<a href="settings.php?record=payment_type" class="nav-link px-0 align-middle"><i class="fas fa-cogs"></i> <span class="ms-1 d-none d-sm-inline">Settings</span></a> 
</li>

<li>
<a href="membership_history.php" class="nav-link px-0 align-middle"><i class="fas fa-cogs"></i> <span class="ms-1 d-none d-sm-inline">Membership History</span></a> 
</li>

</ul>
<hr />
<?php //print_r($_SESSION); die(); ?>
<div class="dropdown pb-4 profile">
<a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">

<?php
	//echo $_SESSION['pid'];
	//die("==");
		$p = new _spprofiles;
		$result = $p->read($_SESSION['pid']);
		if ($result != false) {
			$row = mysqli_fetch_assoc($result);
			if (isset($row["spProfilePic"]) && $row['spProfilePic'] != '')
				echo "<img alt='profilepic' style='width: 40px; height: 40px; ' id='img1' class='rounded-circle' src=' " . ($row["spProfilePic"]) . "'  >";
			else
				echo "<img alt='profilepic' class='img-circle' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px; height: 40px; ' >";
		}
                                        ?>

<!--<img src="img/user.png" alt="hugenerd" width="30" height="30" class="rounded-circle" />-->
<span class="d-none d-sm-inline mx-1"><?php echo $_SESSION['myprofile']; ?></span>
</a>
<ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
<li><a class="dropdown-item" href="<?php echo $BaseUrl; ?>/dashboard/settings/">Settings</a></li>
<li><a class="dropdown-item" href="<?php echo $BaseUrl; ?>/my-profile/">Profile</a></li>
<li>
<hr class="dropdown-divider" />
</li>
<li><a class="dropdown-item" href="<?php echo $BaseUrl; ?>/authentication/logout.php">Sign out</a></li>
</ul>
</div>
</div>
</div>

