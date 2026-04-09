<div class="modal modal-3" id="add-experience" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Experience Details</h1>
          </div>
          <div class="modal-body">
            <form action="" method="POST" id="experience-form">
              <input type="hidden" id="experience-id" name="experience-id">
              <div class="input-group in-1-col">
                <label for="jobTitle">Job Title</label>
                <input type="text" id="jobTitle" placeholder="Enter Job Title" name="jobtitle">
                <span class="error-message" id="error-jobTitle" style="color:red;"></span>
              </div>
              <div class="input-group in-2-col">
                <label for="employmentType">Employment Type</label>
                <select class="form-select" id="employmentType" aria-label="Default select example" name="emptype">
                  <option value="">Select Employment Type</option>
                  <option value="Permanent">Permanent</option>
                  <option value="Part-Time">Part-Time</option>
                  <option value="Contract">Contract</option>
                  <option value="Voluntary">Voluntary</option>
                </select>
                <span class="error-message" id="error-employmentType" style="color:red;"></span>
              </div>
              <div class="input-group in-2-col">
                <label for="companyName">Company Name</label>
                <input type="text" id="companyName" placeholder="Enter Company Name" name="compnyname">
                <span class="error-message" id="error-companyName" style="color:red;"></span>
              </div>
              <div class="input-group in-3-col">
                <label for="spUserCountry">Country</label>
                <select class="form-select" id="spUserCountry" aria-label="Select Country" name="spProfilesCountry" required>
                    <option value="">Select Country</option>
                    <?php 
                    $countries = $t->readCountry();
                    foreach ($countries['data'] as $row): ?>
                       <option value="<?= htmlspecialchars($row['country_id']) ?>">
                          <?= htmlspecialchars($row['country_title']) ?>
                       </option>
                    <?php endforeach; ?>
                </select>
                <span class="error-message" id="error-spUserCountry" style="color:red;" ></span>
              </div>
              <div class="input-group in-3-col">
                <label for="spUserState">State</label>
                <select class="form-select" aria-label="Default select example" id="spUserState" name="spUserState">
                  <option value="">Select State</option>
                </select>
                <span class="error-message" id="error-spUserState" style="color:red;"></span>
              </div>
              <div class="input-group in-3-col">
                <label for="spUserCity">City</label>
                <select class="form-select" aria-label="Default select example" id="spUserCity" name="spUserCity">
                  <option value="">Select City</option>
                </select>
                <span class="error-message" id="error-spUserCity" style="color:red;"></span>
              </div>
              <div class="check-box">
                <label class="main-container"> This is my current job
                  <input type="checkbox" checked="checked" name="checked" id="isCurrentJob">
                  <span class="checkmark"></span>
                </label>
              </div>
              <div class="input-group in-2-col">
                <label for="startMonth">Start Month</label>
                <select class="form-select" id="startMonth" aria-label="Default select example" name="smonth">
                  <option value="">Select Start Month</option>
                  <option value="Jan">January</option>
                  <option value="Feb">February</option>
                  <option value="Mar">March</option>
                  <option value="Apr">April</option>
                  <option value="May">May</option>
                  <option value="Jun">June</option>
                  <option value="Jul">July</option>
                  <option value="Aug">August</option>
                  <option value="Sep">September</option>
                  <option value="Oct">October</option>
                  <option value="Nov">November</option>
                  <option value="Dec">December</option>
                </select>
                <span class="error-message" id="error-startMonth" style="color:red;"></span>
              </div>
              <div class="input-group in-2-col">
                <label for="startYear">Start Year</label>
                <select class="form-select" id="startYear" onfocus="populateYears('startYear', '')" aria-label="Default select example" name="syear">
                  <option value="">Select Start Year</option>
                </select>
                <span class="error-message" id="error-startYear" style="color:red;"></span>
              </div>
              <div class="input-group in-2-col">
                <label for="endMonth">End Month</label>
                <select class="form-select" id="endMonth" aria-label="Default select example" name="emonth">
                  <option value="">Select End Month</option>
                  <option value="Jan">January</option>
                  <option value="Feb">February</option>
                  <option value="Mar">March</option>
                  <option value="Apr">April</option>
                  <option value="May">May</option>
                  <option value="Jun">June</option>
                  <option value="Jul">July</option>
                  <option value="Aug">August</option>
                  <option value="Sep">September</option>
                  <option value="Oct">October</option>
                  <option value="Nov">November</option>
                  <option value="Dec">December</option>
                </select>
                <span class="error-message" id="error-endMonth" style="color:red;"></span>
              </div>
              <div class="input-group in-2-col">
                <label for="endYear">End Year</label>
                <select class="form-select" id="endYear" onfocus="populateYears('endYear', '')" aria-label="Default select example" name="eyear">
                  <option value="">Select End Year</option>
                </select>
                <span class="error-message" id="error-endYear" style="color:red;"></span>
              </div>
              <div class="input-group in-1-col">
                <label for="jobDescription">Job Description</label>
                <textarea id="jobDescription" placeholder="Type Career Highlights.." rows="4" cols="50" name="description"></textarea>
                <span class="error-message" id="error-jobDescription" style="color:red;"></span>
              </div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
            <button type="button" id="saveExperience" class="btn btn-primary active">SAVE</button>
          </div>
        </div>
      </div>
    </div>
