<?php
//  error_reporting(E_ALL);
//  ini_set('display_errors', '1');

if (!defined('WEB_ROOT')) {
exit;
}


if(isset($_POST["btnButton"])){
//print_r($_POST);die('+++');
$id= $_GET['id'];
$role_id= $_POST['role_id'];
//echo $role_id; die('===');
$role_name=$_POST["role_name"];

$sql="UPDATE `staff` SET `role_name`='$role_name' WHERE id= $role_id ";
$result = dbQuery($dbConn,$sql);



$sql4="DELETE FROM `role_permission` WHERE role_id=$role_id ";
$result4 = dbQuery($dbConn,$sql4);
if(isset($_POST['staff_check'])){

$count = count($_POST['staff_check']);

for($i=0; $i<$count; $i++){

$permission = $_POST['staff_check'][$i];
$role_id=$_GET['id'];
$userid=$_SESSION['userId'];


$sql5="INSERT INTO `role_permission`(`userid`, `role_id`, `permission_id`) VALUES ('$userid','$role_id','$permission')";
$result5 = dbQuery($dbConn,$sql5);

}

}





redirect('index.php?view=staff');
}
if(isset($_GET['id'])){
$id= $_GET['id'];
$role_id= $_GET['id'];

$sql1= "SELECT * FROM `staff` WHERE id= $id ";
$result2 = dbQuery($dbConn,$sql1);
$row = dbFetchAssoc($result2);
// print_r ($row);die('====');
}
?>

<!-- Content Header (Page header) -->
<section class="content-header">
<h1>Edit Role <small>[Add]</small></h1>
</section>
<!-- Main content -->
<section class="content" >
<div class="row">
<div class="col-md-12">
<!-- start any work here. -->
<form action="" method="post" name="frmAddAdmin" id="frmAddAdmin">
<div class="box box-primary">
<div class="box-body">
<div class="row">
<div class="col-md-11 col-sm-12">
<div class="form-group">
<label>Add Role</label> <span class="pull-right"><input type="checkbox" id="checkAll" ><label  style="
margin-left: 3px;" >Check All</label></span></br>
<input type="hidden" name="role_id" value="<?php echo $id ;?>">
<input type="text" name="role_name" id="role_name" class="form-control" value="<?php echo $row['role_name']; ?>" style="width: 30% !important">
</div>
</div>

<div class="col-md-3 col-sm-4" >
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Report" value="1" <?php echo (check_permission($role_id,1,$dbConn)) ? 'checked':'';?> />
<label for="Report">Report</label></br>
</div>
</div> 

<div class="col-md-3 col-sm-4">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="DashBoard" value="2" <?php echo (check_permission($role_id,2,$dbConn)) ? 'checked':'';?> />
<label for="DashBoard">DashBoard</label></br>
</div>
</div>
<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ProfileType" value="3" <?php echo (check_permission($role_id,3,$dbConn)) ? 'checked':'';?> />
<label for="ProfileType">Profile Type</label></br>
</div>
</div> 

<div class="col-md-3 col-sm-4">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="SharepageEarning" value="4" <?php echo (check_permission($role_id,4,$dbConn)) ? 'checked':'';?> />
<label for="SharepageEarning">Sharepage Earning</label></br>
</div>
</div> 

<div class="col-md-3 col-sm-4">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="CommisionRequest" value="5" <?php echo (check_permission($role_id,5,$dbConn)) ? 'checked':'';?> />
<label for="CommisionRequest">Commision Request </label></br>
</div>
</div>	
<div class="col-md-7 col-sm-8 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="SpPointRequest" value="6" <?php echo (check_permission($role_id,6,$dbConn)) ? 'checked':'';?> />
<label for="SpPointRequest">SpPoint Request  </label></br>
</div>
</div>	

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Wallet</b>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="RealEstate" value="7" <?php echo (check_permission($role_id,7,$dbConn)) ? 'checked':'';?> />
<label for="RealEstate"> Real Estate </label></br>
</div>
</div>	

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Event" value="8" <?php echo (check_permission($role_id,8,$dbConn)) ? 'checked':'';?> />
<label for="Event">Event</label></br>
</div>
</div>	

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ArtCraft" value="9" <?php echo (check_permission($role_id,9,$dbConn)) ? 'checked':'';?> />
<label for="ArtCraft"> Art and Craft</label></br>
</div>

