<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

require_once("../helpers/start.php");
require_once "../classes/Base.php";
require_once "../classes/CreateProfile.php";
$t = new CreateProfile();
?>
     
<div class="business-overview">
    <div class="sub-heading">
        Business Overview
    </div>
    <div class="input-wrapper">
        <div class="input-group in-2-col">
            <label>Business Name<span style="color: #EF1D26;">*</span></label>
            <input type="text" placeholder="Enter Business Name" name="companyname" id="companyname" value="<?php if(isset($buss_name)){ echo $buss_name; } ?>" required>
            <span class="error-message" id="error-companyname"></span>
        </div>
        <div class="input-group in-2-col">
          <label>Business Category<span style="color: #EF1D26;">*</span></label>
            <select class="form-select select2" multiple style="height: 100px; overflow-y: auto;" name="businesscategory[]" id="category" required>
                <option value="">Select category</option>
                <?php 
                $masterid = 8;
                $Category = $t->businessCategoryList($masterid);
                foreach ($Category['data'] as $row){
                  $selected = '';
                  if(isset($buss_cat_array) && count($buss_cat_array) > 0) {
                    $selected = in_array($row['idmasterDetails'], $buss_cat_array) ? 'selected' : '';
                  }
                ?>
                    <option value="<?php echo $row['idmasterDetails']; ?>" <?php echo $selected; ?>>
                        <?php echo $row['masterDetails']; ?>
                    </option>
                <?php } ?>
            </select>
            <span class="error-message" id="error-category"></span>
        </div>

        <div class="input-group in-1-col">
            <label>Business Tagline<span style="color: #EF1D26;">*</span></label>
            <input type="text" placeholder="Enter Business Tagline" name="companytagline" id="companytagline" value="<?php if(isset($buss_tag)){ echo $buss_tag; } ?>" required>
            <span class="error-message" id="error-companytagline"></span>
        </div>
        <div class="input-group in-2-col">
            <label>Company Phone<span style="color: #EF1D26;">*</span></label>
            <input type="number" placeholder="Enter Company Phone" name="companyPhoneNo" id="companyPhoneNo" value="<?php if(isset($buss_phone)){ echo $buss_phone; } ?>" required>
            <span class="error-message" id="error-companyPhoneNo"></span>
        </div>
        <div class="input-group in-2-col">
            <label>Company Email <span style="color: #EF1D26;">*</span>
                <!-- <span style="color:#000000;">(Optional)</span> -->
            </label>
            <input type="email" placeholder="Enter Company Email" name="companyEmail" id="companyEmail" value="<?php if(isset($buss_email)){ echo $buss_email; } ?>" required>
            <span class="error-message" id="error-companyEmail"></span>
        </div>
        <div class="input-group in-1-col">
            <label> Website<span style="color: #EF1D26;"></span></label>
            <input type="text" placeholder="Enter  Website" name="CompanyWebsite" id="CompanyWebsite" value="<?php if(isset($buss_website)){ echo $buss_website; } ?>" required>
            <span class="error-message" id="error-CompanyWebsite"></span>
        </div>
        <div class="input-group in-1-col">
            <label> Specialties(Add each Business Specialty separated by comma)<span style="color: #EF1D26;">*</span></label>
            <textarea placeholder="Type Specialties.." rows="4" cols="50" name="skill" id="CompanySpecialties" required><?php if(isset($buss_skill)){ echo $buss_skill; } ?></textarea>
            <span class="error-message" id="error-CompanySpecialties"></span>
        </div>
        <div class="input-group in-1-col">
            <label>Product and Services<span style="color: #EF1D26;">*</span></label>
            <textarea placeholder="Type Product and Services.." rows="4" cols="50" name="companyProductService" id="ProductAndServices" required><?php if(isset($buss_productservice)){ echo $buss_productservice; } ?></textarea>
            <span class="error-message" id="error-ProductAndServices"></span>
        </div>
        <div class="input-group in-1-col">
            <label>Business Overview<span style="color: #EF1D26;">*</span></label>
            <textarea placeholder="Type Business Overview.." rows="4" cols="50" name="BussinessOverview" id="BusinessOverview" required><?php if(isset($buss_overview)){ echo $buss_overview; } ?></textarea>
            <span class="error-message" id="error-BusinessOverview"></span>
        </div>
    </div>
</div>

