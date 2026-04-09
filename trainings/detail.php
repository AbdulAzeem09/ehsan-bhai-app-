<?php
 //ini_set('display_errors', 1);
  //ini_set('display_startup_errors', 1);
 //error_reporting(E_ALL);

include('../univ/baseurl.php');
session_start();
//echo $_SESSION['pid'];
if (!isset($_SESSION['pid'])) {
	$_SESSION['afterlogin'] = "trainings/";
	include_once ("../authentication/check.php");

}else{
	function sp_autoloader($class) {
		include '../mlayer/' . $class . '.class.php';
	}
	spl_autoload_register("sp_autoloader");

	$_GET["categoryID"] = "8";
	$_GET["categoryName"] = "Trainings";
	$header_train = "header_train";
	$available = 0;
	
	$postid = isset($_GET['postid']) ? (int)$_GET['postid'] : 0;

	if ($postid > 0) {
		$p = new _postings;
		$pf  = new _postfield;

		$con=mysqli_connect("localhost","theshare_page","mgB81jXxxafr","theshare_share");
		$result = $p->read_training($postid);

//echo $p->ta->sql;
		if($result != false){
			$row = mysqli_fetch_assoc($result);
// print_r($row);
// exit;
			$ProTitle   = $row['spPostingTitle'];
			$Category	= $row['trainingcategory'];
			$ProDes     = $row['spPostingNotes'];
			$spPostingTraimnerBio =$row['spPostingTraimnerBio'];
			$company=$row['spPostingCompany'];
			$video_level=$row['videolevel'];
			$total_hour=$row['totalhour'];
			$ArtistName = $row['spProfileName'];
			$ArtistId   = $row['idspProfiles'];
			$ArtistAbout= $row['spProfileAbout'];
			$ArtistPic  = $row['spProfilePic'];
			$price      = $row['spPostingPrice'];
			$country    = $row['spPostingsCountry'];
			$city      = $row['spPostingsCity'];
			$txtDiscount=$row['txtDiscount'];
			$requirmnet=$row['spRequiremnt'];
			$currency=$row['default_currency'];
			$seller_pid=$row['spprofiles_idspprofiles'];
			$seller_uid=$row['spuser_idspuser'];
//posting fields
//  $result_pf = $pf->read($row['idspPostings']);
//echo $pf->ta->sql."<br>";
/* if($result_pf){
$outline = "";
$txtDiscount = "";
$spPostingCompany    = "";
$spPostingTraimnerBio = "";
$trainingcategory = "";
$requirmnet = "";
$videoLevel = "";
$totalHour = "";

while ($row2 = mysqli_fetch_assoc($result_pf)) {



if($outline == ''){
if($row2['spPostFieldName'] == 'outline_'){
$outline = $row2['spPostFieldValue'];
}
}
if($txtDiscount == ''){
if($row2['spPostFieldName'] == 'txtDiscount_'){
$txtDiscount = $row2['spPostFieldValue'];
}
}
if($spPostingCompany == ''){
if($row2['spPostFieldName'] == 'spPostingCompany_'){
$spPostingCompany = $row2['spPostFieldValue'];
}
}
if($spPostingTraimnerBio == ''){
if($row2['spPostFieldName'] == 'spPostingTraimnerBio_'){
$spPostingTraimnerBio = $row2['spPostFieldValue'];
}
}
if($trainingcategory == ''){
if($row2['spPostFieldName'] == 'trainingcategory_'){
$trainingcategory = $row2['spPostFieldValue'];
}
}
if($requirmnet == ''){
if($row2['spPostFieldName'] == 'spRequiremnt_'){
$requirmnet = $row2['spPostFieldValue'];
}
}
if($videoLevel == ''){
if($row2['spPostFieldName'] == 'videolevel_'){
$videoLevel = $row2['spPostFieldValue'];
}
}
if($totalHour == ''){
if($row2['spPostFieldName'] == 'totalhour_'){
$totalHour = $row2['spPostFieldValue'];
}
}


}
}*/
if($price!='' && $txtDiscount!=''){

	$discountedPrice = $price - ($price* ($txtDiscount/100));
//echo  $price.'xxxxxxxxxxx';
//echo  $txtDiscount;
//die("====");
}else{
	$discountedPrice=$price;

}

}

}else{
	$re = new _redirect;
	$redirctUrl = "../trainings";
	$re->redirect($redirctUrl);
}


?>
<!DOCTYPE html>
<html lang="en-US">

<head>
	<?php include('../component/f_links.php');?>
	<style type="text/css">
		.right_head_box p.price {
			font-size: 20px !important;
			
		}


		.rating:not(:checked)>label:hover, .rating:not(:checked)>label:hover~label, .rating>input:checked~label {
			color: gold; !important;
		}
		.rating-box {
			position:relative!important;
			vertical-align: middle!important;
			font-size: 15px;
			font-family: FontAwesome;
			display:inline-block!important;
			color: lighten(@grayLight, 25%);
/*padding-bottom: 10px;*/
}

.rating-box:before{
	content: "\f006 \0020 \f006 \0020 \f006 \0020 \f006 \0020 \f006";
}

.ratings {
	position: absolute!important;
	left:0;
	top:0;
	white-space:nowrap!important;
	overflow:hidden!important;
	color: Gold!important;

}
.ratings:before {
	content: "\f005 \0020 \f005 \0020 \f005 \0020 \f005 \0020 \f005";
}

p {
	margin-top: 4px;
}


.btn-success {
	margin-top: -113px;
	margin-left: 270px;
	
}

textarea {
	resize: none;
}

.btn_fb{background-color:#3b5999;font-size:20px;color:white;padding: 7px 12px;
	border-radius: 8px;}
	.btn_fb:hover{color:white;background-color: #6178ab;}	
	.btn_google{background-color:#3b5999;font-size:20px;color:white;padding: 7px 12px;
		border-radius: 8px;}
		
		.btn_tweet{background-color:#55acee;font-size:20px;color:white;padding: 7px 2px 7px 9px;
			border-radius: 8px;}
			.btn_tweet:hover{color:white;background-color: #6178ab;}	

			.btn_linkdin{background-color:#3b5999;font-size:20px;color:white;padding: 7px 4px 7px 10px;border-radius: 8px; margin: 5px;}
			.btn_linkdin:hover{color:white;background-color: #6178ab;}	

			.btn_whatsapp{background-color:#0f8f46;font-size:20px;color:white;padding: 7px 12px;border-radius: 8px;}
			.btn_whatsapp:hover{color:white;background-color: #35b96e;}	

			.mt_d{margin-top: 10px;}
			.pull-right {
				color: white;
			}

		</style>
	</head>

	<body class="bg_gray">
		<?php
		include_once("../header.php");
		?>
		<section>
			
			
			
			<div class="container">
				<div class="row no-margin">
					<div class="col-md-12 no-padding">
						<div class="fulmainarttab">
							<ul class='nav nav-tabs' id='navtabVdo' >
								<li><a href="<?php echo $BaseUrl.'/trainings';?>">Home</a></li>
								<li><a href="<?php echo $BaseUrl.'/trainings/category.php';?>">All Courses</a></li>  
								<li role="presentation" class="active"><a href="#video1" aria-controls="home" role="tab" data-toggle="tab"><?php echo ucwords($Category); ?></a></li> 


							</ul>
							<div class="linebtm"></div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section class="top_detail_train">
			<div class="container">
				<div class="row">
					<div class="col-md-8">
						<h2><?php echo ucwords($ProTitle); ?></h2>
						<div class="pull-right" style="margin-top: -40px;">
							<?php 
							$bR = new _trainingrating;
							$resultsum1 = $bR->readrating($postid);
//$totalmyreviews1=0;
							if($resultsum1 != false){
								$sumrevrating1 = 0;
								$totalmyreviews1 = $resultsum1->num_rows;
								while($rowreview1 = mysqli_fetch_assoc($resultsum1)){
									$sumrevrating1 += $rowreview1['rating'];

								}  

								$reviewaveragerate1 = $sumrevrating1 / $totalmyreviews1;
								$totalreviewrate1  = round($reviewaveragerate1, 1);
							} else{
								$totalmyreviews1=0;
							}
							?>
							<p class="rating_box">

								<div class="rating-box">
									<?php if($totalreviewrate1 >= "5") { 
										echo '<div class="ratings" style="width:100%;"></div>';
									}else  if($totalreviewrate1 >= "4" && $totalreviewrate1 < "5") { 
										echo '<div class="ratings" style="width:92%;"></div>';
									}
									else  if($totalreviewrate1 >= "4") { 
										echo '<div class="ratings" style="width:80%;"></div>';
									}else  if($totalreviewrate1 > "3" && $totalreviewrate1 < "4") { 
										echo '<div class="ratings" style="width:72%;"></div>';
									}else  if($totalreviewrate1 >= "3") { 
										echo '<div class="ratings" style="width:60%;"></div>';
									}else  if($totalreviewrate1 > "2" && $totalreviewrate1 < "3") { 
										echo '<div class="ratings" style="width:51%;"></div>';
									}else  if($totalreviewrate1 >= "2") { 
										echo '<div class="ratings" style="width:38%;"></div>';
									}else  if($totalreviewrate1 > "1" && $totalreviewrate1 < "2") { 
										echo '<div class="ratings" style="width:29%;"></div>';
									}else  if($totalreviewrate1 >= "1") { 
										echo '<div class="ratings" style="width:16%;"></div>';
									}else  if($totalreviewrate1 <= "0") { 
										echo '<div class="ratings" style="width:0%;"></div>';
									}

									?>

								</div>
								<small style="color:white;">(<?php echo $totalmyreviews1; ?>)</small> 
							</p>
						</div>
						<p class="text-justify"><?php echo $spPostingTraimnerBio; ?></p>
						<p>
							Created By 
							<?php 
							$p = new _spprofiles;
							$pres2 = $p->readUserId($seller_pid);
//print_r($pres2);die('==0099');
							if($pres2 != false){
								$prow2 = mysqli_fetch_assoc($pres2);
								$sellerNmae=$prow2['spProfileName'];
								?>
								<a href="<?php echo $BaseUrl.'/trainings/intructor-detail.php?intructor='.$prow2['idspProfiles']?>" > <?php echo $prow2['spProfileName']; ?></a>
								<?php
							}
							?>
							&nbsp;&nbsp;&nbsp;
							<?php echo $Category;?>
							&nbsp;&nbsp;&nbsp;
							<?php echo $company; ?>

						</p>







						<?php 

						$bR = new _trainingrating;
						$sql = "SELECT max(rating) FROM sptrainingrating AS t where sptrainid = ".$postid." and spprofileid = ".$_SESSION['pid']."";
//echo $sql;die;
						if($res){
							$res=mysqli_query($con,$sql);
						}
//var_dump($res);die;
						if($res!=false){
							$rat=mysqli_fetch_assoc($res);
	//print_r($rat);die;
							$totalRating=$rat['max(rating)'];
							
						}?>
<!--<fieldset id='train_postrating' class="rating no-padding">
<input class="stars" type="radio" id="star5" name="rating" value="5" 
<?php echo ($totalRating == 5)? 'checked': '';?>/>
<label  style="cursor:pointer" class = "full" for="star5" title="Awesome - 5 stars"></label>
<input class="stars" type="radio" id="star4" name="rating" value="4" <?php echo ($totalRating == 4)? 'checked': '';?> />
<label style="cursor:pointer" class = "full" for="star4" title="Pretty good - 4 stars"></label>
<input class="stars" type="radio" id="star3" name="rating" value="3" <?php echo ($totalRating == 3)? 'checked': '';?> />
<label style="cursor:pointer" class = "full" for="star3" title="Meh - 3 stars"></label>
<input style="cursor:pointer" class="stars" type="radio" id="star2" name="rating" value="2" <?php echo ($totalRating == 2)? 'checked': '';?> />
<label style="cursor:pointer" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
<input class="stars" type="radio" id="star1" name="rating" value="1" <?php echo ($totalRating == 1)? 'checked': '';?> />
<label style="cursor:pointer" class = "full" for="star1" title="Sucks big time - 1 star"></label>
</fieldset>-->
<?php 
$po= new _postings;
$p22=$po->read_purchase_buyer($postid, $_SESSION['pid']);
if($p22!=false){
	?>
	<fieldset id='train_postrating' class="rating no-padding">
		<input class="stars" type="radio" id="star5" name="rating" value="5" 
		<?php echo ($totalRating == 5)? 'checked': '';?>/>
		<label  style="cursor:pointer" class = "full" for="star5" title="Awesome - 5 stars"></label>
		<input class="stars" type="radio" id="star4" name="rating" value="4" <?php echo ($totalRating == 4)? 'checked': '';?> />
		<label style="cursor:pointer" class = "full" for="star4" title="Pretty good - 4 stars"></label>
		<input class="stars" type="radio" id="star3" name="rating" value="3" <?php echo ($totalRating == 3)? 'checked': '';?> />
		<label style="cursor:pointer" class = "full" for="star3" title="Meh - 3 stars"></label>
		<input style="cursor:pointer" class="stars" type="radio" id="star2" name="rating" value="2" <?php echo ($totalRating == 2)? 'checked': '';?> />
		<label style="cursor:pointer" class = "full" for="star2" title="Kinda bad - 2 stars"></label>
		<input class="stars" type="radio" id="star1" name="rating" value="1" <?php echo ($totalRating == 1)? 'checked': '';?> />
		<label style="cursor:pointer" class = "full" for="star1" title="Sucks big time - 1 star"></label>
	</fieldset>
<?php } ?>
</div>
<div class="col-md-4">
	<div class="right_head_box">
		<?php
		$pic = new _postings;
		$res2 = $pic->read_cover_images($postid);
//echo $pic->ta->sql;
		if($res2 != false){                                                
			$rp = mysqli_fetch_assoc($res2);
			$pic2 = $rp['filename'];
			echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " .$BaseUrl.'/post-ad/uploads/'.($pic2) . "' >"; 

		}else{
			echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive blank' style='width: 350px;height: 250px;'>";
		}
		?>
		<?php if( $price!='' && $txtDiscount!=''){
			$price_1 = $price*($txtDiscount/100);    
			$price_dis = $price-$price_1;
			?>
			<p class="price"><?php echo ($price_dis > 0)?$currency.' '.$price_dis:'Free';?>

			<del class="text-success" style="/* color:green; */"><?php echo ($price > 0)?$currency.' '.$price:'';?></del> 
		</p>
		<?php

	}else{ ?>  
		<p class="price"><?php echo ($price > 0)?$currency.' '.$price:'Free';?></p>
	<?php } ?>
	<p class="dis">Discount <?php echo $txtDiscount; ?>%</p>
	<!-- <p class="dis">Discounted Price $<?php echo $discountedPrice; ?></p> -->
	<form action="<?php echo "../cart/addorder.php";?>" method="post">
		<input type="hidden" id="spOrderAdid_" name="spOrderAdid_" value="<?php echo $_GET["postid"]?>">
<!--<input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="spByuerProfileId" value="<?php echo $_SESSION['pid']?>"/>

	<input type="hidden" class="dynamic-pid" id="spBuyeruserId" name="spBuyeruserId" value="<?php echo $_SESSION['uid']?>"/>-->

	<input type="hidden" class="dynamic-pid" id="size" name="size" />

	<input type="hidden" class="orderamount" id="sporderAmount" name="sporderAmount" value="<?php echo $discountedPrice ?>"/>
	<input type="hidden" id="spSellerProfileId" name="spSellerProfileId" value="<?php  echo $prow2['idspProfiles'];?>"/>
	<input type="hidden" id="cartItemType" name="cartItemType" value="Training"/>
	<input type="hidden" id="spOrdrQty" name="spOrderQty" value="1" >
	<?php 

	$available = 0;
	$catid = 8;
	$buyerid = $_SESSION['pid'];
	$od = new  _order;
	$res = $od->checkTrainorder($postid , $buyerid);

	if ($res != false){
		?>	

		<a type="button" href="<?php echo $BaseUrl.'/trainings/dashboard/training_detail.php?postid='.$postid;?>"><i class="fa fa-eye"></i> View This Course</a>
		<br>
		<?php
	}else{
		echo "<button style='border-radius:25px;' type='button' class='btn btn-success  ".($available == 0 ? "":"")."'  data-postid='".$postid."'  data-profileid='".$_SESSION["pid"]."' data-categoryid='".$catid."' data-toggle='modal' data-target='#exampleModal1'>Buy Now</button>";
	}
	?>
</form>
<div class="classified">
	<?php
	$fv = new _favorites;
	$res_fv = $fv->chekFavourite_training($postid, $_SESSION['uid'], $_SESSION['pid']);
//var_dump($res_fv);
//echo $fv->ta->sql;
	if($res_fv != false){ ?>
		<a href="javascript:void(0)" id="remtofavoritesevent" data-postid="<?php echo $postid;?>" data-pid="<?php echo $_SESSION['pid'];?>">
			<span id="removetofavouriteeve"><i class="fa fa-heart"></i>&nbsp favourite</span>

			</a><?php
//echo '<li><a data-postid="'. $_GET["postid"].'" class="remtofavorites"><img src="'.$BaseUrl.'/assets/images/icon/store/favourite.png"><span id="remtofavorites"> Unfavourite</span></a></li>';
		}else{
			?>
			<a href="javascript:void(0)" id="addtofavouriteevent" data-postid="<?php echo $postid;?>" data-pid="<?php echo $_SESSION['pid'];?>">
				<span id="addtofavouriteeve"><i class="fa fa-heart-o"></i>&nbsp Unfavourite</span>

			</a>
			<?php
		}
		?>
	</div>
	<?php 
	$flag = new _flagpost;

	$res_flag= $flag->get_data($postid, $_SESSION['pid']);
	if($res_flag){ ?>
		<p>You are already Flag This Post</p>

	<?php }else{ ?> 
		<p><a href="javascript:void(0)" data-toggle="modal" data-target="#flagPost" ><i class="fa fa-flag"></i> Flag This Post</a></p>

	<?php }
	?>


	<!-- Modal -->
	<div id="flagPost" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<form method="post" action="addtoflag.php" class="sharestorepos">
				<div class="modal-content no-radius">
					<input type="hidden" name="spPosting_idspPosting" value="<?php echo $postid;?>">
					<input type="hidden" name="spProfile_idspProfile" value="<?php echo $_SESSION['pid']; ?>">
					<input type="hidden" name="spCategory_idspCategory" value="<?php echo $_GET['categoryID']?>">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Flag Post</h4>
					</div>
					<div class="modal-body">
						<div class="radio">
							<label><input type="radio" name="why_flag" value="Duplicate post" checked="">Duplicate post</label>
						</div>
						<div class="radio">
							<label><input type="radio" name="why_flag" value="Posting Violation">Posting Violation</label>
						</div>
						<div class="radio">
							<label><input type="radio" name="why_flag" value="Suspicious Post">Suspicious Post</label>
						</div>
						<div class="radio">
							<label><input type="radio" name="why_flag" value="Copied My Post">Copied My Post</label>
						</div> 

						<!-- <label>Why flag this post?</label> -->
						<textarea class="form-control" name="flag_desc" placeholder="Add Comments"></textarea>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn butn_cancel" data-dismiss="modal">Cancel</button>
						<input type="submit" name="" class="btn butn_mdl_submit ">

					</div>
				</div>
			</form>
		</div>
	</div>


	<p><strong>Includes:</strong></p>
	<p><?php echo $total_hour; ?> hours on-demand video</p>
	<?php
	$mus = new _postingmusicmedia;
	$res4 = $mus->readPostMusicFile($postid);
	$res5 = $mus->readPostMusicMedia($postid);
//echo $mus->ta->sql;
	if($res4 != false){
		$totlAtach = $res4->num_rows;
	}else{
		$totlAtach = 0;
	}
	if($res5 != false){
		$totlResouc = $res5->num_rows;
	}else{
		$totlResouc = 0;
	}
	$enrolled=0;
	$en=$po->read_purchase_postid($postid);
	if($en!=false){
		$enrolled=$en->num_rows;
	}
	?>
	<p><?php echo $totlResouc; ?> Articles</p>
	<p><?php echo $totlAtach; ?> Supplemental Resources</p>
	<p>Full lifetime access</p>
	<p><?php echo $enrolled;?> Students Enrolled</p>

	<?php
	$title="whatsapp";
	
	$url=(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	
	?>	
	
	<div id="social-share" class="mt_d">
		<strong><span>Sharing is caring</span></strong> <i class="fa fa-share-alt"></i>&nbsp;&nbsp;
		<a href="https://www.facebook.com/sharer.php?u=<?php echo $url; ?>" target="_blank" class="facebook btn_fb"><i class='fa fa-facebook '></i></a>
		<!-- <a href="https://plus.google.com/share?url=<?php echo $url; ?>" target="_blank" class="gplus btn_google"><i class="fa fa-google-plus"></i></a>-->
		<a href="https://twitter.com/intent/tweet?text='.$title.'&amp;url=<?php echo $url; ?>&amp;via=YOUR_TWITTER_HANDLE_HERE" target="_blank" class="twitter btn_tweet"><i class="fa fa-twitter"></i> </a>
		<a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>" target="_blank" class="linkedin btn_linkdin"><i class="fa fa-linkedin"></i> </a>
		<a href="whatsapp://send?text=<?php echo $url; ?>" target="_blank" class="whatsapp btn_whatsapp"><i class="fa fa-whatsapp"></i></a>
	</div>




</div>
</div>
</div>
</div>
</section>
<section>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="rightDetailVideo">
					<?php if ($outline != '') { ?>
						<h3>Course Outline</h3>
						<p style="word-wrap: break-word;"><?php echo $outline; ?></p>
					<?php } ?>
					<h3>Description</h3>
					<p class="text-justify" style="word-wrap: break-word;"><?php echo $ProDes; ?></p>

					<h3>Requirements</h3>
					<p style="word-wrap: break-word;"><?php echo $requirmnet; ?></p>

					<h3>Details</h3>
					<div class="table-responsive">
						<table class="table table-striped table-bordered">
							<tbody>
								<tr>
									<td>Category</td>
									<td><?php echo $Category; ?></td>
								</tr>
								<tr>
									<td>Company</td>
									<td><?php echo $company; ?></td>
								</tr>
								<tr>
									<td>Video Level</td>
									<td><?php echo $video_level; ?></td>
								</tr>
								<tr>
									<td>Total Hour</td>
									<td><?php echo $total_hour; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-3 no-padding">



			</div>
		</div>
		<br>
		<br>
		<div class="row">
			<div class="col-md-12">
				<h3>Similar Courses</h3>
			</div>
			<br>
			<?php
			$limit = 10;
			$orderBy = "DESC";
			$p   = new _postings;
/*$pf  = new _postfield;

$course_type = $p->Course_type($postid);
if($course_type!=false){
$courseType = mysqli_fetch_assoc($course_type);
}
if (isset($courseType)) {*/
	$course_type = $courseType['spPostFieldValue'];


// $res = $p->publicpost_music($limit, $_GET["categoryID"], $orderBy);
	$res = $p->read_all_training_category($Category); 

	if($res){
		$i=0;
		while ($row = mysqli_fetch_assoc($res)) {
			if($postid==$row['id']) {
				continue;
			} 
			else{

				if ($i < 4) {?>

					<div class="col-xs-5ths">
						<div class="course_Box" style="height: 270px;">
							<div class="img_fe_box">
								<a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$row['id'];?>">
									<?php
									$pic = new _postings;
									$res2 = $pic->read_cover_images($row['id']);
//echo $pic->ta->sql;
									if($res2 != false){                                                
										$rp = mysqli_fetch_assoc($res2);
										$pic2 = $rp['filename'];
										echo "<img alt='Posting Pic' class='img-responsive imgMain' src=' " .$BaseUrl.'/post-ad/uploads/'.($pic2) . "' >"; 

									}else{
										echo "<img alt='Posting Pic' src='../img/no.png' class='img-responsive blank'>";
									}
									?>
								</a>
							</div>
							<div class="innerBoxvdo">
								<a href="<?php echo $BaseUrl.'/trainings/detail.php?postid='.$row['id'];?>" class="title" data-toggle="tooltip" title="<?php echo $row['spPostingtitle'];?>" style="font-size:18px;">
									<?php 
									if(strlen($row['spPostingTitle']) < 20){
										echo $row['spPostingTitle'];
									}else{
										echo substr($row['spPostingTitle'], 0,15)."...";
									} 
									?>     
								</a><br>
								<?php 
								$bR = new _trainingrating;
								$resultsum1 = $bR->readrating($row['idspPostings']);

								if($resultsum1 != false){
									$sumrevrating1 = 0;
									$totalmyreviews1 = $resultsum1->num_rows;
									while($rowreview1 = mysqli_fetch_assoc($resultsum1)){
										$sumrevrating1 += $rowreview1['rating'];

									}  

									$reviewaveragerate1 = $sumrevrating1 / $totalmyreviews1;
									$totalreviewrate1  = round($reviewaveragerate1, 1);
								} 
								?>
								<small>(<?php echo $row['trainingcategory']; ?>)</small><br>
								<p class="rating_box">

<!-- <div class="rating-box">
<?php if($totalreviewrate1 >= "5") { 
echo '<div class="ratings" style="width:100%;"></div>';
}else  if($totalreviewrate1 >= "4" && $totalreviewrate1 < "5") { 
echo '<div class="ratings" style="width:92%;"></div>';
}
else  if($totalreviewrate1 >= "4") { 
echo '<div class="ratings" style="width:80%;"></div>';
}else  if($totalreviewrate1 > "3" && $totalreviewrate1 < "4") { 
echo '<div class="ratings" style="width:72%;"></div>';
}else  if($totalreviewrate1 >= "3") { 
echo '<div class="ratings" style="width:60%;"></div>';
}else  if($totalreviewrate1 > "2" && $totalreviewrate1 < "3") { 
echo '<div class="ratings" style="width:51%;"></div>';
}else  if($totalreviewrate1 >= "2") { 
echo '<div class="ratings" style="width:38%;"></div>';
}else  if($totalreviewrate1 > "1" && $totalreviewrate1 < "2") { 
echo '<div class="ratings" style="width:29%;"></div>';
}else  if($totalreviewrate1 >= "1") { 
echo '<div class="ratings" style="width:16%;"></div>';
}else  if($totalreviewrate1 <= "0") { 
echo '<div class="ratings" style="width:0%;"></div>';
}

?>
a
</div> -->
<!-- <small>(<?php echo $totalmyreviews1; ?>)</small>  -->
</p>
<?php
$p = new _spprofiles;
$pres1 = $p->readUserId($row['idspProfiles']);
if($pres1 != false){
	$prow = mysqli_fetch_assoc($pres1);
	?>
	<a href="javascript:void(0)" class="name"><?php echo $prow['spProfileName']; ?></a>
	<?php

}
$price_14 = $row['spPostingPrice']*($row['txtDiscount']/100);    
$price_dis4 = $row['spPostingPrice']-$price_14;
?>

<p class="price" style="float: left;"><?php echo ($price_dis4 > 0)?$currency.' '.$price_dis4:'Free';?>

<del class="text-success" style="margin-top:2px;"><?php echo ($row['spPostingPrice'] > 0)?$currency.' '.$row['spPostingPrice']:'Free';?>
</del></p>
</div>
</div>
</div> <?php
$i++;
}else{
	break;
}
}
}
}else{
	echo "<h4 style='text-align:center;'>No Similar categories!</h4>";
}
//}
?>
</div>
<?php
$p   = new _postingview;
$post_id = $postid;
$course_type = $p->Course_type($post_id);
if($course_type1=false){
	$courseType = mysqli_fetch_assoc($course_type);
}
$course_type = $courseType['spPostFieldValue'];
$res = $p->similarCourses($course_type,$post_id);
if ($res) {?>
	<a style="margin-left: 350px;" href="<?php echo $BaseUrl.'/trainings/category.php?catName='.$course_type?>" >View More</a>
<?php }
?>
</div>
</section>

<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Enter Credit Card Details: <span id="seller_name"> </span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:-32px;">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">
				<form class="row" action="<?php echo $BaseUrl;?>/trainings/payment.php" method="POST" id="paymentForm">
					<div class="col-md-2"></div>
					<div class="col-md-10">
						<div class="row">
							<div class="col-md-9 form-group">
								<label><b>Card Holder Name <span class="text-danger">*</span></b></label>
								<input type="text" name="customerName" id="customerName" class="form-control" maxlength="22" value="<?php echo $cardname ?>" onkeypress="return /[a-z ]/i.test(event.key)" required>
								<span id="errorCustomerName" class="text-danger"></span>
							</div>
							<div class="col-md-9 form-group">
								<label>Card Number <span class="text-danger">*</span></label>
								<input type="number" name="cardNumber" id="cardNumber" class="form-control" maxlength="20" onkeypress="" value="<?php echo $cardnumber ?>">
								<span id="errorCardNumber" class="text-danger"></span>
							</div>
							<div class="col-md-9">
								<div class="row">
									<div class="col-md-4">
										<label>Expiry Month</label>
										<input type="text" name="cardExpMonth" id="cardExpMonth" class="form-control" placeholder="MM" maxlength="2" onkeypress="return validateNumber(event);" value="<?php echo $month ?>">
										<span id="errorCardExpMonth" class="text-danger"></span>
									</div>
									<script>
										$(document).ready(function(){
											$("#cardExpMonth").keyup(function(){
												var mm = $("#cardExpMonth").val();

												if((mm ==0)||(mm ==12)||(mm ==11)||(mm ==10)||(mm ==09)||(mm ==08)||(mm ==07)||(mm ==06)||(mm ==05)||(mm ==04)|(mm ==03)||(mm ==02)||(mm ==01)||(mm ==00)) 
												{
													$("#cardExpMonth").val(mm);
												}
												else{
													$("#cardExpMonth").val("");
												}
											})
										})
									</script>
									<div class="col-md-4">
										<label>Expiry Year</label>
										<input type="text" name="cardExpYear" id="cardExpYear" class="form-control" placeholder="YYYY" maxlength="4" onkeypress="return validateNumber(event);" value="<?php echo $year ?>">
										<span id="errorCardExpYear" class="text-danger"></span>
									</div>
									<div class="col-md-4">
										<label>CVV</label>
										<input type="password" name="cardCVC" id="cardCVC" class="form-control" placeholder="XXX"  maxlength="3" onkeypress="return validateNumber(event);" value="<?php echo $cvc ?>">
										<span id="errorCardCvc" class="text-danger"></span>
									</div>
								</div>
							</div>
							<br>
							<div class="col-md-7" align="left" style=" margin-top: 12px; ">
								<input type="hidden" class="dynamic-pid" id="spByuerProfileId" name="buyer_pid" value="<?php echo $_SESSION['pid']?>"/>

								<input type="hidden" class="dynamic-pid" id="spBuyeruserId" name="buyer_uid" value="<?php echo $_SESSION['uid']?>"/>
								<input type="hidden" id="total_amountforss" name="total_amount" value="<?php echo $discountedPrice; ?>">
								<input type="hidden" id="postid" name="postid" value="<?php echo $postid; ?>">
								<input type="hidden" id="item-details" name="item_details" value="<?php echo $ProTitle ?>">
								<input type="hidden" id="sellerpidforss" name="seller_pid" value="<?php echo $seller_pid ?>">
								<input type="hidden" id="selleruidforss" name="seller_uid" value="<?php echo $seller_uid ?>">
								<input type="hidden" id="prodt_currency" name="currency_code" value="<?php echo $currency; ?>">
								<!--<input type="hidden" name="shipping_address" value="<?php  echo $shpping_Address; ?>">-->
								<button type="button" class="btn butn_cancel  btn-border-radius" name="payNow" id="payNow"  style=" padding: 5px 7px !important;" onclick="stripePay(event)" value="Pay Now" href="javascript:;"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>Pay Now <span id="totalpriceforss"><?php echo $currency.' '.$discountedPrice;?><span></button>
									<span><label for="cardDetails"></label><input type="checkbox" name="cardDetails" id="cardDetails"><label for="cardDetails">Save Card</label></span>
									<!-- <input type="button" name="payNow" id="payNow" class="btn btn-success btn-sm" onclick="stripePay(event)" value="Pay Now" /> -->
								</div>
								<br>
							</div>
						</div>
						<div class="col-md-2"></div>
					</form>
				</div>
				<div class="modal-footer">
					<!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close11</button>-->
				</div>
			</div>
		</div>
	</div>

	<div class="space-lg"></div>

	<?php 
	include('../component/f_footer.php');
// include('../component/btm_script.php');
	include('../component/f_btm_script.php');
	?>
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-creditcardvalidator/1.0.0/jquery.creditCardValidator.js"></script>	
	<script type="text/javascript" src="<?php echo $BaseUrl; ?>/assets/js/payment.js"></script>
	<script>
		Stripe.setPublishableKey('<?php echo PUBLIC_KEY?>');
	</script>
	<script>
		$(document).ready(function() {
                           // $("#success-alert").hide();
			$("#payNow").click(function showAlert() {
				$("#success-alert").fadeTo(2000, 500).slideUp(500, function() {
					$("#success-alert").slideUp(500);
				});
			});
		});			
	</script>
	<script>
		$(document).ready(function() {
                           // $("#success-alert").hide();
			$("#payNow").click(function showAlert() {
				$("#danger-alert").fadeTo(2000, 500).slideUp(500, function() {
					$("#danger-alert").slideUp(500);
				});
			});
		});			
	</script>
	<script type="text/javascript">
		$(document).ready(function(){
//Rating Testing
			$("#train_postrating .stars").click(function () {
				$("#spPostRating").val($(this).val());
				var userId = <?php echo $_SESSION['pid']?>;
				var TrainId = <?php echo $postid?>;
				$.post('trainingRating.php', {rating: $(this).val(), profileid: userId, trainingId: TrainId}, function (d) {
				});
			});
		});
	</script>
</body>
</html>
<?php
}
?>
