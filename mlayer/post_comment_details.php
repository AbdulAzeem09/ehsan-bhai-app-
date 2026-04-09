
  <?php
   include('../univ/baseurl.php');
    session_start();
if(!isset($_SESSION['pid'])){ 
	$_SESSION['afterlogin']="store/";
	include_once ("../authentication/check.php");
	
}else{

       if(isset($_GET["postid"]) && $_GET["postid"] >0 && isset($_GET['catid']) && $_GET['catid'] == 1){

    }else if(isset($_GET["postid"]) && $_GET["postid"] >0){
            
    }
	

    function sp_autoloader($class) {
        include '../mlayer/' . $class . '.class.php';
    } 
    spl_autoload_register("sp_autoloader");

        $_GET['categoryID'] = 1;

    function timeago($time, $tense='ago') {
        date_default_timezone_set('UTC');
        // declaring periods as static function var for future use
        static $periods = array('Y', 'M', 'd', 'h', 'm', 's');
		
        // checking time format
        if(!(strtotime($time)>0)) {
            return trigger_error("Wrong time format: '$time'", E_USER_ERROR);
        }

        // getting diff between now and time
        $now  = new DateTime('now');
        $time = new DateTime($time);
        $diff = $now->diff($time)->format('%y %m %d %h %i %s');
        // combining diff with periods
        $diff = explode(' ', $diff);
        $diff = array_combine($periods, $diff);
        // filtering zero periods from diff
        $diff = array_filter($diff);
        // getting first period and value
        $period = key($diff);
        $value  = current($diff);

        // if input time was equal now, value will be 0, so checking it
        if(!$value) {
            $period = 'seconds';
            $value  = 0;
        } else {
            // converting days to weeks
            if($period=='day' && $value>=7) {
                $period = 'week';
                $value  = floor($value/7);
            }
            // adding 's' to period for human readability
            // if($value>1) {
            //     $period .= 's';
            // }
        }

        // returning timeago
        return "$value$period";
    }

?>
<?php
$p = new _postings;
	$result = $p->read($_GET["postid"]);

	if($result != false)
	{
		$row = mysqli_fetch_assoc($result);

      /*print_r($row);*/
		echo "<input type='hidden' id='postititle' value='".$row["spPostingtitle"]."' name='posttitle'>";
		
		//echo "<input type='hidden' id='shareprofile' value='".$row["spProfileName"]."' name='profilename'>";
		
		echo "<input type='hidden' id='sharedpost' value='".$_POST['idspPostings']."' name='postid'>";
	}
            $p2 = new _postings;
                    $postingDate = $p2->spPostingDate($row["spPostingDate"]);
                    
             $p3 = new _spprofiles;
					$rpvt = $p3->read($row["spProfiles_idspProfiles"]);
					//echo $p->ta->sql;
					if ($rpvt != false){
						$row = mysqli_fetch_assoc($rpvt);
						$name 		= $row["spProfileName"];
						$picture 	= $row['spProfilePic'];
					}

                                 ?>
<!doctype html>
<html>
    <head>

	<?php include('../component/f_links.php');?> 
	<style>
	div#sidebar {
    width: 215px !important;
	    padding-right: 0px;
} 

div#sidebar_right {
    padding-left: 0px;
}

	.nav ul {
	margin: 0;
	padding: 0;
	list-style: none;
	}
	
	.nav ul {
	display: inline-block;
	vertical-align: top;
	font-size: 14px; 
	}
	
	.nav ul li {
	position: relative;
	float: left;
	}
	
	.nav ul li + li {
	margin-left: 1px;
	}
	
	.nav ul li a {
	
	display: inline-block;
	text-decoration: none;
	padding: 0px 20px;
	-webkit-transition: all 0.1s ease-in;
	-o-transition: all 0.1s ease-in;
	transition: all 0.1s ease-in;
	}
	
	.nav ul li > ul {
	display: none;
	position: absolute;
	width: 150px;
	top: 100%;
	left: -1px;
	z-index: 5;
	text-align: left;
	}
	
	.nav ul li > ul li {
	float: none;
	margin: -2px;
	}
	
	.nav ul li > ul li a {
	display: block;
	
	}

	.nav ul li.active {
	pointer-events: none;
	}
	
	
	.navigation : hover {
			display: flex !important;

	}

	#Menu ul {display:none;}
#Menu { list-style:none;}
#Menu li:hover > ul {display:flex;    margin-top: -75px;}
#Menu li ul { margin:0; padding:0; position:absolute;z-index:5;/*padding-top:6px*/;}
#Menu li { float:left; margin-left:10px; }
#Menu li ul li { float:none; margin:0; display:inline;}
#Menu li ul li a {display:block; padding:6px 10px; background:#333; white-space:nowrap;}
#Menu li { display: list-item; text-align: -webkit-match-parent;}
#Menu ul { border:0; font-size:100%; font:inherit;vertical-align:baseline;}
	
	
	.nav ul {
	margin: 0;
	padding: 0;
	list-style: none;
	}
	
	.nav ul {
	display: inline-block;
	vertical-align: top;
	font-size: 14px; 
	}
	
	.nav ul li {
	position: relative;
	float: left;
	}
	
	.nav ul li + li {
	margin-left: 1px;
	}
	
	.nav ul li a {
	
	display: inline-block;
	text-decoration: none;
	padding: 0px 20px;
	-webkit-transition: all 0.1s ease-in;
	-o-transition: all 0.1s ease-in;
	transition: all 0.1s ease-in;
	}
	
	
	.nav ul li > ul {
	display: none;
	position: absolute;
	width: 150px;
	top: 100%;
	left: -1px;
	z-index: 5;
	text-align: left;
	}
	
	.nav ul li > ul li {
	float: none;
	margin: -2px;
	}
	
	.nav ul li > ul li a {
	display: flex;
	
	}


	
	.nav ul li.active {
	pointer-events: none;
	}
	span#car1 {
    margin-top: 10px;
}
	.navigation : hover {
			display: flex !important;

	}
	#span1{ 
		    color: #060505 !important;
			background-color:white !important;
			margin-top: -25px !important;
	}
	
	.reactionbtn_remove{
		    margin-top: -10px!important;
	}

    
	</style>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
       
        <!--This script for posting timeline data End-->
        
        <!--This script for sticky left and right sidebar STart-->
        <script type="text/javascript" src="<?php echo $BaseUrl;?>/assets/js/jquery.hc-sticky.min.js"></script>
        <script>
            function execute(settings) {
                $('#sidebar').hcSticky(settings);
            }
            // if page called directly
            jQuery(document).ready(function($){
                if (top === self) {
                    execute({
                        top: 20,
                        bottom: 50
                    });
                }
            });
            function execute_right(settings) {
                $('#sidebar_right').hcSticky(settings);
            }
             // if page called directly
            jQuery(document).ready(function($){
                if (top === self) {
                    execute_right({
                        top: 20,
                        bottom: 50
                    });
                }
            });
            
        </script>
        <!--This script for sticky left and right sidebar END-->
        <?php
        if($vis == 1){ ?>
            <script type="text/javascript">
                $(window).load(function(){        
                   $('#alertNotEmpProfile').modal('show');
                   //$('#alertNotEmpProfile').modal('toggle');
                   $('#alertNotEmpProfile').modal({
                      backdrop: 'static',
                      keyboard: false

                    });
                }); 
            </script>
            <?php
        }



        ?>

        <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/style.css">
            <link rel="stylesheet" type="text/css" href="<?php echo $BaseUrl;?>/assets/css/design.css">

    </head>
    <body class="bg_gray" onload="pageOnload('<?php
        if (isset($_GET["globaltimeline"]) == 7){
            echo "timelines";
        }elseif (isset($_GET["myfavorite"]) == 3){
            echo "favorite";
        }elseif (isset($_GET["friendstore"]) == 4){
            echo "store";
        }elseif (isset($_GET["groupstore"]) == 5){
            echo "store";
        }elseif (isset($_GET["mystore"]) == 6){
            echo "store";
        }elseif (isset($_GET["mytimeline"]) == 2){
            echo "mytimeline";
        }else{
            echo "store";
        }
        ?>')" >
  <?php
        
        include_once("../header.php");
        ?>

  <section class="landing_page">
            <div class="container pubpost">

                <div id="sidebar" class="col-md-2">
                    <?php include('../component/left-landing.php');?>
                </div>


