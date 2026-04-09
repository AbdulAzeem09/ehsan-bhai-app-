<?php 
 session_start();
?>

<div class="seller_info bradius-15" >
        <div class="row no-margin">
            <div class="col-md-2 no-padding">
                <?php
                $postId = isset($_GET['postid']) ? (int)$_GET['postid'] : 0;
               // echo "here";
            //    print_r($SellId);
            //     print_r($SellId);
            //   die("======+++++++++++");
				//echo $SellId;
                    $p = new _spprofiles;            
                    $result = $p->read($SellId);
                    if ($result != false) {
                        $row = mysqli_fetch_assoc($result);
						//print_r($row);
                        $receiver_name=$row["spProfileName"];

                        $address = $row['address'];

                        if (isset($row["spProfilePic"]))
                            echo "<img alt='profilepic' class='img-responsive sellerPic' src=' " . ($row["spProfilePic"]) . "'  >";
                        else
                            echo "<img alt='profilepic' class='img-responsive sellerPic' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px;' >";
                    }
                    
                    $pr         = new _spprofilehasprofile;
                    $result6    = $pr->frndLeevel($_SESSION['pid'], $SellId);  
                    //echo $pr->ta->sql;
                    //echo $result3;
                    if($result6 == 0){
                      $level = '1st';
                    }else if($result6 == 1){
                      $level = '1st';
                    }else if($result6 == 2){
                      $level = '2nd';
                    }else if($result6 == 3){
                      $level = '3rd';
                    }else{
                      $level = 'Not Defined';
                    }
