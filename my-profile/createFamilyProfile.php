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
    Family Member
</div>
<div class="input-wrapper">
    <div class="input-group in-2-col">
        <label>Member Name<span style="color: #EF1D26;">*</span></label>
        <input type="text" class="form-control" id="memberName" placeholder="Enter Member Name" aria-label="Member Name">
        <span class="error-message" id="error-memberName" style="color: red;"></span>
    </div>
    <div class="input-group in-2-col">
        <label>Relation Type<span style="color: #EF1D26;">*</span></label>
        <select class="form-select" id="relationType" aria-label="Default select example">
          <option value="">Choose relationship</option>
          <option value="Mother">Mother</option>
          <option value="Father">Father</option>
          <option value="Daughter">Daughter</option>
          <option value="Son">Son</option>
          <option value="Sister">Sister</option>
          <option value="Brother">Brother</option>
          <option value="Auntie">Auntie</option>
          <option value="Uncle">Uncle</option>
          <option value="Niece">Niece</option>
          <option value="Nephew">Nephew</option>
          <option value="Cousin">Cousin</option>
          <option value="Grandmother">Grandmother</option>
          <option value="Grandfather">Grandfather</option>
          <option value="Granddaughter">Granddaughter</option>
          <option value="Grandson">Grandson</option>
          <option value="Stepsister">Stepsister</option>
          <option value="Stepbrother">Stepbrother</option>
          <option value="Stepmother">Stepmother</option>
          <option value="Stepfather">Stepfather</option>
          <option value="Stepdaughter">Stepdaughter</option>
          <option value="Stepson">Stepson</option>
          <option value="Sister-in-law">Sister-in-law</option>
          <option value="Brother-in-law">Brother-in-law</option>
          <option value="Mother-in-law">Mother-in-law</option>
          <option value="Father-in-law">Father-in-law</option>
          <option value="Daughter-in-law">Daughter-in-law</option>
          <option value="Son-in-law">Son-in-law</option>
        </select>
        <span class="error-message" id="error-relationType" style="color: red;"></span>
    </div>
    <div class="input-group in-1-col d-flex" style="align-items: center;">
        <img src="../assets/images/add-3.svg" alt="" onclick="addFamilyMember()">
        <span style="padding-left: 5px; font-weight: 600; color: #7649B3; font-size: 14px;">
            Add
        </span>
    </div>
    <div id="famTable" class="table-wrapper in-1-col">
      <table id="familyTable">
        <thead>
        <tr>
          <th>Family Member Name</th>
          <th style="width: 50%;">Relation Type</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody id="famTableBody">
        <?php
        if(isset($fam_members) && count($fam_members) > 0){ 
          foreach ($fam_members as $row){ 
        ?>
        <tr>
          <td><?php echo $row['family_name']; ?></td>
          <td><?php echo $row['family_relation']; ?></td>
          <td>
            <span style="cursor: pointer;">
              <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" data-id="<?php echo $row['id']; ?>" onclick="editRow(this, 'family')">
              <rect x="0.699219" y="0.474609" width="27" height="27" rx="13.5" fill="#7649B3"/>
              <path d="M19.0325 12.445L12.765 18.731C12.4391 19.0477 12.0107 19.2246 11.5637 19.2246H9.3752C9.25413 19.2246 9.14238 19.178 9.05857 19.0942C8.97475 19.0104 8.9375 18.8987 8.9375 18.7776L8.99338 16.5705C9.00269 16.1328 9.17963 15.7231 9.48695 15.4157L13.9291 10.9736C14.0036 10.8991 14.134 10.8991 14.2085 10.9736L15.7637 12.5195C15.8662 12.6219 16.0152 12.6871 16.1735 12.6871C16.518 12.6871 16.7881 12.4078 16.7881 12.0725C16.7881 11.9049 16.7229 11.7559 16.6205 11.6441C16.5926 11.6069 15.1118 10.1355 15.1118 10.1355C15.0187 10.0423 15.0187 9.88403 15.1118 9.79091L15.7358 9.15765C16.3132 8.58026 17.2444 8.58026 17.8218 9.15765L19.0325 10.3683C19.6006 10.9364 19.6006 11.8676 19.0325 12.445Z" fill="white"/>
              </svg>
            </span>
            <span style="cursor: pointer;">
              <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" class="delete-button" onclick="deleteElement(this, 'family')" data-id="<?php echo $row['id']; ?>">
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
<div class="business-overview">
    <div class="sub-heading">
        Overview
    </div>
    <div class="input-wrapper">
        <div class="input-group in-1-col">
            <label>Store Name<span style="color: #EF1D26;">*</span></label>
            <input type="text" placeholder="Enter Store Name" id="spDynamicWholesell" name="spDynamicWholesell" value="<?php if(isset($spProfile_storename)) { echo $spProfile_storename; } ?>" required>
            <span class="error-message" id="error-spDynamicWholesell"></span>
        </div>
        <div class="input-group in-1-col">
            <label>My Interest<span style="color: #EF1D26;">*</span></label>
            <textarea  placeholder="Type My Interest.." rows="4" cols="50" id= "choice_"name="choice_" required><?php if(isset($fam_interest)) { echo $fam_interest; } ?></textarea>
            <span class="error-message" id="error-choice_"></span>
        </div>
        <div class="input-group in-1-col">
            <label>Career In<span style="color: #EF1D26;">*</span></label>
            <textarea  placeholder="Type Career In.." rows="4" cols="50"  id="carrer" name="carrer" required><?php if(isset($fam_career)) { echo $fam_career; } ?></textarea>
             <span class="error-message" id="error-carrer"></span>
        </div>
    </div>
</div>
  <?php
  if(isset($page) && $page == "neweditprofile"){
  ?>
  <div class="main-btns" style="margin-top: 30px;">
    <button id="cancel">CANCEL</button>
    <button type="button" class="active" onclick="validateForm(event,'family', 'update')">UPDATE PROFILE</button>
  </div>
</form>
  <?php
  } else {
  ?>
  <div class="main-btns" style="margin-top: 30px;">
    <button type="button" onclick="cancelForm()">CANCEL</button>
    <button class="active" type="button" onclick="validateForm(event,'family', 'create')">CREATE PROFILE</button>
  </div>
  <?php
  }
  ?>
</div>
</div>
 
