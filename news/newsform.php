 <?php
 
   $nws=new _news;
	   
	 $lastpid=$_SESSION['pid'];
	  
	$nws->delete_tempfiles($lastpid); 
	

 

include( "../univ/main.php");
$con = mysqli_connect(DOMAIN, UNAME, PASS);

if(!$con) {
    echo 'Not connected to server';
}
//Connection to database
if(!mysqli_select_db($con, DBNAME)) { 
    echo 'Database Not Selected';
}
?>
<link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/style.css">

<link rel="stylesheet" href="css/bootstrap.min.css" >
      <!-- Optional theme -->
      <link rel="stylesheet" href="<?php echo $BaseUrl; ?>/assets/css/bootstrap-theme.min.css">
      <!-- <link rel="stylesheet" type="text/css" href="css/docs.theme.min.css"> -->
     
      <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl; ?>/assets/css/newsviews.css">
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     
<style>
.post2{
	border:1px solid gray;
	padding:20px;
	
    border-radius: 10px;
	
}


.form-group {
    margin-bottom: 1px!important;

}
.icons {
    margin-bottom: -20px!important;

}
.zoom1:hover {
  -ms-transform: scale(1.10); /* IE 9 */
  -webkit-transform: scale(1.10); /* Safari 3-8 */
  transform: scale(1.10); 
}

    

</style>
   

  
<h1 style="margin-top:0px"> Views</h1>   

<form class="postForm" method="post" action=""  id="sp-form-post2" enctype="multipart/form-data" >
    <div class="row post2" style="border:1px solid gray" >
							  
    <input type="hidden" id="catname2" value="">
    <input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="16">
    <input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="-1">
    <input type="hidden" class="dynamic-pid" id="spProfiles_idspProfiles2" name="spProfiles_idspProfiles" value="<?php echo $_SESSION["pid"]; ?>">
    <input type="hidden" name="spPostingDate" id="spPostingDate" value="<?php echo date("Y-m-d H:i:s");?>">
    <input type ="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum_" class="album_id2" value="<?php echo $albumid; ?>">
                            
    <div class="form-group" style="margin-bottom:5px;">
        <label for="comment">Your Views</label> 
        <label class="pull-right"><a href="<?php echo $BaseUrl;?>/news/follower.php?id=<?php echo $_SESSION['pid']; ?>">Follower</a> <strong><?php 
                $obj=new _spprofilefeature;
                $ress=$obj->readfollowersallcount($_SESSION['pid']);
            
                $count1=$ress->num_rows;
                $count=$count1-1;
                
                
                if($count>0){
                echo $count;
                }
                else{
                    echo "0";
                }
                ?></strong> |<a href="<?php echo $BaseUrl;?>/news/following.php?id=<?php echo $_SESSION['pid']; ?>"> Following </a> <strong>
                <?php 
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
                ?></strong></label>
        <input type="hidden" name="spids"id="spids">

        <input type="hidden" name="tempnum"id="tempNum" value="<?php  
        
        $randomNumber = rand(11111,99999);
        echo $randomNumber;
        
        $_SESSION['rand']=$randomNumber;
        ?>"> 
        
        <textarea class="form-control" rows="3" id="views_comment" maxlength="300" placeholder="Post your views here...." name="comment" cols="60"  onkeyup="charcountupdate(this.value)" required   ></textarea><span id="charcount"></span>
    </div>
    <div class=" form-group icons">
        <label class="buton btn-bs-file custom-file-upload  " style="margin-top: 14px;" ><input type="file" class="" id="addimages22" name="newsPic[]" accept="image/*" onchange="readURL(this);"  ><i  aria-hidden="true"></i>&nbsp; <i class="fa fa-picture-o fa-lg zoom1" style="font-size: 30px;color:#f38080;" ></i></label> 

        <label class=" buton btn-bs-file custom-file-upload  "><input type="file" id="addvideo2" class="spmedia foo"   name="newsMedia"  accept="video/*,.mp3,.mpa,.wav,.wma,.midi,.mid" ><i  aria-hidden="true"></i>&nbsp;<i class="fa fa-video-camera fa-lg zoom1" style="font-size: 30px;"></i></label> 

        <label class="buton btn-bs-file custom-file-upload  "><input type="file" id="addnewsDocument" class='spDocument foo' name="newsDocument" accept=".pdf,.doc,.xls,.docx "/><i  aria-hidden="true"></i>&nbsp; <i class="fa fa-file zoom1" style="font-size: 22px; color:#31dfe5;" aria-hidden="true"></i></label>

        <!--label class=" buton btn-bs-file custom-file-upload  "><a href="#"><i class="fa fa-map-marker fa-lg"></i></a></label-->
    <button type="button" class="btn  btn-small pull-right buton btn btnPosting  db_primarybtn btn-border-radius" id="spPostSubmitnews" type="button"  data-visibility="<?php echo "-1" ?>" data-loading-text="Posting..." style="color:white;margin-top: 14px;" >Post</button>
    

        
    
    </div> 
    
    <span class="col-md-12 " style="margin-top: 20px;" id="preview_image">
    
    </span><br>  
    

    </div>  
</form>







