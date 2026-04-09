<div class="post" id="post_<?php echo $id; ?>">
   <div id="commentbox<?php echo $id; ?>" >
      <div class="media"  style="display:block;">
	    
	  
	 
         <!-- answer to the first comment -->
         <div class="media-heading" id="commentbox22<?php echo $id; ?>" style="
    margin-top: 10px;
"> 
		 
		
		 
              <button  id="btn11"  class="btn btn-default btn-collapse btn-xs" type="button" data-toggle="collapse" data-target="#collapseSix<?php echo $id; ?>" aria-expanded="false" aria-controls="collapseExample"><span id="span1" class="fa fa-minus" aria-hidden="true"></span></button> <span class="label">
			<script>
			$( document ).ready(function() {
				$("#btn11").click(function(){
					
				$('#span1').toggleClass('fa-minus fa-plus');
				});
			});
			</script>
			<?php   
if($pic!=""){
?>
			<a href="<?php echo $BaseUrl; ?>/news/profile.php?id=<?php echo $ppid; ?>"><img src="<?php echo $pic; ?>" class="img-circle" style="width: 50px; height: 50px;"></span> <?php echo $name;?></a>
	<?php
}else
{
?>
<a href="<?php echo $BaseUrl; ?>/news/profile.php?id=<?php echo $ppid; ?>"><img  style="margin-top: 10px;width: 50px;height: 50px;" src="<?php echo $BaseUrl; ?>/img/no.png" class="img-circle" style="width: 50px; height: 50px;"></span> <?php echo $name;?></a>
<?php
}

?>		
			
			
			 <?php
