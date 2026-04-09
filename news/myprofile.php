<?php 
 //error_reporting(E_ALL);
// ini_set('display_errors', 'On');

   include '../univ/baseurl.php';
   session_start();
   
   if (!isset($_SESSION['pid'])) {
   	$_SESSION['afterlogin'] = "videos/";
   	include_once "../authentication/check.php";
   
   } else {
   	function sp_autoloader($class)
   	{
   		include '../mlayer/' . $class . '.class.php';
   	}
   	spl_autoload_register("sp_autoloader");
   
   
   	$_GET["categoryID"]   = "26";
   	$_GET["categoryName"] = "News";
   
   	$f = new _spprofilehasprofile;
   
   	$totalFrnd = array();
   	$result3   = $f->readallfriend($_SESSION['pid']);
   	if ($result3 != false) {
   		while ($row3 = mysqli_fetch_assoc($result3)) {
   			array_push($totalFrnd, $row3['spProfiles_idspProfilesReceiver']);
   		}
   	}
   
   	$result4 = $f->readall($_SESSION['pid']);
   	if ($result4 != false) {
   		while ($row4 = mysqli_fetch_assoc($result4)) {
   			array_push($totalFrnd, $row4['spProfiles_idspProfileSender']);
   		}
   	}

   	$friend_ids = implode("','", $totalFrnd);
   	$friend_id  = "'" . $friend_ids . "'";
      
   	$pageactive = 7;
   
   	?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <?php include '../component/f_links.php';?>
      <link rel="stylesheet" href="css/bootstrap.min.css" >
      <!-- Optional theme -->
      <link rel="stylesheet" href="css/bootstrap-theme.min.css">
      <!-- <link rel="stylesheet" type="text/css" href="css/docs.theme.min.css"> -->
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" type="text/css" href="css/newsviews.css"> 
      <script type="text/javascript">
         let h = window.innerHeight;
         document.getElementById("wrapper").style.height = h+'px';
         alert(h);
      </script>
      <script type="text/javascript" src="js/news.js"></script> 
	  <style>
	  .media {
    border-left: 1px solid #000!important;
    border-bottom: 1px solid #000!important;
	border-right: 1px solid #000!important;
    border-top: 1px solid #000!important;
    margin-bottom: 5px;
    padding-left: 10px;
}
.img-circle {
    border-radius: 50%;
    width: 40px!important;
    height: 40px!important;
}
.media-heading {
    margin-top: 7px !important;
    margin-bottom: 5px !important;
}

	  </style>
	  
   </head>
   <?php
      //session_start();
      
      $header_select = "header_video";
      include_once "../header.php";
      ?>
   <body cz-shortcut-listen="true">
      <div class="container-fluid">
         <div class="row">
            <div class="lsbar">
               <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><i class="fa fa-bars"></i></a>
               <div id="wrapper" class="wrapper">
                  <?php  include_once("newsSidebar.php"); 
                     $object=new _spprofiles;
                     
                     $resu=$object->readprofilebanner($_SESSION['pid']);
                     
                     $roww1=mysqli_fetch_assoc($resu);
                     
                     $banner=$roww1['banner_image'];
                     //die("********************************");
                     
                     
                     
                     
                     ?>
                  <!-- Page Content -->
                  <!-- Page Content -->
                  <div id="page-content-wrapper">
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-md-6 h style-1">
                              <!-- Column -->
                              <div class="row">
                                 <div class="card">
                                    <?php  if($banner){   ?>
                                    <img class="card-img-top img-responsive" src="<?php echo $banner; ?>" alt="Card image cap" style="width: 97%;height: 240px; "><span style="font-size:25px; margin-right:11px; color:#a07eff;cursor:pointer"  data-toggle="modal" data-target="#myModal2"><i class="fa fa-edit pull-right" title="Edit Banner"  style="font-size:35px; margin-right:30px; position:absolute; z-index: 100;    margin-top: -1px; margin-left: 476px;color: black;"></i></span>
   
   
                                    <?php } else{?>
                                    <img class="card-img-top img-responsive" src="img/pinksky.jpg" alt="Card image cap"><span style="font-size:35px; margin-right:20px; color:#a07eff;cursor:pointer"  data-toggle="modal" data-target="#myModal2"><i class="fa fa-edit pull-right" title="Edit Banner"  style="font-size:25px; margin-right: 3px; "></i></span>
                                    <?php }?>
                                    <div class="card-body little-profile">
                                       <div class="col-lg-6 col-md-6 col-xs-6">
                                          <div class="pro-img">
                                             <?php
                                                $p = new _spprofiles;
                                                $result = $p->read($_SESSION['pid']);
                                                if ($result != false) {
                                                   $row = mysqli_fetch_assoc($result);
                                                   if (isset($row["spProfilePic"]) && $row['spProfilePic'] != '')
                                                       echo "<img alt='user' class='img-responsive' src=' " . ($row["spProfilePic"]) . "'  >";
                                                   else
                                                       echo "<img alt='user' class='img-responsive' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px; height: 40px;' >";
                                                }
                                                $profiletype=$row['spProfileType_idspProfileType'];
                                                $sptypes=$p->spread($profiletype);
                                                $row1=mysqli_fetch_assoc($sptypes);
                                                ?>
                                             <!-- <img src="https://i.imgur.com/8RKXAIV.jpg" alt="user" class="img-responsive"> -->
                                          </div>
                                          <h3 style=" margin-top: 30px; white-space: nowrap;">@<?php 
                                             if($row['alias_name']){
                                             
                                             
                                             echo str_replace(" ","_",$row['alias_name']); 
                                             }
                                             else
                                             {
                                              echo str_replace(" ","_",$_SESSION['spProfileName']);  
                                             }
                                             
                                             
                                             ?> 
                                             <span class="fa fa-edit" data-toggle="modal" data-target="#myModal" style="color:#a07eff;cursor:pointer"></span>
                                          </h3>
                                          <span class="" style="font-size:13px"><?php echo (isset($row['spProfileName'])? ucwords(strtolower($row['spProfileName'])) : "Profile "); ?>&nbsp;&nbsp;(<?php echo $row1['spProfileTypeName']; ?>&nbsp;Profile)&nbsp;&nbsp; </span>
                                          <!--p><?php echo $_SESSION['ptname']; ?> </p> <a href="#" class="waves-effect waves-dark btn btn-primary btn-md btn-rounded" data-abc="true">Follow</a-->
                                       </div>
                                       <div class="col-lg-2 col-md-2 col-xs-2" style="margin-top:-50px; text-align:center">
                                          <a href="<?php echo $BaseUrl;?>/news/bucket.php">
                                             <h3 class="">
                                                <?php 
                                                   $n = new _news;
												     if($_SESSION['guet_yes'] != "yes"){
                                                   $bucketCountResult = $n->read_bucket_news($_SESSION['pid']); 
                                                   if($bucketCountResult != false){
                                                   $bucketCount = mysqli_num_rows($bucketCountResult);
                                                   echo $bucketCount;
                                                   } else {
                                                   echo 0;
                                                   }
                                                   }
												   else{
													  echo 0; 
												   }
                                                   ?>
                                             </h3>
                                             <small>Bucket</small>
                                          </a>
                                       </div>
                                       <div class="col-lg-2 col-md-2 col-xs-2" style="margin-top:-50px; text-align:center">
                                          <a href="<?php echo $BaseUrl;?>/news/follower.php?id=<?php echo $_SESSION['pid']; ?>">
                                             <h3 class=""><?php 
                                                $obj=new _spprofilefeature;
                                                $ress=$obj->readfollowersallcount($_SESSION['pid']);
												if($ress!=false){
                                                $rw=mysqli_fetch_assoc($ress);
												}              $count1=$ress->num_rows;
												         $count=$count1-1;
                                                  
                                                if( $count>0){
                                                echo $count;
                                                }
                                                else{
                                                	echo "0";
                                                }
                                                ?></h3>
                                             <small>Followers</small>
                                          </a>
                                       </div>
                                       <div class="col-lg-2 col-md-2 col-xs-2" style="margin-top:-50px;text-align:center">
                                          <a href="<?php echo $BaseUrl;?>/news/following.php?id=<?php echo $_SESSION['pid']; ?>">
                                             <h3 class=""><?php 
                                                $obj=new _spprofilefeature;
                                                $ress2=$obj->readforallcount($_SESSION['pid']);
                                                
                                                                    $count3=$ress2->num_rows;
                                                  $count2=$count3-1;
                                                if( $count2>0){
                                                echo $count2;
                                                }
                                                else{
                                                	echo "0";
                                                }
                                                ?></h3>
                                             <small>Following</small>
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <hr>
                              <!-- article sec -->
                              <?php
							   $obj2=new _spprofiles;
                                 $res4= $obj2->readcommentdata2($_SESSION['pid']);
                                 $allcount2 = $res4->num_rows;
                                 
                                 
                                 // print_r($res4);
                                 //die("*************");
                                 //die("9999999999999999999999999999999999999999999");
                                 
                                 if($res4!=false){
                                 while(  $row4=mysqli_fetch_assoc($res4)){
                                 $id=$row4['id'];
                                 $pids=$row4['pid'];
                                 $uid=$row4['userid'];
                                 $msg1=$row4['comment'];
                                 
                                 
                                 $reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
                                 if(preg_match($reg_exUrl, $msg1, $url)) {
                                 $msg= preg_replace($reg_exUrl, '<a target=" " href="'.$url[0].'" rel="nofollow">'.$url[0].'</a>', $msg1);
                                 
                                 } else {
                                 
                                 
                                 $msg= $msg1;
                                 
                                 }
                                 
                                 //cccccccc
                                 $date=$row4['comment_date'];
                                 
                                 $ppid=$row4['pid'];
                                 
                                 
                                 $res5=$obj2->readcommentbypid($ppid);
                                 $row5=mysqli_fetch_assoc($res5);
                                 
                                 $pic=$row5['spProfilePic'];
                                 $name=$row5['spProfileName'];
                                 // die("9999999999999999999999999999999999999999999");
                                 
                                 
                                 include('myprofileData.php');	 						 
                                 
                                 
                                 
								 }?>
                         <h1 class="load-more1" style="text-align: center; color: #5088ef; font-size: 24px;cursor:pointer;" >Load More</h1>
						 <?php  } ?>
                              <input type="hidden" id="row1" value="0">
                              <input type="hidden" id="all1" value="<?php echo $allcount2; ?>"> 
                           </div>
                           <div class="col-md-6 h style-1">
                              <?php  include_once("rightSidebar.php"); ?>
                              <!--div class="viewscontent">
                                 <h1> Views</h1>
                                 <div class="post-comments">
                                    <form>
                                       <div class="form-group">
                                          <label for="comment">Your Views</label> <label class="pull-right">Follower <strong>250</strong> | Follwoing <strong>12</strong></label>
                                          <textarea name="comment" class="form-control" rows="3"></textarea>
                                       </div>
                                       <button type="submit" class="btn btn-default">Send</button>
                                    </form>
                                    <div class="comments-nav">
                                       <ul class="nav nav-pills">
                                          <li role="presentation" class="dropdown">
                                             <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                             Views 259 <span class="caret"></span>
                                             </a>
                                             <ul class="dropdown-menu">
                                                <li><a href="#">All</a></li>
                                                <li><a href="#">My Views</a></li>
                                                <li><a href="#">Follower Views</a></li>
                                             </ul>
                                          </li>
                                       </ul>
                                    </div>
                                    <div class="media">
                                       <!-- first comment -->
                              <!--div class="media-heading">
                                 <button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-minus" aria-hidden="true"></span></button> <span class="label"><img src="img/uiface.jpg" class="img-circle"></span> <a href="profile.html">@terminator</a> 12 hours ago <span class="pull-right">1 comment</span>
                                 </div>
                                 <div class="panel-collapse collapse in" id="collapseOne">
                                 <div class="media-left">
                                    <div class="vote-wrap">
                                       <div class="save-post">
                                          <a href="#"><span class="fa fa-star" aria-label="Save"></span></a>
                                       </div>
                                       <div class="vote up">
                                          <i class="fa fa-menu-up"></i>
                                       </div>
                                       <div class="vote inactive">
                                          <i class="fa fa-menu-down"></i>
                                       </div>
                                    </div>
                                    <!-- vote-wrap ->
                                 </div>
                                 <!-- media-left >
                                 <div class="media-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                                    </p>
                                    <div class="comment-meta">
                                       <span><a href="#">delete</a></span>
                                       <span><a href="#">report</a></span>
                                       <span><a href="#">hide</a></span>
                                       <span>
                                       <a class="" role="button" data-toggle="collapse" href="#replyCommentT" aria-expanded="false" aria-controls="collapseExample">reply</a>
                                       </span>
                                       <div class="collapse" id="replyCommentT">
                                          <form>
                                             <div class="form-group">
                                                <label for="comment">Your Comment</label>
                                                <textarea name="comment" class="form-control" rows="3"></textarea>
                                             </div>
                                             <button type="submit" class="btn btn-default">Send</button>
                                          </form>
                                       </div>
                                    </div>
                                    <!-- comment-meta ->
                                    <div class="media">
                                       <!-- answer to the first comment >
                                       <div class="media-heading">
                                          <button class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-minus" aria-hidden="true"></span></button> <span class="label"><img src="img/uiface.jpg" class="img-circle"></span> <a href="profile.html">@veru</a> 12 sat once yazmis
                                       </div>
                                       <div class="panel-collapse collapse in" id="collapseTwo">
                                          <div class="media-left">
                                             <div class="vote-wrap">
                                                <div class="save-post">
                                                   <a href="#"><span class="fa fa-star" aria-label="Save"></span></a>
                                                </div>
                                                <div class="vote up">
                                                   <i class="fa fa-menu-up"></i>
                                                </div>
                                                <div class="vote inactive">
                                                   <i class="fa fa-menu-down"></i>
                                                </div>
                                             </div>
                                             <!-- vote-wrap ->
                                          </div>
                                          <!-- media-left >
                                          <div class="media-body">
                                             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                                             </p>
                                             <div class="comment-meta">
                                                <span><a href="#">delete</a></span>
                                                <span><a href="#">report</a></span>
                                                <span><a href="#">hide</a></span>
                                                <span>
                                                <a class="" role="button" data-toggle="collapse" href="#replyCommentThree" aria-expanded="false" aria-controls="collapseExample">reply</a>
                                                </span>
                                                <div class="collapse" id="replyCommentThree">
                                                   <form>
                                                      <div class="form-group">
                                                         <label for="comment">Your Comment</label>
                                                         <textarea name="comment" class="form-control" rows="3"></textarea>
                                                      </div>
                                                      <button type="submit" class="btn btn-default">Send</button>
                                                   </form>
                                                </div>
                                             </div>
                                             <!-- comment-meta ->
                                          </div>
                                       </div>
                                       <!-- comments ->
                                    </div>
                                    <!-- answer to the first comment ->
                                 </div>
                                 </div>
                                 <!-- comments ->
                                 </div>
                                 <!-- first comment ->
                                 <div class="media">
                                 <!-- first comment >
                                 <div class="media-heading">
                                 <button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-minus" aria-hidden="true"></span></button> <span class="label"><img src="img/uiface.jpg" class="img-circle"></span> <a href="profile.html">@guru</a> 12 min ago <span class="pull-right">4 comment</span>
                                 </div>
                                 <div class="panel-collapse collapse in" id="collapseThree">
                                 <div class="media-left">
                                    <div class="vote-wrap">
                                       <div class="save-post">
                                          <a href="#"><span class="fa fa-star" aria-label="report"></span></a>
                                       </div>
                                       <div class="vote up">
                                          <i class="fa fa-menu-up"></i>
                                       </div>
                                       <div class="vote inactive">
                                          <i class="fa fa-menu-down"></i>
                                       </div>
                                    </div>
                                    <!-- vote-wrap ->
                                 </div>
                                 <!-- media-left >
                                 <div class="media-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                                    </p>
                                    <div class="comment-meta">
                                       <span><a href="#">delete</a></span>
                                       <span><a href="#">report</a></span>
                                       <span><a href="#">hide</a></span>
                                       <span>
                                       <a class="" role="button" data-toggle="collapse" href="#replyCommentFour" aria-expanded="false" aria-controls="collapseExample">reply</a>
                                       </span>
                                       <div class="collapse" id="replyCommentFour">
                                          <form>
                                             <div class="form-group">
                                                <label for="comment">Yorumunuz</label>
                                                <textarea name="comment" class="form-control" rows="3"></textarea>
                                             </div>
                                             <button type="submit" class="btn btn-default">Yolla</button>
                                          </form>
                                       </div>
                                    </div>
                                    <!-- comment-meta >
                                    <div class="media">
                                       <!-- answer to the first comment >
                                       <div class="media-heading">
                                          <button class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-minus" aria-hidden="true"></span></button> <span class="label"><img src="img/uiface.jpg" class="img-circle"></span> <a href="profile.html">@terminator</a> 12 days ago
                                       </div>
                                       <div class="panel-collapse collapse in" id="collapseFour">
                                          <div class="media-left">
                                             <div class="vote-wrap">
                                                <div class="save-post">
                                                   <a href="#"><span class="fa fa-star" aria-label="report"></span></a>
                                                </div>
                                                <div class="vote up">
                                                   <i class="fa fa-menu-up"></i>
                                                </div>
                                                <div class="vote inactive">
                                                   <i class="fa fa-menu-down"></i>
                                                </div>
                                             </div>
                                             <!-- vote-wrap ->
                                          </div>
                                          <!-- media-left >
                                          <div class="media-body">
                                             <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                                             </p>
                                             <div class="comment-meta">
                                                <span><a href="#">delete</a></span>
                                                <span><a href="#">report</a></span>
                                                <span><a href="#">hide</a></span>
                                                <span>
                                                <a class="" role="button" data-toggle="collapse" href="#replyCommentFive" aria-expanded="false" aria-controls="collapseExample">reply</a>
                                                </span>
                                                <div class="collapse" id="replyCommentFive">
                                                   <form>
                                                      <div class="form-group">
                                                         <label for="comment">Yorumunuz</label>
                                                         <textarea name="comment" class="form-control" rows="3"></textarea>
                                                      </div>
                                                      <button type="submit" class="btn btn-default">Yolla</button>
                                                   </form>
                                                </div>
                                             </div>
                                             <!-- comment-meta>
                                             <div class="media">
                                                <!-- first comment >
                                                <div class="media-heading">
                                                   <button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#collapseFive" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-minus" aria-hidden="true"></span></button> <span class="label"><img src="img/uiface.jpg" class="img-circle"></span> <a href="profile.html">@terminator</a> 12 sat once yazmis
                                                </div>
                                                <div class="panel-collapse collapse in" id="collapseFive">
                                                   <div class="media-left">
                                                      <div class="vote-wrap">
                                                         <div class="save-post">
                                                            <a href="#"><span class="fa fa-star" aria-label="report"></span></a>
                                                         </div>
                                                         <div class="vote up">
                                                            <i class="fa fa-menu-up"></i>
                                                         </div>
                                                         <div class="vote inactive">
                                                            <i class="fa fa-menu-down"></i>
                                                         </div>
                                                      </div>
                                                      <!-- vote-wrap >
                                                   </div>
                                                   <!-- media-left >
                                                   <div class="media-body">
                                                      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                                                      </p>
                                                      <div class="comment-meta">
                                                         <span><a href="#">delete</a></span>
                                                         <span><a href="#">report</a></span>
                                                         <span><a href="#">hide</a></span>
                                                         <span>
                                                         <a class="" role="button" data-toggle="collapse" href="#replyCommentSix" aria-expanded="false" aria-controls="collapseExample">reply</a>
                                                         </span>
                                                         <div class="collapse" id="replyCommentSix">
                                                            <form>
                                                               <div class="form-group">
                                                                  <label for="comment">Yorumunuz</label>
                                                                  <textarea name="comment" class="form-control" rows="3"></textarea>
                                                               </div>
                                                               <button type="submit" class="btn btn-default">Yolla</button>
                                                            </form>
                                                         </div>
                                                      </div>
                                                      <!-- comment-meta ->
                                                      <div class="media">
                                                         <!-- answer to the first comment >
                                                         <div class="media-heading">
                                                            <button class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse" data-target="#collapseSix" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-minus" aria-hidden="true"></span></button> <span class="label"><a href="profile.html"><img src="img/uiface.jpg" class="img-circle"></span> @terminator</a> 12 sat once 
                                                         </div>
                                                         <div class="panel-collapse collapse in" id="collapseSix">
                                                            <div class="media-left">
                                                               <div class="vote-wrap">
                                                                  <div class="save-post">
                                                                     <a href="#"><span class="fa fa-star" aria-label="report"></span></a>
                                                                  </div>
                                                                  <div class="vote up">
                                                                     <i class="fa fa-menu-up"></i>
                                                                  </div>
                                                                  <div class="vote inactive">
                                                                     <i class="fa fa-menu-down"></i>
                                                                  </div>
                                                               </div>
                                                               <!-- vote-wrap >
                                                            </div>
                                                            <!-- media-left >
                                                            <div class="media-body">
                                                               <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod.
                                                               </p>
                                                               <div class="comment-meta">
                                                                  <span><a href="#">delete</a></span>
                                                                  <span><a href="#">report</a></span>
                                                                  <span><a href="#">hide</a></span>
                                                                  <span>
                                                                  <a class="" role="button" data-toggle="collapse" href="#replyCommentOne" aria-expanded="false" aria-controls="collapseExample">reply</a>
                                                                  </span>
                                                                  <div class="collapse" id="replyCommentOne">
                                                                     <form>
                                                                        <div class="form-group">
                                                                           <label for="comment">Yorumunuz</label>
                                                                           <textarea name="comment" class="form-control" rows="3"></textarea>
                                                                        </div>
                                                                        <button type="submit" class="btn btn-default">Yolla</button>
                                                                     </form>
                                                                  </div>
                                                               </div>
                                                               <!-- comment-meta >
                                                            </div>
                                                         </div>
                                                         <!-- comments >
                                                      </div>
                                                      <!-- answer to the first comment >
                                                   </div>
                                                </div>
                                                <!-- comments >
                                             </div>
                                             <!-- first comment >
                                          </div>
                                       </div>
                                       <!-- comments >
                                    </div>
                                    <!-- answer to the first comment >
                                 </div>
                                 </div>
                                 <!-- comments >
                                 </div>
                                 <!-- first comment >
                                 </div>
                                 <!-- post-comments >
                                 </div -->
                           </div>
                        </div>
                     </div>
                  </div>
                  <!-- /#page-content-wrapper -->				
               </div>
            </div>
         </div>
      </div>
      <!--================================================== -->
      <script type="text/javascript">
         $("#menu-toggle").click(function(e) {
         	e.preventDefault();
         	$("#wrapper").toggleClass("toggled");
         });
         
      </script>
      <script type="text/javascript">
         $('[data-toggle="collapse"]').on('click', function() {
         	var $this = $(this),
         	$parent = typeof $this.data('parent')!== 'undefined' ? $($this.data('parent')) : undefined;
         	if($parent === undefined) { /* Just toggle my  */
         		$this.find('.fa').toggleClass('fa-plus fa-minus');
         		return true;
         	}
         
         	/* Open element will be close if parent !== undefined */
         	var currentIcon = $this.find('.fa');
         	currentIcon.toggleClass('fa-plus fa-minus');
         	$parent.find('.fa').not(currentIcon).removeClass('fa-minus').addClass('fa-plus');
         
         });
      </script>
      <style>
         .propic img{
         height:100px;width:100px;
         }
         .custom-file-upload {
         border: 1px solid #ccc;
         display: inline-block;
         padding: 6px 12px;
         cursor: pointer; 
         }
         .media {
         border-left: 1px dotted #000;
         border-bottom: 1px dotted #000;
         margin-bottom: 5px;
         padding-left: 10px;
         }
      </style>
      <div class="modal fade" id="myModal" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title"><?php echo $row['spProfileName']; ?></h4>
               </div>
               <form method="POST" action="uploadsimage.php"enctype='multipart/form-data'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-6">
                           <label>Name:</label><br>
                           <input type="text"name="names" class="form-control" value="<?php echo $row['alias_name']; ?>" style="height:40px;"/>
                        </div>
                        <div class="col-md-6">
                           <?php echo "<img alt='user'style='height:100px;width:100px;' class='img-responsive' src=' " . ($row["spProfilePic"]) . "'  >";  ?>
                           <br>
                           <label for="file-upload" class="custom-file-upload">
                           <i class="fa fa-cloud-upload"></i> Upload Your Photo
                           </label>
                           <input type="hidden"  name="hideenimg" value="<?php echo $row["spProfilePic"];?>">
                           <input type="file" name="files" class="profilegalleryPic"  id="file-upload" style="display: none;" /><br> 
                           <div id="image-holder" class="propic"></div>
                           <!--   <input type=button value="Take Snapshot" onClick="take_snapshot()"> -->
                           <input type="hidden" name="profileid" id="spProfileId" value="<?php echo $_SESSION['pid'];?>">
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-danger  btn-border-radius" data-dismiss="modal">Cancel</button>
                     <button type="submit" class="btn btn-success  btn-border-radius" name="btnedit">Update</button>
                    
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- 	banner modal------->
      <div class="modal fade" id="myModal2" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Upload Banner</h4>
               </div>
               <form method="POST" action="upload_banner.php"enctype='multipart/form-data'>
                  <div class="modal-body">
                     <div class="row">
                        <div class="col-md-12">
                           <img id="thumb" src="" width="150px"/>
                           <br>
                           <input type="file" name="banners" class="bannergalleryPic" style="display:block"  id="file-upload2"  onchange="preview()" required /><br> 
                           <div id="image-holder2" class="bannerpic"></div>
                           <!--   <input type=button value="Take Snapshot" onClick="take_snapshot()"> -->
                           <input type="hidden" name="profileidd" id="spProfileId2" value="<?php echo $_SESSION['pid'];?>">
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-danger btn-border-radius" data-dismiss="modal">Cancel</button> 
                     <button type="submit" class="btn btn-success btn-border-radius" name="banneredit">Update</button>
                   
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- 	banner modal------->
   </body>
</html>
<script>
   $(document).ready(function(){
   	$('.commentlike1').click(function(){
   	var a = $(this).attr('data-like');  
   		
   		
   		$.ajax({
   		  url: "like.php",
   		  type: "POST",
   		 cache:false,
   			data: {'comment_id':a
   			
   			
   			},
   		   success: function(data) {
                                        												// location.reload();
   			$('#appendlike1'+a).html(data);	
   					  
   		}
   		
   	});
   });
   
   
   
   
   
   
   
   $('.sharepost2').click(function(){
   	var y = $(this).attr('data-share'); 
   		//alert(z);
   		
   		$.ajax({
   		  url: "share.php",
   		  type: "POST",
   		 cache:false,
   			data: {'comment_id':y 
   			
   			
   			},
   		   success: function(data) {
                                        												// location.reload();
   			$('#appendshare2'+y).html(data);	
   					  
   		}
   		
   	});
   });
   
   
   
   
   
   
   
   
   
   $('.commentbookmark1').click(function(){
   	var mark = $(this).attr('data-mark');
   		
   		
   		$.ajax({
   		  url: "bookmark.php",
   		  type: "POST",
   		 cache:false,
   			data: {'comment_id':mark
   			
   			
   			},
   		   success: function(data) {
                                        												// location.reload();
   			$('#appendbookmark1'+mark).html(data);	
   					  
   		}
   		
   	});
   });
   
   ///////////////////////////////////////////////////
   
   $('.commentbookmark222').click(function(){
   	var markk = $(this).attr('data-mark');
   			
   		
   		$.ajax({
   		  url: "deletebookmark.php",
   		  type: "POST",
   		 cache:false,
   			data: {'comment_id':markk
   			
   			
   			},
   		   success: function(data) {
                                        $('#commentbox11'+markk).html(" ");									// location.reload();
   				
   					  
   		}
   		
   	});
   	
   });
   
   
   
   
   
   
   //////////////////////////////////////////////
   
   
   
   
   
   
   
   /*	
   $('.delbook1').click(function(){
   	var i2 = $(this).attr('data-reply');
   		
   		
   		$.ajax({
   		  url: "rep_delete.php",
   		  type: "POST",
   		 cache:false,
   			data: {'id':i2
   			
   			
   			},
   		   success: function(data) {
                                        												// location.reload();
   			$('#rpllybox11'+i2).html(' ');	
   					  
   		}
   		
   	});
   });
   */
   
   
   
    
    
   
   
   
   
   
   
   });
   
   
   
   
   
   
</script>
<script>
   //////////////////////bookmsark load more							
   									
   									
   									
   									
   									
   	$(document).ready(function(){
   
      // Load more data
      $('.load-more1').click(function(){
          var row1 = Number($('#row1').val());
          var allcount1 = Number($('#all1').val());
          row1 = row1 + 10;
   
          if(row1 <= allcount1){
              $("#row1").val(row1);
   
              $.ajax({
                  url: 'myprofileloadmore.php', 
                  type: 'post',
                  data: {row:row1},
                  beforeSend:function(){
                      $(".load-more1").text("Loading...");
                  },
                  success: function(response){
   
                      // Setting little delay while displaying new content
                      setTimeout(function() {
                          // appending posts after last post with class="post"
                          $(".post1:last").after(response).show().fadeIn("slow");
   
                          var rowno1 = row1 + 10;
   
                          // checking row value is greater than allcount or not
                          if(rowno1 > allcount1){
   
                              // Change the text and background
                            /*  $('.load-more1').text("Hide");
                              $('.load-more1').css("background","darkorchid");*/
   						
   						$('.load-more1').css("display","none");	
                          }else{
                              $(".load-more1").text("Load more");
                          }
                      }, 2000);
   
   
                  }
              });
          }else{
              $('.load-more1').text("Loading...");
   
              // Setting little delay while removing contents
              setTimeout(function() {
   
                  // When row is greater than allcount then remove all class='post' element after 3 element
                  $('.post1:nth-child(3)').nextAll('.post1').remove().fadeIn("slow");
   
                  // Reset the value of row
                  $("#row1").val(0); 
   
                  // Change the text and background
                  $('.load-more1').text("Load more");
                  $('.load-more1').css("background","#15a9ce");
   
              }, 2000);
   
   
          } 
   
      });
   
   });
   									
   									
   									
   									
   				////////////////////////////////////////////////////////////////////////////bookmark load more end
   
   
   
   
   
   
   
   
   
   
   
   
   $(".profilegalleryPic").on('change', function () {
   
      var imgPath = $(this)[0].value;
      var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
   
      if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
          if (typeof (FileReader) != "undefined") {
   
              var image_holder = $("#image-holder");
              image_holder.empty();
   
              var reader = new FileReader();
              reader.onload = function (e) {
                  $("<img />", {
                      "src": e.target.result,
                          "class": "thumb-image"
                  }).appendTo(image_holder);
   
              }
              image_holder.show();
              reader.readAsDataURL($(this)[0].files[0]);
          } else {
              alert("This browser does not support FileReader.");
          }
      } else {
          alert("Pls select only images");
      }
   });
   
   
   
   
   
   /*$(".bannergalleryPic2").on('change', function () {
   
      var imgPath2 = $(this)[0].value;
      var extn2 = imgPath2.substring(imgPath2.lastIndexOf('.') + 1).toLowerCase();
   
      if (extn2 == "gif" || extn2 == "png" || extn2 == "jpg" || extn2 == "jpeg") {
          if (typeof (FileReader) != "undefined") {
   
              var image_holder2 = $("#image-holder2");
              image_holder2.empty();
   
              var reader2 = new FileReader();
              reader2.onload = function (e) {
                  $("<img />", {
                      "src": e.target.result,
                          "class": "thumb-image"
                  }).appendTo(image_holder2);
   
              }
              image_holder2.show();
              reader2.readAsDataURL($(this)[0].files[0]);
          } else {
              alert("This browser does not support FileReader.");
          }
      } else {
          alert("Pls select only images");
      }
   });*/
   
   
   
   
   
   
   
   
   
   
   
   
   