<!--form method="post" action=""  id="sp-form-post2" enctype="multipart/form-data" >
        <input type="hidden" id="catname2" value="">
        <input class="spCategories_idspCategory" name="spCategories_idspCategory" type="hidden" value="16">
        <input id="spPostingVisibility" name="spPostingVisibility" type="hidden" value="-1">
        <input type="hidden" class="dynamic-pid" id="spProfiles_idspProfiles2" name="spProfiles_idspProfiles" value="<?php echo $_SESSION["pid"]; ?>">

        <input type="hidden" name="spPostingDate" id="spPostingDate" value="<?php echo date("Y-m-d H:i:s");?>">

        <div class="row">
           
            <div class="col-md-12">
                <div class="topstatus timeline-topstatus">
                    <div class="createbox"> 
                        <span><label><img src="<?php echo $BaseUrl;?>/assets/images/icon/time-line/create_post_icon_enable.png" alt="" style="width:20px;" class="img-responsive" >Create a post</label></span>
                    </div>
                </div>
            </div>
            <?php
                $albumObj = new _album;
                // following commented line not works in some cases.
                //$resultOfAlbum = $albumObj->readalbum($_SESSION["pid"]);

                $pid = $_SESSION["pid"];
                $query = "SELECT * FROM sppostingalbum as t
                INNER JOIN spProfiles as d ON t.spProfiles_idspProfiles = d.idspProfiles
                WHERE t.spProfiles_idspProfiles = ".$pid;

                $resultOfAlbum = mysqli_query($con,$query);

                if ($resultOfAlbum->num_rows > 0) {
                    while ($row = mysqli_fetch_array($resultOfAlbum)) {
                        if ($row['spPostingAlbumName'] == "Timeline") {
                            $albumid = $row["idspPostingAlbum"];
                        }
                    }
                    if (!isset($albumid)) {
                        $albumid = $albumObj->timelinealbum($pid);
                    }
                }else {
                    $albumid = $albumObj->timelinealbum($pid);
                }
            ?>
            <input type ="hidden" id="albumid" data-filter="0" name="spPostingAlbum_idspPostingAlbum_" class="album_id2" value="<?php echo $albumid; ?>">
            <div class="col-md-12">
                <div class="statusimage commentprofile">
                    <?php
                        $p = new _spprofiles;
                        $result = $p->read($_SESSION['pid']);
                        if ($result != false) {
                            $row = mysqli_fetch_assoc($result);
                          
						  
						 
						}
						
						
						

                    ?>
					
					 <style>
					 
					 
					 .statusimage textarea {
						 padding-left: 23px;
					 }
					 
					 
					 
					 .commentprofile textarea {
    border:solid 1px orange!important;
    border-radius: 0!important;
    resize: none;
    box-shadow: none;
}
					 
					 
					 
					 
					 i.emoji-picker-icon.emoji-picker.fa.fa-smile-o {
																		display: none;
																	}
					 
					 
					 
								  .buton{
								  font-size: 17px;
                                  padding: 4px; 
								     
} 
								 
								  </style> 
                    
					<input type="hidden" name="spids"id="spids">    
                    <textarea  type="text" class="form-control post_box border border-secondary" id="views_comment" maxlength="300" placeholder="Post your views here...." name="comment" cols="50"   rows="3" onkeyup="charcountupdate(this.value)" required ></textarea> <span id="charcount"></span><br>
					
					  
                </div>
                <div class="post_btn_footer post_footer_timeline" style="white-space:nowrap;"> 
                    <label class="tel_feel"></label>

         
                            
                           <label class="buton btn-bs-file custom-file-upload  "><input type="file" class="" id="addimages22" name="" accept="image/*"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; <i class="fa fa-picture-o fa-lg" style="font-size: 30px;" ></i></label> 

                           <label class=" buton btn-bs-file custom-file-upload  "><input type="file" id="addvideo2" class="spmedia foo"  name="newsMedia"  accept="video/*,.mp3,.mpa,.wav,.wma,.midi,.mid"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;<i class="fa fa-video-camera fa-lg" style="font-size: 30px;"></i></label> 

                           <label class="buton btn-bs-file custom-file-upload  "><input type="file" id="addnewsDocument" class='spDocument foo' name="newsDocument" accept=".pdf,.doc,.xls,.docx " /><i class="fa fa-plus" aria-hidden="true"></i>&nbsp; <i class="fa fa-file" style="font-size: 22px;" aria-hidden="true"></i></label>

                                 
                    <div class="dropdown pull-right timeline_butn">
                        <button id="spPostSubmitnews" type="button"  class=" buton btn btnPosting  db_primarybtn" data-visibility="<?php echo "-1" ?>" data-loading-text="Posting..." style="margin-top:12px; padding:4px 8px;">Post</button>
                       <!-- <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" id="mygroup" ><span class="caret"></span></button>>
                        <ul class="dropdown-menu timelinedrop" id="allmygroup">
                            <li><label>Share with group</label></li>
                            <?php include("allmygroup.php"); ?> 
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-12 hidden" id="showchekbox2">
                <div class="post_timeline acknowled" style="padding: 5px;">
                    <label class="checkbox-inline"><input type="checkbox" id="chkAcknw" value="1" checked="">Acknowledgement: I am owner of this item.</label>
                    <label class="checkbox-inline"><input type="checkbox" id="chkAgree" value="1" checked="">I agree to the <a href="<?php echo $BaseUrl;?>/page/?page=copyrights" target="_blank" class="anchor_default">copyright  </a>violate information</label>
                </div>
            </div>
            <div id="postingPicPreview">
                <div id="dvPreview2" class="hidden timelineimg"></div>
            </div>
            <div id="media-container"></div>
        </div>
    </form-->
    <!--div class="timelineload11 " > 
        <div class="loader"></div>
		
    </div--> 
    <div class="row no-margin">
        <div class="col-md-12 no-padding">
            <div id="mediaTitle2" class=""></div>
            <div id="groupTitle" class=""></div>
        </div>
        <div class="col-md-12 no-padding">
            <div id="progressBox" style="" class="">
                <progress id="progressBar" value="0" max="100" style="width:100%"></progress>
                <span id="status">100% Loading</span>
            </div>
        </div>
    </div>
	