</div>
<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="video" value="10" <?php echo (check_permission($role_id,10,$dbConn)) ? 'checked':'';?> />
<label for="video">Video</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="StoreWallet" value="11" <?php echo (check_permission($role_id,11,$dbConn)) ? 'checked':'';?> />
<label for="StoreWallet">Store Wallet</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="GroupEvent" value="12" <?php echo (check_permission($role_id,12,$dbConn)) ? 'checked':'';?> />
<label for="GroupEvent">Group Event</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="BonusWallet" value="13" <?php echo (check_permission($role_id,13,$dbConn)) ? 'checked':'';?> />
<label for="BonusWallet">Bonus Wallet</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="TrainingWallet" value="14" <?php echo (check_permission($role_id,14,$dbConn)) ? 'checked':'';?> />
<label for="TrainingWallet">Training Wallet</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Earnings By Modules</b>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ListingModules" value="15" <?php echo (check_permission($role_id,15,$dbConn)) ? 'checked':'';?> />
<label for="ListingModules">Listing Of All Modules</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Support Packages</b>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="PackageList" value="16" <?php echo (check_permission($role_id,16,$dbConn)) ? 'checked':'';?> />
<label for="PackageList">Package List</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="PurchasePackage" value="17" <?php echo (check_permission($role_id,17,$dbConn)) ? 'checked':'';?> />
<label for="PurchasePackage">Purchase Support Package </label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="CustomerEnquiry" value="18" <?php echo (check_permission($role_id,18,$dbConn)) ? 'checked':'';?> />
<label for="CustomerEnquiry">Customer Enquiry</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ClosedEnquiry" value="19" <?php echo (check_permission($role_id,19,$dbConn)) ? 'checked':'';?> />
<label for="ClosedEnquiry">Closed Enquiry</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="OpenEnquiry" value="20" <?php echo (check_permission($role_id,20,$dbConn)) ? 'checked':'';?> />
<label for="OpenEnquiry">Open Enquiry</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Payments</b>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="StorePayment" value="21" <?php echo (check_permission($role_id,21,$dbConn)) ? 'checked':'';?> />
<label for="StorePayment">Store Payment</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="RFQPayment" value="22"  <?php echo (check_permission($role_id,22,$dbConn)) ? 'checked':'';?> />
<label for="RFQPayment">Private RFQ Payment</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="QuotationPayment" value="23" <?php echo (check_permission($role_id,23,$dbConn)) ? 'checked':'';?> />
<label for="QuotationPayment">Quotation Payment</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="PaymentRequest" value="24" <?php echo (check_permission($role_id,24,$dbConn)) ? 'checked':'';?> />
<label for="Payment Request">Payment Request</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ManageCuerrency" value="25" <?php echo (check_permission($role_id,25,$dbConn)) ? 'checked':'';?> />
<label for="ManageCuerrency">Manage Cuerrency</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Setting" value="26" <?php echo (check_permission($role_id,26,$dbConn)) ? 'checked':'';?> />
<label for="Setting">Setting</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="PointsView" value="27" <?php echo (check_permission($role_id,27,$dbConn)) ? 'checked':'';?> />
<label for="PointsView">Sp Points-View</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="PointsRedeemed" value="28" <?php echo (check_permission($role_id,28,$dbConn)) ? 'checked':'';?> />
<label for="PointsRedeemed">Sp Points Redeemed</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="PointsUnused" value="29" <?php echo (check_permission($role_id,29,$dbConn)) ? 'checked':'';?> />
<label for="PointsUnused">Sp Points Unused</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="RedeemRequest" value="30" <?php echo (check_permission($role_id,30,$dbConn)) ? 'checked':'';?> />
<label for="RedeemRequest">Redeem Request</label></br>
</div>
</div>
<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Users Rights" value="31" <?php echo (check_permission($role_id,31,$dbConn)) ? 'checked':'';?> />
<label for="UsersRights">Users Rights</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="AssignUsers" value="32" <?php echo (check_permission($role_id,32,$dbConn)) ? 'checked':'';?> />
<label for="AssignUsers">Assign Users</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="CreateUsers" value="33" <?php echo (check_permission($role_id,33,$dbConn)) ? 'checked':'';?> />
<label for="CreateUsers">Create Users</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="UsersList" value="34" <?php echo (check_permission($role_id,34,$dbConn)) ? 'checked':'';?> />
<label for="UsersList">Users List</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check182" value="182" <?php echo (check_permission($role_id,182,$dbConn)) ? 'checked':'';?> />
<label for="staff_check182">Users Referral</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check183" value="183" <?php echo (check_permission($role_id,183,$dbConn)) ? 'checked':'';?> />
<label for="staff_check183">Deleted Users</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="AddMembership" value="35" <?php echo (check_permission($role_id,35,$dbConn)) ? 'checked':'';?> />
<label for="AddMembership">Add Membership Types</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ActiveMemberships" value="36" <?php echo (check_permission($role_id,36,$dbConn)) ? 'checked':'';?> />
<label for="ActiveMemberships">Active Memberships</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="MembershipEnquiry" value="37" <?php echo (check_permission($role_id,37,$dbConn)) ? 'checked':'';?> />
<label for="MembershipEnquiry">Membership Enquiry</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="MembershipTransaction" value="38" <?php echo (check_permission($role_id,38,$dbConn)) ? 'checked':'';?> />
<label for="MembershipTransaction">Membership Transaction</label></br>
</div>
</div>



