<?php
	session_start();
	if(!isset($_SESSION['pid']))
	{	
		include_once ("../authentication/check.php");
		$_SESSION['afterlogin']="my-profile/";
	}

	function sp_autoloader($class){
	include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");


    $p = new _spprofiles;

	if(isset($_POST['pid'])){
		$result  = $p->read($_POST["pid"]);
		if($result != false)
		{
			$row = mysqli_fetch_assoc($result);
			$name = $row["spProfileName"];
			$email = $row["spProfileEmail"];
			$phone = $row["spProfileCntryCode"].$row["spProfilePhone"];
			$usercountry = $row["spProfilesCountry"];
			$userstate = $row['spProfilesState'];
			$usercity = $row["spProfilesCity"];
			$dob = $row['spProfilesDob'];
			$about = $row["spProfileAbout"];
			$picture = $row["spProfilePic"];
			$location = $row["spprofilesLocation"];
			$language = $row["spprofilesLanguage"];
			$address = $row["spprofilesAddress"];
			$postalCode = $row['spProfilePostalCode'];
			$relationship_status = $row['relationship_status'];
			$phone_status = $row['phone_status'];
			$profile_status=$row['profile_status'];
			$email_status = $row['email_status'];
			$address_city = $row["address"];
			$spProfile_storename = $row["store_name"];
			
		}
	}

	$u = new _spuser;
	$spuserres = $u->read($_SESSION["uid"]);
	
	if($spuserres != false)
	{
      	$ruser = mysqli_fetch_assoc($spuserres);
		$username = $ruser["spUserName"]; 
		$userpnone = $ruser["spUserCountryCode"].$ruser["spUserPhone"]; 
		$useremail = $ruser["spUserEmail"]; 
		$useraddress = $ruser["spUserAddress"];
		$phone_status = $row['phone_status'];
	    $email_status = $row['email_status'];
		
		if (is_null($usercountry) || empty($usercountry)) {
			$usercountry = $ruser["spUserCountry"];
		}
		if (is_null($userstate) || empty($userstate)) {
			$userstate = $ruser["spUserState"];
		}
		if (is_null($usercity) || empty($usercity)) {
			$usercity = $ruser["spUserCity"];
		}
		if (is_null($address_city) || empty($address_city)) {
			$address_city = $ruser["address"];
		}
	}

	//$pf = new _profilefield;
	$pf = new _spbusiness_profile;

	if(isset($_POST['pid'])){
		$res = $pf->read($_POST["pid"]);
		//echo $pf->ta->sql;
		if($res != false){

            $spprofileid  = "";

			$busCat 	= "";
            //$busSubCat 	= "";
            $cmpName 	= "";
            $opeHour 	= "";
            $contactDetail 	= "";
            $cmpyAdd 		= "";
            $cmpyPhoneNo 	= "";
            $cmpyTagline 	= "";
            $cmpySize 		= "";
            $yearFounded 	= "";
            $cmpyRevenue 	= "";
            $cmpywebsite 	= "";
            $Ownersship 	= "";
            $stocklink 		= "";
            $cmpnyBenfit 	= "";
            $cmpnyDesc 		= "";
            $skill 			= "";
            $cmpnyEmail 	= "";
            $cmpnyExt 		= "";
            $cmpnyProSer 	= "";
            $about = "";
            $cmpnyLng		= "";
            $cmpnyStockSymb = "";
            $storename      = "";
            $aboutstore     = "";
            $spProfilerefund = "";
            $spshippingtext = "";
            $aboutpolicy   = "";
            $business_city = "";

           

			while($result = mysqli_fetch_assoc($res)){
				
				//$row[$result["spProfileFieldLabel"]] = $result["spProfileFieldValue"];

				//print_r($result['spprofiles_idspProfiles']);
				if ($business_city == '') {
                	$business_city = $result['business_city'];
                }
                
                if ($spprofileid == '') {
                	$spprofileid = $result['spprofiles_idspProfiles'];
                }

				if($cmpnyStockSymb == ''){
                    /*if($result['spProfileFieldName'] == 'stockSymbol_'){*/
                        $cmpnyStockSymb = $result['stockSymbol']; 
                    /*}*/
                }
				if($cmpnyLng == ''){
                    /*if($result['spProfileFieldName'] == 'languageSpoken_'){*/
                        $cmpnyLng = $result['languageSpoken']; 
                    /*}*/
                }
				if($cmpnyProSer == ''){
                   /* if($result['spProfileFieldName'] == 'companyProductService_'){*/
                        $cmpnyProSer = $result['companyProductService']; 
                    /*}*/
                }if($about == ''){
                   /* if($result['spProfileFieldName'] == 'companyProductService_'){*/
                        $about = $result['BussinessOverview']; 
                    /*}*/
                }
				$businesscategory = $result['businesscategory']; 

                
				if($cmpnyExt == ''){
                    /*if($result['spProfileFieldName'] == 'companyExtNo_'){*/
                        $cmpnyExt = $result['companyExtNo']; 
                    /*}*/
                }
				if($cmpnyEmail == ''){
                    /*if($result['spProfileFieldName'] == 'companyEmail_'){*/
                        $cmpnyEmail = $result['companyEmail']; 
                   /* }*/
                }
				if($skill == ''){
                   /* if($result['spProfileFieldName'] == 'skill_'){*/
                        $skill = $result['skill']; 
                    /*}*/
                }
				if($cmpnyDesc == ''){
                    /*if($result['spProfileFieldName'] == 'CompanyOverview_'){*/
                        $cmpnyDesc = $result['CompanyOverview']; 
                    /*}*/
                }
				/*if($cmpnyBenfit == ''){
                    if($result['spProfileFieldName'] == 'cmpnyBenefits_'){
                        $cmpnyBenfit = $result['spProfileFieldValue']; 
                    }
                }*/
				if($stocklink == ''){
                    /*if($result['spProfileFieldName'] == 'cmpnyStockLink_'){*/
                        $stocklink = $result['cmpnyStockLink']; 
                    /*}*/
                }
				if($Ownersship == ''){
                   /* if($result['spProfileFieldName'] == 'CompanyOwnership_'){*/
                        $Ownersship = $result['CompanyOwnership']; 
                    /*}*/
                }
				if($cmpywebsite == ''){
                    /*if($result['spProfileFieldName'] == 'CompanyWebsite_'){*/
                        $cmpywebsite = $result['CompanyWebsite']; 
                    /*}*/
                }
				if($cmpyRevenue == ''){
                   /* if($result['spProfileFieldName'] == 'cmpyRevenue_'){*/
                        $cmpyRevenue = $result['cmpyRevenue']; 
                    /*}*/
                }
				if($yearFounded == ''){
                    /*if($result['spProfileFieldName'] == 'yearFounded_'){*/
                        $yearFounded = $result['yearFounded']; 
                    /*}*/
                }
				if($cmpySize == ''){
                   /* if($result['spProfileFieldName'] == 'CompanySize_'){*/
                        $cmpySize = $result['CompanySize']; 
                    /*}*/
                }
				if($cmpyTagline == ''){
                    /*if($result['spProfileFieldName'] == 'companytagline_'){*/
                        $cmpyTagline = $result['companytagline']; 
                    /*}*/
                }
				if($cmpyPhoneNo == ''){
                    /*if($result['spProfileFieldName'] == 'companyPhoneNo_'){*/
                        $cmpyPhoneNo = $result['companyPhoneNo']; 
                    /*}*/
                }
				if($busCat == ''){
                   /* if($result['spProfileFieldName'] == 'businesscategory_'){*/
                        $busCat = $result['businesscategory']; 
                    /*}*/
                }
                
                if($cmpName == ''){
                    /*if($result['spProfileFieldName'] == 'companyname_'){*/
                        $cmpName = $result['companyname']; 
                    /*}*/
                }
                if($opeHour == ''){
                    /*if($result['spProfileFieldName'] == 'operatinghours_'){*/
                        $opeHour = $result['operatinghours']; 
                    /*}*/
                }
                if($contactDetail == ''){
                    /*if($result['spProfileFieldName'] == 'contactdetails_'){*/
                        $contactDetail = $result['contactdetails']; 
                    /*}*/
                }
                if($cmpyAdd == ''){
                   /* if($result['spProfileFieldName'] == 'companyaddress_'){*/
                        $cmpyAdd = $result['companyaddress']; 
                    /*}*/
                }
                if (isset($spProfile_storename) && !is_null($spProfile_storename) && !empty($spProfile_storename)) {
                	 $storename = $spProfile_storename; 
                }
                if ($aboutstore == '') {
                	 $aboutstore = $result['spProfilesAboutStore']; 
                }
                if ($spProfilerefund == '') {
                	 $spProfilerefund = $result['spProfilerefund']; 
                }
                if ($spshippingtext == '') {
                	 $spshippingtext = $result['spshippingtext']; 
                }
                if ($aboutpolicy == '') {
                	 $aboutpolicy = $result['spProfilepolicy']; 
                }
                 
            



			}
		}
	}

?>


<!-- <?php 
	$p = new _spprofiles;
	if(isset($_POST['pid'])){
		$result  = $p->profilestore($_POST["pid"]);
		if($result != false)
		{
			$row = mysqli_fetch_assoc($result);
			$storename = $row["spDynamicWholesell"];
		}
	}
	
	//print_r($_SESSION);
	//die('==');
?> -->
<style>
@media only screen and (max-width: 700px) {
    .mdc14 {
        margin-left: 0px !important;
    }

    .div1 {
        margin-left: 0px !important;
    }
}
</style>


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<!-- Select2 CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

<div class="row">
    <div class="col-md-12">
        <input type="hidden" id="ptid_b" value="<?php echo $_SESSION['ptid'];?>">


        <input type="hidden" class="form-control profilefield" id="spprofiles_idspProfiles"
            name="spprofiles_idspProfiles" value="<?php echo (isset($spprofileid))?$spprofileid: ''; ?>">


        <div class="form-group">
            <label for="companyname_" class="control-label">Business Name<span class="red">* <span
                        class="lbl_8"></span></span></label>

            <input type="text" class="form-control profilefield" id="companyname_" name="companyname" maxlength="50"
                value="<?php echo $cmpName; ?>">
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="companytagline_" class="control-label">Company Tagline<span class="red">* <span
                        class="lbl_13"></span></span></label>
            <textarea class="form-control profilefield" id="companytagline_" name="companytagline"
                required><?php echo (isset($cmpyTagline))?$cmpyTagline: ''; ?></textarea>
        </div>
    </div>


    <div class="col-md-6">
        <div class="form-group">
            <label for="skill_">Company Specialties<span class="red"> <span class="lbl_9"></span></span></label>
            <input type="text" class="form-control profilefield" id="skill_" name="skill"
                value="<?php echo (isset($skill) ? $skill : ''); ?>" required>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label for="companyEmail_" class="control-label">Company Email<span class="red"> <span
                        class="lbl_10"></span></span></label>
            <input type="email" class="form-control profilefield" id="companyEmail_" name="companyEmail"
                value="<?php echo (isset($cmpnyEmail))?$cmpnyEmail:''; ?>">
        </div>
    </div>
    <!-- <div class="col-md-1">
		<div class="form-group">
<label for="companyExtNo_" class="control-label"></label> -->
    <!-- <select class="form-control profilefield" name="companyExtNo" id="companyExtNo_" style="width: 171% !important; padding: 6px 0px !important;"> -->
    <!-- <input type="text" class="form-control Checkphone" onkeyup="Checkphone(this.value)" id="respUserEphone" name="spUserPhone" placeholder="895-965-7865" value=""> 
		</div>
	</div>-->
    <div class="col-md-6">
        <div class="form-group">
            <label for="companyPhoneNo_" class="control-label mdc14">Company Phone<span class="red">* <span
                        class="lbl_11"></span></span></label>

            <input type="hidden" class="form-control" id="companyExtNo" name="companyExtNo" value="" />


            <input type="text" class="form-control Checkphone profilefield" onkeyup="Checkphone(this.value)"
                id="companyPhoneNo_" name="companyPhoneNo" placeholder="Company Phone"
                value="<?php echo (isset($cmpyPhoneNo))?$cmpnyExt.$cmpyPhoneNo: ''; ?>" required />

            <!-- <input type="text" class="form-control profilefield" id="companyPhoneNo_"   maxlength="20" name="companyPhoneNo" value="<?php echo (isset($cmpyPhoneNo))?$cmpyPhoneNo: ''; ?>" required />  -->
        </div>
    </div>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> -->


    <div class="col-md-6">
        <?php //print_r($businesscategory); die('kkkkkkkkkkkkkkkk'); 
		$explodedArray = explode(",", $businesscategory);
		
		?>
        <div class="form-group">
            <label for="businesscategory_" class="control-label">Business Category<span class="red">* <span
                        class="lbl_12"></span></span></label>
            <select class="form-control profilefield multiple" id="businesscategory_" data-filter="1"
                name="businesscategory[]"
                value="<?php echo (empty($row["Business Category"]) ? "" : $row["Business Category"]);?>" required
                multiple>

                <option value="">Select Category</option>
                <?php
				//print_r($explodedArray); die(' kkkkkkkkkkkkkk');
					//echo "<option value='' disabled selected>".$row["Business Category"]."</option>";
					$m = new _masterdetails;
					$masterid = 8;
					$result = $m->read($masterid);
					if($result != false){
						while($rows = mysqli_fetch_assoc($result)){ ?>
                <option value='<?php echo $rows["idmasterDetails"]; ?>' <?php
						if(isset($explodedArray) && in_array($rows["idmasterDetails"], $explodedArray) ) {echo "selected";}
				
					?>>
                    <?php echo ucfirst(strtolower($rows["masterDetails"]));?>

                </option><?php
						}
					}
				?>
            </select>
        </div>
    </div>


    <div class="col-md-12">
        <div class="form-group">
            <label for="companyProductService_" class="control-label">Product and Services<span class="red">* <span
                        class="lbl_14"></span></span></label>
            <textarea class="form-control profilefield" id="companyProductService_" name="companyProductService"
                required><?php echo (isset($cmpnyProSer))?$cmpnyProSer:''; ?></textarea>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="spProfileAbout" class="control-label" id="lblAbout">Business Overview<span class="red">* <span
                        class="lbl_15"></span></span></label>
            <textarea class="form-control" rows="3" id="spProfileAbout" name="BussinessOverview"
                required><?php echo (isset($about))?$about:''; ?></textarea>
        </div>
    </div>
    <!-- <div class="col-md-12">
		<div class="form-group">
			<label for="languageSpoken_" class="control-label">Language Fluency</label>
			<textarea class="form-control profilefield" id="languageSpoken_" name="languageSpoken"><?php echo (isset($cmpnyLng))?$cmpnyLng:'';?></textarea>
		</div>
	</div> -->
    <div class="col-md-12">
        <div class="bg_gray addInfoPro">
            <h3>Additional Information</h3>
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="CompanySize_">Company Size</label>
                        <select class="form-control profilefield" id="CompanySize_" data-filter="1" name="CompanySize">
                            <option value="" selected>Select Category</option>
                            <option value="1 - 49 Employee"
                                <?php if(isset($cmpySize)){if($cmpySize == "1 - 49 Employee"){echo "selected";}}?>>1 -
                                49 Employee</option>
                            <option value="50 - 149 Employee"
                                <?php if(isset($cmpySize)){if($cmpySize == "50 - 149 Employee"){echo "selected";}}?>>50
                                - 149 Employee</option>
                            <option value="150 - 249 Employee"
                                <?php if(isset($cmpySize)){if($cmpySize == "150 - 249 Employee"){echo "selected";}}?>>
                                150 - 249 Employee</option>
                            <option value="250 - 499 Employee"
                                <?php if(isset($cmpySize)){if($cmpySize == "250 - 499 Employee"){echo "selected";}}?>>
                                250 - 499 Employee</option>
                            <option value="500 - 749 Employee"
                                <?php if(isset($cmpySize)){if($cmpySize == "500 - 749 Employee"){echo "selected";}}?>>
                                500 - 749 Employee</option>
                            <option value="750 - 999 Employee"
                                <?php if(isset($cmpySize)){if($cmpySize == "750 - 999 Employee"){echo "selected";}}?>>
                                750 - 999 Employee</option>
                            <option value="1000+ Employee"
                                <?php if(isset($cmpySize)){if($cmpySize == "1000+ Employee"){echo "selected";}}?>>1000+
                                Employee</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cmpyRevenue_" class="control-label">Company Revenue</label>
                        <input type="text" class="form-control profilefield" id="cmpyRevenue_" name="cmpyRevenue"
                            value="<?php echo (isset($cmpyRevenue))?$cmpyRevenue: ''; ?>" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="yearFounded_" class="control-label">Year Founded</label>
                        <input type="text" class="form-control profilefield" maxlength="4" id="yearFounded_"
                            name="yearFounded" onkeypress="return onlyNumberKey(event)" maxlength="4"
                            value="<?php echo (isset($yearFounded))?$yearFounded: ''; ?>" />
                    </div>
                </div>
                <!-- <div class="col-md-4">
					<div class="form-group">
						<label for="CompanyOwnership_">Ownership</label>
						<select class="form-control profilefield" id="CompanyOwnership_" data-filter="1" name="CompanyOwnership" >
						    <option value="" selected>Select Category</option>
							<option value="Public" <?php if(isset($Ownersship)){if($Ownersship == "Public"){echo "selected";}}?> >Public</option>
							<option value="Private" <?php if(isset($Ownersship)){if($Ownersship == "Private"){echo "selected";}}?> >Private</option>
						</select>
					</div>
				</div> -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="CompanyWebsite_">Company Website</label>
                        <input type="text" class="form-control profilefield" id="CompanyWebsite_" name="CompanyWebsite"
                            value="<?php echo (isset($cmpywebsite))?$cmpywebsite: ''; ?>" />
                    </div>
                </div>
                <!-- <div class="col-md-4">
					<div class="form-group">
						<label for="operatinghours_" class="control-label">Operating Days/Hours</label>
						<input type="text" class="form-control profilefield" id="operatinghours_" name="operatinghours" value="<?php echo (isset($opeHour))?$opeHour: ''; ?>"> 
					</div>
				</div> -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="stockSymbol_" class="control-label">Stock Symbol</label>
                        <input type="text" class="form-control profilefield" id="stockSymbol_" name="stockSymbol"
                            value="<?php echo (isset($cmpnyStockSymb))?$cmpnyStockSymb:'';?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="cmpnyStockLink_" class="control-label">Stock Weblink</label>
                        <input type="text" class="form-control profilefield" id="cmpnyStockLink_" name="cmpnyStockLink"
                            value="<?php echo (isset($stocklink))?$stocklink: ''; ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="storeName" class="control-label">Store Name</label>
                        <input type="text" class="form-control profilefield"
                            id="<?php echo (isset($storename)? "":"storeName_business");?>" name="spDynamicWholesell"
                            value="<?php if(isset($storename)){ echo $storename;}?>" required>
                    </div>
                    <p class="hidden" id="checkstore">This storename is taken. Try another.</p>
                </div>
                <!--<div class="col-md-4">
    <div class="form-group">
	    <label for="spPostingCountry" class="lbl_2">Country</label>
      <select class="form-control " name="spPostingsCountry" id="spPostingsCount">
      <option value="">Select Country</option>
      <?php
        $co = new _country;
        $result3 = $co->readCountry();
        if($result3 != false){
          while ($row3 = mysqli_fetch_assoc($result3)) {
      ?>
      <option value='<?php echo $row3['country_id'];?>' <?php echo (isset($usercountry) && $usercountry == $row3['country_id'])?'selected':''; ?>>
      <?php echo $row3['country_title'];?>
      </option>
      <?php
        }
      }
      ?>	
      </select>
    </div>
  </div> -->
            </div>
        </div>
    </div>
    <div class="col-md-12" style="display: none;">
        <div class="form-group">
            <label for="companyaddress_" class="control-label">Company Address<span class="red">* <span
                        class="lbl_16"></span></span></label>
            <input type="hidden" name="relationship_status" value="<?php echo $row['relationship_status']; ?>">
            <textarea class="form-control profilefield" id="companyaddress_"
                name="companyaddress">sdsd<?php echo (isset($cmpyAdd))?$cmpyAdd: ''; ?></textarea>
        </div>
    </div>

    <!--user data start-->
    <div class="col-md-12">
        <div class=" panel-primary">
            <div>
                <div class="row">
                    <div class="col-md-12">
                        <?php
						/*if($_POST["ptid"] == 1){*/
							echo "<ul class='nav nav-tabs' id='navtabprofile'>
							<li class='active' role='presentation'><a href='#aboutstore'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>About Business</a></li>
							
							<li  role='presentation'><a href='#aboutshipping'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>Shipping Destination </a></li>
							
							<li  role='presentation'><a href='#aboutreturn'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>Returns and Refunds</a></li>

							<li  role='presentation'><a href='#Policy'  aria-controls='sp-activePost' role='tab' data-toggle='tab'>Policy</a></li>
							</ul>";
						/*}*/
					?>
                    </div>
                </div>


                <!--Testing-->
                <!-- <div class="tab-content <?php echo ($_POST["ptid"] == 1 ? '""' : "hidden"); ?>" style="margin-left:10px; margin-right:20px;"> -->
                <div class="tab-content ">
                    <div role="tabpanel" class="tab-pane active  store" id="aboutstore">

                        <!--<form action="aboutstore.php" method="post" class="profileform" >-->
                        <input type="hidden" name="spProfileid_" value=<?php echo $_POST["pid"];?>>
                        <!--<div class="form-group">-->
                        <br>
                        <!-- <label for="aboutstore">About Business</label> -->

                        <textarea class="form-control profilefield" id="aboutstore" name="spProfilesAboutStore"
                            rows="4"><?php echo (isset($aboutstore))?$aboutstore:'';?></textarea>



                        <!--</div>-->
                        <!-- <button type="submit" class="btn btn-success">Submit</button> -->
                        <!--	</form> -->
                    </div>

                    <div role="tabpanel" class="tab-pane store" id="aboutshipping">


                        <!-- <form action="addshipping.php" method="post" class="profileform" > -->
                        <input type="hidden" name="spProfiles_idspProfiles" value=<?php echo $_POST["pid"];?>>
                        <!-- <div class="row"> -->

                        <br>
                        <label for="aboutstore">Shipping Destination</label>
                        <textarea class="form-control profilefield" id="aboutstore" name="spshippingtext"
                            rows="4"><?php echo (isset($spshippingtext))?$spshippingtext:'';?></textarea>


                    </div>


                    <div role="tabpanel" class="tab-pane returnrefund" id="aboutreturn">



                        <br>

                        <label for="aboutstore">Returns and Refunds</label>
                        <!-- 	<form action="addreturnrefund.php" method="post" class="profileform" > -->
                        <input type="hidden" name="spProfiles_idspProfiles" value=<?php echo $_POST["pid"];?>>
                        <textarea class="form-control profilefield" id="store" name="spProfilerefund"
                            rows="4"><?php echo (isset($spProfilerefund))?$spProfilerefund:'';?></textarea>

                    </div>

                    <div role="tabpanel" class="tab-pane store" id="Policy">

                        <!-- <form action="addpolicy.php" method="post" class="profileform" > -->
                        <input type="hidden" name="spProfiles_idspProfiles" value=<?php echo $_POST["pid"];?>>
                        <div class="form-group">
                            <br>
                            <label for="aboutstore">Policy</label>
                            <textarea class="form-control profilefield" id="aboutstore" name="spProfilepolicy"
                                rows="4"><?php echo (isset($aboutpolicy))?$aboutpolicy:'';?></textarea>

                        </div>
                        <!-- <button type="submit" class="btn btn-success">Submit</button> -->
                        <!-- </form> -->
                    </div>


                </div>

            </div>
            <!--Testing Complete-->

        </div>
    </div>



</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for="spProfilesCountry">Country</label>
            <select id="spUserCountry_default_address" class="form-control " name="spUserCountry">
                <option value="0">Select Country</option>
                <?php
                        $co = new _country;
                        $result3 = $co->readCountry();
                        if($result3 != false){
                            while ($row3 = mysqli_fetch_assoc($result3)) {
                                ?>
                <option value='<?php echo $row3['country_id'];?>'
                    <?php echo (isset($usercountry) && $usercountry == $row3['country_id'])?'selected':''; ?>>
                    <?php echo $row3['country_title'];?>
                </option>
                <?php
                            } 
                        }
                        ?>
            </select>
            <span id="shippcounrty_error" style="color:red;"></span>

            <!-- <input type="text" list="suggested_address" class="form-control" name="address"  id="address" onkeyup="getaddress();" value="<?php //echo $address_city;?>"  >

                <datalist id="suggested_address"></datalist> -->

            <input type="hidden" name="latitude" id="latitude">
            <input type="hidden" name="longitude" id="longitude">

        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group">

            <div class="loadUserState">
                <label for="spUserState">State</label>
                <select class="form-control" name="spUserState" id="spUserState">
                    <option value="0">Select State</option>
                    <?php 
                            if (isset($userstate) && $userstate > 0) {
                                $pr = new _state;
                                $result2 = $pr->readState($usercountry);
                                if($result2 != false){
                                    while ($row2 = mysqli_fetch_assoc($result2)) { ?>
                    <option value='<?php echo $row2["state_id"];?>'
                        <?php echo (isset($userstate) && $userstate == $row2["state_id"] )?'selected':'';?>>
                        <?php echo $row2["state_title"];?> </option>
                    <?php
                                    }
                                }
                            }
                            ?>
                </select>
                <span id="shippstate_error" style="color:red;"></span>
            </div>
        </div>
    </div>

    <style>
    #email1 {
        margin-left: -129px;
    }

    .div1 {
        margin-left: -130px;
    }

    .row {
        margin-left: -6px;
        margin-right: -6px;

    }

    input[type="radio"],
    input[type="checkbox"] {
        /* margin: 0px 0 0; */
        margin-bottom: 2px !important;
        margin-top: 1px \9;
        line-height: normal !important;
    }

    #pro1 {
        margin-left: -9px !important;
    }

    #profile1 {
        margin-left: -9px !important;
    }
    </style>

    <div class="col-md-4">
        <div class="form-group">
            <div class="loadCity">
                <label for="spUserCity">City</label>
                <select class="form-control" name="spUserCity" id="spUserCity">
                    <option value="0">Select City</option>
                    <?php 
                                if (isset($usercity) && $usercity > 0) {
                                    $co = new _city;
                                    $result3 = $co->readCity($userstate);
                                    if($result3 != false) {
                                        while ($row3 = mysqli_fetch_assoc($result3)) { ?>
                    <option value='<?php echo $row3['city_id']; ?>'
                        <?php echo (isset($usercity) && $usercity == $row3['city_id'])?'selected':''; ?>>
                        <?php echo $row3['city_title'];?></option> <?php
                                        }
                                    }
                                } 
                            ?>
                </select>
                <span id="shippcity_error" style="color:red;"></span>
            </div>
        </div>
    </div>