$shareobj=new _spprofilefeature;
		if($shared==1){ 
		//die("***********");
	$sharedres	=$shareobj->readcommentByParrentId($parrent_id);    
//print_r($sharedres);
//die('====');

	if($sharedres!=false){
		$shreRow=mysqli_fetch_assoc($sharedres);  
		 $sharedpid=$shreRow['pid'];
		//echo $ppid;
		//die("PPPPPPPPPPPPP");
		}
		
		$shares=$shareobj->readBysharedpId($sharedpid);
         	if($shares!=false){
         	
         	$sharow=mysqli_fetch_assoc($shares);
         
         	$sharedpic=$sharow['spProfilePic'];
         	$sharedname=$sharow['spProfileName'];
		//echo $sharedname;
//die('======================');  
			}
		echo 'Shared  '.'<a href="'.$BaseUrl.'/news/profile.php?id='.$sharedpid.'">'.$sharedname."'s".'</a>'.' Post'.' ';
		
		} 
	//	print_r($shreRow);
		
		
   
		
		 
		 ?> 
			
			<?php echo $date;?> 
         </div>
         <div class="panel-collapse collapse in" id="collapseSix<?php echo $id ;?>">
            <div class="media-left" >
               <div class="vote-wrap">
                  <div class="save-post">
				  <?php 
				  $bbb=$_SESSION['uid'];
                        $ccc=$_SESSION['pid']; 
				   $obj5=new _spprofiles;
                        $rr5=$obj5->readbookmarkdata($bbb,$ccc,$id) ;
						//print_r($rr5); 
                        if($rr5!=false){
				  
				  ?>
				         <input type="hidden" id="bookmark<?php echo $id; ?>" value="0">
                     <a><span id="appendbookmark<?php echo $id ?>" onclick="BookmarkComment(<?php echo $id; ?>)" class="commentbookmark"    aria-label="report"> 
					 <i class='fa fa-star' style='color:blue'></i></span></a>
                     <?php
						}else{
                        ?>
						<input type="hidden" id="bookmark<?php echo $id; ?>" value="1">
						<a><span id="appendbookmark<?php echo $id ?>" onclick="BookmarkComment(<?php echo $id; ?>)" class="commentbookmark"    aria-label="report"> 
					 <i class='fa fa-bookmark' style='color:gray'></i>
						<?php } ?>
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
               <span style="text-justify: inter-word;  word-break: break-all;" id="commentbox44<?php echo $id; ?>"><?php
                  echo $msg;   
                                                                        ?>
               </span> 
			   
			   
			   
			  
			  
               <div id="attachment<?php echo $id;?>">
                  <?php  
                     $j=new _news;
                     
                     $media=$j->read_news_attachment($id);
                     if($media != false){
                     while($rowdata=mysqli_fetch_assoc($media)){
                     
                     if($rowdata['type']==3){
                     if($rowdata['attachmentfiles']){
                     ?> 
                  <style>
                     .center {
                     display: block;
                     margin-left: auto;
                     margin-right: auto;
                     width: 50%;
                     }
                  </style>
                  <div id="myModal22" class="modal">
                     <span class="close">&times;</span>
                     <div class="card">
                        <img class="modal-content center" id="img01" style="height:300px; width:50%;">
                        <div id="caption"></div>
                     </div>
                  </div>
				 <?php $tempno=rand(111,999); ?>
                  <div class="col-md-12">
                     <span data-toggle="modal" data-target="#myModal22">
                     <img id="image<?php echo $id.$tempno; ?>"  style="height:200px; width:100%;margin-top: 10px;" src="<?php echo $BaseUrl;?>/news/news_upload/<?php echo $rowdata['attachmentfiles'] ;?>" alt="Card image">
                     </span>
                  </div>
                  <br>
                  <script>  
                     var modal = document.getElementById("myModal22");
                     
                     // Get the image and insert it inside the modal - use its "alt" text as a caption
                     var img = document.getElementById("image<?php echo $id.$tempno; ?>");
                     var modalImg = document.getElementById("img01");
                     var captionText = document.getElementById("caption");
                     img.onclick = function(){
						 
						 ///alert("OOOOOOOK");   
						 
                       modal.style.display = "block";
                       modalImg.src = this.src;
                       captionText.innerHTML = this.alt;
                                                                                                }
                     
                  </script>
                  <?php 
                     }}
                     if($rowdata['type']==2){
                       if($rowdata['attachmentfiles']){
                      
                     ?>
                  <div class="col-md-12">   

                     <span>
                        <video style="height:200px; width:100%; margin-top: 10px;" controls>
                           <source src="<?php echo $BaseUrl;?>/news/news_upload/<?php echo $rowdata['attachmentfiles'] ;?>" type="video/mp4">
                           <source src="<?php echo $BaseUrl;?>/news/news_upload/<?php echo $rowdata['attachmentfiles'] ;?>" type="video/ogg">
                        </video>
                     </span>
                  </div>
                  <?php
                     }}  
                                                                if($rowdata['type']==1){
                     if($rowdata['attachmentfiles']){
                     ?> 
                  <div class="col-md-12">
                     <span>DOCUMENT <a style=" margin-top:10px;" href="<?php echo $BaseUrl;?>/news/news_upload/<?php echo $rowdata['attachmentfiles'] ;?>" download="<?php echo $rowdata['attachmentfiles'] ;?>"><?php echo $rowdata['attachmentfiles'] ;?></a></span>
                  </div>
                  <br><br>
                  <?php 
																}}
                                 ?> 
                  <?php	
                     }}
					 ?>
               </div>
			   
			    
			   
			   <br>
               <div class="comment-meta" style="margin-bottom: -40px;">
			   
			   
			   <?php 
			   
			   
			   
			   ?>
			  
                  <span><a class="commentlike" id="appendlike<?php echo $id; ?>" data-like="<?php echo $id; ?>" onclick="myFunction22(<?php echo $id; ?>)"  style="font-size:15px;"> 
                  <?php	 //$id=$_POST['comment_id'];
                     $bb=$_SESSION['uid'];  
                     $cc=$_SESSION['pid'];
                     
                     $obj5=new _spprofiles;
                     $r5=$obj5->readlikedata($bb,$cc,$id) ;
                     if($r5!=false){
                     	echo "<i class='fa fa-thumbs-up'  title='Unlike' style=' margin-top: 5px;'></i> ";	
                     
                     }
                     else {
                     	echo "<i class='fa fa-thumbs-o-up' style='color: #a07eff;margin-top: 5px;' title='Like'></i> ";	
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
                  <span><a class="commentdel" onclick="myFunctionDel(<?php echo $id; ?>)" data-del="<?php echo $id; ?>"  style="font-size:15px;padding-left:5px;"><i class="fa fa-trash" style="color: red;" title="Delete"></i></a></span>|
                  <?php } 
                     $sppid=$_SESSION['pid'];
                     if($sppid!=$pids)
                     {
                     	?>
                  <!--a href="javascript:void(0)" data-toggle="modal" data-target="#flagPost" ><i class="fa fa-flag"></i> Flag This Profile</a-->
                  <span><a href="javascript:void(0)"  data-toggle="modal" data-target="#flagPost2"  style="font-size:15px; padding-left:5px;"><i class="fa fa-flag" style="color: #a07eff;" title="Report"></i></a></span>|
                  <!--span><a class="reportcomment" data-report="<?php echo $id; ?>" data-toggle="modal" data-target="#exampleModal22"  style="font-size:15px; padding-left:5px;"><i class="fa fa-flag"  title="Report"></i></a></span-->|
                  <?php } ?>
                  <span><a  onclick="myFunction(<?php echo $id; ?>)"   id="hideshow<?php echo $id; ?>"  style="font-size:15px;padding-left:5px;"><i class="fa fa-eye" style='color: #a07eff;' title="Hide"></i></a></span>|
                  <span>
				  
                  <a class="" role="button" data-toggle="collapse" id="repcount<?php echo $id; ?>" href="#replyCommentOne<?php echo $id; ?>" aria-expanded="false" aria-controls="collapseExample"  style="font-size:15px; padding-left:5px; color:purpal;"><i class="fa fa-comment" style="color: #a07eff;" title="Reply"></i>




				<span id="delcnt<?php echo $id; ?>">
                 <span id="echocnt<?php echo $id; ?>">
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
				  
				  
				  
				  <input  type="hidden" id="countrep<?php echo $id;?>" value="<?php  
                     if($resul!=false){
                     	echo $num_rows;
                     }
                     else{
                     	echo 0; 
                     } 
					 ?>">
					 

					<?php  $obj123=new _spprofilefeature;  
                     $res123=$obj123->readsharedata($_SESSION['uid'],$_SESSION['pid'],$id) ;
                     if($res123!=false){  ?>
                    				 <input type="hidden" id="share<?php echo $id; ?>" value="0">
					 <?php } else {   ?>
						 	 <input type="hidden" id="share<?php echo $id; ?>" value="1">
						 <?php 
					 } ?>
				    
				  <?php   
				    
				  
				   
				
				   
                     $res123=$obj123->readsharedata($_SESSION['uid'],$_SESSION['pid'],$id) ;
                     if($res123!=false){  ?>
                    
					 
                     	  <span id="appendshare<?php echo $id ; ?>" >
                  <a class="sharepost" onclick="myFunctionunshare(<?php echo $id; ?>)" class="" role="button"  style="font-size:15px; padding-left:5px;"><i class='fa fa-share-alt' title='Unshare' style='color:purple;'></i>
				         
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
				   
                  <span id="appendshare<?php echo $id ; ?>">
                  <a class="sharepost" onclick="myFunctionshare(<?php echo $id; ?>)" class="" role="button"  style="font-size:15px; padding-left:5px;"><i class='fa fa-share-alt' title='Share' style='color:#a07eff;'></i>
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
				 
				   <?php 
				   
				   if($_SESSION['pid']==$ppid){
					   
					   ?>
				  |<span><a  href="<?php echo $BaseUrl?>/news/post_edit.php?comment_id=<?php echo $id;?>" class="editpost" style="font-size:15px;padding-left:5px;"><i class="fa fa-edit" title="Edit" style="
    font-size: 17px;
   
" ></i></a></span> 
				  
					 <?php } }?>
				  
				  
				  
				  
				  <div id="appendreply<?php echo $id ;?>"></div>
			   
			   
			   
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
                  
				
				
				  
                  <div class="form-group" id="rpllybox<?php echo $id2; ?>" >
                     <div class="form-group">	
                        <a href="<?php echo $BaseUrl; ?>/news/profile.php?id=<?php echo $profile_id; ?>"><span style="font-weight: normal; color:#115abc;"><img src="<?php echo $pic2; ?>" class="img img-circle" style="height:30px; width:30px;"><?php echo '  '.$pname;?></span><span><?php echo'   '.$rpdate; ?></span></a><br>
                        <span for="comment" style="margin:0px; word-break: break-all; color: purple; text:normal;"><?php 
                           echo $reply_message;  ?>          
                        </span> 
                        <?php
                           if($_SESSION['pid']==$profile_id){
                           		?>

                          								
                        <span><a class="delreply" onclick="DelreplyReply(<?php echo $id2;?>,<?php echo $id;?>)" data-reply="<?php echo $id2; ?>" style="font-size:15px;padding-left:5px;"><i class="fa fa-trash" title="Delete"></i></a></span>|
                        <span><a class="bookmarkreply" onclick="BookmarkReply(<?php echo $id2; ?>)" data-bookmarkreply="<?php echo $id ; ?>" id="appendbookmarkreply<?php echo $id2; ?>" style="font-size:15px;padding-left:5px;">
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
			   
			   <!--------RPLY  ---------->
				  
				  
				           <div class="collapse" id="replyCommentOne<?php echo $id; ?>">
                   
                        <div class="form-group" style="margin-bottom:none;
                           " >
                           <label for="comment" style="margin-top:10px;">Reply</label>    
                           <input type="hidden" name="comment_id" id="com_id<?php echo $id; ?>" value="<?php echo $id; ?>">
                           <textarea name="comment" class="form-control" id="reply<?php echo $id; ?>" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-default replysubmit" onclick="ReplySubmit(<?php echo $id;?>)" data-apenrep="<?php echo $id; ?>" name="submit">Send</button>
                    
					   <br>
                  </div>
                  <br><br>
				  
				  <br>
                  <!--reply data 222@@@@@@@@@@@@--->
           
               </div>
			   
			   
               <!-- comment-meta -->
            </div>
         </div>
         <!-- comments -->
      </div>
   </div>

</div>