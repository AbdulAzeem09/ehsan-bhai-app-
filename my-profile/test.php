<?php 
   session_start();
  include 'includes/header.php'; 
  

	 include('../univ/baseurl.php');
     include( "../univ/main.php");

		function sp_autoloader($class){
			include '../mlayer/' . $class . '.class.php';
		}
		spl_autoload_register("sp_autoloader");

		//$p = new _spprofiles;
		//$rpvt = $p->read($_POST["pid"]);

		//echo "here"; exit;
		$pr = new _spprofiles; 
	

	
		$result  = $pr->read($_POST["pid"]);

			

		//echo $p->ta->sql;
		if ($result != false){
			$sprows = mysqli_fetch_assoc($result);
			$name = $sprows["spProfileName"];
			$email = $sprows["spProfileEmail"];
			$phone = $sprows["spProfileCntryCode"].$sprows["spProfilePhone"];
			$country = $sprows["spProfilesCountry"];
			$state = $sprows['spProfilesState'];
			$city = $sprows["spProfilesCity"];
			$dob = $sprows['spProfilesDob'];
			$about = $sprows["spProfileAbout"];
			$picture = $sprows["spProfilePic"];
			$location = $sprows["spprofilesLocation"];
			$language = $sprows["spprofilesLanguage"];
			$address = $sprows["spprofilesAddress"];
			$postalCode = $sprows['spProfilePostalCode'];
			$relationship_status = $sprows['relationship_status'];
			$phone_status = $sprows['phone_status'];
			$email_status = $sprows['email_status'];
			$address_city = $sprows["address"];
}



		$p = new _spbusiness_profile;

		$rpvt = $p->read($_POST["pid"]);


		//echo $p->ta->sql;
		if ($rpvt != false){
			$row = mysqli_fetch_assoc($rpvt);
			$default = $row['spProfilesDefault'];
			$status = $row['spAccountStatus'];
			$publish = $row['spprofilesPublished'];
           
            // echo "<pre>";
			//print_r($row);
			
		}


      //print_r($_POST["pid"]);

		$f = new _spfreelancer_profile;

		$resfree = $f->read($_POST["pid"]);


		//echo $p->ta->sql;
		if ($resfree != false){
			$row1 = mysqli_fetch_assoc($resfree);
			
           
          /*echo "<pre>";
			print_r($row1);*/
			
		}

		$ps = new _spprofessional_profile;

		$respro = $ps->read($_POST["pid"]);


		//echo $p->ta->sql;
		if ($respro != false){
			$row2 = mysqli_fetch_assoc($respro);
			
           
        }

		$em = new _spemployment_profile;

		$resemp = $em->read($_POST["pid"]);


		
		if ($resemp != false){
			$row4 = mysqli_fetch_assoc($resemp);			
		}

		$fm = new _spfamily_profile;

		$resfam = $fm->read($_POST["pid"]);


		//echo $p->ta->sql;
		if ($resfam != false){
			$row5 = mysqli_fetch_assoc($resfam);
		}




		$pt = new _profiletypes;
		$rpt = $pt->readProfileType($_POST["ptid"]);
		if ($rpt != false)
		{
			$rows = mysqli_fetch_assoc($rpt);
			/*echo "<pre>";
			print_r($rows);*/
		}

?>

<!-- Popup Flayer Data Basic Info Start -->
<div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
        <button class="btn-close btn btn-sm btn-border-radius btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
          <h4 class="mb-1" id="modalExampleDemoLabel">Basic Info </h4>
          <div class="title sg-heading4 float-left cardTitle-RXK7R" role="heading" aria-level="1"> * Required fields</div>
        </div>
        <div class="p-4 pb-0">
          <form>
            <div class="mb-3">
              <label class="col-form-label" for="recipient-name">Profile Name</label>
              <input class="form-control" id="recipient-name" type="text" />
            </div>
            <div class="mb-3">
              <label class="col-form-label" for="recipient-name">Email</label>
              <input class="form-control" id="recipient-name" type="text" />

              <label class="col-form-label" for="recipient-name">Email Status</label>
              <div>
              <input class="form-check-input" id="customRadio4" type="radio" name="listingPrivacy" checked="checked"><label class="form-label mb-0" for="customRadio4"> <strong>Public</strong></label>
                      <div class="form-text mt-0">Discoverable by anyone on Falcon, our distribution partners, and search engines.</div>
            <input class="form-check-input" id="customRadio4" type="radio" name="listingPrivacy" checked="checked"><label class="form-label mb-0" for="customRadio4"> <strong>Public </strong></label>
                      <div class="form-text mt-0">Discoverable by anyone on Falcon, our distribution partners, and search engines.</div>
        
              </div>
              <label class="col-form-label" for="recipient-name">Phone  Status</label>
              <div>
              <input class="form-check-input" id="customRadio4" type="radio" name="listingPrivacy" checked="checked"><label class="form-label mb-0" for="customRadio4"> <strong>Public</strong></label>
                      <div class="form-text mt-0">Discoverable by anyone on Falcon, our distribution partners, and search engines.</div>
            <input class="form-check-input" id="customRadio4" type="radio" name="listingPrivacy" checked="checked"><label class="form-label mb-0" for="customRadio4"> <strong>Public </strong></label>
                      <div class="form-text mt-0">Discoverable by anyone on Falcon, our distribution partners, and search engines.</div>
        
              </div>
              <label class="col-form-label" for="recipient-name">Profile  Status</label>
              <div>
              <input class="form-check-input" id="customRadio4" type="radio" name="listingPrivacy" checked="checked"><label class="form-label mb-0" for="customRadio4"> <strong>Public</strong></label>
                      <div class="form-text mt-0">Discoverable by anyone on Falcon, our distribution partners, and search engines.</div>
            <input class="form-check-input" id="customRadio4" type="radio" name="listingPrivacy" checked="checked"><label class="form-label mb-0" for="customRadio4"> <strong>Public </strong></label>
                      <div class="form-text mt-0">Discoverable by anyone on Falcon, our distribution partners, and search engines.</div>
        
              </div>
                 
            </div>
        
                   
            <div class="mb-3">
              <label class="col-form-label" for="message-text">Tagline:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-border-radius" type="button" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary btn-border-radius" type="button">Update </button>
      </div>
    </div>
  </div>
