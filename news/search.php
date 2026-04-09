<?php
/*error_reporting(E_ALL);
ini_set('display_errors', 'On');*/

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
		//echo $friend_id; exit;
		
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
										<div class="col-md-6 h style-1">
											
											
											<div class="col-md-12 ">
												<div class="panel with-nav-tabs panel-warning" style=" border-color: blue;">
													<div class="panel-heading1" style="padding: 0px!important;background-color: #a07ffe;
													         border-color: blue;">
														<ul class="nav nav-tabs">
															<!--li><a href="#All" style="color:black" data-toggle="tab">All</a></li>
															<li><a href="#News" style="color:black" data-toggle="tab">News</a></li-->
															<li><a href="#Views" style="color:black" data-toggle="tab">Views</a></li>
															<li class="active"><a href="#people" style="color:black" data-toggle="tab">People</a></li>
															<li><a href="#Comments" style="color:black" data-toggle="tab">Comments</a></li> 
														</ul>
													</div>
													<div class="panel-body">
														<div class="tab-content">
															
															
															<!---div class="tab-pane fade " id="All"> 
																
																
															</div>
															
															<div class="tab-pane fade " id="News">
																
																
															</div0--> 
															
															<div class="tab-pane fade " id="Views">
															
																<?php include('search_views.php'); ?>  
																
															</div>
															
															<div class="tab-pane fade " id="Comments">
															
																<?php include('search_comment.php'); ?>  
																
															</div>  
															
															

															<div class="tab-pane fade in active" id="people">
																
																
																
																<?php  
																	$pr = new _spprofiles;									
																	if(isset($_GET['btns']))
																	{
																		$records=$_GET['records'];
																		$spcmd=$pr->sprecordAllcount($records);
																		$allcount2=$spcmd->num_rows;
																		$spcmd=$pr->sprecord($records);
																		
																		if($spcmd != false){ 
																		while($spdata=mysqli_fetch_assoc($spcmd))
																		{
																			
																			?>
																			<div class="post1" id="post1_<?php echo $records; ?>">
																			<a href='<?php echo $BaseUrl;?>/news/profile.php?id=<?php echo $spdata['idspProfiles'];?>'>
																			<div class="form-group"style="border-color: red;border:2px solid blue;border-radius:5px;margin-top:10px;">
																				<tr style="border-color: red">
																					<?php if($spdata['spProfilePic']!=false){ ?>
																						<td><img  src="<?php echo $spdata['spProfilePic'] ?>"style="width:80px;height:80px;border-radius:50%;"></td><?php } else
																						{		  ?>
																						<td><img  src="https://www.freeiconspng.com/thumbs/no-image-icon/no-image-icon-15.png"style="width:80px;height:80px;border-radius:50%;"></td>
																					<?php } ?>
																					<td><?php echo $spdata['spProfileName'];?></td>
																					<?php 
																						$ids=$_SESSION['pid'];
																						$spids=$spdata['idspProfiles'];
																					 
																						$spres=$pr->spdataa($ids,$spdata['idspProfiles']);
																						$add=$_GET['records'];
																						
																						if($spids!=$ids){
																						 if($_SESSION['guet_yes'] != 'yes'){ 
																						 
																								 $obb=new _news;
						                                                               $blockres=$obb->read_profile_block($spids,$_SESSION['pid']); 				if(!$blockres){	
																							if($spres!=false){  
																						?>
																						<td><a href="operation1.php?whom=<?php echo $spdata['idspProfiles']; ?>&records=<?php echo $add;?>"><span style="font-size:20px;color:blue;margin-left:40px;float: right; padding: 23px;">Unfollow</span></a></td>
																						<?php  } else {
																						?>
																						<td><a href="operation.php?whom=<?php echo $spdata['idspProfiles']; ?>&records=<?php echo $add;?>"><span style="font-size:20px;color:blue;margin-left:40px;float: right; padding: 23px;">Follow</span></a></td>
																						<?php 
																						 }	}}	}	  ?>
																				</tr>
																			</div></div></a>
																			<?php 
																				
																				
																			}
	                                                               	}
																	else{  ?>
																	
																	
																	
																	
																
																<div class="alert alert-danger" role="alert">
																	Don't have any matching records!
																	</div>
																	
															<?php	
															
															        }} ?>     
																	
																	
																	
														<h1 class="load-more1" style="text-align: center;color: #5088ef; font-size: 24px;" >Load More</h1>
														<input type="hidden" id="row1" value="0">
														<input type="hidden" id="all1" value="<?php echo $allcount2; ?>">
														</div>
															
															
															
															
															<script>
	
	
	$(document).ready(function(){

    // Load more data
    $('.load-more1').click(function(){
		//alert("wwwwww");
        var row1 = Number($('#row1').val());
        var allcount1 = Number($('#all1').val());  
        row1 = row1 + 5;
		var record="<?php echo $records; ?>";
		var btn="<?php echo $_GET['btns']; ?>";

        if(row1 <= allcount1){
            $("#row1").val(row1);

            $.ajax({
                url: 'SearchLoadmore.php', 
                type: 'post',
                data: {row:row1,
						records:record,
						btns:btn
						},
                beforeSend:function(){
                    $(".load-more1").text("Loading...");
                },
                success: function(response){

                    // Setting little delay while displaying new content
                    setTimeout(function() {
                        // appending posts after last post with class="post"
                        $(".post1:last").after(response).show().fadeIn("slow");

                        var rowno1 = row1 + 5;

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
                $("#row1").val(1); 

                // Change the text and background
                $('.load-more1').text("Load more");
                $('.load-more1').css("background","#15a9ce"); 

            }, 2000);


        } 

    });
	
	

});
	
	
	</script>
															
															
															
															
															
															<div class="tab-pane fade " id="Comments">
																
																
															</div>
															
															
														</div>
													</div>
												</div>
											</div>
											
											
											<!--     <div class="btn-group nav nav-tabs"  role="group" aria-label="Basic example">
												<a href="#" class="btn btn-primary">All</a>
												<a href="#" class="btn btn-primary" >News</a>
												<a href="#" class="btn btn-primary">Views</a>
												<a href="#people" class="btn btn-primary" id="people">People</a>
												<a href="#" class="btn btn-primary">Comments</a>
												</div>
												<div id="people" class="row">		
												
											<!-- Column -->
											
											<!--  </div> -->
											<hr>
											<!-- article sec -->
											
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
				
				$("#people").click(function(){
					$(this).addClass("active");
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