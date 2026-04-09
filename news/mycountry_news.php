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
   
   	$pageactive = 2;
   
   	$pr = new _spprofiles;	
   	$result  = $pr->read($_SESSION["pid"]);
   	if ($result != false){
   		$sprows = mysqli_fetch_assoc($result);
   		$firstCountry = $sprows["spProfilesCountry"];	
   	}
   
   	// $co = new _news;
   	// $result5 = $co->readRssCountry();
   	// if($result5 != false){
   	// 	$row6 = mysqli_fetch_assoc($result5);
   	// 	$firstCountry = $row6['country']; 
   
   	// }
   	
   	
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
	  
	  <style>
			i.fa.fa-bookmark.gray {
    color: gray;
}

i.fa.fa-bookmark.blue {
    color: blue;
}

i.fa.fa-archive.green{
    color: gray;
}

i.fa.fa-archive.red{
    color: blue;
}
	.imgres a img {
    width: 100px;
    height: 100px;
}
#rfq:hover {
    background-color: #4daba7!important;
}

.dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover {
   
    background-image: linear-gradient(to bottom,#568E8C 0,#568E8C 100%)!important;
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
                           <div class="col-md-6 h style-1">
                              <div class="newscontent">
                                 <h1> News</h1>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <select id="spUserCountryId" class="form-control country" name="country" onchange="fieldChange('country');">
                                            
                                             <?php
                                                $co = new _news;
                                                $result6 = $co->readcounty_news();
												//print_r($result6);
												//die("ddddddddddddddddd");  
                                                if($result6 != false){
                                                	
                                                	while ($row6 = mysqli_fetch_assoc($result6)) {
                                                		?>
                                             <option value="<?php echo $row6['country_id'];?>" 
                                                <?php if($row6['country_id'] == $firstCountry){ echo 'selected';} ?>>
                                                <?php echo $row6['country_title'];?>
                                             </option>
                                             <?php
                                                }
                                                }
                                                ?>
                                          </select>
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <select id="category" class="form-control category" name="category" onchange="fieldChange('category');">
                                             <?php
                                                // $n = new _news;
                                                // $result = $n->read('1'); 
                                                // while ($row = mysqli_fetch_assoc($result)) {
                                                // 	$category = $row["category"];	
                                                // }
                                                $n = new _news;
                                                $result3 = $n->readCategoryByCountry($firstCountry,'country_wise');
                                                if($result3 != false){
                                                	while ($row3 = mysqli_fetch_assoc($result3)) { 
                                                		?>
                                             <option value='<?php echo $row3['id'];?>'>
                                                <?php echo $row3['name'];?>
                                             </option>
                                             <?php
                                                }
                                                }
                                                ?>
                                          </select>
                                       </div>
                                    </div>
                                 </div>
                                 <!-- <div class="timelineload1 loader_back1" >
                                    <div class="loader timeline_loader"></div>
                                    </div> -->
                                 <div class="news-details">
                                    <?php 
                                       $n = new _news;
                                       $result = $n->readNewsByCountry($firstCountry,'country_wise'); 
                                       //print_r($result);die;
                                       //while ($row = mysqli_fetch_assoc($result)) {
                                       if($result !=false){ 	 
                                       $row = mysqli_fetch_all($result);
                                       //print_r($row);die;
                                       $num_rows=count($row);
                                       $pagination=$_GET['page']-1;
                                       
                                       //$rss_feed = simplexml_load_file( $row["website_link"]);
                                       $rss_feed = simplexml_load_file( $row[$pagination][4]);
                                       	// $ch = curl_init();
                                        //          $timeout = 5;
                                        //          curl_setopt($ch, CURLOPT_URL, "https://www.cbc.ca/cmlink/rss-canada");
                                        //          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                                        //          curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
                                        //          $rss_feed = curl_exec($ch);
                                        //          curl_close($ch);
                                       
                                        //          print_r($rss_feed);
                                       $limit=0;
									   
									   
                                       	if(!empty($rss_feed)) {
                                       foreach ($rss_feed->channel->item as $key => $feed_item) {
                                                      
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






													
															 
                                       			$randomnum = rand(1111,9999);
                                       			$randomnum1 = rand(10000000,99999999);
                                       			$publish_date = date("YmdHis", strtotime($feed_item->pubDate));
                                       			$date = date("Y-m-d H:i:s", strtotime($feed_item->pubDate));
												
												$abc = date("YmdHis", strtotime($feed_item->pubDate));
												
                                       			?>
                                    <div class="panel opencomment" id="<?php echo $publish_date; ?>">
									<input type="hidden" id="newsid<?php echo $abc; ?>" name="newsid" value="<?php echo $link; ?>">
                                       <div class="panel-body" id="panel-body">
                                          <div>
                                             <h3 class="feed_title"><?php echo $row['website_name']; ?></h3>
                                          </div>
                                          <div class="npcontent">
                                             <div class="newstext">
											 <div class="col-md-8" style="margin-top:0px;">
                                                
                                                <h4><?php echo $feed_item->title; ?> </h4>
                                                <p>
                                                   <?php 
                                                      // print_r($feed_item); 
                                                      $description = implode(' ', array_slice(explode(' ', $feed_item->description), 0, 14)); 
                                                      echo $description.'<br>';
                                                      ?> 
                                                   <a href="<?php echo $link; ?>">Read more...</a> 
												   
												    <span style="border: 2px solid white;padding: 4px 8px; box-shadow: 0px 0px 4px gray;">
												   
                                                   |<a href="#"><i class="fa fa-share-alt readshare<?= $randomnum1; ?>" data-link="<?=  $link; ?>" title="Share" data-id="<?php echo $row[$pagination][2]; ?>" ></i></a>
                                                   | <a  class="bookmark" onclick="MyCountryNews(<?php echo $abc;?>)" id="appendmark<?php echo $abc; ?>" data-website-name="<?php echo $row['website_name'];?>" data-link="<?php echo $link; ?>" data-title="<?php echo $feed_item->title; ?>" data-publish-date="<?php echo $date; ?>" data-description="<?php // echo $description; ?>">  
                                                                           <?php  
																							$obj=new _spprofiles;
																							 
																							
																							
																							$res=$obj->readbookmarknewsdata($link,$_SESSION['pid']) ;
																							//print_r($res); die('-------');
																							if($res!=false){
																							echo '<i class="fa fa-bookmark blue" aria-hidden="true" title="Unbookmark" style="cursor:pointer;"></i>';
																								
																							}
																								else{
																									echo '<i class="fa fa-bookmark gray" aria-hidden="true" title="Bookmark" style=" cursor:pointer;"></i>';
																								}																				   
																						?>	  
                                                   
                                                   | <a href="javascript:void(0)"  onclick="MyCountrynewsBucket555(<?php echo $abc;?>)" id="appendbucket<?php echo $link; ?>" data-website-name="<?php echo $row['website_name'];?>" data-link="<?php echo $link; ?>" data-title="<?php echo $feed_item->title; ?>" data-publish-date="<?php echo $date; ?>" data-description="<?php //echo $description; ?>">

												   
												   
												   <?php  
													$obj=new _spprofiles;
													 
													
													
													$res=$obj->readbucketnewsdata($link,$_SESSION['pid']) ;
													//print_r($res); die('-------');
													if($res!=false){
													 echo '<i class="fa fa-archive red" aria-hidden="true" title="UnBucket" style="cursor:pointer;"></i>';
														
													}
														else{
															echo '<i class="fa fa-archive green" aria-hidden="true" title="Bucket" style=" cursor:pointer;"></i>';
														}																				   
													?>	  
												   </a>
												   
                                                   | <a href="javascript:void(0)" onclick="NewsBan555(<?php echo $abc;?>)" id="AppendBan<?php echo $link; ?>" class="fa fa-ban" aria-hidden="true" title="Ban"></i> </a>
												   </span>
                                                </p>
                                             </div>
											 
											 <div class="col-md-3">
                                                   <p class="imgres"><?php echo implode(' ', array_slice(explode(' ', $feed_item->description), 0, 7)); ?>        </p>
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
         			
         			//alert(a);
         			
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
					
									
									
									
									
									
									
									
									
									
									///////bucket iconv
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
									   
									   
									
									///////////
                                       function MyCountryNews(id)
                                       	{
                                       		var a =  $('#newsid'+id).val();
	                                       $.ajax({
										  url: "newsbookmark.php",
										  type: "POST",
										 cache:false,
											data: {'id':a  
											
											
											},
										   success: function(data) {
																						// location.reload();
										$('#appendmark'+id).html(data);	 
													  
										}
										
									});
                                       		
                                       		
                                       }
                                       		
                                       		  $('.blue').on('click',function(){
								  this.className = "fa fa-bookmark gray";
								});	
								
									$('.gray').on('click',function(){
										 this.className = "fa fa-bookmark blue";
								
								});	
								
								
								$('.green').on('click',function(){
								  this.className = "fa fa-archive red";
								});	
								
									$('.red').on('click',function(){
										 this.className = "fa fa-archive green";  
								
								});	
                                       
                                       $(".readshare<?= $randomnum1; ?>").click(function(){
                                       var linkid = $(".readshare<?= $randomnum1; ?>").attr("data-link");
                                       
                                       var spids= $(".readshare<?= $randomnum1; ?>").attr("data-id");
                                       //var achor="<a>linkid</a>";
                                       $("#views_comment").val(linkid);
                                       //var xyz =alert(xyz);
                                       
                                       $("#spids").val(spids);
                                       });
                                       									
                                       
                                    </script>
                                    <?php		
                                       }
                                       }}
                                       //}
                                       
                                       //if($num_rows !=""){
                                       
                                       ?>	
                                 </div>
                              </div>
                              <?php if($_GET['page'] > "1"){ ?>
                              <a class="float-left btn btn-primary" href="<?php echo $BaseUrl.'/news/mycountry_news.php?page='.$_GET['page']-1;?>">Previous</a>
                              <?php  } ?>
                              <?php if($num_rows >= $_GET['page']){ ?>
                              <a class="float-right  btn btn-primary" style="margin-bottom: 10px;" href="<?php echo $BaseUrl.'/news/mycountry_news.php?page='.$_GET['page']+1;?>">Next</a>
                              <?php  } 	?>
                           </div>
                           <!-- newscontent col-md-6 end -->
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
         	$('.opencomment1').one('click',function(){
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
           						html +=	'<div class="media-heading">'+
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
         
         function fieldChange(type) {
         	var country = $( "#spUserCountryId option:selected" ).val();
         	var category = $( "#category option:selected" ).val();
         
         	$.ajax({
         			type: 'post',
         			url: 'getnewsbycountry.php',
         			dataType: 'json',
         			data: {country: country, category: category, type:type},
         			beforeSend: function() {
                               $(".timelineload1").css({ display: "block" });
                           },
         			success: function(response){ 
         				$(".timelineload1").css({ display: "none" });
         				if(response.category1 != ''){
         					$("#category").html(response.category1);
         				}
         				$(".news-details").html(response.news1);
         			}
         		});
         }
         
         // $(document).ready(function() {
         // 	$('.country1').on('change',function(){
         // 		var id = $(this).val();
         // 		// alert(id);
         // 		$.ajax({
         // 			type: 'post',
         // 			url: 'getnewsbycountry.php',
         // 			dataType: 'json',
         // 			data: {
         // 				id: id
         // 			},
         // 			dataType: 'json',
         // 			success: function(response){ 
         // 				// console.log(id);
         // 				var html = '';					
         // 				console.log(response);   
         // 				$.each(response, function(k, v) {
         // 					// console.log(v.title);
         // 					var title = v.title;
         // 					html +=	'<div class="panel opencomment" id="<?php echo $publish_date; ?>">'+
         // 					'<div class="panel-body" id="panel-body">'+
         // 					'<h3 class="feed_title">'+v.website_name+'</h3>'+
         // 					'</div>'+
         // 					'<div class="npcontent">'+
         // 					'<div class="newstext">'+
         // 					'<a href="'+v.website_link+'">'+
         // 					'<h4>'+title+' </h4>'+
         // 					'</a>'+
         // 					'<p>'+
         // 					'| <a href="#"><i class="fa fa-share-alt"></i></a>'+
         // 					'| <a href="#"><i class="fa fa-bookmark" aria-hidden="true"></i></a>'+
         // 					'| <a href="#"><i class="fa fa-plus" aria-hidden="true"></i></a>'+
         // 					'| <a href="#"><i class="fa fa-archive" aria-hidden="true"></i></a>'+
         // 					'| <a href="#"><i class="fa fa-ban" aria-hidden="true"></i></a>'+
         // 					'</p>'+
         // 					'</div>'+
         // 					'</div>'+
         // 					'</div>';
         // 				});	
         // 				$(".panel-body").append(html);		
         // 			}
         // 		});
         // 	});
         // });
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