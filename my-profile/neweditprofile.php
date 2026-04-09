<?php
$page = 'neweditprofile';
include_once("../views/common/header.php");
require_once "../classes/CreateProfile.php";
require_once "../classes/EditProfile.php";
require_once "../classes/Timeline.php";
$time = new Timeline();
$p = new EditProfile();
$t = new CreateProfile();
$row  = $p->featchProfilesData($_SESSION["pid"]);
$row1 = $p->featchUsersData2($_SESSION["uid"]);
$row2 = $p->featchEmployementData3($_SESSION["pid"],$_SESSION["ptid"]);
$row3  = $p->featchBussinessData4($_SESSION["pid"]);
$row4  = $p->experienceDetails($_SESSION["pid"]);
$row5  = $p->featchProfessionalData($_SESSION["pid"]);
$name = $row['data']["spProfileName"];
$email = $row['data']["spProfileEmail"];
$phone = $row['data']["spProfilePhone"];
$state = $row['data']['spProfilesState'];
$lname = $row['data']['spProfileLastName'];
$dob = $row['data']['spProfilesDob'];
$about = $row['data']["spProfileAbout"];
$country = $row['data']["spProfilesCountry"];
$picture = $row['data']["spProfilePic"];
$location = $row['data']["spprofilesLocation"];
$language = $row['data']["spprofilesLanguage"];
$address = $row['data']["spprofilesAddress"];
$postalCode = $row['data']['spProfilePostalCode'];
$relationship_status = $row['data']['relationship_status'];
$phone_status = $row['data']['phone_status'];
$profile_status = $row['data']['profile_status'];
$email_status = $row['data']['email_status'];
$address_city = $row['data']["address"];
$spProfile_storename = $row['data']["store_name"];
$tags = $row1['data']["memberrelation"];
$cmpyPhoneNo = $row1['data']["personal_PhoneNo"];
$relationship_status = $row1['data']["relationship_status"];
$storename = $row1['data']["spDynamicWholesell"];
$Category = $row1['data']["category"];
$Highlights = $row1['data']["highlights"];
$LanguageFluency = $row1['data']["languagefluency"];
$sphobbies = $row1['data']["sphobbies"];
$spProfileeducation = $row1['data']["Education"];
$spProfileAbout = $row1['data']["spProfileAbout"];
$data = $row2['data'];
$school = $row2['data']['school'];
$empdegree = $row2['data']['empdegree'];
$study = $row2['data']['study'];
$year = $row2['data']['year'];
$spProfileTypeNew = $row2['data']["spProfileType_idspProfileType"];
$companytagline = $row3['data']["companytagline"];
$companyname = $row3['data']["companyname"];
$languageSpoken = $row3['data']["languageSpoken"];
if($_SESSION["ptid"] == 3){
$languageSpoken = $row5['data']["splanguagefluency"];
$sphobbies = $row5['data']["sphobbies"];
}
$data1 = $row4['data'];
$experiences = [];
foreach ($data1 as $index => $entry) {
  $experiences[$index] = [
    'id' => $entry['id'],
    'jobtitle' => $entry['jobtitle'],
    'company' => $entry['company'],
    'country' => $entry['country'],
    'state' => $entry['state'],
    'city' => $entry['city'],
    'start_date' => $entry['start_date'],
    'end_date' => $entry['end_date'],
    'frommonth' => $entry['frommonth'],
    'fromyear' => $entry['fromyear'],
    'tomonth' => $entry['tomonth'],
    'toyear' => $entry['toyear'],
    'idspProfiles' => $entry['idspProfiles'],
    'idsp_pid' => $entry['idsp_pid'],
    'description' => $entry['description'],
    'spProfileType_idspProfileType' => $entry['spProfileType_idspProfileType'],
    'emptype' => $entry['emptype'],
    'current_work' => $entry['current_work']
  ];
}
?>
            <form class="profile" method="POST" id="editform">
                <div class="profile-detail">
                    <div class="check-view-btn">
                        <svg width="19" height="13" viewBox="0 0 19 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M5.5697 6.37498C5.5697 4.41177 7.16693 2.81451 9.13019 2.81451C11.0934 2.81451 12.6906 4.41177 12.6906 6.37498C12.6906 8.33817 11.0934 9.93542 9.13019 9.93542C7.16693 9.93542 5.5697 8.33817 5.5697 6.37498ZM6.7565 6.37498C6.7565 7.68382 7.82126 8.7486 9.13019 8.7486C10.439 8.7486 11.5038 7.68382 11.5038 6.37498C11.5038 5.06614 10.439 4.00136 9.13019 4.00136C7.82135 4.00136 6.7565 5.06614 6.7565 6.37498Z" fill="white"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M9.13028 0.638672C14.0237 0.638672 17.8552 5.80486 18.0159 6.02483C18.1685 6.2333 18.1685 6.51656 18.0159 6.72521C17.8552 6.94498 14.0237 12.1112 9.13028 12.1112C4.23688 12.1112 0.405212 6.94501 0.244629 6.72505C0.0922852 6.51636 0.0922852 6.23332 0.244629 6.02463C0.405212 5.80486 4.23688 0.638672 9.13028 0.638672ZM1.47968 6.37454C2.40381 7.49549 5.52576 10.9244 9.13028 10.9244C12.7426 10.9244 15.8579 7.49725 16.7809 6.37534C15.8564 5.25378 12.7346 1.82547 9.13028 1.82547C5.51797 1.82547 2.40262 5.25259 1.47968 6.37454Z" fill="white"/>
                        </svg>
                        CHECK PUBLIC VIEW
                    </div>
                    <div class="heading">
                        <?php echo $_SESSION["ptname"]?> Profile
                    </div>
                    <div class="profile-info">
                        <div class="profile-img-wrapper">
                            <img id="profilepic" src="<?php echo empty($picture) ? 'http://localhost/assets/images/icon/blank-img.png' : $picture; ?>" alt="">
                            <div class="edit-icon" id="edit-icon">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="0.699219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                                    <path d="M19.0325 12.445L12.765 18.731C12.4391 19.0477 12.0107 19.2246 11.5637 19.2246H9.3752C9.25413 19.2246 9.14238 19.178 9.05857 19.0942C8.97475 19.0104 8.9375 18.8987 8.9375 18.7776L8.99338 16.5705C9.00269 16.1328 9.17963 15.7231 9.48695 15.4157L13.9291 10.9736C14.0036 10.8991 14.134 10.8991 14.2085 10.9736L15.7637 12.5195C15.8662 12.6219 16.0152 12.6871 16.1735 12.6871C16.518 12.6871 16.7881 12.4078 16.7881 12.0725C16.7881 11.9049 16.7229 11.7559 16.6205 11.6441C16.5926 11.6069 15.1118 10.1355 15.1118 10.1355C15.0187 10.0423 15.0187 9.88403 15.1118 9.79091L15.7358 9.15765C16.3132 8.58026 17.2444 8.58026 17.8218 9.15765L19.0325 10.3683C19.6006 10.9364 19.6006 11.8676 19.0325 12.445Z" fill="white"/>
                                </svg>
                            </div>
                        </div>
                        <input type="file" id="file-input" style="display: none;" accept="image/*">
                        <input type="hidden" id="name" value="<?php echo $name; ?>">
                        <div class="name" id="name">
                            <?php echo $name;?>
                            <span id="openModal">
                                <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <rect x="0.699219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                                    <path d="M19.0325 12.445L12.765 18.731C12.4391 19.0477 12.0107 19.2246 11.5637 19.2246H9.3752C9.25413 19.2246 9.14238 19.178 9.05857 19.0942C8.97475 19.0104 8.9375 18.8987 8.9375 18.7776L8.99338 16.5705C9.00269 16.1328 9.17963 15.7231 9.48695 15.4157L13.9291 10.9736C14.0036 10.8991 14.134 10.8991 14.2085 10.9736L15.7637 12.5195C15.8662 12.6219 16.0152 12.6871 16.1735 12.6871C16.518 12.6871 16.7881 12.4078 16.7881 12.0725C16.7881 11.9049 16.7229 11.7559 16.6205 11.6441C16.5926 11.6069 15.1118 10.1355 15.1118 10.1355C15.0187 10.0423 15.0187 9.88403 15.1118 9.79091L15.7358 9.15765C16.3132 8.58026 17.2444 8.58026 17.8218 9.15765L19.0325 10.3683C19.6006 10.9364 19.6006 11.8676 19.0325 12.445Z" fill="white"/>
                                </svg> 
                            </span>
                        </div>
                    </div>
                    <div class="sub-heading">
                        Personal Information
                    </div>
                    <div class="input-wrapper">
                        <div class="input-group in-2-col d-flex" style="align-items: center; gap :10px;">
                            <div class="input-group in-2-col">
                                <label>First Name<span style="color: #EF1D26;">*</span></label>
                                <input type="text" placeholder="Enter First Name"  value="<?php echo (!empty($name) ? $name : $username); ?>" name="fname" id="firname">
                                <span class="error-message" id="firnameError" style="color: red;"></span>
                            </div>
                            <div class="input-group in-2-col">
                                <label>Last Name<span style="color: #EF1D26;">*</span></label>
                                <input type="text" placeholder="Enter Last Name" name="lname" id="lname" value="<?php echo $lname ?>">
                                <span class="error-message" id="lnameError" style="color: red;"></span>
                            </div>
                        </div>
                        <div class="input-group in-2-col">

                            <label>Date Of Birth<span style="color: #EF1D26;">*</span></label>
                            <div class="w-100 d-flex" style="align-items: center; position: relative;">
                                <input type="text" placeholder="Enter Date Of Birth" id="datepicker-input" value="<?php echo $dob ?>"name="dob">
                                
                                <span style="margin-top: 5px;">
                                    <svg id="datepicker-icon"  width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.949219 0.599609H30.3577C32.7837 0.599609 33.9968 0.599609 34.9063 1.10897C35.5491 1.46896 36.0799 1.9997 36.4399 2.64251C36.9492 3.55204 36.9492 4.76509 36.9492 7.19117V30.008C36.9492 32.4341 36.9492 33.6472 36.4399 34.5567C36.0799 35.1995 35.5491 35.7303 34.9063 36.0902C33.9968 36.5996 32.7837 36.5996 30.3577 36.5996H0.949219V0.599609Z" fill="#1F1216"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M25.6594 10.9199H24.5451V9.10303H23.0916V10.9199H14.8068V9.10303H13.3533V10.9199H12.2389C11.5322 10.9199 10.8544 11.2006 10.3547 11.7004C9.85496 12.2001 9.57422 12.8779 9.57422 13.5846V25.4305C9.57422 26.1372 9.85496 26.815 10.3547 27.3147C10.8544 27.8144 11.5322 28.0952 12.2389 28.0952H25.6594C26.3661 28.0952 27.0439 27.8144 27.5436 27.3147C28.0434 26.815 28.3241 26.1372 28.3241 25.4305V13.5846C28.3241 12.8779 28.0434 12.2001 27.5436 11.7004C27.0439 11.2006 26.3661 10.9199 25.6594 10.9199ZM12.2632 12.3734H13.3775V13.948H14.831V12.3734H23.0916V13.948H24.5451V12.3734H25.6594C25.9806 12.3734 26.2887 12.501 26.5159 12.7281C26.743 12.9553 26.8706 13.2634 26.8706 13.5846V15.0623H11.0277V13.5846C11.0277 13.2634 11.1553 12.9553 11.3825 12.7281C11.6096 12.501 11.9177 12.3734 12.2389 12.3734H12.2632ZM25.6594 26.6417H12.2389C11.9177 26.6417 11.6096 26.5141 11.3825 26.2869C11.1553 26.0598 11.0277 25.7517 11.0277 25.4305V16.5158H26.8706V25.4305C26.8706 25.5895 26.8393 25.747 26.7784 25.894C26.7176 26.0409 26.6284 26.1745 26.5159 26.2869C26.4034 26.3994 26.2699 26.4886 26.1229 26.5495C25.976 26.6104 25.8185 26.6417 25.6594 26.6417ZM20.5479 17.9199H17.3745V21.0909H20.5479V17.9199ZM12.8687 17.9214H16.0421V21.0924H12.8687V17.9214ZM25.0538 17.9199H21.8804V21.0909H25.0538V17.9199ZM17.3745 22.0391H20.5479V25.2101H17.3745V22.0391ZM16.0421 22.039H12.8686V25.21H16.0421V22.039ZM21.8804 22.0391H25.0538V25.2101H21.8804V22.0391Z" fill="white"/>
                                    </svg>
                                </span>
                            </div>
                            <span id="datepicker-inputError" style="color: red;"></span>
                        </div>
                        <div class="in-2-col" >
                            <div class="input-group in-1-col">
                                <label>Phone<span style="color: #EF1D26;">*</span></label>
                                <input type="text" placeholder="Enter phone" value="<?php echo $phone ?>" name="phones" id="phone">
                                <span class="error-message" id="phoneError" style="color: red;"></span>
                            </div>
                            <div class="phone-status-wrapper radio-box w-100">
                                <label for="" class="label" style="margin-top: 5px;">
                                    Phone Status<span id="phstatus"style="color: #EF1D26;">*</span>
                                </label>
                                <div class="phone-status">
                                    <input type="radio" id="phone-status-private" name="phone" value="private" <?php echo (isset($phone_status) && $phone_status == "private") ? 'checked' : ''; ?>>
                                    <label for="phone-status-private" class="radio-label">Private</label>
                                    <input type="radio" id="phone-status-public" name="phone" value="public" <?php echo (isset($phone_status) && $phone_status == "public") ? 'checked' : ''; ?>>
                                    <label for="phone-status-public" class="radio-label">Public</label>
                                </div>                                
                            </div>
                            <span class="error-message" id="phstatusError" style="color: red;"></span>
                        </div>
                        <div class="in-2-col" sty>
                            <div class="input-group in-1-col">
                                <label>Email<span style="color: #EF1D26;">*</span></label>
                                <input type="text" placeholder="Enter email" value="<?php echo $email ?>" name="emails" id="email">
                                <span class="error-message" id="emailError" style="color: red;"></span>
                            </div>
                            <div class="phone-status-wrapper radio-box w-100">
                                <label for="" class="label" style="margin-top: 5px;">
                                    Email Status<span id="emailstatus"style="color: #EF1D26;">*</span>
                                </label>
                                <div class="phone-status">
                                    <input type="radio" id="email-status-private" name="email" value="private" <?php echo (isset($email_status) && $email_status == "private") ? 'checked' : ''; ?>>
                                    <label for="email-status-private" class="radio-label">Private</label>
                                    <input type="radio" id="email-status-public" name="email" value="public" <?php echo (isset($email_status) && $email_status == "public") ? 'checked' : ''; ?>>
                                    <label for="email-status-public" class="radio-label">Public</label>
                                </div>
                            </div>
                            <span class="error-message" id="emailstatusError" style="color: red;"></span>
                        </div>
                        <div class="input-group in-1-col d-flex " style="align-items: center; margin-top: 20px; cursor: pointer;"  data-bs-toggle="modal" data-bs-target="#email-add-sucess">

                            <img src="./images/add-2.svg" alt="">
                            <span style="padding-left: 5px; font-weight: 600; color: #7649B3; font-size: 14px;">
                                Add More Email
                            </span>

                        </div>
                        <div class="table-wrapper in-1-col">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width: 60%">Email</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><?php echo htmlspecialchars($email); ?></td>
                                    <td>
                    <span class="primary-email">
                        Primary Email
                    </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td><?php echo htmlspecialchars($email); ?></td>
                                    <td>
                    <span class="primary-email active">
                        Make it Primary
                    </span>
                                        <span style="cursor: pointer;">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.949219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7994 10.4272C19.0036 10.4272 19.1736 10.5967 19.1736 10.8125V11.012C19.1736 11.2225 19.0036 11.3974 18.7994 11.3974H10.0984C9.89366 11.3974 9.72363 11.2225 9.72363 11.012V10.8125C9.72363 10.5967 9.89366 10.4272 10.0984 10.4272H11.6292C11.9401 10.4272 12.2107 10.2061 12.2807 9.8943L12.3608 9.53625C12.4854 9.04853 12.8954 8.72461 13.3647 8.72461H15.5326C15.9967 8.72461 16.4113 9.04853 16.5313 9.51053L16.6171 9.89377C16.6865 10.2061 16.9572 10.4272 17.2686 10.4272H18.7994ZM18.0214 17.7196C18.1812 16.2302 18.4611 12.6917 18.4611 12.656C18.4713 12.5479 18.436 12.4455 18.3661 12.3631C18.291 12.2859 18.1961 12.2402 18.0914 12.2402H10.8093C10.7042 12.2402 10.6041 12.2859 10.5346 12.3631C10.4642 12.4455 10.4295 12.5479 10.4346 12.656C10.4355 12.6626 10.4456 12.7872 10.4623 12.9956C10.5369 13.9213 10.7446 16.4996 10.8788 17.7196C10.9738 18.6184 11.5635 19.1833 12.4177 19.2038C13.0769 19.219 13.756 19.2242 14.4504 19.2242C15.1044 19.2242 15.7687 19.219 16.4483 19.2038C17.3321 19.1885 17.9214 18.6336 18.0214 17.7196Z" fill="white"/>
                        </svg>
                    </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="input-group in-1-col" <?php if ($_SESSION["ptid"] == 6) echo 'hidden'; ?>>
                            <label>Language Fluency<span style="color: #EF1D26;">*</span></label>
                            <input type="text" placeholder="Enter Language Fluency" value="<?php echo (isset($languageSpoken)) ? $languageSpoken : ''; ?>" name="language" id="language">
                            <span class="error-message" id="languageError" style="color: red;"></span>
                        </div>
                    </div>
                </div>

                <div class="business-overview <?php if ($_SESSION["ptid"] == 6) echo 'hidden'; ?>">
                    <div class="sub-heading">
                        Location Information
                    </div>
                    <div class="input-wrapper">

                        <div class="input-group in-1-col">
                            <label>Street Address<span style="color: #EF1D26;">*</span></label>
                            <input type="text" placeholder="Enter Street Address*" value="<?php echo $address_city; ?>" name="address" id="address">
                            <span class="error-message" id="addressError" style="color: red;"></span>
                        </div>
                        <div class="input-group in-4-col" >
                            <label>Country<span style="color: #EF1D26;">*</span></label>
                            <select class="form-select" id="spUserCountry"aria-label="Default select example"name="country" >
                                <option selected>Select Country</option>
                                <?php
                                $Country = $t->readCountry();
                                foreach ($Country['data'] as $rows): ?>
                                    <option value="<?= htmlspecialchars($rows['country_id']) ?>" <?php echo ($rows['country_id'] == $country) ? 'selected' : ''; ?>>
                                        <?= htmlspecialchars($rows['country_title']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <span class="error-message" id="spUserCountryError" style="color: red;"></span>
                        </div>
                        <div class="input-group in-4-col" >
                            <label>State<span style="color: #EF1D26;">*</span></label>
                            <select class="form-select" aria-label="Default select example" id="spUserState" name="spUserState" >
                                <option value="0" selected>Select State</option>

                            </select>
                            <span class="error-message" id="spUserStateError" style="color: red;"></span>
                        </div>
                        <div class="input-group in-4-col" >
                            <label>City<span style="color: #EF1D26;">*</span></label>
                            <select class="form-select" aria-label="Default select example" id="spUserCity" name="spUserCity">
                                <option value="0" selected>Select City</option>
                            </select>
                            <span class="error-message" id="spUserCityError" style="color: red;"></span>
                        </div>
                        <div class="input-group in-4-col">
                            <label>Postal Code</label>
                            <input type="text" placeholder="Enter Postal Code" name="postalcode" value="<?php echo $postalCode ?>" id="postalcode">
                            <span class="error-message" id="postalcodeError" style="color: red;"></span>
                        </div>

                    </div>
                </div>
                <div class="business-overview">
                    <div class="sub-heading">
                        Marketplace Information
                    </div>
                    <div class="input-wrapper">

                        <div class="input-group in-1-col">
                            <label>Store Name<span style="color: #EF1D26;">*</span></label>
                            <input type="text" placeholder="Enter Store Name" value="<?php echo $companyname ?>"name="store" id="store">
                            <span class="error-message" id="storeError" style="color: red;"></span>
                        </div>
                        <div class="input-group in-1-col" <?php if ($_SESSION["ptid"] == 6) echo 'hidden'; ?>>
                            <label>Tag Line For Your Store<span style="color: #EF1D26;">*</span></label>
                            <input type="text" placeholder="Enter tag line" value="<?php echo $companytagline ?>" name="tagline" id="tagline">
                            <span class="error-message" id="taglineError" style="color: red;"></span>
                        </div>

                    </div>
                </div>
                <div class="business-overview <?php if ($_SESSION["ptid"] == 6) echo 'hidden'; ?>">
                    <div class="sub-heading">
                        About Myself
                    </div>
                    <div class="input-wrapper">

                        <div class="input-group in-1-col">
                            <label>About Me<span style="color: #EF1D26;">*</span></label>
                            <textarea  id="about" placeholder="Type About Me" name="about" rows="4" cols="50" value="<?php echo (isset($about)) ? $about : ''; ?>"><?php echo (isset($about)) ? $about : ''; ?></textarea>
                            <span class="error-message" id="aboutError" style="color: red;"></span>
                        </div>
                        <div class="input-group in-1-col">
                            <label>Hobbies<span style="color: #EF1D26;">*</span></label>
                            <textarea id="hobby" placeholder="Type Hobbies" rows="4" cols="50" name="hobbies" value="<?php echo (isset($sphobbies)) ? $sphobbies : ''; ?>"><?php echo (isset($sphobbies)) ? $sphobbies : ''; ?></textarea>
                            <span class="error-message" id="hobbyError" style="color: red;"></span>
                        </div>
                    </div>
                </div>
                <div class="business-overview"<?php if ($_SESSION["ptid"] == 6) echo 'hidden'; ?>>
                    <div class="sub-heading">
                        Education
                    </div>
                    <div class="input-wrapper">

                        <div class="input-group in-4-col">
                            <label>School/College<span style="color: #EF1D26;">*</span></label>
                            <input type="text" id="schoolCollege" placeholder="Enter School/College" name="school">
                            <span class="error-message" id="schoolError" style="color: red;"></span>
                        </div>
                        <div class="input-group in-4-col">
                            <label>Degree<span style="color: #EF1D26;">*</span></label>
                            <input type="text" id="degree" placeholder="Enter degree" name="degree">
                            <span class="error-message" id="degreeError" style="color: red;"></span>
                        </div>
                        <div class="input-group in-4-col">
                            <label>Field of Study<span style="color: #EF1D26;">*</span></label>
                            <input type="text" id="fieldOfStudy" placeholder="Enter field" name="fieldofstudy">
                            <span class="error-message" id="studyError" style="color: red;"></span>
                        </div>
                        <div class="input-group in-4-col" >
                            <label>Year</label>
                            <select class="form-select" id="yearSelect"  onfocus="populateYears()" aria-label="Default select example"name="year" >
                                <option selected>Select Year</option>
                            </select>
                            <span class="error-message" id="yearError" style="color: red;"></span>
                        </div>
                        <div class="input-group in-1-col d-flex " style="align-items: center;">
                        <input type="hidden" id="editIndex" value="">
                            <img src="./images/add-2.svg" alt="">
                            <span id="addButton" style="padding-left: 5px; font-weight: 600; color: #7649B3; font-size: 14px;cursor: pointer;">
                                Add
                            </span>

                        </div>
                        <div class="table-wrapper in-1-col">
                            <table>
                                <thead>
                                    <tr>
                                        <th>School/College</th>
                                        <th>Degree</th>
                                        <th>Field of Study</th>
                                        <th>Year</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="educationTableBody">
                                <?php foreach ($data as $row): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['school']); ?></td>
                                        <td><?php echo htmlspecialchars($row['empdegree']); ?></td>
                                        <td><?php echo htmlspecialchars($row['study']); ?></td>
                                        <td><?php echo htmlspecialchars($row['year']); ?></td>
                                        <td>
                    <span style="cursor: pointer;">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" data-id="<?php echo $row['id']; ?>" onclick="editRow(this)">
                            <rect x="0.699219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                            <path d="M19.0325 12.445L12.765 18.731C12.4391 19.0477 12.0107 19.2246 11.5637 19.2246H9.3752C9.25413 19.2246 9.14238 19.178 9.05857 19.0942C8.97475 19.0104 8.9375 18.8987 8.9375 18.7776L8.99338 16.5705C9.00269 16.1328 9.17963 15.7231 9.48695 15.4157L13.9291 10.9736C14.0036 10.8991 14.134 10.8991 14.2085 10.9736L15.7637 12.5195C15.8662 12.6219 16.0152 12.6871 16.1735 12.6871C16.518 12.6871 16.7881 12.4078 16.7881 12.0725C16.7881 11.9049 16.7229 11.7559 16.6205 11.6441C16.5926 11.6069 15.1118 10.1355 15.1118 10.1355C15.0187 10.0423 15.0187 9.88403 15.1118 9.79091L15.7358 9.15765C16.3132 8.58026 17.2444 8.58026 17.8218 9.15765L19.0325 10.3683C19.6006 10.9364 19.6006 11.8676 19.0325 12.445Z" fill="white"/>
                        </svg>
                    </span>
                        <span style="cursor: pointer;">
                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="delete-button" data-id="<?php echo $row['id']; ?>">
                           <rect x="0.949219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7994 10.4272C19.0036 10.4272 19.1736 10.5967 19.1736 10.8125V11.012C19.1736 11.2225 19.0036 11.3974 18.7994 11.3974H10.0984C9.89366 11.3974 9.72363 11.2225 9.72363 11.012V10.8125C9.72363 10.5967 9.89366 10.4272 10.0984 10.4272H11.6292C11.9401 10.4272 12.2107 10.2061 12.2807 9.8943L12.3608 9.53625C12.4854 9.04853 12.8954 8.72461 13.3647 8.72461H15.5326C15.9967 8.72461 16.4113 9.04853 16.5313 9.51053L16.6171 9.89377C16.6865 10.2061 16.9572 10.4272 17.2686 10.4272H18.7994ZM18.0214 17.7196C18.1812 16.2302 18.4611 12.6917 18.4611 12.656C18.4713 12.5479 18.436 12.4455 18.3661 12.3631C18.291 12.2859 18.1961 12.2402 18.0914 12.2402H10.8093C10.7042 12.2402 10.6041 12.2859 10.5346 12.3631C10.4642 12.4455 10.4295 12.5479 10.4346 12.656C10.4355 12.6626 10.4456 12.7872 10.4623 12.9956C10.5369 13.9213 10.7446 16.4996 10.8788 17.7196C10.9738 18.6184 11.5635 19.1833 12.4177 19.2038C13.0769 19.219 13.756 19.2242 14.4504 19.2242C15.1044 19.2242 15.7687 19.219 16.4483 19.2038C17.3321 19.1885 17.9214 18.6336 18.0214 17.7196Z" fill="white"/>
                        </svg>
                    </span>
                       </td>
                         </tr>
                           <?php endforeach; ?>
                              </tbody>
                            </table>
                        </div>

                    </div>
                </div>
                <div class="experience">
                    <div class="sub-heading">
                        Experience
                    </div>
                    <div class="w-100 d-flex" style="align-items: center; margin-bottom: 20px; cursor: pointer;"   data-bs-toggle="modal" data-bs-target="#add-experience">
                        <img src="./images/add-2.svg" alt="">
                        <span style="padding-left: 5px; font-weight: 600; color: #7649B3; font-size: 14px;">
                            Add
                        </span>
                    </div>
                     <div class="experiences">
                       <?php foreach ($experiences as $experience) : ?>
                        <div class="bold-title" style="margin-bottom: 5px;">
                          <?php echo $experience['jobtitle']; ?>
                            <div class="icon">
                <span style="cursor: pointer;">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect x="0.699219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                        <path d="M19.0325 12.445L12.765 18.731C12.4391 19.0477 12.0107 19.2246 11.5637 19.2246H9.3752C9.25413 19.2246 9.14238 19.178 9.05857 19.0942C8.97475 19.0104 8.9375 18.8987 8.9375 18.7776L8.99338 16.5705C9.00269 16.1328 9.17963 15.7231 9.48695 15.4157L13.9291 10.9736C14.0036 10.8991 14.134 10.8991 14.2085 10.9736L15.7637 12.5195C15.8662 12.6219 16.0152 12.6871 16.1735 12.6871C16.518 12.6871 16.7881 12.4078 16.7881 12.0725C16.7881 11.9049 16.7229 11.7559 16.6205 11.6441C16.5926 11.6069 15.1118 10.1355 15.1118 10.1355C15.0187 10.0423 15.0187 9.88403 15.1118 9.79091L15.7358 9.15765C16.3132 8.58026 17.2444 8.58026 17.8218 9.15765L19.0325 10.3683C19.6006 10.9364 19.6006 11.8676 19.0325 12.445Z" fill="white"/>
                    </svg>
                </span>
                  <span style="cursor: pointer;">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="delete-buttons" data-id="<?php echo $experience['id']; ?>">
                        <rect x="0.949219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7994 10.4272C19.0036 10.4272 19.1736 10.5967 19.1736 10.8125V11.012C19.1736 11.2225 19.0036 11.3974 18.7994 11.3974H10.0984C9.89366 11.3974 9.72363 11.2225 9.72363 11.012V10.8125C9.72363 10.5967 9.89366 10.4272 10.0984 10.4272H11.6292C11.9401 10.4272 12.2107 10.2061 12.2807 9.8943L12.3608 9.53625C12.4854 9.04853 12.8954 8.72461 13.3647 8.72461H15.5326C15.9967 8.72461 16.4113 9.04853 16.5313 9.51053L16.6171 9.89377C16.6865 10.2061 16.9572 10.4272 17.2686 10.4272H18.7994ZM18.0214 17.7196C18.1812 16.2302 18.4611 12.6917 18.4611 12.656C18.4713 12.5479 18.436 12.4455 18.3661 12.3631C18.291 12.2859 18.1961 12.2402 18.0914 12.2402H10.8093C10.7042 12.2402 10.6041 12.2859 10.5346 12.3631C10.4642 12.4455 10.4295 12.5479 10.4346 12.656C10.4355 12.6626 10.4456 12.7872 10.4623 12.9956C10.5369 13.9213 10.7446 16.4996 10.8788 17.7196C10.9738 18.6184 11.5635 19.1833 12.4177 19.2038C13.0769 19.219 13.756 19.2242 14.4504 19.2242C15.1044 19.2242 15.7687 19.219 16.4483 19.2038C17.3321 19.1885 17.9214 18.6336 18.0214 17.7196Z" fill="white"/>
                    </svg>
                </span>
                     </div>
                        </div>
                           <div class="title">
                             <?php echo $experience['company']; ?> · <?php echo $experience['emptype']; ?> </br>
                             <?php echo $experience['frommonth'] . ' ' . $experience['fromyear'] . ' - ' . $experience['tomonth'] . ' ' . $experience['toyear']; ?> </br>
                             <?php echo $experience['city'] . ', ' . $experience['state'] . ', ' . $experience['country']; ?> · On-site
                           </div>
                           <div class="text" style="margin-bottom: 10px;">
                             <?php echo $experience['description']; ?>
                           </div>
                             <?php endforeach; ?>
                         <a class="view-all" href="#">
                             View All <?php echo count($experiences); ?> experiences
                         </a>
                     </div>
                <div class="main-btns" style="margin-top: 30px;">
                    <button id="cancel">CANCEL</button>
                    <button type="button" class="active" id="createprofile">CREATE PROFILE</button>
                </div>
            </form>
        </div>
    </div>
    <div class="modal modal-2" id="email-add-sucess" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Add & Confirm Your Email</h1>
                </div>
                <div class="modal-body">
                    <form action="">
                        <div class="input-group in-1-col">
                            <label>Enter New Email </label>
                            <input type="text" placeholder="Enter New Email ">
                        </div>
                        <div class="input-group verify-wrapper">
                            <label>Enter the code we sent to your registered email address</label>
                            <div class="verify">
                                <input type="text" placeholder="Enter Code">
                                <div class="verify-btn">
                                    VERIFY
                                </div>
                            </div>
                        </div>
                        <div class="label w-100" style="text-align: center; font-weight: 600; font-size: 14px;">
                            Didn't receive the code? <span style="color: #4A0080;">Send Again</span>

                        </div>
                        <div class="line" style=" margin-left: 10px; height: 0.68px; background:  #E0E0E0; width: calc(100% - 10px);">

                        </div>
                        <div class="input-group verify-wrapper">
                            <label>Enter the code we sent to your new email address</label>
                            <div class="verify">
                                <input type="text" placeholder="Enter Code">
                                <div class="verify-btn">
                                    VERIFY
                                </div>
                            </div>
                        </div>
                        <div class="label w-100" style="text-align: center; font-weight: 600; font-size: 14px;">
                            Didn't receive the code? <span style="color: #4A0080;">Send Again</span>

                        </div>
                        <div class="cong w-100">
                            <div class="d-flex w-100"  style="justify-content: center;">
                                <img src="./images/sucess.svg" alt="">
                            </div>
                            <div class="d-flex w-100"  style="justify-content: center; margin-top: 20px;">
                                <img src="./images/Congratulations!.svg" alt="">
                            </div>
                        </div>
                        <div class="w-100 succ-messg">
                            Your Email is Successfully Verified!
                        </div>
                        <div class="cong w-100">
                            <div class="d-flex w-100"  style="justify-content: center;">
                                <img src="./images/failed.svg" alt="">
                            </div>

                        </div>
                        <div class="w-100 succ-messg">
                            Your Email Is Not Verified Yet!
                        </div>
                        <div class="text" style="font-size: 12px; color: #595959; padding: 0px 40px ; text-align: center;">
                            Enter the code we sent to your email address amelia.joseph@gmail.com
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-primary" data-bs-dismiss="modal">CONTINUE</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-3" id="add-experience" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Experience Details</h1>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id="experience-form">
                        <div class="input-group in-1-col">
                            <label>Job Title</label>
                            <input type="text" placeholder="Enter Job Title" name="jobtitle">
                        </div>
                        <div class="input-group in-2-col" >
                            <label>Employment Type</label>
                            <select class="form-select" aria-label="Default select example" name="emptype">
                                <option selected>Select Employment Type</option>
                                <option value="Permanent">Permanent</option>
                                <option value="Part-Time">Part-Time</option>
                                <option value="Contract">Contract</option>
                                <option value="Contract">Voluntary</option>
                            </select>
                        </div>
                        <div class="input-group in-2-col">
                            <label>Company Name</label>
                            <input type="text" placeholder="Enter Company Name" name="compnyname">
                        </div>

                        <div class="input-group in-3-col" >
                            <label>Country</label>
                             <select class="form-select" id="spUserCountry"aria-label="Default select example" name="country">
                                <option selected>Select Country</option>
                                <?php
                                $Country = $t->readCountry();
                                foreach ($Country['data'] as $rows): ?>
                                    <option value="<?= htmlspecialchars($rows['country_id']) ?>">
                                        <?= htmlspecialchars($rows['country_title']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="input-group in-3-col" >
                            <label>State</label>
                            <select class="form-select" aria-label="Default select example" id="spUserStates" name="state">
                                <option value="0" selected>Select State</option>
                            </select>
                        </div>
                        <div class="input-group in-3-col" >
                            <label>City</label>
                            <select class="form-select" aria-label="Default select example"  id="spUserCitys" name="city">
                                <option value="0" selected>Select City</option>
                            </select>
                        </div>
                        <div class="check-box">
                            <label class="main-container"> This is my current job
                                <input type="checkbox" checked="checked" name="checked">
                                <span class="checkmark"></span>
                            </label>
                        </div>
                        <div class="input-group in-2-col" >
                            <label>End Month</label>
                            <select class="form-select" aria-label="Default select example" name="emonth">
                                <option selected>Select End Month</option>
                                <option value="1">January</option>
                                <option value="2">February</option>
                                <option value="3">March</option>
                                <option value="4">April</option>
                                <option value="5">May</option>
                                <option value="6">June</option>
                                <option value="7">July</option>
                                <option value="8">August</option>
                                <option value="9">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div class="input-group in-2-col" >
                            <label>End Year</label>
                            <select class="form-select" aria-label="Default select example" id="yearSelects" onclick="populateYear()" name="eyear">
                                <option value="0"selected>Select End Year</option>
                            </select>
                        </div>
                        <div class="input-group in-1-col">
                            <label>Job Description</label>
                            <textarea  placeholder="Type Career Highlights.." rows="4" cols="50" name="description"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                  <button type="button" id="save-btn" class="btn btn-primary active">SAVE</button>
                </div>
            </div>
        </div>
    </div>
        <script src="../assets/js/posting/timeline.js"></script>
        <script src="../assets/js/editprofile.js"></script>
</body>
</html>