<?php
                        
                          $timeline = new _postings;


                          $result11 = $timeline->singletimelines($_GET["postid"]);

                          //echo $timeline->ta->sql;
                          if($result11 != false){

                            while($rows = mysqli_fetch_assoc($result11))
                            {
                         ?>



                <!--------post content------>
                <div class="col-md-6" >
                           <!--Testing video content div-->
                                <div class="tab-content no-radius otherTimleineBody social">
                                    <!--Timeline-->
            <div role="tabpanel" class="tab-pane active" id="srchtimeline" style="padding-left: 10px;padding-right: 10px;">
                                    <div class="row ">
                                        <div class="col-md-12">
                                    
                                     <div class="post_timeline post_timeline_all_post searchable deldiv_2203">
       
                                 <div class="row ">
                                        <div class="col-md-6">
                                           <div class="left_profile_timeline">
                   <img id="profilepicture" alt="Profile Pic" style="border-radius:30px" class="img-responsive" src="<?php echo ((isset($picture))?" ". ($picture)."":"../assets/images/icon/blank-img.png");?>">
                                                    </div>
                            <div class="title_profile">

                                <h4><?php echo $name; ?> </h4>
                                <?php
                                $p2 = new _postings;
                                $postingDate = $p2->spPostingDate($row["spPostingDate"]); ?>
                               

                                <h5><!-- <?php echo $postingDate; ?> -->1 day ago  <i class="fa fa-globe"></i></h5>
                            </div>      
                                         </div>
                     <div class="col-md-6">

                         <?php

                           /* print_r($_SESSION['pid']);
                            print_r($row);*/

                          if($_SESSION['pid'] == $row['spProfile_idspProfile']){ ?>

                        <div class="dropdown pull-right right_profile_timeline" >
                            <button class="btn dropdown-toggle" onclick="myFunction()" type="button" data-toggle="dropdown" ><i class="fa fa-ellipsis-h" aria-hidden="true"></i></button>
                            <ul  class="dropdown-menu" id="myDropdown">
                                <?php
								if(isset($_SESSION['pid'])){
									$sp = new _savepost;

									$result2 = $sp->savepost($row['idspPostings'], $_SESSION['pid'], $_SESSION['uid']);
									if($result2){
										if($result2->num_rows > 0){ ?>
											<li><a href="<?php echo $BaseUrl.'/publicpost/saveP2Post.php?unsave='.$rows['idspPostings'];?>"><i class="fa fa-save"></i> Unsave Post</a></li> <?php
										}else{ ?>
											<li><a href="<?php echo $BaseUrl.'/publicpost/saveP2Post.php?postid='.$rows['idspPostings'];?>"><i class="fa fa-save"></i> Save Post</a></li> <?php
										}
									}else{?>
										<li><a href="<?php echo $BaseUrl.'/publicpost/saveP2Post.php?postid='.$rows['idspPostings'];?>"><i class="fa fa-save"></i> Save Post</a></li> <?php
									}
								}else{?>
									<li><a href="<?php echo '/publicpost/saveP2Post.php?postid='.$rows['idspPostings'];?>"><i class="fa fa-floppy-o"></i> Save Post</a></li> <?php
								}
                                if($_SESSION['pid'] == $rows['idspProfiles']){ ?>
                                    <li><a href="javascript:void(0)" data-toggle="modal" data-target="#myPostEdit" data-postid="<?php echo $rows['idspPostings']; ?>" class="sendPostidEdit"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit Post</a></li> <?php
                                }
                                ?>
                                
                                
                                <!-- <li><a href="#"><i class="fa fa-map-o"></i> Add Location</a></li> -->
                                <?php
                                //Delete timeline by poster//
								if(isset($_SESSION['uid'])){
									$pr = new _spprofiles;
									$pres = $pr->checkprofile($_SESSION['uid'], $rows['idspProfiles']);
									if ($pres != false) {
                                        ?>
                                        <li><a href="javascript:void(0);" class="postdel" data-id="<?php echo $rows['idspPostings']?>" data-pid="<?php ?>" >
                        <i class="fa fa-trash-o" style="color:red"></i>  Delete Post</a></li>
                                        <?php
										//echo "<li><a href='../post-ad/deletePost.php?postid=".$rows['idspPostings']."&flag=1' ><i class='fa fa-trash'></i> Delete Post</a></li>";
										//echo "<li><a href='#'><i class='fa fa-trash'></i> Delete Post</a></li>";
									}
								}else{
									echo "<li><a href='../post-ad/deletePost.php?postid=".$rows['idspPostings']."&flag=1' ><i class='fa fa-trash'></i> Delete Post</a></li>";
								}
                                //hide post from timeline
                                if($_SESSION['pid'] != $rows['idspProfiles']){
                                    echo "<li><a href='".$BaseUrl."/post-ad/hidePost.php?postid=".$rows['idspPostings']."&flag=1' ><i class='fa fa-minus-square-o'></i> Hide Post</a></li>";   
                                }
                                ?>
                                <!-- <li><a href="#"><i class="fa fa-bell-o"></i> Notification On</a></li> -->

                            </ul>

                        </div>

                     <?php } ?>

                    </div>
                           

                      <div class="col-md-12 ">

                                  <?php
                                      if($rows["spPostingNotes"] != ''){


                                echo "<div style='color:#333;padding-top:20px;word-wrap: break-word; width: 480px'>".$rows["spPostingNotes"]."</div>";
                              }

                              $pic = new _postingpic;
                              $res = $pic->read($rows['idspPostings']);
                              if($res!= false){
                                $rp = mysqli_fetch_assoc($res);
                                $pic = $rp['spPostingPic'];
                                echo "<div class='row no-margin text-center'>";
                                echo "<img alt='Posting Pic' src=' ".($pic)."' style='max-height:300px;' class='postpic img-thumbnail img-responsive center-block bradius-15' >" ;
                                echo "</div>";
                              }


                              $media = new _postingalbum;
                                          $result2 = $media->read($rows['idspPostings']);
                                          if ($result2 != false) 
                                     
                                  {

                             $r = mysqli_fetch_assoc($result2);
                             $picture = $r['spPostingMedia'];
                                $sppostingmediaTitle = $r['sppostingmediaTitle'];
                                $sppostingmediaExt = $r['sppostingmediaExt'];
                                if($sppostingmediaExt == 'mp3'){ ?>
                                  <div style='margin-left:15px;margin-right:15px;'>
                                    <audio controls>
                                      <source src="<?php echo $BaseUrl.'/upload/'.$sppostingmediaTitle;?>" type="audio/<?php echo $sppostingmediaExt;?>">
                                      Your browser does not support the audio element.
                                    </audio>
                                  </div>
                                  <?php
                                }else if($sppostingmediaExt == 'mp4'){ ?>
       
                        <div style='margin-left:15px;margin-right:15px;'>
									<video  style='max-height:300px;width: 100%;border-radius: 17px;' controls>
										<source src='<?php echo $sppostingmediaTitle;?>' type="video/<?php echo $sppostingmediaExt;?>">
									</video>
								</div>
                                  <?php
                                }else if($sppostingmediaExt == 'pdf' || $sppostingmediaExt == 'xls' || $sppostingmediaExt == 'doc' || $sppostingmediaExt == 'docx'){
                                  ?>

                                  <div class="row timelinefile">
                                    <div class="col-md-offset-1 col-md-1 no-padding">
                                      <img src="<?php echo $BaseUrl.'/assets/images/pdf.png'?>" alt="pdf" class="img-responsive" />
                                    </div>
                                    <div class="col-md-10">
                                      <h3><?php echo $sppostingmediaTitle;?></h3>
                                      <small><?php echo $sppostingmediaExt;?></small>
                                      <a href="<?php echo $sppostingmediaTitle;?>" target="_blank">Preview</a>
                                    </div>
                                  </div>


                                  <?php
                                }
                                          } 
                                          
                                       
                                       ?>
                   

                             
                       </div>
					   
					   <div>
					<?php  							$c = new _comment;  ?>

							<div id="comments_<?php echo $rows['idspPostings']; ?>">
							
					
								<div class="timelinecmnt_<?php echo $rows['idspPostings']; ?>">
									<!--
										<div class="row">
                                        <div class="col-md-1">
										<?php
											if (isset($picture))   
											echo "<img alt='profilepic'  class='' src='" . ($picture) . "' >";
											else
											echo "<img alt='profilepic'  class='' src='../assets/images/blank-img/default-profile.png' >";
										?>
                                        </div>
                                        <div class="col-md-11">
										<div class="right_coment_detail">
										<a href="#"><?php echo $profilename;?></a>
										<p><?php echo $comment; ?></p>
										</div>
                                        </div>
									</div>-->
									
									<div class="row view_more_cmnt_<?php echo $rows['idspPostings']; ?> comment_align">
                                 
							       <div class="col-md-12">
								   <a class="rcount"  id='rcount' data-postidr="<?= $rows['idspPostings']; ?>" data-toggle="modal" data-target="#myModal">
										<?php  $read_like_cont = $c->read_like($rows['idspPostings']); 
									//	print_r($read_like_cont);  die('-----------');
										if($read_like_cont->num_rows==""){
											echo " 0 Reactions ";
										}
										else {
											echo $read_like_cont->num_rows. " Reactions";  
										}
										
										?> </a>
										</div>

					
						
				
										
									</div>
								</div>
						
								
								<?php //} ?>
					</div>
					
								</div>


                   <!---------footer -------------------->
                     <div class="col-md-12">
                        <div class="post_footer">
                           <ul>
						   <?php
											 $rection =  "&#128077;&#127995;";
											 $like = "0";
                           $pl = new _postlike;
                                 $r = $pl->likeread($rows['idspPostings'], $_SESSION['pid'], $_SESSION['uid']);
								$react_count =  $r->num_rows;
								   $count = 0;
								 if($r->num_rows == 0){
									 $rection =  "&#128077;&#127995;";
									 $count_react = 0;
								 }
								 else {
									  $count_react = 1;
								// if($react_coun > 0) {
							//echo "ppppppppppppp";
                               $row22 = mysqli_fetch_assoc($r);
							   $rid = $row22['Reaction_id'];
							   if($rid == 1){
								   $rection = "&#128525";
								   } 
								   
						      if($rid == 2){
								   $rection = "&#128512;";
								   }
					          if($rid == 3){
								   $rection = "&#128546;";
								   }
							  if($rid == 4){
								   $rection = "&#129315;";
								   }
						     if($rid == 5){
								   $rection = "&#128563;";
								   }
						     if($rid == 6){
								   $rection = "&#128545;";
								   }
								   
								      if($rid == 7){
								   $rection = "&#128077"; 
								   }
								}
								// }
							/*	 
								 else {
									 $rection =  "&#128077;&#127995;";
								 } */
									?>
                                <li> 
                                      <nav class="nav">
									<ul id="Menu">
										<input type="hidden" id="usid" value="<?= $_SESSION['uid'];?>">
										<input type="hidden" id="prid" value="<?= $_SESSION['pid'];?>">
										<li>
										
											<?php if($r->num_rows ==''){ ?>
											
											
										<div id="new_data_<?php echo $rows['idspPostings'];  ?>">	<a id="currentreaction_<?php echo $rows['idspPostings'];  ?>" href="javascript:void(0);"  class="reactionbtn" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="7" style="font-size: 25px;margin-top: -9px;" ><?php  echo $rection; ?></a>	</div>	
										
										
										<?php  } ?>
										
										
										<?php if($r->num_rows=='1'){ ?>
												<div id="new_data_<?php echo $rows['idspPostings'];  ?>">		<a id="currentreaction_<?php echo $rows['idspPostings'];  ?>" href="javascript:void(0);"  class="reactionbtn_remove" data-postid="<?= $rows['idspPostings']; ?>" style="font-size: 25px;margin-top: -20px;" ><?php  echo $rection; ?></a>	</div>	
										<?php  } ?>
										
										
										
											<ul class="" style="">
											
											<li  style="font-size: 25px;margin-right:-4px;cursor: pointer;" value="7" class="reactionbtn" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="7">&#128077;</li>&nbsp;&nbsp;&nbsp;&nbsp;
 
											<li  style="font-size: 25px;margin-right:-4px;cursor: pointer;" value="1" class="reactionbtn" data-postid="<?= $rows['idspPostings']; ?>" data-reaction="1">&#128525;</li>&nbsp;&nbsp;&nbsp;&nbsp;
												<li  style="font-size: 25px;margin-right:-4px;cursor: pointer;"  value="2" class="reactionbtn"  data-postid="<?= $rows['idspPostings']; ?>" data-reaction="2">&#128512;</li>&nbsp;&nbsp;&nbsp;&nbsp;
												<li  style="font-size: 25px;margin-right:-4px;cursor: pointer;"  value="3" class="reactionbtn"  data-postid="<?= $rows['idspPostings']; ?>" data-reaction="3">&#128546;</li>&nbsp;&nbsp;&nbsp;&nbsp;
												<li  style="font-size: 25px;margin-right:-4px;cursor: pointer;"  value="4" class="reactionbtn"  data-postid="<?= $rows['idspPostings']; ?>" data-reaction="4">&#129315;</li>&nbsp;&nbsp;&nbsp;&nbsp;
												<li  style="font-size: 25px;margin-right:-4px;cursor: pointer;"  value="5" class="reactionbtn"  data-postid="<?= $rows['idspPostings']; ?>" data-reaction="5">&#128563;</li>&nbsp;&nbsp;&nbsp;&nbsp;
												<li  style="font-size: 25px;margin-right:-4px;cursor: pointer;"  value="6" class="reactionbtn"  data-postid="<?= $rows['idspPostings']; ?>" data-reaction="6">&#128545;</li>
											</ul>
										</li>
										
									</ul>
								</nav>
                                </li>

                                <li><i class="fa fa-comment" aria-hidden="true"></i> <span class='font_regular'>Comment</span></li>
                                <li>
                                    <?php
                                    $pl = new _favorites;
                                    $re = $pl->read($rows['idspPostings']);
									//print_r($re);
									//die('=====');
                                    if ($re != false) {
                                        $i = 0;
                                        while ($rw = mysqli_fetch_assoc($re)) {
											$pid1=$rw['spProfiles_idspProfiles'];
											$post_id1=$rw['spPostings_idspPostings'];
											
											
                                            if ($rw['spUserid'] == $_SESSION['uid'] && $rw['spProfiles_idspProfiles'] ==$_SESSION['pid1'] && =$rw['spPostings_idspPostings'] ==$_SESSION['post_id1']   ) {
                                                echo "<span id='spFavouritePost' data-toggle='tooltip' data-placement='bottom' title='Unfavourite' class='icon-favorites fa fa-heart removefavorites' data-postid='" . $rows['idspPostings'] . "'><span class='font_regular'> Unfavourite</span></span>";
                                                $i++;
                                            }
                                        }
                                        if ($i == 0) {
                                            echo "<span id='spFavouritePost' data-toggle='tooltip' data-placement='bottom' title='Favourite' class='icon-favorites fa fa-heart-o sp-favorites' data-postid='" . $rows['idspPostings'] . "'><span class='font_regular'> </span></span>";
                                        }
                                    } else {

                                        echo "<span id='spFavouritePost' data-toggle='tooltip' data-placement='bottom' title='Favourite' class='icon-favorites fa fa-heart-o sp-favorites' data-postid='" . $rows['idspPostings'] . "'><span class='font_regular'></span></span>";
                                    }?>
                                </li>
                                <li><a href="javascript:void(0);"  data-toggle='modal' data-target='#myshare'><span class='sp-share' data-postid='<?php echo $rows['idspPostings'];?>' src='<?php echo ($pict); ?>'><i class="fa fa-share-alt"></i> <span class='font_regular'>Share</span></span></a></li>
                            </ul>
							<?php $date = date('Y-m-d H:i:s');  ?>
							<input type = "hidden" name = "" value="<?php echo $date; ?>">
                        </div>
                    </div>
                    <div class="col-md-12 no-padding">
                      <div class="commt_box timeline_comm_box commentbox_<?php echo $rows['idspPostings']; ?>">
                          <?php
                              if(isset($_GET['idspprofile'])){
                                  $idspprofile = $_GET['idspprofile'];
                              }else{
                                  $idspprofile = $_SESSION['pid'];
                              }
                              $callFromPostDetailPage = true;
                              include("commentform.php");
                          ?>
                      </div>
                    </div>
               <?php
                        
                          $comment = new _comment;
						  $recomment = new _comment_reply;
                          $commentLikes = new _commentlike;

                          $result_c = $comment->read($_GET["postid"]);
/*                            $result = $c->read($_POST['idspPostings']);
*/
                          if($result_c != false){
                            while($row = mysqli_fetch_assoc($result_c)){
                               $profilename = $row["spProfileName"];
                               $comment = $row["comment"];
                               $picture = $row["spProfilePic"];
                                $date = $row["commentdate"];
								//echo $date;die;
                                $cid=$row["idComment"];
								$pro_ids = $row["spProfiles_idspProfiles"];
								$href_profile = $BaseUrl."/friends/?profileid=".$pro_ids;
								
								$result_rc = $recomment->read($row["idComment"]);
								$commentTotalLikes =  $commentLikes->getTotalLikes($cid);
                                $isCommentLikedByUser = $commentLikes->isCommentLikedByUser($cid,$_SESSION['pid']);

                         ?>
                          <!-- Modal for edit any post -->
    <div id="mycmtEdit<?php echo $cid;  ?>" class="modal fade " role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content  bradius-15">
                <form method="post" action="editcomment.php"  id="sp-form-post-edit" class="editPostTimeline" enctype="multipart/form-data" >
                    <div class="modal-header">
                        
                        <h4 class="modal-title">Edit Comment</h4>
                  <button type="button" class="close " data-dismiss="modal" style="margin-right: 5px; margin-top: -25px !important;"> <span aria-hidden="true" id="span1">&times;</span>
                   </button> 
                    </div>
                     
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="posteditloader">
                                    <div class="loader"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                
                                <div class="">
                  <input type="text"  class="form-control" name="comment" value="<?php echo $row["comment"]; ?>">

                   <input name="idComment" id="pid"  type="hidden" value="<?php echo $row["idComment"]?>">
                    <input name="postid" id="pid"  type="hidden" value="<?php echo $_GET["postid"] ?>">
                    

                   

                                </div>
                                
                            </div>
                        </div>
                    </div>  
                     
                    <div class="modal-footer">
                        <button id="comment"  onclick='editcomment(<?php echo $row["idComment"]; ?>)'  
                          class="btn btnPosting pull-right editing db_btn db_primarybtn"  >Save</button>
                          <button type="button" class="btn btnPosting pull-right db_btn db_orangebtn" data-dismiss="modal" style="margin-right: 5px;">Cancel</button>
                       
 
                    </div>             
                </form>
            </div>
        </div>
    </div>
	
	<div id="replycomment<?php echo $cid;  ?>" class="modal fade " role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content  bradius-15">
                <form id="recomments<?php echo $cid;  ?>" name="recomments<?php echo $cid;  ?>" method="post" action="reply_comment.php" >
                    <div class="modal-header">
                        
                        <h4 class="modal-title">Reply Comment</h4>
                  <button type="button" class="close " data-dismiss="modal" style="margin-right: 5px;"> <span aria-hidden="true">&times;</span>
                   </button> 
                    </div>
                     
                    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="posteditloader">
                                    <div class="loader"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                
                                <div class="">
                  <input type="text"  class="form-control" name="replycomment" required value="">

                   <input name="idComment" id="idComment"  type="hidden" value="<?php echo $row["idComment"]?>">
                    <input name="spPostings_idspPostings" id="spPostings_idspPostings"  type="hidden" value="<?php echo $_GET["postid"] ?>">
                     <input name="spProfiles_idspProfiles" id="spProfiles_idspProfiles"  type="hidden" value="<?php echo $_SESSION["pid"]; ?>">
					<input name="userid" id="userid"  type="hidden" value="<?php echo $_SESSION["uid"]; ?>">
                   

                                </div>
                                
                            </div>
                        </div>
                    </div>  
                     
                    <div class="modal-footer">
                        <button id="recomment" type="submit" class="btn btnPosting pull-right editing db_btn db_primarybtn"  >Save</button>
                          <button type="button" class="btn btnPosting pull-right db_btn db_orangebtn" data-dismiss="modal" style="margin-right: 5px;">Cancel</button>
                    </div>             
                </form>
            </div>
        </div>
    </div>

   <div>   
    <div class="cmtdiv<?php echo $cid;  ?>" style="padding: 0px 15px 0px 0px;">
        <div class="col-md-12">
            <div class="col-md-8">
            <?php
            if(isset($picture))
                echo "<div  class='commentoverflow'><a href='".$href_profile."'><img alt='profilepic'  class='img-circle' src=' ".($picture)."' style='width: 40px; height: 40px;'><span style='color:#032350; font-size:15px;padding-left: 8px;'>" .ucfirst($profilename)."</span></a></div>";
            else
                echo "<div  class='commentoverflow'><a href='".$href_profile."'><img alt='profilepic'  class='img-circle' src='../assets/images/icon/blank-img.png' style='width: 40px; height: 40px;'>
            <span  style='color:#032350; font-size:15px;padding-left: 8px;'>" .ucfirst($profilename)."</span></a></div>";
                ?>
            </div>
            <?php 
            if($_SESSION['pid'] == $row["spProfiles_idspProfiles"]) {
            ?>                         
                <div class="dropdown pull-right right_profile_timeline">
                    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-h" aria-hidden="true">
                        </i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><?php 
                           echo  "<button type='button' onclick='deletecomment(".$row['idComment'].")' class='deletecmt btn btn1 ".($_SESSION["uid"]==$row["userid"] ?"":"hidden")."' data-commentid='".$row["idComment"]."'><span class='fa fa-trash '>  </span> Delete Comment</button>";
                            ?>  
                        </li>     
                        <li class="cpading"> 
                            <?php 
                            echo "<button type='button'  data-toggle='modal' data-target='#mycmtEdit".$cid."' class='editcomment btn1 btn ".($_SESSION["uid"]==$row["userid"] ?"":"hidden")."' data-commentid='".$row["idComment"]."' data-commenttext='".$row["comment"]."'><span class='fa fa-pencil ' > </span> Edit Comment</button>"; ?>
                        </li>                              
                    </ul>
                </div>
                <?php } ?>
        </div>
        <div class="input-group" style="margin-top: 10px;    padding-bottom: 10px;" >
            <div class="input-group-addon commentprofile inputgroupadon border_none" style="border-radius:20px">
            </div>
            <div id="ip10">
                <div id="comment1">
                    <?php
                    echo "<div class='col-md-12 commentoverflow' style='margin-top:11px;'><span style='color:#1c1e21;' >".$comment."</span></div>";
                    ?>
                </div>
            </div>
            <div style="display: inline-flex;padding-left:55px; margin-top:7px; margin-bottom:10px">
                <!--- Start section for like of comment --->
                <?php if ($isCommentLikedByUser) { 
                        $likeClass = 'comment_like';
                        $postAction = 'remove_like';
                    } else {
                        $likeClass = 'comment_like';
                        $postAction = 'add_like';
                    } 
                ?>
                <span class="comment_like_area_<?php echo $cid;?>">
                <a href="javascript:void(0);" class="<?php echo $likeClass;?>" id="cmnt_like_<?php echo $cid;?>" data-postid="<?php echo $_GET['postid'];?>" data-commentId="<?php echo $cid;?>" data-userId="<?php echo $_SESSION['pid'];?>" data-postAction="<?php echo $postAction;?>"> 
				
				
                    <span id='spLikePost'>
                        <?php if ($isCommentLikedByUser) { ?>
                            <?php if($commentTotalLikes > 0) { ?>
                           <i class='icon-socialise fa fa-thumbs-up'></i>     Unlike (<?php echo $commentTotalLikes ?>)&nbsp;.&nbsp;
                            <?php } else {?>
                         <i class='icon-socialise fa fa-thumbs-up'></i>       Unlike&nbsp;.&nbsp;
                            <?php }
                        } else { ?> 
                            <?php if($commentTotalLikes > 0) { ?>
                           <i class='icon-socialise fa fa-thumbs-o-up'></i>     Like (<?php echo $commentTotalLikes ?>)&nbsp;&nbsp;
                            <?php } else {?>
                           <i class='icon-socialise fa fa-thumbs-o-up'></i>     Like&nbsp;&nbsp;
                            <?php } 
                        } ?>
                    </span>
                </a>
            </span>
            <!--- End section for like of comment --->
            <a href="javascript:void(0);" data-toggle='modal' data-target='#replycomment<?php echo $cid; ?>' id="rep_main_cmt">
                <div class=' commentoverflow'>
                    Reply
                </div>
            </a>
            <span style="color: #999;">
                &nbsp;
                <?php 
                    echo ($date);
                ?>
            </span>
        </div>
	       <?php
	       if($result_rc != false){						
	       while($rowss = mysqli_fetch_assoc($result_rc)) {
	    ?>
    	    <div class="repcmtdiv<?php echo $rowss["id"]; ?>" style="margin-bottom: 10px;">
	           <?php		
//print_r( $rowss);
			   
	           $profilename1 = $rowss["spProfileName"];
			   $comment1 = $rowss["replycomment"];
			   $picture1 = $rowss["spProfilePic"];
				$c_date1 = $rowss["comment_reply_date"];
				$cid1=$rowss["idComment"];
                $repid1=$rowss["id"];
				$pro_ids1 = $rowss["spProfiles_idspProfiles"];
				$href_profile1 = $BaseUrl."/friends/?profileid=".$pro_ids1;
               if($cid1 == $cid){
                if(isset($picture1)) { ?>
                    <div  style='padding-left:60px; padding-right:10px;margin-top:12px;' class='commentoverflow hhhhhhhhhh'><a href='<?php echo $href_profile1; ?> '><img alt='profilepic'  class='img-circle' src='<?php echo ($picture1);?>' style='width: 40px; height: 40px;'><span style='color:#032350; font-size:15px; padding-left: 8px;'><?php echo ucfirst($profilename1); ?></span></a>
					
					
					 <div class='dropdown pull-right right_profile_timeline'>
                    <button class='btn dropdown-toggle' type='button' data-toggle='dropdown'>
				
					</div>
					 <?php
            if($_SESSION['pid'] == $pro_ids1){ ?>
                        <div class="dropdown pull-right right_profile_timeline"1111111111>
                    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-h" aria-hidden="true">
                        </i>
                            </button>
                            <ul class="dropdown-menu">
                              <li>
							  <?php
                                echo "<button type='button' onclick='deletecommentreply(".$repid1.")' class='deletecmt btn btn1 ".($_SESSION["uid"]==$row["userid"] ?"":"hidden")."' data-commentid='".$repid1."'><span class='fa fa-trash '>  </span> Delete Comment</button>";?>

                            </li>


           <li class="cpading"> <?php echo "<button type='button'  data-toggle='modal' data-target='#mycmtEditrep".$repid1."'
class='editcommentrep btn1 btn ".($_SESSION["uid"]==$row["userid"] ?"":"hidden")."' data-commentid='".$repid1."' data-commenttext='".$repid1."'><span class='fa fa-pencil ' > </span> Edit Comment</button>"; ?>
</li>
                            </ul>
                  </div>
<?php } ?>
					
					</div>
              <?php  }
                else {
				//	echo $_SESSION['pid'] ;
				//	echo $pro_ids1;
					//die("=====");
                    echo "<div  style='padding-left:60px; padding-right:10px;margin-top:12px;' class='commentoverflow'><a href='".$href_profile1."'><img alt='profilepic'  class='img-circle' src='../assets/images/icon/blank-img.png' style='width: 40px; height: 40px;'>
                        <span  style='color:#032350; font-size:15px; padding-left: 3px;'>" .ucfirst($profilename1)."</span></a>";
						
						?>
						 <div class='dropdown pull-right right_profile_timeline'>
                    <button class='btn dropdown-toggle' type='button' data-toggle='dropdown'>
				
					</div>
							 <?php
            if($_SESSION['pid'] == $pro_ids1){ ?>
                        <div class="dropdown pull-right right_profile_timeline"1111111111>
                    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-h" aria-hidden="true">
                        </i>
                            </button>
                            <ul class="dropdown-menu">
                              <li>
							  <?php
                                echo "<button type='button' onclick='deletecommentreply(".$repid1.")' class='deletecmt btn btn1 ".($_SESSION["uid"]==$row["userid"] ?"":"hidden")."' data-commentid='".$repid1."'><span class='fa fa-trash '>  </span> Delete Comment</button>";?>

                            </li>


           <li class="cpading"> <?php echo "<button type='button'  data-toggle='modal' data-target='#mycmtEditrep".$repid1."'
class='editcommentrep btn1 btn ".($_SESSION["uid"]==$row["userid"] ?"":"hidden")."' data-commentid='".$repid1."' data-commenttext='".$repid1."'><span class='fa fa-pencil ' > </span> Edit Comment</button>"; ?>
</li>
                            </ul>
                  </div>
<?php } ?>
						
						
						
						
						
						
						<?php
				echo	"</div>	";
                } ?>
				
				
				
            <div id="mycmtEditrep<?php echo $repid1;  ?>" class="modal fade " role="dialog">
                    <div class="modal-dialog">
                        <!-- Modal content-->
                        <div class="modal-content  bradius-15">
                            <form method="post" action="repeditcomments.php"  id="sp-form-post-edit" class="editPostTimeline" enctype="multipart/form-data" >
                                <div class="modal-header">

                                    <h4 class="modal-title">Edit Comment</h4>
                                    <button type="button" class="close " data-dismiss="modal" style="margin-right: 5px;margin-top: -25px !important; "> <span aria-hidden="true" id="span1">&times;</span>
                                    </button> 
                                </div>


                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="posteditloader">
                                                <div class="loader"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">

                                            <div class="">
                                                <input type="text"  class="form-control" name="replycomment" value="<?php echo $comment1; ?>">

                                                <input name="repid" id="pid"  type="hidden" value="<?php echo $repid1;?>">
                                                <input name="postid" id="pid"  type="hidden" value="<?php echo $_GET["postid"] ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button id="comment"  onclick='editcomment(<?php echo $repid1; ?>)'
                                            class="btn btnPosting pull-right editing db_btn db_primarybtn"  >Save</button>
                                    <button type="button" class="btn btnPosting pull-right db_btn db_orangebtn" data-dismiss="modal" style="margin-right: 5px;">Cancel</button>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
 <!------------------------------------------------------------------------------------------>


            <?php
            /*if($_SESSION['pid'] == $row["spProfiles_idspProfiles"]){ ?>
                        <div class="dropdown pull-right right_profile_timeline"1111111111>
                    <button class="btn dropdown-toggle" type="button" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-h" aria-hidden="true">
                        </i>
                            </button>
                            <ul class="dropdown-menu">
                              <li>
							  <?php
                                echo "<button type='button' onclick='deletecommentreply(".$repid1.")' class='deletecmt btn btn1 ".($_SESSION["uid"]==$row["userid"] ?"":"hidden")."' data-commentid='".$repid1."'><span class='fa fa-trash '>  </span> Delete Comment</button>";?>

                            </li>


           <li class="cpading"> <?php echo "<button type='button'  data-toggle='modal' data-target='#mycmtEditrep".$repid1."'
class='editcommentrep btn1 btn ".($_SESSION["uid"]==$row["userid"] ?"":"hidden")."' data-commentid='".$repid1."' data-commenttext='".$repid1."'><span class='fa fa-pencil ' > </span> Edit Comment</button>"; ?>
</li>
                            </ul>
                  </div>
<?php }*/ ?>








			<div id="ip10">
            <div id="comment1" >
			<?php
			echo "<div class='col-md-12 commentoverflow' style='margin-top:10px;'><span style='color:#1c1e21;' >".$comment1."</span></div>";    
				?>


				 </div>
                <h5 style="margin: 5px;
color: #999; 
font-family: MarksimonRegular; padding-top: 10px;">
                    <?php //echo timeago($c_date1);//time_elapsed_string($date);
                    //  echo $date;
                    // $dt = new DateTime($date);
                    // echo $dt->format('Y-m-d H:i:s');
                    // echo timeago($dt);
                    ?>
                </h5>

            </div>
      </div>
	  <?php } }} ?>
	  
	        <div style="display: none;padding-left:55px; margin-top:7px; margin-bottom:10px">
                <!--- Start section for like of comment --->
                <?php if ($isCommentLikedByUser) { 
                        $likeClass = 'comment_like';
                        $postAction = 'remove_like';
                    } else {
                        $likeClass = 'comment_like';
                        $postAction = 'add_like';
                    } 
                ?>
                <span class="comment_like_area_<?php echo $cid;?>">
                <a href="javascript:void(0);" class="<?php echo $likeClass;?>" id="cmnt_like_<?php echo $cid;?>" data-postid="<?php echo $_GET['postid'];?>" data-commentId="<?php echo $cid;?>" data-userId="<?php echo $_SESSION['pid'];?>" data-postAction="<?php echo $postAction;?>"> 
				
				
                    <span id='spLikePost'>
                        <?php if ($isCommentLikedByUser) { ?>
                            <?php if($commentTotalLikes > 0) { ?>
                           <i class='icon-socialise fa fa-thumbs-up'></i>     Unlike (<?php echo $commentTotalLikes ?>)&nbsp;.&nbsp;
                            <?php } else {?>
                         <i class='icon-socialise fa fa-thumbs-up'></i>       Unlike&nbsp;.&nbsp;
                            <?php }
                        } else { ?> 
                            <?php if($commentTotalLikes > 0) { ?>
                           <i class='icon-socialise fa fa-thumbs-o-up'></i>     Like (<?php echo $commentTotalLikes ?>)&nbsp;&nbsp;
                            <?php } else {?>
                           <i class='icon-socialise fa fa-thumbs-o-up'></i>     Like&nbsp;&nbsp;
                            <?php } 
                        } ?>
                    </span>
                </a>
            </span>
            <!--- End section for like of comment --->
            <a href="javascript:void(0);" data-toggle='modal' data-target='#replycomment<?php echo $cid; ?>' id="rep_main_cmt">
                <div class=' commentoverflow'>
                    Reply
                </div>
            </a>
            <span style="color: #999;">
                &nbsp;
                <?php 
                    echo ($date);
                ?>
            </span>
        </div>
   </div>
   


        </div>


    </div>

    <!------loop close------------>
    <?php
}
}
?>


   




                   <!--------footer end------------> 

                       </div>
                     </div>
                 </div>
               </div>
            </div>                         
                               
          </div>

 <!--Video section div end-->             

               </div>
 <!--------loop close------->
<?php  
}
}
?>



