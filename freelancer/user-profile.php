  <?php
/* ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL); */

  include('../univ/baseurl.php');
  session_start();
  if(!isset($_SESSION['pid'])){ 
  $_SESSION['afterlogin']="store/";
  include_once ("../authentication/check.php");

  }else{
  function sp_autoloader($class) {
  include '../mlayer/' . $class . '.class.php';
  }
  spl_autoload_register("sp_autoloader");

  // ==CHEK PROFILE IS BUSINESS OR FREELANCE OR NOT
  $f = new _spprofiles;

  $re = new _redirect;
  //check profile is freelancer or not
  $chekIsFreelancer = $f->readfreelancer($_SESSION['pid']);
  if($chekIsFreelancer == false){
  $redirctUrl = $BaseUrl . "/my-profile/";
  $_SESSION['count'] = 0;
  $_SESSION['msg'] = "Please change your profile to Business Profile or Freelance Profile";
  $re->redirect($redirctUrl);
  }
  // END


  if(isset($_GET['profile']) && $_GET['profile'] > 0){
  $profileId = $_GET['profile'];
  }else{
  $redirctUrl = $BaseUrl . "/freelancer/";
  $re->redirect($redirctUrl);
  }
  ?>
  <!DOCTYPE html>
  <html lang="en-US"> 

  <head>
  <?php include('../component/f_links.php');?>
  <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl ?>/assets/css/design.css">

  <style type="text/css">



  .rating-box {
  position:relative!important;
  vertical-align: middle!important;
  font-size: 18px;
  font-family: FontAwesome;
  display:inline-block!important;
  color: lighten(@grayLight, 25%);
  /*padding-bottom: 10px;*/
  }

  .rating-box:before{
  content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
  }

  .ratings {
  position: absolute!important;
  left:0;
  top:0;
  white-space:nowrap!important;
  overflow:hidden!important;
  color: Gold!important;

  }
  .ratings:before {
  content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
  }

  </style>


  </head>

  <body class="bg_gray">
  <?php
  //session_start();

  $header_select = "freelancers";
  include_once("../header.php");
  ?>
  <section class="main_box" id="freelancers-page">
  <div class="container nopadding projectdetails userprofile">
  <p class="back-to-projectlist">
  <a href="<?php echo $BaseUrl.'/freelancer/freelancer.php?cat=ALL';?>"><i class="fa fa-chevron-left"></i>Back to Freelancer list</a>
  </p>
  <?php
  $p =  new _spprofiles;
  $result = $p->read($profileId);
  //echo $p->ta->sql;
  if($result){
  $row = mysqli_fetch_assoc($result);
  /* echo "<pre>";
  print_r($row);*/
  $Title = $row['spProfileName'];
  $country = $row['spProfilesCountry'];
  $state = $row['spProfilesState'];
  $city = $row['spProfilesCity'];
  $picture = $row['spProfilePic'];
  $spprofilesAddress = $row['spprofilesAddress'];



  $fi = new _spfreelancer_profile;
  $result_fi = $fi->getType($row['idspProfiles']);
  //echo $fi->ta->sql;
  /*        if($result_fi){
  $row_fi = mysqli_fetch_assoc($result_fi);
  $pro = new _projecttype;
  $result_pro = $pro->getProjectName($row_fi['spProfileFieldValue']);
  //echo $pro->ta->sql;
  if($result_pro){
  $row_pr = mysqli_fetch_assoc($result_pro);
  $ProjectName = $row_pr['project_title'];
  }else{
  $ProjectName = "Not Define";
  }
  }else{
  $ProjectName = "Not Define";
  }

  */

  // $profileis=$_GET['profile'];   selcect * from spprofile whrere idspprofile= $profileis
  $profileid=$_GET['profile'];
  //$_SESSION['profileids']=$profileid;
  $spobj= new _spprofiles;

  $result_read=$spobj->read_cure($profileid);

  if($result_read)
  {
  $userid='';
  $row_urecord= mysqli_fetch_assoc($result_read);

  $userid=$row_urecord['spUser_idspUser'];


  }

  //userid


  $spu= new _spuser;
  $result_user=$spu->read($userid);
  if($result_user){
  $currancys='';
  $row_user= mysqli_fetch_assoc($result_user);

  $currancys=$row_user['currency'];


  }




  $fi = new _spfreelancer_profile;
  $result_fi = $fi->read($row['idspProfiles']);
  //echo $fi->ta->sql;
  if($result_fi){
  $ProjectName = '';
  $perhour = '';
  $skill = '';
  $row_fi = mysqli_fetch_assoc($result_fi);
  /* print_r($row_fi);*/
  $skills = $row_fi['skill'];
  $hourlyrate = $row_fi['hourlyrate'];
  $overview = $row_fi['spProfileAbout'];
  $certification = $row_fi['certification'];
  $personalwebsite = $row_fi['personalwebsite'];
  $languagefluency = $row_fi['languagefluency'];


  /* while($row_fi = mysqli_fetch_assoc($result_fi)){
  if($skill == ''){
  if($row_fi['spProfileFieldName'] == 'skill_'){*/
  $skill = explode(',', $skills);
  /*       
  }
  }

  }*/
  }

  }
  ?>
  <div class="col-xs-12 col-sm-9 no-left-padding" >
  <div class="col-xs-12 profile-detail freelancerprofile" >
  <div class="col-xs-12 col-sm-2 nopadding">
  <?php
  if(isset($picture)){
  echo "<img  alt='Posting Pic' class='img-responsive center-block freelancerImg' src=' ".($picture)."' >" ;
  }else{
  echo "<img  alt='Posting Pic' class='img-responsive center-block freelancerImg' src='../img/default-profile.png' >" ;
  }
  ?>
  </div>
  <div class="col-xs-12 col-sm-10 freelancer-details">

  <?php	


  $profid1=$_SESSION['pid'];
  $uid1=$_SESSION['uid'];
  $flid=$_GET['profile'];
  $f = new _flagpost;
  $id = $f->read_heart($profid1,$uid1,$flid);
  if($id->num_rows>0){ 

    ?>
  <span id="savefun<?php echo $flid; ?>"><a onclick="myUnsave('<?php echo $flid; ?>')" class="profile_section icon-favorites fa fa-heart sp-favorites pull-right color: red" style="font-size:24px"></a></span>

 <!--  <?php	//header("location:user-profile.php");  ?> -->
  <?php
  }
  else{ 


    ?>

  <span id="savefun<?php echo $flid; ?>"><a onclick="myFun('<?php echo $flid; ?>')" class="profile_section icon-favorites fa fa-heart-o sp-favorites pull-right  color: red" style="font-size:24px"></a></span>
  <!-- <?php	//header("location:user-profile.php");  ?> -->

  <?php }
  ?>

  <p class="name"><?php echo ucwords(strtolower($Title));?>
  <p class="designation"><?php echo $ProjectName;?></p>
  <?php  
  // COUNTRY NAME
  $co = new _country;
  $result3 = $co->readCountryName($country);
  //echo $co->ta->sql;
  if($result3 && $result3->num_rows > 0){
  $row3 = mysqli_fetch_assoc($result3);
  $countryTitle = $row3['country_title'];
  }else{
  $countryTitle = "";
  }
  // CITY NAME
  $ci = new _city;
  $result4 = $ci->readCityName($city);
  if ($result4) {
  $row4 = mysqli_fetch_assoc($result4);
  $cityTitle = $row4['city_title'];
  }else{
  $cityTitle = "";
  }

  $st = new _state;
  $result5 = $st->readStateName($state);
  if ($result5) {
  $row5 = mysqli_fetch_assoc($result5);
  $stateTitle = $row5['state_title'];
  }else{
  $stateTitle = "";
  }

  ?>
  <?php if(!empty($countryTitle)){  ?>
  <p class="country"><i class="fa fa-map-marker"></i>&nbsp;<?php echo $cityTitle.' ,'.$stateTitle.' ,'. $countryTitle;?></p>
  <?php }?>

  <div class="professional-skills">
  <?php
  if(isset($skill) && $skill != ''){
  foreach($skill as $key => $value){
  echo "<span class='freelancer_uppercase'>".$value."</span>";
  }
  }else{
  echo "No Skills Define";
  }
  ?>
  </div>
  <br>
  <br>
  <?php if(isset($hourlyrate)){ ?>
  <div class="col-xs-12 nopadding"><span class="black pull-left">Hourly Rate:&nbsp;&nbsp;</span>
  <span class="red"><?php echo ($currancys);?>&nbsp;<?php echo $hourlyrate;?>/hr</span></div>

  <?php }  ?>

  <?php if(isset($certification)){ ?>

  <div class="col-xs-12 nopadding"><span class="black pull-left">Certification:&nbsp;&nbsp;</span>
  <span class=""><?php echo $certification;?></span></div>

  <?php }  ?>

  <?php if(isset($personalwebsite)){ ?>

  <div class="col-xs-12 nopadding pull-right"><span class="black ">Personal website:&nbsp;&nbsp;</span>
  <span class=""><?php echo $personalwebsite;?></span></div>

  <?php }  ?>

  <?php if(isset($languagefluency)){ ?>

  <div class="col-xs-12 nopadding"><span class="black pull-left">Language fluency:&nbsp;&nbsp;</span>
  <span class=""><?php echo $languagefluency;?></span></div>

  <?php }  ?>

  <?php if(isset($spprofilesAddress)){ ?>
  <div class="col-xs-12 nopadding pull-right"><span class="black ">Address:&nbsp;&nbsp;</span>
  <span class=""><?php echo $spprofilesAddress;?></span></div>

  <?php }  ?>
  <!-- <p><?php echo $hourlyrate ; ?>/hr</p> -->

  <?php


  $mr = new _freelance_recomndation;

  $resultsum1 = $mr->readfreelancerating($row['idspProfiles']);

  // echo $mr->ta->sql;

  $totalreviewrate1 = 0;
  $totalmyreviews1 = 0;

  if($resultsum1 != false){



  $totalmyreviews1 = $resultsum1->num_rows;

  //echo"here";  
  //  echo $totalreviews;


  while($rowreview1 = mysqli_fetch_assoc($resultsum1)){

  //  print_r($rowreview1);

  $sumrevrating1 += $rowreview1['recomnd_rating'];

  $rateingarr1[] =  $rowreview1['recomnd_rating'];

  }  

  $count1 = count($rateingarr1);

  $reviewaveragerate1 = $sumrevrating1 / $count1;

  $totalreviewrate1  = round($reviewaveragerate1, 1);

  /*echo $totalreviewrate1;
  */
  }      


  ?>




  <p class="rating_box">

  <div class="rating-box">
  <?php if($totalreviewrate1 >= "5") { 
  echo '<div class="ratings" style="width:100%;"></div>';
  }else  if($totalreviewrate1 > "4" && $totalreviewrate1 < "5") { 
  echo '<div class="ratings" style="width:92%;"></div>';
  }
  else  if($totalreviewrate1 >= "4") { 
  echo '<div class="ratings" style="width:80%;"></div>';
  }else  if($totalreviewrate1 > "3" && $totalreviewrate1 < "4") { 
  echo '<div class="ratings" style="width:72%;"></div>';
  }else  if($totalreviewrate1 >= "3") { 
  echo '<div class="ratings" style="width:60%;"></div>';
  }else  if($totalreviewrate1 > "2" && $totalreviewrate1 < "3") { 
  echo '<div class="ratings" style="width:51%;"></div>';
  }else  if($totalreviewrate1 >= "2") { 
  echo '<div class="ratings" style="width:38%;"></div>';
  }else  if($totalreviewrate1 > "1" && $totalreviewrate1 < "2") { 
  echo '<div class="ratings" style="width:29%;"></div>';
  }else  if($totalreviewrate1 >= "1") { 
  echo '<div class="ratings" style="width:16%;"></div>';
  }else  if($totalreviewrate1 <= "0" ) { 
  echo '<div class="ratings" style="width:0%;"></div>';
  }

  ?>

  </div>

  <a href="<?php echo $BaseUrl.'/freelancer/showfreelancerating.php?postid='.$profileId;?>"><span>&nbsp;&nbsp; Reviews : <?php echo $totalmyreviews1; ?>
  </span></a>

  </p>





  </div>

  <div class="col-xs-12 overview">
  <p class="heading">Overview:</p>
  <?php if(!empty($overview)){  ?>
  <p class="details-description "><?php //echo $overview;?></p>
  <?php }else{
  //echo $_SESSION['pid'];

  echo "<h3 class='text-center'>No Overview Found </h3>";
  }

  $fd= new _freelancerposting;

  $free=$fd->freelanceget($_GET['profile']);

  //print_r($free);
  //die("kjfjhbjhdkjghhkjbk");
  if($free){
  $free1= mysqli_fetch_assoc($free);
  }
 
  ?>

  <b style="font-size: 18px; color:black;">		Hourly Rate:	</b>
  <?php
  echo '<span style="font-size:18px">'.($currancys);?>&nbsp;
  <?php
  echo '<span style="font-size:18px">'.$free1['hourlyrate'].'</span>';
  echo '<br><br>';
  ?>

  <b style="font-size: 18px; color:black;">		Skills:		</b>
  <?php  $skills=$free1['skill'];
  $ex= explode(",",$skills);
  //echo $ex.'<br>';
  foreach($ex as $i){
  echo '<span style="font-size:18px">'.$i."  ".'</span>';
  }
  echo '<br><br>';?>


  <b style="font-size: 18px; color:black;">		Certification:	<?php	 ?></b>
  <?php  $cert=$free1['certification'];
  $ex= explode(",",$cert);
  //echo $ex.'<br>';
  foreach($ex as $i){
  echo '<span style="font-size:18px">'.$i."  ".'</span>';
  }
  echo '<br><br>';?>


  <b style="font-size: 18px; color:black;"> Project Worked:		   </b>
  <?php   $proj=$free1['projectworked'];
  $ex= explode(",",$proj);
  //echo $ex.'<br>';
  foreach($ex as $i){
  echo '<span style="font-size:18px">'.$i."  ".'</span>';
  }
  echo '<br><br>';?>

  <b style="font-size: 18px; color:black;"> Working Interest:		</b>
  <?php 	$work=$free1['workinginterests'];
  $ex= explode(",",$work);
  //echo $ex.'<br>';
  foreach($ex as $i){
  echo '<span style="font-size:18px">'.$i."  ".'</span>';
  }
  echo '<br><br>'; ?>

  <b style="font-size: 18px; color:black;">	Lanugage Fluency :</b>
  <?php  $lang=$free1['languagefluency'];
  $ex= explode(",",$lang);
  //echo $ex.'<br>';
  foreach($ex as $i){
  echo '<span style="font-size:18px">'.$i."  ".'</span>';
  }


  //echo $_SESSION['pid'];
  ?>
  </div>
  </div>
  </div>
  <div class="col-xs-12 col-sm-3  no-right-padding">
  <div class="col-xs-12 nopadding">
  <div class="col-xs-12 contact-marina contactfreelancer">
  <p class="contact-marina-heading contactheading freelancer_capitalize">Contact <?php echo $Title;?></p>
  <div class="col-xs-12 contact-marina-content contactcontent">



  <form method="post" id="messageform" action="freelance_chat_project.php" >
  <input type="hidden" name="chat_date" value="<?php echo date('Y-m-d h:m');?>">
  <input type="hidden" name="sender_idspProfiles" value="<?php echo $_SESSION['pid'];?>" >
  <input type="hidden" name="receiver_idspProfiles" value="<?php echo $_GET['profile']; ?>" >


  <div class="form-group">
  <label for="spPostingPrice_" class="price_label">Price</label><br>
  <label class="radio-inline" for="spPostingPrice_">

  <input type="radio" class="spPostField fixedprice" data-filter="0" id="spfixedPrice" name="PriceFixed" checked="" value="Fixed">Fixed Price</label>
  <label class="radio-inline" for="spPostingPrice_"><input type="radio" class="spPostField hourlyrate" data-filter="0" id="spfixedPrice" name="PriceFixed" value="Hourly">Hourly Rate</label>

  </div>
  <div class="form-group">
  <input type="text" class="form-control activity" id="bidPrice" name="bidPrice" data-filter="0" placeholder="Bid Price...." maxlength="8" aria-describedby="basic-addon1">

  </div>

  <div class="form-group">
  <textarea class="form-control inputField-textarea" id="myMessage" name="chat_conversation" placeholder="Message"></textarea>
  </div>


  <div class="form-group">


  <input type="button" id="FormSubmitButton" class="form-control inputSubmitField sendbtn" onclick="return message_submit()" value="Hire">
  </div>
  </form>



  </div>
  </div>
  <!--
  <div class="col-xs-12 blackBox">
  <p class="blackBox-heading">Work History</p>
  <div class="col-xs-12 blackBox-content">
  <p>8 jobs</p>
  <p>$4k+ earned</p>
  </div>
  </div>

  <div class="col-xs-12 blackBox">
  <p class="blackBox-heading">Availability</p>
  <div class="col-xs-12 blackBox-content">
  <p>Available</p>
  <p>More than 30 hrs/week</p>
  </div>
  </div>

  <a href="#" class="btn btn_freelancer" style="width: 100%">Hire Me</a>
  -->
  <div class="col-xs-12 profileLink">
  <p>Profile Link</p>
  <input type="text" name="" class="profileLinkField"  value="<?php echo $BaseUrl.'/freelancer/user-profile.php?profile='.$profileId;?>">
  </div>
  </div>
  </div>
  <!--
  <div class="col-xs-12 portfolioImages nopadding">
  <p class="heading">Portfolio Images</p>
  <div class="portfolio">
  <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/portfolioImg1.jpg" class="img-responsive">
  </div>
  <div class="portfolio">
  <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/portfolioImg2.jpg" class="img-responsive">
  </div>
  <div class="portfolio">
  <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/portfolioImg3.jpg" class="img-responsive">
  </div>
  <div class="portfolio">
  <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/portfolioImg4.jpg" class="img-responsive">
  </div>
  <div class="portfolio">
  <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/portfolioImg1.jpg" class="img-responsive">
  </div>
  <div class="portfolio">
  <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/portfolioImg2.jpg" class="img-responsive">
  </div>
  <div class="portfolio">
  <img src="<?php echo $BaseUrl;?>/assets/images/freelancer/portfolioImg3.jpg" class="img-responsive">
  </div>
  </div>
  <div class="col-xs-12 nopadding">
  <div class="col-xs-12 col-sm-4 well"></div>
  <div class="col-xs-12 col-sm-4 well"></div>
  <div class="col-xs-12 col-sm-4 well"></div>
  </div>

  <div class="col-xs-12 nopadding text-center">
  <a href="javascript:void(0);" class="btn submit-recomnedation-btn"> Submit a Recomnedation</a>
  </div>
  -->
  </div>
  </section>

  <script>
function myFun(postid){
  

  

$.ajax({
url: "/freelancer/addfav1.php",
type: "POST",
data: {
'postid':postid
},
success: function (response) {  
      
  $("#savefun"+postid).html('<a class="profile_section icon-favorites fa fa-heart sp-favorites pull-right color: red" onclick="myUnsave('+postid+')" style="font-size:24px"></a>');
  }

});

}



function myUnsave(postid){
  
 
$.ajax({
url: "/freelancer/delfav1.php",
type: "POST",
data: {
'postid':postid
},
success: function (response) {  
      
  $("#savefun"+postid).html('<a class="profile_section icon-favorites fa fa-heart-o sp-favorites pull-right" onclick="myFun('+postid+')" style="font-size:24px"></a>');
  }

});

}

  function message_submit(input) {
  var msg = $('#myMessage').val();


  if (msg.length == 0) {

  swal({
  title: "<img src='../assets/images/logo/tsp_trans.png' alt='The SharePage' style='width: 70px;height: 70px;'>",
  text: " <b>Message can't be blank. </b>",
  html: true,

  })
  return false;
  }else{

  swal({                     
  title: "<img src='../assets/images/logo/tsp_trans.png' alt='The SharePage' style='width: 70px;height: 70px;'>",
  text:  "<b>Request Sent Successfully. </b>",
  html: true,
  showConfirmButton: true
  },

  function() {
  $("#messageform").submit();
  //window.location = "<?php echo $BaseUrl;?>/freelancer";

  });
  }

  /*return true;*/
  }
  </script>



  <<!-- script>

  $('#submit').click(function(){

  if($.trim($('#myMessage').val()) == ''){


  alert();
  $('#head').text(" ");

  /*swal({
  title: "Good!",
  text: "Message Successful!",
  type: "success"
  }, function() {
  window.location = "freelance_chat.php";
  });*/

  }

  });
  </script> -->



  <?php 
  include('../component/f_footer.php');
  include('../component/f_btm_script.php'); 
  ?>
  </body>
  </html>
  <?php
  } ?>