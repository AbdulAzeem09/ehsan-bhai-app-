<?php
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
   	
   	
   	$comment_id = isset($_GET['comment_id']) ? (int) $_GET['comment_id'] : 0;
   	
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
      <script src="../assets/js/validations.js"></script>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
      <style>
         .imgres a img{
         width:100px;height:100px;	
         }
         .imgres{
         margin-top:-15px;
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
                  <?php  include_once("newsSidebar.php"); ?>
                  <!-- Page Content -->
                  <div id="page-content-wrapper">
                     <div class="container-fluid">
                        <div class="row">
                           <div class="col-md-12 h style-1">
                             
                                  
                                 <style>
                                    .center {
                                    display: block;
                                    margin-left: auto;
                                    margin-right: auto;
                                    width: 50%;
                                    }
                                 </style>
								 
								 <?php   
								   $obj=new _spprofilefeature;
								   
								   
								$result=$obj->readcommentforupdate($comment_id);
								if($result!=false){
									$crow=mysqli_fetch_assoc($result);
									 $comment=$crow['comment'];
									//die("successss");
								}
								
								 ?>
                                
                              <form action="Edit_upoad_attachment.php" method="POST" enctype="multipart/form-data">
                                 <h2 class="text-center">Edit Post</h2> 
                                 <div class="form-group">
                                    <label for="comment">Comment</label>
									<input type="hidden" name="comment_id" value="<?php echo $_GET['comment_id']; ?>">
                                    <textarea class="form-control" rows="3" id="views_comment" maxlength="300" placeholder="Post your views here...." name="comment" cols="60"  value="<?php echo $comment; ?>" onkeyup="charcountupdate(this.value)" required   ><?php echo $comment; ?></textarea><span id="charcount"></span>
                                 </div>
                                 <div class="form-group row col-md-12">
                                    <?php  
                                       //$comment_id=$_GET['comment_id'];
                                       $type=3;
                                       $obj=new _spprofilefeature;
                                       
                                       $res2=$obj->readimageforupdate($comment_id,$type);
                                                             if($res2!=false){
                                                               while($row2=mysqli_fetch_assoc($res2)){
                                       
                                      // print_r($row2);
                                      // die("OOOOOOOOOOOOOOOO");
                                       if($row2['attachmentfiles']!=''){
                                       ?> 
                                    <div id="myModal22" class="modal">
                                       <span class="close">&times;</span>
                                       <div class="card">
                                          <img class="modal-content center" id="img01" style="height:300px; width:50%;">
                                          <div id="caption"></div>
                                       </div>
                                    </div>
                                    <div class="col-md-3" id="delimg<?php echo $row2['id']; ?>"> 
                                       <span data-toggle="modal" data-target="#myModal22">
                                       <img id="image<?php echo $id; ?>"  style="height:200px; width:100%;" src="<?php echo $BaseUrl;?>/news/news_upload/<?php echo $row2['attachmentfiles'] ;?>" alt="Card image">
                                       </span>
                                    <a class="btn btn-danger form-control" onclick="DelPostImg(<?php echo $row2['id'];?>)" >Remove</a>
                                    </div>
									   <?php }}}?>  
                                 </div>
								 
								 
								 
								 
                                 <div class="col-md-6">
								 <label for="comment" style="font-size: 25px;">Upload Images</label>
								 <span class="red"></span><span class="red" id="image_error"></span>
                                    <input type="file" style="margin-bottom:30px;"  class="form-control" id="addimages22" name="newsPic[]" accept="image/*"   multiple="multiple">
                                    <span class="red"></span><span class="red" id="image_error"></span>
                                 </div>
								 
								 
								 
								 
								 
								 
								 
								   <div class="form-group row col-md-12">
                                    <?php  
                                       //$comment_id=$_GET['comment_id'];
                                       $type=2;
                                     
                                       
                                       $res2=$obj->readimageforupdate($comment_id,$type);
                                                             if($res2!=false){
                                                               while($row2=mysqli_fetch_assoc($res2)){
                                       
                                       //print_r($row2);
                                       //die("OOOOOOOOOOOOOOOO");
                                        if($row2['attachmentfiles']!=''){
                                       ?> 
                                    
                                    <div class="col-md-3" id="delVid<?php echo $row2['id'];?>">
									
									
									   
									      <video style="height:200px; width:100%;" controls>
                                          <source src="<?php echo $BaseUrl;?>/news/news_upload/<?php echo $row2['attachmentfiles'] ;?>" type="video/mp4">
                                          <source src="<?php echo $BaseUrl;?>/news/news_upload/<?php echo $row2['attachmentfiles'] ;?>" type="video/ogg">
                                       </video>
									   
									   
									   
                                       <a class="btn btn-danger form-control" onclick="DelPostImg(<?php echo $row2['id'];?>)" >Remove</a>
                                    </div>
															   <?php }}}?>
                                 </div>
								 
								 
								 
								 
                                 <div class="col-md-6">
								 <label for="comment" style="font-size: 25px;">Upload Videos</label>
								 <span class="red"></span><span class="red" id="Videos_error"></span>
                                    <input type="file" style="margin-bottom:30px;" id="addvideo2" class="form-control"   name="newsvideo[]"  accept="video/*,.mp3,.mpa,.wav,.wma,.midi,.mid" multiple="multiple">
                                 </div>
								 
								 
								 
								 <div class="form-group row col-md-12">
                                    <?php  
                                       //$comment_id=$_GET['comment_id'];
                                       $type=1;
                                       $obj=new _spprofilefeature;
                                       
                                       $res2=$obj->readimageforupdate($comment_id,$type);
                                                             if($res2!=false){
                                                               while($row2=mysqli_fetch_assoc($res2)){
                                       
                                       //print_r($row2);
                                       //die("OOOOOOOOOOOOOOOO");
                                        if($row2['attachmentfiles']!=''){
                                       ?> 
                                     
                                    <div class="col-md-3" id="deldoc<?php echo $row2['id'];?>"> 
									
									
									   
									      <span>DOCUMENT <a href="<?php echo $BaseUrl;?>/news/news_upload/<?php echo $row2['attachmentfiles'] ;?>" download="<?php echo $row2['attachmentfiles'] ;?>"><?php echo $row2['attachmentfiles'] ;?></a></span>
									   
									   
									   
                                       <a class="btn btn-danger form-control" onclick="DelPostImg(<?php echo $row2['id'];?>)" >Remove</a>
                                    </div>
										<?php }}}?>
                                 </div>
								   
								 
								 
								 
                                 <div class="col-md-6">
								 <label for="comment" style="font-size: 25px;">Upload Documents</label>
								 <span class="red"></span><span class="red" id="file_error"></span>
                                    <input type="file" style="margin-bottom:30px;" id="document" class="form-control"  name="newsDocument[]" accept=".pdf,.doc,.xls,.docx " multiple="multiple">
                                 </div><br>
								 
								 
								 
								 
							<div class="col-md-12">                       
								                                       
								 <button type="submit" class=" btn  btn-success " style="float:right" id="spUpdatiSubmitnews" name="submit">UPDATE</button> 
								   
								  </div>
								 
                                
                               
                              </form>
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
	  
         var modal = document.getElementById("myModal22");
         
         // Get the image and insert it inside the modal - use its "alt" text as a caption
         var img = document.getElementById("image<?php echo $id; ?>");
         var modalImg = document.getElementById("img01");
         var captionText = document.getElementById("caption");
         img.onclick = function(){
           modal.style.display = "block";
           modalImg.src = this.src;
           captionText.innerHTML = this.alt;
		 }
			
			
		   
		   function DelPostImg(id){
			     
			    // alert(id); 
			   
			   $.ajax({
				   
					  url: "delete_news_attachment.php",
					  cache: false,
					  method:"POST",
					  data:{'id':id},
					  success: function(response){
					 $("#delimg"+id).html(""); 
					 $("#deldoc"+id).html("");
					 $("#delVid"+id).html("");
                         }
                       });
		 
           }    
		   
		   
		   
		   
		   
		   
		   
		   
		   </script>
<script>	  
document.getElementById("addimages22").addEventListener("change", function() {
  validateImageFile("addimages22", "image_error");
});
document.getElementById("addvideo2").addEventListener("change", function() {
  validateVideoFile("addvideo2", "Videos_error");
});
document.getElementById("document").addEventListener("change", function() {
  validateDocFile("document", "file_error");
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