</div>

<!-- Popup Flayer Data Basic Info End -->

<!-- Popup Flayer Data Experience  Start -->
<div class="modal fade" id="experience-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
        <button class="btn-close btn btn-sm btn-border-radius btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
          <h4 class="mb-1" id="modalExampleDemoLabel">Experience </h4>
          <div class="title sg-heading4 float-left cardTitle-RXK7R" role="heading" aria-level="1"> * Required fields</div>
        </div>
        <div class="p-4 pb-0">
          <form>
            <div class="mb-3">
              <label class="col-form-label" for="recipient-name">Job Post</label>
              <input class="form-control" id="recipient-name" type="text" />
            </div>
            <div class="mb-3">
              <label class="col-form-label" for="recipient-name">Company Name</label>
              <input class="form-control" id="recipient-name" type="text" />

            </div>
        
                   
            
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-border-radius" type="button" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary btn-border-radius" type="button">Update </button>
      </div>
    </div>
  </div>
</div>
<!-- Popup Flayer Data Experience  End -->

<!-- Popup Flayer Data Education  Start -->
<div class="modal fade" id="education-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 500px">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
        <button class="btn-close btn btn-sm btn-border-radius btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
          <h4 class="mb-1" id="modalExampleDemoLabel">Education </h4>
          <div class="title sg-heading4 float-left cardTitle-RXK7R" role="heading" aria-level="1"> * Required fields</div>
        </div>
        <div class="p-4 pb-0">
          <form>
          <div class="col-sm-6 mb-3"><label class="form-label" for="field-type">Education Level</label><select class="form-select form-select-sm" id="field-type">
                          <option>Select a type</option>
                          <option>High School</option>
                          <option>Under Graduate</option>
                          <option>Graduate</option>
                         
                        </select></div>
            <div class="mb-3">
              <label class="col-form-label" for="recipient-name">Degree</label>
              <input class="form-control" id="recipient-name" type="text" />
            </div>
            <div class="form-group">
					<label><b>Completed On</b></label>
					<input type="date" name="bod" class="form-control">
					<span class="error-msg" id="msg_4"></span>
			  	</div>
            <div class="mb-3">
              <label class="col-form-label" for="recipient-name">College / University</label>
              <input class="form-control" id="recipient-name" type="text" />
            </div>
            <div class="mb-3">
              <label class="col-form-label" for="recipient-name">Accrediation</label>
              <input class="form-control" id="recipient-name" type="text" />
            </div>
            <div class="mb-3">
            
              <div class="col-sm-6 mb-3"><label class="form-label" for="field-type">Career Sector</label>
              
                        <select  class="form-select form-select-sm" id="field-type">
													<option value="ACCOUNTING/FINANCE">Accounting/finance</option>
																<option value="ADMINISTRATION">Administration</option>
																<option value="ARCHITECTURE">Architecture</option>
																<option value="ART/MEDIA">Art/media</option>
																<option value="BEAUTY SERVICES">Beauty Services</option>
																<option value="BIOTECHNOLOGY/SCIENCE">Biotechnology/science</option>
																<option value="BUSINESS MANAGEMENT">Business Management</option>
																<option value="CUSTOMER SERVICE">Customer Service</option>
																<option value="EDUCATION/TRAINING">Education/training</option>
																<option value="ENGINEERING">Engineering</option>
																<option value="FILM/ACTING">Film/acting</option>
																<option value="GENERAL LABOUR">General Labour</option>
																<option value="GOVERNMENT/PUBLIC SERVICE">Government/public Service</option>
																<option value="HEALTH FITNESS">Health Fitness</option>
																<option value="HOSPITALITY BUSINESS">Hospitality Business</option>
																<option value="HUMAN RESOURCES">Human Resources</option>
																<option value="INFORMATION TECHNOLOGY">Information Technology</option>
																<option value="LEGAL SERVICES">Legal Services</option>
																<option value="MANUFACTURING BUSINESS">Manufacturing Business</option>
																<option value="Marketing Advertising">Marketing Advertising</option>
																<option value="MEDICAL / HEALTH SERVICES">Medical / Health Services</option>
																<option value="REAL ESTATE">Real Estate</option>
																<option value="Regions">Regions</option>
																<option value="RETAIL BUSINESS">Retail Business</option>
																<option value="SKILLED TRADES">Skilled Trades</option>
																<option value="TRANSPORT">Transport</option>
																<option value="WRITING/EDITING">Writing/editing</option>
													
					
			  </select>
            </div>

            </div>
        
                   
            
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-border-radius" type="button" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary btn-border-radius" type="button">Update </button>
      </div>
    </div>
  </div>
