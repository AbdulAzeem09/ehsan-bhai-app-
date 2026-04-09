<?php
	if (!defined('WEB_ROOT')) {
		exit;
	}
	$userid=$_SESSION['userId'];

	// print_r ($_SESSION); die('+=======');

	if(isset($_POST["btnButton"])){
		$role_name=$_POST["role_name"];

		$sql="INSERT INTO `staff`(`role_name`) VALUES ('$role_name')";
		$result = dbQuery($dbConn,$sql);
		  $role_id = $dbConn->insert_id; 

 

             $count = count($_POST['staff_check']);

				for($i=0; $i<$count; $i++){
					$permission = $_POST['staff_check'][$i];


					$sql2="INSERT INTO `role_permission`(`userid`, `role_id`, `permission_id`) VALUES ('$userid','$role_id','$permission')";
					$result2 = dbQuery($dbConn,$sql2);

				}
	}
?>

	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>Add Role <small>[Add]</small></h1>  
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
										<label>Add Role</label> <span class="pull-right">
											
										<input type="checkbox" id="checkAll"><label for="checkAll" style="
    margin-left: 3px;" > Check All</label></span></br>
										<input type="text" name="role_name" id="role_name" class="form-control" style="width: 30% !important" >
									</div>
								</div>
								<div class="col-md-3 col-sm-4" >
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Report" value="1" />
									<label for="Report">Report</label></br>
								</div>
								</div> 
								
								<div class="col-md-3 col-sm-4">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="DashBoard" value="2" />
									<label for="DashBoard">DashBoard</label></br>
								</div>
								</div>
								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ProfileType" value="3" />
									<label for="ProfileType">Profile Type</label></br>
								</div>
								</div> 
								
								<div class="col-md-3 col-sm-4">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="SharepageEarning" value="4" />
									<label for="SharepageEarning">Sharepage Earning</label></br>
								</div>
								</div> 
								 
								<div class="col-md-3 col-sm-4">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="CommisionRequest" value="5" />
									<label for="CommisionRequest">Commision Request </label></br>
								</div>
								</div>	
								<div class="col-md-7 col-sm-8 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="SpPointRequest" value="6" />
									<label for="SpPointRequest">SpPoint Request  </label></br>
								</div>
								</div>	

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Wallet</b>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="RealEstate" value="7" />
									<label for="RealEstate"> Real Estate </label></br>
								</div>
								</div>	

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Event" value="8" />
									<label for="Event">Event</label></br>
								</div>
								</div>	

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ArtCraft" value="9" />
									<label for="ArtCraft"> Art and Craft</label></br>
								</div>

								</div>
								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="video" value="10" />
									<label for="video">Video</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="StoreWallet" value="11" />
									<label for="StoreWallet">Store Wallet</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="GroupEvent" value="12" />
									<label for="GroupEvent">Group Event</label></br>
								</div>
								</div>

								
								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="BonusWallet" value="13" />
									<label for="BonusWallet">Bonus Wallet</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="TrainingWallet" value="14" />
									<label for="TrainingWallet">Training Wallet</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Earnings By Modules</b>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ListingModules" value="15" />
									<label for="ListingModules">Listing Of All Modules</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Support Packages</b>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="PackageList" value="16" />
									<label for="PackageList">Package List</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="PurchasePackage" value="17" />
									<label for="PurchasePackage">Purchase Support Package </label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="CustomerEnquiry" value="18" />
									<label for="CustomerEnquiry">Customer Enquiry</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ClosedEnquiry" value="19" />
									<label for="ClosedEnquiry">Closed Enquiry</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="OpenEnquiry" value="20" />
									<label for="OpenEnquiry">Open Enquiry</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Payments</b>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="StorePayment" value="21" />
									<label for="StorePayment">Store Payment</label></br>
								</div>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="RFQPayment" value="22" />
									<label for="RFQPayment">Private RFQ Payment</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="QuotationPayment" value="23" />
									<label for="QuotationPayment">Quotation Payment</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="PaymentRequest" value="24" />
									<label for="Payment Request">Payment Request</label></br>
								</div>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ManageCuerrency" value="25" />
									<label for="ManageCuerrency">Manage Cuerrency</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Setting" value="26" />
									<label for="Setting">Setting</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="PointsView" value="27" />
									<label for="PointsView">Sp Points-View</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="PointsRedeemed" value="28" />
									<label for="PointsRedeemed">Sp Points Redeemed</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="PointsUnused" value="29" />
									<label for="PointsUnused">Sp Points Unused</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="RedeemRequest" value="30" />
									<label for="RedeemRequest">Redeem Request</label></br>
								</div>
								</div>
								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Users Rights" value="31" />
									<label for="UsersRights">Users Rights</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="AssignUsers" value="32" />
									<label for="AssignUsers">Assign Users</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="CreateUsers" value="33" />
									<label for="CreateUsers">Create Users</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="UsersList" value="34" />
									<label for="UsersList">Users List</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check182" value="182" />
									<label for="staff_check182">Users Referral</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check183" value="183" />
									<label for="staff_check183">Deleted Users</label></br>
								</div>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="AddMembership" value="35" />
									<label for="AddMembership">Add Membership Types</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ActiveMemberships" value="36" />
									<label for="ActiveMemberships">Active Memberships</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="MembershipEnquiry" value="37" />
									<label for="MembershipEnquiry">Membership Enquiry</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="MembershipTransaction" value="38" />
									<label for="MembershipTransaction">Membership Transaction</label></br>
								</div>
								</div>


								
								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="MembershipAssign" value="39" />
									<label for="MembershipAssign">Membership Assign</label></br>
								</div>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="FreeMembership" value="40" />
									<label for="FreeMembership">Free Membership Users</label></br>
								</div>
								</div>
								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="FreeMembership1" value="410" />
									<label for="FreeMembership1">Expired Membership Users</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ProfileType" value="41" />
									<label for="ProfileType">Profile Type</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="NotificationTemplate " value="42" />
									<label for="NotificationTemplate ">Notification Template</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="SharepageModules" value="43" />
									<label for="SharepageModules">Sharepage Modules</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ContactTopic" value="44" />
									<label for="ContactTopic">Contact Topic Issues</label></br>
								</div>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Aws" value="45" />
									<label for="Aws">Aws S-3</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Packages" value="46" />
									<label for="Packages">Packages</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Listings" value="47" />
									<label for="Packages">Listings </label></br>
								</div>
								</div>
							
								<!-- new Subscriber  -->

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Subscriber" value="48" />
									<label for="Subscriber">Subscriber</label></br>
								</div>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Countries" value="49" />
									<label for="Countries">Countries</label></br>
								</div>
								</div>


								
								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="StateProvince" value="50" />
									<label for="StateProvince">State/Province</label></br>
								</div>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Cities" value="51" />
									<label for="Cities">Cities</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="AllGroups" value="52" />
									<label for="AllGroups"> All Groups</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="BannedGroups" value="53" />
									<label for="BannedGroups">Banned Groups</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="GroupsCategory" value="54" />
									<label for="GroupsCategory">Groups Category</label></br>
								</div>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Category" value="55" />
									<label for="Category ">Category</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Setting1" value="56" />
									<label for="Setting1">Setting</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="CommissionRate" value="57" />
									<label for="CommissionRate">Commission Rate</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Commission List</b>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="TodayRegistered" value="58" />
									<label for="TodayRegistered">Today Registered Users</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Friend Commission</b>
								</div>

								<!-- new -->


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="SuperFriends" value="59" />
									<label for="SuperFriends">Super VIP Friends</label></br>
								</div>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="VIPFriends" value="60" />
									<label for="VIPFriends">VIP Friends </label></br>
								</div>
								</div>


								
								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="SuperCommission" value="61" />
									<label for="SuperCommission">Super VIP Commission</label></br>
								</div>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="VIPCommission " value="62" />
									<label for="VIPCommission ">VIP Commission </label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="GeneralCommission" value="63" />
									<label for="GeneralCommission">General Commission</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="SaleCommission" value="64" />
									<label for="SaleCommission">Sale Commission</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ContactMassages" value="65" />
									<label for="ContactMassages">Contact Massages</label></br>
								</div>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="SocialMedia" value="66" />
									<label for="SocialMedia">Social Media Links</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="PostingContent" value="67" />
									<label for="PostingContent">Posting Content</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ProfileContent" value="68" />
									<label for="ProfileContent">Profile Content</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="UploadBanner" value="69" />
									<label for="UploadBanner">Upload Store Banner</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Job Board</b>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="HireEmployee" value="70" />
									<label for="HireEmployee">Hire An Employee</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="LookingJob" value="71" />
									<label for="LookingJob">Looking For A Job</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="LeftContent" value="72" />
									<label for="LeftContent">Left Content</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Footer Content</b>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="HeadingColum" value="73" />
									<label for="HeadingColum">Footer Heading Colum</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="FooterPages" value="74" />
									<label for="FooterPages">Footer Pages</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="SharepageBlogs" value="75" />
									<label for="SharepageBlogs">Sharepage Blogs</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Contacts</b>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ContactIssue" value="76" />
									<label for="ContactIssue">Contact Topic Issue</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ReceivedReplies" value="77" />
									<label for="ReceivedReplies">Received Message And Replies</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="SocialMedia2" value="78" />
									<label for="SocialMedia2">Social Media</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Homepage Content</b>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="EmailMarketing" value="79" />
									<label for="EmailMarketing">Email Marketing</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="SMSMarketing" value="80" />
									<label for="SMSMarketing">SMS Marketing</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Feature" value="81" />
									<label for="Feature">Feature</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="EmailUsers" value="82" />
									<label for="EmailUsers">Email to Users</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Bookings</b>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="GroupBooked" value="83" />
									<label for="GroupBooked">Group Event Booked</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="EventBooked" value="84" />
									<label for="EventBooked">Event Booked</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Email Template</b>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="EmailTemplate" value="85" />
									<label for="EmailTemplate">Email Template</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="AddMedia" value="86" />
									<label for="AddMedia">Add Media</label></br>
								</div>
								</div>

								<!-- new -->



								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ChannelRequest" value="87" />
									<label for="ChannelRequest">Channel Request</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Aboutus2" value="178" />
									<label for="Aboutus2">Approved/Rejected Courses</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Aboutus" value="88" />
									<label for="Aboutus">About Us</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Announcement" value="89" />
									<label for="Announcement">Announcement</label></br>
								</div>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Worldnews" value="90" />
									<label for="Worldnews">World News</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="PendingApproval" value="91" />
									<label for="PendingApproval">Pending Approval</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="RejectedCourses" value="92" />
									<label for="RejectedCourses">Rejected Courses</label></br>
								</div>
								</div>

								
								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ApprovedCourses" value="93" />
									<label for="ApprovedCourses">Approved Courses</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Courses22" value="94" />
									<label for="Courses22">Courses</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Art Gallery [Category]</b>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ArtGallery" value="95" />
									<label for="ArtGallery">Art Gallery [Subcategory]</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ArtSizes" value="96" />
									<label for="ArtSizes">Art Gallery [Sizes]</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Craft Gallery [Category]</b>
								</div>
								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ArtSizes22" value="97" />
									<label for="ArtSizes22">Craft Gallery [Subategory]</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ClassifiedCategory" value="98" />
									<label for="ClassifiedCategory"> Classified Ads Category</label></br>
								</div>
								</div>

	
								<!-- new -->

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="EventCategory" value="99" />
									<label for="EventCategory">Event Category</label></br>
								</div>
								</div>

							
								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="EventGroups" value="100" />
									<label for="EventGroups">Event Groups</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="MusicCategory" value="101" />
									<label for="MusicCategory">Music Category</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="GroupCategory" value="102" />
									<label for="GroupCategory">Group Category</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Project_Type" value="103" />
									<label for="Project_Type">Freelance - Project Type</label></br>
								</div>
								</div>

							
								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Modules" value="104" />
									<label for="Modules">Modules</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;"> All Category</b>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="SubCategory" value="105" />
									<label for="SubCategory"> Inner Sub Category</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="AdsCategory" value="106" />
									<label for="AdsCategory"> Classified Ads Category</label></br>
								</div>
								</div>




								<!-- new -->

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="BusinessCategory" value="107" />
									<label for="BusinessCategory">Business Category</label></br>
								</div>
								</div>

							
								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="AllSticky" value="108" />
									<label for="AllSticky">All Sticky Notes</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="My Task" value="109" />
									<label for="My Task">My Task</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="WaitingTask" value="110" />
									<label for="WaitingTask">Waiting Task</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="CrossCheck" value="112" />
									<label for="CrossCheck"> Cross Check</label></br>
								</div>
								</div>

							
								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="CompletedTask" value="113" />
									<label for="CompletedTask"> Completed Task</label></br>
								</div>
								</div>



							<!-- new -->

							<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Today_Registered" value="114" />
									<label for="Today_Registered">Today Registered Users</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="AllUsers" value="115" />
									<label for="AllUsers">All Users</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ValidEmail" value="116" />
									<label for="ValidEmail">Valid Email Users</label></br>
								</div>
								</div>

							
								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="ValidPhone" value="117" />
									<label for="ValidPhone">Valid Phone Users</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="BlockedUsers" value="118" />
									<label for="BlockedUsers">Blocked Users</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="VerifyAccount" value="119" />
									<label for="VerifyAccount">Verify Account</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="BuisnessAccounts" value="120" />
									<label for="BuisnessAccounts">Buisness Accounts</label></br>
								</div>
								</div>

							
								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="DeactivatedUser" value="121" />
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
									<input type="checkbox" name="staff_check[]" id="staff_check3" value="122" />
									<label for="staff_check3"> Industry Type</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check4" value="123" />
									<label for="staff_check4"> Product Status</label></br>
								</div>
								</div>
								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check5" value="124" />
									<label for="staff_check5"> Shipping Destination</label></br>
								</div>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check6" value="125" />
									<label for="staff_check6"> Freelance </label></br>
								</div>
								</div>

								
								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;"> Job Board </b>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="Jstaff_check7" value="126" />
									<label for="staff_check7"> Job Level</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Real Estate</b>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check1" value="127" />
									<label for="staff_check1"> Property Type</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check8" value="128" />
									<label for="staff_check8"> Property Status</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Art Gallery</b>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check9" value="129" />
									<label for="staff_check9"> Art Sold By</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check10" value="130" />
									<label for="staff_check10">  Framing Type </label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Timeline</b>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check11" value="131" />
									<label for="staff_check11"> All Active Posts</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check12" value="132" />
									<label for="staff_check12"> Freelancer Hired</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check13" value="133" />
									<label for="staff_check13"> Freelancer payment</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check14" value="134" />
									<label for="staff_check14"> Freelancer Cancel payment</label></br>
								</div>
								</div>


								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Store</b>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check15" value="135" />
									<label for="staff_check15">Retail</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check16" value="136" />
									<label for="staff_check16">Personal</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check17" value="137" />
									<label for="staff_check17">Wholesale</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check18" value="138" />
									<label for="staff_check18">Auction</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check19" value="139" />
									<label for="staff_check19">RFQ</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Jobs</b>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check20" value="140" />
									<label for="staff_check20">Job Board</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Real Estate</b>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check21" value="141" />
									<label for="staff_check21">Real Estate</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check22" value="142" />
									<label for="staff_check22">Rentals</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Freelancer</b>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check23" value="143" />
									<label for="staff_check23">Freelancer Project</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check24" value="144" />
									<label for="staff_check24">Freelancer Bids</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check179" value="179" />
									<label for="staff_check179">Freelancer Category</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check25" value="145" />
									<label for="staff_check25">Events</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check26" value="146" />
									<label for="staff_check26">Art Craft Gallery</label></br>
								</div>
								</div>


								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Videos</b>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check27" value="147" />
									<label for="staff_check27">Paid Video</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check28" value="148" />
									<label for="staff_check28">Free Video</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check29" value="149" />
									<label for="staff_check29">Trainings</label></br>
								</div>
								</div>


								<!-- new 49 -->

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check30" value="150" />
									<label for="staff_check30">Classified Ads</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check31" value="151" />
									<label for="staff_check31">Business For Sale</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check32" value="152" />
									<label for="staff_check32">Module</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check33" value="153" />
									<label for="staff_check33">Q&A</label></br>
								</div>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check34" value="154" />
									<label for="staff_check34">Company News</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check35" value="155" />
									<label for="staff_check35">All News</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check36" value="156" />
									<label for="staff_check36">Banned News</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check37" value="157" />
									<label for="staff_check37">Timeline</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check38" value="158" />
									<label for="staff_check38">Store</label></br>
								</div>
								</div>

								<!-- <div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Jobs</b>
								</div> -->


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check39" value="159" />
									<label for="staff_check39">RFQ Flag</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check40" value="160" />
									<label for="staff_check40">Freelance</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check41" value="161" />
									<label for="staff_check41">Job Board</label></br>
								</div>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check42" value="162" />
									<label for="staff_check42">Real Estate</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check43" value="163" />
									<label for="staff_check43">Event</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check44" value="164" />
									<label for="staff_check44">Group Event</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check45" value="165" />
									<label for="staff_check45">Art Gallery</label></br>
								</div>
								</div>


								<!-- <div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Videos</b>
								</div> -->


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check46" value="166" />
									<label for="staff_check46">Music</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check47" value="167" />
									<label for="staff_check47">Videos</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check48" value="168" />
									<label for="staff_check48">Trainings</label></br>
								</div>
								</div>


								<!-- new 68 -->


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check49" value="169" />
									<label for="staff_check49">Classified Ads</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check50" value="170" />
									<label for="staff_check50">Flag User</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check51" value="171" />
									<label for="staff_check51">Business</label></br>
								</div>
								</div>


								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Membership</b>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check52" value="172" />
									<label for="staff_check52"> Add Membership</label></br>
								</div>
								</div>


								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check53" value="173" />
									<label for="staff_check53">All Membership</label></br>
								</div>
								</div>

								<div class="col-md-11 col-sm-12">
								<b style="font-size: 20px !important;">Commission Level</b>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check185" value="185" />
									<label for="staff_check185">Close Friend</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check186" value="186" />
									<label for="staff_check186">Set Commission</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check54" value="174" />
									<label for="staff_check54">Staff</label></br>
								</div>
								</div>

								<div class="col-md-3 col-sm-4 ">
								<div class="form-group">
									<input type="checkbox" name="staff_check[]" id="staff_check55" value="175" />
									<label for="staff_check55">Staff Role</label></br>
								</div>
								</div>









							</div>
						</div>
						
						<div class="box-footer"> 
	                        <input type="submit" name="btnButton" value="Save" class="btn vd_btn vd_bg-green finish" /> &nbsp;
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
		