<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="MembershipAssign" value="39" <?php echo (check_permission($role_id,39,$dbConn)) ? 'checked':'';?> />
<label for="MembershipAssign">Membership Assign</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="FreeMembership" value="40" <?php echo (check_permission($role_id,40,$dbConn)) ? 'checked':'';?> />
<label for="FreeMembership">Free Membership Users</label></br>
</div>
</div>
<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="FreeMembership1" value="410"  <?php echo (check_permission($role_id,410,$dbConn)) ? 'checked':'';?>/>
<label for="FreeMembership1">Expired Membership Users</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ProfileType" value="41" <?php echo (check_permission($role_id,41,$dbConn)) ? 'checked':'';?> />
<label for="ProfileType">Profile Type</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="NotificationTemplate " value="42" <?php echo (check_permission($role_id,42,$dbConn)) ? 'checked':'';?> />
<label for="NotificationTemplate ">Notification Template</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="SharepageModules" value="43" <?php echo (check_permission($role_id,43,$dbConn)) ? 'checked':'';?> />
<label for="SharepageModules">Sharepage Modules</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ContactTopic" value="44" <?php echo (check_permission($role_id,44,$dbConn)) ? 'checked':'';?> />
<label for="ContactTopic">Contact Topic Issues</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Aws" value="45" <?php echo (check_permission($role_id,45,$dbConn)) ? 'checked':'';?> />
<label for="Aws">Aws S-3</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Packages" value="46" <?php echo (check_permission($role_id,46,$dbConn)) ? 'checked':'';?> />
<label for="Packages">Packages</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Listings" value="47" <?php echo (check_permission($role_id,47,$dbConn)) ? 'checked':'';?> />
<label for="Packages">Listings </label></br>
</div>
</div>

<!-- new Subscriber  -->

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Subscriber" value="48" <?php echo (check_permission($role_id,48,$dbConn)) ? 'checked':'';?> />
<label for="Subscriber">Subscriber</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Countries" value="49" <?php echo (check_permission($role_id,49,$dbConn)) ? 'checked':'';?> />
<label for="Countries">Countries</label></br>
</div>
</div>



<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="StateProvince" value="50" <?php echo (check_permission($role_id,50,$dbConn)) ? 'checked':'';?> />
<label for="StateProvince">State/Province</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Cities" value="51" <?php echo (check_permission($role_id,51 ,$dbConn)) ? 'checked':'';?> />
<label for="Cities">Cities</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="AllGroups" value="52" <?php echo (check_permission($role_id,52,$dbConn)) ? 'checked':'';?> />
<label for="AllGroups"> All Groups</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="BannedGroups" value="53" <?php echo (check_permission($role_id,53,$dbConn)) ? 'checked':'';?> />
<label for="BannedGroups">Banned Groups</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="GroupsCategory" value="54" <?php echo (check_permission($role_id,54,$dbConn)) ? 'checked':'';?> />
<label for="GroupsCategory">Groups Category</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Category" value="55" <?php echo (check_permission($role_id,55,$dbConn)) ? 'checked':'';?> />
<label for="Category ">Category</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Setting1" value="56" <?php echo (check_permission($role_id,56,$dbConn)) ? 'checked':'';?> />
<label for="Setting1">Setting</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="CommissionRate" value="57" <?php echo (check_permission($role_id,57,$dbConn)) ? 'checked':'';?> />
<label for="CommissionRate">Commission Rate</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Commission List</b>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="TodayRegistered" value="58" <?php echo (check_permission($role_id,58,$dbConn)) ? 'checked':'';?> />
<label for="TodayRegistered">Today Registered Users</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Friend Commission</b>
</div>

