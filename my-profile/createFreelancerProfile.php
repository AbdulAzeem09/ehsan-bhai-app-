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
                        Overview
                    </div>
                    <div class="input-wrapper">
                        <div class="input-group in-2-col">
                            <label>Career Category<span style="color: #EF1D26;">*</span></label>
                             <select class="form-select" id="profiletype_" name="profiletype"   aria-label="Default select example"  required>
                                <option value="0">Select Career Category</option>
                                <?php 
                                $catid = 5;
                                $category = $t->readcategory($catid);
                                foreach ($category['data'] as $rows){ ?>
                                  <option value="<?php echo $rows['idsubCategory']; ?>" <?php if(isset($free_category) && ($free_category == $rows['idsubCategory'])) { echo "selected"; } ?> >
                                    <?php echo $rows['subCategoryTitle']; ?>
                                  </option>
                                <?php } ?>
                            </select>
                            <span class="error-message" id="error-profiletype_"></span>
                        </div>
                        <div class="input-group in-2-col" >
                            <label>Hourly Rate (USD)<span style="color: #EF1D26;">*</span></label>
                            <div class="w-100 d-flex" style="align-items: center;">
                                <span style="margin-top: 5px;">
                                    <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M36.9492 0.0996094H7.54078C5.11469 0.0996094 3.90165 0.0996094 2.99212 0.608973C2.34931 0.968963 1.81857 1.4997 1.45858 2.14251C0.949219 3.05204 0.949219 4.26509 0.949219 6.69117V29.508C0.949219 31.9341 0.949219 33.1472 1.45858 34.0567C1.81857 34.6995 2.34931 35.2303 2.99212 35.5902C3.90165 36.0996 5.11469 36.0996 7.54078 36.0996H36.9492V0.0996094Z" fill="#1F1216"/>
                                        <path d="M24.2067 21.5771C24.2067 22.3571 24.0042 23.0921 23.5992 23.7821C23.2092 24.4571 22.6242 25.0196 21.8442 25.4696C21.0792 25.9046 20.1717 26.1596 19.1217 26.2346V28.0571H17.6817V26.2121C16.1817 26.0771 14.9742 25.6271 14.0592 24.8621C13.1442 24.0821 12.6717 23.0321 12.6417 21.7121H16.0167C16.1067 22.7921 16.6617 23.4446 17.6817 23.6696V19.3721C16.6017 19.1021 15.7317 18.8321 15.0717 18.5621C14.4117 18.2921 13.8417 17.8571 13.3617 17.2571C12.8817 16.6571 12.6417 15.8396 12.6417 14.8046C12.6417 13.4996 13.1067 12.4346 14.0367 11.6096C14.9817 10.7846 16.1967 10.3121 17.6817 10.1921V8.36961H19.1217V10.1921C20.5617 10.3121 21.7092 10.7471 22.5642 11.4971C23.4342 12.2471 23.9217 13.2821 24.0267 14.6021H20.6292C20.5842 14.1671 20.4267 13.7921 20.1567 13.4771C19.9017 13.1471 19.5567 12.9146 19.1217 12.7796V17.0321C20.2467 17.3171 21.1317 17.5946 21.7767 17.8646C22.4367 18.1196 23.0067 18.5471 23.4867 19.1471C23.9667 19.7321 24.2067 20.5421 24.2067 21.5771ZM15.9267 14.6471C15.9267 15.1421 16.0767 15.5471 16.3767 15.8621C16.6767 16.1621 17.1117 16.4096 17.6817 16.6046V12.7121C17.1417 12.7871 16.7142 12.9896 16.3992 13.3196C16.0842 13.6496 15.9267 14.0921 15.9267 14.6471ZM19.1217 23.7146C19.6917 23.6096 20.1342 23.3771 20.4492 23.0171C20.7792 22.6571 20.9442 22.2221 20.9442 21.7121C20.9442 21.2171 20.7867 20.8196 20.4717 20.5196C20.1567 20.2196 19.7067 19.9721 19.1217 19.7771V23.7146Z" fill="white"/>
                                    </svg>
                                </span>
                                <input type="number" id="hourlyrate_" name="hourlyrate" placeholder="Enter Hourly Rate (USD)" value="<?php if(isset($free_hourly_rate)) { echo $free_hourly_rate; } ?>">
                            </div>
                            <span class="error-message" id="error-hourlyrate_"></span>
                        </div>
                        <div class="input-group in-2-col">
                            <label>Language Fluency<span style="color: #EF1D26;">*</span></label>
                            <input type="text" id="languagefluency_" name="languagefluency" placeholder="Enter Language Fluency" value="<?php if(isset($free_language_fluency)) { echo $free_language_fluency; } ?>">
                            <span class="error-message" id="error-languagefluency_"></span>
                        </div>
                        <div class="input-group in-2-col">
                            
                            <label>Available From<span style="color: #EF1D26;"></span></label>
                            <div class="w-100 d-flex" style="align-items: center; position: relative;">
                                <input type="text"  id="availableForm" name="availablefrom" placeholder="Enter Available From" value="<?php if(isset($free_available_from)) { echo $free_available_from; } ?>">
                                <span style="margin-top: 5px;">
                                    <svg id="datepicker-icon" width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.949219 0.599609H30.3577C32.7837 0.599609 33.9968 0.599609 34.9063 1.10897C35.5491 1.46896 36.0799 1.9997 36.4399 2.64251C36.9492 3.55204 36.9492 4.76509 36.9492 7.19117V30.008C36.9492 32.4341 36.9492 33.6472 36.4399 34.5567C36.0799 35.1995 35.5491 35.7303 34.9063 36.0902C33.9968 36.5996 32.7837 36.5996 30.3577 36.5996H0.949219V0.599609Z" fill="#1F1216"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M25.6594 10.9199H24.5451V9.10303H23.0916V10.9199H14.8068V9.10303H13.3533V10.9199H12.2389C11.5322 10.9199 10.8544 11.2006 10.3547 11.7004C9.85496 12.2001 9.57422 12.8779 9.57422 13.5846V25.4305C9.57422 26.1372 9.85496 26.815 10.3547 27.3147C10.8544 27.8144 11.5322 28.0952 12.2389 28.0952H25.6594C26.3661 28.0952 27.0439 27.8144 27.5436 27.3147C28.0434 26.815 28.3241 26.1372 28.3241 25.4305V13.5846C28.3241 12.8779 28.0434 12.2001 27.5436 11.7004C27.0439 11.2006 26.3661 10.9199 25.6594 10.9199ZM12.2632 12.3734H13.3775V13.948H14.831V12.3734H23.0916V13.948H24.5451V12.3734H25.6594C25.9806 12.3734 26.2887 12.501 26.5159 12.7281C26.743 12.9553 26.8706 13.2634 26.8706 13.5846V15.0623H11.0277V13.5846C11.0277 13.2634 11.1553 12.9553 11.3825 12.7281C11.6096 12.501 11.9177 12.3734 12.2389 12.3734H12.2632ZM25.6594 26.6417H12.2389C11.9177 26.6417 11.6096 26.5141 11.3825 26.2869C11.1553 26.0598 11.0277 25.7517 11.0277 25.4305V16.5158H26.8706V25.4305C26.8706 25.5895 26.8393 25.747 26.7784 25.894C26.7176 26.0409 26.6284 26.1745 26.5159 26.2869C26.4034 26.3994 26.2699 26.4886 26.1229 26.5495C25.976 26.6104 25.8185 26.6417 25.6594 26.6417ZM20.5479 17.9199H17.3745V21.0909H20.5479V17.9199ZM12.8687 17.9214H16.0421V21.0924H12.8687V17.9214ZM25.0538 17.9199H21.8804V21.0909H25.0538V17.9199ZM17.3745 22.0391H20.5479V25.2101H17.3745V22.0391ZM16.0421 22.039H12.8686V25.21H16.0421V22.039ZM21.8804 22.0391H25.0538V25.2101H21.8804V22.0391Z" fill="white"/>
                                    </svg>
                                </span>
                            </div>
                            <span class="error-message" id="error-availablefrom"></span>
                        </div>
                        <div class="input-group in-1-col">
                            <label>Personal Website<span style="color: #EF1D26;"></span></label>
                            <input type="text" id="personalwebsite_" name="personalwebsite" placeholder="Enter Personal Website" value="<?php if(isset($free_personal_website)) { echo $free_personal_website; } ?>">
                            <span class="error-message" id="error-personalwebsite_"></span>
                        </div>
                        <div class="input-group in-1-col">
                            <label>Skills (Each skill separated with comma)<span style="color: #EF1D26;">*</span></label>
                            <input type="text" id="skill_" name="skill" placeholder="Enter Skills" value="<?php if(isset($free_skill)) { echo $free_skill; } ?>">
                            <span class="error-message" id="error-skill_"></span>
                        </div>
                        <div class="input-group in-1-col">
                            <label>Certification(s)<span style="color: #EF1D26;"></span></label>
                            <textarea  placeholder="Type Certification(s)" id="certification_" name="certification" rows="4" cols="50"><?php if(isset($free_certification)) { echo $free_certification; } ?></textarea>
                            <span class="error-message" id="error-certification_"></span>
                        </div>
                        <div class="input-group in-1-col">
                            <label>Project Worked<span style="color: #EF1D26;"></span></label>
                            <textarea  placeholder="Type Project Worked.." id="projectworked_" name="projectworked" rows="4" cols="50"><?php if(isset($free_project_worked)) { echo $free_project_worked; } ?></textarea>
                            <span class="error-message" id="error-projectworked_"></span>
                        </div>
                        <div class="input-group in-1-col">
                            <label>Working Interests<span style="color: #EF1D26;">*</span></label>
                            <textarea  placeholder="Type Working Interests.." id="workinginterests_" name="workinginterests" rows="4" cols="50"><?php if(isset($free_working_interests)) { echo $free_working_interests; } ?></textarea>
                            <span class="error-message" id="error-workinginterests_"></span>
                        </div>
                        <div class="input-group in-1-col">
                            <label>Overview<span style="color: #EF1D26;">*</span></label>
                            <textarea  placeholder="Type Overview.." id="Overview" name="Overview" rows="4" cols="50"><?php if(isset($free_overview)) { echo $free_overview; } ?></textarea>
                            <span class="error-message" id="error-Overview"></span>
                        </div>
                    </div>
                   
                </div>
                <div class="business-overview">
                    <div class="sub-heading">
                        Education
                    </div>
                    <div class="input-wrapper">
                       
                       
                        <div class="input-group in-4-col">
                            <label>School/College<span style="color: #EF1D26;"></span></label>
                            <input type="text" id="schoolCollege" placeholder="Enter School/College">
                            <span class="error-message" id="error-schoolCollege" style="color: red;"></span>
                        </div>

                        <div class="input-group in-4-col">
                            <label>Degree<span style="color: #EF1D26;"></span></label>
                            <input type="text" id="degree" placeholder="Enter degree">
                            <span class="error-message" id="error-degree" style="color: red;"></span>
                        </div>

                        <div class="input-group in-4-col">
                            <label>Field of Study<span style="color: #EF1D26;"></span></label>
                            <input type="text" id="fieldOfStudy" placeholder="Enter field">
                            <span class="error-message" id="error-fieldOfStudy" style="color: red;"></span>
                        </div>
                        
                        <div class="input-group in-4-col" >
                            <label>Year</label>
                            <select class="form-select" aria-label="Default select example" id="yearSelect">
                                <option selected>Select Year</option>
                            </select>
                            <span class="error-message" id="error-yearSelect" style="color: red;"></span>
                        </div>
                        <div class="input-group in-1-col d-flex addbtn" onclick="addEducation()">
                            <img src="../assets/images/add-3.svg" alt="">
                            <span style="padding-left: 5px; font-weight: 600; color: #7649B3; font-size: 14px;">
                                Add
                            </span>
                           
                        </div>
                        <div id="eduTable" class="table-wrapper in-1-col">
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
                                <?php
                                if(isset($educationData) && count($educationData) > 0){ 
                                  foreach ($educationData as $row){ 
                                ?>
                                <tr>
                                  <td><?php echo $row['school']; ?></td>
                                  <td><?php echo $row['empdegree']; ?></td>
                                  <td><?php echo $row['study']; ?></td>
                                  <td><?php echo $row['year']; ?></td>
                                <td>
                                <span style="cursor: pointer;">
                                  <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" data-id="<?php echo $row['id']; ?>" onclick="editRow(this, 'education')">
                                    <rect x="0.699219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                                    <path d="M19.0325 12.445L12.765 18.731C12.4391 19.0477 12.0107 19.2246 11.5637 19.2246H9.3752C9.25413 19.2246 9.14238 19.178 9.05857 19.0942C8.97475 19.0104 8.9375 18.8987 8.9375 18.7776L8.99338 16.5705C9.00269 16.1328 9.17963 15.7231 9.48695 15.4157L13.9291 10.9736C14.0036 10.8991 14.134 10.8991 14.2085 10.9736L15.7637 12.5195C15.8662 12.6219 16.0152 12.6871 16.1735 12.6871C16.518 12.6871 16.7881 12.4078 16.7881 12.0725C16.7881 11.9049 16.7229 11.7559 16.6205 11.6441C16.5926 11.6069 15.1118 10.1355 15.1118 10.1355C15.0187 10.0423 15.0187 9.88403 15.1118 9.79091L15.7358 9.15765C16.3132 8.58026 17.2444 8.58026 17.8218 9.15765L19.0325 10.3683C19.6006 10.9364 19.6006 11.8676 19.0325 12.445Z" fill="white"/>
                                  </svg>
                                </span>
                                <span style="cursor: pointer;">
                                  <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="delete-button" onclick="deleteElement(this, 'education')" data-id="<?php echo $row['id']; ?>">
                                    <rect x="0.949219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.7994 10.4272C19.0036 10.4272 19.1736 10.5967 19.1736 10.8125V11.012C19.1736 11.2225 19.0036 11.3974 18.7994 11.3974H10.0984C9.89366 11.3974 9.72363 11.2225 9.72363 11.012V10.8125C9.72363 10.5967 9.89366 10.4272 10.0984 10.4272H11.6292C11.9401 10.4272 12.2107 10.2061 12.2807 9.8943L12.3608 9.53625C12.4854 9.04853 12.8954 8.72461 13.3647 8.72461H15.5326C15.9967 8.72461 16.4113 9.04853 16.5313 9.51053L16.6171 9.89377C16.6865 10.2061 16.9572 10.4272 17.2686 10.4272H18.7994ZM18.0214 17.7196C18.1812 16.2302 18.4611 12.6917 18.4611 12.656C18.4713 12.5479 18.436 12.4455 18.3661 12.3631C18.291 12.2859 18.1961 12.2402 18.0914 12.2402H10.8093C10.7042 12.2402 10.6041 12.2859 10.5346 12.3631C10.4642 12.4455 10.4295 12.5479 10.4346 12.656C10.4355 12.6626 10.4456 12.7872 10.4623 12.9956C10.5369 13.9213 10.7446 16.4996 10.8788 17.7196C10.9738 18.6184 11.5635 19.1833 12.4177 19.2038C13.0769 19.219 13.756 19.2242 14.4504 19.2242C15.1044 19.2242 15.7687 19.219 16.4483 19.2038C17.3321 19.1885 17.9214 18.6336 18.0214 17.7196Z" fill="white"/>
                                  </svg>
                                </span>
                              </td>
                            </tr>
                            <?php
                              }
                            }
                            ?>
                            </tbody>
                          </table>
                        </div>
                    </div>
                </div>
                 <div class="experience">
                    <div class="sub-heading">
                        Experience
                    </div>
                    <div class="w-100 d-flex add-exp" style="align-items: center; margin-bottom: 20px; cursor:pointer;" data-bs-toggle="modal" data-bs-target="#add-experience">
                        <img src="../assets/images/add-3.svg" alt="">
                        <span id="addExperienceBtn" style="padding-left: 5px; font-weight: 600; color: #7649B3; font-size: 14px; cursor: pointer;">
                            Add
                        </span>
                    </div>
                    <span id="experience_error" style="display:none;"></span>
                    <div id="experience-entries"></div>
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
                                <input <?php if(!isset($phone_status)){ echo "checked";} ?> type="radio" id="phone-status-private" name="phone_status" value="private" <?php if(isset($phone_status) && ($phone_status == 'private')) { echo "checked"; } ?> required>
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
                                <input <?php if(!isset($profile_status)){ echo "checked";} ?> type="radio" id="profile-status-public" name="profile_status" value="public" <?php if(isset($profile_status) && ($profile_status == 'public')) { echo "checked"; } ?> required>
                                <label for="profile-status-public" class="radio-label">Public</label>
                            </div>
                            <span class="error-message" id="error-profile-status"></span>
                        </div>
                        <div class="phone-status-wrapper radio-box">
                            <label for="" class="label">
                                Email Status<span style="color: #EF1D26;">*</span>
                            </label>
                            <div class="phone-status">
                                <input <?php if(!isset($email_status)){ echo "checked";} ?> type="radio" id="email-status-private" name="email_status" value="private" <?php if(isset($email_status) && ($email_status == 'private')) { echo "checked"; } ?> required>
                                <label for="email-status-private" class="radio-label">Private</label>
                                <input type="radio" id="email-status-public" name="email_status" value="public" <?php if(isset($email_status) && ($email_status == 'public')) { echo "checked"; } ?> required>
                                <label for="email-status-public" class="radio-label">Public</label>
                            </div>
                            <span class="error-message" id="error-email-status"></span>
                        </div>
                       
                    </div>
                    
                </div>
                <?php
                if(isset($page) && $page == "neweditprofile"){
                ?>
                <div class="main-btns" style="margin-top: 30px;">
                  <button id="cancel">CANCEL</button>
                  <button type="button" class="active"  id="updateprofile" onclick="validateForm(event,'freelancer', 'update')" disabled>UPDATE PROFILE</button>
                </div>
                <?php
                } else {
                ?>
                <div class="main-btns" style="margin-top: 30px;">
                  <button type="button" onclick="cancelForm()">CANCEL</button>
                  <button class="active" type="button" onclick="validateForm(event,'freelancer', 'create')">CREATE PROFILE</button>
                </div>
                <?php
                }
                ?>

           
        </div>
    </div>
