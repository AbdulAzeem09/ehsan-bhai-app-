<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 'On');

require_once("../helpers/start.php");
require_once "../classes/Base.php";
require_once "../classes/CreateProfile.php";
$t = new CreateProfile();
?>
<style>
  .upload_resume_link {
    position: absolute;
    top: 0;
    right: 20px;
    padding: 5px 20px;
    border-radius: 75px;
    background-color: #FB8308;
    color: white;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    text-decoration: none;
}
</style>
        <div class="business-overview">
            <div class="sub-heading">
                Overview
            </div>
            <div class="input-wrapper">
                <div class="input-group in-1-col">
                    <label>Tag Line (Write a catchy phrase to attract employer's attention)<span style="color: #EF1D26;">*</span></label>
                    <input type="text" name="jobSeekProfileTagline" id="jobSeekProfileTagline" placeholder="Enter tag line" value="<?php if(isset($emp_tagline)) { echo $emp_tagline; } ?>" required>
                    <span class="error-message" id="error-jobSeekProfileTagline"></span>
                </div>
                
                <div class="input-group in-2-col">
                    <label>Education Level<span style="color: #EF1D26;">*</span></label>
                    <select class="form-select" aria-label="Default select example"id="spPostingEducationLevel_" name="spPostingEducationLevel"required>
                    <option value="highschool" <?php if(isset($emp_edulevel) && $emp_edulevel == "highschool") { echo "selected"; } ?>>High School</option>
                    <option value="undergraduate" <?php if(isset($emp_edulevel) && $emp_edulevel == "undergraduate") { echo "selected"; } ?>>Under-Graduate</option>
                    <option value="graduate" <?php if(isset($emp_edulevel) && $emp_edulevel == "graduate") { echo "selected"; } ?>>Graduate</option>
                    </select>
                    <span class="error-message" id="error-spPostingEducationLevel_"></span>
                </div>
                <div class="input-group in-2-col">
                    
                    <label>Completed On<span style="color: #EF1D26;">*</span></label>
                    <div class="w-100 d-flex" style="align-items: center; position: relative;">
                        <input type="text" name="graduate" id="graduate" placeholder="Enter Completed On" value="<?php if(isset($emp_graduated)) { echo $emp_graduated; } ?>">
                        <span id="datepicker-icon" style="margin-top: 5px;">
                            <svg width="37" height="37" viewBox="0 0 37 37" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.949219 0.599609H30.3577C32.7837 0.599609 33.9968 0.599609 34.9063 1.10897C35.5491 1.46896 36.0799 1.9997 36.4399 2.64251C36.9492 3.55204 36.9492 4.76509 36.9492 7.19117V30.008C36.9492 32.4341 36.9492 33.6472 36.4399 34.5567C36.0799 35.1995 35.5491 35.7303 34.9063 36.0902C33.9968 36.5996 32.7837 36.5996 30.3577 36.5996H0.949219V0.599609Z" fill="#1F1216"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M25.6594 10.9199H24.5451V9.10303H23.0916V10.9199H14.8068V9.10303H13.3533V10.9199H12.2389C11.5322 10.9199 10.8544 11.2006 10.3547 11.7004C9.85496 12.2001 9.57422 12.8779 9.57422 13.5846V25.4305C9.57422 26.1372 9.85496 26.815 10.3547 27.3147C10.8544 27.8144 11.5322 28.0952 12.2389 28.0952H25.6594C26.3661 28.0952 27.0439 27.8144 27.5436 27.3147C28.0434 26.815 28.3241 26.1372 28.3241 25.4305V13.5846C28.3241 12.8779 28.0434 12.2001 27.5436 11.7004C27.0439 11.2006 26.3661 10.9199 25.6594 10.9199ZM12.2632 12.3734H13.3775V13.948H14.831V12.3734H23.0916V13.948H24.5451V12.3734H25.6594C25.9806 12.3734 26.2887 12.501 26.5159 12.7281C26.743 12.9553 26.8706 13.2634 26.8706 13.5846V15.0623H11.0277V13.5846C11.0277 13.2634 11.1553 12.9553 11.3825 12.7281C11.6096 12.501 11.9177 12.3734 12.2389 12.3734H12.2632ZM25.6594 26.6417H12.2389C11.9177 26.6417 11.6096 26.5141 11.3825 26.2869C11.1553 26.0598 11.0277 25.7517 11.0277 25.4305V16.5158H26.8706V25.4305C26.8706 25.5895 26.8393 25.747 26.7784 25.894C26.7176 26.0409 26.6284 26.1745 26.5159 26.2869C26.4034 26.3994 26.2699 26.4886 26.1229 26.5495C25.976 26.6104 25.8185 26.6417 25.6594 26.6417ZM20.5479 17.9199H17.3745V21.0909H20.5479V17.9199ZM12.8687 17.9214H16.0421V21.0924H12.8687V17.9214ZM25.0538 17.9199H21.8804V21.0909H25.0538V17.9199ZM17.3745 22.0391H20.5479V25.2101H17.3745V22.0391ZM16.0421 22.039H12.8686V25.21H16.0421V22.039ZM21.8804 22.0391H25.0538V25.2101H21.8804V22.0391Z" fill="white"/>
                            </svg>
                        </span>
                    </div>
                    <span class="error-message" id="error-graduate"></span>
                </div>
                <div class="input-group in-2-col">
                    <label>Career Sector<span style="color: #EF1D26;">*</span></label>
                    <select class="form-select" aria-label="Default select example" id="spPostingJobType_" name="spPostingJobType" required>
                        <option value="">Select Selector</option>
                        <?php 
                          $catid = 2;
                          $Category = $t->carrerSector($catid);
                          foreach ($Category['data'] as $row): ?>
                              <option value="<?= $row['idsubCategory'] ?>" <?php if(isset($emp_sector) && $emp_sector == $row['idsubCategory']) { echo "selected"; } ?>>
                                  <?= $row['subCategoryTitle'] ?>
                              </option>
                          <?php endforeach; ?>
                    </select>
                    <span class="error-message" id="error-spPostingJobType_"></span>
                </div>
                <div class="input-group in-2-col">
                    <label>Language Fluency<span style="color: #EF1D26;">*</span></label>
                    <input type="text" placeholder="Enter Language Fluency" id="Language_Fluency" name="language_fluency" value="<?php if(isset($emp_language)) { echo $emp_language; } ?>" required>
                    <span class="error-message" id="error-Language_Fluency"></span>
                </div>
                <div class="input-group in-1-col">
                    <label>Highlight (Enter max 10 skills by pressing enter for multiple)<span style="color: #EF1D26;">*</span></label>
                    <textarea  placeholder="Type Highlight.." rows="4" cols="50" name="skill" id="skill" required><?php if(isset($emp_highlights)) { echo $emp_highlights; } ?></textarea>
                    <span class="error-message" id="error-skill"></span>
                </div>
                <div class="input-group in-1-col">
                    <label>Certification<span style="color: #EF1D26;">*</span></label>
                    <textarea  placeholder="Type Certification" rows="4" cols="50" id="certification_" name="certification"required><?php if(isset($emp_certification)) { echo $emp_certification; } ?></textarea>
                    <span class="error-message" id="error-certification_"></span>
                </div>
                <div class="input-group in-1-col">
                    <label>Achievements<span style="color: #EF1D26;">*</span></label>
                    <textarea  placeholder="Type Achievements.." rows="4" cols="50" id="achievements_" name="achievements" required><?php if(isset($emp_achievements)) { echo $emp_achievements; } ?></textarea>
                    <span class="error-message" id="error-achievements_"></span>
                </div>
                <div class="input-group in-1-col">
                    <label>Hobbies<span style="color: #EF1D26;">*</span></label>
                    <textarea  placeholder="Type Hobbies.." rows="4" cols="50" id="hobbies_" name="hobbies" required><?php if(isset($emp_hobbies)) { echo $emp_hobbies; } ?></textarea>
                    <span class="error-message" id="error-hobbies_"></span>
                </div>
                <div class="input-group in-1-col">
                    <label>References<span style="color: #EF1D26;">*</span></label>
                    <textarea  placeholder="Type References.." rows="4" cols="50"id="references_" name="reference" required><?php if(isset($emp_reference)) { echo $emp_reference; } ?></textarea>
                    <span class="error-message" id="error-references_"></span>
                </div>
            </div>
            
        </div>
        <?php if(isset($page) && $page == "neweditprofile"){ ?> 
          <div class="experience">
            <div class="sub-heading">
                Default Resume <a class="upload_resume_link" href="/job-seeker/my-resume.php">Upload New Resume</a>
            </div>
            <div class="w-100 d-flex">
              <select class="form-select" id="resumeSelectDefault" aria-label="Default select example">
                <option selected>Select Default Resume</option>
                <?php 
                  $resume = $t->getProfileResumes($_SESSION['pid']);
                  if (isset($resume) && count($resume) > 0) {
                    foreach ($resume as $row) {
                        // Construct the file name and URL
                        $fileName = htmlspecialchars($row['fileName']);
                        $resumeUrl = htmlspecialchars($row['resume_url']);
                        $resumeType = htmlspecialchars(pathinfo($row['fileName'], PATHINFO_EXTENSION));
                        // Generate the <option> tag
                      ?>
                        <option <?php if($row['default_resume'] == 1) { echo 'selected';} ?> value="<?= $row['idResume'] ?>" data-resume-url="<?= $resumeUrl ?>" data-resume-type="<?= $resumeType ?>"><?= htmlspecialchars($row['fileName']) ?></option>
                  <?php 
                    }
                  } else {
                    echo '<option disabled>No resumes available</option>';
                  }
                ?>
              </select>
            </div>
          </div>        
        <?php } ?>
        <div class="business-overview">
            <div class="sub-heading">
                Education
            </div>
            <div class="input-wrapper">
                <div class="input-group in-4-col">
                <label>School/College<span style="color: #EF1D26;">*</span></label>
                <input type="text" id="schoolCollege" placeholder="Enter School/College">
                <span class="error-message" id="error-schoolCollege" style="color: red;"></span>
              </div>
              <div class="input-group in-4-col">
                <label>Degree<span style="color: #EF1D26;">*</span></label>
                <input type="text" id="degree" placeholder="Enter degree">
                <span class="error-message" id="error-degree" style="color: red;"></span>
              </div>
              <div class="input-group in-4-col">
                <label>Field of Study<span style="color: #EF1D26;">*</span></label>
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
            <div id="experience-entries"></div>
              <!-- <a class="view-all" href="#">
              View All 5 experiences
              </a> -->
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
                    <input type="radio" id="phone-status-private" <?php if(!isset($phone_status)){ echo "checked";} ?> name="phone_status" <?php if(isset($phone_status) && ($phone_status == 'private')) { echo "checked"; } ?> value="private">
                    <label for="phone-status-private" class="radio-label">Private</label>
                    <input type="radio" id="phone-status-public" name="phone_status" <?php if(isset($phone_status) && ($phone_status == 'public')) { echo "checked"; } ?> value="public">
                    <label for="phone-status-public" class="radio-label">Public</label>
                  </div>
                  <span class="error-message" id="error-phone-status"></span>
              </div>
              <div class="phone-status-wrapper radio-box">
                  <label for="" class="label">
                      Profile Status<span style="color: #EF1D26;">*</span>
                  </label>
                  <div class="phone-status">
                    <input type="radio" id="profile-status-private" <?php if(!isset($profile_status)){ echo "checked";} ?> name="profile_status" <?php if(isset($profile_status) && ($profile_status == 'private')) { echo "checked"; } ?>  value="private">
                    <label for="profile-status-private" class="radio-label">Private</label>
                    <input type="radio" id="profile-status-public" name="profile_status" <?php if(isset($profile_status) && ($profile_status == 'public')) { echo "checked"; } ?>  value="public">
                    <label for="profile-status-public" class="radio-label">Public</label>
                  </div>
                  <span class="error-message" id="error-profile-status"></span>
              </div>
              <div class="phone-status-wrapper radio-box">
                  <label for="" class="label">
                      Email Status<span style="color: #EF1D26;">*</span>
                  </label>
                  <div class="phone-status">
                    <input type="radio" id="email-status-private" <?php if(!isset($email_status)){ echo "checked";} ?> name="email_status" <?php if(isset($email_status) && ($email_status == 'private')) { echo "checked"; } ?> value="private">
                    <label for="email-status-private" class="radio-label">Private</label>
                    <input type="radio" id="email-status-public" name="email_status" <?php if(isset($email_status) && ($email_status == 'public')) { echo "checked"; } ?> value="public">
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
            <button type="button" class="active" onclick="validateForm(event,'employment', 'update')">UPDATE PROFILE</button>
          </div>
        </form>
      <?php
      } else {
      ?>
      <div class="main-btns" style="margin-top: 30px;">
        <button type="button" onclick="cancelForm()">CANCEL</button>
        <button class="active" type="button" onclick="validateForm(event,'employment', 'create')">CREATE PROFILE</button>
      </div>
      <?php
      }
    ?>
  </div>
</div>
   
   
   
   