<!-- new -->


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="SuperFriends" value="59" <?php echo (check_permission($role_id,59,$dbConn)) ? 'checked':'';?> />
<label for="SuperFriends">Super VIP Friends</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="VIPFriends" value="60" <?php echo (check_permission($role_id,60,$dbConn)) ? 'checked':'';?> />
<label for="VIPFriends">VIP Friends </label></br>
</div>
</div>



<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="SuperCommission" value="61" <?php echo (check_permission($role_id,61,$dbConn)) ? 'checked':'';?> />
<label for="SuperCommission">Super VIP Commission</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="VIPCommission " value="62" <?php echo (check_permission($role_id,62,$dbConn)) ? 'checked':'';?> />
<label for="VIPCommission ">VIP Commission </label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="GeneralCommission" value="63" <?php echo (check_permission($role_id,63,$dbConn)) ? 'checked':'';?> />
<label for="GeneralCommission">General Commission</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="SaleCommission" value="64" <?php echo (check_permission($role_id,64,$dbConn)) ? 'checked':'';?> />
<label for="SaleCommission">Sale Commission</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ContactMassages" value="65" <?php echo (check_permission($role_id,65,$dbConn)) ? 'checked':'';?> />
<label for="ContactMassages">Contact Massages</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="SocialMedia" value="66" <?php echo (check_permission($role_id,66,$dbConn)) ? 'checked':'';?> />
<label for="SocialMedia">Social Media Links</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="PostingContent" value="67" <?php echo (check_permission($role_id,67,$dbConn)) ? 'checked':'';?> />
<label for="PostingContent">Posting Content</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ProfileContent" value="68" <?php echo (check_permission($role_id,68,$dbConn)) ? 'checked':'';?> />
<label for="ProfileContent">Profile Content</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="UploadBanner" value="69" <?php echo (check_permission($role_id,69,$dbConn)) ? 'checked':'';?> />
<label for="UploadBanner">Upload Store Banner</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Job Board</b>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="HireEmployee" value="70" <?php echo (check_permission($role_id,70,$dbConn)) ? 'checked':'';?> />
<label for="HireEmployee">Hire An Employee</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="LookingJob" value="71" <?php echo (check_permission($role_id,71,$dbConn)) ? 'checked':'';?> />
<label for="LookingJob">Looking For A Job</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="LeftContent" value="72" <?php echo (check_permission($role_id,72,$dbConn)) ? 'checked':'';?> />
<label for="LeftContent">Left Content</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Footer Content</b>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="HeadingColum" value="73" <?php echo (check_permission($role_id,73,$dbConn)) ? 'checked':'';?> />
<label for="HeadingColum">Footer Heading Colum</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="FooterPages" value="74" <?php echo (check_permission($role_id,74,$dbConn)) ? 'checked':'';?> />
<label for="FooterPages">Footer Pages</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="SharepageBlogs" value="75" <?php echo (check_permission($role_id,75,$dbConn)) ? 'checked':'';?> />
<label for="SharepageBlogs">Sharepage Blogs</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Contacts</b>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ContactIssue" value="76" <?php echo (check_permission($role_id,76,$dbConn)) ? 'checked':'';?> />
<label for="ContactIssue">Contact Topic Issue</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ReceivedReplies" value="77" <?php echo (check_permission($role_id,77,$dbConn)) ? 'checked':'';?> />
<label for="ReceivedReplies">Received Message And Replies</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="SocialMedia2" value="78" <?php echo (check_permission($role_id,78,$dbConn)) ? 'checked':'';?> />
<label for="SocialMedia2">Social Media</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Homepage Content</b>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="EmailMarketing" value="79" <?php echo (check_permission($role_id,79,$dbConn)) ? 'checked':'';?> />
<label for="EmailMarketing">Email Marketing</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="SMSMarketing" value="80" <?php echo (check_permission($role_id,80,$dbConn)) ? 'checked':'';?> />
<label for="SMSMarketing">SMS Marketing</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Feature" value="81" <?php echo (check_permission($role_id,81,$dbConn)) ? 'checked':'';?> />
<label for="Feature">Feature</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="EmailUsers" value="82" <?php echo (check_permission($role_id,82,$dbConn)) ? 'checked':'';?> />
<label for="EmailUsers">Email to Users</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Bookings</b>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="GroupBooked" value="83" <?php echo (check_permission($role_id,83,$dbConn)) ? 'checked':'';?> />
<label for="GroupBooked">Group Event Booked</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="EventBooked" value="84" <?php echo (check_permission($role_id,84,$dbConn)) ? 'checked':'';?> />
<label for="EventBooked">Event Booked</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Email Template</b>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="EmailTemplate" value="85" <?php echo (check_permission($role_id,85,$dbConn)) ? 'checked':'';?> />
<label for="EmailTemplate">Email Template</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="AddMedia" value="86" <?php echo (check_permission($role_id,86,$dbConn)) ? 'checked':'';?> />
<label for="AddMedia">Add Media</label></br>
</div>
</div>