</div>
<!-- Popup Flayer Data Education  End -->


<!-- Popup Flayer Data Basic Info End -->
          <div class="card mb-3">
            <div class="card-header position-relative min-vh-25 mb-7">
              <div class="bg-holder rounded-3 rounded-bottom-0" style="background-image:url(assets/img/generic/4.jpg);"></div>
              <!--/.bg-holder-->
              <div class="avatar avatar-5xl avatar-profile">
				   <?php
						if($sprows['spProfilePic']){
							echo "<img  alt='profile-Pic' class='img-responsive' src='data:image/jpg;base64, ".base64_encode($picture)."'  style='border-radius: 100%;'>" ;
						}
				  else
				  {
					  echo "<img  alt='profile-Pic' class='img-responsive' src='../assets/images/icon/blank-img.png' >" ;
						}
					?>
			  </div>
            </div>
            <div class="card-body">

            <div class="container-fluid">

              <div class="row">
                <div class="col-lg-8">
                  <h4 class="mb-1">
					  <?php echo $_POST["pname"]; ?>
                  <button class="fas fa-pen btn-icon" type="button" data-bs-toggle="modal" data-bs-target="#error-modal"></button>
                </h4>
                  <h5 class="fs-0 fw-normal"><?php  echo $row4["degree"]; ?></h5>
                  <p class="text-500"><?php echo $address_city;?></p>
                  <div >
                  
                  <p class="text-500">Email:
                  <a href="<?php echo $email;?>" class="fs-0 fw-normal"><?php echo $email;?></a></p>

                </div>
                  
                  <p class="">Tagline: The SharePage</p>
                  
                 
                  <div class="border-dashed-bottom my-4 d-lg-none"></div>
                </div>
                
              </div>
            </div>
          </div>
          <div class="row g-0">
            <div class="col-lg-8 pe-lg-2">
              <div class="card mb-3">
                <div class="card-header bg-light">
                  <h5 class="mb-1"> About Myself
                  <button class="fas fa-pen btn-icon text-primary" type="button" data-bs-toggle="modal" data-bs-target="#aboutmyself-modal"></button>
                  </span></h5>
                  
                  <div class="modal fade" id="aboutmyself-modal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px">
    <div class="modal-content position-relative">
      <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
        <button class="btn-close btn btn-sm btn-border-radius btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
          <h4 class="mb-1" id="modalExampleDemoLabel">About Myself </h4>
        </div>
        <div class="p-4 pb-0">
          <form>
           
            <div class="mb-3">
              <label class="col-form-label" for="message-text">Message:</label>
              <textarea class="form-control" id="message-text"></textarea>
            </div>
          </form>
        </div>
      </div>
      <div class="modal-footer">
        <button class="btn btn-secondary btn-border-radius" type="button" data-bs-dismiss="modal">Close</button>
        <button class="btn btn-primary btn-border-radius" type="button">Understood </button>
      </div>
    </div>
  </div>
