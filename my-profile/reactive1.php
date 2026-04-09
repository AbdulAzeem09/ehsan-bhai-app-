<?php
//die('====');
//	error_reporting(E_ALL);
//ini_set('display_errors', '1');

    include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
    $_SESSION['afterlogin']="store/";
    include_once ("../authentication/islogin.php");
 
}else{
    function sp_autoloader($class){
      include '../mlayer/' . $class . '.class.php';
    }
    spl_autoload_register("sp_autoloader");
?>
<!DOCTYPE html>
<html lang="en-US">
    
    <head>
        <?php include('../component/f_links.php');?>
        
        <!-- ===== INPAGE SCRIPTS====== -->
        <?php include('../component/dashboard-link.php'); ?>
        <script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
    </head>

    <body class="bg_gray">
    	<?php
        //this is for store header
        //$header_store = "header_store";
        include_once("../header.php");
        ?>
		 <section class="main_box">
		<?php
		 $p = new _spprofiles;
		$id=$_GET['id'];
        $result = $p->read_reactive($id);
		$row = mysqli_fetch_assoc($result);
		 
        $deleted_profileid=$row['deleted_profileid'];
		$spProfileName=$row['spProfileName'];
		$spProfileEmail=$row['spProfileEmail'];		
		$spProfilePhone=$row['spProfilePhone'];		
		$spProfilePhone=$row['spProfilePhone'];		
		$spProfilePic=$row['spProfilePic'];		
		$banner_image=$row['banner_image'];		
		$alias_name=$row['alias_name'];		
		$spUser_idspUser=$row['spUser_idspUser'];		
		$spProfileType_idspProfileType=$row['spProfileType_idspProfileType'];
		$spProfileAbout=$row['spProfileAbout'];		
		$spProfilesDefault =$row[' spProfilesDefault '];		
		$spMembership_idspMembership=$row['spMembership_idspMembership'];
		$spProfileSubscriptionDate=$row['spProfileSubscriptionDate'];		
		$spProfilesRenewalDate=$row['spProfilesRenewalDate'];
		$spDynamicWholesell=$row['spDynamicWholesell'];
		$spProfilesCity=$row['spProfilesCity'];
		$spProfilesState=$row['spProfilesState'];
		$spProfilesCountry=$row['spProfilesCountry'];
		$spProfilesDob=$row['spProfilesDob'];
		$spProfilesAboutStore=$row['spProfilesAboutStore'];		$spAccountStatus=$row['spAccountStatus'];	
		$spprofilesLanguage=$row['spprofilesLanguage'];
		$spprofilesLocation=$row['spprofilesLocation'];	
		$spprofilesAddress=$row['spprofilesAddress'];
		$spprofilesPublished=$row['spprofilesPublished'];
		$spProfileVerification=$row['spProfileVerification'];
		$spProfileCode=$row['spProfileCode'];
		$is_active=$row['is_active'];
		$spProfilePostalCode=$row['spProfilePostalCode'];		
		$spProfileCntryCode=$row['spProfileCntryCode'];
		$relationship_status=$row['relationship_status'];	
		$phone_status=$row['phone_status'];
		$profile_status=$row['profile_status'];		
		$email_status=$row['email_status'];		
		$address=$row['address'];	
		$chat_status=$row['chat_status'];	
		$spUserzipcode=$row['spUserzipcode'];	
		$latitude=$row['latitude'];
		$longitude=$row['longitude'];	
		$store_name=$row['store_name'];	
		$default_country=$row['default_country'];	
		$default_state=$row['default_state'];		
		$default_city=$row['default_city'];		
		$spdate_created=$row['spdate_created'];		
		$deleted_date=$row['deleted_date'];		
		$data=array(
		              "idspProfiles"=>$deleted_profileid,
					  "spProfileName"=>$spProfileName,
					  "spProfileEmail"=>$spProfileEmail,
					  "spProfilePhone"=>$spProfilePhone,
					  "spProfilePic"=>$spProfilePic,
					  "banner_image"=>$banner_image,
					  "alias_name"=>$alias_name,
					  "spUser_idspUser"=>$spUser_idspUser,
					  "spProfileType_idspProfileType"=>$spProfileType_idspProfileType,
					  "spProfileAbout"=>$spProfileAbout,
					  "spProfilesDefault"=>$spProfilesDefault,
					  "spMembership_idspMembership "=>$spMembership_idspMembership,
					  "spProfileSubscriptionDate"=>$spProfileSubscriptionDate,
					  "spProfilesRenewalDate"=>$spProfilesRenewalDate,
					  "spDynamicWholesell"=>$spDynamicWholesell,
					  "spProfilesCity"=>$spProfilesCity,
					  "spProfilesState"=>$spProfilesState,
					  "spProfilesCountry"=>$spProfilesCountry,
					  "spProfilesDob"=>$spProfilesDob,
					  "spProfilesAboutStore"=>$spProfilesAboutStore,
					  "spAccountStatus"=>$spAccountStatus,
					  "spprofilesLanguage"=>$spprofilesLanguage,
					  "spprofilesLocation"=>$spprofilesLocation,
					  "spprofilesAddress"=>$spprofilesAddress,
					  "spprofilesPublished"=>$spprofilesPublished,
					  "spProfileVerification"=>$spProfileVerification,
					  "spProfileCode"=>$spProfileCode,
					  "is_active"=>$is_active,
					  "spProfilePostalCode"=>$spProfilePostalCode,
					  "spProfileCntryCode"=>$spProfileCntryCode,
					  "relationship_status"=>$relationship_status,
					  "phone_status"=>$phone_status,
					  "profile_status"=>$profile_status,
					  "email_status"=>$email_status,
					  "address"=>$address,
					  "chat_status"=>$chat_status,
					  "spUserzipcode"=>$spUserzipcode,
					  "latitude"=>$latitude,
					  "longitude"=>$longitude,
					  "store_name"=>$store_name,
					  "default_country"=>$default_country,
					  "default_state"=>$default_state,
					  "default_city"=>$default_city,
					  "spdate_created"=>$spdate_created
		);
		$rs=$p->reactive_insert($data);
		$del=$p->reactive_delete($id);
		?>
		<script>
         window.location.replace('<?php echo $BaseUrl;?>/my-profile/deleted_profile.php?msg=insert');
        </script>
       </section>
    	<?php 
       // include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>
    </body>
</html>
<?php
} ?>