<!-- new -->



<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ChannelRequest" value="87" <?php echo (check_permission($role_id,87,$dbConn)) ? 'checked':'';?> />
<label for="ChannelRequest">Channel Request</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Aboutus2" value="178" <?php echo (check_permission($role_id,178,$dbConn)) ? 'checked':'';?> />
<label for="Aboutus2">Approved/Rejected Courses</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Aboutus" value="88" <?php echo (check_permission($role_id,88,$dbConn)) ? 'checked':'';?> />
<label for="Aboutus">About Us</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Announcement" value="89" <?php echo (check_permission($role_id,89,$dbConn)) ? 'checked':'';?> />
<label for="Announcement">Announcement</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Worldnews" value="90" <?php echo (check_permission($role_id,90,$dbConn)) ? 'checked':'';?> />
<label for="Worldnews">World News</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="PendingApproval" value="91" <?php echo (check_permission($role_id,91,$dbConn)) ? 'checked':'';?> />
<label for="PendingApproval">Pending Approval</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="RejectedCourses" value="92" <?php echo (check_permission($role_id,92,$dbConn)) ? 'checked':'';?> />
<label for="RejectedCourses">Rejected Courses</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ApprovedCourses" value="93" <?php echo (check_permission($role_id,93,$dbConn)) ? 'checked':'';?> />
<label for="ApprovedCourses">Approved Courses</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Courses22" value="94" <?php echo (check_permission($role_id,94,$dbConn)) ? 'checked':'';?> />
<label for="Courses22">Courses</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Art Gallery [Category]</b>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ArtGallery" value="95" <?php echo (check_permission($role_id,95,$dbConn)) ? 'checked':'';?> />
<label for="ArtGallery">Art Gallery [Subcategory]</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ArtSizes" value="96" <?php echo (check_permission($role_id,96,$dbConn)) ? 'checked':'';?> />
<label for="ArtSizes">Art Gallery [Sizes]</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Craft Gallery [Category]</b>
</div>
<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ArtSizes22" value="97" <?php echo (check_permission($role_id,97,$dbConn)) ? 'checked':'';?> />
<label for="ArtSizes22">Craft Gallery [Subategory]</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ClassifiedCategory" value="98" <?php echo (check_permission($role_id,98,$dbConn)) ? 'checked':'';?> />
<label for="ClassifiedCategory"> Classified Ads Category</label></br>
</div>
</div>


<!-- new -->

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="EventCategory" value="99" <?php echo (check_permission($role_id,99,$dbConn)) ? 'checked':'';?> />
<label for="EventCategory">Event Category</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="EventGroups" value="100" <?php echo (check_permission($role_id,100,$dbConn)) ? 'checked':'';?> />
<label for="EventGroups">Event Groups</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="MusicCategory" value="101" <?php echo (check_permission($role_id,101,$dbConn)) ? 'checked':'';?> />
<label for="MusicCategory">Music Category</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="GroupCategory" value="102" <?php echo (check_permission($role_id,102,$dbConn)) ? 'checked':'';?> />
<label for="GroupCategory">Group Category</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Project_Type" value="103" <?php echo (check_permission($role_id,103,$dbConn)) ? 'checked':'';?> />
<label for="Project_Type">Freelance - Project Type</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Modules" value="104" <?php echo (check_permission($role_id,104,$dbConn)) ? 'checked':'';?> />
<label for="Modules">Modules</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;"> All Category</b>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="SubCategory" value="105" <?php echo (check_permission($role_id,105,$dbConn)) ? 'checked':'';?> />
<label for="SubCategory"> Inner Sub Category</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="AdsCategory" value="106" <?php echo (check_permission($role_id,106,$dbConn)) ? 'checked':'';?> />
<label for="AdsCategory"> Classified Ads Category</label></br>
</div>
</div>




