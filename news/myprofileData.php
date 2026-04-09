<div class="post1" id="post1_<?php echo $id; ?>">
   <div id="commentbox1<?php echo $id; ?>">
      <div class="media"  style="display:block;">
         <!-- answer to the first comment -->
         <div class="media-heading" id="commentbox222<?php echo $id; ?>">
            <button class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse" data-target="#collapseSix1<?php echo $id; ?>" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-minus" aria-hidden="true"></span></button> <span class="label"><a href="<?php echo $BaseUrl; ?>/news/profile.php?id=<?php echo $ppid; ?>"><img src="<?php echo $pic; ?>" class="img-circle"></span> <?php echo $name;?></a> <?php echo $date;?>
         </div>
         <div class="panel-collapse collapse in" id="collapseSix1<?php echo $id ;?>">
            <div class="media-left" >
               <div class="vote-wrap">
                  <div class="save-post">
                     <a><span id="appendbookmark1<?php echo $id ?>" data-mark="<?php echo $id; ?>" class="commentbookmark1"    aria-label="report"> 
                     <?php
                        $bbb=$_SESSION['uid']; 
                        $ccc=$_SESSION['pid'];
                        
                        $obj5=new _spprofiles;
                        $rr5=$obj5->readbookmarkdata($bbb,$ccc,$id) ;
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
               
			   
			   
               <div id="attachment1<?php echo $id;?>">
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
				   <?php $tempno2=rand(111,999); ?>
                  <div class="col-md-12">
                     <span data-toggle="modal" data-target="#myModal222">
                     <img style="margin-top: 10px;height: 200px;width: 100%;" id="image2<?php echo $id.$tempno2; ?>"  style="height:200px; width:100%;" src="<?php echo $BaseUrl;?>/news/news_upload/<?php echo $rowdata2['attachmentfiles'] ;?>" alt="Card image"><br>
                     </span>
                  </div>
                  <br>
                  <script>
                     var modal2 = document.getElementById("myModal222");
                     
                     var img2 = document.getElementById("image2<?php echo $id.$tempno2; ?>");
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
                  <span><a class="commentlike1" id="appendlike1<?php echo $id; ?>" onclick="myFunctionLike(<?php echo $id; ?>)"  style="font-size:15px;">
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
                  </a></span>&nbsp;|
                  <?php if($_SESSION['pid']==$ppid){?>
                  <span><a class="commentdel2" onclick="myFunctionDel2(<?php echo $id; ?>)"  style="font-size:15px;padding-left:5px;"><i class="fa fa-trash"  title="Delete"></i></a></span>&nbsp;|&nbsp;
                  <?php } 
                     $sppid=$_SESSION['pid'];  
                     if($sppid!=$pids)
                     {
                     ?>
                  &nbsp; <span><a class="reportcomment1" data-report="<?php echo $id; ?>" data-toggle="modal" data-target="#exampleModal22"  style="font-size:15px; padding-left:5px;"><i class="fa fa-flag"  title="Report"></i></a></span>&nbsp;|&nbsp;
                  <?php } ?>
                  <span><a  onclick="myFunction2(<?php echo $id; ?>)"   id="hideshow1<?php echo $id; ?>"  style="font-size:15px;padding-left:5px;"><i title="View" class="fa fa-eye" ></i></a></span>&nbsp;|&nbsp;
                  <span>
                  <a class="" role="button" data-toggle="collapse" id="repcount<?php echo $id;?>"  href="#replyCommentOne2<?php echo $id; ?>" aria-expanded="false" aria-controls="collapseExample"  style="font-size:15px; padding-left:5px;"><i class="fa fa-comment" style="margin-bottom: 10px;"  title="Reply"></i></a>
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
                  </a></span>
                  <input  type="hidden" id="countrep2<?php echo $id;?>" value="<?php  
                     if($resul!=false){
                     	echo $num_rows;
                     }
                     else{
                     	echo 0; 
                     } 
                     ?>">
					 
					 
					 <div id="appendreply2<?php echo $id ;?>"></div>
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
                  
                  $row44=mysqli_fetch_assoc($r1);
                  
                  $pname=$row44['spProfileName'];
                  
                  $pic2=$row44['spProfilePic'];
                  ?>   
               <div class="form-group" id="rpllybox11<?php echo $id2; ?>">
                  <div class="form-group">
                     <a href="<?php echo $BaseUrl; ?>/news/profile.php?id=<?php echo $profile_id; ?>"><span><img src="<?php echo $pic2; ?>" class="img img-circle" style="height:25px; width:25px;"><?php echo $pname.'   '.$rpdate; ?></span></a>
					 
                  </div>
                  <label for="comment" style="margin:0px;"><?php if(strlen($reply_message)<=50){
                     echo $reply_message;            
                         }else{
                     echo substr($reply_message,0,49).'...' ;
                     }?>  <a class="delreply" onclick="DelreplyReply2(<?php echo $id2; ?>,<?php echo $id;?>)" data-reply="<?php echo $id2; ?>" style="font-size:15px;padding-left:5px;"><i  title="Delete" class="fa fa-trash" title="Delete"></i></a></label>
                  <input type="hidden" name="comment_id" value="<?php echo $id; ?>">
               </div>
               <?php } }?>
					 
					 
                  <div class="collapse" id="replyCommentOne2<?php echo $id; ?>">
                     <div class="form-group" style="margin-bottom:none;
                        " >
                        <label for="comment">Reply</label>
                        <input type="hidden" name="comment_id" id="com_id2<?php echo $id; ?>" value="<?php echo $id; ?>">
                        <textarea name="comment" class="form-control" id="reply2<?php echo $id; ?>" rows="3"></textarea>
                     </div>
                     <button type="submit" class="btn btn-default replysubmit" onclick="ReplySubmit2(<?php echo $id;?>)" data-apenrep="<?php echo $id; ?>" name="submit">Send</button>
                     <br>
                  </div>
               </div>
               <!-- comment-meta -->
            </div>
         </div>
         <!-- comments -->
      </div>
   </div>
</div>