<?php


include '../publicpost/globaltimelineformEdit.php';
include '../publicpost/postshare.php';

?>

            <div id="sidebar_right" class="col-md-3">
                <?php include('../component/right-landing.php');?>
            </div>
                
            </div>
            

        </section>


        <?php 
        include('../component/f_footer.php');
        include('../component/f_btm_script.php'); 
        ?>

    </body>
</html>
<?php
}
?>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel">Total Reactions</h4>
            <div role="tabpanel" id="total_reaction"> 
               <!-- Nav tabs -->
			   
			   <ul class="nav nav-tabs" role="tablist" id="top_reaction">
			   
              
		      </ul>
                    <!-- Tab panes -->
                    <div class="tab-content" id="bottom_reaction" style="">

						
						
                    </div>
			   
			   
             
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script-->
<script src="https:<?php echo $baseurl?>/assets/js/sweetalert.js.0.19/dist/sweetalert2.all.min.js"></script>
<script type="text/javascript">

//POST LIKE
$(document).on("click", ".comment_like", function () {
    var commentId = $(this).attr("data-commentId");
    var likedBy = $(this).attr("data-userId");
    var postId = $(this).attr("data-postid");
    var postAction = $(this).attr("data-postAction");

    $.post("../social/addcommentlike.php", {comment_id: commentId, post_id: postId, liked_by: likedBy, postAction: postAction}, function (response) {
        var resp = JSON.parse(response);
        $('#cmnt_like_'+commentId).remove();
        $(".comment_like_area_"+commentId).html(resp.liked);
    });
});

  function deletecomment1(idComment)
{
  //alert(idComment);

   swal({
      title: "Are you sure?",
      type: "warning",
      confirmButtonClass: "sweet_ok",
      confirmButtonText: "Yes",
      cancelButtonClass: "sweet_cancel",
      cancelButtonText: "No",
      showCancelButton: true,
    },
    function(isConfirm) {
      if (isConfirm) {
         $.ajax
    ({
      type: 'post',
      url: 'commentdelete.php',
      data: 
      {
         idComment:idComment
       
      },
      success: function (response) 
      {
/*        alert(idComment);

*/     

 $(".cmtdiv"+idComment).hide();
  
      }
    });
      }
    });
  
 

}



    function deletecomment(id){
              //alert(url);
        Swal.fire({
          title: 'Are you sure?',
          text: "It will be deleted !",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
		 
		
          if (result.isConfirmed) {
           
            // window.location.href = url;
			 $.ajax
    ({
      type: 'post',
      url: 'commentdelete.php',
      data: 
      {
         idComment:id
       
      },
      success: function (response) 
      {
  window.location.href = '<?php echo $BaseUrl; ?>/publicpost/post_comment_details.php?postid=<?php echo $_GET["postid"];?> ';

 $(".cmtdiv"+idComment).hide();
  
      }
    })
          }
        })  
  
    }
	
	