<!-- new -->

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="BusinessCategory" value="107" <?php echo (check_permission($role_id,107,$dbConn)) ? 'checked':'';?> />
<label for="BusinessCategory">Business Category</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="AllSticky" value="108" <?php echo (check_permission($role_id,108,$dbConn)) ? 'checked':'';?> />
<label for="AllSticky">All Sticky Notes</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="My Task" value="109" <?php echo (check_permission($role_id,109,$dbConn)) ? 'checked':'';?> />
<label for="My Task">My Task</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="WaitingTask" value="110" <?php echo (check_permission($role_id,110,$dbConn)) ? 'checked':'';?> />
<label for="WaitingTask">Waiting Task</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="CrossCheck" value="112"<?php echo (check_permission($role_id,112,$dbConn)) ? 'checked':'';?> />
<label for="CrossCheck"> Cross Check</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="CompletedTask" value="113" <?php echo (check_permission($role_id,113,$dbConn)) ? 'checked':'';?> />
<label for="CompletedTask"> Completed Task</label></br>
</div>
</div>



<!-- new -->

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Today_Registered" value="114" <?php echo (check_permission($role_id,114,$dbConn)) ? 'checked':'';?> />
<label for="Today_Registered">Today Registered Users</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="AllUsers" value="115" <?php echo (check_permission($role_id,115,$dbConn)) ? 'checked':'';?> />
<label for="AllUsers">All Users</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ValidEmail" value="116" <?php echo (check_permission($role_id,116,$dbConn)) ? 'checked':'';?> />
<label for="ValidEmail">Valid Email Users</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="ValidPhone" value="117" <?php echo (check_permission($role_id,117,$dbConn)) ? 'checked':'';?> />
<label for="ValidPhone">Valid Phone Users</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="BlockedUsers" value="118" <?php echo (check_permission($role_id,118,$dbConn)) ? 'checked':'';?> />
<label for="BlockedUsers">Blocked Users</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="VerifyAccount" value="119" <?php echo (check_permission($role_id,119,$dbConn)) ? 'checked':'';?> />
<label for="VerifyAccount">Verify Account</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="BuisnessAccounts" value="120" <?php echo (check_permission($role_id,120,$dbConn)) ? 'checked':'';?> />
<label for="BuisnessAccounts">Buisness Accounts</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="DeactivatedUser" value="121" <?php echo (check_permission($role_id,121,$dbConn)) ? 'checked':'';?> />
<label for="DeactivatedUser">Deactivated User</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Module Form Setting</b>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Store</b>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check3" value="122" <?php echo (check_permission($role_id,122,$dbConn)) ? 'checked':'';?> />
<label for="staff_check3"> Industry Type</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check4" value="123" <?php echo (check_permission($role_id,123,$dbConn)) ? 'checked':'';?> />
<label for="staff_check4"> Product Status</label></br>
</div>
</div>
<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check5" value="124" <?php echo (check_permission($role_id,124,$dbConn)) ? 'checked':'';?> />
<label for="staff_check5"> Shipping Destination</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check6" value="125" <?php echo (check_permission($role_id,125,$dbConn)) ? 'checked':'';?> />
<label for="staff_check6"> Freelance </label></br>
</div>
</div>


<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;"> Job Board </b>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="Jstaff_check7" value="126" <?php echo (check_permission($role_id,126,$dbConn)) ? 'checked':'';?> />
<label for="staff_check7"> Job Level</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Real Estate</b>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check1" value="127" <?php echo (check_permission($role_id,127,$dbConn)) ? 'checked':'';?> />
<label for="staff_check1"> Property Type</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check8" value="128" <?php echo (check_permission($role_id,128,$dbConn)) ? 'checked':'';?> />
<label for="staff_check8"> Property Status</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Art Gallery</b>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check9" value="129" <?php echo (check_permission($role_id,129,$dbConn)) ? 'checked':'';?> />
<label for="staff_check9"> Art Sold By</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check10" value="130" <?php echo (check_permission($role_id,130,$dbConn)) ? 'checked':'';?> />
<label for="staff_check10">  Framing Type </label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Timeline</b>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check11" value="131" <?php echo (check_permission($role_id,131,$dbConn)) ? 'checked':'';?> />
<label for="staff_check11"> All Active Posts</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check12" value="132" <?php echo (check_permission($role_id,132,$dbConn)) ? 'checked':'';?> />
<label for="staff_check12"> Freelancer Hired</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check13" value="133" <?php echo (check_permission($role_id,133,$dbConn)) ? 'checked':'';?> />
<label for="staff_check13"> Freelancer payment</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check14" value="134" <?php echo (check_permission($role_id,134,$dbConn)) ? 'checked':'';?> />
<label for="staff_check14"> Freelancer Cancel payment</label></br>
</div>
</div>


