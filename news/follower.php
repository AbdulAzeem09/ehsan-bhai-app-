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
	
	$Id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    
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

						<?php  include_once("newsSidebar.php");
                      $obj=new _spprofilefeature;
					  
                        $res3=$obj->followsname($Id);
						
						$row3=mysqli_fetch_assoc($res3);
						

						?>
						
						
						
						<div class="col-md-6 h style-1">
                              <label><h3><a href='<?php echo $BaseUrl;?>/news/profile.php?id=<?php echo $Id;?>'><?php echo $row3['spProfileName']?></a><?php echo " Followers"; ?></h3></label>						
								<div class="row">		
								<?php  
 
					$res22s=$obj->readfollowersallcount($Id);
					$allcount2=$res22s->num_rows;
					$ress=$obj->readfollowers($Id);
					if($ress!=false){
					
						
						//echo $row2['spProfileName'];
						//echo $row2['spProfilePic'];
							//die("****************");
					
	   
	  ?>
	  <div class="form-group"style="border-color: red;">
	  <?php 
	  while($row=mysqli_fetch_assoc($ress)){
						
                          $who=$row['who'];
						$res2=$obj->readfollowersdata($who);
						
						$row2=mysqli_fetch_assoc($res2);
	   
	   ?>
	   <style>
						.followerstructure{
							margin-left: 4px;
                            margin-right: 4px;
							border:2px solid blue;
                            border-radius: 5px;
							padding: 2px;
						}
						</style>
	   
	 <?php  
   include('followerData.php');

	 }?></div>
				 <?php  	}	
					
					
else{
		 echo "Data not found";
	 }		

if($ress!=false){	 
					?> 
					
<h1 class="load-more2" style="text-align: center; padding: 16px;font-size: 24px;" >Load More</h1>
<input type="hidden" id="row1" value="0">
<input type="hidden" id="all1" value="<?php echo $allcount2; ?>">
<?php }?>
	  
	  
	  </div></div>
	  		<div class="col-md-6 h style-1">
                          <?php  include_once("rightSidebar.php"); ?>
						  
									</div>
	   
		
					</div>
				</div>
			</div>
		</div>
		<!--================================================== -->
		
		
		
		<script>
	
	
	$(document).ready(function(){

    // Load more data
    $('.load-more2').click(function(){
		//alert("wwwwww");
        var row1 = Number($('#row1').val());
        var allcount1 = Number($('#all1').val());  
        row1 = row1 + 4;
		var gid="<?php echo $Id; ?>"

        if(row1 <= allcount1){
            $("#row1").val(row1);

            $.ajax({
                url: 'followerloadmore.php', 
                type: 'post',
                data: {row:row1,
						id:gid
						},
                beforeSend:function(){
                    $(".load-more2").text("Loading...");
                },
                success: function(response){

                    // Setting little delay while displaying new content
                    setTimeout(function() {
                        // appending posts after last post with class="post"
                        $(".post1:last").after(response).show().fadeIn("slow");

                        var rowno1 = row1 + 4;

                        // checking row value is greater than allcount or not
                        if(rowno1 > allcount1){

                            // Change the text and background
                          /*  $('.load-more1').text("Hide");
                            $('.load-more1').css("background","darkorchid");*/
								$('.load-more2').css("display","none");	
                        }else{
                            $(".load-more2").text("Load more");
                        }
                    }, 2000);

 
                }
            });
        }else{
            $('.load-more2').text("Loading...");

            // Setting little delay while removing contents
            setTimeout(function() {

                // When row is greater than allcount then remove all class='post' element after 3 element
                $('.post1:nth-child(3)').nextAll('.post1').remove().fadeIn("slow");

                // Reset the value of row
                $("#row1").val(1); 

                // Change the text and background
                $('.load-more2').text("Load more");
               // $('.load-more2').css("background","#15a9ce");  

            }, 2000);


        } 

    });
	
	

});
	
	
	</script>
		
		
		
		
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
			
		$(document).ready(function(){
			
			
			$('#follow').click(function(){
			var a=	$('#follow').attr('data-who');
			var b=	$('#follow').attr('data-whom');
			
					$.ajax({
			  url: "follow.php",
			  type: "POST",
			 cache:false,
				data: {'who':a,
				'whom':b
				},
			   success: function(data) {
			   			  var unfollow = '<a  id="unfollow" class="waves-effect waves-dark btn btn-primary btn-md btn-rounded" data-abc="true"  data-who='+a+' data-whom='+b+'>UnFollow</a>';
					$('#profile').html(unfollow);	  
						  
			}
			
			});
			
		});	
			
			
		$('#unfollow').click(function(){
			var a=	$('#unfollow').attr('data-who');
			var b=	$('#unfollow').attr('data-whom');
			
					$.ajax({
			  url: "unfollow.php",
			  type: "POST",
			 cache:false,
				data: {'who':a,
				'whom':b
				},
			   success: function(data) {
			  var follow = '<a  id="unfollow" class="waves-effect waves-dark btn btn-primary btn-md btn-rounded" data-abc="true"  data-who='+a+' data-whom='+b+'>Follow</a>';
			  	$('#profile').html(follow);	
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