////////////////////////////////////////////////////

 function deletecommentreply(id){
              //alert(url);
			  Swal.fire({
          title: 'Are you sure?',
          text: "It will be deleted !",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
		 
		
          if (result.isConfirmed) {
           
            // window.location.href = url;
			 $.ajax
    ({
      type: 'post',
      url: 'replycommentdelete.php',
      data: 
      {
         idComment:id
       
      },
      success: function (response) 
      {
  window.location.href = '<?php echo $BaseUrl; ?>/publicpost/post_comment_details.php?postid=<?php echo $_GET["postid"];?> ';

 $(".cmtdiv"+idComment).hide();
  
      }
    })
          }
        })  
  
    }


  function deletecommentreply1(idComment)
  {
      //alert(idComment);

      swal({
              title: "Are you sure?",
              type: "warning",
              confirmButtonClass: "sweet_ok",
              confirmButtonText: "Yes",
              cancelButtonClass: "sweet_cancel",
              cancelButtonText: "No",
              showCancelButton: true,
          },
          function(isConfirm) {
              if (isConfirm) {
                  $.ajax
                  ({
                      type: 'post',
                      url: 'replycommentdelete.php',
                      data:
                          {
                              idComment:idComment

                          },
                      success: function (response)
                      {
                          /*        alert(idComment);

                          */

                          $(".repcmtdiv"+idComment).hide();

                      }
                  });
              }
          });



  }
    ////////////////////////////////////////////////



