<?php
//error_reporting(E_ALL);
 //ini_set('display_errors', 'On');  


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

	$pageactive = 10;

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
			margin-top:-30px; 
		}
		
			i.fa.fa-archive.gray1 {
    color: gray;
}

i.fa.fa-archive.blue1 {
    color: blue;
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
					$mssg=$_GET['mssg'];
					
					if($mssg=='success'){
						
					?>
										
													
					<div class='alert alert-success' role='alert'>
						Your comment is sent successfully.								
                         
                      </div>

										
														
										
										
													<?php 
													}
													?>
						
							<div class="container-fluid">
								<div class="row">
									<div class="col-md-6 h style-1">
										<div class="newscontent">
											<h1>My Channel</h1>
											<?php
											$pr = new _spprofiles;	
											$result  = $pr->read($_SESSION["pid"]);
											if ($result != false){
												$sprows = mysqli_fetch_assoc($result);
												$country = $sprows["spProfilesCountry"];
												$spdate_created = $sprows["spdate_created"];
                                                        
                                          // print_r($sprows)	;
                                         //die("((((((((((((((((((((((((((((((");									   
												// echo $country;											
									        }
										// $co = new _country;
                                        // $result3 = $co->readCountryName($row['spProfilesCountry']);
                                        // if ($result3) {
                                        // 	$row3 = mysqli_fetch_assoc($result3);
                                        // 	echo $row3['country_title'];
                                        // }
											?>
										
													<?php 
													
													$n = new _news;
                                               
									if(isset($_POST['submit'])){
										$website_name=$_POST['website_name'];	
										$website_link=$_POST['website_link'];
											 $rss_status=2;
								$ress2=$n->readsw($website_link, $rss_status);
													//var_dump($ress2);
													//die("%%%%%%hhhhhhhhhhhhhh%%%%%");
													if($ress2!=false){
														//
													$roww3=mysqli_fetch_assoc($ress2);
													}
													//print_r($roww3);
													//die("------------------");
													if(!(empty($roww3)&&$rss_status=2)){ 
													
													 ?>
													
													<script>
														window.location.href = "<?php echo $BaseUrl; ?>/news/?msg=notaccess&website=<?php echo $website_link; ?>";
													</script>
														
													<?php
													
													
													
													}
													
													else{
													
													//print_r($roww3);
													//die('**********************************');
													
													$news_type=$_POST['news_type'];
													$country=$_POST['country'];
													$category=$_POST['category'];	
											
													$data=array(
													
													'website_name'=>$website_name,
													'website_link'=>$website_link,
													'news_type'=>$news_type,
													'country'=>$country,
													'category'=>$category,
													'uid'=>$_SESSION['uid'],
													'pid'=>$_SESSION['pid']
													);
													$n->add_channel($data); 
													}
															}
													
													if($_GET['page']==1){
														$start=0;
														
														
													
													}else{
													 $r=$_GET['page']-1;
													 $start= $r*10;
													}
													 
													 $limit=10;    
														  
														  
														   //$empty=" ";  
														  
                                                         $result =$n->readch('1',$_SESSION['pid'],$start,$limit);
 													  //print_r($result);
													 //die("DDDDDDDDDDDDDD"); 
														 if($result !=false){
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            //if($empty==5){
																//break;
															//}
							                                //$empty++;
							
                                                    ?>
													<input type="hidden" id="idspProfileCountry_" value="<?php echo $country; ?>">
													<?php
														
														$rss_feed = simplexml_load_file( $row['website_link']);
														
														$limit=0;
														
														if(!empty($rss_feed)) {
														//$i=0;
														foreach ($rss_feed->channel->item as $feed_item) {
															
															 $limit++;
												
												if($limit>2){
													break;
												}
															
															
															$link=trim($feed_item->link);
															
															
															
															
															  $ob2=new _spprofiles;
													
                                    					$pid2=$_SESSION['pid'];
                                    					$rr1=$ob2->readBANnewsdata($pid2);
														if($rr1!=false){
														 
                                    				$ban_news=array();
													
                                    							while($row9=mysqli_fetch_assoc($rr1))  {
																	
                                    								$ban_news[]=$row9['newsid'];
														} 
																
                                    						//	print_r($bookmark_news); die;
                                    			//print_r($rr1); 
                                    			
                                                      //die('=====vfffff55fds===');
                                    		if (in_array($link, $ban_news))
                                    		  {
                                    		continue;
                                    		  }  
														}
															
															
															
															
															
															
															
														//if($i>=10) break;
														$randomnum = rand(1111,9999);
														$randomnum1 = rand(10000000,99999999);
														
														?>
														<p style="display:none"><?php echo $abc = date("YmdHis", strtotime($feed_item->pubDate));?></p>
														<div class="panel opencomment" id="<?php echo $abc; ?>">
														<input type="hidden" id="newsid<?php echo $abc; ?>" name="newsid" value="<?php echo $link; ?>">
														
														
														<div class="panel-body">									
														<div><?php 
						$str=$link;
						if (str_contains($str, 'https://')) {
   $str1 = substr($str, 8);
     $variable = substr($str1, 0, strpos($str1, "/"));?>
						<?php
						?><a href="<?php echo $link ;?>" target=" ">
						<span>https://<?php echo $variable; ?></span></a>
						
						<span><?php echo $spdate_created; ?></span>
  <?php 
}
else{
	$str = substr($str, 0, strpos($str, "/"));
	 ?>
	 <a href="<?php echo $link ;?>"target=" ">
		<span><?php echo $str; ?></span></a>
	 <?php
	 
}
						?>	
																<h3 class="feed_title"><?php echo $row['website_name']; ?></h3>
														</div>
														<div class="npcontent">
															<!-- <div class="newsimg">
																<img src="img/uiface.jpg">
															</div> -->
															<div class="row">
															<div class="col-md-8" style="margin-top:0px;">
															<div class="newstext">
															
																
																<p>	<!-- <a href=" "> -->
																	
																	<h4><?php echo $feed_item->title; ?> </h4>
																<!-- </a> -->
															 
																	  <a href="<?php echo $link; ?>">Read more...</a> 
																	  
																	   <span style="border: 2px solid white;padding: 4px 8px; box-shadow: 0px 0px 4px gray;">
																	  
																	<a href="#"><i class="fa fa-share-alt readshares<?= $randomnum1; ?>" data-link="<?=  $link; ?>" title="Share"></i></a>
																	| <a href="#" class="bookmark<?php echo $abc; ?>" id="appendmark<?php echo $abc;?>">
																					
																					<?php
																							$obj=new _spprofiles;
																							 
																							
																							
																							$res=$obj->readbookmarknewsdata($link,$_SESSION['pid']) ;  
																							if($res!=false){
																							
																							echo '<i class="fa fa-bookmark" aria-hidden="true" title="Unbookmark" style="color:blue;cursor:pointer;"></i>';
																								
																							}
																								else{
																									echo '<i class="fa fa-bookmark" aria-hidden="true" title="Bookmark" style="color:gray;cursor:pointer;"></i>';
																								}	
																								
																								
																								?>	
																					
																					
																					</a> 
																	 
																	|<a href="javascript:void(0)"  onclick="MyCountrynewsBucket555(<?php echo $abc;?>)" id="appendbucket<?php echo $link; ?>" data-website-name="<?php echo $row['website_name'];?>" data-link="<?php echo $link; ?>" data-title="<?php echo $feed_item->title; ?>" data-publish-date="<?php echo $date; ?>" data-description="<?php //echo $description; ?>">

												   
												   
												   <?php  
													$obj=new _spprofiles;
													 
													
													
													$res2=$obj->readbucketnewsdata($link,$_SESSION['pid']) ;    
													//print_r($res); die('-------');
													if($res2!=false){
													echo '<i class="fa fa-archive blue1" aria-hidden="true" title="Unarchive" style="cursor:pointer;"></i>';
														
													}
														else{
															echo '<i class="fa fa-archive gray1" aria-hidden="true" title="Archive" style=" cursor:pointer;"></i>';
														}																				   
													?>	  
												   </a>
																	|  <a href="javascript:void(0)" onclick="NewsBan555(<?php echo $abc;?>)" id="AppendBan<?php echo $link; ?>" class="fa fa-ban" aria-hidden="true" title="Ban"></i> </a>
																</span>  
																</p>
															</div>
															</div>
															<div class="col-md-3"> 
															<p class="imgres">
																	<?php echo implode(' ', array_slice(explode(' ', $feed_item->description), 0, 7)); ?>
																	
																	
																	</p>  
															</div>
															<div class="col-md-1"></div>
															</div>
														</div>
														</div>
													</div>
													<script type="text/javascript"> 
													
													
			 function NewsBan555(id){
				 
				 Swal.fire('Banned Successfully').then((result) => {

                  if (result.isConfirmed) {
	                               
		var a =  $('#newsid'+id).val();
         			
         			////////////alert(a);
         			
         			   $.ajax({ 
         			  url: "banNews.php",
         			  type: "POST",
         			 cache:false,
         				data: {'id':a  
         				
         				
         				},
         			   success: function(data) {
         						//alert("hhhhhhhhhhhhh");									// location.reload();
         			//$('#banNews'+a).html("");	 
         					//alert("success");	  
         			}
         			
         		});

				  }
				 })
				
			 }      
													
												   
												   
												   
												   
												   
												   
												   function MyCountrynewsBucket555(id)
                                       	{
                                       		var a =  $('#newsid'+id).val();
											
											
											   $.ajax({
											  url: "bucketNews.php",
											  type: "POST",
											 cache:false,
												data: {'id':a  
												
												
												},
											   success: function(data) {
																							// location.reload();
											$('#appendbucket'+a).html(data);	 
													//alert("success");	  
											}
											
										});
                                       		
                                       		
                                       }  
														
											$('.blue1').on('click',function(){
								  this.className = "fa fa-archive gray";
								});	
								
									$('.gray1').on('click',function(){
										 this.className = "fa fa-archive blue";
								
								});				
									
												   
												   
												   
												   
												   
												   
												   
												   
													
													
													
													$(document).ready(function(){
																				$('.bookmark<?php echo $abc; ?>').click(function(){
																			     var aa = $('#newsid<?php echo $abc; ?>').val();
                                                                                        //alert(a);
																				 	$.ajax({
																				  url: "newsbookmark.php",
																				  type: "POST",
																				 cache:false,
																					data: {'id':aa
																					
																					
																					},
																				   success: function(data) {
																																// location.reload();
																				$('#appendmark<?php echo $abc; ?>').html(data);	 
																							  
																				}
																				
																			});
																			});
																			});
													
													
													
													
													
													
													
													
													
																				$(".readshares<?= $randomnum1; ?>").click(function(){
																					var linkid = $(".readshares<?= $randomnum1; ?>").attr("data-link");
																				    //var achor="<a>linkid</a>";
																					$("#views_comment").val(linkid);
																					});
																				</script>
														<?php		
														 $i++;	
														}
														}
														 }}
													?>											
												
											

										</div>
								
									<!-- newscontent col-md-6 end -->
							<?php if($result){?>
							<?php if($_GET['page'] != "1"){ ?>
							
							<a class="float-left btn btn-primary" href="<?php echo $BaseUrl.'/news/mychannels_news.php?page='.$_GET['page']-1;?>">Previous</a>
						<?php  } ?>
							
							
								<?php if($_GET['page'] == "1") { ?>
		<a class="float-right  btn btn-primary" style="margin-bottom: 10px;" href="<?php echo $BaseUrl.'/news/mychannels_news.php?page='.$_GET['page']+1;?>" >Next</a>
							<?php  } }?>		
								
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