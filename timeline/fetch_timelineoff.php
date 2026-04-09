 <?php

 include('../univ/baseurl.php');
     include( "../univ/main.php");

$row = $_POST['row'];

   $pid = $_POST['profile_id'];
   $uid = $_POST['user_id'];
$rowperpage = 3;
 $start = date('Y-m-d', strtotime('-7 days'));
// selecting posts

    $con = mysqli_connect(DBHOST, UNAME, PASS);

     if(!$con) {
        die('Not Connected To Server');
    }
 
    //Connection to database
    if(!mysqli_select_db($con, DBNAME)) {
        echo 'Database Not Selected';
    }

  $query = "SELECT * FROM sppostings AS t where (spcategories_idspcategory = 16 or spcategories_idspcategory = 17 or spcategories_idspcategory = 9 or spcategories_idspcategory = 1) and (sppostingvisibility = -1 or sppostingvisibility in(select spgroup_idspgroup from spprofiles_has_spgroup where spprofiles_idspprofiles in(select idspprofiles from spprofiles where idspprofiles =" . $pid . "))) and (t.spprofiles_idspprofiles in (select spprofiles_idspprofilesreceiver from spprofiles_has_spprofiles where spprofiles_has_spprofileflag = 1 or spprofiles_idspprofiles = " . $pid . " and spprofiles_idspprofilesender in(select idspprofiles from spprofiles where idspprofiles =" . $pid . " )) or idsppostings in(select timelineid from share where spsharetowhom = " . $pid . " ) or t.spprofiles_idspprofiles in (select spprofiles_idspprofilesender from spprofiles_has_spprofiles where spprofiles_has_spprofileflag = 1 and spprofiles_idspprofilesreceiver in(select idspprofiles from spprofiles where idspprofiles = " . $pid . " )) ) and t.sppostingdate >= '" . $start . "' ORDER BY spPostingDate DESC limit ".$row.",3";   


/*echo $query;*/

$result = mysqli_query($con,$query);

/*print_r($result);*/
$html = '';


