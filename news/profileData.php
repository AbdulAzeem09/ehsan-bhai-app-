<style>
   .media {
   border: 1px solid #000;
   margin-bottom: 5px;
   padding-left: 10px;
   }
</style>

<div style="display:block;margin-top: 20px;" class="post1" id="post1_<?php echo $id; ?>">
   <div id="commentboxx222<?php echo $id; ?>">
      <div class="media"  style="display:block;">
         <!-- answer to the first comment -->
         <div class="media-heading" id="commentbox222<?php echo $id; ?>">
            <button class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse" data-target="#collapseSix2<?php echo $id; ?>" aria-expanded="false" aria-controls="collapseExample">
            <span class="fa fa-minus" aria-hidden="true"></span></button> 
            <span class="label"><a href="<?php echo $BaseUrl; ?>/news/profile.php?id=<?php echo $ppid; ?>">
            <img src="<?php echo $pic; ?>" class="img-circle" style="height:50px; width:50px; margin-top: 5px;"> <?php echo $name;?></a></span> 
            <?php echo $date;?>
         </div>
         <div class="panel-collapse collapse in" id="collapseSix2<?php echo $id ;?>">
            <div class="media-left" >
               <div class="vote-wrap">
                  <div class="save-post">
                     <a><span id="appendbookmark1<?php echo $id ?>" data-mark="<?php echo $id; ?>" class="commentbookmark2"  id="commentbox3333<?php echo $id; ?>"   aria-label="report"> 
                     <?php
                        $bbb=$_SESSION['uid'];
                        $ccc=$_SESSION['pid'];
                        
                        $pro3=new _spprofiles;
                        $rr5=$pro3->readbookmarkdata($bbb,$ccc,$id) ;
                        if($rr5!=false){
                        echo "<i class='fa fa-star' style='color:blue'></i>";	
                        }
                        else {
                        echo "<i class='fa fa-star ' style='color:gray'></i>";	
                        }
                        ?>
                     </span></a>
                  </div>
                  <div class="vote up">
                     <i class="fa fa-menu-up"></i>
                  </div>
                  <div class="vote inactive">
                     <i class="fa fa-menu-down"></i>
                  </div>
               </div>
               <!-- vote-wrap -->
            </div>
            <!-- media-left -->
            <div class="media-body">
               <span style="text-justify: inter-word;" id="commentbox444<?php echo $id; ?>"><?php
                  if(strlen($msg)<=300){
                    echo $msg;            
                  }else{
                   
                   echo substr($msg, 0, 299) . '...';
                  
                  }
                  
                  
                                                                        // $str = substr($str, 0, 7) . '...'; 
                  
                  ?>
               </span>
               
               <div id="attachment2<?php echo $id;?>">
                  <?php  
                     $j=new _news;
                     
                     $media2=$j->read_news_attachment($id);
                     if($media2 != false){
                     while($rowdata2=mysqli_fetch_assoc($media2)){
                     
                     if($rowdata2['type']==3){
                     
                     ?> 
                  <style>
                     .center {
                     display: block;
                     margin-left: auto;
                     margin-right: auto;
                     width: 50%;
                     }
                  </style>
                  <div id="myModal222" class="modal">
                     <span class="close">&times;</span>
                     <div class="card">
                        <img class="modal-content center" id="img012" style="height:300px; width:50%;">
                        <div id="caption2"></div>
                     </div>
                  </div>
                  <div class="col-md-12">
                     <span data-toggle="modal" data-target="#myModal222">
                     <img id="image2<?php echo $id; ?>"  style="height:200px; width:100%;margin-top: 10px;" src="<?php echo $BaseUrl;?>/news/news_upload/<?php echo $rowdata2['attachmentfiles'] ;?>" alt="Card image">
                     </span>
                  </div>
                  <br>
                  <script>
                     var modal2 = document.getElementById("myModal222");
                     
                     // Get the image and insert it inside the modal - use its "alt" text as a caption
                     var img2 = document.getElementById("image2<?php echo $id; ?>");
                     var modalImg2 = document.getElementById("img012");
                     var captionText2 = document.getElementById("caption2");
                     img2.onclick = function(){
                       modal2.style.display = "block";
                       modalImg2.src = this.src;
                       captionText2.innerHTML = this.alt;
                     }
                     
                  </script>
                  <?php 
                     }
                     if($rowdata2['type']==2){
                      
                      
                     ?>
                  <div class="col-md-12">
                     <span>
                        <video style="height:200px; width:100%;margin-top: 10px;" controls>
                           <source src="<?php echo $BaseUrl;?>/news/news_upload/<?php echo $rowdata2['attachmentfiles'] ;?>" type="video/mp4">
                           <source src="<?php echo $BaseUrl;?>/news/news_upload/<?php echo $rowdata2['attachmentfiles'] ;?>" type="video/ogg">
                        </video>
                     </span>
                  </div>
                  <?php
                     }
                                                                if($rowdata2['type']==1){
                     
                     ?> 
                  <div class="col-md-12"> 
                     <span>DOCUMENT <a href="<?php echo $BaseUrl;?>/news/news_upload/<?php echo $rowdata2['attachmentfiles'] ;?>" download="<?php echo $rowdata2['attachmentfiles'] ;?>"><?php echo $rowdata2['attachmentfiles'] ;?></a></span>
                  </div>
                  <?php 
                     }
                                 ?> 
                  <?php	
                     }}
                     	
                     	
                     
                     ?>
               </div>
               <div class="comment-meta">
                  <span><a class="commentlike2" id="appendlike2<?php echo $id; ?>" onclick="ProfieLike(<?php echo $id; ?>)"  style="font-size:15px;">
                  <?php	 //$id=$_POST['comment_id'];
                     $bb=$_SESSION['uid'];
                     $cc=$_SESSION['pid'];
                     
                     $obj5=new _spprofiles;
                     $r5=$obj5->readlikedata($bb,$cc,$id) ;
                     if($r5!=false){
                     echo "<i class='fa fa-thumbs-up'  title='Unlike'></i>";	
                     
                     }
                     else {
                     echo "<i class='fa fa-thumbs-o-up'  title='Like'></i>";	
                     }
                     $r6=$obj5->readlikedata22($id) ;
                     if($r6!=false){
                     $count22=$r6->num_rows;
                     echo "(".$count22.")";
                     }else{
                     echo "(0)";
                     }
                     ?>																			 
                  </a></span>|
                  <?php if($_SESSION['pid']==$ppid){?>
                  <span><a class="commentdel2" onclick="ProfileComDel(<?php echo $id; ?>)" style="font-size:15px;padding-left:5px;"><i class="fa fa-trash"  title="Delete"></i></a></span>|
                  <?php } 
                     $sppid=$_SESSION['pid'];
                     if($sppid!=$pids)
                     {
                     ?> 
                  <span><a class="reportcomment2" data-report="<?php echo $id; ?>" data-toggle="modal" data-target="#exampleModal222"  style="font-size:15px; padding-left:5px;"><i class="fa fa-flag"  title="Report"></i></a></span>|
                  <?php } ?>
                  <span><a  onclick="myFunction1(<?php echo $id; ?>)"   id="hideshow11<?php echo $id; ?>"  style="font-size:15px;padding-left:5px;"><i class="fa fa-eye-slash"  title="Hide"></i></a></span>|
                  <span><a class="" role="button" data-toggle="collapse" id="repcount2<?php echo $id; ?>" href="#replyCommentOne2<?php echo $id; ?>" aria-expanded="false" aria-controls="collapseExample"  style="font-size:15px; padding-left:5px; color:purpal;"><i class="fa fa-comment" style="color: #a07eff; margin-bottom:10px;" title="Reply"></i>
                  <span id="delcnt2<?php echo $id; ?>">
                  <span id="echocnt2<?php echo $id; ?>">
                  <?php
                     $ob=new _spprofilefeature;
                     $resul=$ob->replydatacount($id);   
                     
                     $num_rows=$resul->num_rows;
                     if($resul!=false){
                     	echo '('.$num_rows.')';
                     }
                     else{
                     	echo '(0)';    
                     }
                     
                     ?>	
                  </span></span>
                  </a></span>|
                  <input  type="hidden" id="countrep2<?php echo $id;?>" value="<?php  
                     if($resul!=false){
                     	echo $num_rows; 
                     }
                     else{
                     	echo 0; 
                     } 
                     ?>">
                  <!-------- share---------->
                  <?php
                     $obj=new _spprofilefeature;  
                     	
                     	$res3=$obj->readforshare($id); 
                     	 $row=mysqli_fetch_assoc($res3);
                     	 
                     	$objectt=new _news;
                     
                     
                     $settres=$objectt->read_settings($row['pid']);
                     			 if($settres != false){
                     $setrow=mysqli_fetch_assoc($settres);
                     			 }
                     $can_share=$setrow['can_share']; 
                     
                     //echo $can_share; die;
                     
                     
                     	 $obj123=new _spprofilefeature;  
                     	if($can_share == 1){ 
                     	
                     	
                     	
                     					 $obj123=new _spprofilefeature;  
                                          $res123=$obj123->readsharedata($_SESSION['uid'],$_SESSION['pid'],$id) ;
                                          if($res123!=false){  ?>
                  <input type="hidden" id="share2<?php echo $id; ?>" value="0">
                  <?php } else {   ?>
                  <input type="hidden" id="share2<?php echo $id; ?>" value="1">
                  <?php 
                     } 
                     
                     }else { 
                     
                     
                     $rress=$objectt->followers($_SESSION['pid'],$row['pid']);
                        
                                                           if($rress!=false){    
                     	 			 $obj123=new _spprofilefeature;  
                               $res123=$obj123->readsharedata($_SESSION['uid'],$_SESSION['pid'],$id) ;
                               if($res123!=false){  ?>
                  <input type="hidden" id="share2<?php echo $id; ?>" value="0">
                  <?php } else {   ?>
                  <input type="hidden" id="share2<?php echo $id; ?>" value="1">
                  <?php 
                     } 
                     							 					 
                     	 }  else { ?>
                  <input type="hidden" id="share2<?php echo $id; ?>" value="2">
                  <?php }
                     }
                     																	
                     																	
                     
                     																	
                     			  $res123=$obj123->readsharedata($_SESSION['uid'],$_SESSION['pid'],$id) ;
                                         if($res123!=false){  ?>
                  <span class="sharepost" onclick="myFunctionunshare2(<?php echo $id; ?>)" id="appendshare2<?php echo $id ; ?>" >
                  <a class="" role="button"  style="font-size:15px; padding-left:5px;"><i class='fa fa-share-alt' title='Unshare' style='color:purple;'></i>
                  <?php
                     $r6=$obj123->readsharedata22($id) ;  
                     if($r6!=false){
                     	$count22=$r6->num_rows;
                     	echo "(".$count22.")";
                     }else{
                     	echo "(0)";
                     }
                     
                     ?>
                  </a>
                  </span>
                  <?php  }
                     else{
                     
                     
                     
                     ?>
                  <span class="sharepost" onclick="myFunctionshare2(<?php echo $id; ?>)" id="appendshare2<?php echo $id ; ?>" >
                  <a class="" role="button"  style="font-size:15px; padding-left:5px;"><i class='fa fa-share-alt' title='Share' style='color:#a07eff;'></i>
                  <?php
                     $r6=$obj123->readsharedata22($id) ;    
                     if($r6!=false){
                     	$count22=$r6->num_rows;
                     	echo "(".$count22.")";
                     }else{
                     	echo "(0)";
                     }
                     
                     ?>
                  </a>
                  </span>
                  <?php } ?>


                     
					 <div id="appendreply2<?php echo $id ;?>"></div>
               <!------- RPLY    ------->
               <?php  
                  $objj=new _spprofiles;
                  
                  $r3=$objj->readreplydata($id);
                  if($r3!=false){
                  	while($row33=mysqli_fetch_assoc($r3)){
                  		$reply_message=$row33['reply_message'];
                  
                  		$profile_id=$row33['profile_id'];
                  		$id2=$row33['id'];
                  		$rpdate=$row33['reply_date'];
                  
                  		$r1=$objj->readreplybypid($profile_id);
                          if($r1!=false){
                  		$row44=mysqli_fetch_assoc($r1);
                  		
                  			   }
                  
                  		$pname=$row44['spProfileName'];
                  
                  		$pic2=$row44['spProfilePic'];
                  		?>
               <div class="form-group" id="rpllybox2<?php echo $id2; ?>" >
                  <div class="form-group">	
                     <a href="<?php echo $BaseUrl; ?>/news/profile.php?id=<?php echo $profile_id; ?>"><span style="font-weight: normal; color:#115abc;"><img src="<?php echo $pic2; ?>" class="img img-circle" style="height:30px; width:30px;"><?php echo '  '.$pname;?></span><span><?php echo'   '.$rpdate; ?></span></a><br>
                     <span for="comment" style="margin:0px; word-break: break-all; color: purple; text:normal;"><?php 
                        echo $reply_message;  ?>          
                     </span> 
					 <br>
                     <?php
                        if($_SESSION['pid']==$profile_id){
                        		?>
                     <span><a class="delreply" onclick="DelreplyReply2(<?php echo $id2;?>,<?php echo $id;?>)" data-reply="<?php echo $id2; ?>" style="font-size:15px;padding-left:5px;"><i class="fa fa-trash" title="Delete"></i></a></span>|
                     <span><a class="bookmarkreply" onclick="BookmarkReply2(<?php echo $id2; ?>)" data-bookmarkreply="<?php echo $id ; ?>" id="appendbookmarkreply2<?php echo $id2; ?>" style="font-size:15px;padding-left:5px;">
                     <?php 
                        $b3=$_SESSION['uid'];  
                        $c3=$_SESSION['pid'];
                        
                        $object5=new _spprofiles;
                        $result44=$object5->readreplybookmarkdata($b3,$c3,$id2) ;
                        
                                                                              // print_r($result44);
                        //die("9999999999999999999999999");
                        
                        if($result44!=false){
                        	echo "<i class='fa fa-star' style='color:blue' title='Unbookmark'></i>";	
                        }
                        else {
                        	echo "<i class='fa fa-star' style='color:gray' title='Bookmark'></i>";	
                        }
                        ?>
                     </a></span>
                     <?php } ?>
                  </div>
                  <input type="hidden" name="comment_id" value="<?php echo $id; ?>">
               </div>
               <?php } }?>
               <!---reply---->


				  
                 
                  <div class="collapse" id="replyCommentOne2<?php echo $id; ?>">
                     <div class="form-group" style="margin-bottom:none;">
                        <label for="comment">Reply</label>  
                        <input type="hidden" name="comment_id" id="com_id2<?php echo $id; ?>" value="<?php echo $id; ?>">
                        <textarea name="comment" class="form-control" id="reply2<?php echo $id; ?>" rows="3"></textarea>
                     </div>
                     <?php $obj=new _spprofilefeature;  
                        $res33=$obj->readforReply($id); 
                         $row22=mysqli_fetch_assoc($res33);
                         
                        $objectt=new _news;
                        
                        
                        $settres=$objectt->read_settings($row22['pid']);  
                        		// if($settres != false){
                        $setrow=mysqli_fetch_assoc($settres);
                        $can_comment=$setrow['can_comment']; 
                        
                        //echo $can_share; die;
                        
                        
                         $obj123=new _spprofilefeature;  
                        if($can_comment == 1){  
                        ?>	
                     <button type="submit" class="btn btn-default replysubmit" onclick="ReplySubmit2(<?php echo $id;?>)" data-apenrep="<?php echo $id; ?>" name="submit">Send</button>
                     <?php }else{ 
                        $rress=$objectt->followers($_SESSION['pid'],$row['pid']);
                           
                                                              if($rress!=false){  ?>
                     <button type="submit" class="btn btn-default replysubmit" onclick="ReplySubmit2(<?php echo $id;?>)" data-apenrep="<?php echo $id; ?>" name="submit">Send</button>
                     <br>
                     <?php	}  
                        else{?>
                     <div class="alert alert-danger" style="margin-top:5px;">
                        <strong>You Dont Have Permission to Reply On This Post!</strong>
                     </div>
                     <?php
                        }
                        } ?>
                  </div>
                  <br><br>
               </div>
               <!-- comment-meta -->
            </div>
         </div>
         <!-- comments -->
      </div>
   </div>
</div>