</div>

                </div>
                <div class="card-body text-justify">
                  <p class="mb-0 text-1000">Dedicated, passionate, and accomplished Full Stack Developer with 9+ years of progressive experience working as an Independent Contractor for Google and developing and growing my educational social network that helps others learn programming, web design, game development, networking.</p>
                  <div class="collapse show" id="profile-intro">
                    <p class="mt-3 text-1000">I’ve acquired a wide depth of knowledge and expertise in using my technical skills in programming, computer science, software development, and mobile app development to developing solutions to help organizations increase productivity, and accelerate business performance. </p>
                    <p class="text-1000">It’s great that we live in an age where we can share so much with technology but I’m but I’m ready for the next phase of my career, with a healthy balance between the virtual world and a workplace where I help others face-to-face.</p>
                    <p class="text-1000 mb-0">There’s always something new to learn, especially in IT-related fields. People like working with me because I can explain technology to everyone, from staff to executives who need me to tie together the details and the big picture. I can also implement the technologies that successful projects need.</p>
                  </div>
                </div>
                <div class="card-footer bg-light p-0 border-top"><button class="btn btn-link btn-border-radius d-block w-100 btn-intro-collapse" type="button" data-bs-toggle="collapse" data-bs-target="#profile-intro" aria-expanded="true" aria-controls="profile-intro">Show <span class="less">less<span class="fas fa-chevron-up ms-2 fs--2"></span></span><span class="full">full<span class="fas fa-chevron-down ms-2 fs--2"></span></span></button></div>
              </div>

              <div class="card mb-3">
                <div class="card-header bg-light d-flex justify-content-between">
                  <h5 class="mb-1"> Skills
                  <button class="fas fa-pen btn-icon text-primary" type="button" data-bs-toggle="modal" data-bs-target="#skills-modal"></button>
                  </span></h5>
                 
                  <div class="modal fade" id="skills-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px">
                      <div class="modal-content position-relative">
                        <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                          <button class="btn-close btn btn-sm, btn-border-radius btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                          <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                            <h4 class="mb-1" id="modalExampleDemoLabel">Skills </h4>
                          </div>
                          <div class="p-4 pb-0">
                            <form>
                            
                              <div class="mb-3">
                                <label class="col-form-label" for="message-text">Add Skills:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                              </div>
                            </form>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-secondary btn-border-radius" type="button" data-bs-dismiss="modal">Close</button>
                          <button class="btn btn-primary btn-border-radius" type="button">Understood </button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <a class="font-sans-serif" href="../../app/social/activity-log.html">All logs</a>
                </div>
                <div class="card-body fs--1 p-0">
                  <a class="border-bottom-0 notification rounded-0 border-x-0 border border-300" href="#!">
                    <div class="notification-avatar">
                      <div class="avatar avatar-xl me-3">
                        <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">🎁</span></div>
                      </div>
                    </div>
                    <div class="notification-body">
                      <p class="mb-1"><strong>Jennifer Kent</strong> Congratulated <strong>Anthony Hopkins</strong></p>
                      <span class="notification-time">November 13, 5:00 Am</span>
                    </div>
                  </a>

                  
                </div>
              </div>

              <div class="card mb-3">
                <div class="card-header bg-light d-flex justify-content-between">
               
                  <h5 class="mb-1"> Certifications / Licenses
                  
                  <button class="fas fa-pen btn-icon text-primary" type="button" data-toggle="modal" data-target="#exampleModalCenter"></button>
                  </span>
                </h5>
                  <a class="font-sans-serif" href="../../app/social/activity-log.html">All logs</a>
                </div>


                <div class="container-fluid">
	             
                  <div class="card-body fs--1 p-0" id="tbl_rec">
                
                  </div>
	
	              </div>






              </div>

  

              <div class="card mb-3">
                <div class="card-header bg-light d-flex justify-content-between">
                 
                  <h5 class="mb-1"> Hobbies
                  <button class="fas fa-pen btn-icon text-primary" type="button" data-bs-toggle="modal" data-bs-target="#hobbies-modal"></button>
                  </span></h5>


                  <div class="modal fade" id="hobbies-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 800px">
                      <div class="modal-content position-relative">
                        <div class="position-absolute top-0 end-0 mt-2 me-2 z-index-1">
                          <button class="btn-close btn btn-sm btn-border-radius btn-circle d-flex flex-center transition-base" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-0">
                          <div class="rounded-top-lg py-3 ps-4 pe-6 bg-light">
                            <h4 class="mb-1" id="modalExampleDemoLabel">Hobbies </h4>
                          </div>
                          <div class="p-4 pb-0">
                            <form>
                            
                              <div class="mb-3">
                                <label class="col-form-label" for="message-text">Add Hobbies:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                              </div>
                            </form>
                          </div>
                        </div>
                        <div class="modal-footer">
                          <button class="btn btn-secondary btn-border-radius" type="button" data-bs-dismiss="modal">Close</button>
                          <button class="btn btn-primary btn-border-radius" type="button">Understood </button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <a class="font-sans-serif" href="../../app/social/activity-log.html">All logs</a>
                </div>
                <div class="card-body fs--1 p-0">
                  <a class="border-bottom-0 notification rounded-0 border-x-0 border border-300" href="#!">
                    <div class="notification-avatar">
                      <div class="avatar avatar-xl me-3">
                        <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">🎁</span></div>
                      </div>
                    </div>
                    <div class="notification-body">
                      <p class="mb-1"><strong>Jennifer Kent</strong> Congratulated <strong>Anthony Hopkins</strong></p>
                      <span class="notification-time">November 13, 5:00 Am</span>
                    </div>
                  </a>


                </div>
              </div>
             
              <div class="card mb-3">
                <div class="card-header bg-light d-flex justify-content-between">
                  
                  <h5 class="mb-1"> Referances
                  <button class="fas fa-pen btn-icon text-primary" type="button" data-toggle="modal" data-target="#exampleModalCenter-referances"></button>
                  </span>
                </h5>
                

                  <a class="font-sans-serif" href="../../app/social/activity-log.html">All logs</a>
                  
                </div>
                <div class="container-fluid">
	             
                  <div class="card-body fs--1 p-0" id="tbl_rec">
                
                  </div>
	
	              </div>

                <div class="card-body fs--1 p-0">
                  <a class="border-bottom-0 notification rounded-0 border-x-0 border border-300" href="#!">
                    <div class="notification-avatar">
                      <div class="avatar avatar-xl me-3">
                        <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">🎁</span></div>
                      </div>
                    </div>
                    <div class="notification-body">
                      <p class="mb-1"><strong>Jennifer Kent</strong> Congratulated <strong>Anthony Hopkins</strong></p>
                      <span class="notification-time">November 13, 5:00 Am</span>
                    </div>
                  </a>

                  <a class="border-bottom-0 notification rounded-0 border-x-0 border border-300" href="#!">
                    <div class="notification-avatar">
                      <div class="avatar avatar-xl me-3">
                        <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">🏷️</span></div>
                      </div>
                    </div>
                    <div class="notification-body">
                      <p class="mb-1"><strong>California Institute of Technology</strong> tagged <strong>Anthony Hopkins</strong> in a post.</p>
                      <span class="notification-time">November 8, 5:00 PM</span>
                    </div>
                  </a>

                  <a class="border-bottom-0 notification rounded-0 border-x-0 border border-300" href="#!">
                    <div class="notification-avatar">
                      <div class="avatar avatar-xl me-3">
                        <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">📋️</span></div>
                      </div>
                    </div>
                    <div class="notification-body">
                      <p class="mb-1"><strong>Anthony Hopkins</strong> joined <strong>Victory day cultural Program</strong> with <strong>Tony Stark</strong></p>
                      <span class="notification-time">November 01, 11:30 AM</span>
                    </div>
                  </a>

                  <a class="notification border-x-0 border-bottom-0 border-300 rounded-top-0" href="#!">
                    <div class="notification-avatar">
                      <div class="avatar avatar-xl me-3">
                        <div class="avatar-emoji rounded-circle "><span role="img" aria-label="Emoji">📅️</span></div>
                      </div>
                    </div>
                    <div class="notification-body">
                      <p class="mb-1"><strong>Massachusetts Institute of Technology</strong> invited <strong>Anthony Hopkin</strong> to an event</p>
                      <span class="notification-time">October 28, 12:00 PM</span>
                    </div>
                  </a>
                </div>
              </div>
             
            </div>
            <div class="col-lg-4 ps-lg-2">
              <div class="sticky-sidebar">
                <div class="card mb-3">
                  <div class="card-header bg-light">
                    
                    <h5 class="mb-1"> Experience
                    <button class="fas fa-pen btn-icon text-primary" type="button" data-bs-toggle="modal" data-bs-target="#experience-modal"></button>
                  </span>
                </h5>
                  </div>
                  <div class="card-body fs--1">
                    <div class="d-flex"><a href="#!"> <img class="img-fluid" src="assets/img/logos/g.png" alt="" width="56"></a>
                      <div class="flex-1 position-relative ps-3">
                        <h6 class="fs-0 mb-0">Big Data Engineer<span data-bs-toggle="tooltip" data-bs-placement="top" title="Verified"><small class="fa fa-check-circle text-primary" data-fa-transform="shrink-4 down-2"></small></span></h6>
                        <p class="mb-1"> <a href="#!">Google</a></p>
                        <p class="text-1000 mb-0">Apr 2012 - Present &bull; 6 yrs 9 mos</p>
                        <p class="text-1000 mb-0">California, USA</p>
                        <div class="border-dashed-bottom my-3"></div>
                      </div>
                    </div>
                    <div class="d-flex"><a href="#!"> <img class="img-fluid" src="assets/img/logos/apple.png" alt="" width="56"></a>
                      <div class="flex-1 position-relative ps-3">
                        <h6 class="fs-0 mb-0">Software Engineer<span data-bs-toggle="tooltip" data-bs-placement="top" title="Verified"><small class="fa fa-check-circle text-primary" data-fa-transform="shrink-4 down-2"></small></span></h6>
                        <p class="mb-1"> <a href="#!">Apple</a></p>
                        <p class="text-1000 mb-0">Jan 2012 - Apr 2012 &bull; 4 mos</p>
                        <p class="text-1000 mb-0">California, USA</p>
                        <div class="border-dashed-bottom my-3"></div>
                      </div>
                    </div>
                    <div class="d-flex"><a href="#!"> <img class="img-fluid" src="assets/img/logos/nike.png" alt="" width="56"></a>
                      <div class="flex-1 position-relative ps-3">
                        <h6 class="fs-0 mb-0">Mobile App Developer<span data-bs-toggle="tooltip" data-bs-placement="top" title="Verified"><small class="fa fa-check-circle text-primary" data-fa-transform="shrink-4 down-2"></small></span></h6>
                        <p class="mb-1"> <a href="#!">Nike</a></p>
                        <p class="text-1000 mb-0">Jan 2011 - Apr 2012 &bull; 1 yr 4 mos</p>
                        <p class="text-1000 mb-0">Beaverton, USA</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card mb-3">
                  <div class="card-header bg-light">
                   
                    <h5 class="mb-1"> Education
                    <button class="fas fa-pen btn-icon text-primary" type="button" data-bs-toggle="modal" data-bs-target="#education-modal"></button>
                  </span>
                </h5>
                    
                  </div>
                  <div class="card-body fs--1">
                    <div class="d-flex"><a href="#!">
                        <div class="avatar avatar-3xl">
                          <div class="avatar-name rounded-circle"><span>SU</span></div>
                        </div>
                      </a>
                      <div class="flex-1 position-relative ps-3">
                        <h6 class="fs-0 mb-0"> <a href="#!">Stanford University<span data-bs-toggle="tooltip" data-bs-placement="top" title="Verified"><small class="fa fa-check-circle text-primary" data-fa-transform="shrink-4 down-2"></small></span></a></h6>
                        <p class="mb-1">Computer Science and Engineering</p>
                        <p class="mb-1">B.E</p>
                        <p class="text-1000 mb-0">2010 - 2014 • 4 yrs</p>
                        <p class="text-1000 mb-0">Mumbai University</p>
                        <p class="text-1000 mb-0">A++</p>
                        <div class="border-dashed-bottom my-3"></div>
                      </div>
                    </div>
                    <div class="d-flex"><a href="#!"> <img class="img-fluid" src="assets/img/logos/staten.png" alt="" width="56"></a>
                      <div class="flex-1 position-relative ps-3">
                        <h6 class="fs-0 mb-0"> <a href="#!">Staten Island Technical High School<span data-bs-toggle="tooltip" data-bs-placement="top" title="Verified"><small class="fa fa-check-circle text-primary" data-fa-transform="shrink-4 down-2"></small></span></a></h6>
                        <p class="mb-1">Higher Secondary School Certificate, Science</p>
                        <p class="text-1000 mb-0">2008 - 2010 &bull; 2 yrs</p>
                        <p class="text-1000 mb-0">New York, USA</p>
                        <div class="border-dashed-bottom my-3"></div>
                      </div>
                    </div>
                    <div class="d-flex"><a href="#!"> <img class="img-fluid" src="assets/img/logos/tj-heigh-school.png" alt="" width="56"></a>
                      <div class="flex-1 position-relative ps-3">
                        <h6 class="fs-0 mb-0"> <a href="#!">Thomas Jefferson High School for Science and Technology<span data-bs-toggle="tooltip" data-bs-placement="top" title="Verified"><small class="fa fa-check-circle text-primary" data-fa-transform="shrink-4 down-2"></small></span></a></h6>
                        <p class="mb-1">Secondary School Certificate, Science</p>
                        <p class="text-1000 mb-0">2003 - 2008 &bull; 5 yrs</p>
                        <p class="text-1000 mb-0">Alexandria, USA</p>
                      </div>
                    </div>
                  </div>
                </div>
 
              </div>
            </div>
          </div>
          <!-- End Delete Design Modal -->


          <!-- Certificates Section Scripts For Table  Management -->
      