while($row = mysqli_fetch_array($result)){

//$html .= '<div style="font-weight:bold;" >';

          $que2 = "SELECT * FROM sppostings AS t where t.idsppostings = ".$row['idspPostings']." and t.spcategories_idspcategory = 16";

/*
echo $que2;*/
          $result1 = mysqli_query($con,$que2);

          $rows = mysqli_fetch_array($result1);

        /*  print_r($rows);*/

          $que3 = "SELECT * FROM spprofiles AS t inner join spprofiletype as d on t.spprofiletype_idspprofiletype = d.idspprofiletype where idspprofiles = ".$rows['spProfiles_idspProfiles']."";

          $result2 = mysqli_query($con,$que3);

          $rows2 = mysqli_fetch_array($result2);

         // print_r($rows2);
            
            $picture = $rows2["spProfilePic"];
                                    $profilename = $rows2["spProfileName"];



          $html .= '<div class="post" style="font-weight:bold;" ><div class="post_timeline post_timeline_all_post searchable deldiv_'.$rows['idspPostings'].'" ><div class="row ">';

          $html .='<div class="col-md-6">';


          $html .= '<input type="hidden" id="postid" value="'.$rows["idspPostings"].'"><input type="hidden" id="postdate" value="'.$rows["spPostingDate"].'">';
           $html .= '<div class="left_profile_timeline">';

           if (isset($picture)) {
			   
                                     $html .=  "<img alt='profilepic'  class='img-circle' src=' " . ($picture) . "'>";
                                }else{
                                     $html .=  "<img alt='profilepic'  class='' src=".$BaseUrl."/assets/images/icon/blank-img.png >";
                                }
 $html .='</div>'; 
            $html .= '<div class="title_profile"><h4><a href='.$BaseUrl.'/friends/?profileid='.$rows['spProfiles_idspProfiles'].'>'.ucwords(strtolower($profilename)).'</a></h4><h5 id="posttimeago'.$rows['idspPostings'].'> <i class="fa fa-globe"></i></h5></div>';      

                        
?>



<?php if(isset($rows["idspPostings"]) && !empty($rows["idspPostings"])){   ?>

  <input type="hidden" id="postid" value="<?php echo $rows["idspPostings"]; ?>">
                                        <input type="hidden" id="postdate" value="<?php echo $rows["spPostingDate"]; ?>">
                    
                    <script type="text/javascript">


document.getElementById("posttimeago"+<?php echo $rows["idspPostings"]; ?>).innerHTML = get_post_time(<?php echo $rows["idspPostings"]; ?>,<?php echo "'". $rows["spPostingDate"] ."'";?>);
 function get_post_time(postid,postdate){


              /*  var postid = $("#postid").val();
        var postdate = $("#postdate"+postid).val();*/
 
      

       /* alert(postdate);*/
       /* alert(postid);*/


  var countDownDate = new Date(postdate)

// Update the count down every 1 second
/*  var x = setInterval(function() {*/

  // Get today's date and time

    var today = new Date();

/*var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();

var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

var dateTime = date+' '+time;*/
        /*document.getElementById("spPostingDate").value = dateTime; */
  var now = new Date();

/*    alert(countDownDate);
    alert(now);*/

   /* var isLarger = new Date("2-11-2012 13:40:00") > new Date("01-11-2012 10:40:00");*/
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
/*  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);*/
    

      var seconds = Math.floor((now - (countDownDate))/1000);
      var  minutes = Math.floor(seconds/60);
       var hours = Math.floor(minutes/60);
       var days = Math.floor(hours/24);
        
      var  hours = hours-(days*24);
      var  minutes = minutes-(days*24*60)-(hours*60);
      var  seconds = seconds-(days*24*60*60)-(hours*60*60)-(minutes*60);


if(days > 0){

var ago = days+ " days ago";

}else if(days <= 0 &&  hours >0 ){
       
       var ago = hours+ " hours ago";
}else if(days <= 0 &&  hours <=0 && minutes > 0){
       
       var ago = minutes + " minutes ago";
}else if(days <= 0 &&  hours <=0 && minutes <= 0 && seconds > 0){
       
       var ago = seconds + " seconds ago";
}

/*console.log(ago);*/


/*}, 10000);*/

/*alert(ago);*/

return ago;

 }         

                    </script>


                  <?php } ?>


<?php
//echo "here";
/*   $html .='<div class="col-md-6"><div class="dropdown pull-right right_profile_timeline">';
                        
                           
    


$flagque = "SELECT * FROM flagtimelinepost WHERE spPosting_idspPosting='".$rows['idspPostings']."' AND spProfile_idspProfile='".$pid."'";

//echo $flagque;
 $flagresult2 = mysqli_query($con,$flagque);

if($flagresult2->num_rows > 0) {
    

echo"here";
     //  $html .= '<i class="fa fa-flag danger" data-toggle="tooltip" data-placement="top" title="Post Flaged"  id="unflag"></i>';

    
 }else{ 

// echo"here2";

  $html .= '<i class="fa fa-flag danger" data-toggle="tooltip" data-placement="top" title="Post Flaged"  id="unflag"></i>';
    $html .= '<i class="fa fa-flag danger" data-toggle="tooltip" data-placement="top" title="Post Flaged" style="color:red;display:none;" id="unflag'.$rows['idspPostings'].'  ></i>';
                 
                  if($pid == $rows['idspProfiles']){
                 $html .= '<i class="fa fa-flag" id="flag'.$rows['idspPostings'].' data-toggle="tooltip" data-placement="top" title="You Cannot Flag This Post!"  disable></i>';
               }else{ 
                 $html .= '<span data-toggle="tooltip" data-placement="top" title="Flag Post">';
                 $html .= '<i class="fa fa-flag" id="flag'.$rows['idspPostings'].'" data-placement="top" title="Flag Post" data-toggle="modal" data-target="#myModal'.$rows['idspPostings'].'" ></i>
                 </span>';

}
    }*/

/*$html .='</div></div>';*/
/*$query1 = mysqli_query($con,"SELECT * FROM flagtimelinepost WHERE spPosting_idspPosting='".$rows['idspPostings']."'");
$flaged_count = mysqli_num_rows($query1);


if($flaged_count > 0){
  $html .= '($flaged_count)';
}*/

                             

/*                         
 
                              $html .= '<div id="myModal.'$rows['idspPostings'].'" class="modal fade" role="dialog">
                                  <div class="modal-dialog">
                                    <div class="modal-content ">
                                        <form class="" method="post" id="flagpostfrm.'$rows['idspPostings'].'">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">×</button>
                                                            <h4 class="modal-title">Flag this Post</h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">

                                                    

                                                   <input type="hidden" name="spProfile_idspProfile" value="'.$pid.'">
                                                   <input type="hidden" name="userid" value="'.$pid.'">
                                                   <input type="hidden" name="flagpostprofileid" value="'.$rows['idspProfiles'].'">
                                                   <input type="hidden" name="flagpostuserid" value="'.$rows['spUser_idspUser'].'">
                                                   <input type="hidden" name="spPosting_idspPosting" value="'.$rows['idspPostings'].'">
                                                                
                                                        
                                                                <div class="col-md-12" style="display: grid;">
                                                                    <label><input type="radio" name="radReport" id="radReport" class="mr_right_7" value="This person is annoying me">This post is annoying me</label>
                                                                    <label><input type="radio" name="radReport" id="radReport" class="mr_right_7" value="They re pretending to be me or someone I know">They re pretending to be me or someone I know</label>
                                                                    <label><input type="radio" name="radReport" id="radReport" class="mr_right_7" value="This is a fake account">This is a fake account Post</label>
                                                                    <label><input type="radio" name="radReport" id="radReport" class="mr_right_7" value="This profile represents a business or organization">This Post represents a business or organization</label>
                                                                    <label><input type="radio" name="radReport" id="radReport" class="mr_right_7" value="They re using a different name than they use in everyday life">They re using a different name than they use in everyday life</label>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn_gray db_btn db_orangebtn" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn_blue db_btn db_primarybtn" onclick="flagpost('. $rows['idspPostings'].');" name="btnReport" id="flagtimelinepost">Submit</button>
                                                        </div>
                                                     </form>
                                  
                                    </div>

                                  </div>
                              </div>';


                             

                         /*  $html .= ' <button class="btn dropdown-toggle" type="button" data-toggle="dropdown"><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>';*/
           /*                 $html .= '<ul class="dropdown-menu">';*/
                               
/*                if(isset($pid)){
                  $sp = new _savepost;
                  $result2 = $sp->savepost($rows['idspPostings'], $_SESSION['pid'], $_SESSION['uid']);
                  if($result2){
                    if($result2->num_rows > 0){ 
                      $html .= '<li><a href="'.$BaseUrl.'/post-ad/savePost.php?unsave='.$rows['idspPostings'].'"><i class="fa fa-save"></i> Unsave Post</a></li>'; 
                    }else{
                     $html .= '<li><a href="'.$BaseUrl.'/post-ad/savePost.php?postid='.$rows['idspPostings'].'"><i class="fa fa-save"></i> Save Post</a></li>'; 
                    }
                  }else{
                    $html .= '<li><a href="'.$BaseUrl.'/post-ad/savePost.php?postid='.$rows['idspPostings'].'"><i class="fa fa-save"></i> Save Post</a></li>'; 
                  }
                }else{
                  $html .= '<li><a href="../post-ad/savePost.php?postid='.$rows['idspPostings'].'"><i class="fa fa-floppy-o"></i> Save Post</a></li>'; 



                }
                                if($pid == $rows['idspProfiles']){
                                     $html .= '<li><a href="javascript:void(0)" data-toggle="modal" data-target="#myPostEdit" data-postid="'.$rows['idspPostings'].'" class="sendPostidEdit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Post</a></li>'; 
                                }*/
                                
                                
                                
                          
                          
                                //Delete timeline by poster//
/*                if(isset($uid)){
                  $pr = new _spprofiles;
                  $pres = $pr->checkprofile($_SESSION['uid'], $rows['idspProfiles']);
                  if ($pres != false) {
                                       
                                        <li><a href="javascript:void(0);" class="postdel" data-id="<?php echo $rows['idspPostings']?>" data-pid="<?php ?>" >
                        <i class="fa fa-trash-o" style="color:red"></i>  Delete Post</a></li>
                                        <?php
                 
                  }
                }else{
                  echo "<li><a href='../post-ad/deletePost.php?postid=".$rows['idspPostings']."&flag=1' ><i class='fa fa-trash'></i> Delete Post</a></li>";
                }
                                //hide post from timeline
                                if($_SESSION['pid'] != $rows['idspProfiles']){
                                    echo "<li><a href='".$BaseUrl."/post-ad/hidePost.php?postid=".$rows['idspPostings']."&flag=1' ><i class='fa fa-minus-square-o'></i> Hide Post</a></li>";   
                                }
                              
                              

                            </ul>

                        </div>
                    </div>*/
         /* $html .= '<div>here</div>';*/
          
        /*   $html .=' <div class="title_profile"><h4><a href="'.$BaseUrl.'/friends/?profileid='.$rows['idspProfiles'].'">'.ucwords(strtolower($profilename));.'</a></h4><h5 id="posttimeago'.$rows["idspPostings"].'">'.$postingDate.' <i class="fa fa-globe"></i></h5></div>';*/

$html .='<div class="col-md-6"></div>';
$html .='</div>';

$html .='<div class="col-md-12 ">';

                       $html .=' <h2 style="word-wrap: break-word;">';
                            
                                   if(!empty($rows['sharetype'])){  
                                    

                            /*$html .= "<p>".$sharedesc."</p>";*/
                           
                             }else{ 
                                  /*echo $text = $p2->turnUrlIntoHyperlink($rows['spPostingNotes']); */
                                  $html .=$rows['spPostingNotes'];

                                }

                         
                      
                       $html .=' </h2>';
$postquer = "SELECT * FROM sppostingpics AS t where t.sppostings_idsppostings = '".$rows['idspPostings']."' ORDER BY spPostings_idspPostings ASC";


   $postresult = mysqli_query($con,$postquer);

          $post = mysqli_fetch_array($postresult);

           if ($postresult->num_rows >0) {
                            /*while ($rp = mysqli_fetch_assoc($result)) {*/
                                $pict = $post['spPostingPic'];
                           /* }*/
                        } else{
                            $pict = NULL;
                        }


$postmedia= "SELECT * FROM sppostingmedia AS t inner join sppostingalbum as d on t.sppostingalbum_idsppostingalbum = d.idsppostingalbum where t.sppostings_idsppostings = '".$rows['idspPostings']."'";


  $postmediaresult = mysqli_query($con,$postmedia);

          $r = mysqli_fetch_array($postmediaresult);

           if ($postmediaresult->num_rows > 0) {
        $picture = $r['spPostingMedia'];
              $sppostingmediaTitle = $r['sppostingmediaTitle'];
              $sppostingmediaExt = $r['sppostingmediaExt'];
              if($sppostingmediaExt == 'mp3'){ 
                $html .='<div style="margin-left:15px;margin-right:15px;">
                  <audio controls>
                    <source src="'.$BaseUrl.'/upload/'.$sppostingmediaTitle.'" type="audio/<?php echo $sppostingmediaExt;?>">
                    Your browser does not support the audio element.
                  </audio>
                </div>';
                
              }else if($sppostingmediaExt == 'mp4'){
                 $html .='<div style="margin-left:15px;margin-right:15px;">
                  <video  style="max-height:300px;width: 100%;border-radius: 17px;" controls>
                    <source src='.$BaseUrl.'/upload/'.$sppostingmediaTitle.' type="video/'.$sppostingmediaExt.'">
                  </video>
                </div>';
                
              }else if($sppostingmediaExt == 'pdf' || $sppostingmediaExt == 'xls' || $sppostingmediaExt == 'doc' || $sppostingmediaExt == 'docx'){
                
                $html .='<div class="row timelinefile">
                  <div class="col-md-offset-1 col-md-1 no-padding">
                    <img src="'.$BaseUrl.'/assets/images/pdf.png" alt="pdf" class="img-responsive" />
                  </div>
                  <div class="col-md-10">
                    <h3>'.$sppostingmediaTitle.'</h3>
                    <small><?php echo $sppostingmediaExt;?></small>
                    <a href="'.$BaseUrl.'/upload/'.$sppostingmediaTitle.'" target="_blank">Download</a>
                  </div>
                </div>';
                
              }

            }else {
                            if (isset($pict)) {
                               $html .="<div class='timlinepicture text-center'>";
                               $html .= "<a class='thumbnail mag' data-effect='mfp-newspaper' style='border: 0px solid #ddd;' href='" . ($pict) . "'><img alt='Posting Pic' src='" . ($pict) . "' style='height: 300px;    width: 50%;' class='postpic img-thumbnail img-responsive bradius-15'></a>";
                                /*include("postingpic.php");*/
                                $html .= "</div>";
                            }
                            /* else
                              echo "<img alt='Posting Pic' src='../img/no.png' style='vertical-align:top; max-height: 300px; max-width: 800px;' class='postpic img-thumbnail' height='300' width='600' class='img-thumbnail'>" ; */
                        }
/*$html .='</div>';*/


                  $html .= '<div class="col-md-12">
                        <div class="post_footer">
                            <ul>';
                                $html .= '<li>'; 
                                  
 
                              $likequery = "SELECT * FROM splike AS t where sppostings_idsppostings='".$rows['idspPostings']."'";

                                $likeresult = mysqli_query($con,$likequery);

          $liker = mysqli_fetch_array($likeresult);

                                    /*$pl = new _postlike;
                                    $r = $pl->readnojoin($rows['idspPostings']);*/
                                    if ($liker->num_rows > 0 ) {
                                        $i = 0;
                                        $liked = $likeresult->num_rows;
                                      /*  while ($row = mysqli_fetch_assoc($r)) {*/
                                            if ($liker['spProfiles_idspProfiles'] == $pid) {
                                                $html .=  "<a class='faa-parent animated-hover'><span id='spLikePost' data-toggle='tooltip' data-placement='bottom' title='Unlike' class='icon-socialise fa fa-thumbs-up spunlike faa-vertical' data-postid='" . $rows['idspPostings'] . "' data-liked='" . $likeresult->num_rows . "'> (" . $likeresult->num_rows . ") <span class='font_regular'></span></span></a>";
                                                $i++;
                                            }
                                       /* }*/
                                        if ($i == 0) {
                                            $html .=  "<a class='faa-parent animated-hover'><span id='spLikePost' data-likeid='postid" . $rows['idspPostings'] . "' data-toggle='tooltip' data-placement='bottom' title='Like' class='icon-socialise sp-like fa fa-thumbs-o-up faa-vertical' data-postid='" . $rows['idspPostings'] . "' data-liked='" . $likeresult->num_rows . "'> (" . $likeresult->num_rows . ") <span class='font_regular'>Like</span></span></a>";
                                        }
                                    } else {
                                        $liked = 0;
                                       $html .= "<a class='faa-parent animated-hover'><span id='spLikePost' data-likeid='postid" . $rows['idspPostings'] . "' data-toggle='tooltip' data-placement='bottom' title='Like' class='icon-socialise sp-like fa fa-thumbs-o-up faa-vertical' data-postid='" . $rows['idspPostings'] . "' data-liked='" . $liked . "'> <span class='font_regular'>Like</span></span></a>";
                                    }
                                $html .= '</li>';

                                $html .= '<li><i class="fa fa-comment" aria-hidden="true"></i> <span class="font_regular">Comment</span></li>';
                               
                                $html .= '<li>';


  $favquery = "SELECT * FROM splike AS t where sppostings_idsppostings='".$rows['idspPostings']."'";

                                $favresult = mysqli_query($con,$favquery);

          $favourate = mysqli_fetch_array($favresult);
                                  
                                  
                                   
                                    if ($favresult->num_rows > 0 ) {
                                        $i = 0;
                                    /*    while ($rw = mysqli_fetch_assoc($re)) {*/
                                            if ($favourate['spUserid'] == $uid) {
                                                $html .= "<span id='spFavouritePost' data-toggle='tooltip' data-placement='bottom' title='Unfavourite' class='icon-favorites fa fa-heart removefavorites faa-pulse animated' data-postid='" . $rows['idspPostings'] . "'><span class='font_regular'> </span></span>";
                                                $i++;
                                            }
                                        /*}*/
                                        if ($i == 0) {
                                            $html .= "<span id='spFavouritePost' data-toggle='tooltip' data-placement='bottom' title='Favourite' class='icon-favorites fa fa-heart-o sp-favorites faa-pulse animated 74' data-postid='" . $rows['idspPostings'] . "'><span class='font_regular'></span></span>";
                                        }
                                    } else {

                                        $html .= "<span id='spFavouritePost' data-toggle='tooltip' data-placement='bottom' title='Favourite' class='icon-favorites fa fa-heart-o sp-favorites faa-pulse animated 74' data-postid='" . $rows['idspPostings'] . "'><span class='font_regular'></span></span>";
                                    }
                                $html .= '</li>';
                                $html .= "<li><a href='javascript:void(0);'  data-toggle='modal' data-target='#myshare'><span class='sp-share' data-toggle='tooltip' data-placement='bottom' title='Share' data-postid='".$rows['idspPostings']."' src='".($pict)."'><i class=fa fa-share-alt'></i> <span class='font_regular'>Share</span></span></a></li>";
                            $html .= ' </ul>';
                        $html .= ' </div>';
                     $html .= '</div>';


           $html .='</div></div></div>';


        /*  $html .= '<div class="post_timeline post_timeline_all_post searchable deldiv_'.$rows['idspPostings'].'" ><div class="row "><div class="col-md-6">
                                        <input type="hidden" id="postid" value="'.$rows["idspPostings"].'"><input type="hidden" id="postdate" value="'.$rows["spPostingDate"].'">';
           $html .= '<div class="left_profile_timeline">';
                    
                     if (isset($picture)) {
                                     $html .=  "<img alt='profilepic'  class='img-circle' src=' " . ($picture) . "'>";
                                }else{
                                     $html .=  "<img alt='profilepic'  class='' src='".$BaseUrl."/assets/images/icon/blank-img.png' >";
                                }
          $html .='</div>';
          $html .=' <div class="title_profile"><h4><a href="'.$BaseUrl.'/friends/?profileid='.$rows['idspProfiles'].'">'.ucwords(strtolower($profilename));.'</a></h4><h5 id="posttimeago'.$rows["idspPostings"].'">'.$postingDate.' <i class="fa fa-globe"></i></h5></div>';*/



 /* $id = $row['id'];
  $title = $row['title'];
  $content = $row['description'];
  $shortcontent = substr($content, 0, 160)."...";
  $link = $row['link'];
  // Creating HTML structure
  $html .= '<div id="post_'.$id.'" class="post">';
  $html .= '<h1>'.$title.'</h1>';
  $html .= '<p>'.$shortcontent.'</p>';
  $html .= '<a href="'.$link.'" target="_blank" class="more">More</a>';
  $html .= '</div>';*/

}

echo $html;   
?> 