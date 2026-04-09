<?php
 //error_reporting(E_ALL);
/// ini_set('display_errors', 'On');  
      
      
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
      
        $G_Id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
        
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
          //echo $friend_id; exit;
      
      	$pageactive = 7;
      
      
      
            if(isset($_POST['submit'])){
      		  
      		 $flag_pid =$_POST['flag_pid'];
      		 $user_pid=$_SESSION['pid'];
      		 $user_uid=$_SESSION['uid'];
      		  $why_flag =$_POST['why_flag'];
      		  $flag_desc =$_POST['flag_desc'];
      		  
      		  $data1=array(
      		  'flag_pid'=>$flag_pid,
      		  'user_pid'=>$user_pid,
      		  'user_uid'=>$user_uid,
      		  'why_flag'=>$why_flag,
      		  'flag_desc'=>$flag_desc
      		  );
      		  $object=new _spprofilefeature;
      		  $result1=$object->createflag($data1);
      		  
      		  
      		  
      	  }
                 
      		
      
      
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
	  <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	  
      <script type="text/javascript">
	  
	  
	  
         let h = window.innerHeight;
         document.getElementById("wrapper").style.height = h+'px';
         alert(h);
      </script>
      <script type="text/javascript" src="js/news.js"></script> 
      <style>
         .media {
         border-left: 1px dotted #000;
         border-bottom: 1px dotted #000;
         margin-bottom: 5px;
         padding-left: 10px;
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
                     ?>
                  <!-- Page Content -->
                  <!-- Page Content -->
                  <div id="page-content-wrapper">
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-md-6 h style-1">
                              <?php $obb=new _news;
                                 $blockres=$obb->read_profile_block($G_Id,$_SESSION['pid']); ?>
                              <!-- Column -->
                              <div class="row">
                                 <div class="card">
                                    <?php 
                                       $object=new _news;
                                       
                                       $resu=$object->readprofilebanner($G_Id);
                                       
                                       $roww1=mysqli_fetch_assoc($resu);
                                       
                                       
                                       
                                       $banner=$roww1['banner_image'];
                                       
                                       				if($banner != ""){   ?>
                                    <img class="card-img-top img-responsive" src="<?php echo $banner; ?>" alt="Card image cap" style="width: 97%;height: 240px;">
                                    <?php } else{?>
                                    <img class="card-img-top img-responsive" src="img/pinksky.jpg" alt="Card image cap">
                                    <?php }?>
                                    <div class="card-body little-profile">
                                       <div class="col-lg-6 col-md-6 col-xs-6">
                                          <div class="pro-img">
                                             <?php
                                                $p = new _spprofiles;
                                                $result = $p->read($G_Id);
                                                if ($result != false) {
                                                   $row = mysqli_fetch_assoc($result);
                                                
                                                //print_r($row);
                                                //die("&&&&&&&&&&&&&&&&&&");
                                                
                                                   if (isset($row["spProfilePic"]) && $row['spProfilePic'] != '')
                                                       echo "<img alt='user' class='img-responsive' src=' " . ($row["spProfilePic"]) . "'  >";
                                                   else
                                                       echo "<img alt='user' class='img-responsive' src='".$BaseUrl."/assets/images/icon/blank-img.png' style='width: 40px; height: 40px;' >";
                                                }
                                                ?>
                                             <!-- <img src="https://i.imgur.com/8RKXAIV.jpg" alt="user" class="img-responsive"> -->
                                          </div>
                                          <?php    $idspProfileType=$row['spProfileType_idspProfileType']; 
                                             $new=new _spprofilefeature ;
                                             
                                                    $resss=$new->readprotyp($idspProfileType);
                                              if( $resss!=false){
                                              $rowww=mysqli_fetch_assoc($resss);
                                               //echo $rowww['spProfileTypeName'];
                                              }
                                                      // print_r($resss) ;
                                                       //die("++++++++++++++++++++++++");
                                              
                                             
                                             	 
                                             	 
                                             	 
                                             
                                             ?>
                                          <h4 class="" style="margin-top: 30px; white-space: nowrap; ">
                                             @<?php 
                                                if($row['alias_name']){
                                                
                                                echo str_replace(" ","_",$row['alias_name']);
                                                }
                                                                                         else{
                                                   
                                                   echo str_replace(" ","_",$row['spProfileName']);
                                                  }
                                                ?> 
                                             
                                          </h4>
                                          <span style="font-size:13px "> <?php echo (isset($row['spProfileName'])? ucwords(strtolower($row['spProfileName'])) : "Profile "); ?>(<?php echo $rowww['spProfileTypeName']; ?>&nbsp;Profile)</span>
                                          <?php 
                                             $sesid=$_SESSION['pid'];
                                             $getid=$G_Id;
                                             $res2=$new->readfollow($sesid,$getid) ;
                                             $pide=$_SESSION['pid'];
                                             $ids=$G_Id;
                                             			if($pide!=$ids)
                                             			{
                                             if($_SESSION['guet_yes'] != 'yes'){ 
                                             
                                             			if(!$blockres){
                                             
                                             if($res2!=false){
                                             				
                                             			
                                             					?>
                                          <div id="profile">
                                             <a  id="unfollow" class="waves-effect waves-dark btn btn-primary btn-md btn-rounded" data-abc="true"  data-who="<?php echo $_SESSION['pid'];?>" data-whom="<?php echo $G_Id;?>">UnFollow</a>
                                          </div>
                                          <?php 
                                             }else{
                                             	?>
                                          <div id="profile">
                                             <a id="follow" class="waves-effect waves-dark btn btn-primary btn-md btn-rounded" data-abc="true"  data-who="<?php echo $_SESSION['pid'];?>" data-whom="<?php echo $G_Id;?>" >Follow</a>
                                          </div>
                                          <?php 
                                             } }
                                             
                                             }
                                                                            }
                                                                            
                                                                            ?>
                                       </div>
                                       <div class="col-lg-2 col-md-2 col-xs-2">
                                          <a href="<?php echo $BaseUrl;?>/news/bucket.php">
                                             <h3 class="">
                                                <?php 
                                                   $n = new _news;
                                                   $bucketCountResult = $n->read_bucket_news($G_Id); 
                                                   if($bucketCountResult != false){
                                                   $bucketCount = mysqli_num_rows($bucketCountResult);
                                                   echo $bucketCount;
                                                   } else {
                                                   echo 0;
                                                   }
                                                   ?> 
                                             </h3>
                                             <small>Bucket</small>
                                          </a>
                                       </div>
                                       <div class="col-lg-2 col-md-2 col-xs-2">
                                          <a href="<?php echo $BaseUrl;?>/news/follower.php?id=<?php echo $getid;?>">
                                             <h3 class=""><?php 
                                                $obj=new _spprofilefeature;
                                                
                                                $ress=$obj->readfollowersallcount($G_Id);
                                                if($ress){
                                                $rw=mysqli_fetch_assoc($ress);
                                                }
                                                                    $count=$ress->num_rows;
                                                  
                                                if( $count>0){
                                                echo $count;
                                                }
                                                else{
                                                	echo "0";
                                                }
                                                ?>
                                             </h3>
                                             <small>Followers</small>
                                          </a>
                                       </div>
                                       <div class="col-lg-2 col-md-2 col-xs-2">
                                          <a href="<?php echo $BaseUrl;?>/news/following.php?id=<?php echo $getid;?>">
                                             <h3 class=""><?php 
                                                $ress2=$obj->readforallcount($G_Id);
                                                
                                                                    $count2=$ress2->num_rows; 
                                                  
                                                if($count2>0){
                                                 echo $count2;
                                                }
                                                else{
                                                 echo "0";
                                                }
                                                ?>
                                             </h3>
                                             <small>Following</small>
                                          </a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <?php 
                                 if(!$blockres){
                                 
                                 ?>
                              <?php
                                 $objectt=new _news;
                                 
                                 
                                 $resultt=$objectt->flaggeddata($_SESSION['pid'],$G_Id);
								 
                                 if($resultt == false){
                                
                                 if($pide!=$ids)
                                 {
                                 ?>
                              
                              <div class="pull-right" style="">
                                 <a href="javascript:void(0)" data-toggle="modal" data-target="#flagPost" ><i class="fa fa-flag"></i> Flag This Profile</a>
                              </div>
                              <?php }
                                 }
                                 
                                                                   else{
                                 		   echo "<span class='pull-right'>You have already flaged this profile</span>";
                                 	   }
                                 
                                 
                                 
                                
								$blockres2=$objectt->read_profile_block($_SESSION['pid'],$G_Id);
								if($G_Id!==$_SESSION['pid']){
                                 if($blockres2 == false){   
									 
									 
									 
                                 ?>
                              <form action="block_profile.php" id="formsubmit"  method="POST">
                                 <input type="hidden" name="id" value="<?php echo $G_Id;?>">
								 <button type="submit" id="deleteamc11" style="margin-top: 15px;margin-left: 15px;background-color: #898282;color: white;" class="btn btn-dark" name="block" >Block <i class="fa fa-lock" aria-hidden="true"></i></button> 
                              </form>
                              <?php   
                                 }else{ 
                                 ?>  
								 
                              <form action="block_profile.php" id="formsubmit22"  method="POST">
							  <input type="hidden" name="id" value="<?php echo $G_Id;?>"> 
                                 <button type="submit" id="deleteamc22" style="margin-top: 15px;margin-left: 15px;background-color: #898282;color: white;" class="btn btn-dark" name="block" >UnBlock <i class="fa fa-lock" aria-hidden="true"></i></button> 
                              </form>
								<?php  }} ?> 
							  
                              <?php
							
							  $settres=$objectt->read_settings($G_Id);
							 if($settres != false){
							   $setrow=mysqli_fetch_assoc($settres);
							 $can_seeprofile=$setrow['can_seeprofile'];  
							
							 if($can_seeprofile==1){
							
						    $obj2=new _spprofiles;
							  $res4= $obj2->readcommentdata3($G_Id);
							 $allcount2 =$res4->num_rows;
							  
							
					  
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
							 
								   
							include('profileData.php'); 
                                 		  
                                 				  
                                 
                                 }}?>
                              <h1 class="load-more1" style="text-align: center;color: #5088ef; font-size: 24px;" >Load More</h1>
                              <input type="hidden" id="row1" value="0">
                              <input type="hidden" id="all1" value="<?php echo $allcount2; ?>"> 	
                              <?php //}
                                 }}else{
                                 	
							   $rress=$objectt->followers($_SESSION['pid'],$G_Id);
				 
								 if($rress!=false){   
                                 
                                 
                                 // die("OOOOOOOOOOOOOOOOOOOOOOOO");
                                   
                                   
							 $obj2=new _spprofiles;
							  $res4= $obj2->readcommentdata3($G_Id);
							 $allcount2 =$res4->num_rows;
							  
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
							 
								   
							include('profileData.php'); 
                                 						  
                                 								  
                                 
                                  }}?>
                              <h1 class="load-more1" style="text-align: center;color: #5088ef; font-size: 24px;" >Load More</h1>
                              <input type="hidden" id="row1" value="0">
                              <input type="hidden" id="all1" value="<?php echo $allcount2; ?>">
                              <?php }else{
                                 if($_SESSION['pid']==$G_Id){
                                  
                                 
                                 
				      $obj2=new _spprofiles;
					  $res4= $obj2->readcommentdata3($G_Id);
					 $allcount2 =$res4->num_rows;
					  
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
							 
								   
							include('profileData.php'); 
																									  
									 }}?>
									 
                              <h1 class="load-more1" style="text-align: center;color: #5088ef; font-size: 24px;" >Load More</h1>
                              <input type="hidden" id="row1" value="0">
                              <input type="hidden" id="all1" value="<?php echo $allcount2; ?>">
                              <?php }}}}else{?>
                              <div style="
                                 margin-top: 35px;
                                 " class="alert alert-danger mt-5" role="alert">
                                 <strong> You Are Blocked By This User !</strong>
                              </div>
                              <?php }?>
                           </div>
                           <div class="col-md-6 h style-1">
                              <?php include ('rightSidebar.php'); ?>
                           </div>
                           <!-- comments -->
                        </div>
                        <!-- answer to the first comment -->
                     </div>
                  </div>
                  <!-- comments -->
               </div>
               <!-- first comment -->
            </div>
         </div>
         <!-- comments -->
      </div>
      <!-- answer to the first comment -->
      </div>
      </div>
      <!-- comments -->
      </div>
      <!-- first comment -->
      </div>
      <!-- post-comments -->
      </div>
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
      <div id="flagPost" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <form method="post" action="" class="sharestorepos">
               <div class="modal-content no-radius">
                  <!--input type="hidden" name="uid_idspPosting" value="<?php echo $_GET['postid'];?>">
                     <input type="hidden" name="_idspProfile" value="<?php echo $_SESSION['pid']; ?>"-->
                  <input type="hidden" name="flag_pid" value="<?php echo $G_Id?>">
                  <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                     <h4 class="modal-title">Flag Profile</h4>
                  </div>
                  <div class="modal-body">
                     <div class="radio">
                        <label><input type="radio" name="why_flag" value="Duplicate post" checked="">Duplicate Profile</label>
                     </div>
                     <div class="radio">
                        <label><input type="radio" name="why_flag" value="Posting Violation">Profiling Violation</label>
                     </div>
                     <div class="radio">
                        <label><input type="radio" name="why_flag" value="Suspicious Post">Suspicious Profile</label>
                     </div>
                     <div class="radio">
                        <label><input type="radio" name="why_flag" value="Copied My Post">Copied My Profile</label>
                     </div>
                     <!-- <label>Why flag this post?</label> -->
                     <textarea class="form-control" name="flag_desc" placeholder="Add Comments"></textarea>
                  </div>
                  <div class="modal-footer">
                     <input type="submit" name="submit" class="btn butn_mdl_submit ">
                     <button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <!--================================================== -->
	  

      <script>
	/* $('#deleteamc').on('click',function(e) {
    
    event.preventDefault();
var form = this;
    
        swal({
  title: "Are you sure?",
  text: "All data related to this AMC ID will be parmanently deleted",
  type: "warning",
  showCancelButton: true,
  confirmButtonColor: "#DD6B55",
  confirmButtonText: "Yes, DELETE it!",
  cancelButtonText: "No, cancel please!",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
  if (isConfirm) {
	  form.submit();
	  } else {
    swal("Cancelled", "AMC Record is safe :)", "error");
	
  }
});
});*/

	  $('#deleteamc11').click(function (e){
    e.preventDefault();
    let form = $(this).parents('form');
    swal({
       title: 'Are you sure You want to block this User?',
        
        icon: 'warning',
       buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if(value){
            form.submit();
        }
    });
});
	

	 $('#deleteamc22').click(function (e){
    e.preventDefault();
    let form = $(this).parents('form');
    swal({
        title: 'Are you sure You want to Unblock this User ?',
       
        icon: 'warning',
        buttons: ["Cancel", "Yes!"],
    }).then(function(value) {
        if(value){
            form.submit();
        }
    });
});
	

	
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
              	     
          	            $('#rpllybox2'+i2).html('');
         		
         		/*var cnt2 = parseInt($('#countrep2'+i3).val());
         	 alert(cnt2);
         		   var cnt3=parseInt(cnt2) - parseInt(1);
         		   
                           alert(cnt3); 
         		 
         	           
         			 parseInt($('#countrep2'+i3).val(cnt3));  
         			  $('#echocnt2'+i3).empty().append(cnt3);*/
         			  
         			  
         			  
         var cnt = parseInt($('#countrep2'+id).val());
         
         //alert(cnt);
          var cnt1 = parseInt(cnt) - parseInt(1);
         //alert(cnt1);
         
         $('#countrep2'+id).val(cnt1);  
         
         //$('#echocnt'+id).html(cnt1); 
         
         $('#echocnt2'+id).empty().append(cnt1);
         $('#countrep2'+id).empty().append(cnt1);	  
         			  
         			  
         			  
                                 						 
         			 
         }
         
         });
         }
         }) 
         
         };
         
         
         
         
         
          function BookmarkReply2(id){  
         var r = id;
         
         
		$.ajax({
			url: "bookmarkreply.php",
			type: "POST",
			cache:false,
			data: {'comment_id':r},
		success: function(data) {
         	
         	$('#appendbookmarkreply2'+r).html(data);	    
         
         }
         
         });
         }
         
         
         
         
         
         
         
         function ReplySubmit2(id) { 
         
         
         // alert("pppppppppppppppppp");
         //return false;
         
         //var thml = $('#repcount'+id).html();
         //alert(thml);
         
          var replyvalidation = $('#replyvalidation'+id).val();
         
         //if(replyvalidation==3){
         //swal("");
         //}
         
         
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
         
         
         //////////////share profie
         
         function myFunctionshare2(id){ 
         var share2  =$('#share2'+id).val(); 
         
         
         
         if(share2==2){
          	swal("You Don't Have Permission To Share This Post");
          
         }
         
         
         
         if(share2==0){
         
         
         Swal.fire('UnShared successfully').then((result) => {
         	 
         	
         	  if (result.isConfirmed) {
         
         
         		//alert(z);*/
         		
         		$.ajax({
         			url: "share.php",
         			type: "POST",
         			cache:false,
         			data: {
         	'comment_id':id 
         			
         			
         		},
         		success: function(data) {
         			if(share==0){
         $('#share2'+id).val(1);
         
         }
         else {
         		$('#share2'+id).val(0);
         }
         			       if(data==0){
         		swal("You Don't Have Permission To Share This Post");
         		}
         		else{
         				$('#appendshare2'+id).html(data);  	    
         		}
         			}
                                          
         		})
         	
          //alert("Shared successfully");
         	}
                              })
         }
         if(share2==1){
         Swal.fire('Shared successfully').then((result) => {
         	 
         	
         	  if (result.isConfirmed) {
         
         
         		//alert(z);
         		
         		$.ajax({
         			url: "share.php",
         			type: "POST",
         			cache:false,
         			data: {'comment_id':id 
         			
         			
         		},
         		success: function(data) {
         				if(share2==0){
         $('#share2'+id).val(1);
         
         }
         else {
         		$('#share2'+id).val(0);
         }
         			 if(data==0){
            swal("You Don't Have Permission To Share This Post");
         			}
         			else{
         				$('#appendshare2'+id).html(data);  	    
         			}
         			}
                                          
         		})
         	
          //alert("Shared successfully");
         	}
                              })
         }
         
         
         
         }
         
         
         
         
            
          function myFunctionunshare2(id){ 
         
         var share2  =$('#share2'+id).val();  
         
         if(share2==2){
         
         		swal("You Don't Have Permission To Share This Post");
         
         }
         
         
         
         
         
         
         
         
         
         
         
         
         if(share2==0){
         
         
         Swal.fire('UnShared successfully').then((result) => {
         	 
         	
         	  if (result.isConfirmed) {
         
         
         		//alert(z);*/
         		
         		$.ajax({
         			url: "share.php",
         			type: "POST",
         			cache:false,
         			data: {'comment_id':id 
         			
         			
         		},
         		success: function(data) {
         				if(share2==0){
         $('#share2'+id).val(1);
         
         }
         else {
         		$('#share2'+id).val(0);
         }
         			if(data==0){
         	swal("You Don't Have Permission To Share This Post");
         		}
         	else{
         				$('#appendshare2'+id).html(data);  	    
         	}
         			}
                                          
         		})
         	
          //alert("Shared successfully");
         	}
                              })
         }
         
         if(share2==1){
         
         Swal.fire('Shared successfully').then((result) => {
         	 
         	
         	  if (result.isConfirmed) {
         
         
         		//alert(z);
         		
         		$.ajax({
         			url: "share.php",
         			type: "POST",
         			cache:false,
         			data: {'comment_id':id 
         			
         			
         		},
         		success: function(data) {
         				if(share2==0){
                 $('#share2'+id).val(1);
         
         }
         else {
         		$('#share2'+id).val(0);
         }
         			       
         	   if(data==0){
         	   swal("You Don't Have Permission To Share This Post");
         			}else{
         				$('#appendshare2'+id).html(data);  	    
         			}
         			}
                                          
         		})
         	
          //alert("Shared successfully");
         	    }
             })
          }
       } 
         
         //////////////share profie
         
         
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
                             url: 'profileloadmore.php', 
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
               
               
               
               
            
      </script>
      <script src="<?php echo $baseurl?>/assets/js/sweetalert.js"></script>
      <script type="text/javascript">
         function ProfileComDel(id){
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
         
         $('#commentboxx222'+id).html('');	  
         
         }
         })
         }
         })  
         
         }
         
         
         
         
         
         
         function ProfieLike(id){ 
                                 
		var a = id;


		$.ajax({
			url: "like.php",
			type: "POST",
			cache:false,
			data: {'comment_id':a},
			success: function(data) {
         		
         		if(data==0){
         			swal("You Don't Have Permission To Like This Post");
         		}
         		else{
         // location.reload();
         $('#appendlike2'+a).html(data);	
         		}
         }
         
         });
        };
         
         
         
         
         
         
         
         
         
         	function myFunction1(id) {
         	
         	  var x = document.getElementById("commentbox222"+id);
         	  var y = document.getElementById("appendbookmark1"+id);
         	  var z = document.getElementById("commentbox444"+id);
         	  var attachment2 = document.getElementById("attachment2"+id);
         	  //alert(x);
         	 // alert(y);
         	  //alert(z);
         	  
         	  if (x.style.display === "none") {
         		  
         		x.style.display = "block";
         		y.style.display = "block";
         		z.style.display = "block";
         		attachment2.style.display = "block";
         		 	 document.getElementById("hideshow11"+id).innerHTML = "<i class='fa fa-eye-slash' title='Hide'></i>";
         		
         	  } else {
         			x.style.display = "none";
         		y.style.display = "none";
         		z.style.display = "none";
         		attachment2.style.display = "none";
         		
         		//app = document.querySelector('#hideshow'+id);
                                            // app.html('Show');
         	 document.getElementById("hideshow11"+id).innerHTML = "<i class='fa fa-eye' title='Show'></i>";
         
         	}}
         	  
         	  
         	 // alert(y);
         	 /* if (y.style.display === "none") {
         		
         		
         	  } else {
         		
         	  }
         	  
         	 // alert(z);
         	  if (z.style.display === "none") {
         		  
         		
         	  } else {
         		
         	  }
         	  
         	 
         	}*/ 
      </script>
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
         
         $(document).ready(function(){
         
         
         $('#follow').click(function(){
         var a=	$('#follow').attr('data-who');
         var b=	$('#follow').attr('data-whom');
		 
		  Swal.fire({
         title: 'Are you sure You want to follow this User?',
       
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, follow it!'
         }).then((result) => {
         
             if (result.isConfirmed) {
         
         		$.ajax({
           url: "follow.php",
           type: "POST",
          cache:false,
         	data: {'who':a,
         	'whom':b
         	},
            success: function(data) {
				
				
				
         	     location.reload();
            			/*  var unfollow = '<a  id="unfollow" class="waves-effect waves-dark btn btn-primary btn-md btn-rounded" data-abc="true"  data-who='+a+' data-whom='+b+'>UnFollow</a>';
         		$('#profile').html(unfollow);	  */ 
         			  
         }
         
         });
			 }
			 })
         });	
         
         
         $('#unfollow').click(function(){
         var a=	$('#unfollow').attr('data-who');
         var b=	$('#unfollow').attr('data-whom');
         
		 Swal.fire({
         title: 'Are you sure You want to Unfollow this User?',
       
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Yes, Unfollow it!'
         }).then((result) => {
         
             if (result.isConfirmed) {
		 
         		$.ajax({
           url: "unfollow.php",
           type: "POST",
          cache:false,
         	data: {'who':a,
         	'whom':b
         	},
            success: function(data) {
         	     location.reload();
         /*	  var follow = '<a  id="unfollow" class="waves-effect waves-dark btn btn-primary btn-md btn-rounded" data-abc="true"  data-who='+a+' data-whom='+b+'>Follow</a>';
           	$('#profile').html(follow);	*/
         }
         
         });
			 }
		 })
         });		
         
         
         
         
         
         
         });		
      </script>
   </body>
</html>
<?php 
   include('../component/f_footer.php');
   include('../component/f_btm_script.php'); 
   ?>
<?php
   }
   ?>