<!-- Referances Table Start-->
<div class="modal fade" id="exampleModalCenter-referances" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Referances</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" id="ins_rec">
	      <div class="modal-body">
			  	<div class="form-group">
					<label><b>Referance Title</b></label>
					<input type="text" name="username" class="form-control" placeholder="Username">
					<span class="error-msg" id="msg_1"></span>
			  	</div>
			  	<div class="form-group">
					<label><b>Referance Link</b></label>
					<input type="text" name="email" class="form-control" placeholder="YourEmail@email.com">
					<span class="error-msg" id="msg_2"></span>
			  	</div>
          <div class="mb-3">
                                <label class="col-form-label" for="message-text">Add Hobbies:</label>
                                <textarea class="form-control" id="message-text"></textarea>
                              </div>
		
				<div class="form-group">
					<span class="success-msg" id="sc_msg"></span>
				</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary btn-border-radius" id="close_click" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary btn-border-radius" > Add</button>
	      </div>
      </form>
    </div>
  </div>
</div>
<!-- Referances Table End -->
          
<!-- Insert Design Modal -->
	
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Certifications / Licenses</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="POST" id="ins_rec">
	      <div class="modal-body">
			  	<div class="form-group">
					<label><b>User Name</b></label>
					<input type="text" name="username" class="form-control" placeholder="Username">
					<span class="error-msg" id="msg_1"></span>
			  	</div>
			  	<div class="form-group">
					<label><b>Email</b></label>
					<input type="text" name="email" class="form-control" placeholder="YourEmail@email.com">
					<span class="error-msg" id="msg_2"></span>
			  	</div>
				<div class="form-group">
					<label><b>Country</b></label>
					<select class="custom-select" name="country" id="country">
						<option value="" selected>Choose...</option>
						<option value="USA">USA</option>
						<option value="Germany">Germany</option>
						<option value="UK">UK</option>
					</select>
					<span class="error-msg" id="msg_3"></span>
			  	</div>
				<div class="form-group">
					<label><b>Certificate Issued</b></label>
					<input type="date" name="bod" class="form-control">
					<span class="error-msg" id="msg_4"></span>
			  	</div>
				<div class="form-group">
					<label class="mr-3"><b>Gender :- </b></label>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="gender" value="Male" checked>
					  <label class="form-check-label" >Male</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" name="gender" value="Female">
					  <label class="form-check-label" >Female</label>
					</div>
					<span class="error-msg"  id="msg_5"></span>
				</div>	
				<div class="form-group">
					<span class="success-msg" id="sc_msg"></span>
				</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary btn-border-radius" id="close_click" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary btn-border-radius" >Add Record</button>
	      </div>
      </form>
    </div>
  </div>