</div>

<div class="row">

    <div class="col-md-12">
        <div class="form-group">
            <label for="shipp_address">Additional Address<span class="red">*</span></label>
            <textarea class="form-control" rows="2" name="address" id="shipp_address"><?php 
                        echo(isset($address_city) && !empty($address_city))?$address_city:''; ?></textarea>
            <span id="shippaddress_error" style="color:red;"></span>
        </div>
    </div>
    <?php 
			   $u = new _spuser;
	$spuserres = $u->read($_SESSION["uid"]);
	
	if($spuserres != false)
	{
      	$ruser = mysqli_fetch_assoc($spuserres);
		$username = $ruser["spUserName"]; 
		$userpnone = $ruser["spUserCountryCode"].$ruser["spUserPhone"]; 

			   
			   ?>
    <div class="col-md-4">
        <div class="form-group">
            <label for="spProfilePhone" class="control-label">Personal Phone</label>
            <input type="text" class="form-control profilefield" id="spProfilePhone" name="spProfilePhone"
                onkeypress="return onlyNumberKey(event)" maxlength="10"
                value="<?php echo (isset($phone))?$phone:''; ?>">
        </div>
    </div>
    <?php } ?>
    <div class="col-md-3">
        <div class="form-group">
            <label for="spProfilePostalCode" class="control-label">Postal Code/Zip</label>
            <input type="text" class="form-control" id="spProfilePostalCode" name="spProfilePostalCode"
                value="<?php echo (isset($postalCode))?$postalCode:'';?>">
        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <label for="spProfilePostalCode" id="phone1" class="control-label pb_10">Phone Status</label>
            <br>

            <input type="radio" name="phone_status" value="private"
                <?php if(isset($phone_status) && $phone_status == "private"){ echo 'checked'; }elseif(!isset($phone_status)){ echo 'checked'; }else{ echo " ";} ?>>Private
            &nbsp;&nbsp;
            <input type="radio" name="phone_status" value="public"
                <?php echo (isset($phone_status) && $phone_status == "public" )?'checked':''; ?>>Public &nbsp;&nbsp;

        </div>
    </div>
    <div class="col-md-3">
        <div class="form-group" style="margin-left:10px">
            <label class="control-label pb_10" id="profile1">Profile Status</label>
            <br>

            <input type="radio" id="pro1" name="profile_status" value="private"
                <?php if(isset($profile_status) && $profile_status == "private"){ echo 'checked'; }elseif(!isset($profile_status)){ echo 'checked'; }else{ echo " ";} ?>>Private
            &nbsp;&nbsp;
            <input type="radio" name="profile_status" value="public"
                <?php echo (isset($profile_status) && $profile_status == "public" )?'checked':''; ?>>Public &nbsp;&nbsp;

        </div>
    </div>
    <div class="col-md-3 pull-right">
        <div class="form-group ">
            <label for="spProfilePostalCode" class="control-label pb_10 mdc14" id="email1">Email Status</label>
            <br>

            <div class="div1"> <input type="radio" id="pri1" name="email_status" value="private"
                    <?php if(isset($email_status) && $email_status == "private" ){ echo 'checked'; }elseif(!isset($email_status)){ echo 'checked'; }else{ echo " ";} ?>>Private
                &nbsp;&nbsp;
                <input type="radio" id="pub1" name="email_status" value="public"
                    <?php echo (isset($email_status) && $email_status == "public" )?'checked':''; ?>>Public &nbsp;&nbsp;
            </div>
        </div>
    </div>