<div class="business-overview">
    <div class="sub-heading">
        Additional Information
    </div>
    <div class="input-wrapper">
        <div class="input-group in-2-col">
            <label>Store Name<span style="color: #EF1D26;"></span></label>
            <input type="text" placeholder="Enter Store Name" name="spDynamicWholesell" id="StoreName" value="<?php echo isset($buss_store) && !empty($buss_store) ? htmlspecialchars($buss_store) : htmlspecialchars($buss_name)."' Store"; ?>" required>
            <span class="error-message" id="error-StoreName"></span>
        </div>
        <div class="input-group in-2-col">
            <label>Personal Phone<span style="color: #EF1D26;"></span></label>
            <input type="number" placeholder="Enter Personal Phone" name="spProfilePhone" id="PersonalPhone" value="<?php if(isset($phone)){ echo $phone; } ?>" required>
            <span class="error-message" id="error-PersonalPhone"></span>
        </div>
        <div class="input-group in-4-col">
            <label>Company Size<span style="color: #EF1D26;"></span></label>
            <select class="form-select" aria-label="Default select example" name="CompanySize" id="CompanySize" required>
                <option  value="0">Select Size</option>
                <option value="1 - 49 Employee" <?php if(isset($buss_company_size) && $buss_company_size == "1 - 49 Employee") { echo "selected"; } ?> >1 - 49 Employee</option>
                <option value="50 - 149 Employee" <?php if(isset($buss_company_size) && $buss_company_size == "50 - 149 Employee") { echo "selected"; } ?> >50 - 149 Employee</option>
                <option value="150 - 249 Employee" <?php if(isset($buss_company_size) && $buss_company_size == "150 - 249 Employee") { echo "selected"; } ?> >150 - 249 Employee</option>
                <option value="250 - 499 Employee" <?php if(isset($buss_company_size) && $buss_company_size == "250 - 499 Employee") { echo "selected"; } ?> >250 - 499 Employee</option>
                <option value="500 - 749 Employee" <?php if(isset($buss_company_size) && $buss_company_size == "500 - 749 Employee") { echo "selected"; } ?> >500 - 749 Employee</option>
                <option value="750 - 999 Employee" <?php if(isset($buss_company_size) && $buss_company_size == "750 - 999 Employee") { echo "selected"; } ?> >750 - 999 Employee</option>
                <option value="1000+ Employee" <?php if(isset($buss_company_size) && $buss_company_size == "1000+ Employee") { echo "selected"; } ?> >1000+ Employee</option>
            </select>
            <span class="error-message" id="error-CompanySize"></span>
        </div>
        <div class="input-group in-4-col">
            <label>Company Revenue<span style="color: #EF1D26;"></span></label>
            <input type="text" placeholder="Enter Company Revenue" name="cmpyRevenue" id="Revenue" value="<?php if(isset($buss_cmpyRevenue)) { echo $buss_cmpyRevenue; } ?>" required>
            <span class="error-message" id="error-Revenue"></span>
        </div>
        <div class="input-group in-4-col">
            <input id="found-year" type="hidden" value="<?php if(isset($buss_year)) { echo $buss_year; } else { echo ''; } ?>">
            <label for="yearSelect">Year Founded<span style="color: #EF1D26;"></span></label>
            <select id="yearSelect" class="form-select" aria-label="Default select example" name="yearFounded" onfocus="populateYears('yearSelect', <?php if(isset($buss_year)) { echo $buss_year; } else { echo ""; } ?>)" required>
                <option  value="0">Select Year</option>
            </select>
            <span class="error-message" id="error-yearSelect"></span>
        </div>
        <div class="input-group in-4-col">
            <label>Stock Symbol</label>
            <input type="text" placeholder="Enter Stock Symbol" name="stockSymbol" id="stockSymbol" value="<?php if(isset($buss_stock_symbol)) { echo $buss_stock_symbol; } ?>">
            <span class="error-message" id="error-stockSymbol"></span>
        </div>
        <div class="input-group in-1-col">
            <label>Stock Weblink</label>
            <input type="text" placeholder="Enter Stock Weblink" name="cmpnyStockLink" id="cmpnyStockLink" value="<?php if(isset($buss_stock_link)) { echo $buss_stock_link; } ?>" required>
            <span class="error-message" id="error-cmpnyStockLink"></span>
        </div>
       <div class="group-navigation">
        <div class="link active-link" onclick="showContent('about-business', this)">About Business</div>
        <div class="link" onclick="showContent('shipping-destination', this)">Shipping Destination</div>
        <div class="link" onclick="showContent('returns-refunds', this)">Returns and Refunds</div>
        <div class="link" onclick="showContent('policy', this)">Policy</div>
      </div>
        <div class="input-group in-1-col content-section" id="about-business">
            <label id="content-label">About Business</label>
            <textarea id="content-area" placeholder="Type About Business.." rows="4" cols="50" name="spProfilesAboutStore" id="About"><?php if(isset($buss_about)) { echo $buss_about; } ?></textarea>
            <span class="error-message" id="error-About"></span>
        </div>

        <div class="input-group in-1-col content-section hidden" id="shipping-destination">
            <label id="content-label">Shipping Destination<span style="color: #EF1D26;">*</span></label>
            <textarea id="content-area" placeholder="Type Shipping Destination.." rows="4" cols="50" name="spshippingtext" id="ShippingDestination"><?php if(isset($buss_shipping)) { echo $buss_shipping; } ?></textarea>
            <span class="error-message" id="error-ShippingDestination"></span>
        </div>

        <div class="input-group in-1-col content-section hidden" id="returns-refunds">
            <label id="content-label">Returns and Refunds<span style="color: #EF1D26;">*</span></label>
            <textarea id="content-area" placeholder="Type Returns and Refunds.." rows="4" cols="50" name="spProfilerefund" id="ReturnsRefunds"><?php if(isset($buss_return)) { echo $buss_return; } ?></textarea>
            <span class="error-message" id="error-ReturnsRefunds"></span>
        </div>

        <div class="input-group in-1-col content-section hidden" id="policy">
            <label id="content-label">Policy<span style="color: #EF1D26;">*</span></label>
            <textarea id="content-area" placeholder="Type Policy.." rows="4" cols="50" name="spProfilepolicy" id="Policy"><?php if(isset($buss_policy)) { echo $buss_policy; } ?></textarea>
            <span class="error-message" id="error-Policy"></span>
        </div>
    </div>