</div>



	<!-- Update Design Modal -->
		
	<div class="modal fade" id="updateModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="updateModalCenterTitle">Update Certifications / Licenses</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <form method="POST" id="updata">
	      <div class="modal-body">
			  	<div class="form-group">
					<label><b>Certificate Name</b></label>
					<input type="text" class="form-control" name="username" id="upd_1" placeholder="Username">
					<span class="error-msg" id="umsg_1"></span>
			  	</div>
			  	<div class="form-group">
					<label><b>Email</b></label>
					<input type="text" class="form-control" name="email" id="upd_2" placeholder="YourEmail@email.com">
					<span class="error-msg" id="umsg_2"></span>
			  	</div>
				<div class="form-group">
					<label><b>Country</b></label>
					<select class="custom-select" id="upd_3" name="country">
						<option value="" selected>Choose...</option>
						<option value="USA">USA</option>
						<option value="Germany">Germany</option>
						<option value="UK">UK</option>
					</select>
					<span class="error-msg" id="umsg_3"></span>
			  	</div>
				<div class="form-group">
					<label><b>Certificate Issued</b></label>
					<input type="date" class="form-control" id="upd_4" name="bod">
					<span class="error-msg" id="umsg_4"></span>
			  	</div>
          <div class="dropzone dropzone-single p-0" data-dropzone="data-dropzone" data-options='{"url":"valid/url","maxFiles":1,"dictDefaultMessage":"Choose or Drop a file here"}'>
  <div class="fallback"><input type="file" name="file" /></div>
  <div class="dz-preview dz-preview-single">
    <div class="dz-preview-cover dz-complete"><img class="dz-preview-img" src="../../../assets/img/generic/image-file-2.png" alt="..." data-dz-thumbnail="" /><a class="dz-remove text-danger" href="#!" data-dz-remove="data-dz-remove"><span class="fas fa-times"></span></a>
      <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
      <div class="dz-errormessage m-1"><span data-dz-errormessage="data-dz-errormessage"></span></div>
    </div>
    <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div>
  </div>
  <div class="dz-message" data-dz-message="data-dz-message">
    <div class="dz-message-text"><img class="me-2" src="../../../assets/img/icons/cloud-upload.svg" width="25" alt="" />Drop your Certificate here</div>
  </div>