</script>

<script>
	
	
	</script>

<script type="text/javascript">
  function editcomment(idComment)
{
 // alert(idComment);


    $.ajax
    ({
      type: 'post',
      url: 'editcomment.php',
      data: 
      {
         comment:comment,
         idComment:idComment
       
      },
      success: function (response) 
      {
/*        alert(idComment);

*/     

 /*$(".cmtdiv"+idComment).hide();*/
  
      }
    });
 

}</script>
  <?php
  if(isset($_GET['loadcom'])) {
      ?>
      <script type="text/javascript">
       ///  $("#rep_main_cmt").click();
      </script>
      <?php
  }
  ?>
  
  <script> 
	$(".rcount").on("click", function(){
			var postidr = $(this).attr("data-postidr");
		//	var rdetails = $(".rcount").val();

	
					$.ajax({
						url: "../social/getReaction.php",
						type: "POST",
					data: {
						spPostings_idspPostings: postidr
						},
						success: function(response){
							
								$('#top_reaction').html(response);
					},
						          
					});	
					
						$.ajax({
						url: "../social/getReaction1.php",
						type: "POST",
					data: {
						spPostings_idspPostings: postidr
						},
						success: function(response){
							
								$('#bottom_reaction').html(response);
					},
						          
					});		
		});
</script>   