<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Store</b>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check15" value="135" <?php echo (check_permission($role_id,135,$dbConn)) ? 'checked':'';?> />
<label for="staff_check15">Retail</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check16" value="136" <?php echo (check_permission($role_id,136,$dbConn)) ? 'checked':'';?> />
<label for="staff_check16">Personal</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check17" value="137" <?php echo (check_permission($role_id,137,$dbConn)) ? 'checked':'';?> />
<label for="staff_check17">Wholesale</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check18" value="138" <?php echo (check_permission($role_id,138,$dbConn)) ? 'checked':'';?> />
<label for="staff_check18">Auction</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check19" value="139" <?php echo (check_permission($role_id,139,$dbConn)) ? 'checked':'';?> />
<label for="staff_check19">RFQ</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Jobs</b>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check20" value="140" <?php echo (check_permission($role_id,140,$dbConn)) ? 'checked':'';?> />
<label for="staff_check20">Job Board</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Real Estate</b>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check21" value="141" <?php echo (check_permission($role_id,141,$dbConn)) ? 'checked':'';?> />
<label for="staff_check21">Real Estate</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check22" value="142" <?php echo (check_permission($role_id,142,$dbConn)) ? 'checked':'';?> />
<label for="staff_check22">Rentals</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Freelancer</b>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check23" value="143" <?php echo (check_permission($role_id,143,$dbConn)) ? 'checked':'';?> />
<label for="staff_check23">Freelancer Project</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check24" value="144" <?php echo (check_permission($role_id,144,$dbConn)) ? 'checked':'';?> />
<label for="staff_check24">Freelancer Bids</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check179" value="179" <?php echo (check_permission($role_id,179,$dbConn)) ? 'checked':'';?> />
<label for="staff_check179">Freelancer Category</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check25" value="145" <?php echo (check_permission($role_id,145,$dbConn)) ? 'checked':'';?> />
<label for="staff_check25">Events</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check26" value="146" <?php echo (check_permission($role_id,146,$dbConn)) ? 'checked':'';?> />
<label for="staff_check26">Art Craft Gallery</label></br>
</div>
</div>


<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Videos</b>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check27" value="147" <?php echo (check_permission($role_id,147,$dbConn)) ? 'checked':'';?> />
<label for="staff_check27">Paid Video</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check28" value="148" <?php echo (check_permission($role_id,148,$dbConn)) ? 'checked':'';?> />
<label for="staff_check28">Free Video</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check29" value="149" <?php echo (check_permission($role_id,149,$dbConn)) ? 'checked':'';?> />
<label for="staff_check29">Trainings</label></br>
</div>
</div>


<!-- new 49 -->

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check30" value="150" <?php echo (check_permission($role_id,150,$dbConn)) ? 'checked':'';?> />
<label for="staff_check30">Classified Ads</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check31" value="151" <?php echo (check_permission($role_id,151,$dbConn)) ? 'checked':'';?> />
<label for="staff_check31">Business For Sale</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check32" value="152" <?php echo (check_permission($role_id,152,$dbConn)) ? 'checked':'';?> />
<label for="staff_check32">Module</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check33" value="153" <?php echo (check_permission($role_id,153,$dbConn)) ? 'checked':'';?> />
<label for="staff_check33">Q&A</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check34" value="154" <?php echo (check_permission($role_id,154,$dbConn)) ? 'checked':'';?> />
<label for="staff_check34">Company News</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check35" value="155" <?php echo (check_permission($role_id,155,$dbConn)) ? 'checked':'';?> />
<label for="staff_check35">All News</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check36" value="156" <?php echo (check_permission($role_id,156,$dbConn)) ? 'checked':'';?> />
<label for="staff_check36">Banned News</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check37" value="157" <?php echo (check_permission($role_id,157,$dbConn)) ? 'checked':'';?> />
<label for="staff_check37">Timeline</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check38" value="158" <?php echo (check_permission($role_id,158,$dbConn)) ? 'checked':'';?> />
<label for="staff_check38">Store</label></br>
</div>
</div>