</div>


				<div class="form-group">
					<label><b>Gender</b></label>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" id="upd_5" name="gender" value="Male">
					  <label class="form-check-label" >Male</label>
					</div>
					<div class="form-check form-check-inline">
					  <input class="form-check-input" type="radio" id="upd_6" name="gender" value="Female">
					  <label class="form-check-label" >Female</label>
					</div>
					<span class="success-msg" id="umsg_5"></span>
				</div>
				<div class="form-group">
					<input type="hidden" name="dataval" id="upd_7">
					<span class="success-msg" id="umsg_6"></span>
				</div>
	      </div>
	      <div class="modal-footer"> 
	        <button type="button" class="btn btn-secondary btn-border-radius" data-dismiss="modal" id="up_cancle">Cancle</button>
	        <button type="submit" class="btn btn-primary btn-border-radius">Update Record</button>
	      </div>
	      </form>	
	    </div>
	  </div>
	</div>	
		
	<!-- End Update Design Modal -->
		
	<!-- Delete Design Modal -->
		
	<div class="modal fade" id="deleteModalCenter" tabindex="-1" role="dialog" aria-labelledby="deleteModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="deleteModalCenterTitle">Are You Sure Delete This Record ?</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
			  <p>If You Click On Delete Button Record Will Be Deleted. We Don't have Backup So Be Carefull.</p>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary btn-border-radius" id="de_cancle" data-dismiss="modal">Cancle</button>
	        <button type="button" class="btn btn-primary btn-border-radius" id="deleterec">Delete Now</button>
	      </div>
	    </div>
	  </div>
	</div>	
		
