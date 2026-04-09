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
		
		$f = new _spprofiles;
		//check profile is freelancer or not
		$chekIsEmployment = $f->readEmployment($_SESSION['pid']);
		if($chekIsEmployment !== false){
			$_SESSION['count'] = 0;
			$_SESSION['msg'] = "Employment Profile can not post any video. Please switch to any other profiles.";
		}
		
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
		
		$pageactive = 12;
		
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
								<?php
									$msg=$_GET['msg'];
									if($msg=='notaccess'){
									?>
									
									
									<div class='alert alert-danger' role='alert'>
										
										The Channel <b>(<?php echo $_GET['website']; ?>)</b> can not be added as it has been already blocked by the SharePage Admin
									</div>
									
									<?php
									}
									//$mssg=$_GET['mssg'];
									
									//if($mssg=='success'){
										
									?>
									
									
									<!--div class='alert alert-success' role='alert'>
										Your comment is sent successfully.								
										
									</div-->
									
									
									
									
									
									<?php 
									//}
								?>
								
								<div class="container-fluid">
									<div class="row">
										<div class="col-md-6 h style-1">
										<div class="newscontent">
 							<h3> About NewsViews </h3>
										</div>
										<!-- newscontent col-md-6 end -->
					 					<?php 
                                     $object=new _spprofilefeature;
									$result=$object->readaboutdata();
									if($result !=false){
										$row=mysqli_fetch_array($result);
									}
                                      $content  = $row['content'];
									  $title  = $row['title'];
										
										?>
										<div style="display:box;text-align:center;">
										<span class="h3"><?php echo $title; ?></span>
										
										<P><?php echo $content; ?></p>
										</div>
										</div>
										<div class="col-md-6 h style-1">
											<?php  include_once("rightSidebar.php"); ?>
											
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
				$(document).ready(function() {
					$('.opencomment').on('click',function(){
						var id = $(this).attr('id');
						// alert(id);
						$("#news_id").val(id);
						$.ajax({
							type: 'post',
							url: 'getcomments.php',
							dataType: 'json',
							data: {
								id: id
							},
							dataType: 'json',
							success: function(response){ 
								console.log(id);
								var html = '';					
								console.log(response);   
								$.each(response, function(k, v) {
									html +=	
									'<div class="media-heading">'+
									'<button class="btn btn-default btn-xs" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseExample"><span class="fa fa-minus" aria-hidden="true"></span></button> <span class="label"><img src="img/uiface.jpg" class="img-circle"></span> <a href="profile.html">'+v.userid+'</a> '+v.date+' <span class="pull-right">1 comment</span>'+
									'</div>'+
									'<div class="panel-collapse collapse in" id="collapseOne">'+
									'<div class="media-left">'+
									'<div class="vote-wrap">'+
									'<div class="save-post">'+
									'<a href="#"><span class="fa fa-star" aria-label="Save"></span></a></div>'+
									'<div class="vote up"><i class="fa fa-menu-up"></i></div><div class="vote inactive"><i class="fa fa-menu-down"></i></div></div></div>'+				
									'<div class="media-body">'+
									'<p>'+v.comment+'</p>'+
									'<div class="comment-meta">'+
									'<span><a href="#">delete</a></span>'+
									'<span><a href="#">report</a></span>'+
									'<span><a href="#">hide</a></span>'+
									'<span>'+
									'<a class="" role="button" data-toggle="collapse" href="#replyCommentT" aria-expanded="false" aria-controls="collapseExample">reply</a>'+
									'</span>'+
									'<div class="collapse" id="replyCommentT">'+
									'<form method="POST" id="NewsCommentForm" action="news_comment.php">'+
									'<div class="form-group">'+
									'<input type="hidden" id="news_id" name="news_id" value="v.news_id">'+
									'<label for="comment">Your Views</label> <label class="pull-right">Follower <strong>250</strong> | Follwoing <strong>12</strong></label>'+
									'<textarea name="comment" class="form-control" rows="3" value=""></textarea>'+
									'</div>'+
									'<button type="save" class="btn btn-default">Comment</button>'+
									'</form></div></div><div class="media-body" id="commentbody"></div></div></div></div></div>';
								});
								$("#commentbody").append(html);
							} 				
						});
					});
				});
				$(document).ready(function() {
					$('.bookmark').on('click',function(){
						var id = $(this).attr('id');
						console.log(id);
						$("#newsid").val(id);
						$.ajax({
							type: 'post',
							url: 'storebookmarknews.php',
							dataType: 'json',
							data: {
								id: id
							},
							dataType: 'json',
							success: function(response){ 
								console.log(id);
								var html = '';					
								console.log(response);   
								$.each(response, function(k, v) {
									
								});
								$("#commentbody").append(html);
							} 				
						});				
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