</div>

<div class="business-overview">
    <div class="sub-heading">
        Location Information
    </div>
    <div class="input-wrapper">
        <div class="input-group in-1-col">
            <label>Street Address<span style="color:#000000;">(Optional)</span></label>
            <input type="text" placeholder="Enter Street Address" name="address" id="StreetAddress" value="<?php if(isset($address)) { echo $address; } ?>" required>
            <span class="error-message" id="error-StreetAddress"></span>
        </div>
        <div class="input-group in-4-col">
            <label>Country<span style="color: #EF1D26;">*</span></label>
            <select class="form-select" id="spUserCountry" aria-label="Default select example" name="spProfilesCountry" required>
                <option value="0">Select Country</option>
                <?php 
                $Country = $t->readCountry();
                foreach ($Country['data'] as $rows){ ?>
                  <option value="<?php echo $rows['country_id']; ?>" <?php if(isset($country) && ( $country == $rows['country_id'])) { echo "selected"; } ?> >
                  <?php echo $rows['country_title']; ?>
                  </option>
                <?php } ?>
            </select>
            <span class="error-message" id="error-spUserCountry"></span>
        </div>
        <div class="input-group in-4-col">
            <label>State<span style="color: #EF1D26;">*</span></label>
            <select class="form-select loadUserState" id="spUserState" name="spUserState" aria-label="Default select example" required>
                <option value="<?php if(isset($state)) { echo $state; } else { echo 0; }?>" selected>Select State</option>
            </select>
            <span class="error-message" id="error-spUserState"></span>
        </div>
        <div class="input-group in-4-col">
            <label>City<span style="color: #EF1D26;">*</span></label>
            <select class="form-select" id="spUserCity" name="spUserCity" aria-label="Default select example" required>
                <option  value="<?php if(isset($city)) { echo $city; } else { echo 0; }?>" >Select City</option>
            </select>
            <span class="error-message" id="error-spUserCity"></span>
        </div>
        <div class="input-group in-4-col">
            <label>Postal Code<span style="color: #EF1D26;">*</label>
            <input type="text" placeholder="Enter Postal Code" name="spProfilePostalCode" id="PostalCode" value="<?php if(isset($postalCode)) { echo $postalCode; } ?>">
            <span class="error-message" id="error-PostalCode"></span>
        </div>
    </div>
</div>