<!-- End Delete Design Modal -->
         

<script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" type="text/javascript"></script>


<script type="text/javascript">
	
$(document).ready(function (){
	$('#tbl_rec').load('record.php');

	$('#search').keyup(function (){
		var search_data = $(this).val();
		$('#tbl_rec').load('record.php', {keyword:search_data});
	});

	//insert Record

	$('#ins_rec').on("submit", function(e){
		e.preventDefault();
		$.ajax({

			type:'POST',
			url:'insprocess.php',
			data:$(this).serialize(),
			success:function(vardata){

				var json = JSON.parse(vardata);

				if(json.status == 101){
					console.log(json.msg);
					$('#tbl_rec').load('record.php');
					$('#ins_rec').trigger('reset');
					$('#close_click').trigger('click');
				}
				else if(json.status == 102){
					$('#sc_msg').text(json.msg);
					console.log(json.msg);
				}
				else if(json.status == 103){
					$('#msg_1').text(json.msg);
					console.log(json.msg);
				}
				else if(json.status == 104){
					$('#msg_2').text(json.msg);
					console.log(json.msg);
				}
				else if(json.status == 105){
					$('#msg_3').text(json.msg);
					console.log(json.msg);
				}
				else if(json.status == 106){
					$('#msg_4').text(json.msg);
					console.log(json.msg);
				}
				else if(json.status == 107){
					$('#msg_5').text(json.msg);
					console.log(json.msg);
				}
				else{
					console.log(json.msg);
				}

			}

		});

	});

	//select data

	$(document).on("click", "button.editdata", function(){
		$('#umsg_1').text("");
		$('#umsg_2').text("");
		$('#umsg_3').text("");
		$('#umsg_4').text("");
		$('#umsg_5').text("");
		$('#umsg_6').text("");
		$('#umsg_7').text("");
		var check_id = $(this).data('dataid');
		$.getJSON("updateprocess.php", {checkid : check_id}, function(json){
			if(json.status == 0){
				$('#upd_1').val(json.username);
				$('#upd_2').val(json.email);
				$('#upd_3').val(json.country);
				$('#upd_4').val(json.bod);
				$('#upd_7').val(check_id);
				if(json.gender == 'Male'){
					$('#upd_5').prop("checked", true);
				}
				else{
					$('#upd_6').prop("checked", true);
				}
			}
			else{
				console.log(json.msg);
			}
		});
	});

	//Update Record

	$('#updata').on("submit", function(e){
		e.preventDefault();

		$.ajax({

			type:'POST',
			url:'updateprocess2.php',
			data:$(this).serialize(),
			success:function(vardata){

				var json = JSON.parse(vardata);

				if(json.status == 101){
					console.log(json.msg);
					$('#tbl_rec').load('record.php');
					$('#ins_rec').trigger('reset');
					$('#up_cancle').trigger('click');
				}
				else if(json.status == 102){
					$('#umsg_6').text(json.msg);
					console.log(json.msg);
				}
				else if(json.status == 103){
					$('#umsg_1').text(json.msg);
					console.log(json.msg);
				}
				else if(json.status == 104){
					$('#umsg_2').text(json.msg);
					console.log(json.msg);
				}
				else if(json.status == 105){
					$('#umsg_3').text(json.msg);
					console.log(json.msg);
				}
				else if(json.status == 107){
					$('#umsg_4').text(json.msg);
					console.log(json.msg);
				}
				else if(json.status == 106){
					$('#umsg_5').text(json.msg);
					console.log(json.msg);
				}

				else{
					console.log(json.msg);
				}

			}

		});

	});

	//delete record

	var deleteid;

	$(document).on("click", "button.deletedata", function(){
		deleteid = $(this).data("dataid");
	});

	$('#deleterec').click(function (){
		$.ajax({
			type:'POST',
			url:'deleteprocess.php',
			data:{delete_id : deleteid},
			success:function(data){
				var json = JSON.parse(data);
				if(json.status == 0){
					$('#tbl_rec').load('record.php');
					$('#de_cancle').trigger("click");
					console.log(json.msg);
				}
				else{
					console.log(json.msg);
				}
			}
		});
	});


});
	
function phoneprivacy(){

var address = $(".address").val();

         $.ajax({
                    type: "POST",
                    url: "address.php",
                    cache:false,
                    data: {'address':address},
                    success: function(data) {

                        var obj = JSON.parse(data);

                        $("#suggested_address").html('<option value="' + obj.address + '" class="op_address">' + obj.address + '</option>');
                    

                        $("#latitude").val(obj.latitude);
                        $("#longitude").val(obj.longitude);
  
                    } 
                }); 
}

</script>