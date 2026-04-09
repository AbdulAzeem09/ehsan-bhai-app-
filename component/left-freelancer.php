  <style>
  .zoom1:hover {
  -ms-transform: scale(1.05); /* IE 9 */
  -webkit-transform: scale(1.05); /* Safari 3-8 */
  transform: scale(1.05); 
  background-color:#fca66d!important;
  }

  #myList li{ display:none;
}
#loadMore {
    color:green;
    cursor:pointer;
}
#loadMore:hover {
    color:black;
}
#showLess {
    color:red;
    cursor:pointer;
}
#showLess:hover {
    color:black;
}


  </style>
  <div class="left_freelance_top">


  <!-- <h2 class="nameheading"><a href="<?php echo $BaseUrl;?>/freelancer">Freelancer</a></h2> -->

  <?php
  $p = new _spprofiles;
  if($_SESSION['ptid'] == 1 OR $_SESSION['ptid'] == 2){ ?>
  <div class="row no-margin">

  <p class="back-to-projectlist" style="padding-top:20px;margin-right: 135px;">
  <a type="button"  href="<?php echo $BaseUrl.'/freelancer/';?>" style="color: white;font-weight:bold;background-color:#f78d47;border-radius: 2px;padding: 7px;" class="zoom1 btn-border-radius"><i class="fa fa-arrow-left"></i>&nbsp; Home</a>
  </p>
  <br />
  <div class="col-md-4 no-padding">
  <?php
  $result = $p->read($_SESSION['pid']);
  if ($result != false) {
  $row = mysqli_fetch_assoc($result);
  if (isset($row["spProfilePic"])){
  echo "<img alt='profilepic' class='img-responsive propic center-block' src=' " . ($row["spProfilePic"]) . "'  style='margin-left:0px;'>";
  }else{
  echo "<img alt='profilepic' class='img-responsive img-circle propic center-block' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px; height: 40px;margin-left:0px;' >";
  }
  }
  ?>
  </div>
  <div class="col-md-8" style="padding-left:5px;">
  <div class="dropdown" id="drop0">
  <button class="btn btn-primary dropdown-toggle freelancer_capitalize sidedropdown" type="button" data-toggle="dropdown"><?php echo $_SESSION['MyProfileName']; ?>
  <span class="caret" id="caret0"></span></button>
  <ul class="dropdown-menu sp-profile-det">
  <?php

  $rpvt = $p->readProfiles($_SESSION["uid"]);
  //echo $p->ta->sql;
  if ($rpvt != false){
  while($row = mysqli_fetch_assoc($rpvt)) {
  if($row['spProfileType_idspProfileType'] == 1 || $row['spProfileType_idspProfileType'] == 2){
  ?>
  <li>
  <a id='makedefaultprofile' class='freelancer_capitalize' data-profileid='<?php echo $row['idspProfiles'];?>' data-profiletype='<?php echo $row['spProfileTypeName']; ?>' >

  <?php if (isset($row["spProfilePic"]) && !empty($row["spProfilePic"]))
  {
  echo "<img alt='Posting Pic' class='img-responsive' src=' ".($row["spProfilePic"])."'>"; 
  }else{
  echo "<img alt='Posting Pic' class='img-responsive' src='../assets/images/blank-img/default-profile.png' >";
  }
  ?>

  <?php echo $row['spProfileName'];?> 
  <br><span><?php echo $row['spProfileTypeName']. " Profile";?></span>


  </a>


  </li>
  <?php
  }
  }
  }
  ?>

  </ul>
  </div>
  </div>
  <?php       
  $rpvt = $p->readprofile_type($_SESSION["pid"]);

  //print_r($rpvt)
  if ($rpvt != false){
  while($row = mysqli_fetch_assoc($rpvt)) {

  if($row['spProfileType_idspProfileType'] == 2){?>

  <br><span class="freelancer_profile">(<?php echo $row['spProfileTypeName']." Profile";?>)</span>

  <?php } ?>
  <?php  if($row['spProfileType_idspProfileType'] == 1){?>

  <br><span class="freelancer_profile">(<?php echo $row['spProfileTypeName']." Profile";?>)</span>                                
  <?php }
  }
  }
  ?> 

  </div>

  <?php            
  }else{ 
  $re = new _redirect;
  $result2 = $p->readBusFreeProfiles($_SESSION['uid']);
  if($result2){
  $row2 = mysqli_fetch_assoc($result2);
  $LeftProName = $row2['spProfileName'];
  $LeftProId = $row2['idspProfiles'];

  }else{

  $redirctUrl = $BaseUrl . "/freelancer/";
  $_SESSION['count'] = 0;
  $_SESSION['msg'] = "Please change your profile to Business Profile or Freelance Profile";
  $re->redirect($redirctUrl);

  }
  ?>
  <div class="row no-margin">
  <div class="col-md-4 no-padding">
  <?php
  $result3 = $p->read($LeftProId);
  if ($result3 != false) {
  $row3 = mysqli_fetch_assoc($result3);
  if (isset($row3["spProfilePic"])){
  echo "<img alt='profilepic' class='img-responsive propic center-block' src=' " . ($row3["spProfilePic"]) . "'  >";
  }else{
  echo "<img alt='profilepic' class='img-responsive propic center-block' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px; height: 40px;' >";
  }
  } ?>
  </div>
  <div class="col-md-8">
  <div class="dropdown" style="background-color: #3e3e3e!important;">
  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: #3e3e3e!important;"><?php echo $LeftProName; ?>
  <span class="caret"></span></button>
  <ul class="dropdown-menu sp-profile-det">
  <?php

  $rpvt = $p->readProfiles($_SESSION["uid"]);
  //echo $p->ta->sql;
  if ($rpvt != false){
  while($row = mysqli_fetch_assoc($rpvt)) {
  if($row['spProfileType_idspProfileType'] == 1 || $row['spProfileType_idspProfileType'] == 2){
  ?>
  <li>
  <a id='makedefaultprofile' data-profileid='<?php echo $row['idspProfiles'];?>' data-profiletype='<?php echo $row['spProfileTypeName']; ?>' >
  <img src="<?php echo ($row["spProfilePic"]);?>" class="img-responsive"> <?php echo $row['spProfileName'];?> <br><span><?php echo $row['spProfileTypeName']. " Profile";?></span>
  </a>
  </li>
  <?php
  }
  }
  }
  ?>

  </ul>
  </div>
  </div>
  <?php       
  $rpvt = $p->readprofile_type($_SESSION["pid"]);

  //print_r($rpvt)
  if ($rpvt != false){
  while($row = mysqli_fetch_assoc($rpvt)) {

  if($row['spProfileType_idspProfileType'] == 2){?>

  <br><span class="freelancer_profile">(<?php echo $row['spProfileTypeName']." Profile";?>)</span>

  <?php } ?>
  <?php  if($row['spProfileType_idspProfileType'] == 1){?>

  <br><span class="freelancer_profile">(<?php echo $row['spProfileTypeName']." Profile";?>)</span>                                
  <?php }
  }
  }
  ?> 

  </div>

  <?php

  }

  // print_r($_POST);
  ?>

  <h1 class="skill-category">Skill Categories</h1>

  <h1 class="" style="font-size: 20px;
  font-family: Marksimon!important; <?php if (isset($_POST['cat'])) {
  echo "border: 1px solid #a1a1a1;
  background-color: #fff;
  border-left: 4px solid #ff6802;
  padding: 4px 1px 3px 5px;";
  } ?>">

  <!--<a href="#0" class="button" data-toggle="modal" data-target="#myfeed" style="color: black; " >My Feed</a>
  <!  <a href="#0" class="button"  style="color: black; " >My Feed</a> -->
  </h1>

  <form action="projects.php" method="POST">


  <div class="modal fade" id="myfeed" role="dialog">
  <div class="modal-dialog modal-sm">
  <div class="modal-content modalwidth">
  <div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title" style="font-size: 25px;">My Feed</h4>
  </div>

  <!-- <form method="post" action="projects.php"> -->
  <div class="modal-body">

  <ul class="nav skill-category-list">

  <!-- <li id="li_checkbox1"> -->

  <?php
  $m = new _subcategory;

  $catid = 5;
  $result = $m->showall_id($catid);
  $row = mysqli_fetch_assoc($result);
  //	print_r($row);
  //	exit;

  $get_profile_id = new _spprofiles;
  $get_profile_data = $p->readProfiles($_SESSION["uid"]);
  $ids = array();
  if ($get_profile_data != false){
  while($row = mysqli_fetch_assoc($get_profile_data)) {
  $ids[] = $row["idspProfiles"];
  //echo "<pre>"; print_r($row); 
  }
  //exit;
  }

  $implode_profileids = implode("','", $ids);

  if($result){
  while ($row = mysqli_fetch_assoc($result)) { 

  // print_r($row);

  // $p = new _postingview;
  $sf  = new _freelancerposting;




  $res = $sf->total_post_freelancer1($row['subCategoryTitle'],$implode_profileids);
  /* $st= new _spuser;
  $st1=$st->readdatabybuyerid($_SESSION['uid']);
  if($st1!=false){
  $stt=mysqli_fetch_assoc($st1);
  $account_status=$stt['deactivate_status'];
  }*/

  if($res){
  $totalProject = $res->num_rows;
  }else{
  $totalProject = 0;
  }

  ?>


  <!-- <a href="<?php echo $BaseUrl.'/freelancer/projects.php?cat='.$row['idsubCategory'];?>"
  class="<?php  if(isset($_GET['cat'])){ echo ($_GET['cat'] == $row['idsubCategory'])? 'active': '';}
  ?>" > -->

  <label for="checkbox<?php echo $row['subCategoryTitle']; ?>" id="checkbox1_label" class="control-label checkboxtab">
  <input type="checkbox" class="" id="checkbox<?php echo $row['subCategoryTitle']; ?>" name="cat[]" value="<?php echo ($row['subCategoryTitle']);?>" style="position: unset!important;opacity: unset!important;cursor: pointer!important;height: unset!important;width: unset!important;" ><!-- <span class="checkmark"></span>  -->

  <?php echo ($row['subCategoryTitle']);?>(<?php echo $totalProject;?>)</label>

  <!--  </a> -->

  <!--</li> -->

  <?php
  }
  }
  ?>
  </ul>


  </div>
  <div class="modal-footer">

  <button type="submit" id="" style="background-color: #ff9900!important;" class="btn btn-primary btn-modalsubmit">Submit</button>


  <!--      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
  </div>

  </form>
  </div>
  </div>
  </div>

  </form>



  <ul class="nav skill-category-list" id="myList">
  <?php  $s = new _subcategory;
  $sf  = new _freelancerposting;
  $idresult = $s->showall_id(5);
  $get_profile_id = new _spprofiles;
  $get_profile_data = $p->readProfiles($_SESSION["uid"]);
  $ids = array();
  if ($get_profile_data != false){
  while($row = mysqli_fetch_assoc($get_profile_data)) {
  $ids[] = $row["idspProfiles"];
  }
  //exit;
  }
  $implode_profileids = implode("','", $ids);
  while($row4 = mysqli_fetch_assoc($idresult)){
  $catidall[]=$row4['idsubCategory'];
  }
  $commaseprated_id = "'" . implode ( "', '", $catidall) . "'";
  $result1 = $m->showall_Nameall($commaseprated_id);
  // echo $m->ta->sql;
  if ($result1) {
  while($row5 = mysqli_fetch_assoc($result1))
  {
  $subCategoryTitle[] =$row5['subCategoryTitle'];   
  }   
  $subCategoryTitle_name = "'" . implode ( "', '", $subCategoryTitle) . "'";
  $res = $sf->total_post_freelancer_name1($subCategoryTitle_name);
  //echo $p->ta->sql;
  if($res!=false){
  while($dog=mysqli_fetch_assoc($res)){
  }
  }
  if($account_status!=1){
  if($res!=false){
  $allProject = $res->num_rows;
  }}else{
  $allProject = 0;
  }   
  ?>  
  <li>
  <a href="<?php echo $BaseUrl.'/freelancer/projects.php?cat=ALL';?>" 
  class="<?php if(isset($_GET['cat'])){ echo ($_GET['cat'] == 'ALL')? 'active': '';}  ?>" title="">All <span class="red">(<?php echo $allProject;?>)</span></a>
  </li>          
  <?php   }
  ?>
  <?php
  $m = new _subcategory;
  $catid = 5;
  $result9 = $m->read($catid);
  if($result9){
  while ($row9 = mysqli_fetch_assoc($result9)) { 
  $result = $m->showName($row9['idsubCategory']);
  if ($result!=false) {
  $row3 = mysqli_fetch_assoc($result);
  }
  $cate = $row3['subCategoryTitle']; 
  $sf  = new _freelancerposting;
  $res = $sf->total_post_freelancer1($row3['subCategoryTitle']);
  if($account_status!=1){				
  if($res){
  $totalProject = $res->num_rows;
  }}else{
  $totalProject = 0;
  }

  ?>
  <li>
  <a href="<?php echo $BaseUrl.'/freelancer/projects.php?cat='.$row9['idsubCategory'];?>"
  class="<?php  if(isset($_GET['cat'])){ echo ($_GET['cat'] == $row9['idsubCategory'])? 'active': '';}
  ?>" >
  <?php echo ucfirst(strtolower($row9['subCategoryTitle']));?>
  <span class="red">(<?php echo $totalProject;?>)</span>
  </a>
  </li>
  <?php
  $totalProject=0;
  }
  }
  ?>



  </ul>
  <div id="loadMore">Load more</div>
<div id="showLess">Show less</div>
    </div>
    <script>
        $(document).ready(function () {
    size_li = $("#myList li").size();
    x=15;
    $('#myList li:lt('+x+')').show();
    $('#loadMore').click(function () {
        x= (x+5 <= size_li) ? x+5 : size_li;
        $('#myList li:lt('+x+')').show();
        if(size_li == x){
          $('#loadMore').hide();
        } else {
          $('#loadMore').show();
        }

    });
    $('#showLess').click(function () {
        x=(x-5<0) ? 3 : x-5;
        $('#myList li').not(':lt('+x+')').hide();
        if(size_li == x){
          $('#loadMore').hide();
        } else {
          $('#loadMore').show();
        }

    });
});
    </script>