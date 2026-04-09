    
    <!-- THIS IS EXTRA CSS FOR ADMIN -->
	<link rel="stylesheet" type="text/css" href="<?php echo WEB_ROOT_TEMPLATE;  ?>/dist/css/theme.min.css">


    <div class="box-header with-border">
        <h3 class="box-title">Profile</h3>
        
    </div><!-- /.box-header -->
    <div class="box-body">
    	<div class="row">
    		<div class="col-md-12">
				<div class="tab-content">
				    <div id="profile-tab" class="tab-pane active">
				      	<div class="pd-20">
				  			
					        <h3 class="mgbt-xs-15 font-semibold"><i class="fa fa-user mgr-10 profile-icon"></i> ABOUT</h3>
					        <div class="row">
					        	<div class="col-sm-6">
						            <div class="row mgbt-xs-0">
						              	<label class="col-xs-5 control-label">Account Name:</label>
						              	<div class="col-xs-7 controls"><?php echo showspUserName($dbConn, $spUser_idspUser);?></div>
						              	<!-- col-sm-10 --> 
						            </div>
					          	</div>
					          
					          	<div class="col-sm-6">
						            <div class="row mgbt-xs-0">
						              	<label class="col-xs-5 control-label">User Name:</label>
						              	<div class="col-xs-7 controls"><?php echo ucwords($spProfileName);?></div>
						              	<!-- col-sm-10 --> 
						            </div>
					          	</div>
					          	<div class="col-sm-6">
						            <div class="row mgbt-xs-0">
						              	<label class="col-xs-5 control-label">Profile Type:</label>
						              	<div class="col-xs-7 controls"><?php ProfileType($dbConn, $spProfileType_idspProfileType);?></div>
						              	<!-- col-sm-10 --> 
						            </div>
					          	</div>
					          	<div class="col-sm-6">
						            <div class="row mgbt-xs-0">
						              	<label class="col-xs-5 control-label">Default Profile:</label>
						              	<div class="col-xs-7 controls"><?php echo ($spProfilesDefault == 1)?'Yes':'No'?></div>
						              	<!-- col-sm-10 --> 
						            </div>
					          	</div>
					          	
					          	<div class="col-sm-6">
						            <div class="row mgbt-xs-0">
						              	<label class="col-xs-5 control-label">Email:</label>
						              	<div class="col-xs-7 controls"><?php echo $spProfileEmail;?></div>
						              	<!-- col-sm-10 --> 
						            </div>
					          	</div>
					          	<div class="col-sm-6">
						            <div class="row mgbt-xs-0">
						              	<label class="col-xs-5 control-label">Phone No:</label>
						              	<div class="col-xs-7 controls"><?php echo $spProfilePhone;?></div>
						              	<!-- col-sm-10 --> 
						            </div>
					          	</div>
					          	
					          	<div class="col-sm-6">
						            <div class="row mgbt-xs-0">
						              	<label class="col-xs-5 control-label">Store Name:</label>
						              	<div class="col-xs-7 controls"><?php echo $spDynamicWholesell;?></div>
						              	<!-- col-sm-10 --> 
						            </div>
					          	</div>
					          	<div class="col-sm-6">
						            <div class="row mgbt-xs-0">
						              	<label class="col-xs-5 control-label">Country:</label>
						              	<div class="col-xs-7 controls"><?php echo $spProfilesCountry;?></div>
						              	<!-- col-sm-10 --> 
						            </div>
					          	</div>
					          	<div class="col-sm-6">
						            <div class="row mgbt-xs-0">
						              	<label class="col-xs-5 control-label">State / Province:</label>
						              	<div class="col-xs-7 controls"><?php echo $spProfilesState;?></div>
						              	<!-- col-sm-10 --> 
						            </div>
					          	</div>
					          	<div class="col-sm-6">
						            <div class="row mgbt-xs-0">
						              	<label class="col-xs-5 control-label">City:</label>
						              	<div class="col-xs-7 controls"><?php echo $spProfilesCity;?></div>
						              	<!-- col-sm-10 --> 
						            </div>
					          	</div>
					          	<div class="col-sm-6">
						            <div class="row mgbt-xs-0">
						              	<label class="col-xs-5 control-label">Date Of Birth:</label>
						              	<div class="col-xs-7 controls"><?php echo $spProfilesDob;?></div>
						              	<!-- col-sm-10 --> 
						            </div>
					          	</div>
					          	
					          	<div class="col-sm-6">
						            <div class="row mgbt-xs-0">
						              	<label class="col-xs-5 control-label">Address:</label>
						              	<div class="col-xs-7 controls"><?php echo $spprofilesAddress;?></div>
						              	<!-- col-sm-10 --> 
						            </div>
					          	</div>
					          	<div class="col-sm-6">
						            <div class="row mgbt-xs-0">
						              	<label class="col-xs-5 control-label">Postal Code:</label>
						              	<div class="col-xs-7 controls"><?php echo $spProfilePostalCode;?></div>
						              	<!-- col-sm-10 --> 
						            </div>
					          	</div>

					          	<?php
					          	$sql = "SELECT * FROM spprofilefield WHERE spprofiles_idspProfiles = $pid";
					          	$result = dbQuery($dbConn, $sql);
					          	if ($result) {
					          		while($rw = dbFetchAssoc($result)){
										?>
										<div class="col-sm-6">
								            <div class="row mgbt-xs-0">
								              	<label class="col-xs-5 control-label"><?php echo $rw["spProfileFieldLabel"];?>:</label>
								              	<div class="col-xs-7 controls"><?php echo $rw["spProfileFieldValue"];?></div>
								              	<!-- col-sm-10 --> 
								            </div>
							          	</div>
										<?php
									}
					          	}
								?>

					          	<div class="col-sm-12">
						            <div class="row mgbt-xs-0">
						              	<label class="col-xs-12 control-label">About Profile:</label>
						              	<div class="col-xs-12 controls"><?php echo $spProfileAbout;?></div>
						              	<!-- col-sm-10 --> 
						            </div>
					          	</div>
					          	
					          	<div class="col-sm-12">
						            <div class="row mgbt-xs-0">
						              	<label class="col-xs-12 control-label">About Store:</label>
						              	<div class="col-xs-12 controls"><?php echo $spProfilesAboutStore;?></div>
						              	<!-- col-sm-10 --> 
						            </div>
					          	</div>

					        </div>
				        
				      </div>
				      <!-- pd-20 --> 
				    </div>
				    <!-- home-tab -->
				    

				    
				</div>
    		</div>
    	</div>        
    </div><!-- /.box-body -->