</div>
<br>

<!-- <div class="col-md-12">

		<div class="form-group">

							<label for="aboutstore">About Store</label>
							<textarea class="form-control" id="aboutstore" name="spProfilesAboutStore" rows="4" placeholder="Type about store.."><?php echo $aboutstore ; ?></textarea>
		  </div>
		
	</div> -->

<!-- <div class="col-md-12">

		<div class="form-group">
                            
                            <label for="aboutstore">Shipping Destination</label>
							<textarea class="form-control" id="aboutstore" name="spshippingtext" rows="4" > <?php echo $spshippingtext ; ?></textarea>

	</div> -->
<!-- 
		<div class="form-group">
				<label for="aboutstore">Returns and Refunds</label>

 
						<textarea class="form-control" id="store" name="spProfilerefund" rows="4" ><?php echo $spProfilerefund; ?></textarea>
				</div>		 -->

<!-- <div class="form-group">
							<label for="aboutstore">Policy</label>
							<textarea class="form-control" id="aboutstore" name="spProfilepolicy" rows="4" ><?php echo $aboutpolicy; ?></textarea>
						</div>	 -->

<!-- <div class="col-md-12">
		<div class="form-group">
			<label for="CompanyOverview_">Company Overview</label>
			<textarea class="form-control profilefield" id="CompanyOverview_" name="CompanyOverview_" rows="3" ><?php //echo (isset($cmpnyDesc) ? $cmpnyDesc : ''); ?></textarea>
		</div>
	</div> -->