//print_r($SellId);
//die("!!!!!!!!!!!!!!!");
                    $resultOfCurrentUser  = $p->read_seller($SellId);
                   // echo $p->ta->sql;
                  //die("&&&&&&&&&&&&&&&&&&");

				
                    if ($resultOfCurrentUser != false) {
                       // die("----------------------#######");
                        $sprows = mysqli_fetch_assoc($resultOfCurrentUser);
                        $userCountry = $sprows["spProfilesCountry"];
                        $userState = $sprows['spProfilesState'];
                        $userCity = $sprows["spProfilesCity"];
                        $profile_additional_address = $sprows["address"];
                        $profile_zipcode = $sprows["spUserzipcode"];
                    }

                    // // Check the address of user , otherwise use the default address
                    // if ((is_null($userCountry) || empty($userCountry) || $userCountry == 0) 
                    //         && (is_null($userState) || empty($userState) || $userState == 0) 
                    //         && (is_null($userCity) || empty($userCity) || $userCity == 0) 
                    //         && $profile_zipcode == 0) {

                    //     $getAllOtherProfilesByUID = $p->getMasterProfileData($_SESSION['uid'],4);
                    //     if ($getAllOtherProfilesByUID != false && mysqli_num_rows($getAllOtherProfilesByUID) > 0)
                    //     {
                    //         $profInfo = mysqli_fetch_assoc($getAllOtherProfilesByUID);
                    //         $profile_additional_address = $profInfo["address"];
                    //         $profile_zipcode = $profInfo["spUserzipcode"];
                    //         $userCountry =  $profInfo["spProfilesCountry"];
                    //         $userState =  $profInfo["spProfilesState"];
                    //         $userCity =  $profInfo["spProfilesCity"];
                    //     }
                    // }

                    // Get names of locations
                    $co = new _country;
                      $result3 = $co->readCountryName($userCountry);
                      if ($result3) {
                        $rowcon = mysqli_fetch_assoc($result3);
                        $userCountry =  $rowcon['country_title'];
                      }

                      $stateObj = new _state;
                      $result4 = $stateObj->readStateName($userState);

                      if ($result4) {
                        $rowstate = mysqli_fetch_assoc($result4);
                        $userState =  $rowstate['state_title'];
                      }


                        $cityObj = new _city;
                      $result5 = $cityObj->readCityName($userCity);
                      if ($result5) {
                        $rowcity = mysqli_fetch_assoc($result5);
                        $userCity =  $rowcity['city_title'];
                      }
					  
                ?>
                
            </div>
            <div class="col-md-10">
			
			
			<style>
			
			.seller{
				padding: 0px;
				margin-left:-50px;
				 
			}
			.prdct{
			padding-bottom: 0px;
			
			}
			.zoom1:hover {
  -ms-transform: scale(1.05); /* IE 9 */
  -webkit-transform: scale(1.05); /* Safari 3-8 */
  transform: scale(1.05); 
}
			
			</style>
			<div id="composeNewTxt" class="modal fade" role="dialog">
                           <div class="modal-dialog">
			  <div class="modal-content no-radius sharestorepos">
                                 <form method="post"  >
                                    <div class="modal-header">
                                       <h4 class="modal-title"><i style="color: #428bca" class="fa fa-pencil"></i> Compose Message</h4>
                                    </div>
                                    <div class="modal-body">
                                       <input type="hidden" name="txtSender" id="txtSender" value="<?php echo $_SESSION['pid'];?>">
									   <input type="hidden" name="txtReceiver" id="txtReceiver" value="<?php echo $SellId;?>">
                                       <div class="form-group">
                                          <label>To (<?php echo $receiver_name;?>)<span class="red"> * <span class="error_user"></span></span></label>
                                          
                                       </div>
                                       <div class="form-group">
                                          <label>Message<span class="red"> * <span class="error_msg"></span></span></label>
                                          <textarea class="form-control" name="spfriendChattingMessage" id="friendMessage" required=""></textarea>
                                       </div>
                                    </div>
                                    <div class="modal-footer">
                                       <button type="button" class="btn btn-secondary zoom1" data-dismiss="modal">Close</button>
                                       <input type="button" class="btn btn-primary composTxtNow zoom1" id="composTxtNow1" name="" value="Send Message"  data-dismiss="modal" onclick="message()" > 
                                    </div>
                                 </form>
                              </div>
							  </div>
							  </div>
                <h4 id="mob_view" style="margin-left: -50px;line-height: -0.5;padding: 0px;margin-top: -7px;"><a class="seller" id="seller_text" href="<?php echo $BaseUrl.'/friends/?profileid='.$SellId;?>"><?php echo ucwords($row["spProfileName"]);?> <br></a></h4>
                <!-- <small><?//php echo $level;?></small> -->
                
                <!-- <p style="margin-left: -50px;line-height: -0.5; padding-bottom: 0px; margin-top: 0px;" class="pro_qty" class="prdct"><a href="<?php echo $BaseUrl.'/'.$folder.'/my-all-product.php?userid='.$SellId;?>">(<?php echo $SelProduct;?> Products)</a></p> -->
            </div>
        </div>
        <div class="row no-margin">
            <div class="col-md-12 no-padding">
                <!-- <p class="active_site">&nbsp;</p> -->
                <p class="adds">Seller Details</p>
                <?php
                $ch = new _spAllStoreForm;
                $result7 = $ch->readProfileWise($SellId);
                if($result7){
                    $row7 = mysqli_fetch_assoc($result7);
                    $phoneVis = $row7['spGenPhone'];
                    $emailVis = $row7['spGenEmail'];
                }else{
                    $phoneVis = 0;
                    $emailVis = 0;
                }

                ?>
                <!-- <br> -->
                <p class="<?php echo ($phoneVis == 0)?'hidden':''; ?>"><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/phone.png"> <?php echo $SellPhone; ?></p>
                <p class="<?php echo ($emailVis == 0)?'hidden':''; ?>"><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/email.png"> <?php echo wordwrap($SellEmail , 26, "<br />\n", true);?></p>
                <p class="<?php echo ($phoneVis == 0)?'hidden':''; ?>"><img src="<?php echo $BaseUrl;?>/assets/images/icon/store/location.png"> <?php echo $SellAdres.', '.$SellCounty;?></p>

                
                    <?php
                    $rc = new _country; 
                    $result_cntry = $rc->readCountryName($Country);
                    if ($result_cntry) {
                        $row4 = mysqli_fetch_assoc($result_cntry);
                        $countryName = $row4['country_title'];
                    }

                    $rcty = new _city;
                    $result_cty = $rcty->readCityName($City);
                    if ($result_cty) {
                        $row5 = mysqli_fetch_assoc($result_cty);
                        $cityName = $row5['city_title'];
                    }
                    ?>
                <p class="sel_chat">
                    <i class="fa fa-map-marker" style="color: #035049;
                    font-size: 15px;"></i> 
                    <?php
                        if(empty($userCity) && empty($userState) && empty($userCountry)) {
                            echo "<a href='javascript:void(0);' style='padding-left: 10px;'>N/A</a>";
                            //die("---------------------");
                        } else {
                            // $fullAddr = "".$userCountry.",".$userState.",".$userCity.",".$profile_additional_address."";
                            $fullAddr = " ".$userCity.", ".$userState.", ".$userCountry."";

                        
                            echo "<a href='https://www.google.com/maps/place/". $fullAddr."' target='_blank' style='padding-left: 10px;'>". $fullAddr."</a>";  
                            // print_r($fullAddr);
                            // die("*****************************");
                        }                       
                    ?>
                </p>
                 <?php if($_SESSION['guet_yes'] != 'yes'){ ?>      
                <?php if($SellId == $_SESSION['pid']){  ?>

 <p class="sel_chat" ><i class="fa fa-commenting"style="color: #035049;
    font-size: 15px;"></i> <a href="javascript:void(0)" style="padding-left: 5px;" onclick="javascript:check_chat()">Contact Seller</a></p>

                <?php } elseif ($myuserid != $_SESSION['uid']) {  ?>
                    <div class="col-md-12 zoom" data-toggle="modal" data-target="#composeNewTxt" style="cursor: pointer;" >
                    <!--<p class="sel_chat" ><i class="fa fa-commenting "style="color: #035049;
    font-size: 15px;"></i> <a href="javascript:void(0)" style="padding-left: 5px;" id="composeNewTxt">Lets Chat11</a></p> -->
                   </div>
                <?php
				 } }
                ?>      
               
                <p class="sel_chat"><i class="fa fa-shopping-cart"  style="color: #035049;
    font-size: 15px;" aria-hidden="true"></i> <a style="padding-left: 8px;" href="<?php echo $BaseUrl.'/store/my-all-product.php?userid='.$SellId; ?>">Visit Store : (<?php echo $SelProduct;?> Products)</a></p>
	<?php 
	$p = new _productposting;
				$rd = $p->read($postId);
				
				if ($rd != false) {
					
					$row = mysqli_fetch_assoc($rd);
					$uid=$row['spuser_idspuser'];
				}
	?>
	
	<?php 
	if($uid!=$_SESSION['uid']){
	$pids=$_SESSION['pid'];
    $sp=new _flagpost;
    $spflag=$sp->readflag2($pids,$postId);
	if($spflag!=false){
	?>
	<?php if($_SESSION['guet_yes'] != 'yes'){ ?>
     <p class="sel_chat" onclick="flags()"><i class="fa fa-flag" style="color: #035049;
    font-size: 15px;"></i> &nbsp; <a>Flag this postss</a></p>
	<p id="flags"style="color:red;font-size:15px"></p>
	<?php  }	}
	
	
 
	
else {
	?>
	<?php if($_SESSION['guet_yes'] != 'yes'){ ?>
	<p class="sel_chat"><i class="fa fa-flag" style="color: #035049;
    font-size: 15px;"></i> &nbsp;<a href="javascript:void(0)" style="padding-left: 4px;" data-toggle="modal" data-target="#flagPost">Flag this post</a></p>
	<?php 
	} }	}?>
	 
	 
	 <?php 
	
      $sp=new _productposting;
	  $reads=$sp->readprofiles($postId);
	  //read spprofile
	  if($reads!=false){
	 $result= mysqli_fetch_assoc($reads);
	 $spprofile=$result['spProfiles_idspProfiles'];
	  }
	 //read user profile id
	
	 $spread=$sp->readuserids($spprofile); 
	 if($spread!=false){
	 $results2=mysqli_fetch_assoc($spread);
	 }
	 ?>
                <!-- Modal -->
                <div id="flagPost" class="modal fade" role="dialog"> 
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <form method="post" action="addtoflag.php" class="sharestorepos">
                            <div class="modal-content no-radius bradius-15">
                                <input type="hidden" name="spPosting_idspPosting" value="<?php echo $postId;?>">
								<input type="hidden" name="admin_userId" value="<?php echo $results2['spUser_idspUser'];?>">
                                <input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
                                <input type="hidden" name="spCategory_idspCategory" value="<?php echo $_GET['categoryID']?>">
                                <div class="modal-header bg-white br_radius_top">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">Flag Post</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="radio">
                                        <label><input type="radio" name="why_flag" value="Duplicate post" checked="">Duplicate post</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="why_flag" value="Posting Violation">Posting Violation</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="why_flag" value="Suspicious Post">Suspicious Post</label>
                                    </div>
                                    <div class="radio">
                                        <label><input type="radio" name="why_flag" value="Copied My Post">Copied My Post</label>
                                    </div> 

                                    <!-- <label>Why flag this post?</label> -->
                                    <textarea class="form-control" name="flag_desc" placeholder="Add Comments"></textarea>
                                </div>
                                <div class="modal-footer bg-white br_radius_bottom">
                                    <input type="submit" name="" class="btn butn_mdl_submit db_btn db_primarybtn">
                                    <button type="button" class="btn butn_cancel db_btn db_orangebtn" data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript">
 function flags(){
 document.getElementById('flags').innerText='you have already flagged this post from another profile';
 }
 
</script>
    
    <?php 
    // if(isset($SellId) && $SellId >0){
    //     include('connecting.php');
    // }
    
    ?>  


    <script type="text/javascript">

        function check_chat(){

             var logo = MAINURL+"/assets/images/logo/tsplogo.PNG";

                     swal({
                              title: "This is My Product.",
                              imageUrl: logo
                          });


        }
        








    </script>