<div class="status">
    <div class="sub-heading">
        Status
    </div>
    <div class="list-wrapper">
        <div class="phone-status-wrapper radio-box">
            <label for="" class="label">
                Phone Status<span style="color: #EF1D26;">*</span>
            </label>
            <div class="phone-status">
                <input type="radio" <?php if(!isset($phone_status)){ echo "checked";} ?> id="phone-status-private" name="phone_status" value="private" <?php if(isset($phone_status) && ($phone_status == 'private')) { echo "checked"; } ?> required>
                <label for="phone-status-private" class="radio-label">Private</label>
                <input type="radio" id="phone-status-public" name="phone_status" value="public" <?php if(isset($phone_status) && ($phone_status == 'public')) { echo "checked"; } ?> required>
                <label for="phone-status-public" class="radio-label">Public</label>
            </div>
            <span class="error-message" id="error-phone-status"></span>
        </div>
        <div class="phone-status-wrapper radio-box">
            <label for="" class="label">
                Profile Status<span style="color: #EF1D26;">*</span>
            </label>
            <div class="phone-status">
                <input type="radio" id="profile-status-private" name="profile_status" value="private" <?php if(isset($profile_status) && ($profile_status == 'private')) { echo "checked"; } ?> required>
                <label for="profile-status-private" class="radio-label">Private</label>
                <input type="radio" <?php if(!isset($profile_status)){ echo "checked";} ?> id="profile-status-public" name="profile_status" value="public" <?php if(isset($profile_status) && ($profile_status == 'public')) { echo "checked"; } ?> required>
                <label for="profile-status-public" class="radio-label">Public</label>
            </div>
            <span class="error-message" id="error-profile-status"></span>
        </div>
        <div class="phone-status-wrapper radio-box">
            <label for="" class="label">
                Email Status<span style="color: #EF1D26;">*</span>
            </label>
            <div class="phone-status">
                <input type="radio" <?php if(!isset($email_status)){ echo "checked";} ?> id="email-status-private" name="email_status" value="private" <?php if(isset($email_status) && ($email_status == 'private')) { echo "checked"; } ?> required>
                <label for="email-status-private" class="radio-label">Private</label>
                <input type="radio" id="email-status-public" name="email_status" value="public" <?php if(isset($email_status) && ($email_status == 'public')) { echo "checked"; } ?> required>
                <label for="email-status-public" class="radio-label">Public</label>
            </div>
            <span class="error-message" id="error-email-status"></span>
        </div>
    </div>
</div>

<div class="public">
    <div class="check-box" style="margin-left: 14px;">
        <label class="main-container"> Publish in Business Space
            <input type="checkbox" id="publish" name="defaultbusiness" value="1" <?php if(isset($buss_default) && ($buss_default == 0)) { echo ""; } else { echo "checked"; } ?> required>
            <span class="checkmark"></span>
        </label>
        <span class="error-message" id="error-publish"></span>
    </div>
    <div class="check-box">
        <label class="main-container"> Show email on profile
            <input type="checkbox" id="showEmail" name="showEmailProfile" value="1" <?php if(isset($buss_showemail) && ($buss_showemail == 0)) { echo ""; } else { echo "checked"; } ?> required>
            <span class="checkmark"></span>
        </label>
        <span class="error-message" id="error-showEmail"></span>
    </div>
</div>
<?php 
 if(isset($page) && $page == "neweditprofile"){ 
?>
<div class="main-btns">
  <button id="cancel">CANCEL</button>
  <button type="button" class="active" id="updateprofile" onclick="validateForm(event,'business', 'update')" disabled>UPDATE PROFILE</button>
</div>
<?php
 } else {
?>
<div class="main-btns">
    <button type="button" onclick="cancelForm()">CANCEL</button>
    <button class="active" type="button" onclick="validateForm(event,'business', 'create')">CREATE PROFILE</button>
</div>
<?php
}
?>

<!--
code put on views/common/header.php

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const inputFields = document.querySelectorAll('.input-wrapper input, .input-wrapper textarea, .input-wrapper select');
        const updateProfileButton = document.getElementById('updateprofile');
        inputFields.forEach(field => {
            field.addEventListener('input', function() {
                updateProfileButton.setAttribute('data-changed', 'true');
                updateProfileButton.style.display = 'block'; 
            });
        });
        updateProfileButton.style.display = 'none';
        function cancelForm() {
            updateProfileButton.setAttribute('data-changed', 'false');
            updateProfileButton.style.display = 'none';
        }
        document.getElementById('cancel').addEventListener('click', cancelForm);
    });
</script> -->