<!-- <div class="col-md-4">
		<div class="form-group">
			<label for="cmpnyBenefits_" class="control-label">Company Benefits</label>
			<input type="text" class="form-control profilefield" id="cmpnyBenefits_" name="cmpnyBenefits_" value="<?php //echo (isset($cmpnyBenfit))?$cmpnyBenfit: ''; ?>"> 
		</div>
	</div>
 	 -->



</div>


<script>
$("#companyname_").change(function() {
    $(".lbl_8").html("");
});
$("#skill_").change(function() {
    $(".lbl_9").html("");
});
$("#companyEmail_").change(function() {
    $(".lbl_10").html("");
});
$("#companyPhoneNo_").change(function() {
    $(".lbl_11").html("");
});
$("#businesscategory_").change(function() {
    $(".lbl_12").html("");
});
$("#companytagline_").change(function() {
    $(".lbl_13").html("");
});
$("#companyProductService_").change(function() {
    $(".lbl_14").html("");
});
$("#spProfileAbout").change(function() {
    $(".lbl_15").html("");
});









//==========Handle the my address section of profile update module =======
$("#spUserCountry_default_address").on("change", function() {
    //alert("111111111111111111111");
    var countryId = this.value;
    $.post("loadUserState.php", {
        countryId: countryId
    }, function(r) {
        //alert(r);
        $(".loadUserState").html(r);

    });
    var state = 0;
    $.post("loadUserCity.php", {
        state: state
    }, function(r) {
        //alert(r);

        $(".loadCity").html(r);
    });
});