<script>

/*
$(".main-ul").css("display", "none");

      setTimeout(function () {
                  $(".main-ul").css("display", "flex");
                 }, 2000);
*/

	$(".reactionbtn_remove").on("click", function(){
		var rection =  "&#128077;&#127995;";


	var postid = $(this).attr("data-postid");
	var prid = $("#prid").val();
	var usid = $("#usid").val();

			$.ajax({
						url: "../social/remove_reaction.php",
						type: "POST",
					data: {
								spPostings_idspPostings: postid,
						spProfiles_idspProfiles: prid
						},
						success: function(response){
						$('#currentreaction_'+postid).html(rection);
	
			//		$('#new_data_'+postid).html('<a data-reaction="7"  id="currentreaction_'+postid+'" class="reactionbtn" data-postid="'+postid+'"  style="font-size: 25px;">'+rection+'</a>');		
					
	//	$('#currentreaction_'+postid).removeClass('reactionbtn_remove').addClass('reactionbtn');
					  
					},
						          
					});
		});



	$(".reactionbtn").on("click", function(){
	var postid = $(this).attr("data-postid");
	var reaction = $(this).attr("data-reaction");
	
		var rid = $(this).attr("data-reaction");

												if(rid == 1){
								   rection = "&#128525;";
								   }
								   
						      if(rid == 2){
								   rection = "&#128512;";
								   }
					          if(rid == 3){
								   rection = "&#128546;";
								   }
							  if(rid == 4){
								   rection = "&#129315;"; 
								   }
						     if(rid == 5){
								   rection = "&#128563;";
								   }
						     if(rid == 6){
								   rection = "&#128545;";
								   }
								   
								      if(rid == 7){
								   rection = "&#128077";
								   }
	
	
	
	
	var usid = $("#usid").val();
	var prid = $("#prid").val();
	
				$.ajax({
						url: "../social/addlike.php",
						type: "POST",
					data: {
						spPostings_idspPostings: postid,
						spProfiles_idspProfiles: prid,
						uid: usid,
						Reaction_id: reaction,
						},
						success: function(response){
				$('#currentreaction_'+postid).html(rection);
					//	$('#new_data_'+postid).html('<a id="currentreaction_'+postid+'" class="reactionbtn_remove" data-postid="'+postid+'style="font-size:25px;">'+rection+'</a>');		
						//				  $('#currentreaction_'+postid).removeClass('reactionbtn').addClass('reactionbtn_remove');

					},
						          
					});
		});
				
					
</script> 