<!-- <div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Jobs</b>
</div> -->


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check39" value="159" <?php echo (check_permission($role_id,159,$dbConn)) ? 'checked':'';?> />
<label for="staff_check39">RFQ Flag</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check40" value="160" <?php echo (check_permission($role_id,160,$dbConn)) ? 'checked':'';?> />
<label for="staff_check40">Freelance</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check41" value="161" <?php echo (check_permission($role_id,161,$dbConn)) ? 'checked':'';?> />
<label for="staff_check41">Job Board</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check42" value="162" <?php echo (check_permission($role_id,162,$dbConn)) ? 'checked':'';?> />
<label for="staff_check42">Real Estate</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check43" value="163" <?php echo (check_permission($role_id,163,$dbConn)) ? 'checked':'';?> />
<label for="staff_check43">Event</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check44" value="164" <?php echo (check_permission($role_id,164,$dbConn)) ? 'checked':'';?> />
<label for="staff_check44">Group Event</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check45" value="165" <?php echo (check_permission($role_id,165,$dbConn)) ? 'checked':'';?> />
<label for="staff_check45">Art Gallery</label></br>
</div>
</div>


<!-- <div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Videos</b>
</div> -->


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check46" value="166" <?php echo (check_permission($role_id,166,$dbConn)) ? 'checked':'';?> />
<label for="staff_check46">Music</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check47" value="167" <?php echo (check_permission($role_id,167,$dbConn)) ? 'checked':'';?> />
<label for="staff_check47">Videos</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check48" value="168" <?php echo (check_permission($role_id,168,$dbConn)) ? 'checked':'';?> />
<label for="staff_check48">Trainings</label></br>
</div>
</div>


<!-- new 68 -->


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check49" value="169" <?php echo (check_permission($role_id,169,$dbConn)) ? 'checked':'';?> />
<label for="staff_check49">Classified Ads</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check50" value="170" <?php echo (check_permission($role_id,170,$dbConn)) ? 'checked':'';?> />
<label for="staff_check50">Flag User</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check51" value="171" <?php echo (check_permission($role_id,171,$dbConn)) ? 'checked':'';?> />
<label for="staff_check51">Business</label></br>
</div>
</div>


<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Membership</b>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check52" value="172" <?php echo (check_permission($role_id,172,$dbConn)) ? 'checked':'';?> />
<label for="staff_check52"> Add Membership</label></br>
</div>
</div>


<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check53" value="173" <?php echo (check_permission($role_id,173,$dbConn)) ? 'checked':'';?> />
<label for="staff_check53">All Membership</label></br>
</div>
</div>

<div class="col-md-11 col-sm-12">
<b style="font-size: 20px !important;">Commission Level</b>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check185" value="185" <?php echo (check_permission($role_id,185,$dbConn)) ? 'checked':'';?> />
<label for="staff_check185">Close Friend</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check186" value="186" <?php echo (check_permission($role_id,186,$dbConn)) ? 'checked':'';?> />
<label for="staff_check186">Set Commission</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check54" value="174" <?php echo (check_permission($role_id,174,$dbConn)) ? 'checked':'';?> />
<label for="staff_check54">Staff</label></br>
</div>
</div>

<div class="col-md-3 col-sm-4 ">
<div class="form-group">
<input type="checkbox" name="staff_check[]" id="staff_check55" value="175" <?php echo (check_permission($role_id,175,$dbConn)) ? 'checked':'';?> />
<label for="staff_check55">Staff Role</label></br>
</div>
</div>









</div>

</div>

<div class="box-footer"> 
<input type="submit" name="btnButton" value="Update" class="btn vd_btn vd_bg-green finish" /> &nbsp;
<input type="button" value="Back" class="btn vd_btn vd_bg-yellow" onclick="window.location.href='index.php?view=staff'" /> &nbsp;
</div>

</div>
</form>
</div>
</div>
</section><!-- /.content -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script>

$("#checkAll").click(function() {
$('input:checkbox').not(this).prop('checked', this.checked);
});
</script>