//==========ON CHANGE LOAD CITY==========
$("#spUserState").on("change", function() {
    var state = this.value;
    $.post("loadUserCity.php", {
        state: state
    }, function(r) {
        //alert(r);
        $(".loadCity").html(r);
    });
});
</script>
<script>
function onlyNumberKey(evt) {

    // Only ASCII character in that range allowed
    var ASCIICode = (evt.which) ? evt.which : evt.keyCode
    if (ASCIICode > 31 && (ASCIICode < 48 || ASCIICode > 57))
        return false;
    return true;
}

$("#idupdate111").on("click", function() {

    alert('fhvdsjfsgjvdfdk');
    var aa = $("#companyname_").val();
    var bb = $("#skill_").val();
    var cc = $("#companyEmail_").val();
    var dd = $("#companyPhoneNo_").val();
    //var dl=$("#companyPhoneNo_").length();
    var dl = dd.length;
    //alert(dl);
    var ee = $("#businesscategory_").val();
    var ff = $("#companytagline_").val();
    var gg = $("#companyProductService_").val();
    var hh = $("#spProfileAbout").val();




    if ((aa == "") || (bb == "") || (cc == "") || (dd == "") || (ee == "") || (ff == "") || (gg == "") || (hh ==
            "")) {
        if (aa != "") {
            $(".lbl_8").html("");
        } else {

            $(".lbl_8").html("Please fill Field ");

        }

        if (bb != "") {
            $(".lbl_9").html("");
        } else {
            $(".lbl_9").html("Please fill Field ");

        }
        if (cc != "") {
            $(".lbl_10").html("");
        } else {
            $(".lbl_10").html("Please fill Field ");

        }


        if (dd != "") {
            $(".lbl_11").html("");
        } else {
            $(".lbl_11").html("Please fill Field ");

        }
        if (ee != "") {
            $(".lbl_12").html("");
        } else {
            $(".lbl_12").html("Please fill Field ");

        }
        if (ff != "") {
            $(".lbl_13").html("");
        } else {
            $(".lbl_13").html("Please fill Field ");

        }
        if (gg != "") {
            $(".lbl_14").html("");
        } else {
            $(".lbl_14").html("Please fill Field ");

        }
        if (hh != "") {
            $(".lbl_15").html("");
        } else {
            $(".lbl_15").html("Please fill Field ");

        }

        return false;

    }

    if (dl != 10) {
        //alert('enter 10 value');
        $(".lbl_11").html("Please enter a valid phone number");

        return false;
    } else {
        $(".lbl_11").html("");

    }



});

$(document).ready(function() {

    $aaa = $(".aa74").val();

    //$("#companyname_").val($aaa);

    $(".aa74").keyup(function() {
        $aaa = $(".aa74").val();

        //$("#companyname_").val($aaa);

    });
});
</script>

<script src="https://dev.thesharepage.com/assets/css/country/js/intlTelInput.js"></script>
<script type="text/javascript"
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAPpH4FGQaj_JIJOViHAeHGAjl7RDeW8OQ&libraries=places"></script>


<script>
var input = document.querySelector("#companyPhoneNo_");
window.intlTelInput(input, {
    preferredCountries: ['us', 'ca'],
    separateDialCode: true,
    utilsScript: "https://dev.thesharepage.com/assets/css/country/js/utils.js",
});
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
$("#businesscategory_").select2({

    placeholder: "Select a programming language",
    allowClear: true
});
</script>