</script>
<script type="text/javascript">
   function myFunctionLike(id){ 
                           // alert(id);
                        			var a = id;
   
   
                        			$.ajax({
                        				url: "like.php",
                        				type: "POST",
                        				cache:false,
                        				data: {'comment_id':a
   
   
                        			},
                        			success: function(data) {
   						   // location.reload();
   						   $('#appendlike1'+a).html(data);	
   						   
   						   }
   						   
   						   });
                        		};
   
   
   
   
   
   
   
   
   
   							/*($('.commentdel2').click(function(){
   								var e = $(this).attr('data-del');
   									
   									
   									$.ajax({
   									  url: "delete.php",
   									  type: "POST",
   									 cache:false, 
   										data: {'comment_id':e
   										
   										
   										},
   									   success: function(data) {
                                               												// location.reload();
   										$('#commentbox1'+e).html(' ');	
   												  
   									}
   									
   								});
   							});
   							*/
   
   
   
   function myFunctionDel2(id){
       //alert(url);
   Swal.fire({
   title: 'Are you sure?',
   text: "It will be deleted !",
   icon: 'warning',
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   confirmButtonText: 'Yes, delete it!'
   }).then((result) => {
   
   
   if (result.isConfirmed) {
    
     // window.location.href = url;
   $.ajax({
   url: "delete.php",
   type: "POST",
   cache:false,
   data: {'comment_id':id
   
   
                        			},
   success: function (response) 
   {
   //window.location.href = '<?php echo $BaseUrl; ?>/publicpost/post_comment_details.php?postid=<?php echo $_GET["postid"];?> ';
   
   $('#commentbox1'+id).html(' ');	  
   
   }
   })
   }
   })  
   
   }
   
   
   
   
   
   
   
   
   
   
   
   
   /*$('.delreply11').click(function(){
   								var i2 = $(this).attr('data-reply');
   									
   									
   									$.ajax({
   									  url: "rep_delete.php",
   									  type: "POST",
   									 cache:false,
   										data: {'id':i2
   										
   										
   										},
   									   success: function(data) {
                                               												// location.reload();
   										$('#rpllybox11'+i2).html(' '); 	
   												  
   									}
   									
   								});
   							}); */
   
   
   
   
   function DelreplyReply2(id,id2){ 
   
   
   Swal.fire({
   title: 'Are you sure?',
   text: "It will be deleted !", 
   icon: 'warning',
   showCancelButton: true,
   confirmButtonColor: '#3085d6',
   cancelButtonColor: '#d33',
   confirmButtonText: 'Yes, delete it!'
   }).then((result) => {
   
       if (result.isConfirmed) {
   
   
   
   
   						   var i2 = id;
   						   var i3 = id2;
                        		
   
   
                        			$.ajax({
                        				url: "rep_delete.php",
                        				type: "POST",
                        				cache:false,
                        				data: {'id':i2,
   							'id2':i3 
   
   
                        			},
                        			success: function(data) {  
                                        												// location.reload();
        	     
    	            $('#rpllybox11'+i2).html('');
   		
   		var cnt2 = parseInt($('#countrep2'+i3).val());
   		//alert(cnt2); 
   		   var cnt3=parseInt(cnt2) - parseInt(1);
                     //alert(cnt3);
   	         //$('#echocnt'+i3).html(cnt3); 
   			 //$('#countrep'+i3).val(cnt3);   \
   			 parseInt($('#countrep2'+i3).val(cnt3));
   			  $('#echocnt2'+i3).empty().append(cnt3);
                           // $('#countrep'+i3).empty().append(cnt3);						  
   			 
                 //document.all.('#echocnt'+i3).innerHTML = parseInt(cnt3);						 
   			 
   	  
   	   
   	 
   
   }
   
   });
   }
   })
   
   };
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   function ReplySubmit2(id) { 
   
   
   // alert("pppppppppppppppppp");
   //return false;
   
   //var thml = $('#repcount'+id).html();
   //alert(thml);
   
    var id3 = $('#com_id2'+id).val();
   var id4 = $('#reply2'+id).val();
   
   
    $.ajax({
        type: "POST",
        url: 'commentreply.php',
   cache:false,
        data: {
   'comment_id': id3,
   'comment':id4
   } ,
        success: function(response)
        {
         // alert(response); // show response from the php script.
    
   //alert(response); 
   
    
   $('#appendreply2'+id).prepend(response); 
   
    $('#reply2'+id).val(''); 
   
   //$('#countrep'+id).val(cnt); 
   //$('#repcount'+id).html(thml);
   
   // var cnt = $('#countrep'+id).val();
   
   var cnt = parseInt($('#countrep2'+id).val());
   
   //alert(cnt);
    var cnt1 = parseInt(cnt) + parseInt(1);
   //alert(cnt1);
   
   $('#countrep2'+id).val(cnt1);  
   
   //$('#echocnt'+id).html(cnt1); 
   
   $('#echocnt2'+id).empty().append(cnt1);
   $('#countrep2'+id).empty().append(cnt1);
   //document.all.('#echocnt'+i3).innerHTML = parseInt(cnt1);
     	
   
        }
    });
   
   
   };
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   
   function preview() {
   thumb.src=URL.createObjectURL(event.target.files[0]);
   }
   
   
   
   
   
   								function myFunction2(id) {
   								
   								  var m = document.getElementById("commentbox222"+id);
   								  var n = document.getElementById("appendbookmark1"+id);
   								   var o = document.getElementById("commentbox444"+id);
   								   var attachment1 = document.getElementById("attachment1"+id);
   								  //alert(attachment1);alert(m);alert(n);
   								  if (m.style.display === "none") {
   									  
   									m.style.display = "block";
   									n.style.display = "block";
   									o.style.display = "block";
   									attachment1.style.display = "block";
   									document.getElementById("hideshow1"+id).innerHTML = "<i class='fa fa-eye-slash' title='Hide'></i>";
   									
   								  } else {
   									m.style.display = "none";
   									n.style.display = "none";
   									o.style.display = "none";
   									attachment1.style.display = "none";
   									
   								 document.getElementById("hideshow1"+id).innerHTML = "<i class='fa fa-eye' title='Show'></i>";
   
   								}}
   								  
   								  
   							/*	 // alert(y);
   								  if (y.style.display === "none") {
   									
   									
   								  } else {
   									
   								  }
   								 
   								 // alert(z);
   								  if (z.style.display === "none") {
   									  
   									;
   								  } else {
   									
   								  }
   								  
   								 
   								}*/
   							
</script>
<?php 
   include('../component/f_footer.php');
   include('../component/f_btm_script.php'); 
   ?>
<?php
   }
   ?>